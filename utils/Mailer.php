<?php
use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    public static function sendTicket(string $to, string $pdfPath)
    {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'rachdos76@gmail.com';
        $mail->Password = 'qhwfixjzzlllrwun';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('rachdos76@gmail.com', 'BuyMatch');
        $mail->addAddress($to);

        $mail->Subject = 'Votre billet de match';
        $mail->Body = 'Veuillez trouver votre billet en pièce jointe.';
        $mail->addAttachment($pdfPath);

        $mail->send();
    }
}
