<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\front\HomeController;
use Illuminate\Support\Facades\Route;


##########################################  begain home routs ############

Route::get('/home', [HomeController::class,'index'])->name('user.index');


















Route::get('SwitchLang/{lang}',function($lang){
    session()->put('Lang',$lang);
    app()->setLocale($lang);
    if (auth()->check()) {
        $user = App\Models\User::find(auth()->user()->id)->update(['language'=>$lang]);
    }
	return Redirect::back();
});


Auth::routes();


