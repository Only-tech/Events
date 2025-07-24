<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require __DIR__ . '/vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(strip_tags(trim($_POST["name"])));
    $email = htmlspecialchars(strip_tags(trim($_POST["email"]))); // L'email de l'utilisateur
    $message = htmlspecialchars(strip_tags(trim($_POST["message"])));

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.laposte.net';
        $mail->SMTPAuth = true;
        $mail->Username = 'cedrick...........@laposte.net';
        $mail->Password = '..............';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        //Pour éviter l'usurpation d'identité, je reste destinateur et destinataire 
        $mail->setFrom('cedrick.........@laposte.net', $name . 'eventribe');

        $mail->addAddress('cedrick..........@laposte.net');

        // La réponse au mail va à l'adresse email de l'utilisateur.
        $mail->addReplyTo($email, $name);

        // Contenu du mail
        $mail->isHTML(false);
        $mail->Subject = "eventribe - Nouveau message de $name";
        // email de l'utilisateur dans le corps du message
        $mail->Body    = "$name\n$email\n\n\n$message";

        $mail->send();
        header("Location: index.php?status=success#contactModal");
    } catch (Exception $e) {
        header("Location: index.php?status=error#contactModal");
    }
} else {
    header("Location: index.php");
}
exit;
