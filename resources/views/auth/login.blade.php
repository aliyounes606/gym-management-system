<x-guest-layout>
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gray-950 relative overflow-hidden">

        <div
            class="absolute top-[-20%] right-[-10%] w-96 h-96 bg-indigo-600/20 rounded-full blur-[100px] pointer-events-none">
        </div>
        <div
            class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-5 pointer-events-none">
        </div>

        <div class="w-full max-w-md relative z-10">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <div class="mb-10 text-center lg:text-right">
                <a href="/" class="inline-flex items-center gap-2 mb-6">
                    <span
                        class="text-3xl font-black tracking-tighter text-white uppercase italic font-['Black_Ops_One']">
                        GYM<span class="text-indigo-500">PRO</span>
                    </span>
                </a>
                <h2 class="text-3xl font-bold text-white mb-2">مرحباً بعودتك 👋</h2>
                <p class="text-gray-400">تابع تقدمك ولا تتوقف الآن.</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div class="group">
                    <label class="block text-xs font-bold text-indigo-400 uppercase tracking-wider mb-2">البريد
                        الإلكتروني</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 group-focus-within:text-indigo-400 transition"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                </path>
                            </svg>
                        </div>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus
                            class="w-full bg-gray-900/50 border border-gray-800 text-white text-lg rounded-xl py-4 pr-12 pl-4 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 placeholder-gray-600 transition-all duration-300 shadow-inner">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-sm" />
                </div>

                <div class="group">
                    <label class="block text-xs font-bold text-indigo-400 uppercase tracking-wider mb-2">كلمة
                        المرور</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 group-focus-within:text-indigo-400 transition"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="w-full bg-gray-900/50 border border-gray-800 text-white text-lg rounded-xl py-4 pr-12 pl-4 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 placeholder-gray-600 transition-all duration-300 shadow-inner">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-sm" />
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox"
                            class="rounded bg-gray-800 border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-400">{{ __('تذكرني') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-400 hover:text-white transition-colors"
                            href="{{ route('password.request') }}">
                            {{ __('نسيت كلمة المرور؟') }}
                        </a>
                    @endif
                </div>

                <button type="submit"
                    class="w-full group relative flex items-center justify-center py-4 px-4 border border-transparent text-lg font-black rounded-xl text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 shadow-lg shadow-indigo-600/30 overflow-hidden">
                    <div
                        class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-in-out">
                    </div>
                    تسجيل الدخول
                </button>

                <div class="text-center mt-6">
                    <p class="text-gray-500 text-sm">
                        ليس لديك حساب؟
                        <a href="{{ route('register') }}"
                            class="text-indigo-400 font-bold hover:text-white transition-colors underline decoration-indigo-500/30 hover:decoration-white">انضم
                            إلينا الآن</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <div class="hidden lg:flex w-1/2 bg-gray-900 relative items-center justify-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1599058945522-28d584b6f0ff?q=80&w=2069&auto=format&fit=crop"
            class="absolute inset-0 w-full h-full object-cover opacity-50 mix-blend-overlay">

        <div class="absolute inset-0 bg-gradient-to-br from-gray-950 via-gray-900/80 to-purple-900/30"></div>

        <div class="relative z-10 max-w-lg text-center px-12">
            <h1
                class="text-6xl font-black text-white font-['Black_Ops_One'] uppercase leading-tight mb-6 tracking-wide drop-shadow-2xl">
                Focus on<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">Your
                    Goal</span>
            </h1>
            <p class="text-xl text-gray-300 font-light leading-relaxed">
                التزامك اليوم هو قوتك غداً.
            </p>
        </div>
    </div>
</x-guest-layout>
