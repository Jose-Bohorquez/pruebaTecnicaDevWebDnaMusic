<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Mail\PasswordResetMail;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    // Sobrescribimos el método para enviar el enlace de restablecimiento
    protected function sendResetLinkEmail(Request $request)
    {
        // Validamos el correo
        $this->validate($request, ['email' => 'required|email']);

        // Intentamos enviar el enlace de restablecimiento
        $response = Password::sendResetLink(
            $request->only('email')
        );

        if ($response == Password::RESET_LINK_SENT) {
            // Obtener el usuario para crear el token
            $user = \App\Models\User::where('email', $request->input('email'))->first();

            if ($user) {
                // Crear un token y enviar el correo
                $token = app('auth.password.broker')->createToken($user);
                $emailService = new PasswordResetMail();
                $emailService->send($user->email, $token);
            }

            return back()->with('status', trans($response));
        }

        return back()->withErrors(['email' => trans($response)]);
    }
}
