<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password'=>['required','current_password'],
            'password' => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/', function ($attribute, $value, $fail) use ($request) {
                $user = User::where('email', $request->user()->email)->first();
                if ($user && Hash::check($value, $user->password)) {
                    $fail('The new password cannot be the same as the old password.');
                }
            },],
            // 'password_confirmation' => ['required', Password::defaults(), 'confirmed'],
            'password_confirmation' => ['required','same:password'],
        ],[
            'current_password.required' => 'Please enter your old password.',
            'password.required' => 'Please enter a valid new password.',
            'password_confirmation.required' => 'The passwords you entered do not match.',

        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}