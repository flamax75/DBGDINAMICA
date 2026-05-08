/* ========================= */
/* LANGUAGE SWITCHER */
/* ========================= */
const languageButtons = document.querySelectorAll("[data-language]");
const browserLanguage = navigator.language ? navigator.language.toLowerCase() : "";
const savedLanguage = getStoredLanguage();
const defaultLanguage = browserLanguage.startsWith("fr") ? "fr" : browserLanguage.startsWith("nl") ? "vls" : "en";
let currentLanguage = savedLanguage || defaultLanguage;
let heroPhraseIndex = 0;

function getStoredLanguage() {
    try {
        return localStorage.getItem("dreambouw-language");
    } catch (error) {
        return null;
    }
}

function storeLanguage(language) {
    try {
        localStorage.setItem("dreambouw-language", language);
    } catch (error) {
        // Some browsers block localStorage in strict privacy modes.
    }
}

const translations = {
    en: {
        htmlLang: "en",
        title: "DreamBouw Group",
        metaDescription: "DreamBouw Group delivers construction, renovations, project management, interior design, Garden Living Units, and Light Gauge Steel solutions with durable, professional execution.",
        chooseLanguage: "Choose language",
        openNav: "Open navigation menu",
        closeNav: "Close navigation menu",
        skip: "Skip",
        nav: ["Home", "About", "Services", "LGS", "Projects", "Collaborators", "Contact"],
        heroPhrases: ["YOU DREAM IT", "WE BUILD IT"],
        quoteButton: "Request a quote",
        viewWorkButton: "View work",
        quoteSubject: "Project request - DreamBouw Group",
        contactBody: "Hello DreamBouw Group,\n\nI would like to discuss a project.\n\nProject type:\nLocation:\nTimeline:\nMessage:\n",
        aboutTitle: "About DreamBouwGroup",
        about: [
            "<strong>Dream Bouw Group</strong> is a company built on experience, strong partnerships, and respect for every client.",
            "Over the years, we have been involved in numerous construction and engineering projects, contributing directly to project coordination, site organization, and cost optimization.",
            "Through this experience, we learned that the success of a project depends not only on plans and materials, but above all on professional teams, efficient organization, and a strong sense of responsibility toward the client.",
            "Our experience includes the construction and management of over 5,000+ sqm in Belgium, 3,000+ sqm in Romania, and 5,000+ sqm in Portugal, across residential, commercial, and engineering projects.",
            "Dream Bouw Group was created from the long-term partnerships developed throughout the years with trusted companies, engineers, and professional teams in the construction industry.",
            "These collaborations were built on trust, professionalism, and mutual respect, values that continue to define every project we undertake today.",
            "By bringing together this network of experience and expertise, we are able to offer our clients quality, safety, efficiency, and peace of mind throughout every stage of the construction process.",
            "For us, every project represents more than just construction work. It is a commitment to deliver durable, well-executed results held to the highest standards.",
            "&ldquo;We don&rsquo;t just build structures. We build trust, long-term value, and lasting partnerships.&rdquo;",
        ],
        signature: "Vlad Maxim<br>Structural Engineer & CEO, DBGroup",
        servicesTitle: "Services",
        services: {
            construction: ["Construction", "High-quality construction solutions, from structural systems to full project execution, with precision and durability."],
            "project-management": ["Project Management", "Efficient coordination and planning to ensure successful project delivery from start to finish."],
            renovations: ["Renovations", "Transforming existing spaces with modern solutions and professional execution."],
            "interior-design": ["Interior Design", "Functional and modern interior spaces designed to combine comfort, aesthetics, and everyday usability."],
            "garden-living-units": ["Garden Living Units", "Compact and modern outdoor structures designed for flexible use, comfort, and fast installation."],
        },
        projectManagement: {
            paragraphs: [
                "At DreamBouw Group, we provide complete construction project management services for residential and modern building projects in Belgium.",
                "With more than 10 years of experience in construction coordination, structural engineering, and site execution, we ensure that every phase of the project is planned, monitored, and delivered with precision.",
                "We manage every detail so your project runs smoothly, efficiently, and professionally.",
            ],
            includeTitle: "Our project management services include:",
            includeItems: ["Site coordination and daily supervision", "Planning and scheduling of works", "Budget and cost control", "Quality control and technical inspections", "Coordination of subcontractors and suppliers", "Health & Safety monitoring", "Material planning and logistics", "Technical problem solving on site", "Progress reporting and communication with clients", "Turnkey project organization"],
            whyTitle: "Why clients choose DreamBouw Group",
            whyItems: ["Strong technical engineering background", "Experience with modern and LGS construction systems", "Clear communication and transparent planning", "Focus on deadlines, quality, and efficiency", "Practical on-site experience in Belgium residential projects"],
        },
        details: {
            construction: ["Construction", "High-quality construction solutions, from structural systems to full project execution, with precision and durability."],
            renovations: ["Renovations", "Transforming existing spaces with modern solutions and professional execution. From complete interior renovations to extensions, upgrades, and structural improvements, we deliver high-quality workmanship focused on durability, functionality, and modern design."],
            "interior-design": ["Interior Design", "We design and deliver refined interior spaces where functionality meets elegance. Every detail is carefully considered, from layout and materials to custom-made furniture, creating fully personalized environments built around your lifestyle."],
            "garden-living-units": ["Garden Living Units", "Compact and modern outdoor structures designed for flexible use, comfort, and fast installation.", "Our Garden Living Units can be used as garden houses, guest rooms, home offices, storage spaces, or private relaxation areas, offering a practical extension of your living space.", "Thanks to prefabricated and optimized construction systems, they require minimal transport, reduced on-site work, and significantly faster installation compared to traditional builds. This results in lower logistics costs and a smooth, efficient delivery process.", "A smart solution for expanding your space quickly, without complex construction or high infrastructure costs."],
        },
        lgsTitle: "Light Gauge Steel (LGS)",
        lgsIntro: "Light Gauge Steel (LGS) is a modern construction system based on cold-formed steel profiles. These elements are precisely engineered and assembled to create a strong, stable structural frame.",
        lgsItems: ["High structural strength, calculated according to Eurocodes", "Excellent fire resistance (non-combustible material)", "High resistance to moisture, mold, and pests", "Stable over time - no cracking, shrinking, or warping", "Designed to withstand wind and structural loads"],
        lgsFinal: "In short, LGS is not about building lighter - it's about building smarter, with controlled quality and long-term durability.",
        projectsTitle: "Our Work",
        collaboratorsTitle: "Collaborators",
        contactTitle: "Contact",
        contactText: "Tell us what you want to build and we will get back to you with the next steps.",
        emailButton: "Email DreamBouw",
        footer: "&copy; 2026 DreamBouw Group. All rights reserved. Website by <a href=\"https://flamaxmedia.es\" target=\"_blank\" rel=\"noopener noreferrer\">Flamaxmedia</a>.",
        galleryLabels: {
            construction: "construction",
            renovations: "renovation",
            "interior-design": "interior design",
            "garden-living-units": "garden living unit",
        },
        openImage: "Open {label} image {number}",
        lightbox: {
            gallery: "Project gallery",
            close: "Close gallery",
            previous: "Previous image",
            next: "Next image",
            imageAlt: "Project image {number} of {total}",
        },
    },
    fr: {
        htmlLang: "fr",
        title: "DreamBouw Group",
        metaDescription: "DreamBouw Group realise des projets de construction, renovation, gestion de projet, design interieur, Garden Living Units et solutions Light Gauge Steel avec une execution durable et professionnelle.",
        chooseLanguage: "Choisir la langue",
        openNav: "Ouvrir le menu de navigation",
        closeNav: "Fermer le menu de navigation",
        skip: "Passer",
        nav: ["Accueil", "A propos", "Services", "LGS", "Projets", "Collaborateurs", "Contact"],
        heroPhrases: ["VOUS L'IMAGINEZ", "NOUS LE CONSTRUISONS"],
        quoteButton: "Demander un devis",
        viewWorkButton: "Voir nos projets",
        quoteSubject: "Demande de projet - DreamBouw Group",
        contactBody: "Bonjour DreamBouw Group,\n\nJe souhaite discuter d'un projet.\n\nType de projet :\nLieu :\nDelai :\nMessage :\n",
        aboutTitle: "A propos de DreamBouwGroup",
        about: [
            "<strong>Dream Bouw Group</strong> est une entreprise construite sur l'experience, des partenariats solides et le respect de chaque client.",
            "Au fil des annees, nous avons participe a de nombreux projets de construction et d'ingenierie, en contribuant directement a la coordination, a l'organisation du chantier et a l'optimisation des couts.",
            "Cette experience nous a appris que la reussite d'un projet depend non seulement des plans et des materiaux, mais surtout d'equipes professionnelles, d'une organisation efficace et d'un fort sens des responsabilites envers le client.",
            "Notre experience comprend la construction et la gestion de plus de 5 000 m2 en Belgique, 3 000 m2 en Roumanie et 5 000 m2 au Portugal, dans des projets residentiels, commerciaux et d'ingenierie.",
            "Dream Bouw Group est ne des partenariats durables developpes au fil des annees avec des entreprises, ingenieurs et equipes professionnelles de confiance dans le secteur de la construction.",
            "Ces collaborations reposent sur la confiance, le professionnalisme et le respect mutuel, des valeurs qui continuent de definir chaque projet que nous realisons aujourd'hui.",
            "En reunissant ce reseau d'experience et de savoir-faire, nous pouvons offrir a nos clients qualite, securite, efficacite et tranquillite d'esprit a chaque etape du processus de construction.",
            "Pour nous, chaque projet represente plus qu'un simple travail de construction. C'est un engagement a livrer des resultats durables, bien executes et conformes aux standards les plus eleves.",
            "&ldquo;Nous ne construisons pas seulement des structures. Nous construisons la confiance, une valeur durable et des partenariats solides.&rdquo;",
        ],
        signature: "Vlad Maxim<br>Ingenieur structure & CEO, DBGroup",
        servicesTitle: "Services",
        services: {
            construction: ["Construction", "Solutions de construction de haute qualite, des systemes structurels a l'execution complete du projet, avec precision et durabilite."],
            "project-management": ["Gestion de projet", "Coordination et planification efficaces pour assurer la livraison reussie du projet du debut a la fin."],
            renovations: ["Renovations", "Transformation d'espaces existants avec des solutions modernes et une execution professionnelle."],
            "interior-design": ["Design interieur", "Espaces interieurs fonctionnels et modernes, concus pour combiner confort, esthetique et usage quotidien."],
            "garden-living-units": ["Garden Living Units", "Structures exterieures compactes et modernes, concues pour une utilisation flexible, le confort et une installation rapide."],
        },
        projectManagement: {
            paragraphs: [
                "Chez DreamBouw Group, nous proposons des services complets de gestion de projets de construction pour des projets residentiels et modernes en Belgique.",
                "Avec plus de 10 ans d'experience en coordination de construction, ingenierie structurelle et execution sur chantier, nous veillons a ce que chaque phase soit planifiee, suivie et livree avec precision.",
                "Nous gerons chaque detail afin que votre projet avance de maniere fluide, efficace et professionnelle.",
            ],
            includeTitle: "Nos services de gestion de projet comprennent :",
            includeItems: ["Coordination du chantier et supervision quotidienne", "Planification et calendrier des travaux", "Controle du budget et des couts", "Controle qualite et inspections techniques", "Coordination des sous-traitants et fournisseurs", "Suivi sante et securite", "Planification des materiaux et logistique", "Resolution de problemes techniques sur chantier", "Rapports d'avancement et communication avec les clients", "Organisation de projets cle en main"],
            whyTitle: "Pourquoi les clients choisissent DreamBouw Group",
            whyItems: ["Solide base technique en ingenierie", "Experience des systemes de construction modernes et LGS", "Communication claire et planification transparente", "Priorite aux delais, a la qualite et a l'efficacite", "Experience pratique sur chantiers residentiels en Belgique"],
        },
        details: {
            construction: ["Construction", "Solutions de construction de haute qualite, des systemes structurels a l'execution complete du projet, avec precision et durabilite."],
            renovations: ["Renovations", "Transformation d'espaces existants avec des solutions modernes et une execution professionnelle. Des renovations interieures completes aux extensions, ameliorations et renforcements structurels, nous livrons un travail de qualite axe sur la durabilite, la fonctionnalite et le design moderne."],
            "interior-design": ["Design interieur", "Nous concevons et realisons des espaces interieurs raffines ou la fonctionnalite rencontre l'elegance. Chaque detail est soigneusement pense, de l'agencement aux materiaux et au mobilier sur mesure, pour creer des environnements personnalises autour de votre mode de vie."],
            "garden-living-units": ["Garden Living Units", "Structures exterieures compactes et modernes, concues pour une utilisation flexible, le confort et une installation rapide.", "Nos Garden Living Units peuvent servir d'abris de jardin, chambres d'amis, bureaux a domicile, espaces de stockage ou zones privees de detente, comme extension pratique de votre espace de vie.", "Grace a des systemes prefabbriques et optimises, elles necessitent moins de transport, moins de travail sur site et une installation bien plus rapide que les constructions traditionnelles. Cela reduit les couts logistiques et assure une livraison fluide.", "Une solution intelligente pour agrandir rapidement votre espace, sans construction complexe ni couts d'infrastructure eleves."],
        },
        lgsTitle: "Light Gauge Steel (LGS)",
        lgsIntro: "Le Light Gauge Steel (LGS) est un systeme de construction moderne base sur des profiles en acier formes a froid. Ces elements sont concus avec precision et assembles pour creer une structure solide et stable.",
        lgsItems: ["Haute resistance structurelle, calculee selon les Eurocodes", "Excellente resistance au feu (materiau incombustible)", "Haute resistance a l'humidite, aux moisissures et aux nuisibles", "Stable dans le temps - sans fissuration, retrait ni deformation", "Concu pour resister au vent et aux charges structurelles"],
        lgsFinal: "En bref, le LGS ne consiste pas a construire plus leger, mais a construire plus intelligemment, avec une qualite controlee et une durabilite a long terme.",
        projectsTitle: "Nos projets",
        collaboratorsTitle: "Collaborateurs",
        contactTitle: "Contact",
        contactText: "Dites-nous ce que vous souhaitez construire et nous vous recontacterons avec les prochaines etapes.",
        emailButton: "Envoyer un email",
        footer: "&copy; 2026 DreamBouw Group. Tous droits reserves. Site web par <a href=\"https://flamaxmedia.es\" target=\"_blank\" rel=\"noopener noreferrer\">Flamaxmedia</a>.",
        galleryLabels: {
            construction: "construction",
            renovations: "renovation",
            "interior-design": "design interieur",
            "garden-living-units": "Garden Living Unit",
        },
        openImage: "Ouvrir l'image {number} - {label}",
        lightbox: {
            gallery: "Galerie de projet",
            close: "Fermer la galerie",
            previous: "Image precedente",
            next: "Image suivante",
            imageAlt: "Image de projet {number} sur {total}",
        },
    },
    vls: {
        htmlLang: "nl-BE",
        title: "DreamBouw Group",
        metaDescription: "DreamBouw Group levert bouw, renovaties, projectbeheer, interieurontwerp, Garden Living Units en Light Gauge Steel-oplossingen met duurzame en professionele uitvoering.",
        chooseLanguage: "Taal kiezen",
        openNav: "Navigatiemenu openen",
        closeNav: "Navigatiemenu sluiten",
        skip: "Overslaan",
        nav: ["Home", "Over ons", "Diensten", "LGS", "Projecten", "Partners", "Contact"],
        heroPhrases: ["JIJ DROOMT HET", "WIJ BOUWEN HET"],
        quoteButton: "Offerte aanvragen",
        viewWorkButton: "Bekijk projecten",
        quoteSubject: "Projectaanvraag - DreamBouw Group",
        contactBody: "Hallo DreamBouw Group,\n\nIk wil graag een project bespreken.\n\nType project:\nLocatie:\nTiming:\nBericht:\n",
        aboutTitle: "Over DreamBouwGroup",
        about: [
            "<strong>Dream Bouw Group</strong> is een bedrijf gebouwd op ervaring, sterke partnerships en respect voor elke klant.",
            "Doorheen de jaren waren we betrokken bij tal van bouw- en engineeringprojecten, met directe bijdrage aan projectcoordinatie, werforganisatie en kostenoptimalisatie.",
            "Die ervaring leerde ons dat het succes van een project niet alleen afhangt van plannen en materialen, maar vooral van professionele ploegen, efficiente organisatie en een sterk verantwoordelijkheidsgevoel tegenover de klant.",
            "Onze ervaring omvat de bouw en het beheer van meer dan 5.000 m2 in Belgie, 3.000 m2 in Roemenie en 5.000 m2 in Portugal, binnen residentiele, commerciele en engineeringprojecten.",
            "Dream Bouw Group is ontstaan uit langdurige partnerships die doorheen de jaren werden opgebouwd met betrouwbare bedrijven, ingenieurs en professionele ploegen in de bouwsector.",
            "Deze samenwerkingen zijn gebouwd op vertrouwen, professionaliteit en wederzijds respect, waarden die vandaag elk project blijven bepalen.",
            "Door dit netwerk van ervaring en expertise samen te brengen, bieden we onze klanten kwaliteit, veiligheid, efficientie en gemoedsrust in elke fase van het bouwproces.",
            "Voor ons is elk project meer dan gewoon bouwwerk. Het is een engagement om duurzame, degelijk uitgevoerde resultaten af te leveren volgens de hoogste normen.",
            "&ldquo;We bouwen niet alleen structuren. We bouwen vertrouwen, langetermijnwaarde en duurzame partnerships.&rdquo;",
        ],
        signature: "Vlad Maxim<br>Stabiliteitsingenieur & CEO, DBGroup",
        servicesTitle: "Diensten",
        services: {
            construction: ["Bouw", "Hoogwaardige bouwoplossingen, van structurele systemen tot volledige projectuitvoering, met precisie en duurzaamheid."],
            "project-management": ["Projectbeheer", "Efficientie coordinatie en planning om een geslaagde oplevering van begin tot einde te verzekeren."],
            renovations: ["Renovaties", "Bestaande ruimtes transformeren met moderne oplossingen en professionele uitvoering."],
            "interior-design": ["Interieurontwerp", "Functionele en moderne interieurs die comfort, esthetiek en dagelijks gebruik combineren."],
            "garden-living-units": ["Garden Living Units", "Compacte en moderne buitenstructuren voor flexibel gebruik, comfort en snelle plaatsing."],
        },
        projectManagement: {
            paragraphs: [
                "Bij DreamBouw Group bieden we volledig projectbeheer voor residentiele en moderne bouwprojecten in Belgie.",
                "Met meer dan 10 jaar ervaring in bouwcoordinatie, stabiliteitsengineering en werfuitvoering zorgen we ervoor dat elke fase nauwkeurig wordt gepland, opgevolgd en opgeleverd.",
                "Wij beheren elk detail zodat uw project vlot, efficient en professioneel verloopt.",
            ],
            includeTitle: "Onze diensten voor projectbeheer omvatten:",
            includeItems: ["Werfcoordinatie en dagelijkse opvolging", "Planning en fasering van de werken", "Budget- en kostencontrole", "Kwaliteitscontrole en technische inspecties", "Coordinatie van onderaannemers en leveranciers", "Opvolging van gezondheid en veiligheid", "Materiaalplanning en logistiek", "Technische probleemoplossing op de werf", "Voortgangsrapportage en communicatie met klanten", "Sleutel-op-de-deur projectorganisatie"],
            whyTitle: "Waarom klanten kiezen voor DreamBouw Group",
            whyItems: ["Sterke technische engineeringachtergrond", "Ervaring met moderne en LGS-bouwsystemen", "Heldere communicatie en transparante planning", "Focus op deadlines, kwaliteit en efficientie", "Praktische werfervaring in Belgische residentiele projecten"],
        },
        details: {
            construction: ["Bouw", "Hoogwaardige bouwoplossingen, van structurele systemen tot volledige projectuitvoering, met precisie en duurzaamheid."],
            renovations: ["Renovaties", "Bestaande ruimtes transformeren met moderne oplossingen en professionele uitvoering. Van volledige interieurrenovaties tot uitbreidingen, upgrades en structurele verbeteringen leveren we hoogwaardig vakwerk met focus op duurzaamheid, functionaliteit en modern design."],
            "interior-design": ["Interieurontwerp", "Wij ontwerpen en realiseren verfijnde interieurs waar functionaliteit en elegantie samenkomen. Elk detail wordt zorgvuldig bekeken, van indeling en materialen tot maatmeubilair, om volledig gepersonaliseerde ruimtes te creeren rond uw levensstijl."],
            "garden-living-units": ["Garden Living Units", "Compacte en moderne buitenstructuren voor flexibel gebruik, comfort en snelle plaatsing.", "Onze Garden Living Units kunnen worden gebruikt als tuinhuizen, logeerkamers, thuiskantoren, opslagruimtes of prive ontspanningsruimtes, als praktische uitbreiding van uw leefruimte.", "Dankzij geprefabriceerde en geoptimaliseerde bouwsystemen vragen ze minder transport, minder werk op de werf en een veel snellere plaatsing dan traditionele bouw. Dat verlaagt logistieke kosten en zorgt voor een vlotte levering.", "Een slimme oplossing om uw ruimte snel uit te breiden, zonder complexe bouw of hoge infrastructuurkosten."],
        },
        lgsTitle: "Light Gauge Steel (LGS)",
        lgsIntro: "Light Gauge Steel (LGS) is een modern bouwsysteem op basis van koudgevormde staalprofielen. Deze elementen worden nauwkeurig ontworpen en gemonteerd tot een sterk en stabiel structureel frame.",
        lgsItems: ["Hoge structurele sterkte, berekend volgens de Eurocodes", "Uitstekende brandweerstand (niet-brandbaar materiaal)", "Hoge weerstand tegen vocht, schimmel en ongedierte", "Stabiel op lange termijn - geen scheuren, krimpen of vervormen", "Ontworpen om wind en structurele lasten te weerstaan"],
        lgsFinal: "Kort gezegd: LGS gaat niet over lichter bouwen, maar over slimmer bouwen, met gecontroleerde kwaliteit en duurzaamheid op lange termijn.",
        projectsTitle: "Onze projecten",
        collaboratorsTitle: "Partners",
        contactTitle: "Contact",
        contactText: "Vertel ons wat u wilt bouwen en wij nemen contact op met de volgende stappen.",
        emailButton: "Mail DreamBouw",
        footer: "&copy; 2026 DreamBouw Group. Alle rechten voorbehouden. Website door <a href=\"https://flamaxmedia.es\" target=\"_blank\" rel=\"noopener noreferrer\">Flamaxmedia</a>.",
        galleryLabels: {
            construction: "bouw",
            renovations: "renovatie",
            "interior-design": "interieurontwerp",
            "garden-living-units": "Garden Living Unit",
        },
        openImage: "Open {label} afbeelding {number}",
        lightbox: {
            gallery: "Projectgalerij",
            close: "Galerij sluiten",
            previous: "Vorige afbeelding",
            next: "Volgende afbeelding",
            imageAlt: "Projectafbeelding {number} van {total}",
        },
    },
    nl: {
        htmlLang: "nl",
        title: "DreamBouw Group",
        metaDescription: "DreamBouw Group levert bouw, renovaties, projectmanagement, interieurontwerp, Garden Living Units en Light Gauge Steel-oplossingen met duurzame en professionele uitvoering.",
        chooseLanguage: "Taal kiezen",
        openNav: "Navigatiemenu openen",
        closeNav: "Navigatiemenu sluiten",
        skip: "Overslaan",
        nav: ["Home", "Over ons", "Diensten", "LGS", "Projecten", "Partners", "Contact"],
        heroPhrases: ["JIJ DROOMT HET", "WIJ BOUWEN HET"],
        quoteButton: "Offerte aanvragen",
        viewWorkButton: "Bekijk werk",
        quoteSubject: "Projectaanvraag - DreamBouw Group",
        contactBody: "Hallo DreamBouw Group,\n\nIk wil graag een project bespreken.\n\nType project:\nLocatie:\nPlanning:\nBericht:\n",
        aboutTitle: "Over DreamBouwGroup",
        about: [
            "<strong>Dream Bouw Group</strong> is een bedrijf gebouwd op ervaring, sterke samenwerkingen en respect voor iedere klant.",
            "In de loop der jaren zijn we betrokken geweest bij veel bouw- en engineeringprojecten, met directe bijdragen aan projectcoordinatie, bouwplaatsorganisatie en kostenoptimalisatie.",
            "Door deze ervaring hebben we geleerd dat het succes van een project niet alleen afhangt van plannen en materialen, maar vooral van professionele teams, efficiente organisatie en een sterk verantwoordelijkheidsgevoel richting de klant.",
            "Onze ervaring omvat de bouw en het beheer van meer dan 5.000 m2 in Belgie, 3.000 m2 in Roemenie en 5.000 m2 in Portugal, binnen residentiele, commerciele en engineeringprojecten.",
            "Dream Bouw Group is ontstaan uit langdurige samenwerkingen die door de jaren heen zijn opgebouwd met betrouwbare bedrijven, ingenieurs en professionele teams in de bouwsector.",
            "Deze samenwerkingen zijn gebouwd op vertrouwen, professionaliteit en wederzijds respect, waarden die vandaag elk project blijven bepalen.",
            "Door dit netwerk van ervaring en expertise samen te brengen, bieden wij onze klanten kwaliteit, veiligheid, efficientie en rust gedurende elke fase van het bouwproces.",
            "Voor ons is elk project meer dan alleen bouwwerk. Het is een commitment om duurzame, goed uitgevoerde resultaten te leveren volgens de hoogste normen.",
            "&ldquo;Wij bouwen niet alleen structuren. Wij bouwen vertrouwen, langetermijnwaarde en duurzame samenwerkingen.&rdquo;",
        ],
        signature: "Vlad Maxim<br>Constructief ingenieur & CEO, DBGroup",
        servicesTitle: "Diensten",
        services: {
            construction: ["Bouw", "Hoogwaardige bouwoplossingen, van constructieve systemen tot volledige projectuitvoering, met precisie en duurzaamheid."],
            "project-management": ["Projectmanagement", "Efficientie coordinatie en planning om een succesvolle projectoplevering van begin tot eind te waarborgen."],
            renovations: ["Renovaties", "Bestaande ruimtes transformeren met moderne oplossingen en professionele uitvoering."],
            "interior-design": ["Interieurontwerp", "Functionele en moderne interieurs die comfort, esthetiek en dagelijks gebruik combineren."],
            "garden-living-units": ["Garden Living Units", "Compacte en moderne buitenstructuren, ontworpen voor flexibel gebruik, comfort en snelle installatie."],
        },
        projectManagement: {
            paragraphs: [
                "Bij DreamBouw Group bieden we volledig projectmanagement voor residentiele en moderne bouwprojecten in Belgie.",
                "Met meer dan 10 jaar ervaring in bouwcoordinatie, constructieve engineering en uitvoering op locatie zorgen we ervoor dat elke fase nauwkeurig wordt gepland, bewaakt en opgeleverd.",
                "Wij beheren elk detail zodat uw project soepel, efficient en professioneel verloopt.",
            ],
            includeTitle: "Onze projectmanagementdiensten omvatten:",
            includeItems: ["Bouwplaatscoordinatie en dagelijkse supervisie", "Planning en fasering van werkzaamheden", "Budget- en kostenbewaking", "Kwaliteitscontrole en technische inspecties", "Coordinatie van onderaannemers en leveranciers", "Monitoring van gezondheid en veiligheid", "Materiaalplanning en logistiek", "Technische probleemoplossing op locatie", "Voortgangsrapportage en communicatie met klanten", "Turn-key projectorganisatie"],
            whyTitle: "Waarom klanten kiezen voor DreamBouw Group",
            whyItems: ["Sterke technische engineeringachtergrond", "Ervaring met moderne en LGS-bouwsystemen", "Heldere communicatie en transparante planning", "Focus op deadlines, kwaliteit en efficientie", "Praktische ervaring op Belgische residentiele bouwplaatsen"],
        },
        details: {
            construction: ["Bouw", "Hoogwaardige bouwoplossingen, van constructieve systemen tot volledige projectuitvoering, met precisie en duurzaamheid."],
            renovations: ["Renovaties", "Bestaande ruimtes transformeren met moderne oplossingen en professionele uitvoering. Van complete interieurrenovaties tot uitbreidingen, upgrades en constructieve verbeteringen leveren wij hoogwaardig vakwerk met focus op duurzaamheid, functionaliteit en modern design."],
            "interior-design": ["Interieurontwerp", "Wij ontwerpen en realiseren verfijnde interieurs waar functionaliteit en elegantie samenkomen. Elk detail wordt zorgvuldig bekeken, van indeling en materialen tot maatwerkmeubilair, om volledig gepersonaliseerde omgevingen te creeren rond uw levensstijl."],
            "garden-living-units": ["Garden Living Units", "Compacte en moderne buitenstructuren, ontworpen voor flexibel gebruik, comfort en snelle installatie.", "Onze Garden Living Units kunnen worden gebruikt als tuinhuis, logeerkamer, thuiskantoor, opslagruimte of prive ontspanningsruimte, als praktische uitbreiding van uw leefruimte.", "Dankzij geprefabriceerde en geoptimaliseerde bouwsystemen vragen ze minder transport, minder werk op locatie en een aanzienlijk snellere installatie dan traditionele bouw. Dit verlaagt logistieke kosten en zorgt voor een soepel leveringsproces.", "Een slimme oplossing om uw ruimte snel uit te breiden, zonder complexe bouw of hoge infrastructuurkosten."],
        },
        lgsTitle: "Light Gauge Steel (LGS)",
        lgsIntro: "Light Gauge Steel (LGS) is een modern bouwsysteem op basis van koudgevormde staalprofielen. Deze elementen worden nauwkeurig ontworpen en gemonteerd tot een sterk en stabiel constructief frame.",
        lgsItems: ["Hoge constructieve sterkte, berekend volgens de Eurocodes", "Uitstekende brandwerendheid (niet-brandbaar materiaal)", "Hoge weerstand tegen vocht, schimmel en ongedierte", "Stabiel op lange termijn - geen scheuren, krimpen of vervormen", "Ontworpen om wind en constructieve belastingen te weerstaan"],
        lgsFinal: "Kort gezegd: LGS gaat niet over lichter bouwen, maar over slimmer bouwen, met gecontroleerde kwaliteit en duurzaamheid op lange termijn.",
        projectsTitle: "Ons werk",
        collaboratorsTitle: "Partners",
        contactTitle: "Contact",
        contactText: "Vertel ons wat u wilt bouwen en wij nemen contact op met de volgende stappen.",
        emailButton: "Mail DreamBouw",
        footer: "&copy; 2026 DreamBouw Group. Alle rechten voorbehouden. Website door <a href=\"https://flamaxmedia.es\" target=\"_blank\" rel=\"noopener noreferrer\">Flamaxmedia</a>.",
        galleryLabels: {
            construction: "bouw",
            renovations: "renovatie",
            "interior-design": "interieurontwerp",
            "garden-living-units": "Garden Living Unit",
        },
        openImage: "Open {label} afbeelding {number}",
        lightbox: {
            gallery: "Projectgalerij",
            close: "Galerij sluiten",
            previous: "Vorige afbeelding",
            next: "Volgende afbeelding",
            imageAlt: "Projectafbeelding {number} van {total}",
        },
    },
};

function setText(selector, value) {
    const element = document.querySelector(selector);
    if (element && value !== undefined) {
        element.textContent = value;
    }
}

function setHTML(selector, value) {
    const element = document.querySelector(selector);
    if (element && value !== undefined) {
        element.innerHTML = value;
    }
}

function setList(selector, values) {
    document.querySelectorAll(selector).forEach((element, index) => {
        if (values[index] !== undefined) {
            element.textContent = values[index];
        }
    });
}

function mailtoHref(subject, body = "") {
    const contactEmail = window.DREAMBOUW_DATA?.contactEmail || "info@dreambouwgroup.com";
    const href = `mailto:${contactEmail}?subject=${encodeURIComponent(subject)}`;
    return body ? `${href}&body=${encodeURIComponent(body)}` : href;
}

function formatTranslation(template, values) {
    return template.replace(/\{(\w+)\}/g, (match, key) => values[key] || match);
}

function getCopy() {
    return translations[currentLanguage] || translations.en;
}

function getGalleryLabel(key) {
    return getCopy().galleryLabels[key] || key.replaceAll("-", " ");
}

function updateGeneratedGalleryLabels() {
    document.querySelectorAll("[data-gallery-key] .project-card").forEach((card) => {
        const gallery = card.closest("[data-gallery-key]");
        const img = card.querySelector("img");
        const button = card.querySelector(".project-button");
        const number = Number(card.dataset.startIndex || 0) + 1;
        const label = getGalleryLabel(gallery.dataset.galleryKey);
        const text = formatTranslation(getCopy().openImage, { label, number });

        if (button) {
            button.setAttribute("aria-label", text);
        }

        if (img) {
            img.alt = `${label} ${number}`;
        }
    });
}

function applyLanguage(language) {
    currentLanguage = translations[language] ? language : "en";
    const copy = getCopy();

    document.documentElement.lang = copy.htmlLang;
    document.title = copy.title;
    setText("title", copy.title);
    document.querySelector('meta[name="description"]')?.setAttribute("content", copy.metaDescription);
    document.querySelector('meta[property="og:description"]')?.setAttribute("content", copy.metaDescription);
    document.querySelector('meta[name="twitter:description"]')?.setAttribute("content", copy.metaDescription);

    document.querySelector(".language-switcher")?.setAttribute("aria-label", copy.chooseLanguage);
    languageButtons.forEach((button) => {
        button.setAttribute("aria-pressed", String(button.dataset.language === currentLanguage));
    });

    setText("#intro-skip", copy.skip);
    setList(".nav-links a", copy.nav);

    if (toggle && nav) {
        const isOpen = nav.classList.contains("active");
        toggle.setAttribute("aria-label", isOpen ? copy.closeNav : copy.openNav);
    }

    heroPhraseIndex = 0;
    setText("#hero-text", copy.heroPhrases[0]);
    setText(".hero-actions .button-primary", copy.quoteButton);
    setText(".hero-actions .button-secondary", copy.viewWorkButton);
    document.querySelector(".hero-actions .button-primary")?.setAttribute("href", mailtoHref(copy.quoteSubject));

    setText("#about h2", copy.aboutTitle);
    document.querySelectorAll("#about .container > p:not(.firma)").forEach((paragraph, index) => {
        if (copy.about[index] !== undefined) {
            paragraph.innerHTML = copy.about[index];
        }
    });
    setHTML("#about .firma", copy.signature);

    setText("#services h2", copy.servicesTitle);
    Object.keys(copy.services).forEach((key) => {
        setText(`.service-link[href="#${key}"] h3`, copy.services[key][0]);
        setText(`.service-link[href="#${key}"] p`, copy.services[key][1]);
    });

    setText("#construction h2", copy.details.construction[0]);
    setText("#construction .service-detail-text p", copy.details.construction[1]);

    setText("#project-management h2", copy.services["project-management"][0]);
    setList("#project-management .service-detail-text > p", copy.projectManagement.paragraphs);
    setText("#project-management .service-detail-text > h3:nth-of-type(1)", copy.projectManagement.includeTitle);
    setList("#project-management .service-detail-list:nth-of-type(1) li", copy.projectManagement.includeItems);
    setText("#project-management .service-detail-text > h3:nth-of-type(2)", copy.projectManagement.whyTitle);
    setList("#project-management .service-detail-list:nth-of-type(2) li", copy.projectManagement.whyItems);

    ["renovations", "interior-design", "garden-living-units"].forEach((key) => {
        const detail = copy.details[key];
        setText(`#${key} h2`, detail[0]);
        document.querySelectorAll(`#${key} .service-detail-text p`).forEach((paragraph, index) => {
            if (detail[index + 1] !== undefined) {
                paragraph.textContent = detail[index + 1];
            }
        });
    });

    setText("#lgs h2", copy.lgsTitle);
    setText("#lgs .container > p:not(.lgs-final)", copy.lgsIntro);
    setList("#lgs .lgs-list li", copy.lgsItems);
    setText("#lgs .lgs-final", copy.lgsFinal);

    setText("#projects h2", copy.projectsTitle);
    setText("#collaborators h2", copy.collaboratorsTitle);
    document.querySelector(".collaborator-logo")?.setAttribute("aria-label", currentLanguage === "fr" ? "Visiter le site Flamaxmedia" : currentLanguage === "en" ? "Visit Flamaxmedia website" : "Bezoek de website van Flamaxmedia");

    setText("#contact h2", copy.contactTitle);
    setText("#contact p", copy.contactText);
    setText("#contact .button-primary", copy.emailButton);
    document.querySelector("#contact .button-primary")?.setAttribute("href", mailtoHref(copy.quoteSubject, copy.contactBody));
    setHTML(".site-footer p", copy.footer);

    document.querySelector(".lightbox-dialog")?.setAttribute("aria-label", copy.lightbox.gallery);
    document.querySelector(".lightbox-close")?.setAttribute("aria-label", copy.lightbox.close);
    document.querySelector(".lightbox-prev")?.setAttribute("aria-label", copy.lightbox.previous);
    document.querySelector(".lightbox-next")?.setAttribute("aria-label", copy.lightbox.next);
    updateGeneratedGalleryLabels();

    storeLanguage(currentLanguage);
}

languageButtons.forEach((button) => {
    button.addEventListener("click", () => {
        applyLanguage(button.dataset.language);
    });
});

/* ========================= */
/* MOBILE MENU */
/* ========================= */
const toggle = document.getElementById("menu-toggle");
const nav = document.getElementById("nav-links");
const navItems = document.querySelectorAll(".nav-links a");

if (toggle && nav) {
    function closeMenu() {
        nav.classList.remove("active");
        toggle.setAttribute("aria-expanded", "false");
        toggle.setAttribute("aria-label", getCopy().openNav);
    }

    toggle.addEventListener("click", () => {
        const isOpen = nav.classList.toggle("active");

        toggle.setAttribute("aria-expanded", String(isOpen));
        toggle.setAttribute("aria-label", isOpen ? getCopy().closeNav : getCopy().openNav);
    });

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") {
            closeMenu();
        }
    });

    navItems.forEach((link) => {
        link.addEventListener("click", () => {
            if (window.innerWidth <= 768) {
                closeMenu();
            }
        });
    });
}

/* ========================= */
/* SERVICE GALLERIES */
/* ========================= */
const serviceGalleries = window.DREAMBOUW_DATA?.serviceGalleries || {
    construction: [
        "images/construction/construction-1.jpg",
        "images/construction/construction-2.jpg",
        "images/construction/construction-3.jpg",
        "images/construction/construction-4.jpg",
        "images/construction/construction-5.jpg",
        "images/construction/construction-6.jpg",
        "images/construction/construction-7.jpg",
        "images/construction/construction-8.jpg",
        "images/construction/construction-9.jpg",
        "images/construction/construction-10.jpg",
        "images/construction/construction-11.jpg",
        "images/construction/construction-12.jpeg",
        "images/construction/construction-13.jpeg",
        "images/construction/construction-14.jpeg",
        "images/construction/construction-15.jpeg",
        "images/construction/construction-16.jpeg",
        "images/construction/construction-17.jpeg",
        "images/construction/construction-18.jpeg",
        "images/construction/construction-19.jpeg",
    ],
    renovations: [
        "images/renovations/renovation-1.jpeg",
        "images/renovations/renovation-2.jpeg",
        "images/renovations/renovation-3.jpeg",
        "images/renovations/renovation-4.jpeg",
        "images/renovations/renovation-5.jpeg",
        "images/renovations/renovation-6.jpeg",
        "images/renovations/renovation-7.jpeg",
        "images/renovations/renovation-8.jpeg",
        "images/renovations/renovation-9.jpeg",
        "images/renovations/renovation-10.jpeg",
        "images/renovations/renovation-11.jpeg",
        "images/renovations/renovation-12.jpeg",
    ],
    "interior-design": [
        "images/interior-design/interior-design-1.jpeg",
        "images/interior-design/interior-design-2.jpeg",
        "images/interior-design/interior-design-3.jpeg",
        "images/interior-design/interior-design-4.jpeg",
        "images/interior-design/interior-design-5.jpeg",
        "images/interior-design/interior-design-6.jpeg",
        "images/interior-design/interior-design-7.jpeg",
        "images/interior-design/interior-design-8.jpeg",
        "images/interior-design/interior-design-9.jpeg",
        "images/interior-design/interior-design-10.jpeg",
        "images/interior-design/interior-design-11.jpeg",
        "images/interior-design/interior-design-12.jpeg",
    ],
    "garden-living-units": [
        "images/pool-houses/pool-house-1.jpeg",
        "images/pool-houses/pool-house-2.jpeg",
        "images/pool-houses/pool-house-3.jpeg",
        "images/pool-houses/pool-house-4.jpeg",
    ],
};

document.querySelectorAll("[data-gallery-key]").forEach((gallery) => {
    const images = serviceGalleries[gallery.dataset.galleryKey] || [];
    const label = getGalleryLabel(gallery.dataset.galleryKey);

    gallery.innerHTML = images.map((image, index) => `
        <div class="project-card" data-images='${JSON.stringify(images)}' data-start-index="${index}">
            <button class="project-button" type="button" aria-label="${formatTranslation(getCopy().openImage, { label, number: index + 1 })}">
                <img src="${image}" alt="${label} ${index + 1}" loading="lazy" decoding="async">
            </button>
        </div>
    `).join("");
});

/* ========================= */
/* PROJECTS GALLERY (HOVER) */
/* ========================= */
const projectCards = document.querySelectorAll(".project-card");
const lightbox = document.getElementById("project-lightbox");
const lightboxImage = document.getElementById("lightbox-image");
const lightboxCount = document.getElementById("lightbox-count");
const lightboxPrev = document.querySelector(".lightbox-prev");
const lightboxNext = document.querySelector(".lightbox-next");
const lightboxCloseButtons = document.querySelectorAll("[data-lightbox-close]");
let activeGallery = [];
let activeImageIndex = 0;
let lastFocusedElement = null;

function updateLightbox() {
    if (!lightboxImage || !lightboxCount || activeGallery.length === 0) return;

    lightboxImage.src = activeGallery[activeImageIndex];
    lightboxImage.alt = formatTranslation(getCopy().lightbox.imageAlt, {
        number: activeImageIndex + 1,
        total: activeGallery.length,
    });
    lightboxCount.textContent = `${activeImageIndex + 1} / ${activeGallery.length}`;
}

function openLightbox(images, startIndex = 0) {
    if (!lightbox || images.length === 0) return;

    activeGallery = images;
    activeImageIndex = startIndex;
    lastFocusedElement = document.activeElement;

    updateLightbox();
    lightbox.classList.add("is-open");
    lightbox.setAttribute("aria-hidden", "false");
    document.body.classList.add("lightbox-open");

    const closeButton = lightbox.querySelector(".lightbox-close");
    if (closeButton) {
        closeButton.focus();
    }
}

function closeLightbox() {
    if (!lightbox || !lightbox.classList.contains("is-open")) return;

    lightbox.classList.remove("is-open");
    lightbox.setAttribute("aria-hidden", "true");
    document.body.classList.remove("lightbox-open");

    if (lastFocusedElement) {
        lastFocusedElement.focus();
    }
}

function showLightboxImage(direction) {
    if (activeGallery.length === 0) return;

    activeImageIndex = (activeImageIndex + direction + activeGallery.length) % activeGallery.length;
    updateLightbox();
}

projectCards.forEach((card) => {
    const img = card.querySelector("img");
    const button = card.querySelector(".project-button");
    let images = [];

    try {
        images = JSON.parse(card.dataset.images);
    } catch (error) {
        images = img ? [img.src] : [];
    }

    const startIndex = Number(card.dataset.startIndex || 0);
    let currentIndex = Number.isNaN(startIndex) ? 0 : startIndex;
    let interval = null;

    function showNextImage() {
        if (!img || images.length === 0) return;

        currentIndex = (currentIndex + 1) % images.length;

        img.style.opacity = "0.4";

        setTimeout(() => {
            img.src = images[currentIndex];
            img.style.opacity = "1";
        }, 150);
    }

    if (button) {
        button.addEventListener("click", () => {
            openLightbox(images, currentIndex);
        });
    }

    card.addEventListener("mouseenter", () => {
        if (!interval) {
            interval = setInterval(showNextImage, 1200);
        }
    });

    card.addEventListener("mouseleave", () => {
        clearInterval(interval);
        interval = null;
    });
});

if (lightboxPrev) {
    lightboxPrev.addEventListener("click", () => showLightboxImage(-1));
}

if (lightboxNext) {
    lightboxNext.addEventListener("click", () => showLightboxImage(1));
}

lightboxCloseButtons.forEach((button) => {
    button.addEventListener("click", closeLightbox);
});

document.addEventListener("keydown", (event) => {
    if (!lightbox || !lightbox.classList.contains("is-open")) return;

    if (event.key === "Escape") {
        closeLightbox();
    }

    if (event.key === "ArrowLeft") {
        showLightboxImage(-1);
    }

    if (event.key === "ArrowRight") {
        showLightboxImage(1);
    }
});

applyLanguage(currentLanguage);

/* ========================= */
/* HERO TEXT ANIMATION */
/* ========================= */
const heroText = document.getElementById("hero-text");

if (heroText) {
    function changeText() {
        const phrases = getCopy().heroPhrases;

        heroText.classList.add("hero-out");

        setTimeout(() => {
            heroPhraseIndex = (heroPhraseIndex + 1) % phrases.length;
            heroText.textContent = phrases[heroPhraseIndex];

            heroText.classList.remove("hero-out");
            heroText.classList.add("hero-in");

            setTimeout(() => {
                heroText.classList.remove("hero-in");
            }, 600);
        }, 400);
    }

    setInterval(changeText, 2500);
}

/* ========================= */
/* INTRO VIDEO CONTROL */
/* ========================= */
const intro = document.getElementById("intro-video");
const video = document.getElementById("introVid");
const introSkip = document.getElementById("intro-skip");

if (intro && video) {
    let introClosed = false;
    const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    function closeIntro() {
        if (introClosed) return;
        introClosed = true;

        video.pause();
        intro.classList.add("fade-out");

        setTimeout(() => {
            intro.style.display = "none";
        }, 1000);
    }

    if (reduceMotion) {
        closeIntro();
    } else {
        video.addEventListener("ended", closeIntro);
        setTimeout(closeIntro, 6000);
    }

    if (introSkip) {
        introSkip.addEventListener("click", closeIntro);
    }
}
if ("serviceWorker" in navigator) {
    window.addEventListener("load", () => {
        navigator.serviceWorker.register("/service-worker.js")
            .catch((error) => console.log("Error Service Worker:", error));
    });
}
