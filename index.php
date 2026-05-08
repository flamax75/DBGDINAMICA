<?php
$config = require __DIR__ . '/data/site.php';
$site = $config['site'];

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function gallery_card(array $project): string
{
    $images = e(json_encode($project['images'], JSON_UNESCAPED_SLASHES));
    $firstImage = e($project['images'][0]);
    $label = e($project['label']);
    $alt = e($project['alt']);
    $width = (int) $project['width'];
    $height = (int) $project['height'];

    return <<<HTML
                <div class="project-card" data-images='{$images}'>
                    <button class="project-button" type="button" aria-label="{$label}">
                        <img src="{$firstImage}" alt="{$alt}" width="{$width}"
                            height="{$height}" loading="lazy" decoding="async">
                    </button>
                </div>

HTML;
}

$contactStatus = $_GET['contact'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($site['name']) ?></title>
    <meta name="description" content="<?= e($site['description']) ?>">
    <link rel="canonical" href="<?= e($site['url']) ?>">

    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= e($site['name']) ?>">
    <meta property="og:description" content="<?= e($site['description']) ?>">
    <meta property="og:url" content="<?= e($site['url']) ?>">
    <meta property="og:image" content="<?= e(rtrim($site['url'], '/') . '/images/fondo.jpg') ?>">
    <meta property="og:site_name" content="<?= e($site['name']) ?>">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($site['name']) ?>">
    <meta name="twitter:description" content="<?= e($site['description']) ?>">
    <meta name="twitter:image" content="<?= e(rtrim($site['url'], '/') . '/images/fondo.jpg') ?>">

    <link rel="preload" href="images/fondo.jpg" as="image">
    <link rel="stylesheet" href="style.css">
    <link rel="manifest" href="manifest.json">
    <meta name="theme-color" content="#000000">
    <link rel="icon" href="images/logo.jpg">
    <link rel="apple-touch-icon" href="images/icon-192.png">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="DreamBouw">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "ConstructionBusiness",
            "name": "<?= e($site['name']) ?>",
            "url": "<?= e($site['url']) ?>",
            "logo": "<?= e(rtrim($site['url'], '/') . '/images/logo.jpg') ?>",
            "email": "<?= e($site['email']) ?>",
            "telephone": "<?= e($site['phone']) ?>",
            "founder": {
                "@type": "Person",
                "name": "Vlad Maxim"
            },
            "description": "<?= e($site['description']) ?>"
        }
    </script>
</head>

<body>
    <div id="intro-video">
        <video id="introVid" autoplay muted playsinline preload="metadata" poster="images/fondo.jpg">
            <source src="videos/intro.mp4" type="video/mp4">
        </video>
        <button class="intro-skip" id="intro-skip" type="button">Skip</button>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="logo">
            <a href="#home" class="logo-text">
                <span class="logo-silver">DREAM</span>
                <span class="logo-gold">BOUW GROUP</span>
            </a>
        </div>

        <button class="menu-toggle" id="menu-toggle" type="button" aria-label="Open navigation menu"
            aria-controls="nav-links" aria-expanded="false">
            ☰
        </button>

        <ul class="nav-links" id="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#lgs">LGS</a></li>
            <li><a href="#projects">Projects</a></li>
            <li><a href="#collaborators">Collaborators</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>

        <div class="language-switcher" aria-label="Choose language">
            <button type="button" data-language="en" aria-pressed="true">EN</button>
            <button type="button" data-language="fr" aria-pressed="false">FR</button>
            <button type="button" data-language="vls" aria-pressed="false">VLS</button>
            <button type="button" data-language="nl" aria-pressed="false">NL</button>
        </div>
    </nav>

    <!-- HERO -->
    <header class="hero" id="home">
        <div class="overlay">
            <div class="hero-content">
                <h1 id="hero-text">YOU DREAM IT</h1>
                <div class="hero-actions">
                    <a class="button button-primary"
                        href="mailto:info@dreambouwgroup.com?subject=Project%20request%20-%20DreamBouw%20Group">Request a
                        quote</a>
                    <a class="button button-secondary" href="#projects">View work</a>
                </div>
            </div>
        </div>
    </header>

    <!-- ABOUT -->
    <section id="about" class="about">
        <div class="container">
            <h2>About DreamBouwGroup</h2>

            <p><strong>Dream Bouw Group</strong> is a company built on experience, strong partnerships, and respect for
                every client.</p>

            <p>Over the years, we have been involved in numerous construction and engineering projects, contributing
                directly to project coordination, site organization, and cost optimization.</p>

            <p>Through this experience, we learned that the success of a project depends not only on plans and materials,
                but above all on professional teams, efficient organization, and a strong sense of responsibility toward
                the client.</p>

            <p>Our experience includes the construction and management of over 5,000+ sqm in Belgium, 3,000+ sqm in
                Romania, and 5,000+ sqm in Portugal, across residential, commercial, and engineering projects.</p>

            <p>Dream Bouw Group was created from the long-term partnerships developed throughout the years with trusted
                companies, engineers, and professional teams in the construction industry.</p>

            <p>These collaborations were built on trust, professionalism, and mutual respect, values that continue to
                define every project we undertake today.</p>

            <p>By bringing together this network of experience and expertise, we are able to offer our clients quality,
                safety, efficiency, and peace of mind throughout every stage of the construction process.</p>

            <p>For us, every project represents more than just construction work. It is a commitment to deliver durable,
                well-executed results held to the highest standards.</p>

            <p>&ldquo;We don&rsquo;t just build structures. We build trust, long-term value, and lasting partnerships.&rdquo;</p>

            <p class="firma">
                Vlad Maxim<br>
                Structural Engineer & CEO, DBGroup
            </p>
        </div>
    </section>

    <!-- SERVICES -->
    <section id="services" class="section services">
        <div class="container">
            <h2>Services</h2>

            <div class="services-grid">

                <a class="service-card service-link" href="#construction">
                    <h3>Construction</h3>
                    <p>High-quality construction solutions, from structural systems to full project execution, with
                        precision and durability.</p>
                </a>

                <a class="service-card service-link" href="#project-management">
                    <h3>Project Management</h3>
                    <p>Efficient coordination and planning to ensure successful project delivery from start to finish.
                    </p>
                </a>

                <a class="service-card service-link" href="#renovations">
                    <h3>Renovations</h3>
                    <p>Transforming existing spaces with modern solutions and professional execution.</p>
                </a>

                <a class="service-card service-link" href="#interior-design">
                    <h3>Interior Design</h3>
                    <p>Functional and modern interior spaces designed to combine comfort, aesthetics, and everyday
                        usability.</p>
                </a>

                <a class="service-card service-link" href="#garden-living-units">
                    <h3>Garden Living Units</h3>
                    <p>Compact and modern outdoor structures designed for flexible use, comfort, and fast installation.
                    </p>
                </a>

            </div>
        </div>
    </section>

    <!-- CONSTRUCTION -->
    <section id="construction" class="service-detail">
        <div class="container">
            <h2>Construction</h2>

            <div class="service-detail-text">
                <p>High-quality construction solutions, from structural systems to full project execution, with
                    precision and durability.</p>
            </div>

            <div class="projects-grid service-gallery" data-gallery-key="construction">
                <div class="project-card"
                    data-images='["images/project1.jpg","images/project1-2.jpg","images/project1-3.jpg","images/project1-4.jpg","images/project2.jpg","images/project2-2.jpg","images/project2-3.jpg","images/project2-4.jpg","images/project3.jpg","images/project3-2.jpg","images/project3-3.jpg","images/project3-4.jpg","images/project4.jpg","images/project4-2.jpg","images/project4-3.jpg","images/project4-4.jpg","images/project5.jpg","images/project5-2.jpg","images/project5-3.jpg"]'
                    data-start-index="0">
                    <button class="project-button" type="button" aria-label="Open construction image 1">
                        <img src="images/project1.jpg" alt="Construction project image 1" width="1536" height="1152"
                            loading="lazy" decoding="async">
                    </button>
                </div>

                <div class="project-card"
                    data-images='["images/project1.jpg","images/project1-2.jpg","images/project1-3.jpg","images/project1-4.jpg","images/project2.jpg","images/project2-2.jpg","images/project2-3.jpg","images/project2-4.jpg","images/project3.jpg","images/project3-2.jpg","images/project3-3.jpg","images/project3-4.jpg","images/project4.jpg","images/project4-2.jpg","images/project4-3.jpg","images/project4-4.jpg","images/project5.jpg","images/project5-2.jpg","images/project5-3.jpg"]'
                    data-start-index="1">
                    <button class="project-button" type="button" aria-label="Open construction image 2">
                        <img src="images/project1-2.jpg" alt="Construction project image 2" width="1536" height="1152"
                            loading="lazy" decoding="async">
                    </button>
                </div>

                <div class="project-card"
                    data-images='["images/project1.jpg","images/project1-2.jpg","images/project1-3.jpg","images/project1-4.jpg","images/project2.jpg","images/project2-2.jpg","images/project2-3.jpg","images/project2-4.jpg","images/project3.jpg","images/project3-2.jpg","images/project3-3.jpg","images/project3-4.jpg","images/project4.jpg","images/project4-2.jpg","images/project4-3.jpg","images/project4-4.jpg","images/project5.jpg","images/project5-2.jpg","images/project5-3.jpg"]'
                    data-start-index="2">
                    <button class="project-button" type="button" aria-label="Open construction image 3">
                        <img src="images/project1-3.jpg" alt="Construction project image 3" width="1536" height="1152"
                            loading="lazy" decoding="async">
                    </button>
                </div>

                <div class="project-card"
                    data-images='["images/project1.jpg","images/project1-2.jpg","images/project1-3.jpg","images/project1-4.jpg","images/project2.jpg","images/project2-2.jpg","images/project2-3.jpg","images/project2-4.jpg","images/project3.jpg","images/project3-2.jpg","images/project3-3.jpg","images/project3-4.jpg","images/project4.jpg","images/project4-2.jpg","images/project4-3.jpg","images/project4-4.jpg","images/project5.jpg","images/project5-2.jpg","images/project5-3.jpg"]'
                    data-start-index="3">
                    <button class="project-button" type="button" aria-label="Open construction image 4">
                        <img src="images/project1-4.jpg" alt="Construction project image 4" width="1536" height="1152"
                            loading="lazy" decoding="async">
                    </button>
                </div>

                <div class="project-card"
                    data-images='["images/project1.jpg","images/project1-2.jpg","images/project1-3.jpg","images/project1-4.jpg","images/project2.jpg","images/project2-2.jpg","images/project2-3.jpg","images/project2-4.jpg","images/project3.jpg","images/project3-2.jpg","images/project3-3.jpg","images/project3-4.jpg","images/project4.jpg","images/project4-2.jpg","images/project4-3.jpg","images/project4-4.jpg","images/project5.jpg","images/project5-2.jpg","images/project5-3.jpg"]'
                    data-start-index="4">
                    <button class="project-button" type="button" aria-label="Open construction image 5">
                        <img src="images/project2.jpg" alt="Construction project image 5" width="1152" height="1536"
                            loading="lazy" decoding="async">
                    </button>
                </div>

                <div class="project-card"
                    data-images='["images/project1.jpg","images/project1-2.jpg","images/project1-3.jpg","images/project1-4.jpg","images/project2.jpg","images/project2-2.jpg","images/project2-3.jpg","images/project2-4.jpg","images/project3.jpg","images/project3-2.jpg","images/project3-3.jpg","images/project3-4.jpg","images/project4.jpg","images/project4-2.jpg","images/project4-3.jpg","images/project4-4.jpg","images/project5.jpg","images/project5-2.jpg","images/project5-3.jpg"]'
                    data-start-index="5">
                    <button class="project-button" type="button" aria-label="Open construction image 6">
                        <img src="images/project2-2.jpg" alt="Construction project image 6" width="1152" height="1536"
                            loading="lazy" decoding="async">
                    </button>
                </div>

                <div class="project-card"
                    data-images='["images/project1.jpg","images/project1-2.jpg","images/project1-3.jpg","images/project1-4.jpg","images/project2.jpg","images/project2-2.jpg","images/project2-3.jpg","images/project2-4.jpg","images/project3.jpg","images/project3-2.jpg","images/project3-3.jpg","images/project3-4.jpg","images/project4.jpg","images/project4-2.jpg","images/project4-3.jpg","images/project4-4.jpg","images/project5.jpg","images/project5-2.jpg","images/project5-3.jpg"]'
                    data-start-index="6">
                    <button class="project-button" type="button" aria-label="Open construction image 7">
                        <img src="images/project2-3.jpg" alt="Construction project image 7" width="1152" height="1536"
                            loading="lazy" decoding="async">
                    </button>
                </div>

                <div class="project-card"
                    data-images='["images/project1.jpg","images/project1-2.jpg","images/project1-3.jpg","images/project1-4.jpg","images/project2.jpg","images/project2-2.jpg","images/project2-3.jpg","images/project2-4.jpg","images/project3.jpg","images/project3-2.jpg","images/project3-3.jpg","images/project3-4.jpg","images/project4.jpg","images/project4-2.jpg","images/project4-3.jpg","images/project4-4.jpg","images/project5.jpg","images/project5-2.jpg","images/project5-3.jpg"]'
                    data-start-index="7">
                    <button class="project-button" type="button" aria-label="Open construction image 8">
                        <img src="images/project2-4.jpg" alt="Construction project image 8" width="1152" height="1536"
                            loading="lazy" decoding="async">
                    </button>
                </div>

                <div class="project-card"
                    data-images='["images/project1.jpg","images/project1-2.jpg","images/project1-3.jpg","images/project1-4.jpg","images/project2.jpg","images/project2-2.jpg","images/project2-3.jpg","images/project2-4.jpg","images/project3.jpg","images/project3-2.jpg","images/project3-3.jpg","images/project3-4.jpg","images/project4.jpg","images/project4-2.jpg","images/project4-3.jpg","images/project4-4.jpg","images/project5.jpg","images/project5-2.jpg","images/project5-3.jpg"]'
                    data-start-index="8">
                    <button class="project-button" type="button" aria-label="Open construction image 9">
                        <img src="images/project3.jpg" alt="Construction project image 9" width="1536" height="1152"
                            loading="lazy" decoding="async">
                    </button>
                </div>

                <div class="project-card"
                    data-images='["images/project1.jpg","images/project1-2.jpg","images/project1-3.jpg","images/project1-4.jpg","images/project2.jpg","images/project2-2.jpg","images/project2-3.jpg","images/project2-4.jpg","images/project3.jpg","images/project3-2.jpg","images/project3-3.jpg","images/project3-4.jpg","images/project4.jpg","images/project4-2.jpg","images/project4-3.jpg","images/project4-4.jpg","images/project5.jpg","images/project5-2.jpg","images/project5-3.jpg"]'
                    data-start-index="9">
                    <button class="project-button" type="button" aria-label="Open construction image 10">
                        <img src="images/project3-2.jpg" alt="Construction project image 10" width="1536" height="1152"
                            loading="lazy" decoding="async">
                    </button>
                </div>

                <div class="project-card"
                    data-images='["images/project1.jpg","images/project1-2.jpg","images/project1-3.jpg","images/project1-4.jpg","images/project2.jpg","images/project2-2.jpg","images/project2-3.jpg","images/project2-4.jpg","images/project3.jpg","images/project3-2.jpg","images/project3-3.jpg","images/project3-4.jpg","images/project4.jpg","images/project4-2.jpg","images/project4-3.jpg","images/project4-4.jpg","images/project5.jpg","images/project5-2.jpg","images/project5-3.jpg"]'
                    data-start-index="10">
                    <button class="project-button" type="button" aria-label="Open construction image 11">
                        <img src="images/project3-3.jpg" alt="Construction project image 11" width="1536" height="1152"
                            loading="lazy" decoding="async">
                    </button>
                </div>

                <div class="project-card"
                    data-images='["images/project1.jpg","images/project1-2.jpg","images/project1-3.jpg","images/project1-4.jpg","images/project2.jpg","images/project2-2.jpg","images/project2-3.jpg","images/project2-4.jpg","images/project3.jpg","images/project3-2.jpg","images/project3-3.jpg","images/project3-4.jpg","images/project4.jpg","images/project4-2.jpg","images/project4-3.jpg","images/project4-4.jpg","images/project5.jpg","images/project5-2.jpg","images/project5-3.jpg"]'
                    data-start-index="11">
                    <button class="project-button" type="button" aria-label="Open construction image 12">
                        <img src="images/project3-4.jpg" alt="Construction project image 12" width="1536" height="1152"
                            loading="lazy" decoding="async">
                    </button>
                </div>

                <div class="project-card"
                    data-images='["images/project1.jpg","images/project1-2.jpg","images/project1-3.jpg","images/project1-4.jpg","images/project2.jpg","images/project2-2.jpg","images/project2-3.jpg","images/project2-4.jpg","images/project3.jpg","images/project3-2.jpg","images/project3-3.jpg","images/project3-4.jpg","images/project4.jpg","images/project4-2.jpg","images/project4-3.jpg","images/project4-4.jpg","images/project5.jpg","images/project5-2.jpg","images/project5-3.jpg"]'
                    data-start-index="12">
                    <button class="project-button" type="button" aria-label="Open construction image 13">
                        <img src="images/project4.jpg" alt="Construction project image 13" width="1536" height="1152"
                            loading="lazy" decoding="async">
                    </button>
                </div>

                <div class="project-card"
                    data-images='["images/project1.jpg","images/project1-2.jpg","images/project1-3.jpg","images/project1-4.jpg","images/project2.jpg","images/project2-2.jpg","images/project2-3.jpg","images/project2-4.jpg","images/project3.jpg","images/project3-2.jpg","images/project3-3.jpg","images/project3-4.jpg","images/project4.jpg","images/project4-2.jpg","images/project4-3.jpg","images/project4-4.jpg","images/project5.jpg","images/project5-2.jpg","images/project5-3.jpg"]'
                    data-start-index="13">
                    <button class="project-button" type="button" aria-label="Open construction image 14">
                        <img src="images/project4-2.jpg" alt="Construction project image 14" width="1536" height="1152"
                            loading="lazy" decoding="async">
                    </button>
                </div>

                <div class="project-card"
                    data-images='["images/project1.jpg","images/project1-2.jpg","images/project1-3.jpg","images/project1-4.jpg","images/project2.jpg","images/project2-2.jpg","images/project2-3.jpg","images/project2-4.jpg","images/project3.jpg","images/project3-2.jpg","images/project3-3.jpg","images/project3-4.jpg","images/project4.jpg","images/project4-2.jpg","images/project4-3.jpg","images/project4-4.jpg","images/project5.jpg","images/project5-2.jpg","images/project5-3.jpg"]'
                    data-start-index="14">
                    <button class="project-button" type="button" aria-label="Open construction image 15">
                        <img src="images/project4-3.jpg" alt="Construction project image 15" width="1536" height="1152"
                            loading="lazy" decoding="async">
                    </button>
                </div>

                <div class="project-card"
                    data-images='["images/project1.jpg","images/project1-2.jpg","images/project1-3.jpg","images/project1-4.jpg","images/project2.jpg","images/project2-2.jpg","images/project2-3.jpg","images/project2-4.jpg","images/project3.jpg","images/project3-2.jpg","images/project3-3.jpg","images/project3-4.jpg","images/project4.jpg","images/project4-2.jpg","images/project4-3.jpg","images/project4-4.jpg","images/project5.jpg","images/project5-2.jpg","images/project5-3.jpg"]'
                    data-start-index="15">
                    <button class="project-button" type="button" aria-label="Open construction image 16">
                        <img src="images/project4-4.jpg" alt="Construction project image 16" width="1536" height="1152"
                            loading="lazy" decoding="async">
                    </button>
                </div>

                <div class="project-card"
                    data-images='["images/project1.jpg","images/project1-2.jpg","images/project1-3.jpg","images/project1-4.jpg","images/project2.jpg","images/project2-2.jpg","images/project2-3.jpg","images/project2-4.jpg","images/project3.jpg","images/project3-2.jpg","images/project3-3.jpg","images/project3-4.jpg","images/project4.jpg","images/project4-2.jpg","images/project4-3.jpg","images/project4-4.jpg","images/project5.jpg","images/project5-2.jpg","images/project5-3.jpg"]'
                    data-start-index="16">
                    <button class="project-button" type="button" aria-label="Open construction image 17">
                        <img src="images/project5.jpg" alt="Construction project image 17" width="1536" height="1152"
                            loading="lazy" decoding="async">
                    </button>
                </div>

                <div class="project-card"
                    data-images='["images/project1.jpg","images/project1-2.jpg","images/project1-3.jpg","images/project1-4.jpg","images/project2.jpg","images/project2-2.jpg","images/project2-3.jpg","images/project2-4.jpg","images/project3.jpg","images/project3-2.jpg","images/project3-3.jpg","images/project3-4.jpg","images/project4.jpg","images/project4-2.jpg","images/project4-3.jpg","images/project4-4.jpg","images/project5.jpg","images/project5-2.jpg","images/project5-3.jpg"]'
                    data-start-index="17">
                    <button class="project-button" type="button" aria-label="Open construction image 18">
                        <img src="images/project5-2.jpg" alt="Construction project image 18" width="1536" height="1152"
                            loading="lazy" decoding="async">
                    </button>
                </div>

                <div class="project-card"
                    data-images='["images/project1.jpg","images/project1-2.jpg","images/project1-3.jpg","images/project1-4.jpg","images/project2.jpg","images/project2-2.jpg","images/project2-3.jpg","images/project2-4.jpg","images/project3.jpg","images/project3-2.jpg","images/project3-3.jpg","images/project3-4.jpg","images/project4.jpg","images/project4-2.jpg","images/project4-3.jpg","images/project4-4.jpg","images/project5.jpg","images/project5-2.jpg","images/project5-3.jpg"]'
                    data-start-index="18">
                    <button class="project-button" type="button" aria-label="Open construction image 19">
                        <img src="images/project5-3.jpg" alt="Construction project image 19" width="1536" height="1152"
                            loading="lazy" decoding="async">
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- PROJECT MANAGEMENT -->
    <section id="project-management" class="service-detail">
        <div class="container">
            <h2>Project Management</h2>

            <div class="service-detail-text">
                <p>At DreamBouw Group, we provide complete construction project management services for residential and
                    modern building projects in Belgium.</p>

                <p>With more than 10 years of experience in construction coordination, structural engineering, and site
                    execution, we ensure that every phase of the project is planned, monitored, and delivered with
                    precision.</p>

                <h3>Our project management services include:</h3>
                <ul class="service-detail-list">
                    <li>Site coordination and daily supervision</li>
                    <li>Planning and scheduling of works</li>
                    <li>Budget and cost control</li>
                    <li>Quality control and technical inspections</li>
                    <li>Coordination of subcontractors and suppliers</li>
                    <li>Health &amp; Safety monitoring</li>
                    <li>Material planning and logistics</li>
                    <li>Technical problem solving on site</li>
                    <li>Progress reporting and communication with clients</li>
                    <li>Turnkey project organization</li>
                </ul>

                <h3>Why clients choose DreamBouw Group</h3>
                <ul class="service-detail-list">
                    <li>Strong technical engineering background</li>
                    <li>Experience with modern and LGS construction systems</li>
                    <li>Clear communication and transparent planning</li>
                    <li>Focus on deadlines, quality, and efficiency</li>
                    <li>Practical on-site experience in Belgium residential projects</li>
                </ul>

                <p>We manage every detail so your project runs smoothly, efficiently, and professionally.</p>
            </div>
        </div>
    </section>

    <!-- RENOVATIONS -->
    <section id="renovations" class="service-detail">
        <div class="container">
            <h2>Renovations</h2>

            <div class="service-detail-text">
                <p>Transforming existing spaces with modern solutions and professional execution. From complete
                    interior renovations to extensions, upgrades, and structural improvements, we deliver high-quality
                    workmanship focused on durability, functionality, and modern design.</p>
            </div>

            <div class="projects-grid service-gallery" data-gallery-key="renovations"></div>
        </div>
    </section>

    <!-- INTERIOR DESIGN -->
    <section id="interior-design" class="service-detail">
        <div class="container">
            <h2>Interior Design</h2>

            <div class="service-detail-text">
                <p>We design and deliver refined interior spaces where functionality meets elegance. Every detail is
                    carefully considered, from layout and materials to custom-made furniture, creating fully
                    personalized environments built around your lifestyle.</p>
            </div>

            <div class="projects-grid service-gallery" data-gallery-key="interior-design"></div>
        </div>
    </section>

    <!-- GARDEN LIVING UNITS -->
    <section id="garden-living-units" class="service-detail">
        <div class="container">
            <h2>Garden Living Units</h2>

            <div class="service-detail-text">
                <p>Compact and modern outdoor structures designed for flexible use, comfort, and fast installation.</p>

                <p>Our Garden Living Units can be used as garden houses, guest rooms, home offices, storage spaces, or
                    private relaxation areas, offering a practical extension of your living space.</p>

                <p>Thanks to prefabricated and optimized construction systems, they require minimal transport, reduced
                    on-site work, and significantly faster installation compared to traditional builds. This results in
                    lower logistics costs and a smooth, efficient delivery process.</p>

                <p>A smart solution for expanding your space quickly, without complex construction or high
                    infrastructure costs.</p>
            </div>

            <div class="projects-grid service-gallery" data-gallery-key="garden-living-units"></div>
        </div>
    </section>

    <!-- LGS SECTION -->
    <section id="lgs" class="lgs">
        <div class="container">
            <h2>Light Gauge Steel (LGS)</h2>

            <p>
                Light Gauge Steel (LGS) is a modern construction system based on cold-formed steel profiles.
                These elements are precisely engineered and assembled to create a strong, stable structural frame.
            </p>

            <ul class="lgs-list">
                <li>High structural strength, calculated according to Eurocodes</li>
                <li>Excellent fire resistance (non-combustible material)</li>
                <li>High resistance to moisture, mold, and pests</li>
                <li>Stable over time — no cracking, shrinking, or warping</li>
                <li>Designed to withstand wind and structural loads</li>
            </ul>

            <p class="lgs-final">
                In short, LGS is not about building lighter — it’s about building smarter,
                with controlled quality and long-term durability.
            </p>
        </div>
    </section>

    <section id="projects" class="projects">
        <div class="container">
            <h2>Our Work</h2>

            <div class="projects-grid">
                <?php foreach ($config['featured_projects'] as $project): ?>
<?= gallery_card($project) ?>
                <?php endforeach; ?>

            </div>
        </div>
    </section>

    <!-- COLLABORATORS -->
    <section id="collaborators" class="collaborators">
        <div class="container">
            <h2>Collaborators</h2>

            <div class="collaborators-grid">
                <a class="collaborator-logo" href="https://flamaxmedia.es" target="_blank" rel="noopener noreferrer"
                    aria-label="Visit Flamaxmedia website">
                    <img src="images/collaborators/flamaxmedia-logo.png" alt="Flamaxmedia logo" loading="lazy"
                        decoding="async">
                </a>
            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <section id="contact" class="section contact">
        <div class="container">
            <h2>Contact</h2>
            <p>Tell us what you want to build and we will get back to you with the next steps.</p>
            <?php if ($contactStatus === 'sent'): ?>
                <p class="form-status form-status-success">Thank you. Your request has been received.</p>
            <?php elseif ($contactStatus === 'error'): ?>
                <p class="form-status form-status-error">Please complete your name, email, and message.</p>
            <?php endif; ?>

            <form class="contact-form" action="/api/contact.php" method="post">
                <div class="form-grid">
                    <label>
                        Name
                        <input type="text" name="name" autocomplete="name" required>
                    </label>
                    <label>
                        Email
                        <input type="email" name="email" autocomplete="email" required>
                    </label>
                    <label>
                        Phone
                        <input type="tel" name="phone" autocomplete="tel">
                    </label>
                    <label>
                        Project type
                        <input type="text" name="project_type">
                    </label>
                    <label class="form-span">
                        Location
                        <input type="text" name="location">
                    </label>
                    <label class="form-span">
                        Message
                        <textarea name="message" rows="5" required></textarea>
                    </label>
                    <label class="form-honeypot" aria-hidden="true">
                        Company
                        <input type="text" name="company" tabindex="-1" autocomplete="off">
                    </label>
                </div>
                <div class="contact-actions">
                    <button class="button button-primary" type="submit">Send request</button>
                    <a class="button button-secondary" href="mailto:<?= e($site['email']) ?>"><?= e($site['email']) ?></a>
                    <a class="button button-secondary" href="tel:<?= e($site['phone']) ?>"><?= e($site['phone_display']) ?></a>
                </div>
            </form>
        </div>
    </section>

    <footer class="site-footer">
        <div class="container">
            <p>&copy; <?= e($site['year']) ?> <?= e($site['name']) ?>. All rights reserved. Website by <a href="https://flamaxmedia.es"
                    target="_blank" rel="noopener noreferrer">Flamaxmedia</a>.</p>
        </div>
    </footer>

    <div class="lightbox" id="project-lightbox" aria-hidden="true">
        <div class="lightbox-backdrop" data-lightbox-close></div>
        <div class="lightbox-dialog" role="dialog" aria-modal="true" aria-label="Project gallery">
            <button class="lightbox-close" type="button" aria-label="Close gallery" data-lightbox-close>×</button>
            <button class="lightbox-nav lightbox-prev" type="button" aria-label="Previous image">‹</button>
            <img class="lightbox-image" id="lightbox-image" src="images/project1.jpg" alt="">
            <button class="lightbox-nav lightbox-next" type="button" aria-label="Next image">›</button>
            <p class="lightbox-count" id="lightbox-count"></p>
        </div>
    </div>

    <script>
        window.DREAMBOUW_DATA = <?= json_encode([
            'serviceGalleries' => $config['service_galleries'],
            'contactEmail' => $site['email'],
        ], JSON_UNESCAPED_SLASHES) ?>;
    </script>
    <script src="script.js"></script>
</body>

</html>
