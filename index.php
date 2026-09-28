<?php
require __DIR__ . '/app/bootstrap.php';
if ($route === 'robots.txt') {
    header('Content-Type: text/plain; charset=utf-8');
    echo "User-agent: *\n" . ($isProduction ? "Allow: /\nDisallow: /app/\nDisallow: /storage/\nDisallow: /vendor/\nDisallow: /docs/\nSitemap: " . canonical('sitemap.xml') . "\n" : "Disallow: /\n");
    exit;
}
if ($route === 'sitemap.xml') {
    header('Content-Type: application/xml; charset=utf-8');
    echo '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    foreach ($pages as $path=>$entry) {
        if (in_array($entry[2], ['course','category'], true) || ($entry[2] === 'projects' && !$projects)) continue;
        echo '<url><loc>' . e(canonical($path)) . '</loc></url>';
    }
    echo '</urlset>'; exit;
}
$page = $pages[$route] ?? ['Page not found | Webostics','This page could not be found. Explore services, courses or resources at Webostics.','404'];
if ($page[2] === '404') http_response_code(404);
$noindex = !$isProduction || in_array($page[2], ['course','category','404'], true)
    || ($page[2] === 'projects' && (!$projects || isset($_GET['platform'])));
$slug = basename($route);
require __DIR__ . '/app/components.php';
$formStatus = ''; $formMessage = '';
if ($page[2] === 'contact' || $page[2] === 'service') require __DIR__ . '/app/contact.php';
$schema = ['@context'=>'https://schema.org','@graph'=>[
 ['@type'=>'Organization','@id'=>canonical().'#organization','name'=>'Webostics','url'=>canonical(),'email'=>$contactEmail],
 ['@type'=>'WebSite','@id'=>canonical().'#website','name'=>'Webostics','url'=>canonical(),'publisher'=>['@id'=>canonical().'#organization']],
 ['@type'=>'WebPage','@id'=>canonical($route).'#page','url'=>canonical($route),'name'=>$page[0],'description'=>$page[1],'isPartOf'=>['@id'=>canonical().'#website']]
]];
if ($route !== '' && $page[2] !== '404') {
 $crumbs = [['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>canonical()]];
 if (str_contains($route,'/')) { $parent = explode('/',$route)[0]; $crumbs[] = ['@type'=>'ListItem','position'=>2,'name'=>ucfirst($parent),'item'=>canonical($parent)]; }
 $crumbs[] = ['@type'=>'ListItem','position'=>count($crumbs)+1,'name'=>explode(' | ',$page[0])[0],'item'=>canonical($route)];
 $schema['@graph'][] = ['@type'=>'BreadcrumbList','itemListElement'=>$crumbs];
}
if ($page[2] === 'service') $schema['@graph'][]=['@type'=>'Service','name'=>$services[$slug][0],'description'=>$services[$slug][3],'url'=>canonical($route),'provider'=>['@id'=>canonical().'#organization']];
if ($page[2] === 'lesson') $schema['@graph'][]=['@type'=>'LearningResource','name'=>'Your First HTML Page','description'=>$page[1],'url'=>canonical($route),'learningResourceType'=>'Practice lesson','educationalLevel'=>'Beginner','isAccessibleForFree'=>true,'inLanguage'=>'en','publisher'=>['@id'=>canonical().'#organization']];
require __DIR__ . '/app/views/header.php';
if ($page[2] === 'home') require __DIR__ . '/app/views/home.php';
else require __DIR__ . '/app/views/pages.php';
require __DIR__ . '/app/views/footer.php';
