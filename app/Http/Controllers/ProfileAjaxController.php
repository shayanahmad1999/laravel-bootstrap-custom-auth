<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileAjaxController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required','string','max:100'],
            'last_name'  => ['required','string','max:100'],
            'email'      => ['required','email','unique:users,email,'.$request->user()->id],
            'bio'        => ['nullable','string','max:1000'],
        ]);

        $request->user()->update([
            'name'  => $data['first_name'].' '.$data['last_name'],
            'email' => $data['email'],
            'bio'   => $data['bio'] ?? null,
        ]);

        return response()->json(['ok' => true, 'message' => 'Profile updated.']);
    }

    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => ['required','string'],
            'new_password'     => ['required','string', Password::min(6)],
        ]);

        if (! Hash::check($data['current_password'], $request->user()->password)) {
            return response()->json(['ok' => false, 'errors' => ['current_password' => ['Current password is incorrect']]], 422);
        }

        $request->user()->forceFill(['password' => bcrypt($data['new_password'])])->save();

        return response()->json(['ok' => true, 'message' => 'Password changed.']);
    }

    public function savePreferences(Request $request)
    {
        $data = $request->validate([
            'pref_email' => ['nullable','boolean'],
            'pref_sms'   => ['nullable','boolean'],
            'theme'      => ['required','in:light,dark,auto'],
            'primary_color' => ['nullable','string','regex:/^#[0-9a-f]{6}$/i'],
        ]);

        $prefs = [
            'email' => (bool) ($data['pref_email'] ?? false),
            'sms'   => (bool) ($data['pref_sms'] ?? false),
            'theme' => $data['theme'],
            'primary_color' => $data['primary_color'] ?? '#6f42c1',
        ];
        
        $request->user()->update(['preferences' => $prefs]);

        return response()->json(['ok' => true, 'message' => 'Preferences saved.']);
    }
}
