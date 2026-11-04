<?php
/**
 * Виджет Календаря новостей — ZYNDAN.KZ
 */

// Логика календаря
$currentMonth = (int) date('n');
$currentYear = (int) date('Y');
$firstDayTimestamp = strtotime(sprintf("%04d-%02d-01", $currentYear, $currentMonth));
$daysInMonth = (int) date('t', $firstDayTimestamp);
$firstDayOfMonth = (int) date('N', $firstDayTimestamp);

// Названия месяцев на двух языках
$monthsKz = [1 => 'Қаңтар', 'Ақпан', 'Наурыз', 'Сәуір', 'Мамыр', 'Маусым', 'Шілде', 'Тамыз', 'Қыркүйек', 'Қазан', 'Қараша', 'Желтоқсан'];
$monthsRu = [1 => 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
$monthName = ($lang ?? 'kz') === 'kz' ? $monthsKz[$currentMonth] : $monthsRu[$currentMonth];

// Дни недели
$daysKz = ['Дс', 'Сс', 'Ср', 'Бс', 'Жм', 'Сб', 'Жс'];
$daysRu = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
$weekDays = ($lang ?? 'kz') === 'kz' ? $daysKz : $daysRu;

// Подсвечиваемые даты (из контроллера) — приводим к int для точного сравнения
$activeDates = array_map('intval', $calendarDates ?? []);
$todayDay = (int) date('j');
?>

<div class="flex flex-col h-full bg-white">
    <div class="bg-zyndan-gray px-4 py-2.5 border-b border-zyndan-border flex justify-between items-center flex-shrink-0">
        <h3 class="font-extrabold text-zyndan-navy text-[11px] uppercase tracking-wider flex items-center gap-1.5">
            <i class="las la-calendar text-zyndan-red text-base"></i>
            <span><?= $monthName ?> <?= $currentYear ?></span>
        </h3>
        <span class="text-[10px] font-bold text-zyndan-muted font-mono"><?= date('d.m.Y') ?></span>
    </div>

    <div class="p-3 sm:p-4 flex-1 flex flex-col justify-center">
        <div class="grid grid-cols-7 gap-1 text-center mb-1.5">
            <?php foreach ($weekDays as $idx => $day): ?>
                <div class="text-[10px] font-extrabold <?= $idx >= 5 ? 'text-zyndan-red/80' : 'text-zyndan-muted' ?> uppercase">
                    <?= $day ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="grid grid-cols-7 gap-1 text-center">
            <!-- Пустые ячейки до начала месяца -->
            <?php for ($i = 1; $i < $firstDayOfMonth; $i++): ?>
                <div class="h-6 md:h-7"></div>
            <?php endfor; ?>

            <!-- Дни месяца -->
            <?php for ($day = 1; $day <= $daysInMonth; $day++):
                $hasNews = in_array($day, $activeDates, true);
                $isToday = ($day === $todayDay);
                $formattedDate = sprintf("%04d-%02d-%02d", $currentYear, $currentMonth, $day);
                $link = "/" . (($lang ?? 'kz') === 'ru' ? 'ru/' : '') . "search?date=" . $formattedDate;
                ?>
                <div class="relative">
                    <?php if ($hasNews): ?>
                        <a href="<?= $link ?>"
                            title="<?= ($lang ?? 'kz') === 'kz' ? 'Жаңалықтарды көру' : 'Смотреть новости за ' . sprintf('%02d.%02d.%04d', $day, $currentMonth, $currentYear) ?>"
                            class="relative flex items-center justify-center h-6 md:h-7 w-full rounded-md text-[11px] font-extrabold transition-all
                                   <?= $isToday
                                       ? 'bg-zyndan-red text-white shadow-sm'
                                       : 'bg-zyndan-navy/10 text-zyndan-navy hover:bg-zyndan-navy hover:text-white' ?>">
                            <?= $day ?>
                            <span class="absolute bottom-0.5 left-1/2 -translate-x-1/2 w-1 h-1 rounded-full <?= $isToday ? 'bg-white' : 'bg-zyndan-red' ?>"></span>
                        </a>
                    <?php elseif ($isToday): ?>
                        <a href="<?= $link ?>"
                            class="flex items-center justify-center h-6 md:h-7 w-full rounded-md text-[11px] font-extrabold bg-zyndan-red text-white shadow-sm">
                            <?= $day ?>
                        </a>
                    <?php else: ?>
                        <div class="flex items-center justify-center h-6 md:h-7 w-full rounded-md text-[11px] text-slate-400 font-medium select-none">
                            <?= $day ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>