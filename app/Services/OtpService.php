<?php

namespace App\Services;

use App\Interfaces\OtpInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
      if(Carbon::now()->lt($otp->expired_at))
      {
        return false;
      }

      return true;
  }

  function sendOtp(Request $request)
  {
        // $otp = rand(50, 99) . rand(50, 99) . rand(50, 99);
        //for testing
        $otp = 111111;
        $verificationOtp = $this->otpRepository->store([
          'otp'=>$otp,
          'phone_number'=>$request->phone,
          'expired_at'=> Carbon::now()->addMinutes(2)
        ]);
        // SEND SMS
        return true;

  }

}
