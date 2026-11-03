<?php
/**
 * Главная страница - Informnews.kz
 * Файл обновлен: Дизайн Bento Grid + Фикс логики главной новости
 */

require_once __DIR__ . '/../partials/_header.php';
require_once __DIR__ . '/../partials/_navigation.php';

// === ЛОГИКА ДАННЫХ ВНУТРИ VIEW (ЧТОБЫ НЕ БЫЛО ОШИБОК) ===
// === АПДЕЙТ ИЗМЕНИЛ РЕКЛАМУ НА СТРАНИЦЕ НА АНОНСЫ ===
// 1. Функция для безопасного получения картинки
function getPostImage($post, $size = 'medium')
{
    if (!empty($post['image'])) {
        return "/uploads/$size/" . $post['image'];
    }
    // Фирменная заглушка в цвет бренда ZYNDAN.KZ, если фото нет
    return 'https://placehold.co/800x600/101C31/FFF?text=ZYNDAN.KZ';
}

// 2. Умное определение Главной новости
// Если контроллер передал $heroPost - берем её. Если нет - берем первую из списка $latestNews.
$mainPost = null;
$feedNews = $latestNews ?? []; // Копия массива всех новостей

if (isset($heroPost) && !empty($heroPost)) {
    $mainPost = $heroPost;
} elseif (!empty($feedNews)) {
    $mainPost = $feedNews[0];
    array_shift($feedNews); // Удаляем эту новость из общего списка, чтобы не повторялась
}

// 3. Новости для средней колонки (2 шт)
$centerPosts = array_slice($feedNews, 0, 2);

// 4. Новости для нижней большой сетки (остальные)
$gridPosts = array_slice($feedNews, 2);
?>



<main class="container mx-auto px-3 sm:px-4 py-4 sm:py-8 grid grid-cols-1 lg:grid-cols-4 gap-5 sm:gap-8">

    <!-- Главная новость (Hero Left - 3 колонки) -->
    <div class="lg:col-span-3 relative h-[320px] sm:h-[400px] md:h-[480px] overflow-hidden rounded-xl shadow-zyndan-sm border border-zyndan-border bg-black">
        <?php if ($mainPost):
            $hTitle = $lang === 'kz' ? $mainPost['title_kz'] : $mainPost['title_ru'];
            $hSlug = $lang === 'kz' ? $mainPost['slug_kz'] : $mainPost['slug_ru'];
            $hCatSlug = $mainPost['category_slug'] ?? 'aqparat';
            $hLink = "/" . ($lang === 'ru' ? 'ru/' : '') . "$hCatSlug/$hSlug";
            ?>
            <a href="<?= $hLink ?>" class="block w-full h-full relative">
                <!-- Статичное четкое фото без анимации зума -->
                <img src="<?= getPostImage($mainPost, 'large') ?>"
                    class="absolute inset-0 w-full h-full object-cover"
                    alt="<?= htmlspecialchars($hTitle) ?>">

                <!-- Градиентная подложка для максимальной читаемости -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/45 to-transparent flex flex-col justify-end p-4 sm:p-6 md:p-10 text-white">
                    <div class="mb-2.5 sm:mb-4">
                        <span class="bg-zyndan-red text-white px-2.5 sm:px-3 py-1 text-[10px] sm:text-[11px] font-extrabold uppercase tracking-widest inline-flex items-center gap-1.5 rounded-sm shadow-md">
                            <i class="las la-star text-sm"></i> <?= $lang === 'kz' ? 'Басты жаңалық' : 'Главное событие' ?>
                        </span>
                    </div>

                    <h2 class="hero-white-title text-lg sm:text-2xl md:text-4xl font-extrabold leading-tight mb-3 sm:mb-4 !text-white text-white tracking-tight line-clamp-3" style="color: #ffffff !important;">
                        <?= htmlspecialchars($hTitle) ?>
                    </h2>

                    <div class="hero-white-meta flex flex-wrap items-center text-[11px] sm:text-xs font-semibold !text-white text-white gap-3 sm:gap-6" style="color: #ffffff !important;">
                        <span class="flex items-center gap-1.5 text-white" style="color: #ffffff !important;"><i class="las la-clock text-zyndan-red text-base"></i> <?= date('H:i', strtotime($mainPost['published_at'])) ?>, <?= $lang === 'ru' ? 'Сегодня' : 'Бүгін' ?></span>
                        <span class="flex items-center gap-1.5 text-white" style="color: #ffffff !important;"><i class="las la-eye text-base"></i> <?= number_format($mainPost['views'] ?? 0) ?></span>
                        <?php if (!empty($mainPost['category_name'])): ?>
                            <span class="border-l border-white/30 pl-3 sm:pl-4 uppercase tracking-wider text-[10px] sm:text-[11px] text-white font-bold" style="color: #ffffff !important;"><?= htmlspecialchars($mainPost['category_name']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
        <?php else: ?>
            <div class="w-full h-full bg-zyndan-gray flex items-center justify-center text-zyndan-muted font-bold uppercase tracking-widest text-sm">
                <?= $lang === 'kz' ? 'Жаңалықтар жүктелуде...' : 'Загрузка новостей...' ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Сайдбар (Ақпарат легі / Live Breaking News) -->
    <div class="lg:col-span-1 bg-white rounded-xl shadow-zyndan-sm border border-zyndan-border overflow-hidden flex flex-col lg:h-[480px]">
        <!-- Шапка сайдбара с пульсирующей красной точкой -->
        <div class="bg-zyndan-gray border-b border-zyndan-border text-zyndan-navy px-4 sm:px-5 py-3.5 sm:py-4 font-bold uppercase flex justify-between items-center text-xs tracking-wider flex-shrink-0">
            <span class="flex items-center gap-2.5">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-zyndan-red opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-zyndan-red"></span>
                </span>
                <span class="font-extrabold"><?= $lang === 'kz' ? 'Ақпарат легі' : 'Лента новостей' ?></span>
            </span>
            <a href="https://wa.me/77470645196" target="_blank" class="text-emerald-600 hover:text-emerald-500 transition-colors" title="WhatsApp">
                <i class="lab la-whatsapp text-2xl"></i>
            </a>
        </div>

        <!-- Список оперативных новостей -->
        <div class="divide-y divide-zyndan-border/70 max-h-[260px] lg:max-h-none lg:flex-1 overflow-y-auto no-scrollbar">
            <?php if (isset($announcements) && !empty($announcements)):
                foreach ($announcements as $item):
                    $aTitle = $lang === 'kz' ? $item['title_kz'] : $item['title_ru'];
                    $aLink = "/" . ($lang === 'ru' ? 'ru/' : '') . ($item['category_slug'] ?? 'news') . "/" . ($lang === 'kz' ? $item['slug_kz'] : $item['slug_ru']);
                    ?>
                    <a href="<?= $aLink ?>" class="block p-4 hover:bg-zyndan-gray/60 cursor-pointer transition-colors group/item">
                        <div class="flex items-center gap-2 mb-1.5">
                            <span class="text-[11px] font-mono font-bold text-zyndan-red flex items-center gap-1">
                                <i class="las la-clock text-xs"></i> <?= date('H:i', strtotime($item['published_at'])) ?>
                            </span>
                            <?php if (!empty($item['category_name'])): ?>
                                <span class="text-[10px] text-zyndan-muted uppercase font-semibold">· <?= htmlspecialchars($item['category_name']) ?></span>
                            <?php endif; ?>
                        </div>
                        <h4 class="text-xs font-semibold leading-snug text-black line-clamp-2 group-hover/item:text-zyndan-red transition-colors">
                            <?= htmlspecialchars($aTitle) ?>
                        </h4>
                    </a>
                <?php endforeach; else: ?>
                <div class="flex items-center justify-center h-full text-xs text-zyndan-muted font-bold uppercase tracking-widest p-5 text-center">
                    <?= $lang === 'kz' ? 'Жаңалықтар жүктелуде...' : 'Загрузка...' ?>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- ВИДЖЕТ КАЛЕНДАРЯ / НИЖНИЙ БЛОК -->
        <div class="flex-shrink-0 bg-zyndan-gray border-t border-zyndan-border">
            <?php require __DIR__ . '/../partials/_calendar_widget.php'; ?>
        </div>
    </div>
</main>

<!-- === РАЗДЕЛИТЕЛЬ С ФИРМЕННЫМ КРАСНЫМ АКЦЕНТОМ === -->
<div class="container mx-auto px-4 my-2">
    <div class="h-[1px] bg-zyndan-border flex items-center">
        <div class="w-20 h-[3px] bg-zyndan-red"></div>
    </div>
</div>

<!-- === ЛЕНТА ВСЕХ НОВОСТЕЙ === -->
<section class="container mx-auto px-3 sm:px-4 py-6 sm:py-8 mb-8 sm:mb-12">
    <div class="flex items-center justify-between mb-5 sm:mb-8 pb-3 sm:pb-4 border-b border-zyndan-border">
        <h2 class="text-xl sm:text-2xl font-black text-zyndan-navy zyndan-section-title tracking-tight">
            <?= $lang === 'kz' ? 'Барлық жаңалықтар' : 'Все новости' ?>
        </h2>
        <a href="/" class="text-[11px] sm:text-xs font-bold text-zyndan-muted hover:text-zyndan-red flex items-center gap-1 transition-colors uppercase tracking-wider">
            <?= $lang === 'kz' ? 'Барлығын көру' : 'Смотреть все' ?> <i class="las la-arrow-right text-sm"></i>
        </a>
    </div>

    <!-- Общий массив для сетки -->
    <?php $allGridNews = array_merge($centerPosts, $gridPosts); ?>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 md:gap-8">
        <?php foreach ($allGridNews as $news):
            $nTitle = $lang === 'kz' ? $news['title_kz'] : $news['title_ru'];
            $nLink = "/" . ($lang === 'ru' ? 'ru/' : '') . ($news['category_slug'] ?? 'news') . "/" . ($lang === 'kz' ? $news['slug_kz'] : $news['slug_ru']);
            ?>
            <!-- Карточка новости ZYNDAN -->
            <a href="<?= $nLink ?>" class="bg-white group cursor-pointer rounded-xl zyndan-card overflow-hidden flex flex-col">
                <div class="relative h-44 sm:h-52 overflow-hidden bg-zyndan-gray">
                    <img src="<?= getPostImage($news, 'medium') ?>"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" alt="<?= htmlspecialchars($nTitle) ?>">
                    
                    <!-- Бейдж категории -->
                    <div class="absolute top-3 left-3 bg-zyndan-navy text-white text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-sm shadow-sm flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-zyndan-red"></span>
                        <?= htmlspecialchars($news['category_name'] ?? 'Ақпарат') ?>
                    </div>
                </div>
                <div class="p-4 sm:p-6 flex flex-col flex-1 justify-between">
                    <div>
                        <div class="text-[11px] text-zyndan-muted font-medium mb-2 sm:mb-3 flex items-center gap-1.5">
                            <i class="las la-calendar text-zyndan-red text-sm"></i> <?= date('d.m.Y, H:i', strtotime($news['published_at'])) ?>
                        </div>
                        <h3 class="text-base sm:text-lg font-bold leading-snug text-black group-hover:text-zyndan-red transition-colors mb-3 line-clamp-3">
                            <?= htmlspecialchars($nTitle) ?>
                        </h3>
                    </div>
                    <div class="pt-3 sm:pt-4 border-t border-zyndan-border/60 flex items-center justify-between text-xs text-zyndan-muted">
                        <span class="flex items-center gap-1"><i class="las la-eye"></i> <?= number_format($news['views'] ?? 0) ?></span>
                        <span class="text-zyndan-red font-semibold flex items-center gap-0.5 group-hover:translate-x-1 transition-transform">
                            <?= $lang === 'ru' ? 'Подробнее' : 'Оқу' ?> <i class="las la-angle-right text-xs"></i>
                        </span>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<!-- === ПОПУЛЯРНОЕ (ТАНЫМАЛ ЖАҢАЛЫҚТАР В ТЕМНО-СИНЕМ БЛОКЕ #101C31) === -->
<section class="bg-zyndan-navy text-white py-9 sm:py-14 relative border-t-2 border-zyndan-red">
    <div class="container mx-auto px-3 sm:px-4">
        
        <div class="flex items-center justify-between mb-6 sm:mb-10 pb-3 sm:pb-4 border-b border-white/10">
            <h2 class="text-xl sm:text-2xl font-black text-white flex items-center gap-2.5 sm:gap-3 tracking-tight">
                <span class="w-1.5 h-5 sm:h-6 bg-zyndan-red rounded-none inline-block"></span>
                <?= $lang === 'kz' ? 'Танымал жаңалықтар' : 'Популярные публикации' ?>
            </h2>
            <span class="text-xs text-slate-400 font-semibold uppercase tracking-widest hidden sm:inline-block">
                <?= $lang === 'ru' ? 'ТОП просмотров' : 'Ең көп оқылған' ?>
            </span>
        </div>

        <?php if (isset($popularNews) && !empty($popularNews)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8 sm:mb-10">
                <?php foreach (array_slice($popularNews, 0, 4) as $idx => $pop):
                    $pTitle = $lang === 'kz' ? $pop['title_kz'] : $pop['title_ru'];
                    $pLink = "/" . ($lang === 'ru' ? 'ru/' : '') . ($pop['category_slug'] ?? 'news') . "/" . ($lang === 'kz' ? $pop['slug_kz'] : $pop['slug_ru']);
                    ?>
                    <a href="<?= $pLink ?>" class="group block bg-white/5 hover:bg-white/10 border border-white/10 hover:border-zyndan-red/50 rounded-xl p-5 transition-all flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-3xl font-black text-zyndan-red">#0<?= $idx + 1 ?></span>
                                <span class="text-[11px] text-slate-400 flex items-center gap-1 font-mono">
                                    <i class="las la-eye text-zyndan-red"></i> <?= number_format($pop['views'] ?? 0) ?>
                                </span>
                            </div>
                            <h4 class="font-bold text-sm leading-snug text-white group-hover:text-slate-200 line-clamp-3 mb-4 transition-colors">
                                <?= htmlspecialchars($pTitle) ?>
                            </h4>
                        </div>
                        <div class="text-[11px] text-slate-400 font-medium flex items-center justify-between pt-3 border-t border-white/5">
                            <span><?= date('d.m.Y', strtotime($pop['published_at'])) ?></span>
                            <i class="las la-arrow-right text-zyndan-red group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- === ВИДЕОГАЛЕРЕЯ (ЕСЛИ ЕСТЬ) === -->
        <?php if (isset($videos) && !empty($videos)): ?>
            <div class="pt-10 border-t border-white/10">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-bold text-white flex items-center gap-2.5">
                        <span class="w-1.5 h-5 bg-zyndan-red inline-block"></span>
                        <?= $lang === 'kz' ? 'Бейнематериалдар' : 'Видеорепортажи' ?>
                    </h3>
                    <a href="/<?= $lang === 'ru' ? 'ru/' : '' ?>videos" class="text-xs font-bold text-slate-300 hover:text-white flex items-center gap-1 transition-colors uppercase tracking-wider">
                        <?= $lang === 'kz' ? 'Барлық видео' : 'Все видео' ?> <i class="las la-arrow-right text-zyndan-red"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <?php foreach ($videos as $video):
                        $vTitle = $lang === 'kz' ? $video['title_kz'] : $video['title_ru'];
                        $vLink = $video['youtube_url'];
                        ?>
                        <div class="group bg-white/5 rounded-xl overflow-hidden border border-white/10 hover:border-zyndan-red/50 transition-all">
                            <a href="<?= $vLink ?>" target="_blank" class="relative block aspect-video overflow-hidden">
                                <img src="/uploads/large/<?= $video['image'] ?>" class="w-full h-full object-cover transition duration-500 group-hover:scale-105" alt="<?= htmlspecialchars($vTitle) ?>">
                                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition-all flex items-center justify-center">
                                    <div class="w-12 h-12 bg-zyndan-red text-white rounded-full flex items-center justify-center shadow-lg transform transition group-hover:scale-110">
                                        <i class="las la-play text-xl ml-0.5"></i>
                                    </div>
                                </div>
                            </a>
                            <div class="p-4">
                                <h4 class="text-xs font-bold text-white leading-snug line-clamp-2 group-hover:text-slate-300 transition-colors">
                                    <a href="<?= $vLink ?>" target="_blank"><?= htmlspecialchars($vTitle) ?></a>
                                </h4>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php require_once __DIR__ . '/../partials/_footer.php'; ?>