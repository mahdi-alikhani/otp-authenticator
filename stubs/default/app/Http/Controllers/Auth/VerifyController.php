<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class VerifyController extends Controller
{
    /**
     * Display the verification  view
     */
    public function create()
    {
        return view('auth.verify');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required', 'max:6']
        ]);

        $phone = session()->get("code-" . $request->code);

        if (empty($phone)) {
            throw ValidationException::withMessages([
                'code' => __('Your verification code is invalid'),
            ]);
        }

        $user = User::where('phone', $phone)->first();

        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
