<?php
/**
 * Страница чтения новости (Single Post)
 * ZYNDAN.KZ — Editorial style
 */

// 1. Подготовка данных
$tLang = $lang === 'kz' ? 'kz' : 'ru';
$postTitle = $post['title_' . $tLang] ?? $post['title_ru'];
$postContent = $post['content_' . $tLang] ?? $post['content_ru'];
$postExcerpt = $post['excerpt_' . $tLang] ?? $post['excerpt_ru'];
$postDate = strtotime($post['published_at']);
$categoryName = $post['category_name'] ?? 'Ақпарат';

// SEO Metas
$pageTitle = htmlspecialchars($postTitle) . ' — ZYNDAN.KZ';
$metaDescription = mb_substr(strip_tags($postExcerpt), 0, 160);

// Open Graph
$ogTitle = htmlspecialchars($postTitle);
$ogImage = !empty($post['image']) ? 'https://zyndan.kz/uploads/large/' . $post['image'] : 'https://zyndan.kz/assets/zyndan-logo.jpg';
$ogUrl = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

require_once __DIR__ . '/../partials/_header.php';
require_once __DIR__ . '/../partials/_navigation.php';

// Хелпер для картинок
function getPostImg($img)
{
    return !empty($img) ? "/uploads/large/$img" : null;
}
?>

<!-- === PROGRESS BAR (КРАСНЫЙ ФИРМЕННЫЙ ИНДИКАТОР ЧТЕНИЯ) === -->
<div class="fixed top-0 left-0 w-full h-[3px] z-[60] bg-transparent pointer-events-none">
    <div id="scrollProgress" class="h-full bg-zyndan-red w-0 transition-all duration-75 shadow-sm"></div>
</div>

<main class="container mx-auto px-3 sm:px-4 py-4 sm:py-6 lg:py-10">

    <!-- Хлебные крошки -->
    <nav class="flex flex-wrap items-center gap-1.5 sm:gap-2 text-[11px] font-bold text-zyndan-muted mb-4 sm:mb-6 uppercase tracking-wider">
        <a href="<?= $lang === 'ru' ? '/ru/' : '/' ?>" class="hover:text-zyndan-red transition flex items-center gap-1.5">
            <i class="las la-home text-sm mb-0.5"></i> <?= $lang === 'kz' ? 'Басты бет' : 'Главная' ?>
        </a>
        <i class="las la-angle-right text-xs text-zyndan-border mx-1"></i>
        <a href="/<?= $lang === 'ru' ? 'ru/' : '/' ?><?= $post['category_slug'] ?? 'news' ?>"
            class="hover:text-zyndan-red transition text-zyndan-navy dark:text-white font-bold flex items-center gap-1.5">
            <span class="w-1.5 h-1.5 rounded-full bg-zyndan-red"></span>
            <?= htmlspecialchars($categoryName) ?>
        </a>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 lg:gap-12">

        <!-- === ЛЕВАЯ КОЛОНКА (СТАТЬЯ) === -->
        <article class="lg:col-span-8">

            <!-- Заголовок -->
            <header class="mb-6 sm:mb-8">
                <!-- Категория бейдж -->
                <div class="mb-3 sm:mb-4">
                    <span class="inline-block bg-zyndan-navy text-white text-[10px] sm:text-[11px] font-extrabold uppercase tracking-widest px-2.5 sm:px-3 py-1 rounded-sm">
                        <?= htmlspecialchars($categoryName) ?>
                    </span>
                </div>

                <h1 class="text-xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-zyndan-navy dark:text-white leading-[1.25] sm:leading-[1.2] mb-4 sm:mb-6 tracking-tight">
                    <?= htmlspecialchars($postTitle) ?>
                </h1>

                <!-- Мета-строка -->
                <div class="flex flex-wrap items-center justify-between border-y border-zyndan-border py-3 sm:py-4 gap-3 sm:gap-4 text-xs">
                    <div class="flex items-center gap-3">
                        <div class="zyndan-logo-wrapper rounded border border-zyndan-border p-0.5 bg-white">
                            <img src="/assets/zyndan-logo.jpg?v=2" alt="ZYNDAN.KZ" style="height: 44px; width: auto;">
                        </div>
                        <div class="leading-tight pl-2 border-l border-zyndan-border">
                            <div class="font-bold text-zyndan-navy dark:text-white text-xs">ZYNDAN.KZ</div>
                            <div class="text-[11px] text-zyndan-muted font-medium flex items-center gap-1.5 mt-0.5 font-mono">
                                <i class="las la-clock text-zyndan-red text-sm"></i> <?= date('d.m.Y, H:i', $postDate) ?>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <div class="text-[11px] font-bold text-zyndan-muted uppercase tracking-wider mr-1 hidden sm:block">
                            <?= $lang === 'kz' ? 'Бөлісу:' : 'Поделиться:' ?>
                        </div>
                        <a href="https://api.whatsapp.com/send?text=<?= urlencode($postTitle . ' ' . $ogUrl) ?>"
                            target="_blank"
                            class="w-9 h-9 rounded-lg bg-zyndan-gray dark:bg-white/5 text-zyndan-muted hover:bg-emerald-600 hover:text-white flex items-center justify-center transition-all border border-zyndan-border" title="WhatsApp">
                            <i class="lab la-whatsapp text-lg"></i>
                        </a>
                        <a href="https://t.me/share/url?url=<?= urlencode($ogUrl) ?>&text=<?= urlencode($postTitle) ?>"
                            target="_blank"
                            class="w-9 h-9 rounded-lg bg-zyndan-gray dark:bg-white/5 text-zyndan-muted hover:bg-zyndan-red hover:text-white flex items-center justify-center transition-all border border-zyndan-border" title="Telegram">
                            <i class="lab la-telegram-plane text-lg"></i>
                        </a>
                    </div>
                </div>
            </header>

            <!-- Главное фото -->
            <?php if ($imgSrc = getPostImg($post['image'])): ?>
                <figure class="mb-8 rounded-xl overflow-hidden shadow-zyndan-sm border border-zyndan-border bg-zyndan-gray">
                    <img src="<?= $imgSrc ?>" class="w-full h-auto object-cover" alt="<?= htmlspecialchars($postTitle) ?>">
                </figure>
            <?php endif; ?>

            <!-- ТЕЛО СТАТЬИ -->
            <div class="article-content text-black dark:text-slate-200 text-[15px] sm:text-[17px] md:text-[18px] leading-[1.75] sm:leading-[1.8] font-normal space-y-4 sm:space-y-6 overflow-hidden">
                <div class="article-body">
                    <?= $postContent ?>
                </div>
            </div>

            <!-- Теги и категория -->
            <div class="mt-8 sm:mt-10 pt-5 sm:pt-6 border-t border-zyndan-border flex items-center gap-3 flex-wrap">
                <span class="text-xs font-bold text-zyndan-muted uppercase tracking-wider"><?= $lang === 'kz' ? 'Айдарлар:' : 'Рубрика:' ?></span>
                <a href="/<?= $lang === 'ru' ? 'ru/' : '' ?><?= $post['category_slug'] ?>"
                    class="bg-zyndan-gray dark:bg-white/5 border border-zyndan-border hover:border-zyndan-red transition px-3 py-1.5 rounded-lg text-xs font-bold text-zyndan-navy dark:text-white uppercase tracking-wider flex items-center gap-1.5 shadow-sm">
                    <span class="w-1.5 h-1.5 bg-zyndan-red rounded-full"></span>
                    <?= htmlspecialchars($categoryName) ?>
                </a>
            </div>

            <!-- === БЛОК КОММЕНТАРИЕВ === -->
            <section class="mt-10 sm:mt-14" id="comments">
                <div class="bg-zyndan-gray dark:bg-zyndan-navy/60 border border-zyndan-border dark:border-white/10 rounded-2xl p-4 sm:p-6 md:p-8 shadow-sm">

                    <h3 class="text-lg sm:text-xl font-black text-zyndan-navy dark:text-white mb-5 sm:mb-6 flex flex-wrap items-center gap-2.5 sm:gap-3 tracking-tight">
                        <span class="w-1.5 h-5 bg-zyndan-red rounded-none inline-block"></span>
                        <i class="las la-comments text-zyndan-red text-2xl"></i>
                        <?= $lang === 'kz' ? 'Пікірлер' : 'Обсуждение материала' ?>
                        <span class="bg-white dark:bg-zyndan-dark text-zyndan-navy dark:text-white text-xs font-bold px-2 py-0.5 rounded border border-zyndan-border">
                            <?= count($comments ?? []) ?>
                        </span>
                    </h3>

                    <!-- Уведомления -->
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="mb-4 text-sm text-emerald-800 bg-emerald-50 p-4 rounded-xl border border-emerald-200 font-medium">
                            <?= $_SESSION['success'] ?> <?php unset($_SESSION['success']); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Форма -->
                    <form action="/post/submitComment" method="POST" class="mb-8 relative">
                        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">

                        <div class="mb-4 relative">
                            <i class="las la-user absolute left-4 top-1/2 -translate-y-1/2 text-zyndan-muted text-lg"></i>
                            <input type="text" name="author_name" required
                                placeholder="<?= $lang === 'kz' ? 'Сіздің атыңыз' : 'Ваше имя' ?>"
                                class="w-full rounded-xl border border-zyndan-border bg-white dark:bg-zyndan-dark text-black dark:text-white placeholder-zyndan-muted focus:border-zyndan-red focus:ring-1 focus:ring-zyndan-red shadow-sm transition-all pl-12 py-3 text-sm">
                        </div>

                        <div class="relative mb-4">
                            <i class="las la-pen absolute left-4 top-4 text-zyndan-muted text-lg"></i>
                            <textarea name="comment_text" required rows="3"
                                placeholder="<?= $lang === 'kz' ? 'Өз пікіріңізді жазыңыз...' : 'Напишите ваш комментарий...' ?>"
                                class="w-full rounded-xl border border-zyndan-border bg-white dark:bg-zyndan-dark text-black dark:text-white placeholder-zyndan-muted focus:border-zyndan-red focus:ring-1 focus:ring-zyndan-red shadow-sm transition-all pl-12 py-3 text-sm"></textarea>
                        </div>

                        <button type="submit"
                            class="bg-zyndan-red hover:bg-zyndan-red-hover text-white font-bold text-xs px-7 py-3.5 rounded-xl transition-all shadow-md w-full md:w-auto flex items-center justify-center gap-2 tracking-wider uppercase">
                            <i class="las la-paper-plane text-base"></i> <?= $lang === 'kz' ? 'Пікір жіберу' : 'Отправить комментарий' ?>
                        </button>
                    </form>

                    <!-- Список комментов -->
                    <div class="space-y-4">
                        <?php if (!empty($comments)):
                            foreach ($comments as $comment): ?>
                                <div class="flex gap-3 bg-white dark:bg-zyndan-dark p-4 rounded-xl border border-zyndan-border">
                                    <div class="flex-shrink-0 w-9 h-9 rounded-full bg-zyndan-navy text-white flex items-center justify-center font-bold text-sm uppercase select-none">
                                        <?= mb_substr($comment['author_name'], 0, 1) ?>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="font-bold text-zyndan-navy dark:text-white text-sm">
                                                <?= htmlspecialchars($comment['author_name']) ?>
                                            </span>
                                            <span class="text-[10px] font-mono text-zyndan-muted uppercase">
                                                · <?= date('d.m.Y H:i', strtotime($comment['created_at'])) ?>
                                            </span>
                                        </div>
                                        <p class="text-xs sm:text-sm text-slate-700 dark:text-slate-300 leading-relaxed">
                                            <?= nl2br(htmlspecialchars($comment['comment_text'])) ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; else: ?>
                            <p class="text-center text-xs text-zyndan-muted italic py-3">
                                <?= $lang === 'kz' ? 'Әзірге пікір жоқ. Алғашқы болыңыз!' : 'Комментариев пока нет. Будьте первым!' ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

        </article>

        <!-- === ПРАВАЯ КОЛОНКА (SIDEBAR) === -->
        <aside class="lg:col-span-4 space-y-8">
            <div class="sticky top-20">

                <!-- Виджет: По теме -->
                <div class="bg-white dark:bg-zyndan-navy rounded-xl border border-zyndan-border shadow-zyndan-sm p-6 overflow-hidden">
                    <h3 class="font-black text-base text-zyndan-navy dark:text-white mb-5 flex items-center gap-2.5">
                        <span class="w-1.5 h-4 bg-zyndan-red rounded-none inline-block"></span>
                        <?= $lang === 'kz' ? 'Ұқсас жаңалықтар' : 'Читайте также' ?>
                    </h3>

                    <div class="divide-y divide-zyndan-border/60">
                        <?php if (isset($relatedPosts) && !empty($relatedPosts)):
                            foreach (array_slice($relatedPosts, 0, 4) as $rel):
                                $rTitle = $lang === 'kz' ? $rel['title_kz'] : $rel['title_ru'];
                                $rLink = "/" . ($lang === 'ru' ? 'ru/' : '') . ($rel['category_slug'] ?? 'news') . "/" . ($lang === 'kz' ? $rel['slug_kz'] : $rel['slug_ru']);
                                $rImg = !empty($rel['image']) ? "/uploads/thumbnail/" . $rel['image'] : null;
                                ?>
                                <a href="<?= $rLink ?>" class="flex gap-3 group py-3.5 transition-colors">
                                    <?php if ($rImg): ?>
                                        <img src="<?= $rImg ?>" class="w-16 h-16 rounded-lg object-cover flex-shrink-0 bg-zyndan-gray border border-zyndan-border group-hover:scale-105 transition-transform">
                                    <?php endif; ?>
                                    <div class="flex flex-col justify-center">
                                        <h4 class="text-xs font-semibold leading-snug text-black dark:text-slate-200 group-hover:text-zyndan-red transition-colors line-clamp-2">
                                            <?= htmlspecialchars($rTitle) ?>
                                        </h4>
                                        <span class="text-[10px] text-zyndan-muted mt-1.5 font-mono font-medium flex items-center gap-1">
                                            <i class="las la-clock text-zyndan-red"></i> <?= date('d.m.Y', strtotime($rel['published_at'])) ?>
                                        </span>
                                    </div>
                                </a>
                            <?php endforeach; else: ?>
                            <div class="text-xs text-zyndan-muted py-2"><?= $lang === 'ru' ? 'Новостей пока нет' : 'Жаңалықтар жоқ' ?></div>
                        <?php endif; ?>
                    </div>

                    <a href="/<?= $lang === 'ru' ? 'ru/' : '' ?><?= $post['category_slug'] ?? '' ?>"
                        class="block mt-5 text-center text-xs font-bold uppercase tracking-wider text-zyndan-navy hover:text-white border border-zyndan-border hover:bg-zyndan-navy py-2.5 rounded-lg bg-zyndan-gray transition-all shadow-sm">
                        <?= $lang === 'kz' ? 'Барлығын көру' : 'Все материалы' ?> <i class="las la-arrow-right text-xs ml-1"></i>
                    </a>
                </div>

                <!-- РЕКЛАМА В САЙДБАРЕ -->
                <?php
                $adsToShow = !empty($sidebarAds) ? $sidebarAds : (!empty($contentAds) ? $contentAds : null);
                if ($adsToShow): ?>
                    <div class="mt-6 bg-zyndan-gray rounded-xl border border-zyndan-border p-4 text-center">
                        <div class="text-[10px] font-bold text-zyndan-muted uppercase tracking-widest mb-3 flex items-center justify-center gap-1.5">
                            <i class="las la-ad text-sm"></i> <?= $lang === 'kz' ? 'Жарнама' : 'Реклама' ?>
                        </div>
                        <?php
                        $ads = $adsToShow;
                        require __DIR__ . '/../partials/_ads.php';
                        ?>
                    </div>
                <?php endif; ?>

            </div>
        </aside>

    </div>
</main>

<script>
    // JS: Прогресс бар чтения
    window.addEventListener('scroll', () => {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        document.getElementById("scrollProgress").style.width = scrolled + "%";
    });
</script>

<?php require_once __DIR__ . '/../partials/_footer.php'; ?>