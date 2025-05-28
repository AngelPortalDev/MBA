<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\App;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('frontend.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        if ($request->has('honeypot') && !empty($request->input('honeypot'))) {
            return redirect()->back()->with('error', 'Bot detected!');
        }
        
        // $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        //     'secret' => env('GOOGLE_SECRET_KEY'),
        //     'response' => $request->input('g-recaptcha-response'),
        //     ]);
            
        // $responseBody = json_decode($response->getBody());
        
        if ((request()->getHost() === 'www.eascencia.mt' || request()->getHost() === 'www.dev.eascencia.mt') && env('GOOGLE_SECRET_KEY')) {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => env('GOOGLE_SECRET_KEY'),
                'response' => $request->input('g-recaptcha-response'),
            ]);
        
            $responseBody = json_decode($response->getBody());
        
            if (!$responseBody->success) {
                return back()->withErrors(['captcha' => 'Invalid reCAPTCHA response. Please try again.']);
            }
        } else {
            $responseBody = (object)['success' => true];
        }

        if ($responseBody->success == true) {

            $ipAddress = RequestFacade::ip();
            $key = 'rate_limit:' . $ipAddress;
            $request->authenticate();
            $request->session()->regenerate();
            
            $user = DB::table('users')
                ->where('email', $request->email)
                ->where('role', 'user')
                ->first();
    
            if(isset($user) && !empty($user))
            {
                // if($user->otp_verified_at == null || empty($user->otp_verified_at)){
                //     Auth::logout();
                //     $email = $request->email;
                    
                //     $mobile = ltrim($user->mob_code . $user->phone, '+');
                //     if(session()->has('verification_code')){
                //         $randomNumber = decrypt(session('verification_code'));
                //     }else{
                //         $randomNumber = rand(1000, 9999);
                //     }
                //     // $OTPResponse = $this->user->sendOTP($mobile, $randomNumber);
                //     // if(isset($OTPResponse) && !empty($OTPResponse)){
                //     //     if($OTPResponse['Success'] == 'True'){
                //     //         session(['verification_code' => encrypt($randomNumber)]);
                //     //         $email = $email;
                //     //         return redirect()->route('mobile-number-verification', ['email' => base64_encode($email)]);

                //     //     }
                //     // }
                    
                //     // return redirect()->route('mobile-number-verification', ['email' => base64_encode($email)]);
                    
                //     $OTPResponse = $this->user->sendOTP($mobile, $randomNumber, $key);
                //     if (is_array($OTPResponse) && !empty($OTPResponse)) {
                //         if (isset($OTPResponse['data']['Success']) && $OTPResponse['data']['Success'] === 'True') {
                //             $messageId = $OTPResponse['data']['MessageUUID'];
                //             $verifyOTPResponse = $this->user->sendOtpApiRequest('GET', $messageId);
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
                //             // return redirect()->intended('login-view')->withErrors(['error' => 'Something Went Wrong.']);
                //         }
                //     }else{
                //         $seconds = RateLimiter::availableIn($key);
                //         $minutes = floor($seconds / 60);
                //         $remainingSeconds = $seconds % 60;
                //         return redirect()->back()->with('rate_limit_error', 'Too many requests. Please try again in ' . $minutes . ' minute and ' . $remainingSeconds . ' second.');
                //         // return redirect()->intended('login-view')->withErrors(['error' => 'Something Went Wrong.']);
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

                    return redirect()->intended($url)->with('statusEmail', $email);
                }else{

                    if (session()->has('intended_action_wishlist')){
                        $response = App::call('App\Http\Controllers\CartController@addWishlist');
                        $decodedResponse = json_decode($response, true);
                        session()->forget('intended_action_wishlist'); // Clear the session after use
                        session()->forget('form_data'); // Clear the session after use
                        // Store the decoded response in the session, like title, message, and icon
                        session()->flash('response_data', [
                            'title' => $decodedResponse['title'] ?? $decodedResponse['title'],
                            'message' => $decodedResponse['message'] ?? $decodedResponse['message'],
                            'icon' => $decodedResponse['icon'] ?? 'success' // Use 'success', 'error', etc.
                        ]);

                        return redirect('/');
                    }
                    if (session()->has('intended_action_cart')){

                        $response = App::call('App\Http\Controllers\CartController@addtocart');
                        $decodedResponse = json_decode($response, true);
                        session()->forget('intended_action_cart'); // Clear the session after use
                        session()->forget('form_data'); // Clear the session after use
                        session()->flash('response_data', [
                            'title' => $decodedResponse['title'] ?? $decodedResponse['title'],
                            'message' => $decodedResponse['message'] ?? $decodedResponse['message'],
                            'icon' => $decodedResponse['icon'] ?? 'success' // Use 'success', 'error', etc.
                        ]);
                        return redirect('/');
                    }
                    
                    if (session()->has('intended_url') && session()->has('form_data')) {   
                        $formData =  session('form_data');              
                        $redirectUrl = session('intended_url');
                        session()->forget('intended_url'); // Clear the session after use
                        return redirect()->intended('checkout')->with('formData', $formData);
                    }
                    return redirect('/');
                }
            }

        

            $message = ['message' => 'Login Successfully', 'type' => 'success'];

                $url = '';
                
                if ($request->user()->role === 'admin' || $request->user()->role === "superadmin" || $request->user()->role === "sales" ) { 
                    $url = 'admin/dashboard';
                } elseif ($request->user()->role === 'user') {
                    $url = '';
                } elseif ($request->user()->role === 'instructor') {
                    $url =  'ementor/e-mentor-courses';
                } elseif ($request->user()->role === 'sub-instructor') {
                    $url =  'sub-ementor/sub-e-mentor-dashboard';
                } elseif ($request->user()->role === 'institute') {
                    $url = 'institute/institute-dashboard';
                }
                $request->user()->update([
                    'last_seen' => now(),
                ]);
                
                return redirect()->intended($url)->with($message);
        } else {
            $message = ['message' => 'Please Try Again', 'type' => 'error'];
            return redirect()->back()->withErrors(['recaptcha' => 'reCAPTCHA verification failed. Please try again.']);
        }
       


        // return redirect()->intended(RouteServiceProvider::HOME);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect('/')->with('status', 'logout');
    }
}