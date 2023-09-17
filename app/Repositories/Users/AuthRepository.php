<?php

namespace App\Repositories\Users;

interface AuthRepository {
    public function register($data);
    public function checkOtp($request);
    public function resetPassword($request);
    public function login($request);
    public function logout();

}
?>
