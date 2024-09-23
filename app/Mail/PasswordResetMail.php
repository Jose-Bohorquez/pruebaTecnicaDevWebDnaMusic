<?php

namespace App\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PasswordResetMail
{
    public function send($email, $token)
    {
        $mail = new PHPMailer(true);
        try {
            // Configuración del servidor
            $mail->isSMTP();
            $mail->Host = 'smtp.hostinger.com'; // Cambiado a Hostinger
            $mail->SMTPAuth = true;
            $mail->Username = 'admin@dev-and-test.online'; // Tu correo completo
            $mail->Password = 'abc.123.CBA.321.'; // La contraseña de tu correo
            $mail->SMTPSecure = 'tls'; // Usa 'ssl' si cambias a puerto 465
            $mail->Port = 587; // O 465 si usas SSL
        
            // Remitente y destinatario
            $mail->setFrom('admin@dev-and-test.online', 'Tu Nombre');
            $mail->addAddress($email); // Destinatario
        
            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Restablecimiento de Contraseña';
            $mail->Body    = 'Haz clic en el siguiente enlace para restablecer tu contraseña: <a href="' . url('/password/reset/' . $token) . '">Restablecer Contraseña</a>';
        
            $mail->send();
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
        
    }
}
