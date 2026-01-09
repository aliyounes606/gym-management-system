<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GymPro - Extreme Fitness</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=black-ops-one:400|cairo:200,300,400,600,700,900" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-950 font-['Cairo'] text-white text-right selection:bg-indigo-500 selection:text-white">

    <nav class="absolute top-0 w-full z-50 p-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-3 group cursor-pointer">
                <div class="relative">
                    <div
                        class="absolute -inset-1 bg-indigo-500 rounded-full blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200">
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="relative w-10 h-10 text-indigo-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-2xl font-black tracking-tighter text-white uppercase italic font-['Black_Ops_One']">
                    GYM<span class="text-indigo-500">PRO</span>
                </span>
            </div>

            @if (Route::has('login'))
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-bold transition duration-300">
                            لوحة التحكم
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="hidden md:block text-gray-300 hover:text-white font-semibold transition duration-300">
                            تسجيل الدخول
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-2 rounded-lg font-bold transition duration-300 shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50">
                                ابدأ الآن
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    <div class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=2070&auto=format&fit=crop"
                class="w-full h-full object-cover opacity-20 scale-105 animate-pulse-slow">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-900/80 to-gray-950/90"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto mt-16">
            <div
                class="inline-block mb-4 px-4 py-1 rounded-full border border-indigo-500/30 bg-indigo-500/10 backdrop-blur-sm">
                <span class="text-indigo-400 text-sm font-bold tracking-wider uppercase">الإصدار الجديد v2.0</span>
            </div>

            <h1
                class="text-6xl md:text-9xl font-['Black_Ops_One'] uppercase leading-none mb-6 tracking-tighter drop-shadow-2xl">
                Train Like a <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-indigo-600">Pro</span>
            </h1>

            <p class="text-lg md:text-2xl text-gray-300 mb-12 max-w-2xl mx-auto leading-relaxed font-light">
                نظام <span class="text-white font-bold">GYMPRO</span> المتكامل لإدارة الأندية الرياضية.
                <br>
                <span class="text-indigo-400 font-semibold">القوة</span>، <span
                    class="text-indigo-400 font-semibold">التنظيم</span>، و<span
                    class="text-indigo-400 font-semibold">النتائج</span> في منصة واحدة.
            </p>

            <div class="flex flex-col md:flex-row justify-center gap-6">
                <a href="{{ route('register') }}"
                    class="group relative bg-white text-indigo-950 text-xl px-10 py-4 rounded-lg font-black uppercase transition-all hover:bg-indigo-500 hover:text-white overflow-hidden">
                    <span class="relative z-10">انضم إلينا اليوم</span>
                    <div
                        class="absolute inset-0 h-full w-full scale-0 rounded-lg transition-all duration-300 group-hover:scale-100 group-hover:bg-indigo-600/10">
                    </div>
                </a>
                <a href="#features"
                    class="border border-gray-600 text-gray-300 hover:border-white hover:text-white text-xl px-10 py-4 rounded-lg font-bold transition-all">
                    اكتشف المميزات
                </a>
            </div>
        </div>
    </div>

    <section id="features" class="py-24 bg-gray-950 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">لماذا تختار <span class="text-indigo-500">GYMPRO</span>؟
                </h2>
                <div class="w-24 h-1 bg-indigo-600 mx-auto rounded-full"></div>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div
                    class="group bg-gray-900 p-8 rounded-2xl border border-gray-800 hover:border-indigo-500/50 transition duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-indigo-500/10">
                    <div
                        class="w-14 h-14 bg-gray-800 rounded-lg flex items-center justify-center mb-6 group-hover:bg-indigo-600 transition duration-300">
                        <span class="text-indigo-500 group-hover:text-white font-black text-2xl">01</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-white group-hover:text-indigo-400 transition">إدارة الجلسات
                    </h3>
                    <p class="text-gray-400 leading-relaxed">نظام حجز ذكي يمنع التعارض وينظم مواعيد التدريب بدقة متناهية
                        لك وللمشتركين.</p>
                </div>

                <div
                    class="group bg-gray-900 p-8 rounded-2xl border border-gray-800 hover:border-indigo-500/50 transition duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-indigo-500/10">
                    <div
                        class="w-14 h-14 bg-gray-800 rounded-lg flex items-center justify-center mb-6 group-hover:bg-indigo-600 transition duration-300">
                        <span class="text-indigo-500 group-hover:text-white font-black text-2xl">02</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-white group-hover:text-indigo-400 transition">صيانة المعدات
                    </h3>
                    <p class="text-gray-400 leading-relaxed">تتبع دوري لحالة الأجهزة مع تنبيهات تلقائية للصيانة لضمان
                        سلامة النادي.</p>
                </div>

                <div
                    class="group bg-gray-900 p-8 rounded-2xl border border-gray-800 hover:border-indigo-500/50 transition duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-indigo-500/10">
                    <div
                        class="w-14 h-14 bg-gray-800 rounded-lg flex items-center justify-center mb-6 group-hover:bg-indigo-600 transition duration-300">
                        <span class="text-indigo-500 group-hover:text-white font-black text-2xl">03</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-white group-hover:text-indigo-400 transition">أنظمة التغذية
                    </h3>
                    <p class="text-gray-400 leading-relaxed">بناء جداول غذائية محسوبة السعرات الحرارية ومخصصة لكل مشترك
                        بضغطة زر.</p>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
