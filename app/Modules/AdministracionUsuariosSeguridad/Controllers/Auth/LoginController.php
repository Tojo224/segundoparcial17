<?php

namespace App\Modules\AdministracionUsuariosSeguridad\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Modules\AdministracionUsuariosSeguridad\Services\AuthService;

class LoginController extends Controller
{
    public function __construct(
        protected AuthService $auth
    ) {}

    public function showLoginForm()
    {
        return view('administracion_usuarios_seguridad.auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'correo' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (!$this->auth->attempt(
            $request->string('correo')->toString(),
            $request->string('password')->toString(),
            $request->boolean('remember')
        )) {
            return back()->withErrors(['correo' => 'Credenciales inválidas o usuario inactivo.'])->withInput();
        }

        $request->session()->regenerate();

        $user = Auth::user();
        $target = $this->auth->redirectPathFor($user);

        return redirect()->intended($target);
    }

    public function logout(Request $request)
    {
        $this->auth->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
