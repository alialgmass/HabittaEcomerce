<?php
namespace App\Repositories\Users;

use App\Http\Requests\api\user\UserRequest;
use App\Http\Resources\users\UserResource;
use App\Models\User;
use App\Repositories\Users\AuthRepository;
use App\Traits\messageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthModelRepository implements AuthRepository{
    use messageTrait;
    public function register($data)
    {
        DB::beginTransaction();
        try{
            $user = User::create($data);
            // $user->assignRole('user');
            $user->save();
            DB::commit();
            return $this->successfully(trans('api.UserCreatedSuccessfully'), ['user' => new UserResource($user)]);
        }catch(\Exception $e){
            DB::rollBack();
            return $this->failed($e->getMessage(), $e->getCode());
        }
    }

    public function checkOtp($request)
    {
        $type = $request->type;
        $phone = $request->phone;
        $otp = $request->otp;
        $msg = trans('api.UserInformation');
        $user = null;
        $token = '';
        if ($type != "update") {
            $user = User::where('phone', $phone)->where('otp', $otp)->first();
            if($user)
            {
                $token = $user->createToken($request->device_token)->plainTextToken;
            }
        } elseif ($type === "update") {
            $user = User::where('newPhone', $phone)->where('otp', $otp)->first();
        }

        if (!$user) {
            return $this->failed(trans('api.OtpDoesNotMatchWithThisPhone'));
        }

        if ($type === "register" && $user->is_verified == 1) {
            return $this->failed(trans('api.UserAlreadyVerified'));
        }

        $userData = [
            'otp' => null,
            'is_verified' => 1,
            'device_token' => $request->device_token
        ];

        if ($type === "update") {
            $userData['phone'] = $request->phone;
            $userData['country_code'] = $request->country_code;
            $userData['newPhone'] = null;
            $userData['newCountryCode'] = null;
            $msg = trans('api.PhoneNumberHasBeenChangedSuccessfully');
        }

        $user->update($userData);

        return $this->successfully($msg, [
            'user' => new UserResource($user),
            'token' => $token
        ]);
    }

    public function login($request)
    {
        DB::beginTransaction();
        try{
            if (!Auth::attempt($request->only(['phone', 'password'])))
            {
                return $this->failed(trans('api.phone&PasswordDoesNotMatchWithOurRecord'));
            }
            $user = User::where('phone', $request->phone)->first();
            if ($user->is_verified == 0)
            {
                return $this->notVerify(trans('api.pleaseCompleteYourData') , [
                    'user' => new UserResource($user)
                ]);
            }
            $token = $user->createToken($request->device_token)->plainTextToken;
            DB::commit();
            return $this->successfully(trans('api.UserLoggedInSuccessfully'), ['user' => new UserResource($user), 'token' => $token]);
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return $this->failed($e->getMessage(), $e->getCode());
        }
    }

    public function logout()
    {
        DB::beginTransaction();
        try
        {
            $user = auth()->user()->tokens()->delete();
            DB::commit();
            if($user)
            {
                return $this->successfully(trans('api.UserLoggedOutSuccessfully'), []);
            }
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return $this->failed($e->getMessage(), $e->getCode());
        }
    }

    public function resetPassword($request)
    {
        $user = User::where('phone', $request->phone)->where('country_code', $request->country_code)->first();
        try
        {
            if($user){
                $user->update([
                    'password' => $request->password,
                    'otp' => null
                ]);
                return $this->successfully(trans('api.PasswordResetSuccessfully'), [
                    'user' => new UserResource($user),
                ]);
            }
            return $this->failed(trans('api.pleaseRecheckYourDetails'));
        }
        catch(\Exception $e)
        {
            return $this->failed($e->getMessage(), $e->getCode());
        }
    }
}

?>
