<!DOCTYPE html>
<html lang="<?= $lang === 'kz' ? 'kk' : 'ru' ?>" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $siteConfig = require __DIR__ . '/../../../config/app.php'; ?>
    <title><?= $pageTitle ?? ($siteConfig['name'] . ' — Aqparat • Taldau • Senim') ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/assets/favicon-192.png">
    <link rel="apple-touch-icon" href="/assets/favicon-192.png">

    <!-- Meta Tags -->
    <?php if (isset($metaDescription)): ?>
        <meta name="description" content="<?= htmlspecialchars($metaDescription) ?>">
    <?php else: ?>
        <meta name="description" content="ZYNDAN.KZ — Қазақстанның ақпараттық-сараптамалық медиа порталы. Ақпарат • Талдау • Сенім.">
    <?php endif; ?>

    <!-- Open Graph -->
    <?php
    $_ogScheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ? 'https' : 'http';
    $_ogBaseUrl = $_ogScheme . '://' . ($_SERVER['HTTP_HOST'] ?? 'zyndan.kz');
    $_defaultOgImg = $_ogBaseUrl . '/assets/zyndan-logo.jpg';
    ?>
    <meta property="og:site_name" content="ZYNDAN.KZ">
    <meta property="og:type" content="website">
    <?php if (isset($ogTitle)): ?>
        <meta property="og:title" content="<?= htmlspecialchars($ogTitle) ?>">
        <meta property="og:description" content="<?= htmlspecialchars($ogDescription ?? '') ?>">
        <meta property="og:image" content="<?= $ogImage ?? $_defaultOgImg ?>">
        <meta property="og:url" content="<?= $ogUrl ?? ($_ogBaseUrl . $_SERVER['REQUEST_URI']) ?>">
    <?php else: ?>
        <meta property="og:title" content="ZYNDAN.KZ — Aqparat • Taldau • Senim">
        <meta property="og:description" content="Қазақстанның ақпараттық-сараптамалық жаңалықтар порталы">
        <meta property="og:image" content="<?= $_defaultOgImg ?>">
        <meta property="og:url" content="<?= $_ogBaseUrl . $_SERVER['REQUEST_URI'] ?>">
    <?php endif; ?>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Line Awesome Icons -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <!-- Fonts: Inter & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Theme Config (Чисто белый светлый фон) -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Inter"', 'system-ui', '-apple-system', 'sans-serif'],
                        heading: ['"Plus Jakarta Sans"', '"Inter"', 'sans-serif'],
                    },
                    colors: {
                        'zyndan-navy': '#101C31',
                        'zyndan-dark': '#0B1322',
                        'zyndan-red': '#D71920',
                        'zyndan-red-hover': '#B8141A',
                        'zyndan-gray': '#F5F6F8',
                        'zyndan-border': '#E5E7EB',
                        'zyndan-muted': '#626B78',
                    },
                    boxShadow: {
                        'zyndan-sm': '0 1px 2px 0 rgba(16, 28, 49, 0.05)',
                        'zyndan-card': '0 1px 3px 0 rgba(16, 28, 49, 0.06), 0 1px 2px -1px rgba(16, 28, 49, 0.06)',
                        'zyndan-hover': '0 8px 20px -4px rgba(16, 28, 49, 0.10)',
                    }
                }
            }
        }
    </script>

    <script>
        // Гарантированно чисто белый фон
        try {
            localStorage.clear();
            localStorage.setItem('theme', 'light');
            document.documentElement.classList.remove('dark');
            document.documentElement.classList.add('light');
        } catch (e) {}
    </script>

    <style>
        html, body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            -webkit-font-smoothing: antialiased;
            background-color: #FFFFFF !important;
            background: #FFFFFF !important;
            color: #101C31;
            overflow-x: hidden;
            max-width: 100vw;
        }

        /* Адаптивность контента внутри статей на мобильных */
        .article-body img,
        .article-body video,
        .article-body iframe {
            max-width: 100% !important;
            height: auto !important;
            border-radius: 0.5rem;
        }

        .article-body table {
            display: block;
            width: 100% !important;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .article-body p,
        .article-body h1,
        .article-body h2,
        .article-body h3,
        .article-body li {
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            color: inherit;
        }

        /* Заголовок и метаданные на Hero баннере всегда чисто белые без анимаций */
        .hero-white-title,
        .hero-overlay-title,
        .hero-white-title:hover,
        .hero-overlay-title:hover {
            color: #FFFFFF !important;
            transition: none !important;
            transform: none !important;
        }

        .hero-white-meta,
        .hero-overlay-meta,
        .hero-white-meta *,
        .hero-overlay-meta * {
            color: #FFFFFF !important;
        }

        /* Signature ZYNDAN Red Line styling */
        .zyndan-brand-line {
            height: 3px;
            background: linear-gradient(90deg, #101C31 0%, #101C31 35%, #D71920 35%, #D71920 65%, #101C31 65%, #101C31 100%);
        }

        .zyndan-red-tag {
            background-color: #D71920;
            color: #FFFFFF;
        }

        .zyndan-section-title {
            position: relative;
            display: inline-flex;
            align-items: center;
        }

        .zyndan-section-title::before {
            content: '';
            display: inline-block;
            width: 3px;
            height: 18px;
            background-color: #D71920;
            margin-right: 10px;
            border-radius: 1px;
            flex-shrink: 0;
        }

        /* Glass / Nav Blur */
        .glass-nav {
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }

        /* Logo image wrapper - displays original logo without cropping or changes */
        .zyndan-logo-wrapper {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #FFFFFF;
        }

        .zyndan-logo-wrapper img {
            height: 88px;
            width: auto;
            max-width: 100%;
            object-fit: contain;
            user-select: none;
        }

        @media (max-width: 640px) {
            .zyndan-logo-wrapper img {
                height: 60px;
            }
        }

        /* Navigation active underline */
        .zyndan-nav-link {
            position: relative;
            transition: color 0.2s ease;
        }

        .zyndan-nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2.5px;
            background-color: #D71920;
            transition: width 0.25s ease;
        }

        .zyndan-nav-link:hover::after,
        .zyndan-nav-link.active::after {
            width: 100%;
        }

        .zyndan-card {
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            border: 1px solid #E5E7EB;
        }

        .zyndan-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 22px -4px rgba(16, 28, 49, 0.08);
            border-color: #D1D5DB;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-white flex flex-col min-h-screen text-[#101C31] transition-colors duration-200" style="background-color: #FFFFFF !important;">

    <!-- === HEADER (BRAND ROW) === -->
    <header class="bg-white border-b border-zyndan-border transition-colors" style="background-color: #FFFFFF !important;">
        <div class="container mx-auto px-3 sm:px-4 py-2.5 sm:py-4 md:py-5 flex justify-between items-center">
            
            <!-- Левая часть: Фирменный логотип ZYNDAN.KZ -->
            <div class="flex items-center gap-4">
                <a href="<?= $lang === 'ru' ? '/ru/' : '/' ?>" class="inline-flex items-center group cursor-pointer focus:outline-none" title="ZYNDAN.KZ">
                    <div class="zyndan-logo-wrapper rounded-sm">
                        <img src="/assets/zyndan-logo.jpg?v=2" alt="ZYNDAN.KZ — Aqparat • Taldau • Senim">
                    </div>
                </a>
                
                <!-- Девиз / Слоган медиа -->
                <div class="hidden lg:block pl-4 border-l border-zyndan-border dark:border-white/10">
                    <div class="text-[10px] font-extrabold uppercase tracking-[0.2em] text-zyndan-navy dark:text-slate-200">
                        Aqparat <span class="text-zyndan-red">·</span> Taldau <span class="text-zyndan-red">·</span> Senim
                    </div>
                    <div class="text-[11px] text-zyndan-muted dark:text-slate-400 font-medium mt-0.5">
                        <?= $lang === 'ru' ? 'Информационно-аналитический портал' : 'Ақпараттық-сараптамалық портал' ?>
                    </div>
                </div>
            </div>

        </div>
    </header>