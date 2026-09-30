<?php
session_set_cookie_params(['httponly'=>true,'secure'=>!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off','samesite'=>'Lax','path'=>url()]);
session_start();
header('Cache-Control: no-store');
$_SESSION['csrf'] ??= bin2hex(random_bytes(32));
$queryType = is_string($_GET['type'] ?? null) ? $_GET['type'] : 'service';
$inquiryType = posted('inquiry_type', $page[2]==='service' ? 'service' : $queryType);
if (!in_array($inquiryType,['service','course','general'],true)) $inquiryType='service';
$queryTopic = is_string($_GET['topic'] ?? null) ? $_GET['topic'] : '';
$topic = posted('topic',$page[2]==='service' ? $slug : $queryTopic);
$pricingMessage = '';
$queryPlan = is_string($_GET['plan'] ?? null) ? $_GET['plan'] : '';
if ($inquiryType === 'service' && isset($pricingPlans[$queryPlan]) && $pricingPlans[$queryPlan]['topic'] === $topic) {
 $selectedPlan = $pricingPlans[$queryPlan];
 $platformLabel = $pricingGroups[$selectedPlan['platform']]['title'];
 $pricingMessage = 'I would like a quote for '.$platformLabel.' - '.$selectedPlan['name'].' (starting from PKR '.number_format($selectedPlan['price']).'). Please confirm the scope and final price.';
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

$statusCode=422; $success=false;
$name=posted('name'); $email=posted('email'); $phone=posted('phone'); $message=posted('message'); $budget=posted('budget'); $experience=posted('experience');
$requestedType=posted('inquiry_type');
$validExperiences=['Just getting started','Some experience','Working with this already'];
if (!hash_equals($_SESSION['csrf'],posted('csrf'))) {
 $formMessage='Your form session expired. Refresh the page and try again.';
} elseif (posted('website')!=='') {
 $formMessage='Your inquiry could not be accepted. Please email us directly.';
} elseif (!in_array($requestedType,['service','course','general'],true)) {
 $formMessage='Choose a valid inquiry type.';
} elseif (strlen($name)<2 || strlen($name)>100 || preg_match('/[\r\n]/',$name) || !filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($email)>254) {
 $formMessage='Enter your name (2–100 characters) and a valid email address.';
} elseif (strlen($message)<10 || strlen($message)>5000 || strlen($phone)>40 || strlen($budget)>100) {
 $formMessage='Write a message between 10 and 5,000 characters. Keep phone and budget details brief.';
} elseif ($inquiryType==='service' && !isset($services[$topic])) {
 $formMessage='Choose the service you are interested in.';
} elseif ($inquiryType==='course' && (!isset($courses[$topic]) || !in_array($experience,$validExperiences,true))) {
 $formMessage='Choose a course and your experience level.';
} elseif (time()-(int)($_SESSION['last_attempt'] ?? 0)<30) {
 $statusCode=429; $formMessage='Please wait 30 seconds before trying again.';
} elseif (!env('SMTP_USERNAME') || !env('SMTP_PASSWORD') || !env('RECAPTCHA_SITE_KEY') || !env('RECAPTCHA_SECRET_KEY')) {
 $statusCode=503; $formMessage='The form is temporarily unavailable. Please email '.$contactEmail.' directly.';
} else {
 $_SESSION['last_attempt']=time();
 require __DIR__.'/recaptcha.php';
 $verified=verifyRecaptchaLegacy(env('RECAPTCHA_SECRET_KEY'),posted('recaptcha_token'),env('RECAPTCHA_ACTION','contact_submit'),(float)env('RECAPTCHA_MIN_SCORE','0.5'));
 if (!$verified['success']) {
  $formMessage='Spam verification could not be completed. Try again, or email us directly.';
 } else {
  require_once __DIR__.'/mailer.php';
  try {
   $mail=configuredMailer();
   $mail->addReplyTo($email,$name);
   $topicName=$inquiryType==='course' ? $courses[$topic]['title'] : ($inquiryType==='service' ? $services[$topic][0] : 'General inquiry');
   $mail->Subject='Webostics '. $inquiryType .' inquiry: '.$topicName;
   $mail->isHTML(false);
   $mail->Body="Name: $name\nEmail: $email\nPhone/WhatsApp: $phone\nInquiry: $inquiryType\nTopic: $topicName\n";
   if ($inquiryType==='service') $mail->Body.="Budget: $budget\n";
   if ($inquiryType==='course') $mail->Body.="Experience: $experience\n";
   $mail->Body.="\nMessage:\n$message";
   $mail->send();
   $success=true; $statusCode=200; $formMessage='Thank you. Your inquiry has been sent. We’ll reply by email.'; $_POST=[];
  } catch (\Throwable $exception) {
   error_log('Webostics inquiry delivery failed: '.$exception->getMessage());
   $statusCode=503; $formMessage='Your inquiry could not be sent. Please try again later or email '.$contactEmail.'.';
  }
 }
}
$formStatus=$success ? 'success' : 'error';
if (str_contains($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json')) {
 http_response_code($statusCode); header('Content-Type: application/json; charset=utf-8');
 echo json_encode(['success'=>$success,'message'=>$formMessage]); exit;
}
http_response_code($statusCode);
