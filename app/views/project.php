<?php
$project = array_values(array_filter($projects, fn(array $item): bool => $item['slug'] === $slug))[0];
pageHero('SELECTED WORK / SHOPIFY', 'Co-Museum: from Figma to Shopify.', 'Full website development by Saad Ahmad, translating a Figma design into a Shopify storefront using Liquid.');
?>
<article class="container page-content">
  <figure class="project-showcase">
    <img src="<?= e(url($project['image'])) ?>" alt="Co-Museum storefront with its navigation, editorial imagery and product presentation" width="<?= (int)$project['imageWidth'] ?>" height="<?= (int)$project['imageHeight'] ?>" fetchpriority="high">
    <figcaption><?= e($project['imageCaption']) ?>. The current website may differ from the original delivery.</figcaption>
  </figure>
  <div class="content-grid">
    <div class="prose">
      <h2>The project</h2>
      <p>Co-Museum is a Shopify website in Saad Ahmad's portfolio. The work covered the full website development, with a Figma-to-Liquid implementation, reusable sections and responsive layouts.</p>
      <h2>Saad's contribution</h2>
      <p>Saad developed the complete website. The implementation translated the supplied design into Shopify's theme environment, bringing the page layouts and reusable sections together into a storefront.</p>
      <h2>Development focus</h2>
      <ul><li><strong>Figma to Shopify:</strong> translating the design into the storefront implementation.</li><li><strong>Liquid:</strong> building the theme's page structure and reusable sections.</li><li><strong>Responsive layout:</strong> adapting the presentation across screen sizes.</li></ul>
      <h2>Explore the website</h2>
      <p>Visit the current storefront to explore Co-Museum. As with any live project, content and features can change after the original work is delivered.</p>
      <a href="<?= e($project['url']) ?>" target="_blank" rel="noopener noreferrer">Visit Co-Museum (opens in a new tab)</a>
    </div>
    <aside class="sidebar" aria-label="Project details">
      <span class="eyebrow">WORK BY SAAD AHMAD</span><h2>Project details</h2>
      <dl class="project-facts"><dt>Role</dt><dd><?= e($project['role']) ?></dd><dt>Platform</dt><dd>Shopify</dd><dt>Implementation</dt><dd>Figma to Liquid</dd></dl>
      <h2>Planning a Shopify build?</h2><p>Share your designs, requirements and the store you want to create.</p>
      <?php button('Discuss your project','contact?type=service&topic=shopify'); ?>
      <p class="side-note"><a class="text-link" href="<?= e(url('services/shopify')) ?>">Explore Shopify development &#8599;</a></p>
      <a class="text-link" href="<?= e(url('projects')) ?>">View all projects &#8599;</a>
    </aside>
  </div>
</article>
