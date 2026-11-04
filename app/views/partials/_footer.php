<?php
$siteConfig = $siteConfig ?? require __DIR__ . '/../../../config/app.php';
if (!isset($siteViewsStats)) {
    require_once __DIR__ . '/../../models/PostModel.php';
    $_footerPostModel = new PostModel();
    $siteViewsStats = $_footerPostModel->recordSiteVisit(true);
}
?>
<!-- === FOOTER === -->
<footer class="bg-zyndan-navy text-white mt-auto relative border-t-2 border-zyndan-red">
    <div class="container mx-auto px-3 sm:px-4 pt-9 sm:pt-14 pb-8 sm:pb-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-7 sm:gap-10 items-start pb-8 sm:pb-10 border-b border-white/10">
            
            <!-- Колонка 1: Бренд и миссия -->
            <div class="md:col-span-2">
                <div class="flex items-center gap-4 mb-4">
                    <div class="zyndan-logo-wrapper bg-white rounded p-1.5">
                        <img src="/assets/zyndan-logo.jpg?v=2" alt="ZYNDAN.KZ">
                    </div>
                </div>
                <div class="text-[11px] font-extrabold uppercase tracking-[0.2em] text-zyndan-red mb-3">
                    Aqparat · Taldau · Senim
                </div>
                <p class="text-slate-300 text-xs max-w-xl leading-relaxed mb-6 font-normal">
                    «Zyndan.kz» сайтында жарияланған барлық материалдардың (мәтін, иллюстрациялар, графика, фото, видео, аудио, сұхбаттар, шолулар, жеке авторлар бағаналары, арнайы жоба мәліметтері — бұдан әрі Материалдар) авторлық құқығы «Zyndan.kz» сайтына тиесілі. Сайтта жарияланған материалдарды басқа интернет-ресурстар пайдаланған жағдайда, авторлық құқық белгісін (©), авторды және Материал иесін, сондай-ақ гиперсілтеме (мақаланың www.zyndan.kz сайтындағы тұрақты сілтемесін көрсету) түрінде дереккөзге сілтеме көрсету міндетті. Түпнұсқадағы мәтіннің мазмұнын өзгертуге, мағынасын бұрмалап көшіруге тыйым салынады. Мазмұны өзгертілген немесе мағынасы бұрмаланған көшірме материалға қатысты жауапкершілікті көшіріп басқан жеке немесе заңды тұлға өз мойнына алады. Материалды толық немесе кез келген бөлігін көшіру, тарату үшін редакцияның жазбаша рұқсатын алу қажет.
                </p>
                <div class="flex items-center gap-3 text-slate-300 text-xs">
                    <i class="las la-envelope text-zyndan-red text-base"></i>
                    <span><?= $siteConfig['contact_email'] ?? 'editor@zyndan.kz' ?></span>
                </div>
            </div>

            <!-- Колонка 2: Навигация -->
            <div>
                <h4 class="text-xs font-bold uppercase tracking-[0.2em] text-white mb-4 flex items-center gap-2">
                    <span class="w-1.5 h-3.5 bg-zyndan-red"></span>
                    <?= $lang === 'ru' ? 'Разделы' : 'Бөлімдер' ?>
                </h4>
                <ul class="space-y-2.5 text-xs text-slate-300">
                    <li><a href="<?= $lang === 'ru' ? '/ru/' : '/' ?>" class="hover:text-zyndan-red transition-colors"><?= $lang === 'ru' ? 'Главные новости' : 'Басты жаңалықтар' ?></a></li>
                    <li><a href="/<?= ($lang === 'ru' ? 'ru/' : '') ?>sayasat" class="hover:text-zyndan-red transition-colors"><?= $lang === 'ru' ? 'Политика' : 'Саясат' ?></a></li>
                    <li><a href="/<?= ($lang === 'ru' ? 'ru/' : '') ?>qogam" class="hover:text-zyndan-red transition-colors"><?= $lang === 'ru' ? 'Общество' : 'Қоғам' ?></a></li>
                    <li><a href="/<?= ($lang === 'ru' ? 'ru/' : '') ?>ekonomika" class="hover:text-zyndan-red transition-colors"><?= $lang === 'ru' ? 'Экономика' : 'Экономика' ?></a></li>
                    <li><a href="/<?= ($lang === 'ru' ? 'ru/' : '') ?>ads" class="hover:text-zyndan-red transition-colors"><?= $lang === 'ru' ? 'Реклама на сайте' : 'Жарнама' ?></a></li>
                </ul>
            </div>

            <!-- Колонка 3: Контакты и социальные сети -->
            <div>
                <h4 class="text-xs font-bold uppercase tracking-[0.2em] text-white mb-4 flex items-center gap-2">
                    <span class="w-1.5 h-3.5 bg-zyndan-red"></span>
                    <?= $lang === 'ru' ? 'Связь с редакцией' : 'Байланыс' ?>
                </h4>
                <div class="text-xs text-slate-300 space-y-2 mb-5">
                    <div class="flex items-center gap-2">
                        <i class="las la-phone text-zyndan-red text-base"></i>
                        <span><?= $siteConfig['phone'] ?? '+77470645196' ?></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="las la-map-marker text-zyndan-red text-base"></i>
                        <span><?= $siteConfig['address'] ?? 'Қазақстан, Қызылорда қ.' ?></span>
                    </div>
                </div>

                <!-- Соцсети -->
                <div class="flex gap-2 text-xl">
                    <a href="<?= $siteConfig['social_instagram'] ?? 'https://www.instagram.com/zyndan.kz?utm_source=qr&dlrf=b3l2c3V0aHc3cnZ3' ?>" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-lg bg-white/10 hover:bg-zyndan-red transition-colors flex items-center justify-center text-white" title="Instagram">
                        <i class="lab la-instagram"></i>
                    </a>
                    <a href="<?= $siteConfig['social_facebook'] ?? 'https://www.facebook.com/people/Zyndan-KZ/pfbid02sXeGgRiiUymaiPHdx6LAw28LTstctiAbjSmXbrn9g95uC89JVM3Pptbf8eG6aYNRl/?rdid=dJfw75vxvx0rvdfP&share_url=https%3A%2F%2Fwww.facebook.com%2Fshare%2F19nmaGHaF2%2F%3Fref%3D1' ?>" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-lg bg-white/10 hover:bg-zyndan-red transition-colors flex items-center justify-center text-white" title="Facebook">
                        <i class="lab la-facebook-f"></i>
                    </a>
                    <a href="<?= $siteConfig['social_threads'] ?? 'https://www.threads.com/@zyndan.kz' ?>" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-lg bg-white/10 hover:bg-zyndan-red transition-colors flex items-center justify-center text-white" title="Threads">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 192 192" xmlns="http://www.w3.org/2000/svg"><path d="M141.537 88.988a66.667 66.667 0 0 0-2.518-1.143c-1.482-27.307-16.403-42.94-41.457-43.1h-.34c-14.986 0-27.449 6.396-35.12 18.036l13.779 9.452c5.73-8.695 14.724-10.548 21.348-10.548h.229c8.249.053 14.474 2.452 18.503 7.129 2.932 3.405 4.893 8.111 5.864 14.05-7.314-1.243-15.224-1.626-23.68-1.14-23.82 1.371-39.134 15.264-38.105 34.568.522 9.792 5.4 18.216 13.735 23.719 7.047 4.652 16.124 6.927 25.557 6.412 12.458-.683 22.231-5.436 29.049-14.127 5.178-6.6 8.453-15.153 9.899-25.93 5.937 3.583 10.337 8.298 12.767 13.966 4.132 9.635 4.373 25.468-8.546 38.376-11.319 11.308-24.925 16.2-45.488 16.351-22.809-.169-40.06-7.484-51.275-21.742C35.236 139.966 29.808 120.682 29.605 96c.203-24.682 5.63-43.966 16.133-57.317C56.954 24.425 74.204 17.11 97.013 16.94c22.975.17 40.526 7.52 52.171 21.847 5.71 7.026 10.015 15.86 12.853 26.162l16.147-4.308c-3.44-12.68-8.853-23.606-16.219-32.668C147.036 9.607 125.202.195 97.07 0h-.113C68.882.195 47.292 9.642 32.788 28.08 19.882 44.485 13.224 67.315 13.001 95.932L13 96v.067c.224 28.617 6.882 51.447 19.788 67.854C47.292 182.358 68.882 191.805 96.957 192h.113c24.96-.173 42.554-6.708 57.048-21.19 18.963-18.945 18.392-42.692 12.142-57.27-4.484-10.454-13.033-18.945-24.723-24.552Zm-43.096 40.519c-10.44.588-21.286-4.098-21.82-14.135-.397-7.442 5.296-15.746 22.461-16.735 1.966-.113 3.895-.169 5.79-.169 6.235 0 12.068.606 17.371 1.765-1.978 24.702-13.58 28.713-23.802 29.274Z"/></svg>
                    </a>
                    <a href="<?= $siteConfig['social_whatsapp'] ?? 'https://wa.me/77470645196' ?>" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-lg bg-white/10 hover:bg-emerald-600 transition-colors flex items-center justify-center text-white" title="WhatsApp">
                        <i class="lab la-whatsapp"></i>
                    </a>
                </div>
            </div>

        </div>

        <!-- Нижняя строка: Copyright + Счетчик просмотров сайта -->
        <div class="pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-slate-400">
            <div>
                © <?= date('Y') ?> <strong class="text-white">ZYNDAN.KZ</strong>. <?= $lang === 'ru' ? 'Все права защищены.' : 'Барлық құқықтар қорғалған.' ?>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-4 text-[11px]">
                <div class="flex items-center gap-3 bg-white/5 border border-white/10 px-3 py-1.5 rounded-lg text-slate-300 font-mono" title="<?= $lang === 'ru' ? 'Статистика посещений сайта' : 'Сайт қаралымының статистикасы' ?>">
                    <span class="flex items-center gap-1.5">
                        <i class="las la-eye text-zyndan-red text-sm"></i>
                        <?= $lang === 'ru' ? 'Просмотры сайта:' : 'Сайт қаралымы:' ?>
                        <strong class="text-white"><?= number_format($siteViewsStats['total'] ?? 0) ?></strong>
                    </span>
                    <span class="text-white/20">|</span>
                    <span class="flex items-center gap-1">
                        <?= $lang === 'ru' ? 'Сегодня:' : 'Бүгін:' ?>
                        <strong class="text-emerald-400">+<?= number_format($siteViewsStats['today'] ?? 0) ?></strong>
                    </span>
                </div>
                <a href="/<?= ($lang === 'ru' ? 'ru/' : '') ?>ads" class="hover:text-white transition-colors"><?= $lang === 'ru' ? 'Реклама' : 'Жарнама' ?></a>
                <span>·</span>
                <span class="text-slate-500">18+</span>
            </div>
        </div>
    </div>
</footer>

<!-- Скрипты анимаций и поведения -->
<script>
    // Плавный скролл прогресс-бара
    window.onscroll = function () {
        let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        let scrolled = (winScroll / height) * 100;
        let progress = document.getElementById("scrollProgress");
        if (progress) progress.style.width = scrolled + "%";
    };

    // ЗАЩИТА АВТОРСКИХ ПРАВ ПРИ КОПИРОВАНИИ / АВТОРЛЫҚ ҚҰҚЫҚТЫ ҚОРҒАУ
    document.addEventListener('copy', function (e) {
        const target = e.target;
        if (target && (target.tagName === 'INPUT' || target.tagName === 'TEXTAREA' || target.isContentEditable)) {
            return; // Формалар мен енгізу өрістеріндегі мәтінді қаз-қалпында көшіру
        }

        const selection = window.getSelection();
        const selectedText = selection ? selection.toString() : '';

        if (!selectedText || selectedText.trim().length === 0) {
            return;
        }

        const copyrightNotice = "\n\n«Zyndan.kz» сайтында жарияланған барлық материалдардың (мәтін, иллюстрациялар, графика, фото, видео, аудио, сұхбаттар, шолулар, жеке авторлар бағаналары, арнайы жоба мәліметтері — бұдан әрі Материалдар) авторлық құқығы «Zyndan.kz» сайтына тиесілі. Сайтта жарияланған материалдарды басқа интернет-ресурстар пайдаланған жағдайда, авторлық құқық белгісін (©), авторды және Материал иесін, сондай-ақ гиперсілтеме (мақаланың www.zyndan.kz сайтындағы тұрақты сілтемесін көрсету) түрінде дереккөзге сілтеме көрсету міндетті. Түпнұсқадағы мәтіннің мазмұнын өзгертуге, мағынасын бұрмалап көшіруге тыйым салынады. Мазмұны өзгертілген немесе мағынасы бұрмаланған көшірме материалға қатысты жауапкершілікті көшіріп басқан жеке немесе заңды тұлға өз мойнына алады. Материалды толық немесе кез келген бөлігін көшіру, тарату үшін редакцияның жазбаша рұқсатын алу қажет.\nДереккөз: " + window.location.href;

        if (e.clipboardData) {
            e.clipboardData.setData('text/plain', selectedText + copyrightNotice);
            e.preventDefault();
        }
    });
</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (m, e, t, r, i, k, a) {
        m[i] = m[i] || function () { (m[i].a = m[i].a || []).push(arguments) };
        m[i].l = 1 * new Date();
        for (var j = 0; j < document.scripts.length; j++) { if (document.scripts[j].src === r) { return; } }
        k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
    })(window, document, 'script', 'https://mc.yandex.ru/metrika/tag.js?id=106829765', 'ym');

    ym(106829765, 'init', { ssr: true, webvisor: true, clickmap: true, ecommerce: "dataLayer", referrer: document.referrer, url: location.href, accurateTrackBounce: true, trackLinks: true });
</script>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/106829765" style="position:absolute; left:-9999px;" alt="" /></div>
</noscript>
<!-- /Yandex.Metrika counter -->

</body>

</html>