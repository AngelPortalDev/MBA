<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {

        $checkIp =  block_ipaddress();
        if($checkIp == TRUE){
            abort(403, 'Access denied. Your IP address has been blocked.');
        }
        $this->ensureIsNotRateLimited();

        $credentials = $this->only('email', 'password');

        $credentials['is_active'] = "Active"; // Adjust as per your field name and logic
        
        $credentials['is_deleted'] = "No"; // Adjust as per your field name and logic


        // $user = User::where('email', $credentials['email'])
        //     ->where('is_active', 'Active')
        //     ->where('is_deleted', 'No')
        //     ->whereNotNull('email_verified_at')
        //     ->first();

        // if (! Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $this->boolean('remember'))) {
        if ((!Auth::attempt($credentials, $this->boolean('remember')))) {

            // if ($credentials['is_active'] == "") {
            //     return redirect()->back()->withErrors(['error' => 'Your account has already been used for a one-time login.']);
            // }
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }
}