<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, Crypt};
use App\Models\User;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Support\Facades\RateLimiter;

class OtpAndEmailVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $ipAddress = RequestFacade::ip();
        $key = 'rate_limit:' . $ipAddress;
        $email = Auth::user()->email;
        $user = DB::table('users')
            ->where('email', isset($email) ? $email : '')
            ->where('role', 'user')
            ->first();

        if(isset($user) && !empty($user))
        {
            $userModel = User::find($user->id);
            // if($user->otp_verified_at == null || empty($user->otp_verified_at)){
            //     Auth::logout();
            //     $email = isset($email) ? $email : '';
            //     $mobile = ltrim($user->mob_code . $user->phone, '+');
            //     if(session()->has('verification_code')){
            //         $randomNumber = decrypt(session('verification_code'));
            //     }else{
            //         $randomNumber = rand(1000, 9999);
            //     }
            //     $OTPResponse = $userModel->sendOTP($mobile, $email, $key);
            //     if(isset($OTPResponse) && !empty($OTPResponse)){
            //         if($OTPResponse['Success'] == 'True'){
            //             session(['verification_code' => encrypt($randomNumber)]);
            //             $email = $email;
            //             return redirect()->route('mobile-number-verification', ['email' => base64_encode($email)]);
            //         }
            //     }
            // }elseif($user->email_verified_at == null || empty($user->email_verified_at)){
                
            //     Auth::logout();
            //     $dyc_id = Crypt::encrypt($user->id);
            //     $link =  env('APP_URL') . "/verfiy-mail/" . $dyc_id;
            //     mail_send(32, ['#Name#', '#Link#', '#unsubscribeRoute#'], [$user->name." ".$user->last_name, $link, $email], $email);
            //     $url ='email-id-verification';
            //     return redirect()->intended($url)->with('statusEmail', $email);
            // }

            // if($user->otp_verified_at == null || empty($user->otp_verified_at)){
            //     Auth::logout();
            //     $email = $request->email;
                
            //     $mobile = ltrim($user->mob_code . $user->phone, '+');
            //     if(session()->has('verification_code')){
            //         $randomNumber = decrypt(session('verification_code'));
            //     }else{
            //         $randomNumber = rand(1000, 9999);
            //     }
                
            //     $OTPResponse = $userModel->sendOTP($mobile, $randomNumber, $key);
            //     if (is_array($OTPResponse) && !empty($OTPResponse)) {
            //         if (isset($OTPResponse['data']['Success']) && $OTPResponse['data']['Success'] === 'True') {
            //             $messageId = $OTPResponse['data']['MessageUUID'];
            //             $verifyOTPResponse = $userModel->sendOtpApiRequest('GET', $messageId);
            //             if (is_array($verifyOTPResponse) && !empty($verifyOTPResponse) && $verifyOTPResponse['code'] === 200) {
            //                 session(['verification_code' => encrypt($randomNumber)]);
            //                 $email = $email;
            //                 return redirect()->route('mobile-number-verification', ['email' => base64_encode($email)]);
            //             }else{
            //                 return redirect()->intended('login-view')->withErrors(['error' => 'Something Went Wrong.']);
            //             }
            //         }else{
            //             $seconds = RateLimiter::availableIn($key);
            //             $minutes = floor($seconds / 60);
            //             $remainingSeconds = $seconds % 60;
            //             return redirect()->back()->with('rate_limit_error', 'Too many requests. Please try again in ' . $minutes . ' minute and ' . $remainingSeconds . ' second.');
            //         }
            //     }else{
            //         $seconds = RateLimiter::availableIn($key);
            //         $minutes = floor($seconds / 60);
            //         $remainingSeconds = $seconds % 60;
            //         return redirect()->back()->with('rate_limit_error', 'Too many requests. Please try again in ' . $minutes . ' minute and ' . $remainingSeconds . ' second.');
            //     }
            // }else
            
            if($user->email_verified_at == null || empty($user->email_verified_at)){
                Auth::logout();
                $dyc_id = Crypt::encrypt($user->id);
                $email = $request->email;
                $link =  env('APP_URL') . "/verfiy-mail/" . $dyc_id;
                $unsubscribeRoute = url('/unsubscribe/'.base64_encode($email));
                mail_send(32, ['#Name#', '#Link#', '#unsubscribeRoute#'], [$user->name." ".$user->last_name, $link, $unsubscribeRoute], $email);
                $url ='email-id-verification';
                $email = $request->email;
                session(['statusEmail' => $request->email]);
                $request->user()->update([
                    'last_seen' => now(),
                ]);
                return redirect()->intended($url)->with('statusEmail', $email);
            }else{
                return redirect()->route('index');
            }
        }

        return $next($request);
    }
}
