<?php
use PHPMailer\PHPMailer\PHPMailer;

function configuredMailer(): PHPMailer
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = env('SMTP_HOST', 'smtp.gmail.com');
    $mail->Port = (int) env('SMTP_PORT', '587');
    $mail->SMTPAuth = true;
    $mail->Username = env('SMTP_USERNAME');
    $mail->Password = env('SMTP_PASSWORD');
    $mail->SMTPSecure = $mail->Port === 465 ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
    $mail->CharSet = 'UTF-8';
    $mail->Timeout = 20;
    $mail->SMTPDebug = 0;
    // Use the hosting provider's maintained certificate store by default.
    $mail->SMTPOptions = ['ssl'=>['verify_peer'=>true,'verify_peer_name'=>true,'allow_self_signed'=>false]];
    $caFile = env('SMTP_CA_FILE');
    if ($caFile !== '') {
        if (!is_file($caFile) || !is_readable($caFile)) {
            throw new RuntimeException('The configured SMTP certificate bundle is not readable.');
        }
        $mail->SMTPOptions['ssl']['cafile'] = $caFile;
    }
    $mail->setFrom(env('SMTP_FROM_EMAIL', env('SMTP_USERNAME')), env('SMTP_FROM_NAME', 'Webostics'));
    $mail->addAddress(env('CONTACT_RECEIVER_EMAIL', 'dev.saadahmad@gmail.com'), env('CONTACT_RECEIVER_NAME', 'Saad Ahmad'));
    return $mail;
}
