<?php
namespace App\Repositories\Users;

use App\Http\Requests\api\user\UserRequest;
use App\Http\Resources\users\UserResource;
use App\Models\User;
use App\Repositories\Users\UserRepository;
use App\Traits\messageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserModelRepository implements UserRepository{
    use messageTrait;
    public function requestUser(UserRequest $request, $id = null){
        DB::beginTransaction();
        try{
            $userCheck = $id ? User::find($id) : new User;
            $user = $userCheck->createOrUpdate($request, $id);
            DB::commit();
            return $user;
        }catch(Exception $e){
            DB::rollBack();
            return $this->failed($e->getMessage(), $e->getCode());
        }
    }

    public function show(){
        try{
            $user = auth()->user();
            return new UserResource($user);
        }catch(Exception $e){
            return $this->failed($e->getMessage(), $e->getCode());
        }
    }

    public function update($data){
        $user = auth()->user();
        if(isset($data['image'])){
            if($user->getRawOriginal('image') != ''){
                $file_path = public_path('uploads/users/' . $user->id . '/' . $user->getRawOriginal('image'));
                unlink($file_path);
            }
            $data['image'] = upload_image('users/' . $user->id, $data['image']);
        }
        $user->update($data);
        $user->save();
        return new UserResource($user);
    }
    public function changePassword($newPassword)
    {
        try {
            $user = auth()->user();
            if (Hash::check($newPassword['old_password'], $user->password)) {
                $user->update([
                    'password' => $newPassword['password']
                ]);
                $user->save();
                return $this->successfully(trans('api.passwordUpdatedSuccessfully'), [
                    'user' => new UserResource($user)
                ]);
            } else {
                return $this->failed(trans('api.oldPasswordNotCorrect'));
            }
        } catch (\Exception $e) {
            return $this->failed($e->getMessage(), $e->getCode());
        }
    }
}

?>
