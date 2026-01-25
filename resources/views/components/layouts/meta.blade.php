@php
$meta = $meta ?? [];
// Brand name required by request
$brand = "MA Takhassus Al-Qur’an Wonosobo";
$rawTitle = $meta['title'] ?? ($title ?? '');

$pageTitle = trim($rawTitle);

// Determine if current page is the homepage (beranda)
// Use exact URL comparison to site's root URL
if (url()->current() === url('/')) {
	$fullTitle = $brand;
	$metaTitle = $brand;
} else {
	// If a page title exists, use: "{title} | {BRAND}", otherwise fallback to brand
	$metaTitle = $pageTitle !== '' ? $pageTitle : $brand;
	$fullTitle = ($pageTitle !== '' ? $pageTitle : $brand) . ' - ' . $brand;
}

$description = $meta['description'] ?? config('app.description', '');
$canonical = $meta['canonical'] ?? url()->current();
$image = $meta['image'] ?? asset('assets/og-image.png');
$ogType = $meta['og_type'] ?? 'website';
$robots = $meta['robots'] ?? 'index, follow';
@endphp
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $fullTitle }}</title>
<meta name="title" content="{{ $fullTitle }}">
<meta name="description" content="{{ $description }}">
<link rel="canonical" href="{{ $canonical }}">
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:title" content="{{ $fullTitle }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $fullTitle }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">

<meta name="robots" content="{{ $robots }}">