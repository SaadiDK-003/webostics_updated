<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($page[0]) ?></title>
<meta name="description" content="<?= e($page[1]) ?>">
<meta name="theme-color" content="#163d32">
<meta name="robots" content="<?= $noindex ? 'noindex, follow' : 'index, follow' ?>">
<link rel="canonical" href="<?= e(canonical($route)) ?>">
<meta property="og:type" content="<?= $page[2]==='resource' ? 'article' : 'website' ?>">
<meta property="og:site_name" content="Webostics">
<meta property="og:title" content="<?= e($page[0]) ?>">
<meta property="og:description" content="<?= e($page[1]) ?>">
<meta property="og:url" content="<?= e(canonical($route)) ?>">
<meta property="og:image" content="<?= e(canonical('assets/site/social.png')) ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="Webostics — Build better. Learn faster. Launch smarter.">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="<?= e(canonical('assets/site/social.png')) ?>">
<meta name="twitter:title" content="<?= e($page[0]) ?>">
<meta name="twitter:description" content="<?= e($page[1]) ?>">
<link rel="icon" type="image/svg+xml" href="<?= e(url('assets/site/favicon.svg')) ?>">
<link rel="preload" href="<?= e(url('assets/fonts/space-grotesk-latin.woff2')) ?>" as="font" type="font/woff2" crossorigin>
<link rel="stylesheet" href="<?= e(asset('css/style.css')) ?>">
<?php if (in_array($page[2], ['home', 'projects', 'project'], true)): ?><link rel="stylesheet" href="<?= e(asset('css/projects.css')) ?>"><?php endif ?>
<?php if ($page[2] === 'lesson'): ?><link rel="stylesheet" href="<?= e(asset('css/lesson.css')) ?>"><?php endif ?>
<script src="<?= e(asset('js/script.js')) ?>" defer></script>
<script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP) ?></script>
</head>
<body id="home">
<a class="skip-link" href="#main">Skip to content</a>
<header class="site-header"><div class="container header-inner">
<a class="brand" href="<?= e(url()) ?>" aria-label="Webostics home"><img src="<?= e(url('assets/site/favicon.svg')) ?>" width="34" height="34" alt=""><span>webostics<span class="brand-dot">.</span></span></a>
<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="navigation" hidden>Menu <span aria-hidden="true">☰</span></button>
<div class="menu-backdrop" hidden></div>
<div class="navigation-shell" id="navigation-drawer" tabindex="-1">
<div class="drawer-heading"><span id="drawer-title">Explore Webostics</span><button class="menu-close" type="button" aria-label="Close menu">Close <span aria-hidden="true">&#215;</span></button></div>
<nav class="navigation" id="navigation" aria-label="Main navigation">
<?php foreach (['services'=>'Services','courses'=>'Courses','ai'=>'AI','devops'=>'DevOps','projects'=>'Projects','resources'=>'Resources','about'=>'About'] as $path=>$label): ?><a href="<?= e(url($path)) ?>" <?= ($route===$path || str_starts_with($route,$path.'/')) ? 'aria-current="page"' : '' ?>><?= e($label) ?></a><?php endforeach ?>
<a class="nav-hire" href="<?= e(url('contact?type=service')) ?>">Hire Webostics <span aria-hidden="true">↗</span></a>
</nav></div></div></header>
<main id="main">
<?php if ($route!==''): ?><nav class="breadcrumb container" aria-label="Breadcrumb"><a href="<?= e(url()) ?>">Home</a><span aria-hidden="true">/</span><?php if (str_contains($route,'/')): ?><a href="<?= e(url(explode('/',$route)[0])) ?>"><?= e(ucfirst(explode('/',$route)[0])) ?></a><span aria-hidden="true">/</span><?php endif ?><span aria-current="page"><?= e(explode(' | ',$page[0])[0]) ?></span></nav><?php endif ?>
