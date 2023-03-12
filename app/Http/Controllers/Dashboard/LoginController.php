<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\DashboardLoginRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function getLogin()
    {
        return view('dashboard.auth.login');
    }

    /**
     * @param DashboardLoginRequest $request
     * @return RedirectResponse
     */
    public function login(DashboardLoginRequest $request)
    {
        $remember_me = $request->has('remember_me');

        if (auth()->guard('dashboard')
            ->attempt([
                'email'         => $request->validated('email'),
                'password'      => $request->validated('password')
            ], $remember_me)) {
            toastr()->success(__('auth.success'));
            return redirect()->route('dashboard.index');
        }
        toastr()->error(trans('auth.failed'));
        return redirect()->back();
    }

    /**
     * @return RedirectResponse
     */
    public function logout()
    {
        Auth::guard('dashboard')->logout();
        Auth::logout();
        toastr()->success(__('auth.logout'));
        return redirect()->route('dashboard.login');
    }
}
