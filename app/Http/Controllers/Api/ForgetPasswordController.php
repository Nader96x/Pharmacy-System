<?php

namespace App\Http\Controllers\Api;


use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ForgetPasswordController extends BaseController
{
    public function forgetPassword($request){
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        if( $status === Password::RESET_LINK_SENT)
          return  $this->sendResponse(['status' => __($status)]);
        else
            return  $this->sendError(['email' => __($status)]);
    }
    public function resetPassword($request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );
        if( $status === Password::PASSWORD_RESET)
            return $this->sendResponse('password updated');
        else
           return  $this->sendError(['email' => [__($status)]]);


    }
}
