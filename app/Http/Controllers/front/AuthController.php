<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\users\ChangePasswordRequest;
use App\Http\Requests\api\users\checkOtpRequest;
use App\Jobs\ResetOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\users\UserResource;
use App\Traits\messageTrait;
use App\Models\User;
use App\Http\Requests\api\users\LoginRequest;
use App\Http\Requests\api\users\RegisterRequest;
use App\Http\Requests\api\users\checkPhoneRequest;
use App\Models\country\Country;
use App\Http\Resources\countries\CountryResource;
use Exception;

class AuthController extends Controller
{
    use messageTrait;
    public function register(RegisterRequest $request){
        $data = $request->validated();
        $data += [
            'language' => $request->header('Accept-Language'),
            // 'otp' => rand(1000, 9999)
   "type"=>'user'
        ];
        DB::beginTransaction();
        try{
            $user = User::create($data);
             $user->assignRole('user');
            $user->save();
            DB::commit();
         //   $token = $user->createToken($request->device_token)->plainTextToken;
            return $this->successfully(trans('api.UserCreatedSuccessfully'), ['user' => new UserResource($user)]);
        }catch(\Exception $e){
            DB::rollBack();
            return $this->failed($e->getMessage(),400);
        }
        return $user;
    }
    public function checkPhone(CheckPhoneRequest $request)
    {
        $user = User::where('phone', $request->input('phone'))
            ->where('country_code', $request->input('country_code'))
            ->first();

        if ($user) {
            $user->update([
                'otp' => '1234',
            ]);

          //  ResetOtp::dispatch($user)->delay(now()->addSeconds(90));

            return $this->successfully(trans('api.OtpSentSuccessfully'), [
                'user' => new UserResource($user),
            ]);
        }

        return $this->failed(trans('api.pleaseRecheckYourDetails'));
    }
    public function checkOtp(checkOtpRequest $request){
        try {
            $user = User::where('phone', $request->phone)->first();
            if($user){
                if($user->otp==$request->otp){
                    $user->update(['is_verified'=>1]);
                    return $this->successfully(trans('api.otpIsTrue'),[]);
                }
                else{
                    return $this->failed(trans('api.OtpDoesNotMatchWithThisPhone'));
                }
            }
            else{
                return $this->failed(trans('api.notFound'));
            }


        }
        catch (\Exception $exception){
            return $this->failed($exception->getMessage(), $exception->getCode());
        }

    }
    public function resetPassword(ChangePasswordRequest $request){
        try {
            $user = User::where('phone', $request->phone)->first();
            if($user){
                if($user->otp==$request->otp){
                    if(\Hash::check($request->password,$user->password)){
                        return $this->failed(trans('api.cannotChangePasswordWithSamePassword'));
                    }
                    else{

                        $user->update(['password'=>$request->password]);
                        $user->tokens()->delete();
                        return $this->successfully(trans('api.PasswordResetSuccessfully'),[]);
                    }

                }
                else{
                    return $this->failed(trans('api.OtpDoesNotMatchWithThisPhone'));
                }
            }
            else{
                return $this->failed(trans('api.notFound'));
            }


        }
        catch (\Exception $exception){
            return $this->failed($exception->getMessage(), $exception->getCode());
        }
    }
    public function login(LoginRequest $request){
        DB::beginTransaction();
        try{
            if (Auth::attempt($request->only(['phone', 'password'])))
            {

                $user=auth()->user();
                if($user->is_verified!=1){
                    return $this->failed(trans('api.UserIsNotVerified'));
                }
                else{
                    $token = $user->createToken($request->device_token)->plainTextToken;
                    DB::commit();
                    return $this->successfully(trans('api.UserLoggedInSuccessfully'), ['user' => new UserResource($user), 'token' => $token]);
                }

            }
            else
            return $this->failed(trans('api.phone&PasswordDoesNotMatchWithOurRecord'));

        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return $this->failed($e->getMessage(), $e->getCode() ?: 400);
        }
    }
    public function countriesPicker(){
        $contry=Country::all();
        return $this->successfully('true',['countries'=>CountryResource::collection($contry)]);
    }

}
