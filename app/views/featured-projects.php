<section class="section section-tinted" id="work"><div class="container">
  <div class="heading-row"><?php sectionTitle('SELECTED WORK / SAAD AHMAD', 'Ideas, brought into the world.', 'A selection from Saad’s website and e-commerce portfolio.'); ?><a class="text-link" href="<?= e(url('projects')) ?>">Explore all projects ↗</a></div>
  <div class="project-grid"><?php foreach (array_slice(array_filter($projects, fn(array $project): bool => $project['featured']), 0, 3) as $project) projectCard($project); ?></div>
  <p class="project-footnote">Work by Saad Ahmad. Linked websites may have changed since completion.</p>
</div></section>
