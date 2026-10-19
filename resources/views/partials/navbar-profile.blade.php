<div class="relative" id="profileDropdownContainer">
    @auth
        <button onclick="document.getElementById('profileMenu').classList.toggle('hidden')" id="profileBtn" class="flex items-center gap-2 p-1 pr-3 bg-gray-50 border border-gray-200 rounded-full hover:border-facc transition focus:outline-none">
            <div class="p-1.5 bg-white rounded-full text-gray-600 shadow-sm border border-gray-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <span class="text-sm font-bold text-gray-700">{{ auth()->user()->name }}</span>
        </button>
        <div id="profileMenu" class="absolute right-0 mt-2 w-52 bg-white rounded-2xl shadow-xl py-2 border border-gray-100 hidden z-50">
            @if(auth()->user()->isAdmin())
                <div class="px-4 py-2 border-b border-gray-100 mb-1">
                    <p class="text-[10px] font-bold text-facc uppercase tracking-widest">Admin</p>
                    <p class="text-sm font-bold text-gray-900">{{ auth()->user()->name }}</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-facc font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard Admin
                </a>
            @else
                <div class="px-4 py-2 border-b border-gray-100 mb-1">
                    <p class="text-[10px] font-bold text-facc uppercase tracking-widest">Customer</p>
                    <p class="text-sm font-bold text-gray-900">{{ auth()->user()->name }}</p>
                </div>
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-facc font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Profil Saya
                </a>
                <a href="{{ route('sell.history') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-facc font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Periksa Ajuan
                </a>
                <a href="{{ route('orders.index') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-facc font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    Riwayat Pesanan
                </a>
            @endif
            <div class="border-t border-gray-100 mt-1 pt-1">
                <form action="{{ route('logout') }}" method="POST" class="block w-full text-left">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    @else
        <div class="relative group">
            <a href="{{ route('login') }}" class="p-2 flex items-center justify-center text-gray-600 hover:text-facc bg-gray-50 border border-gray-200 rounded-full transition cursor-pointer">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </a>
            <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 border border-gray-100 hidden group-hover:block z-50">
                <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-facc font-medium">Login</a>
                <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-facc font-medium">Register</a>
            </div>
        </div>
    @endauth
</div>

<script>
    document.addEventListener('click', function(event) {
        const btn = document.getElementById('profileBtn');
        const menu = document.getElementById('profileMenu');
        if (btn && menu) {
            if (!btn.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
            }
        }
    });
</script>
