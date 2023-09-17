<?php

namespace App\Repositories\Users;
use App\Http\Requests\api\user\UserRequest;
use App\Http\Requests\api\users\UpdatePasswordRequest;

interface UserRepository {
    public function requestUser(UserRequest $request, $id = null);
    public function show();
    public function update($data);
    public function changePassword(UpdatePasswordRequest $request);
}
?>
