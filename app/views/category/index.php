<?php
// Страница категории - Informnews.kz
// Подключаем header
require_once __DIR__ . '/../partials/_header.php';
?>

<!-- Подключаем навигацию -->
<?php require_once __DIR__ . '/../partials/_navigation.php'; ?>

<!-- === BREADCRUMBS === -->
<div class="bg-zyndan-gray border-b border-zyndan-border">
    <div class="container mx-auto px-4 py-3.5">
        <div class="flex items-center text-[11px] font-bold text-zyndan-muted uppercase tracking-wider">
            <a href="/<?= $lang === 'ru' ? 'ru/' : '' ?>" class="hover:text-zyndan-red transition-colors flex items-center gap-1.5">
                <i class="las la-home text-sm"></i> <?= $lang === 'kz' ? 'Басты бет' : 'Главная' ?>
            </a>
            <i class="las la-angle-right mx-2 text-zyndan-border text-xs"></i>
            <span class="text-zyndan-navy dark:text-white font-bold flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 bg-zyndan-red rounded-full"></span>
                <?= htmlspecialchars($category['name'] ?? '') ?>
            </span>
        </div>
    </div>
</div>

<!-- === CATEGORY HEADER === -->
<div class="bg-white dark:bg-zyndan-navy border-b border-zyndan-border py-6 sm:py-10 md:py-14">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="flex items-center gap-2 mb-2">
            <span class="w-2.5 h-6 bg-zyndan-red inline-block"></span>
            <span class="text-xs font-bold uppercase tracking-widest text-zyndan-muted"><?= $lang === 'ru' ? 'Рубрика' : 'Бөлім' ?></span>
        </div>
        <h1 class="text-2xl sm:text-3xl md:text-5xl font-black mb-2 sm:mb-3 tracking-tight text-zyndan-navy dark:text-white">
            <?= htmlspecialchars($category['name'] ?? '') ?>
        </h1>
        <?php if (!empty($category['description'])): ?>
            <p class="text-sm sm:text-base text-zyndan-muted font-normal max-w-2xl leading-relaxed">
                <?= htmlspecialchars($category['description']) ?>
            </p>
        <?php endif; ?>
    </div>
</div>

<!-- === POSTS GRID === -->
<main class="container mx-auto px-3 sm:px-4 py-6 sm:py-10">
    <?php if (isset($posts) && !empty($posts)): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 md:gap-8 mb-8 sm:mb-10">
            <?php foreach ($posts as $post): ?>
                <?php
                $postTitle = $lang === 'kz' ? $post['title_kz'] : $post['title_ru'];
                $postExcerpt = $lang === 'kz' ? $post['excerpt_kz'] : $post['excerpt_ru'];
                $postSlug = $lang === 'kz' ? $post['slug_kz'] : $post['slug_ru'];
                $postCategory = $category['slug'] ?? 'aqparat';
                $postImage = !empty($post['image'])
                    ? '/uploads/medium/' . $post['image']
                    : 'https://placehold.co/400x300/101c31/FFF?text=ZYNDAN.KZ';
                $postDate = date('d.m.Y H:i', strtotime($post['published_at'] ?? 'now'));
                ?>
                <a href="/<?= $lang === 'ru' ? 'ru/' : '' ?><?= $postCategory ?>/<?= $postSlug ?>"
                    class="bg-white dark:bg-zyndan-navy border border-zyndan-border zyndan-card group cursor-pointer rounded-xl overflow-hidden flex flex-col">
                    <div class="relative h-52 overflow-hidden bg-zyndan-gray">
                        <img src="<?= $postImage ?>"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            alt="<?= htmlspecialchars($postTitle) ?>">
                        <span class="absolute top-3 right-3 bg-zyndan-navy/90 text-white text-[10px] font-bold px-2 py-0.5 rounded shadow-sm tracking-wider uppercase flex items-center gap-1 font-mono">
                            <i class="las la-eye text-zyndan-red"></i>
                            <?= number_format($post['views'] ?? 0) ?>
                        </span>
                    </div>
                    <div class="p-6 flex flex-col flex-1 justify-between">
                        <div>
                            <div class="text-[11px] font-semibold text-zyndan-muted mb-2.5 flex items-center gap-1.5 uppercase tracking-wider font-mono">
                                <i class="las la-calendar text-zyndan-red text-sm"></i>
                                <?= $postDate ?>
                            </div>
                            <h3 class="text-lg font-bold leading-snug text-black dark:text-white group-hover:text-zyndan-red transition-colors mb-3 line-clamp-2">
                                <?= htmlspecialchars($postTitle) ?>
                            </h3>
                            <p class="text-xs text-zyndan-muted line-clamp-3 leading-relaxed mb-4">
                                <?= htmlspecialchars($postExcerpt ?? '') ?>
                            </p>
                        </div>
                        <div class="pt-3 border-t border-zyndan-border/60 flex items-center justify-end text-xs text-zyndan-red font-semibold group-hover:translate-x-1 transition-transform">
                            <?= $lang === 'ru' ? 'Читать' : 'Оқу' ?> <i class="las la-angle-right ml-1"></i>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- === PAGINATION === -->
        <?php
        $totalPages = 5;
        $hasNext = $currentPage < $totalPages;
        $hasPrev = $currentPage > 1;
        ?>
        <?php if ($totalPages > 1): ?>
            <div class="flex flex-wrap justify-center items-center gap-2 mt-8 sm:mt-12">
                <?php if ($hasPrev): ?>
                    <a href="?page=<?= $currentPage - 1 ?>"
                        class="px-4 py-2.5 bg-white border border-zyndan-border rounded-lg hover:border-zyndan-red hover:text-zyndan-red transition-all text-zyndan-navy font-bold text-xs uppercase tracking-wider">
                        <i class="las la-angle-left mr-1"></i>
                        <?= $lang === 'kz' ? 'Артқа' : 'Назад' ?>
                    </a>
                <?php endif; ?>

                <div class="flex gap-1.5">
                    <?php for ($i = 1; $i <= min($totalPages, 5); $i++): ?>
                        <a href="?page=<?= $i ?>"
                            class="w-10 h-10 flex items-center justify-center rounded-lg transition-all font-bold text-xs border <?= $i === $currentPage ? 'bg-zyndan-red text-white border-zyndan-red shadow-sm' : 'bg-white border-zyndan-border hover:border-zyndan-red text-zyndan-navy' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                </div>

                <?php if ($hasNext): ?>
                    <a href="?page=<?= $currentPage + 1 ?>"
                        class="px-4 py-2.5 bg-white border border-zyndan-border rounded-lg hover:border-zyndan-red hover:text-zyndan-red transition-all text-zyndan-navy font-bold text-xs uppercase tracking-wider">
                        <?= $lang === 'kz' ? 'Алға' : 'Вперед' ?>
                        <i class="las la-angle-right ml-1"></i>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    <?php else: ?>
        <div class="text-center py-20 bg-zyndan-gray rounded-xl border border-zyndan-border max-w-lg mx-auto">
            <i class="las la-inbox text-5xl text-zyndan-muted mb-4"></i>
            <h3 class="text-xl font-bold text-zyndan-navy mb-2 tracking-tight">
                <?= $lang === 'kz' ? 'Жаңалықтар әзірге жоқ' : 'Материалов пока нет' ?>
            </h3>
            <p class="text-sm text-zyndan-muted">
                <?= $lang === 'kz' ? 'Бұл бөлімде әзірге жарияланған жаңалық жоқ' : 'В этой рубрике еще нет публикаций' ?>
            </p>
        </div>
    <?php endif; ?>
</main>

<!-- Подключаем footer -->
<?php require_once __DIR__ . '/../partials/_footer.php'; ?>