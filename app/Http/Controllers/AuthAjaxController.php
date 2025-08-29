<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthAjaxController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required','string','min:6'],
            'remember' => ['nullable','boolean'],
        ]);

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $request->boolean('remember'))) {
            $request->session()->regenerate();
            return response()->json(['ok' => true, 'message' => 'Logged in successfully.']);
        }

        throw ValidationException::withMessages([
            'email' => ['These credentials do not match our records.'],
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required','string','max:100'],
            'last_name'  => ['required','string','max:100'],
            'email'      => ['required','email','unique:users,email'],
            'password'   => ['required','string','min:6'],
            'terms'      => ['accepted'],
        ]);

        $user = User::create([
            'name'     => $data['first_name'].' '.$data['last_name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        event(new Registered($user));
        Auth::login($user);

        return response()->json(['ok' => true, 'message' => 'Account created. Verification email sent (if enabled).']);
    }

    public function forgotPassword(Request $request)
    {
        $data = $request->validate(['email' => ['required','email']]);
        $status = Password::sendResetLink($data);
        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['ok' => true, 'message' => __($status)]);
        }
        return response()->json(['ok' => false, 'message' => __($status)], 400);
    }

    public function resetPassword(Request $request)
    {
        $data = $request->validate([
            'token'    => ['required','string'],
            'email'    => ['required','email'],
            'password' => ['required','string','min:6','confirmed'],
        ]);

        $status = Password::reset($data, function ($user, $password) {
            $user->forceFill(['password' => bcrypt($password)])->save();
        });

        if ($status === Password::PASSWORD_RESET) {
            return response()->json(['ok' => true, 'message' => __($status)]);
        }
        return response()->json(['ok' => false, 'message' => __($status)], 400);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['ok' => true, 'message' => 'Logged out.']);
    }
}
