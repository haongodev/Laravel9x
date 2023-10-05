<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\AdminLoginRequest;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('admin.auth.login');
    }

    public function store(AdminLoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        return redirect(route('admin.index'));
    }
    public function logout(Request $request)
    {

        Auth::guard('admin')->logout();

      //  $request->session()->invalidate();

     //   $request->session()->regenerateToken();

        return redirect(route('admin.login'));

    }
}
