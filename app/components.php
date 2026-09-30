<?php
function icon(string $name): string {
 $paths = [
 'code'=>'<path d="m8 7-5 5 5 5m8-10 5 5-5 5m-3-14-2 18"/>',
 'shop'=>'<path d="M4 9h16l-2-6H6L4 9Zm1 0v12h14V9M9 21v-7h6v7M4 9c0 4 4 4 4 0 0 4 4 4 4 0 0 4 4 4 4 0 0 4 4 4 4 0"/>',
 'layout'=>'<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M9 9v11"/>',
 'launch'=>'<path d="M14 4c3-2 6-1 6-1s1 3-1 6l-7 7-5-5 7-7ZM7 11l-4 1 4-6 6-1m-1 11-1 5 6-4 1-7M4 17l-1 4 4-1"/><circle cx="16" cy="7" r="1"/>',
 'spark'=>'<path d="m12 3 2.5 6.5L21 12l-6.5 2.5L12 21l-2.5-6.5L3 12l6.5-2.5L12 3ZM20 2v4m-2-2h4"/>',
 'bolt'=>'<path d="m13 2-9 12h7l-1 8 10-13h-8l1-7Z"/>',
 'tools'=>'<path d="m14 7 3 3 4-4a6 6 0 0 1-8 8l-7 7-3-3 7-7a6 6 0 0 1 8-8l-4 4Z"/>',
 'globe'=>'<circle cx="12" cy="12" r="9"/><ellipse cx="12" cy="12" rx="4" ry="9"/><path d="M3 12h18"/>',
 'link'=>'<path d="m9 15 6-6m-5-3 2-2a5 5 0 0 1 7 7l-2 2m-3 5-2 2a5 5 0 0 1-7-7l2-2"/>',
 'flow'=>'<rect x="8" y="2" width="8" height="5" rx="1"/><rect x="2" y="17" width="7" height="5" rx="1"/><rect x="15" y="17" width="7" height="5" rx="1"/><path d="M12 7v5H5v5m7-5h7v5"/>',
 'book'=>'<path d="M12 5v16M12 5C8 2 4 3 2 4v15c3-1 6-1 10 2 4-3 7-3 10-2V4c-3-1-6-2-10 1Z"/>',
 ];
 return '<svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'.($paths[$name] ?? $paths['code']).'</svg>';
}
function button(string $label,string $path,string $class='primary'): void { ?><a class="button <?= e($class) ?>" href="<?= e(url($path)) ?>"><?= e($label) ?><span aria-hidden="true">↗</span></a><?php }
function sectionTitle(string $eyebrow,string $title,string $description=''): void { ?><div class="section-heading"><span class="eyebrow"><?= e($eyebrow) ?></span><h2><?= e($title) ?></h2><?php if ($description): ?><p><?= e($description) ?></p><?php endif ?></div><?php }
function serviceCard(string $slug,array $service): void { ?><a class="service-card" href="<?= e(url('services/'.$slug)) ?>"><span class="icon-box"><?= icon($service[6]) ?></span><h3><?= e($service[0]) ?></h3><p><?= e($service[1]) ?></p><span class="text-link">Explore service <span aria-hidden="true">↗</span></span></a><?php }
function courseCard(array $course): void { global $categories; ?><article class="course-card" data-course data-category="<?= e($course['category']) ?>" data-title="<?= e(strtolower($course['title'])) ?>"><a class="course-art art-<?= e($course['category']) ?>" href="<?= e(url('courses/'.$course['slug'])) ?>" tabindex="-1" aria-hidden="true"><span class="art-label">WEBOSTICS / LEARNING</span><span class="art-symbol"><?= $course['category']==='ai' ? '✳' : ($course['category']==='devops' || $course['category']==='hosting-deployment' ? '↗' : '&lt;/&gt;') ?></span><span class="art-caption"><?= e($categories[$course['category']]) ?><span>01 — ∞</span></span></a><div class="course-body"><div class="card-meta"><span><?= e($course['level']) ?></span><span class="status">Planned</span></div><h3><a href="<?= e(url('courses/'.$course['slug'])) ?>"><?= e($course['title']) ?></a></h3><p><?= e($course['description']) ?></p><a class="text-link" href="<?= e(url('courses/'.$course['slug'])) ?>">View course outline <span aria-hidden="true">↗</span></a></div></article><?php }
function cta(): void { ?><section class="container closing-cta"><div><span class="eyebrow">YOUR NEXT CHAPTER</span><h2>Have an idea?<br>Let’s make it happen.</h2></div><div><p>Get help building it. Or learn how to build it yourself.</p><div class="button-row"><?php button('Hire Webostics','contact?type=service'); button('Start learning','courses','light'); ?></div></div></section><?php }
function faq(array $items): void { ?><div class="faq"><?php foreach ($items as [$q,$a]): ?><details><summary><?= e($q) ?><span aria-hidden="true">+</span></summary><p><?= e($a) ?></p></details><?php endforeach ?></div><?php }
function pageHero(string $eyebrow,string $title,string $description): void { ?><header class="page-hero container"><span class="eyebrow"><?= e($eyebrow) ?></span><h1><?= e($title) ?></h1><p><?= e($description) ?></p></header><?php }
function projectCard(array $project): void {
    $hasImage = !empty($project['image']) && !empty($project['imageWidth']) && !empty($project['imageHeight']);
    ?>
    <article class="project-card" id="project-<?= e($project['slug']) ?>">
      <?php if ($hasImage): ?>
        <div class="project-image"><img src="<?= e(url($project['image'])) ?>" alt="<?= e($project['title']) ?> website preview" width="<?= (int)$project['imageWidth'] ?>" height="<?= (int)$project['imageHeight'] ?>" loading="lazy" decoding="async"></div>
      <?php else: ?>
        <div class="project-art project-art-<?= e($project['category']) ?>" aria-hidden="true"><span class="project-art-label"><?= e($project['technology'][0]) ?></span><span class="project-monogram"><?= e($project['monogram']) ?></span><span class="project-art-footer">SELECTED WORK <span>↗</span></span></div>
      <?php endif ?>
      <div class="project-body"><?php if (!empty($project['imageCaption'])): ?><p class="project-capture-note"><?= e($project['imageCaption']) ?></p><?php endif ?><span class="project-attribution">Work by <?= e($project['attribution']) ?></span><h3><?= e($project['title']) ?></h3><p><?= e($project['summary']) ?></p>
        <?php if (!empty($project['problem'])): ?><details class="project-details"><summary>Project context</summary><p><?= e($project['problem']) ?></p><?php if (!empty($project['solution'])): ?><p><?= e($project['solution']) ?></p><?php endif ?><?php if (!empty($project['results'])): ?><p><?= e($project['results']) ?></p><?php endif ?></details><?php endif ?>
        <div class="tags"><?php foreach ($project['technology'] as $tech): ?><span><?= e($tech) ?></span><?php endforeach ?></div>
        <?php if (!empty($project['detailPage'])): ?><a class="text-link" href="<?= e(url($project['detailPage'])) ?>" aria-label="View project: <?= e($project['title']) ?>">View project <span aria-hidden="true">&#8599;</span></a><?php endif ?>
        <?php if (!empty($project['url']) && preg_match('~^https?://~i',$project['url'])): ?><a class="text-link" href="<?= e($project['url']) ?>" target="_blank" rel="noopener noreferrer" aria-label="Visit website: <?= e($project['title']) ?> (opens in a new tab)">Visit website <span aria-hidden="true">↗</span></a><?php endif ?>
      </div>
    </article>
    <?php
}
