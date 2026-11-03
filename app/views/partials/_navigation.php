<?php
// Важно: переменные $categories, $siteConfig, $lang уже должны быть доступны из контроллера
$weather = $weather ?? ['temperature' => -5, 'condition' => 'Ашық аспан', 'icon' => '01d'];
$currency = $currency ?? ['usd_rate' => 502.50, 'eur_rate' => 545.20, 'rub_rate' => 5.40];

// Определяем текущий URL для подсветки активного пункта
$currentUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$currentUri = trim($currentUri, '/');
?>

<!-- === МЕНЮ НАВИГАЦИИ === -->
<nav class="glass-nav border-b border-zyndan-border dark:border-white/10 sticky top-0 z-50 transition-colors">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="flex justify-between items-center h-12 sm:h-14">
            
            <!-- Кнопка меню (Гамбургер / Три полоски) -->
            <button type="button" class="cursor-pointer py-2 pr-3 text-zyndan-navy hover:text-zyndan-red dark:text-slate-200 dark:hover:text-white transition-colors focus:outline-none flex items-center gap-2 min-h-[44px]" onclick="openMobileMenu()" aria-label="Мәзір">
                <i class="las la-bars text-2xl"></i>
                <span class="text-xs font-bold uppercase tracking-wider"><?= $lang === 'ru' ? 'Меню' : 'Мәзір' ?></span>
            </button>
            
            <!-- Правая панель: Поиск, Язык -->
            <div class="flex items-center space-x-2.5 sm:space-x-3 text-zyndan-muted pl-3 sm:pl-4 border-l border-zyndan-border">
                <!-- Поиск -->
                <button type="button" onclick="openSearchModal()" class="w-9 h-9 rounded-lg hover:bg-zyndan-gray flex items-center justify-center text-zyndan-navy hover:text-zyndan-red transition-colors focus:outline-none" title="<?= $lang === 'ru' ? 'Поиск (Ctrl+K)' : 'Іздеу (Ctrl+K)' ?>">
                    <i class="las la-search text-lg"></i>
                </button>
                
                <!-- Переключатель языка -->
                <?php
                $switchUrl = '/';
                if (isset($post) && !empty($post)) {
                    $targetLang = $lang === 'kz' ? 'ru' : 'kz';
                    $categorySlug = $post["slug_{$targetLang}"] ?? $post['category_slug'] ?? '';
                    $postSlug = $post["slug_{$targetLang}"] ?? '';
                    $switchUrl = (!empty($categorySlug) && !empty($postSlug))
                        ? ($targetLang === 'ru' ? '/ru/' : '/') . $categorySlug . '/' . $postSlug
                        : ($targetLang === 'ru' ? '/ru/' : '/');
                } elseif (isset($category) && !empty($category)) {
                    $targetLang = $lang === 'kz' ? 'ru' : 'kz';
                    $categorySlug = $category["slug_{$targetLang}"] ?? '';
                    $switchUrl = !empty($categorySlug) ? ($targetLang === 'ru' ? '/ru/' : '/') . $categorySlug : ($targetLang === 'ru' ? '/ru/' : '/');
                } else {
                    $switchUrl = $lang === 'kz' ? '/ru/' : '/';
                }
                ?>
                <a href="<?= $switchUrl ?>" class="px-2.5 py-1 text-[11px] font-bold tracking-wider rounded border border-zyndan-border hover:border-zyndan-red bg-zyndan-gray hover:bg-zyndan-red hover:text-white text-zyndan-navy transition-all uppercase">
                    <?= $lang === 'kz' ? 'РУС' : 'KAZ' ?>
                </a>
            </div>

        </div>
    </div>

    <!-- ФИРМЕННАЯ РАЗДЕЛИТЕЛЬНАЯ ЛИНИЯ ПОД ШАПКОЙ (ТЕМНО-СИНИЙ + КРАСНЫЙ АКЦЕНТ ПО МОТИВАМ ЛОГОТИПА) -->
    <div class="h-[2.5px] w-full flex">
        <div class="h-full bg-zyndan-navy flex-1"></div>
        <div class="h-full bg-zyndan-red w-32 md:w-56"></div>
        <div class="h-full bg-zyndan-navy flex-1"></div>
    </div>
</nav>

<script>
    function openSearchModal() {
        const modal = document.getElementById('searchModal');
        if (!modal) return;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            const input = document.getElementById('searchInput');
            if (input) input.focus();
        }, 100);
        document.body.style.overflow = 'hidden';
    }

    function closeSearchModal() {
        const modal = document.getElementById('searchModal');
        if (!modal) return;
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    function openMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        if (!menu) return;
        menu.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        if (!menu) return;
        menu.classList.add('hidden');
        document.body.style.overflow = '';
    }

    function toggleTheme() {
        try {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        } catch (e) {}
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeSearchModal();
            closeMobileMenu();
        }
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            openSearchModal();
        }
    });
</script>

<!-- Модальное окно поиска -->
<div id="searchModal" class="fixed inset-0 bg-zyndan-dark/80 backdrop-blur-md z-[100] hidden items-center justify-center p-4 transition-all" onclick="closeSearchModal()">
    <div class="bg-white dark:bg-zyndan-navy border border-zyndan-border dark:border-white/10 rounded-2xl shadow-2xl max-w-xl w-full p-6 md:p-8 transition-colors" onclick="event.stopPropagation()">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-zyndan-navy dark:text-white flex items-center gap-2.5">
                <span class="w-2 h-5 bg-zyndan-red rounded-none inline-block"></span>
                <?= $lang === 'kz' ? 'Сайт бойынша іздеу' : 'Поиск по сайту' ?>
            </h3>
            <button onclick="closeSearchModal()" class="w-8 h-8 rounded-lg bg-zyndan-gray hover:bg-zyndan-red hover:text-white dark:bg-white/10 transition flex items-center justify-center text-zyndan-muted focus:outline-none">
                <i class="las la-times text-lg"></i>
            </button>
        </div>
        <form action="/<?= $lang === 'ru' ? 'ru/' : '' ?>search" method="GET">
            <div class="relative mb-4">
                <i class="las la-search absolute left-4 top-1/2 -translate-y-1/2 text-zyndan-muted text-xl"></i>
                <input type="text" name="q" id="searchInput" placeholder="<?= $lang === 'kz' ? 'Іздеу сұранысын енгізіңіз...' : 'Введите поисковый запрос...' ?>"
                    class="w-full pl-12 pr-4 py-3.5 bg-zyndan-gray dark:bg-zyndan-dark border border-zyndan-border dark:border-white/10 rounded-xl text-black dark:text-white placeholder-zyndan-muted focus:outline-none focus:border-zyndan-red focus:ring-1 focus:ring-zyndan-red transition-all">
            </div>
            <button type="submit" class="w-full bg-zyndan-red hover:bg-zyndan-red-hover text-white font-bold py-3.5 rounded-xl shadow-md transition-all flex items-center justify-center gap-2 uppercase text-xs tracking-wider">
                <i class="las la-search text-base"></i> <?= $lang === 'kz' ? 'Іздеу' : 'Найти' ?>
            </button>
        </form>
    </div>
</div>

<!-- Мобильное меню (Выезжающая панель) -->
<div id="mobileMenu" class="fixed inset-0 bg-zyndan-dark/60 backdrop-blur-sm z-[90] hidden transition-all" onclick="closeMobileMenu()">
    <div class="bg-white dark:bg-zyndan-dark w-[85%] max-w-xs sm:max-w-sm h-[100dvh] p-4 sm:p-6 overflow-y-auto flex flex-col justify-between shadow-2xl" onclick="event.stopPropagation()">
        <div>
            <!-- Шапка мобильного меню с логотипом -->
            <div class="flex justify-between items-center mb-4 sm:mb-6 pb-3 sm:pb-4 border-b border-zyndan-border dark:border-white/10">
                <div class="zyndan-logo-wrapper">
                    <img src="/assets/zyndan-logo.jpg?v=2" alt="ZYNDAN.KZ" style="height: 48px; width: auto;">
                </div>
                <button onclick="closeMobileMenu()" class="w-9 h-9 rounded-lg bg-zyndan-gray dark:bg-white/10 hover:bg-zyndan-red hover:text-white transition flex items-center justify-center text-zyndan-navy dark:text-white focus:outline-none">
                    <i class="las la-times text-xl"></i>
                </button>
            </div>

            <!-- Поиск в мобильном меню -->
            <form action="/<?= $lang === 'ru' ? 'ru/' : '' ?>search" method="GET" class="mb-6">
                <div class="relative">
                    <input type="text" name="q" placeholder="<?= $lang === 'kz' ? 'Іздеу...' : 'Поиск...' ?>"
                        class="w-full pl-10 pr-4 py-2.5 bg-zyndan-gray dark:bg-zyndan-navy border border-zyndan-border dark:border-white/10 rounded-lg text-sm text-black dark:text-white placeholder-zyndan-muted focus:outline-none focus:border-zyndan-red">
                    <i class="las la-search absolute left-3 top-1/2 -translate-y-1/2 text-zyndan-muted text-lg"></i>
                </div>
            </form>

            <!-- Список разделов -->
            <div class="text-[11px] font-bold text-zyndan-muted uppercase tracking-wider mb-2 flex items-center gap-2">
                <span class="w-1.5 h-3 bg-zyndan-red"></span>
                <?= $lang === 'kz' ? 'Бөлімдер' : 'Разделы' ?>
            </div>

            <div class="space-y-1 mb-6">
                <a href="<?= $lang === 'ru' ? '/ru/' : '/' ?>" class="block px-3 py-2.5 rounded-lg text-sm font-semibold text-zyndan-navy dark:text-white hover:bg-zyndan-gray dark:hover:bg-white/5 hover:text-zyndan-red transition flex items-center justify-between">
                    <span><?= $lang === 'ru' ? 'Главная' : 'Басты бет' ?></span>
                    <i class="las la-angle-right text-xs text-zyndan-muted"></i>
                </a>

                <?php if (isset($categories) && !empty($categories)): ?>
                    <?php foreach ($categories as $cat): ?>
                        <?php
                        $catUrl = ($cat['slug'] === 'zhanalyqtar' || $cat['slug'] === 'novosti')
                            ? ($lang === 'ru' ? '/ru/' : '/')
                            : '/' . ($lang === 'ru' ? 'ru/' : '') . $cat['slug'];
                        ?>
                        <a href="<?= $catUrl ?>" class="block px-3 py-2.5 rounded-lg text-sm font-semibold text-zyndan-navy dark:text-white hover:bg-zyndan-gray dark:hover:bg-white/5 hover:text-zyndan-red transition flex items-center justify-between">
                            <span><?= htmlspecialchars($cat['name']) ?></span>
                            <i class="las la-angle-right text-xs text-zyndan-muted"></i>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>

                <a href="/<?= ($lang === 'ru' ? 'ru/' : '') ?>ads" class="block px-3 py-2.5 rounded-lg text-sm font-semibold text-zyndan-navy dark:text-white hover:bg-zyndan-gray dark:hover:bg-white/5 hover:text-zyndan-red transition flex items-center justify-between">
                    <span><?= $lang === 'ru' ? 'Реклама' : 'Жарнама' ?></span>
                    <i class="las la-angle-right text-xs text-zyndan-muted"></i>
                </a>
            </div>
        </div>

        <!-- Подвал мобильного меню: Контакты и соцсети -->
        <div class="pt-6 border-t border-zyndan-border dark:border-white/10 text-xs">
            <div class="text-zyndan-muted font-medium mb-3">
                <?= $siteConfig['phone'] ?? '+77470645196' ?><br>
                <?= $siteConfig['contact_email'] ?? 'editor@zyndan.kz' ?>
            </div>
            <div class="flex gap-2">
                <a href="<?= $siteConfig['social_instagram'] ?? 'https://www.instagram.com/zyndan.kz?utm_source=qr&dlrf=b3l2c3V0aHc3cnZ3' ?>" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-zyndan-gray dark:bg-white/5 flex items-center justify-center text-zyndan-navy dark:text-white hover:bg-zyndan-red hover:text-white transition" title="Instagram">
                    <i class="lab la-instagram text-lg"></i>
                </a>
                <a href="<?= $siteConfig['social_facebook'] ?? 'https://www.facebook.com/people/Zyndan-KZ/pfbid02sXeGgRiiUymaiPHdx6LAw28LTstctiAbjSmXbrn9g95uC89JVM3Pptbf8eG6aYNRl/?rdid=dJfw75vxvx0rvdfP&share_url=https%3A%2F%2Fwww.facebook.com%2Fshare%2F19nmaGHaF2%2F%3Fref%3D1' ?>" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-zyndan-gray dark:bg-white/5 flex items-center justify-center text-zyndan-navy dark:text-white hover:bg-zyndan-red hover:text-white transition" title="Facebook">
                    <i class="lab la-facebook-f text-lg"></i>
                </a>
                <a href="<?= $siteConfig['social_threads'] ?? 'https://www.threads.com/@zyndan.kz' ?>" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-zyndan-gray dark:bg-white/5 flex items-center justify-center text-zyndan-navy dark:text-white hover:bg-zyndan-red hover:text-white transition" title="Threads">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 192 192" xmlns="http://www.w3.org/2000/svg"><path d="M141.537 88.988a66.667 66.667 0 0 0-2.518-1.143c-1.482-27.307-16.403-42.94-41.457-43.1h-.34c-14.986 0-27.449 6.396-35.12 18.036l13.779 9.452c5.73-8.695 14.724-10.548 21.348-10.548h.229c8.249.053 14.474 2.452 18.503 7.129 2.932 3.405 4.893 8.111 5.864 14.05-7.314-1.243-15.224-1.626-23.68-1.14-23.82 1.371-39.134 15.264-38.105 34.568.522 9.792 5.4 18.216 13.735 23.719 7.047 4.652 16.124 6.927 25.557 6.412 12.458-.683 22.231-5.436 29.049-14.127 5.178-6.6 8.453-15.153 9.899-25.93 5.937 3.583 10.337 8.298 12.767 13.966 4.132 9.635 4.373 25.468-8.546 38.376-11.319 11.308-24.925 16.2-45.488 16.351-22.809-.169-40.06-7.484-51.275-21.742C35.236 139.966 29.808 120.682 29.605 96c.203-24.682 5.63-43.966 16.133-57.317C56.954 24.425 74.204 17.11 97.013 16.94c22.975.17 40.526 7.52 52.171 21.847 5.71 7.026 10.015 15.86 12.853 26.162l16.147-4.308c-3.44-12.68-8.853-23.606-16.219-32.668C147.036 9.607 125.202.195 97.07 0h-.113C68.882.195 47.292 9.642 32.788 28.08 19.882 44.485 13.224 67.315 13.001 95.932L13 96v.067c.224 28.617 6.882 51.447 19.788 67.854C47.292 182.358 68.882 191.805 96.957 192h.113c24.96-.173 42.554-6.708 57.048-21.19 18.963-18.945 18.392-42.692 12.142-57.27-4.484-10.454-13.033-18.945-24.723-24.552Zm-43.096 40.519c-10.44.588-21.286-4.098-21.82-14.135-.397-7.442 5.296-15.746 22.461-16.735 1.966-.113 3.895-.169 5.79-.169 6.235 0 12.068.606 17.371 1.765-1.978 24.702-13.58 28.713-23.802 29.274Z"/></svg>
                </a>
                <a href="<?= $siteConfig['social_whatsapp'] ?? 'https://wa.me/77470645196' ?>" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-zyndan-gray dark:bg-white/5 flex items-center justify-center text-emerald-600 hover:bg-emerald-600 hover:text-white transition" title="WhatsApp">
                    <i class="lab la-whatsapp text-lg"></i>
                </a>
            </div>
        </div>
    </div>
</div>