<?php

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
    'featured_projects' => [
        [
            'images' => ['images/project1.jpg', 'images/project1-2.jpg', 'images/project1-3.jpg', 'images/project1-4.jpg'],
            'alt' => 'DreamBouw construction project exterior view',
            'label' => 'Open construction project gallery',
            'width' => 1536,
            'height' => 1152,
        ],
        [
            'images' => ['images/project2.jpg', 'images/project2-2.jpg', 'images/project2-3.jpg', 'images/project2-4.jpg'],
            'alt' => 'DreamBouw renovation project detail',
            'label' => 'Open renovation project gallery',
            'width' => 1152,
            'height' => 1536,
        ],
        [
            'images' => ['images/project3.jpg', 'images/project3-2.jpg', 'images/project3-3.jpg', 'images/project3-4.jpg'],
            'alt' => 'DreamBouw structural construction work',
            'label' => 'Open structural construction gallery',
            'width' => 1536,
            'height' => 1152,
        ],
        [
            'images' => ['images/project4.jpg', 'images/project4-2.jpg', 'images/project4-3.jpg', 'images/project4-4.jpg'],
            'alt' => 'DreamBouw interior and finishing project',
            'label' => 'Open interior and finishing gallery',
            'width' => 1536,
            'height' => 1152,
        ],
        [
            'images' => ['images/project5.jpg', 'images/project5-2.jpg', 'images/project5-3.jpg', 'images/project5-4.jpg'],
            'alt' => 'DreamBouw residential building project',
            'label' => 'Open residential building gallery',
            'width' => 1536,
            'height' => 1152,
        ],
        [
            'images' => ['images/project6.jpg', 'images/project6-2.jpg', 'images/project6-3.jpg', 'images/project6-4.jpg'],
            'alt' => 'DreamBouw completed construction project',
            'label' => 'Open completed construction gallery',
            'width' => 1536,
            'height' => 864,
        ],
    ],
];
