<?php

namespace App\Services;

use App\Interfaces\OtpInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifiyEmail;


class OtpService {

  private $otpRepository;


  public function __construct(OtpInterface $otpRepository)
  {
      $this->otpRepository = $otpRepository;
  }
  function checkOtp(Request $request)
  {
      $user = User::where('phone',$request->phone)->first();
      $otp = $this->otpRepository->findByMany(['phone_number'=> $request->phone,'otp'=>$request->otp]);

      if(!$otp)
      {

        return false;
      }
      if(Carbon::now()->gt($otp->expired_at))
      {

        return false;
      }

      return true;
  }

  function sendOtp($request, $user)
  {
        $otp = rand(50, 99) . rand(50, 99) . rand(50, 99);

        $verificationOtp = $this->otpRepository->store([
          'otp'=>$otp,
          'phone_number'=>$request['phone'],
          'email'=>$request['email'],
          'expired_at'=> Carbon::now()->addMinutes(65)
        ]);
        // SEND SMS
        // SEND OTP TO EMAIL
        Mail::to($user->email)->send(new VerifiyEmail($otp));

        // $user->notify(new VerifyAccount("verification code  ".$otp));

        return true;

  }

}
