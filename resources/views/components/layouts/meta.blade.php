@php
    $meta = $meta ?? [];
    $siteName = config('app.name');
    $rawTitle = $meta['title'] ?? ($title ?? '');

    // Normalize page title: remove any leading/trailing site name to avoid duplicates
    $pageTitle = trim($rawTitle);
    if (! empty($siteName)) {
        // remove site name if present at start or end (case-insensitive)
        $pattern = '/^' . preg_quote($siteName, '/') . '\s*\|?\s*/i';
        $pageTitle = preg_replace($pattern, '', $pageTitle);
        $patternEnd = '/\s*\|?\s*' . preg_quote($siteName, '/') . '$/i';
        $pageTitle = preg_replace($patternEnd, '', $pageTitle);
        $pageTitle = trim($pageTitle);
    }

    // Format title as: SiteName | Page Title (avoid duplicates)
    $fullTitle = $siteName . ($pageTitle !== '' ? ' | ' . $pageTitle : '');

    $description = $meta['description'] ?? config('app.description', '');
    $canonical = $meta['canonical'] ?? url()->current();
    $image = $meta['image'] ?? asset('assets/og-image.png');
    $ogType = $meta['og_type'] ?? 'website';
    $robots = $meta['robots'] ?? 'index, follow';
@endphp

<title>{{ $fullTitle }}</title>
<meta name="title" content="{{ $pageTitle }}">
<meta name="description" content="{{ $description }}">
<link rel="canonical" href="{{ $canonical }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:title" content="{{ $fullTitle }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $image }}">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $fullTitle }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">

<meta name="robots" content="{{ $robots }}">
