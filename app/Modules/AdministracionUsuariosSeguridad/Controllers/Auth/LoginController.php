<?php

namespace App\Modules\AdministracionUsuariosSeguridad\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Modules\AdministracionUsuariosSeguridad\Services\AuthService;
use App\Modules\AdministracionUsuariosSeguridad\Services\BitacoraService;

class LoginController extends Controller
{
    public function __construct(
        protected AuthService $auth
    ) {}

    /**
     * Mostrar formulario de inicio de sesión
     */
    public function showLoginForm()
    {
        return view('administracion_usuarios_seguridad.auth.login');
    }

    /**
     * Iniciar sesión de usuario
     */
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

    /**
     * Cerrar sesión del usuario y registrar en bitácora
     */
    public function logout(Request $request)
    {
        $bitacora = app(BitacoraService::class);
        $usuario = Auth::user();

        if ($usuario) {
            // Registrar acción de cierre de sesión
            $bitacora->registrar("{$usuario->nombre} cerró sesión en el sistema", $usuario->id_usuario);
        }

        // Cerrar sesión y limpiar sesión
        $this->auth->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
