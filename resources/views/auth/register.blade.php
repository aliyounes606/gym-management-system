<x-guest-layout>
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gray-950 relative overflow-hidden">

        <div
            class="absolute top-[-20%] right-[-10%] w-96 h-96 bg-indigo-600/20 rounded-full blur-[100px] pointer-events-none">
        </div>
        <div
            class="absolute bottom-[-20%] left-[-10%] w-96 h-96 bg-purple-900/20 rounded-full blur-[100px] pointer-events-none">
        </div>

        <div
            class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-5 pointer-events-none">
        </div>

        <div class="w-full max-w-md relative z-10">
            <div class="mb-10 text-center lg:text-right">
                <a href="/" class="inline-flex items-center gap-2 mb-6 group">
                    <div
                        class="relative w-10 h-10 flex items-center justify-center bg-indigo-600 rounded-lg transform rotate-3 group-hover:rotate-0 transition duration-300 shadow-lg shadow-indigo-500/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span
                        class="text-3xl font-black tracking-tighter text-white uppercase italic font-['Black_Ops_One']">
                        GYM<span class="text-indigo-500">PRO</span>
                    </span>
                </a>
                <h2 class="text-3xl font-bold text-white mb-2">ابدأ التحدي ⚡</h2>
                <p class="text-gray-400">بياناتك هي خطوتك الأولى نحو الجسم المثالي.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <div class="group">
                    <label class="block text-xs font-bold text-indigo-400 uppercase tracking-wider mb-2">الاسم
                        الكامل</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 group-focus-within:text-indigo-400 transition"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus
                            placeholder="الكابتن..."
                            class="w-full bg-gray-900/50 border border-gray-800 text-white text-lg rounded-xl py-4 pr-12 pl-4 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 placeholder-gray-600 transition-all duration-300 shadow-inner">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400 text-sm" />
                </div>

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
                        <input id="email" type="email" name="email" :value="old('email')" required
                            placeholder="username@gympro.com"
                            class="w-full bg-gray-900/50 border border-gray-800 text-white text-lg rounded-xl py-4 pr-12 pl-4 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 placeholder-gray-600 transition-all duration-300 shadow-inner">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-sm" />
                </div>

                {{-- <div class="grid grid-cols-2 gap-5">
                    <div class="group">
                        <label
                            class="block text-xs font-bold text-indigo-400 uppercase tracking-wider mb-2">العمر</label>
                        <div class="relative">
                            <input id="age" type="number" name="age" :value="old('age')" required
                                class="w-full bg-gray-900/50 border border-gray-800 text-white text-lg rounded-xl py-4 px-4 text-center font-mono focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all shadow-inner">
                            <span
                                class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-600 text-xs font-bold bg-gray-800 px-2 py-1 rounded">سنة</span>
                        </div>
                    </div>
                    <div class="group">
                        <label class="block text-xs font-bold text-indigo-400 uppercase tracking-wider mb-2">الوزن
                            الحالي</label>
                        <div class="relative">
                            <input id="weight" type="number" step="0.1" name="weight" :value="old('weight')"
                                required
                                class="w-full bg-gray-900/50 border border-gray-800 text-white text-lg rounded-xl py-4 px-4 text-center font-mono focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all shadow-inner">
                            <span
                                class="absolute left-3 top-1/2 -translate-y-1/2 text-indigo-400 text-xs font-bold bg-indigo-500/10 px-2 py-1 rounded border border-indigo-500/20">KG</span>
                        </div>
                    </div>
                </div> --}}

                <div class="space-y-4">
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
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                placeholder="••••••••"
                                class="w-full bg-gray-900/50 border border-gray-800 text-white text-lg rounded-xl py-4 pr-12 pl-4 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 placeholder-gray-600 transition-all duration-300 shadow-inner">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-sm" />
                    </div>

                    <div class="group">
                        <div class="relative">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 group-focus-within:text-indigo-400 transition"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                placeholder="تأكيد كلمة المرور"
                                class="w-full bg-gray-900/50 border border-gray-800 text-white text-lg rounded-xl py-4 pr-12 pl-4 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 placeholder-gray-600 transition-all duration-300 shadow-inner">
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="w-full group relative flex items-center justify-center py-4 px-4 border border-transparent text-lg font-black rounded-xl text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 shadow-lg shadow-indigo-600/30 overflow-hidden mt-8">
                    <div
                        class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-in-out">
                    </div>
                    <span class="relative flex items-center gap-2">
                        اشترك وانطلق
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </span>
                </button>

                <div class="text-center mt-6">
                    <p class="text-gray-500 text-sm">
                        لديك حساب بالفعل؟
                        <a href="{{ route('login') }}"
                            class="text-indigo-400 font-bold hover:text-white transition-colors underline decoration-indigo-500/30 hover:decoration-white">سجل
                            دخولك</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <div class="hidden lg:flex w-1/2 bg-indigo-900 relative items-center justify-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?q=80&w=2070&auto=format&fit=crop"
            class="absolute inset-0 w-full h-full object-cover opacity-60 mix-blend-overlay">

        <div class="absolute inset-0 bg-gradient-to-br from-gray-950 via-indigo-950/80 to-indigo-900/50"></div>

        <div class="relative z-10 max-w-lg text-center px-12">
            <div
                class="mb-6 inline-block p-4 rounded-full border border-white/10 bg-white/5 backdrop-blur-md animate-pulse-slow">
                <svg class="w-12 h-12 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                    </path>
                </svg>
            </div>
            <h1
                class="text-6xl font-black text-white font-['Black_Ops_One'] uppercase leading-tight mb-6 tracking-wide drop-shadow-2xl">
                No Pain<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">No
                    Gain</span>
            </h1>
            <p class="text-xl text-gray-300 font-light leading-relaxed">
                انضم إلى مجتمع النخبة. تتبع أدائك، حسن أرقامك، وحقق المستحيل.
            </p>

            <div class="mt-12 flex justify-center gap-8 border-t border-white/10 pt-8">
                <div>
                    <span class="block text-3xl font-bold text-white">5k+</span>
                    <span class="text-sm text-indigo-200 uppercase tracking-widest">مشترك</span>
                </div>
                <div>
                    <span class="block text-3xl font-bold text-white">120</span>
                    <span class="text-sm text-indigo-200 uppercase tracking-widest">برنامج</span>
                </div>
                <div>
                    <span class="block text-3xl font-bold text-white">24/7</span>
                    <span class="text-sm text-indigo-200 uppercase tracking-widest">دعم</span>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
