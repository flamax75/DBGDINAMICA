<?php

require_once __DIR__ . '/env.php';

return [
    'site' => [
        'name' => 'DreamBouw Group',
        'url' => getenv('APP_URL') ?: 'https://dreambouwgroup.com/',
        'email' => getenv('CONTACT_TO') ?: 'info@dreambouwgroup.com',
        'phone' => '+32494583589',
        'phone_display' => '+32 494 58 35 89',
        'year' => '2026',
        'description' => 'DreamBouw Group delivers construction, renovations, project management, interior design, Garden Living Units, and Light Gauge Steel solutions with durable, professional execution.',
    ],
    'service_galleries' => [
        'construction' => array_merge(
            array_map(fn ($i) => "images/construction/construction-{$i}.jpg", range(1, 11)),
            array_map(fn ($i) => "images/construction/construction-{$i}.jpeg", range(12, 19))
        ),
        'renovations' => array_map(fn ($i) => "images/renovations/renovation-{$i}.jpeg", range(1, 12)),
        'interior-design' => array_map(fn ($i) => "images/interior-design/interior-design-{$i}.jpeg", range(1, 12)),
        'garden-living-units' => array_map(fn ($i) => "images/pool-houses/pool-house-{$i}.jpeg", range(1, 4)),
    ],
];
