<?php
/**
 * Бейнежазбалар архиві / Архив видео - Informnews.kz
 */

require_once __DIR__ . '/../partials/_header.php';
require_once __DIR__ . '/../partials/_navigation.php';
?>

<main class="container mx-auto px-4 py-8 lg:py-12">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 pb-6 border-b border-zyndan-border gap-6">
        <div>
            <nav class="flex mb-3 text-[11px] font-bold uppercase tracking-wider text-zyndan-muted">
                <a href="<?= $lang === 'ru' ? '/ru/' : '/' ?>" class="hover:text-zyndan-red transition flex items-center gap-1.5"><i class="las la-home text-sm"></i> <?= $lang === 'ru' ? 'Главная' : 'Басты бет' ?></a>
                <span class="mx-2 text-zyndan-border"><i class="las la-angle-right"></i></span>
                <span class="text-zyndan-navy dark:text-white font-bold flex items-center gap-1"><span class="w-1.5 h-1.5 bg-zyndan-red rounded-full"></span> <?= $lang === 'kz' ? 'Бейнежазбалар' : 'Видеогалерея' ?></span>
            </nav>
            <h1 class="text-3xl md:text-4xl font-black text-zyndan-navy dark:text-white uppercase tracking-tight flex items-center gap-2.5">
                <span class="w-2 h-7 bg-zyndan-red inline-block"></span>
                <?= $lang === 'kz' ? 'Бейнежазбалар' : 'Видеогалерея' ?>
            </h1>
        </div>
        <div class="text-xs font-bold text-zyndan-navy uppercase tracking-wider bg-zyndan-gray px-4 py-2 rounded-lg border border-zyndan-border shadow-sm">
            <?= $lang === 'kz' ? 'Барлығы:' : 'Всего:' ?> <?= $totalVideos ?? 0 ?>
        </div>
    </div>

    <!-- Videos Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        <?php if (isset($videos) && !empty($videos)): ?>
            <?php foreach ($videos as $video):
                $vTitle = $lang === 'kz' ? $video['title_kz'] : $video['title_ru'];
                $vLink = $video['youtube_url'];
                ?>
                <div class="group relative bg-white dark:bg-zyndan-navy rounded-xl overflow-hidden border border-zyndan-border zyndan-card flex flex-col">
                    <!-- Preview Image -->
                    <a href="<?= $vLink ?>" target="_blank" class="relative block aspect-video overflow-hidden bg-zyndan-gray">
                        <img src="/uploads/large/<?= $video['image'] ?>"
                            class="w-full h-full object-cover transition duration-500 group-hover:scale-105"
                            alt="<?= htmlspecialchars($vTitle) ?>">
                        <div class="absolute inset-0 bg-black/25 group-hover:bg-black/40 transition-all flex items-center justify-center">
                            <div class="w-12 h-12 bg-zyndan-red text-white rounded-full flex items-center justify-center shadow-lg transform transition group-hover:scale-110">
                                <i class="las la-play text-xl ml-0.5"></i>
                            </div>
                        </div>
                    </a>

                    <!-- Text Content -->
                    <div class="p-6 md:p-8 flex flex-col flex-1">
                        <div class="text-[11px] font-semibold text-slate-400 mb-3 flex items-center gap-1.5 uppercase tracking-widest">
                            <i class="las la-calendar text-sm"></i>
                            <?= date('d.m.Y', strtotime($video['published_at'])) ?>
                        </div>
                        <h3
                            class="text-lg font-bold text-slate-900 leading-snug group-hover:text-slate-600 transition-colors line-clamp-2">
                            <a href="<?= $vLink ?>" target="_blank">
                                <?= htmlspecialchars($vTitle) ?>
                            </a>
                        </h3>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full py-20 text-center bg-slate-50 rounded-2xl border border-slate-200">
                <div class="text-slate-300 mb-4 text-5xl">
                    <i class="las la-play-circle"></i>
                </div>
                <div class="text-slate-900 font-bold uppercase tracking-widest text-sm">
                    Видеолар табылмады / Видео не найдены
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if (isset($totalPages) && $totalPages > 1): ?>
        <div class="flex justify-center items-center gap-2">
            <?php if ($currentPage > 1): ?>
                <a href="?page=<?= $currentPage - 1 ?>"
                    class="w-12 h-12 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-900 hover:bg-slate-50 transition shadow-sm">
                    <i class="las la-angle-left text-sm"></i>
                </a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>"
                    class="w-12 h-12 flex items-center justify-center rounded-xl <?= $currentPage == $i ? 'bg-slate-900 text-white shadow-md border border-slate-900' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' ?> font-bold text-sm transition">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
                <a href="?page=<?= $currentPage + 1 ?>"
                    class="w-12 h-12 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-900 hover:bg-slate-50 transition shadow-sm">
                    <i class="las la-angle-right text-sm"></i>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</main>

<?php require_once __DIR__ . '/../partials/_footer.php'; ?>