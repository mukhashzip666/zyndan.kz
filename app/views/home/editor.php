<?php $this->view('partials/_header', ['pageTitle' => $pageTitle, 'lang' => $lang]); ?>
<?php $this->view('partials/_navigation', ['categories' => $categories, 'lang' => $lang, 'weather' => $weather, 'currency' => $currency]); ?>

<main class="flex-grow bg-white">
    <!-- Hero Section -->
    <section class="relative py-16 overflow-hidden bg-[#F5F6F8] border-b border-[#E5E7EB]">
        <div class="container mx-auto px-4 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-white border border-[#E5E7EB] rounded-full text-xs font-bold text-brand uppercase tracking-wider mb-4 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-brand-red"></span>
                <?= $lang === 'kz' ? 'Редакция алқасы' : 'Редакция издания' ?>
            </div>
            <h1 class="text-3xl md:text-5xl font-black text-brand uppercase tracking-tight mb-4">
                <?= $lang === 'kz' ? 'Редакция' : 'Редакция' ?>
            </h1>
            <div class="flex items-center justify-center gap-3">
                <span class="h-[2px] w-12 bg-brand"></span>
                <span class="h-[3px] w-8 bg-brand-red"></span>
                <p class="text-brand font-bold uppercase tracking-widest text-lg">ZYNDAN.KZ</p>
                <span class="h-[3px] w-8 bg-brand-red"></span>
                <span class="h-[2px] w-12 bg-brand"></span>
            </div>
            <p class="text-xs uppercase tracking-widest text-[#626B78] mt-2 font-semibold">Aqparat • Taldau • Senim</p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-12 md:py-16 container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white p-8 md:p-12 rounded-2xl border border-[#E5E7EB] shadow-sm relative overflow-hidden">
                <div class="prose prose-lg max-w-none">
                    <?php if ($lang === 'kz'): ?>
                        <p class="text-black leading-relaxed mb-6 font-medium text-lg">
                            <strong class="text-brand">ZYNDAN.KZ</strong> – өңірдегі және ел көлеміндегі өзекті әлеуметтік, экономикалық және
                            қоғамдық-саяси жаңалықтарды жедел әрі сапалы жариялайтын заманауи ақпараттық-сараптамалық медиа портал. Басылымның негізгі
                            бағыты – ақпараттық, талдамалы және танымдық контент ұсыну.
                        </p>
                        <p class="text-[#626B78] leading-relaxed mb-10 font-medium">
                            Сайтта күн сайынғы жедел жаңалықтармен қатар, сараптамалық мақалалар, арнайы репортаждар,
                            сұхбаттар және авторлық шығармашылық материалдар тұрақты түрде жарияланып тұрады. <strong class="text-brand">ZYNDAN.KZ</strong>
                            оқырманға шынайы ақпарат ұсынып қана қоймай, маңызды мәселелерге терең талдау жасап,
                            қоғамдық пікір қалыптастыруға үлес қосуды мақсат етеді.
                        </p>

                        <div class="mt-12 pt-8 border-t border-[#E5E7EB] flex flex-col md:flex-row items-center gap-8">
                            <div class="relative group">
                                <div class="w-48 md:w-56 rounded-xl overflow-hidden border-2 border-[#101C31] shadow-md">
                                    <img src="/assets/aslan.png" alt="Aslan Sagyndyk" class="w-full h-auto">
                                </div>
                            </div>
                            <div class="text-center md:text-left">
                                <span class="inline-block w-8 h-[2px] bg-brand-red mb-2"></span>
                                <h3 class="text-2xl font-black text-brand uppercase tracking-tight mb-1">
                                    Аслан Сағындық
                                </h3>
                                <p class="text-brand-red font-bold uppercase tracking-wider text-xs mb-4">
                                    Бас редактор
                                </p>
                                <div class="flex gap-3 justify-center md:justify-start">
                                    <a href="#" class="w-9 h-9 rounded-lg bg-[#F5F6F8] border border-[#E5E7EB] flex items-center justify-center text-brand hover:bg-brand hover:text-white transition-colors"><i class="lab la-facebook-f"></i></a>
                                    <a href="#" class="w-9 h-9 rounded-lg bg-[#F5F6F8] border border-[#E5E7EB] flex items-center justify-center text-brand hover:bg-brand hover:text-white transition-colors"><i class="lab la-instagram"></i></a>
                                    <a href="#" class="w-9 h-9 rounded-lg bg-[#F5F6F8] border border-[#E5E7EB] flex items-center justify-center text-brand hover:bg-brand-red hover:text-white transition-colors"><i class="lab la-telegram-plane"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <p class="text-black leading-relaxed mb-6 font-medium text-lg">
                            <strong class="text-brand">ZYNDAN.KZ</strong> — современное информационно-аналитическое медиа, оперативно и качественно освещающее актуальные
                            социальные, экономические и общественно-политические события Казахстана и мира. Основное
                            направление издания — предоставление проверенного информационного, аналитического и познавательного контента.
                        </p>
                        <p class="text-[#626B78] leading-relaxed mb-10 font-medium">
                            На сайте издания, помимо оперативных новостей, регулярно публикуются аналитические статьи,
                            специальные репортажи, экспертные интервью и авторские материалы. Цель <strong class="text-brand">ZYNDAN.KZ</strong> — не
                            просто предоставлять читателям достоверную информацию, но и проводить глубокий анализ значимых
                            вопросов, формируя объективное общественное мнение.
                        </p>

                        <div class="mt-12 pt-8 border-t border-[#E5E7EB] flex flex-col md:flex-row items-center gap-8">
                            <div class="relative group">
                                <div class="w-48 md:w-56 rounded-xl overflow-hidden border-2 border-[#101C31] shadow-md">
                                    <img src="/assets/aslan.png" alt="Аслан Сагындык" class="w-full h-auto">
                                </div>
                            </div>
                            <div class="text-center md:text-left">
                                <span class="inline-block w-8 h-[2px] bg-brand-red mb-2"></span>
                                <h3 class="text-2xl font-black text-brand uppercase tracking-tight mb-1">
                                    Аслан Сагындык
                                </h3>
                                <p class="text-brand-red font-bold uppercase tracking-wider text-xs mb-4">
                                    Главный редактор
                                </p>
                                <div class="flex gap-3 justify-center md:justify-start">
                                    <a href="#" class="w-9 h-9 rounded-lg bg-[#F5F6F8] border border-[#E5E7EB] flex items-center justify-center text-brand hover:bg-brand hover:text-white transition-colors"><i class="lab la-facebook-f"></i></a>
                                    <a href="#" class="w-9 h-9 rounded-lg bg-[#F5F6F8] border border-[#E5E7EB] flex items-center justify-center text-brand hover:bg-brand hover:text-white transition-colors"><i class="lab la-instagram"></i></a>
                                    <a href="#" class="w-9 h-9 rounded-lg bg-[#F5F6F8] border border-[#E5E7EB] flex items-center justify-center text-brand hover:bg-brand-red hover:text-white transition-colors"><i class="lab la-telegram-plane"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php $this->view('partials/_footer', ['categories' => $categories, 'lang' => $lang]); ?>