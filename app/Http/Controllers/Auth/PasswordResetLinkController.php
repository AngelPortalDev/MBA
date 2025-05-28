<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use App\Models\User;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        // $status = Password::sendResetLink(
        //     $request->only('email')
        // );

        // if ($status == Password::RESET_LINK_SENT) {
            $user = User::where('email', $request->email)->first();

            if ($user) {
                $token = Password::createToken($user);
                $resetUrl = url('/reset-password/' . $token . '?email=' . urlencode($user->email));
                $unsubscribeRoute = url('/unsubscribe/'.base64_encode($request->email));
                mail_send(
                    38,
                    [
                        '#resetUrl#',
                        '#unsubscribeRoute#',
                    ],
                    [
                        $resetUrl,
                        $unsubscribeRoute
                    ],
                    $request->email
                );
                
                return back()->with('status', __('Custom password reset link sent!'));
            } else {
                return back()->withErrors(['email' => __('If the email ID exists, then reset password link has been sent.')]);
            }
        // } else {
        //     return back()->withInput($request->only('email'))
        //                 ->withErrors(['email' => __($status)]);
        // }

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
}
