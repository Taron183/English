<?php

namespace App\Http\Controllers\Admin\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    protected $redirectTo = '/admin';

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLogin()
    {
        return view('admin.auth.login');
    }


    public function authenticate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "email" => 'required|email',
            'password' => 'required|alphaNum|min:6'
            ]);

        if ($validator->fails()) {
            return redirect('admin/login')
                ->withErrors($validator)
                ->withInput();
        }

        $array = $request->all();

        $remember = $request->has('remember');

        if (Auth::attempt(
            [
                'email' => $array['email'],
                'password' => $array['password'],
            ], $remember)) {

            return redirect()->intended($this->redirectTo);
        }

        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['email' => 'These credentials do not match our records.']);
    }
}
