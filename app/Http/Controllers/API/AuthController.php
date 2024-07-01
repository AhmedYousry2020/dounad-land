<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserConfirmTokenRequest;
use App\Http\Requests\UserForgetPasswordRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserResetPasswordRequest;
use App\Http\Requests\UserUpdateProfileRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\UserCollection;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\ResetPassword;
use App\Notifications\VerifyAccount;
use App\Services\OtpService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    private $otpService;
    public function __construct(OtpService $otpService){
      $this->otpService = $otpService;

    }
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

            //send otp
            $this->otpService->sendOtp($request, $user);

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

            if(!$user->email_verified_at)
                return api(false, 400, __('This Account not verified'))->get();

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
     * verify otp
     * @return JsonResponse
     */
    public function verifyOtp(VerifyOtpRequest $request)
    {
        try {
            $data = $request->validated();
            $user = User::where('phone', $data['phone'])->first();

            if($this->otpService->checkOtp($request))
            {
              $user->email_verified_at = Carbon::now();
              $user->save();
              return api(true, 200, __('OTP verified successfully'))->get();
            }else
            {
              return api(false, 400, __('Invalid OTP'))->get();
            }
        } catch (\Exception $e) {
            return api_exception($e);
        }
    }

    public function sendOtpAgain()
    {
        try {
            $user = auth()->user();
            $request = ['email'=>$user->email,'phone'=> $user->phone];
            //send otp
            $otp = $this->otpService->sendOtp($request, $user);
            return api(true, 200, __('OTP Send successfully'))->get();

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
        $user = User::where('phone', $request['phone'])->first();
        if (!$user) return api(false, 404, __('api.404'))->get();
        $resetPasswordToken = rand(50, 99) . rand(50, 99) . rand(50, 99);

        $passwordReset = PasswordReset::where('phone', $request['phone'])->first();
            PasswordReset::create([
                'phone' => $user->phone,
                'email'=>$user->email,
                'token'=>$resetPasswordToken,
            ]);
        $user->notify(new ResetPassword("reset password code  ".$resetPasswordToken));

        return api(true, 200, __('api.success'))
              ->get();
        } catch (\Exception $e) {
            return api_exception($e);
        }
    }

     /**
     * forget confirm token user
     * @param UserForgetPasswordRequest $request
     * @return JsonResponse
     */
    // public function forgetConfirmCode(UserConfirmTokenRequest $request) {
    //         try {
    //             $resetPasswordToken = PasswordReset::where('token', $request['token'])
    //                 ->first();
    //             if (!$resetPasswordToken)
    //                 return api(false, 400, __('api.wrong_code'))->get();
    //             if (!$resetPasswordToken && $resetPasswordToken->token != $request['token'])
    //                 return api(false, 400, __('api.wrong_code'))->get();

    //             return api(true, 200, __('api.success'))
    //                 ->get();
    //         } catch (\Exception $e) {
    //             return api_exception($e);
    //         }
    // }

     /**
     * reset password user
     * @param UserResetPasswordRequest $request
     * @return JsonResponse
     */
    public function resetPassword(UserResetPasswordRequest $request) {
        try {

          $resetPasswordToken = PasswordReset::where('token', $request['token'])
          ->first();

          if (!$resetPasswordToken)
              return api(false, 400, __('api.wrong_code'))->get();
          if (!$resetPasswordToken && $resetPasswordToken->token != $request['token'])
              return api(false, 400, __('api.wrong_code'))->get();

          $user = User::where('phone', $request['phone'])->first();

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

    public function updateProfile(UserUpdateProfileRequest $request)
    {
        try {
            $user = auth()->user();
            $data = $request->validated();
            $user->email = $data['email'];
            $user->name = $data['name'];
            $user->device_token = $data['device_token'];
            $user->save();

            return api(true, 200, __('api.success'))
            ->add('user', new UserCollection($user))
            ->get();
        } catch (\Exception $e) {
            return api_exception($e);
        }
    }
    public function orders()
    {
        try {
            $user = auth()->user();
            $orders = $user->orders;
            return api(true, 200, __('api.success'))
            ->add('order', OrderCollection::collection($orders))
            ->get();
        } catch (\Exception $e) {
            return api_exception($e);
        }
    }
}
