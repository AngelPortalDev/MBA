<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\User;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('frontend.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/',
                function ($attribute, $value, $fail) use ($request) {
                    $user = User::where('email', $request->email)->first();
                    if ($user && Hash::check($value, $user->password)) {
                        $fail('The new password cannot be the same as the old password.');
                    }
                },],
            'password_confirmation' => 'required|same:password',
        ],[
            'password.required' => 'Please enter a new password.',
            'password_confirmation.required' => 'The enter a confirm password.',
            'password_confirmation.same' => 'The confirmation password does not match.',
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if($status == Password::PASSWORD_RESET){
            $user = User::where('email', $request->email)->first();
            $loginUrl = url('/login-view');
            $unsubscribeRoute = url('/unsubscribe/'.base64_encode($request->email));
            mail_send(
                39,
                [
                    '#Name#',
                    '#Web Link#',
                    '#email#',
                    '#unsubscribeRoute#',
                    
                ],
                [
                    $user->name." ".$user->last_name,
                    $loginUrl,
                    $request->email,
                    $unsubscribeRoute,
                ],
                $request->email
            );
            return $status == Password::PASSWORD_RESET
                        ? back()->with('status', __($status))
                        : back()->withInput($request->only('email'))
                                ->withErrors(['email' => __($status)]);
        }else{
            
            return $status == Password::PASSWORD_RESET
            ? back()->with('status', __("Password Reset Link Expired or Already Used. Please request a new link."))
            : back()->with('status', __("Password Reset Link Expired or Already Used. Please request a new link."));
        }
    
    }
}
