<?php
pageHero('SELECTED WORK / SAAD AHMAD', 'Different businesses. Thoughtful builds.', 'Explore website and e-commerce work from Saad Ahmad’s portfolio, across Shopify, WordPress, Wix and Squarespace.');
$requestedPlatform = is_string($_GET['platform'] ?? null) ? $_GET['platform'] : 'all';
$platform = isset($projectCategories[$requestedPlatform]) ? $requestedPlatform : 'all';
$visibleProjects = array_filter($projects, fn(array $project): bool => $platform === 'all' || $project['category'] === $platform);
?>
<section class="container page-content">
<?php if ($projects): ?>
  <div class="project-context"><p><strong>Work by Saad Ahmad.</strong> These projects are presented from Saad’s personal portfolio. Linked websites may have changed since the work was completed.</p><a class="text-link" href="<?= e(url('contact?type=service')) ?>">Discuss a similar project ↗</a></div>
  <nav class="filters project-filters" aria-label="Filter projects by platform">
    <a class="filter-button <?= $platform === 'all' ? 'is-selected' : '' ?>" href="<?= e(url('projects')) ?>" <?= $platform === 'all' ? 'aria-current="page"' : '' ?>>All work</a>
    <?php foreach ($projectCategories as $key => $label): ?>
      <a class="filter-button <?= $platform === $key ? 'is-selected' : '' ?>" href="<?= e(url('projects?platform=' . $key)) ?>" <?= $platform === $key ? 'aria-current="page"' : '' ?>><?= e($label) ?></a>
    <?php endforeach ?>
  </nav>
  <p class="filter-status"><?= count($visibleProjects) ?> project<?= count($visibleProjects) === 1 ? '' : 's' ?><?= $platform !== 'all' ? ' · ' . e($projectCategories[$platform]) : '' ?></p>
  <div class="project-grid"><?php foreach ($visibleProjects as $project) projectCard($project); ?></div>
<?php else: ?>
  <div class="empty-state"><h2>More work is on the way.</h2><p>Tell us about your project and ask about relevant experience.</p><?php button('Discuss your project', 'contact?type=service'); ?></div>
<?php endif ?>
</section>
<?php cta(); ?>
