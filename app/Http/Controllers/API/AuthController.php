<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserConfirmTokenRequest;
use App\Http\Requests\UserForgetPasswordRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserResetPasswordRequest;
use App\Http\Resources\UserCollection;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\ResetPassword;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * register user
     * @param UserRegisterRequest $request
     * @return JsonResponse
     */
    public function register(UserRegisterRequest $request)
    {
        try{
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);
            $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
            $user->token = $token;
            return api(true, 200, __('api.success_login'))
                ->add('user', new UserCollection($user))
                ->get();
        }catch(\Exception $e)
        {
            return api_exception($e);
        }
    }
    /**
     * login user
     * @param UserLoginRequest $request
     * @return JsonResponse
     */
    public function login(UserLoginRequest $request)
    {
        try {
            $data = $request->validated();
            $user = User::where('phone', $data['phone'])->first();
            if (!$user)
                return api(false, 400, __('constants.loginErr'))->get();

            if (!Hash::check($data['password'], $user->password))
                return api(false, 400, __('constants.loginErr'))->get();

            $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
            $user->token = $token;
            return api(true, 200, __('api.success_login'))
                ->add('user', new UserCollection($user))
                ->get();
        } catch (\Exception $e) {
            return api_exception($e);
        }
    }

     /**
     * logout user
     * @return JsonResponse
     */
    public function logout()
    {
        try {
            auth()->user()->tokens()->delete();
            return api(true, 200, __('api.success_logout'))->get();
        } catch (\Exception $e) {
            return api_exception($e);
        }
    }

    /**
     * forget password user
     * @param UserForgetPasswordRequest $request
     * @return JsonResponse
     */
    public function forgetPassword(UserForgetPasswordRequest $request)
    {
        try{
        $user = User::where('email', $request['email'])->first();
        if (!$user) return api(false, 404, __('api.404'))->get();
        $resetPasswordToken = str_pad(random_int(1, 9999), 4, '0', STR_PAD_LEFT);

        $passwordReset = PasswordReset::where('email', $request['email'])->first();
            PasswordReset::create([
                'email' => $user->email,
                'token'=>$resetPasswordToken
            ]);
        $user->notify(new ResetPassword("reset password code  ".$resetPasswordToken));

        return api(true, 200, __('api.success'))->get();
        } catch (\Exception $e) {
            return api_exception($e);
        }
    }

     /**
     * forget confirm token user
     * @param UserForgetPasswordRequest $request
     * @return JsonResponse
     */
    public function forgetConfirmCode(UserConfirmTokenRequest $request) {
            try {
                $resetPasswordToken = PasswordReset::where('token', $request['token'])
                    ->first();
                if (!$resetPasswordToken)
                    return api(false, 400, __('api.wrong_code'))->get();
                if (!$resetPasswordToken && $resetPasswordToken->token != $request['token'])
                    return api(false, 400, __('api.wrong_code'))->get();

                return api(true, 200, __('api.success'))
                    ->get();
            } catch (\Exception $e) {
                return api_exception($e);
            }
    }

     /**
     * reset password user
     * @param UserResetPasswordRequest $request
     * @return JsonResponse
     */
    public function resetPassword(UserResetPasswordRequest $request) {
        try {
            $user = User::where('email', $request['email'])->first();

            // $resetPasswordToken = PasswordReset::where('email',$request['email'])->first();
            // if(!$resetPasswordToken && $resetPasswordToken->token != $request['token'])
            //      return api(false, 404, __('api.404'))->get();

            $user->password = bcrypt($request['password']);
            $user->save();

            return api(true, 200, __('api.success'))
                ->add('user', new UserCollection($user))
                ->get();
        } catch (\Exception $e) {
            return api_exception($e);
        }
    }

    /**
     * profile user
     * @return JsonResponse
     */
    public function profile()
    {
        try {
            $user = auth()->user();
            return api(true, 200, __('api.success'))
            ->add('user', new UserCollection($user))
            ->get();
        } catch (\Exception $e) {
            return api_exception($e);
        }
    }
}
