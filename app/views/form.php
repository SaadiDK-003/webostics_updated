<form class="contact-form" method="post" action="<?= e(url($route)) ?>#inquiry" data-contact-form data-site-key="<?= e(env('RECAPTCHA_SITE_KEY')) ?>" data-action="<?= e(env('RECAPTCHA_ACTION','contact_submit')) ?>">
<input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
<input type="hidden" name="recaptcha_token" value="">
<label class="hp-field" aria-hidden="true">Leave this field empty<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
<p class="form-note <?= e($formStatus) ?>" role="status" tabindex="-1" data-form-note><?= e($formMessage) ?></p>
<div class="form-grid">
<label class="full"><span>I’m getting in touch about</span><select name="inquiry_type" data-inquiry-type><?php foreach (['service'=>'A project / hire Webostics','course'=>'A planned course','general'=>'A general question'] as $value=>$label): ?><option value="<?= e($value) ?>" <?= $inquiryType===$value ? 'selected' : '' ?>><?= e($label) ?></option><?php endforeach ?></select></label>
<label><span>Your name</span><input name="name" autocomplete="name" required minlength="2" maxlength="100" value="<?= e(posted('name')) ?>" placeholder="Your name"></label>
<label><span>Email address</span><input name="email" type="email" autocomplete="email" required maxlength="254" value="<?= e(posted('email')) ?>" placeholder="you@example.com"></label>
<label class="full"><span>Phone / WhatsApp <small>(optional)</small></span><input type="tel" name="phone" autocomplete="tel" maxlength="40" value="<?= e(posted('phone')) ?>" placeholder="Include your country code"></label>
<label class="full" data-topic-field><span>Service or course of interest</span><select name="topic"><option value="">Choose a topic</option><optgroup label="Services" data-topic-group="service"><?php foreach ($services as $key=>$serviceOption): ?><option value="<?= e($key) ?>" <?= $topic===$key ? 'selected' : '' ?>><?= e($serviceOption[0]) ?></option><?php endforeach ?></optgroup><optgroup label="Planned courses" data-topic-group="course"><?php foreach ($courses as $key=>$courseOption): ?><option value="<?= e($key) ?>" <?= $topic===$key ? 'selected' : '' ?>><?= e($courseOption['title']) ?></option><?php endforeach ?></optgroup></select></label>
<label class="full" data-for-type="service"><span>Budget range <small>(optional)</small></span><input name="budget" maxlength="100" value="<?= e(posted('budget')) ?>" placeholder="Your range and currency, if known"></label>
<label class="full" data-for-type="course"><span>Your experience level <small>(for course inquiries)</small></span><select name="experience"><option value="">Choose your experience</option><?php foreach (['Just getting started','Some experience','Working with this already'] as $level): ?><option <?= posted('experience')===$level ? 'selected' : '' ?>><?= e($level) ?></option><?php endforeach ?></select></label>
<label class="full"><span>Your message</span><textarea name="message" rows="5" required minlength="10" maxlength="5000" placeholder="What would you like to build, improve, or learn?"><?= e(posted('message', $pricingMessage ?? '')) ?></textarea></label>
</div>
<p class="form-help">Your details are used to respond to this inquiry. Read our <a href="<?= e(url('privacy')) ?>">privacy information</a>. This form uses Google reCAPTCHA; Google’s <a href="https://policies.google.com/privacy">Privacy Policy</a> and <a href="https://policies.google.com/terms">Terms of Service</a> apply.</p>
<noscript><p class="form-help">Spam verification requires JavaScript. You can also <a href="mailto:<?= e($contactEmail) ?>">email <?= e($contactEmail) ?></a> directly.</p></noscript>
<button type="submit" class="button primary form-button">Send inquiry <span aria-hidden="true">↗</span></button>
</form>
<script src="<?= e(asset('js/contact.js')) ?>" defer></script>
