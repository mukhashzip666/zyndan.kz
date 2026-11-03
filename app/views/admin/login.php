<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кіру - CMS ZYNDAN.KZ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon.png">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #101C31;
        }
        .zyndan-login-logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            border-radius: 12px;
            padding: 8px;
        }
        .zyndan-login-logo img {
            height: 110px;
            width: auto;
            object-fit: contain;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-md">
        <!-- Логотип -->
        <div class="text-center mb-8">
            <div class="zyndan-login-logo shadow-lg mb-3 border border-white/20">
                <img src="/assets/zyndan-logo.jpg?v=2" alt="ZYNDAN.KZ">
            </div>
            <div class="h-[2px] w-24 mx-auto bg-[#D71920] my-2"></div>
            <p class="text-slate-300 text-xs font-semibold uppercase tracking-widest">Басқару жүйесі / CMS</p>
        </div>

        <!-- Форма входа -->
        <div class="bg-white rounded-2xl shadow-2xl p-8 border border-white/10">
            <h2 class="text-2xl font-black text-[#101C31] mb-6 text-center tracking-tight">Кіру / Вход</h2>

            <?php if (isset($error)): ?>
                <div class="bg-red-50 border-l-4 border-[#D71920] text-[#D71920] px-4 py-3 rounded mb-5 text-sm font-medium">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="/admin/login" method="POST">
                <!-- Username -->
                <div class="mb-5">
                    <label class="block text-slate-800 text-xs font-bold uppercase tracking-wider mb-2" for="username">
                        <i class="fas fa-user mr-1 text-slate-400"></i> Пайдаланушы аты / Логин
                    </label>
                    <input type="text" id="username" name="username"
                        class="w-full px-4 py-3 bg-[#F5F6F8] border border-[#E5E7EB] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#101C31] focus:bg-white transition text-sm"
                        placeholder="admin" required autofocus>
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <label class="block text-slate-800 text-xs font-bold uppercase tracking-wider mb-2" for="password">
                        <i class="fas fa-lock mr-1 text-slate-400"></i> Құпия сөз / Пароль
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-3 bg-[#F5F6F8] border border-[#E5E7EB] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#101C31] focus:bg-white transition pr-12 text-sm"
                            placeholder="••••••••" required>
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-[#101C31] focus:outline-none">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" class="form-checkbox h-4 w-4 text-[#D71920] rounded border-gray-300">
                        <span class="ml-2 text-xs text-slate-600 font-medium">Мені есте сақта / Запомнить меня</span>
                    </label>
                </div>

                <?php
                // CSRF токен
                require_once __DIR__ . '/../../helpers/CSRFHelper.php';
                echo \CSRFHelper::field();
                ?>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-[#101C31] hover:bg-[#D71920] text-white font-bold py-3.5 px-4 rounded-xl transition duration-200 shadow-md uppercase tracking-wider text-xs">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Кіру / Войти
                </button>
            </form>

            <!-- Footer Info -->
            <div class="mt-6 text-center text-xs text-slate-400">
                <p class="font-bold text-slate-600">© <?= date('Y') ?> ZYNDAN.KZ</p>
                <p class="mt-0.5 text-[11px]">Барлық құқықтар қорғалған</p>
            </div>
        </div>

    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function (e) {
            e.preventDefault();
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        });
    </script>
</body>

</html>