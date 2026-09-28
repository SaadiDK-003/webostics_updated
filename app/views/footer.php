</main>
<footer class="site-footer"><div class="container footer-grid">
<div class="footer-brand"><a class="brand" href="<?= e(url()) ?>"><img src="<?= e(url('assets/site/favicon.svg')) ?>" width="34" height="34" alt=""><span>webostics.</span></a><p>Build better. Learn faster.<br>Launch smarter.</p><a class="contact-email" href="mailto:<?= e($contactEmail) ?>"><?= e($contactEmail) ?></a></div>
<div><h2>Build</h2><a href="<?= e(url('services')) ?>">All services</a><a href="<?= e(url('services/shopify')) ?>">Shopify</a><a href="<?= e(url('services/wordpress')) ?>">WordPress</a><a href="<?= e(url('projects')) ?>">Projects</a></div>
<div><h2>Learn</h2><a href="<?= e(url('courses')) ?>">Course outlines</a><a href="<?= e(url('ai')) ?>">AI learning</a><a href="<?= e(url('devops')) ?>">DevOps & deployment</a><a href="<?= e(url('resources')) ?>">Free resources</a></div>
<div><h2>Connect</h2><a href="<?= e(url('about')) ?>">About Webostics</a><a href="<?= e(url('contact')) ?>">Contact</a><a href="<?= e($linkedin) ?>" rel="noopener noreferrer" target="_blank">Saad on LinkedIn ↗</a><a href="<?= e(url('privacy')) ?>">Privacy</a></div>
</div><div class="container footer-bottom"><span>© <?= date('Y') ?> Webostics. Build. Learn. Launch.</span><span>Made for the next thing you build.</span><a href="#home">Back to top ↑</a></div></footer>
</body></html>
