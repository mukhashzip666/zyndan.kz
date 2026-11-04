<!-- Line Awesome Icons & Mobile Admin Styles -->
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<style>
    @media (max-width: 768px) {
        body header {
            padding-left: 0.75rem !important;
            padding-right: 0.75rem !important;
            height: auto !important;
            min-height: 3.5rem !important;
            padding-top: 0.5rem !important;
            padding-bottom: 0.5rem !important;
            flex-wrap: wrap !important;
            gap: 0.5rem !important;
        }
        body header h2 {
            font-size: 0.95rem !important;
            line-height: 1.25rem !important;
        }
        body main.p-8,
        body div.flex-1.p-8 {
            padding: 0.875rem !important;
        }
        body h1.text-3xl {
            font-size: 1.25rem !important;
            line-height: 1.6rem !important;
        }
        .bg-white.rounded-lg.shadow,
        .bg-white.shadow.rounded-lg {
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch;
        }
    }
</style>

<!-- ЗАТЕМНЕНИЕ ФОНА ПРИ ОТКРЫТОМ МЕНЮ -->
<div id="adminSidebarOverlay" onclick="closeAdminSidebar()" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 hidden transition-opacity"></div>

<!-- SIDEBAR (Выезжающее боковое меню по кнопке 3 полоски) -->
<aside id="adminSidebar" class="fixed inset-y-0 left-0 z-50 w-64 h-[100dvh] bg-[#101C31] text-slate-300 flex flex-col border-r border-white/10 shadow-2xl transform -translate-x-full transition-transform duration-300 ease-in-out">
    <!-- Branding + Кнопка закрытия -->
    <div class="h-16 flex items-center justify-between px-5 border-b border-white/10 bg-[#0c1626] flex-shrink-0">
        <a href="/admin" class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-lg bg-[#D71920] flex items-center justify-center font-black text-white text-lg tracking-tighter shadow-sm">Z</div>
            <span class="text-white font-black tracking-tight text-base">ZYNDAN<span class="text-[#D71920]">.KZ</span></span>
            <span class="bg-[#D71920]/20 text-[#D71920] border border-[#D71920]/30 text-[9px] font-black uppercase px-1.5 py-0.5 rounded">CMS</span>
        </a>
        <button type="button" onclick="closeAdminSidebar()" class="w-8 h-8 rounded-lg bg-white/10 hover:bg-[#D71920] text-white flex items-center justify-center transition-colors focus:outline-none" aria-label="Жабу">
            <i class="las la-times text-lg"></i>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-6 px-3">
        <ul class="space-y-1">
            <!-- Dashboard -->
            <li>
                <a href="/admin"
                    class="nav-item <?= isset($activeTab) && $activeTab === 'dashboard' ? 'bg-white/10 text-white font-bold border-l-4 border-[#D71920]' : 'text-slate-400 hover:bg-white/5 hover:text-white' ?> flex items-center px-4 py-2.5 rounded-r-lg transition-colors text-sm font-medium group">
                    <i class="las la-chart-line text-lg w-7 text-slate-400 group-hover:text-white transition-colors"></i>
                    <span>Басты бет</span>
                </a>
            </li>

            <!-- Posts Section -->
            <li class="px-4 pt-5 pb-2 text-[10px] font-bold uppercase text-slate-400 tracking-wider">Контент</li>
            <li>
                <a href="/admin/posts"
                    class="nav-item <?= isset($activeTab) && $activeTab === 'posts' ? 'bg-white/10 text-white font-bold border-l-4 border-[#D71920]' : 'text-slate-400 hover:bg-white/5 hover:text-white' ?> flex items-center px-4 py-2.5 rounded-r-lg transition-colors text-sm font-medium group">
                    <i class="las la-newspaper text-lg w-7 text-slate-400 group-hover:text-white transition-colors"></i>
                    <span>Жаңалықтар</span>
                </a>
            </li>
            <li>
                <a href="/admin/comments"
                    class="nav-item <?= isset($activeTab) && $activeTab === 'comments' ? 'bg-white/10 text-white font-bold border-l-4 border-[#D71920]' : 'text-slate-400 hover:bg-white/5 hover:text-white' ?> flex items-center px-4 py-2.5 rounded-r-lg transition-colors text-sm font-medium group">
                    <i class="las la-comments text-lg w-7 text-slate-400 group-hover:text-white transition-colors"></i>
                    <span>Пікірлер</span>
                    <?php if (isset($pendingCount) && $pendingCount > 0): ?>
                        <span class="ml-auto bg-[#D71920] text-white text-[10px] font-bold rounded-md px-2 py-0.5">
                            <?= $pendingCount ?>
                        </span>
                    <?php endif; ?>
                </a>
            </li>
            <li>
                <a href="/admin/categories"
                    class="nav-item <?= isset($activeTab) && $activeTab === 'categories' ? 'bg-white/10 text-white font-bold border-l-4 border-[#D71920]' : 'text-slate-400 hover:bg-white/5 hover:text-white' ?> flex items-center px-4 py-2.5 rounded-r-lg transition-colors text-sm font-medium group">
                    <i class="las la-tags text-lg w-7 text-slate-400 group-hover:text-white transition-colors"></i>
                    <span>Категориялар</span>
                </a>
            </li>
            <li>
                <a href="/admin/media"
                    class="nav-item <?= isset($activeTab) && $activeTab === 'media' ? 'bg-white/10 text-white font-bold border-l-4 border-[#D71920]' : 'text-slate-400 hover:bg-white/5 hover:text-white' ?> flex items-center px-4 py-2.5 rounded-r-lg transition-colors text-sm font-medium group">
                    <i class="las la-image text-lg w-7 text-slate-400 group-hover:text-white transition-colors"></i>
                    <span>Медиа-файлдар</span>
                </a>
            </li>
            <li>
                <a href="/admin/videos"
                    class="nav-item <?= isset($activeTab) && $activeTab === 'videos' ? 'bg-white/10 text-white font-bold border-l-4 border-[#D71920]' : 'text-slate-400 hover:bg-white/5 hover:text-white' ?> flex items-center px-4 py-2.5 rounded-r-lg transition-colors text-sm font-medium group">
                    <i class="las la-play-circle text-lg w-7 text-slate-400 group-hover:text-white transition-colors"></i>
                    <span>Бейнежазбалар</span>
                </a>
            </li>
            <li>
                <a href="/admin/ads"
                    class="nav-item <?= isset($activeTab) && $activeTab === 'ads' ? 'bg-white/10 text-white font-bold border-l-4 border-[#D71920]' : 'text-slate-400 hover:bg-white/5 hover:text-white' ?> flex items-center px-4 py-2.5 rounded-r-lg transition-colors text-sm font-medium group">
                    <i class="las la-ad text-lg w-7 text-slate-400 group-hover:text-white transition-colors"></i>
                    <span>Жарнама</span>
                </a>
            </li>

            <!-- System Section -->
            <li class="px-4 pt-5 pb-2 text-[10px] font-bold uppercase text-slate-400 tracking-wider">Жүйе</li>
            <li>
                <a href="/admin/users"
                    class="nav-item <?= isset($activeTab) && $activeTab === 'users' ? 'bg-white/10 text-white font-bold border-l-4 border-[#D71920]' : 'text-slate-400 hover:bg-white/5 hover:text-white' ?> flex items-center px-4 py-2.5 rounded-r-lg transition-colors text-sm font-medium group">
                    <i class="las la-users text-lg w-7 text-slate-400 group-hover:text-white transition-colors"></i>
                    <span>Администраторлар</span>
                </a>
            </li>
            <li>
                <a href="/admin/settings"
                    class="nav-item <?= isset($activeTab) && $activeTab === 'settings' ? 'bg-white/10 text-white font-bold border-l-4 border-[#D71920]' : 'text-slate-400 hover:bg-white/5 hover:text-white' ?> flex items-center px-4 py-2.5 rounded-r-lg transition-colors text-sm font-medium group">
                    <i class="las la-cog text-lg w-7 text-slate-400 group-hover:text-white transition-colors"></i>
                    <span>Баптаулар</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- User Info -->
    <div class="border-t border-white/10 p-4 bg-[#0c1626] m-3 rounded-xl mb-4 flex-shrink-0">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-[#D71920] rounded-lg flex items-center justify-center text-white font-bold shadow-sm">
                <?= mb_substr($_SESSION['admin_full_name'] ?? 'A', 0, 1, 'UTF-8') ?>
            </div>
            <div class="flex-1 overflow-hidden">
                <div class="text-white text-sm font-semibold truncate">
                    <?= htmlspecialchars($_SESSION['admin_full_name'] ?? 'Администратор') ?>
                </div>
                <a href="/admin/logout" class="text-xs text-slate-400 hover:text-[#D71920] transition-colors flex items-center gap-1 mt-0.5">
                    <i class="las la-sign-out-alt"></i> Шығу
                </a>
            </div>
        </div>
    </div>
</aside>

<script>
    function openAdminSidebar() {
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('adminSidebarOverlay');
        if (sidebar) sidebar.classList.remove('-translate-x-full');
        if (overlay) overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeAdminSidebar() {
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('adminSidebarOverlay');
        if (sidebar) sidebar.classList.add('-translate-x-full');
        if (overlay) overlay.classList.add('hidden');
        document.body.style.overflow = '';
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Автоматически добавляем кнопку "3 полоски" (гамбургер) в шапку каждой страницы админки
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.onclick = openAdminSidebar;
        btn.setAttribute('aria-label', 'Мәзір');
        btn.className = 'inline-flex items-center justify-center w-10 h-10 rounded-xl bg-[#101C31] hover:bg-[#D71920] text-white shadow-sm transition-colors focus:outline-none mr-3 flex-shrink-0';
        btn.innerHTML = '<i class="las la-bars text-xl"></i>';

        const header = document.querySelector('header');
        if (header) {
            const firstHeading = header.querySelector('h2, h1');
            if (firstHeading) {
                const wrapper = document.createElement('div');
                wrapper.className = 'flex items-center';
                firstHeading.parentNode.insertBefore(wrapper, firstHeading);
                wrapper.appendChild(btn);
                wrapper.appendChild(firstHeading);
            } else {
                header.insertBefore(btn, header.firstChild);
            }
        } else {
            // Для страниц без тега <header> (например, Категории)
            const firstHeading = document.querySelector('h1');
            if (firstHeading) {
                firstHeading.classList.add('flex', 'items-center');
                firstHeading.insertBefore(btn, firstHeading.firstChild);
            }
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeAdminSidebar();
        });
    });
</script>