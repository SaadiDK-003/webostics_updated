# Mail readiness for the live host

## Status

PHPMailer was upgraded from 7.0.2 to 7.1.1 on 28 September 2026, matching the latest official release at https://github.com/PHPMailer/PHPMailer/releases/tag/v7.1.1. composer.json requires ^7.1.1 and composer.lock/vendor are updated. Composer reported no security vulnerability advisories; platform requirements passed. Offline MIME generation passed for service, course and general inquiries on the new version, and the contact page returned HTTP 200. No delivery test was sent during this update.

Composer used an isolated configuration and a temporary bundle of Windows' already trusted public certificates to handle local certificate interception. This temporary file under storage is not used by the application or production SMTP, and storage must not be shipped with a deployment. The original Composer files are backed up under storage/dependency-backup.

The existing .env credentials and recipient settings are preserved. Service, course and general inquiries use the same PHPMailer SMTP configuration. The sender comes from SMTP_FROM_EMAIL (falling back to SMTP_USERNAME); the visitor's address is used for Reply-To. SMTP authentication is enabled, port 587 uses STARTTLS, and port 465 uses implicit TLS. Verification of the peer certificate and hostname remains enabled. Debug output is disabled.

By default, mail uses the live host's maintained PHP/OpenSSL trust store. There is no local Avast certificate workaround in the application. SMTP_CA_FILE is optional, only for a host that explicitly needs a custom maintained CA bundle; an unreadable configured path fails clearly. The Mozilla bundle downloaded for diagnosis is not automatically selected.

The local test failed before authentication because Avast Web/Mail Shield intercepted the SMTP TLS certificate. It did not prove the Gmail credentials are invalid. A separate automated browser test was rejected by reCAPTCHA's low score. Neither protection was bypassed.

## When deployed

1. Keep the existing SMTP and contact recipient settings in the server's private .env. Upload vendor/ or install the locked Composer dependencies.
2. Ensure PHP OpenSSL is enabled, the host has a maintained certificate store, and outbound connections to the configured SMTP port are permitted.
3. Authorize the actual live hostname in the existing reCAPTCHA configuration. Keep the configured site/secret keys, action and score threshold consistent. If RECAPTCHA_HOSTNAME is explicitly set, it must match that hostname.
4. Submit one service inquiry, one course inquiry and one general inquiry from a normal browser. Confirm the success response, inbox receipt and that Reply-To points to the visitor.
5. If a live submission fails, check the server log for the PHPMailer/reCAPTCHA error. Do not expose credentials or debugging output to visitors.

Per the user's instruction, further delivery testing is deferred to the live site. Offline configuration and MIME-generation checks do not contact Gmail, authenticate credentials, send email or prove inbox delivery.
