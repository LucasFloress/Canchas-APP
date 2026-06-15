<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de login.
     * Solo devuelve la vista — nada más que hacer acá.
     */
    public function showLoginForm(): View
    {
        return view('admin.auth.login');
    }

    //---------------------------------
    //  Procesa el intento de login.
    //---------------------------------
    public function login(Request $request): RedirectResponse
    {
        // 1️⃣ VALIDACIÓN
        // Validamos antes de tocar Auth. Si falla, Laravel
        // redirige solo con los errores — no llega al attempt().
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // 2️⃣ INTENTO DE AUTENTICACIÓN
        // attempt() hace internamente:
        //   - busca el admin por email en la tabla admins
        //   - compara el password con Hash::check()
        //   - si coincide, inicia la sesión
        //
        // El segundo parámetro es el "remember me":
        // $request->boolean() devuelve false si el checkbox
        // no viene en el request (no lanza error).
        $remember = $request->boolean('remember');

        if (Auth::guard('admin')->attempt($credentials, $remember)) {

            // 3️⃣ REGENERAR SESIÓN (previene session fixation)
            $request->session()->regenerate();

            // 4️⃣ REDIRIGIR AL DASHBOARD
            // intended() redirige a la URL que el admin
            // intentaba visitar antes de ser mandado al login.
            // Si venía directo al login, va al dashboard.
            return redirect()->intended(route('admin.dashboard'));
        }

        // 5️⃣ FALLO DE AUTENTICACIÓN
        // withErrors() pone el error en el bag de validación
        // para mostrarlo en la vista con @error('email').
        // 'estas credenciales no coinciden' es el string
        // estándar de Laravel — ya está traducido si usás
        // el paquete de idiomas.
        return back()->withErrors([
            'email' => __('auth.failed'),
        ])->onlyInput('email'); // devuelve el email pero NO la contraseña
    }

    /**
     * Cierra la sesión del admin.
     */
    public function logout(Request $request): RedirectResponse
    {
        // Cierra la sesión del guard 'admin' específicamente.
        // Sin el guard, cerraría la sesión del usuario web.
        Auth::guard('admin')->logout();

        // Invalida la sesión actual y regenera el token CSRF.
        // Ambas líneas son necesarias para un logout seguro.
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}