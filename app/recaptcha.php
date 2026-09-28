<?php
function verifyRecaptchaLegacy(
  string $secretKey,
  string $token,
  string $expectedAction,
  float $minScore
): array {
  if ($secretKey === '' || $token === '') {
    return [
      'success' => false,
      'message' => 'reCAPTCHA is not configured correctly.',
    ];
  }

  $payload = http_build_query([
    'secret' => $secretKey,
    'response' => $token,
    'remoteip' => $_SERVER['REMOTE_ADDR'] ?? '',
  ]);

  $verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
  $response = false;

  if (function_exists('curl_init')) {
    $ch = curl_init($verifyUrl);

    curl_setopt_array($ch, [
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => $payload,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT => 10,
      CURLOPT_HTTPHEADER => [
        'Content-Type: application/x-www-form-urlencoded',
      ],
    ]);

    $response = curl_exec($ch);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($response === false) {
      error_log('reCAPTCHA cURL error: ' . $curlError);

      return [
        'success' => false,
        'message' => 'Could not verify reCAPTCHA. Please try again.',
      ];
    }
  } else {
    $context = stream_context_create([
      'http' => [
        'method' => 'POST',
        'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
        'content' => $payload,
        'timeout' => 10,
      ],
    ]);

    $response = file_get_contents($verifyUrl, false, $context);
  }

  if (!$response) {
    return [
      'success' => false,
      'message' => 'Could not verify reCAPTCHA. Please try again.',
    ];
  }

  $data = json_decode($response, true);

  if (!is_array($data) || empty($data['success'])) {
    error_log('reCAPTCHA failed: ' . $response);

    return [
      'success' => false,
      'message' => 'reCAPTCHA verification failed. Please try again.',
    ];
  }

  $action = (string)($data['action'] ?? '');

  if ($action !== $expectedAction) {
    error_log('reCAPTCHA action mismatch. Expected: ' . $expectedAction . ', Got: ' . $action);

    return [
      'success' => false,
      'message' => 'reCAPTCHA verification failed. Please try again.',
    ];
  }

  if (!isset($data['score']) || !is_numeric($data['score'])) {
    return ['success' => false, 'message' => 'reCAPTCHA score missing.'];
  }

  $expectedHostname = env('RECAPTCHA_HOSTNAME', strtolower(explode(':', $_SERVER['HTTP_HOST'] ?? '')[0]));
  if (strtolower((string)($data['hostname'] ?? '')) !== $expectedHostname) {
    return ['success' => false, 'message' => 'reCAPTCHA hostname mismatch.'];
  }

  if (isset($data['score'])) {
    $score = (float)$data['score'];

    if ($score < $minScore) {
      error_log('reCAPTCHA low score: ' . $score);

      return [
        'success' => false,
        'message' => 'Your request could not be verified. Please try again.',
      ];
    }
  }

  return [
    'success' => true,
    'message' => 'reCAPTCHA verified.',
  ];
}
