<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\users\checkOtpRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\users\UserResource;
use App\Traits\messageTrait;
use App\Models\User;
use App\Http\Requests\api\users\LoginRequest;
use App\Http\Requests\api\users\RegisterRequest;
use App\Http\Requests\api\users\checkPhoneRequest;
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
            $token = $user->createToken($request->device_token)->plainTextToken;
            return $this->successfully(trans('api.UserCreatedSuccessfully'), ['user' => new UserResource($user),'token'=>$token]);
        }catch(\Exception $e){
            DB::rollBack();
            return $this->failed($e->getMessage(),400);
        }
        return $user;
    }
    public function checkPhone(checkPhoneRequest $request){
        $user = User::where('phone', $request->input('phone'))
            ->where('country_code', $request->input('country_code'))->first();
        if($user){
            // $otp = rand(1000, 9999);
            $user->update([
                'otp' => '1234',
            ]);
            return $this->successfully(trans('api.OtpSentSuccessfully'),[
                'user' => new UserResource($user)
            ]);
        }
        return $this->failed(trans('api.pleaseRecheckYourDetails'));
    }
    public function checkOtp(checkOtpRequest $request){
        try {
            $user = User::where('phone', $request->phone)->first();
            if($user){
                if($user->otp==$request->otp){
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
    public function login(LoginRequest $request){
        DB::beginTransaction();
        try{
            if (Auth::attempt($request->only(['phone', 'password'])))
            {
                $user=auth()->user();
                $token = $user->createToken($request->device_token)->plainTextToken;
                DB::commit();
                return $this->successfully(trans('api.UserLoggedInSuccessfully'), ['user' => new UserResource($user), 'token' => $token]);
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

}
