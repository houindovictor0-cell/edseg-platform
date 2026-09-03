@props(['name'])

@php
$icons = [
    'home' => '<path d="M3 10.5 12 3l9 7.5"/><path d="M5.5 9.5V20a1 1 0 0 0 1 1H10v-5.5a2 2 0 0 1 2-2h0a2 2 0 0 1 2 2V21h3.5a1 1 0 0 0 1-1V9.5"/>',
    'chart' => '<path d="M4 20V10M10 20V4M16 20v-7M22 20v-3" stroke-linecap="round"/><path d="M2 20h20" stroke-linecap="round"/>',
    'building' => '<rect x="5" y="3" width="14" height="18" rx="1.5"/><path d="M9 8h1M14 8h1M9 12h1M14 12h1M9 16h1M14 16h1" stroke-linecap="round"/><path d="M10 21v-3.5a2 2 0 0 1 4 0V21"/>',
    'book' => '<path d="M4 5.5A1.5 1.5 0 0 1 5.5 4H12v16H5.5A1.5 1.5 0 0 1 4 18.5v-13Z"/><path d="M20 5.5A1.5 1.5 0 0 0 18.5 4H12v16h6.5a1.5 1.5 0 0 0 1.5-1.5v-13Z"/>',
    'calendar' => '<rect x="3.5" y="5" width="17" height="16" rx="1.5"/><path d="M8 3v4M16 3v4M3.5 10h17" stroke-linecap="round"/>',
    'doc-text' => '<path d="M6 3.5h9l3.5 3.5V20a.5.5 0 0 1-.5.5H6a.5.5 0 0 1-.5-.5V4a.5.5 0 0 1 .5-.5Z"/><path d="M9 12.5h6M9 16h6" stroke-linecap="round"/><path d="M15 3.5V7h3.5"/>',
    'user' => '<circle cx="12" cy="8" r="3.5"/><path d="M5 20c0-3.5 3-6 7-6s7 2.5 7 6" stroke-linecap="round"/>',
    'user-badge' => '<circle cx="12" cy="7.5" r="3.25"/><path d="M5.5 19.5c0-3.3 2.9-5.75 6.5-5.75s6.5 2.45 6.5 5.75" stroke-linecap="round"/><circle cx="12" cy="7.5" r="1"/>',
    'flask' => '<path d="M10 3.5h4M10 3.5v6l-5.5 9A1.5 1.5 0 0 0 5.8 21h12.4a1.5 1.5 0 0 0 1.3-2.25L14 9.5v-6"/><path d="M8 15h8" stroke-linecap="round"/>',
    'beaker' => '<path d="M9 4h6M12 4v5.5M8 20.5h8a1 1 0 0 0 .95-1.32l-2.2-6.5a2 2 0 0 1-.1-.63V9.5H9.35v2.55c0 .21-.03.42-.1.63l-2.2 6.5A1 1 0 0 0 8 20.5Z"/>',
    'folder' => '<path d="M3.5 6.5A1.5 1.5 0 0 1 5 5h4.4l1.6 2h8a1.5 1.5 0 0 1 1.5 1.5v9A1.5 1.5 0 0 1 19 19H5a1.5 1.5 0 0 1-1.5-1.5v-11Z"/>',
    'doc-list' => '<path d="M6 3.5h9l3.5 3.5V20a.5.5 0 0 1-.5.5H6a.5.5 0 0 1-.5-.5V4a.5.5 0 0 1 .5-.5Z"/><path d="M8.5 12h.01M8.5 15.5h.01M11 12h4M11 15.5h4" stroke-linecap="round"/><path d="M15 3.5V7h3.5"/>',
    'link' => '<path d="M9.5 14.5 14.5 9.5" stroke-linecap="round"/><path d="M11 7.5 12.6 5.9a3.5 3.5 0 0 1 5 5L16 12.5M13 16.5l-1.6 1.6a3.5 3.5 0 0 1-5-5L8 11.5" stroke-linecap="round"/>',
    'credit-card' => '<rect x="3" y="5.5" width="18" height="13" rx="1.75"/><path d="M3 9.5h18" stroke-linecap="round"/><path d="M6.5 14.5h4" stroke-linecap="round"/>',
    'newspaper' => '<path d="M4.5 5.5h11a1 1 0 0 1 1 1V18a1.5 1.5 0 0 0 1.5 1.5h0A1.5 1.5 0 0 0 19.5 18V9h-3" /><path d="M7 9h6M7 12.5h6M7 16h4" stroke-linecap="round"/><path d="M4.5 5.5V18A1.5 1.5 0 0 0 6 19.5h11.5" />',
    'inbox' => '<path d="M3.5 12.5h4.7l1.2 2h5.2l1.2-2h4.7"/><path d="M5.2 6.2 3.5 12.5v5A1.5 1.5 0 0 0 5 19h14a1.5 1.5 0 0 0 1.5-1.5v-5l-1.7-6.3a1.5 1.5 0 0 0-1.45-1.1H6.65a1.5 1.5 0 0 0-1.45 1.1Z"/>',
    'users' => '<circle cx="9" cy="8.5" r="3"/><path d="M3.5 19c0-3 2.5-5.25 5.5-5.25S14.5 16 14.5 19" stroke-linecap="round"/><path d="M15.5 6a2.75 2.75 0 0 1 0 5.4M17.5 19c0-2.4-1.5-4.35-3.5-5.05" stroke-linecap="round"/>',
    'photo' => '<rect x="3" y="4.5" width="18" height="15" rx="1.5"/><circle cx="8.5" cy="9.5" r="1.6"/><path d="m4 17 5-5 3.5 3.5L17 11l3 4" stroke-linecap="round" stroke-linejoin="round"/>',
    'settings' => '<circle cx="12" cy="12" r="3"/><path d="M12 3.5v2M12 18.5v2M20.5 12h-2M5.5 12h-2M17.8 6.2l-1.4 1.4M7.6 16.4l-1.4 1.4M17.8 17.8l-1.4-1.4M7.6 7.6 6.2 6.2" stroke-linecap="round"/>',
    'search' => '<circle cx="10.5" cy="10.5" r="6.5"/><path d="m20 20-4.5-4.5" stroke-linecap="round"/>',
    'logout' => '<path d="M15.5 8V6a1.5 1.5 0 0 0-1.5-1.5H6A1.5 1.5 0 0 0 4.5 6v12A1.5 1.5 0 0 0 6 19.5h8a1.5 1.5 0 0 0 1.5-1.5v-2" stroke-linecap="round"/><path d="M9.5 12h10M16.5 8.5l3.5 3.5-3.5 3.5" stroke-linecap="round" stroke-linejoin="round"/>',
    'external' => '<path d="M9 6H6.5A1.5 1.5 0 0 0 5 7.5v10A1.5 1.5 0 0 0 6.5 19h10a1.5 1.5 0 0 0 1.5-1.5V15" stroke-linecap="round"/><path d="M13.5 5H19v5.5M19 5l-8.5 8.5" stroke-linecap="round" stroke-linejoin="round"/>',
    'menu' => '<path d="M4 6.5h16M4 12h16M4 17.5h16" stroke-linecap="round"/>',
];
$path = $icons[$name] ?? $icons['doc-text'];
@endphp

<svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke' => 'currentColor', 'stroke-width' => '1.6', 'stroke-linecap' => 'round', 'stroke-linejoin' => 'round', 'aria-hidden' => 'true']) }}>
    {!! $path !!}
</svg>
