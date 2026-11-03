<?php
/**
 * Страница результатов поиска
 * ZYNDAN.KZ
 */

$pageTitle = ($lang === 'kz' ? 'Іздеу нәтижелері' : 'Результаты поиска') . ' — ZYNDAN.KZ';
require_once __DIR__ . '/../partials/_header.php';
require_once __DIR__ . '/../partials/_navigation.php';
?>

<main class="container mx-auto px-4 py-8 md:py-12">

    <!-- Заголовок поиска -->
    <div class="mb-10 pb-6 border-b border-zyndan-border">
        <div class="flex items-center gap-2.5 mb-2">
            <span class="w-2.5 h-6 bg-zyndan-red inline-block"></span>
            <span class="text-xs font-bold uppercase tracking-widest text-zyndan-muted"><?= $lang === 'kz' ? 'Іздеу қызметі' : 'Служба поиска' ?></span>
        </div>
        <h1 class="text-2xl md:text-4xl font-black text-zyndan-navy dark:text-white tracking-tight mb-3">
            <?= $lang === 'kz' ? 'Іздеу нәтижелері' : 'Результаты поиска' ?>
        </h1>

        <?php if (!empty($query)): ?>
            <p class="text-sm text-zyndan-muted font-medium">
                <?= $lang === 'kz' ? 'Сұраныс бойынша' : 'По запросу' ?>:
                <span class="text-zyndan-navy dark:text-white font-bold">"<?= htmlspecialchars($query) ?>"</span>
            </p>

            <?php if (isset($totalResults)): ?>
                <p class="text-xs text-zyndan-red font-bold uppercase tracking-wider mt-2 font-mono">
                    <?= $lang === 'kz'
                        ? "Табылды: {$totalResults} мақала"
                        : "Найдено: {$totalResults} материалов" ?>
                </p>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- Ошибка (минимум символов) -->
    <?php if (isset($error)): ?>
        <div class="bg-amber-50 border-l-4 border-zyndan-red p-4 rounded-r-xl mb-8">
            <div class="flex items-center gap-3">
                <i class="las la-exclamation-triangle text-zyndan-red text-xl"></i>
                <p class="text-xs font-bold text-amber-900">
                    <?= htmlspecialchars($error) ?>
                </p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Результаты -->
    <?php if (!empty($results)): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            <?php foreach ($results as $post): ?>
                <?php
                $postTitle = $lang === 'kz' ? ($post['title_kz'] ?? $post['title_ru']) : ($post['title_ru'] ?? $post['title_kz']);
                $postExcerpt = $lang === 'kz' ? ($post['excerpt_kz'] ?? $post['excerpt_ru']) : ($post['excerpt_ru'] ?? $post['excerpt_kz']);
                $postSlug = $lang === 'kz' ? $post['slug_kz'] : $post['slug_ru'];
                $categorySlug = $post['category_slug'] ?? '';
                $postImage = !empty($post['image']) ? '/uploads/medium/' . $post['image'] : 'https://placehold.co/400x300/101c31/FFF?text=ZYNDAN.KZ';
                ?>

                <!-- Карточка новости -->
                <a href="/<?= $lang === 'ru' ? 'ru/' : '' ?><?= $categorySlug ?>/<?= $postSlug ?>"
                    class="bg-white dark:bg-zyndan-navy border border-zyndan-border zyndan-card group cursor-pointer rounded-xl overflow-hidden flex flex-col">
                    <div class="relative h-48 overflow-hidden bg-zyndan-gray">
                        <img src="<?= $postImage ?>" alt="<?= htmlspecialchars($postTitle) ?>"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 right-3 bg-zyndan-navy/90 text-white text-[10px] font-bold px-2 py-0.5 rounded shadow-sm tracking-wider uppercase flex items-center gap-1 font-mono">
                            <i class="las la-eye text-zyndan-red"></i>
                            <?= number_format($post['views'] ?? 0) ?>
                        </span>
                    </div>
                    <div class="p-5 flex flex-col flex-1 justify-between">
                        <div>
                            <div class="text-[11px] font-semibold text-zyndan-muted mb-2 flex items-center gap-1.5 uppercase tracking-wider font-mono">
                                <i class="las la-calendar text-zyndan-red text-sm"></i>
                                <?= date('d.m.Y', strtotime($post['published_at'])) ?>
                            </div>
                            <h3 class="text-base font-bold leading-snug text-black dark:text-white group-hover:text-zyndan-red transition-colors mb-2 line-clamp-2">
                                <?= htmlspecialchars($postTitle) ?>
                            </h3>
                            <p class="text-xs text-zyndan-muted line-clamp-2 leading-relaxed">
                                <?= htmlspecialchars($postExcerpt ?? '') ?>
                            </p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Пагинация -->
        <?php if (isset($totalPages) && $totalPages > 1): ?>
            <div class="mt-12 flex justify-center">
                <nav class="flex items-center gap-1.5">
                    <?php if ($currentPage > 1): ?>
                        <a href="?q=<?= urlencode($query) ?>&page=<?= $currentPage - 1 ?>"
                            class="px-4 py-2 bg-white border border-zyndan-border rounded-lg hover:border-zyndan-red hover:text-zyndan-red transition text-zyndan-navy font-bold text-xs uppercase tracking-wider">
                            <i class="las la-angle-left mr-1"></i>
                        </a>
                    <?php endif; ?>

                    <div class="flex gap-1.5">
                        <?php for ($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++): ?>
                            <a href="?q=<?= urlencode($query) ?>&page=<?= $i ?>"
                                class="w-10 h-10 flex items-center justify-center rounded-lg transition font-bold text-xs border <?= $i === $currentPage ? 'bg-zyndan-red text-white border-zyndan-red shadow-sm' : 'bg-white border-zyndan-border hover:border-zyndan-red text-zyndan-navy' ?>">
                                <?= $i ?>
                            </a>
                        <?php endfor; ?>
                    </div>

                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?q=<?= urlencode($query) ?>&page=<?= $currentPage + 1 ?>"
                            class="px-4 py-2 bg-white border border-zyndan-border rounded-lg hover:border-zyndan-red hover:text-zyndan-red transition text-zyndan-navy font-bold text-xs uppercase tracking-wider">
                            <i class="las la-angle-right ml-1"></i>
                        </a>
                    <?php endif; ?>
                </nav>
            </div>
        <?php endif; ?>

    <?php elseif (!isset($error)): ?>
        <!-- Ничего не найдено -->
        <div class="text-center py-20 bg-slate-50 rounded-2xl border border-slate-200">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-white border border-slate-200 rounded-3xl mb-6 shadow-sm">
                <i class="las la-search text-4xl text-slate-300"></i>
            </div>
            <h3 class="text-2xl font-bold text-slate-900 mb-3 tracking-tight">
                <?= $lang === 'kz' ? 'Ештеңе табылмады' : 'Ничего не найдено' ?>
            </h3>
            <p class="text-slate-500 font-medium max-w-md mx-auto">
                <?= $lang === 'kz'
                    ? 'Бұл сұраныс бойынша мақалалар табылмады. Басқа сөздерді қолданып көріңіз.'
                    : 'По вашему запросу ничего не найдено. Попробуйте использовать другие слова.' ?>
            </p>
            <a href="/"
                class="inline-flex items-center gap-2 mt-8 text-slate-900 font-bold uppercase tracking-widest text-xs hover:text-slate-600 transition-colors">
                <i class="las la-arrow-left"></i>
                <?= $lang === 'kz' ? 'Басты бетке' : 'На главную' ?>
            </a>
        </div>
    <?php endif; ?>

</main>

<?php require_once __DIR__ . '/../partials/_footer.php'; ?>