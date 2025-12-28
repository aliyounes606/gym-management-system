<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GymPro - Extreme Fitness</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=black-ops-one:400|roboto:400,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-900 font-['Roboto'] text-white">

    <nav
        class="absolute top-0 w-full z-50 p-6 flex justify-between items-center bg-gradient-to-b from-black/50 to-transparent">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-indigo-500" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            <span class="text-2xl font-black tracking-tighter text-white uppercase italic">
                GYM<span class="text-indigo-500">PRO</span>
            </span>
        </div>

        @if (Route::has('login'))
            <div class="flex gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md font-bold transition">لوحة
                        التحكم</a>
                @else
                    <a href="{{ route('login') }}"
                        class="text-white hover:text-indigo-400 font-semibold py-2 transition">تسجيل الدخول</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md font-bold transition shadow-lg shadow-indigo-500/50">ابدأ
                            الآن</a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>

    <div class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&q=80&w=2070"
                class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-gray-900"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-4xl">
            <h1 class="text-5xl md:text-8xl font-['Black_Ops_One'] uppercase leading-none mb-4 tracking-tighter">
                Train Like a <span class="text-indigo-500">Pro</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-400 mb-10 max-w-2xl mx-auto leading-relaxed">
                نظام <span class="text-white font-bold italic">GYMPRO</span> المتكامل لإدارة الأندية الرياضية. القوة،
                التنظيم، والنتائج في منصة واحدة.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('register') }}"
                    class="bg-white text-indigo-900 text-lg px-8 py-4 rounded-md font-black uppercase transition-all hover:bg-indigo-500 hover:text-white transform hover:-translate-y-1">
                    انضم إلينا اليوم
                </a>
            </div>
        </div>
    </div>

    <section class="py-20 bg-gray-800">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-8">
            <div class="bg-gray-900 p-8 rounded-xl border border-gray-700 hover:border-indigo-500 transition">
                <div class="text-indigo-500 mb-4 font-black text-4xl">01</div>
                <h3 class="text-xl font-bold mb-2 uppercase italic text-white">إدارة الجلسات</h3>
                <p class="text-gray-400">تنظيم مواعيد التدريب والحجوزات بدقة متناهية.</p>
            </div>
            <div class="bg-gray-900 p-8 rounded-xl border border-gray-700 hover:border-indigo-500 transition">
                <div class="text-indigo-500 mb-4 font-black text-4xl">02</div>
                <h3 class="text-xl font-bold mb-2 uppercase italic text-white">صيانة المعدات</h3>
                <p class="text-gray-400">متابعة حالة الأجهزة وضمان جاهزيتها دائماً.</p>
            </div>
            <div class="bg-gray-900 p-8 rounded-xl border border-gray-700 hover:border-indigo-500 transition">
                <div class="text-indigo-500 mb-4 font-black text-4xl">03</div>
                <h3 class="text-xl font-bold mb-2 uppercase italic text-white">أنظمة التغذية</h3>
                <p class="text-gray-400">خطط غذائية مخصصة من المدربين مباشرة للمشتركين.</p>
            </div>
        </div>
    </section>

</body>

</html>
