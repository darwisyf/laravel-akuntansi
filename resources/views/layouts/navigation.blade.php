@auth
    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center fixed w-full">

        <div class="text-xl font-bold w-[50%]">
            Aplikasi Akuntansi
            @if (!Route::is('transaksi'))
                <a href="{{ route('transaksi') }}"
                    class="text-gray-700 rounded-md font-medium text-lg ml-7 px-2 py-2 hover:bg-blue-600 hover:text-white">
                    Input Transaksi
                </a>
            @endif

        </div>

        <div class="flex items-center gap-4">

            @if (auth()->check())
                <span>Halo, {{ auth()->user()->name }}</span>
            @endif

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}"> @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-sm hover:bg-red-600">
                    Logout
                </button>
            </form>

        </div>
    </nav>
@endauth