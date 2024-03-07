<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title') | Buitenzorg Bibliotheca</title>

        {{-- Chart.js --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Tailwind CSS -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        {{-- Swiper --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

        {{-- Font Import --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

        {{-- Icon Import --}}
        <script src="https://kit.fontawesome.com/2356e25dd7.js" crossorigin="anonymous"></script>
    </head>
    <body class="
    @if(Route::currentRouteName() == 'homepage.book.show')
        bg-gradient-to-b from-greenjabar to-bluejabar
    @endif
        bg-greenjabar/10">
        <nav class="hidden px-3 lg:sticky lg:top-0 lg:py-2 lg:px-6 lg:mx-auto bg-white shadow lg:flex lg:flex-row lg:items-center lg:justify-between lg:z-10">
            <a href="{{ route('homepage.index') }}">
                <img src="{{ asset('img/nobg.png') }}" alt="Logo" class="w-[130px]">
            </a>
            <div class="items-center justify-center hidden lg:flex">
                <a href="{{ route('homepage.index') }}" class="p-2 bg-transparent text-sm text-center hover:text-greenjabar hover:underline">Beranda</a>
                <a href="
                @if(Auth::check())
                    {{route('homepage.book.index')}}
                @else
                    {{ route('login') }}
                @endif
                " class="p-2 bg-transparent text-sm text-center hover:text-greenjabar hover:underline">Buku</a>
                <a href="
                @if(Auth::check())
                    {{route('homepage.kategori.index')}}
                @else
                    {{ route('login') }}
                @endif
                " class="p-2 bg-transparent text-sm text-center hover:text-greenjabar hover:underline">Kategori</a>
            </div>

            <div class="
            @if (Auth::check())
            w-[30%]
            @endif
            w-[50%] flex flex-row">
                <form action="
                @if(Auth::check())
                    {{ route('buku.search') }}
                @else
                    {{ route('login') }}
                @endif" method="get" class="lg:flex flex-row flex-1">
                    <input type="text" name="search" id="search" placeholder="Cari Buku dengan Barcode atau Judul..." class="bg-gray-100 w-full rounded-l-lg px-4 py-2 border-none">
                    <button type="submit" class="bg-greenjabar rounded-r-lg px-4 py-2 ml-[-1px]">
                        <i class="fa-solid fa-magnifying-glass text-white"></i>
                    </button>
                </form>
            </div>

            <div class="flex flex-row space-x-1 items-center">
                @if (Auth::check())

                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-black space-x-2 hover:text-greenjabar rounded-lg text-sm px-1 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">

                    @if (Auth::user()->imguser)
                    {{-- Jika imguser tidak null --}}
                    <img src="{{ asset(Auth::user()->imguser) }}" alt="Admin Photo" class="h-10 max-h-md object-cover rounded-xl aspect-square mr-3"/>
                    @else
                        {{-- Jika imguser null --}}
                        <img src="{{ asset('img/user.png') }}" alt="Admin Photo" class="h-10 max-h-md object-cover rounded-xl aspect-square mr-3"/>
                    @endif


                    {{-- Welcome --}}
                    @php
                    // Set zona waktu sesuai dengan lokasi Anda
                    date_default_timezone_set('Asia/Jakarta');

                    // Mendapatkan waktu saat ini
                    $currentTime = date('H:i');

                    // Mengatur pesan selamat datang sesuai dengan waktu lokal
                    if ($currentTime >= '04:00' && $currentTime < '11:00') {
                        $welcomeMessage = 'Pagi';
                    } elseif ($currentTime >= '11:00' && $currentTime < '15:00') {
                        $welcomeMessage = 'Siang';
                    } elseif ($currentTime >= '15:00' && $currentTime < '18:00') {
                        $welcomeMessage = 'Sore';
                    } else {
                        $welcomeMessage = 'Malam';
                    }
                    @endphp

                    <p class="text-sm font-normal">{{ $welcomeMessage }}, {{ explode(' ', Auth::user()->namalengkap)[0] }}</p>

                    {{-- Dropdown Icon --}}
                    <i class="fa-solid fa-chevron-down"></i>
                </button>


                    <!-- Dropdown menu -->
                    <div id="dropdown" class="z-50 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li class="flex flex-row flex-1">
                            <a href="{{ route('user.peminjaman.show') }}" class="space-x-2 p-2 bg-transparent flex flex-row flex-1 items-center justify-center hover:text-greenjabar">
                                <i class="fa-solid fa-book-bookmark text-lg"></i>

                                <p class="text-sm">{{ $pinjamcount }}</p>
                                {{-- peminjaman::count --}}
                            </a>

                            <a href="{{ route('user.koleksi.show') }}" class="space-x-2 p-2 bg-transparent flex flex-row flex-1 items-center justify-center hover:text-greenjabar">
                                <i class="fa-regular fa-bookmark text-lg"></i>

                                <p class="text-sm">{{ $koleksicount }}</p>
                                {{-- koleksi::count  --}}
                            </a>

                            <a href="{{ route('user.ulasan.show') }}" class="space-x-2 p-2 bg-transparent flex flex-row flex-1 items-center justify-center hover:text-greenjabar">
                                <i class="fa-regular fa-comments"></i>

                                <p class="text-sm">{{ $ulasancount }}</p>
                                {{-- koleksi::count  --}}
                            </a>

                        </li>
                        <hr class="w-full bg-gray-100">
                        <li>
                            <a href="/homepage/profile/{{ Auth::user()->userid }}" class="block px-4 py-2 hover:bg-gray-100">
                            Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" class="block px-4 py-2 hover:bg-red-50 hover:text-red-500">
                            Logout
                            </a>
                        </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-3 py-2 bg-white text-black hover:text-greenjabar hover:underline rounded-lg">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="px-3 py-2 bg-greenjabar text-white rounded-lg">
                        Register
                    </a>
                @endif

            </div>

        </nav>



        <nav class="lg:hidden bg-white border-gray-200 dark:bg-gray-900">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('img/nobg.png') }}" class="h-10" alt="Flowbite Logo" />
            </a>
            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-greenjabar md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Homepage</a>
                </li>
                {{-- <li>
                    <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-greenjabar md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Books</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-greenjabar md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Categories</a>
                </li> --}}
                @if (Auth::check())
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Profile <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="/homepage/profile/{{ Auth::user()->userid }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-greenjabar md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Profile</a>
                            </li>
                            <li>
                                <a href="{{ route('user.peminjaman.show') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Your Loans</a>
                            </li>
                            <li>
                                <a href="{{ route('user.koleksi.show') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Your Collection</a>
                            </li>
                            <li>
                                <a href="{{ route('user.ulasan.show') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Your Reviews</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-greenjabar md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Logout</a>
                </li>
                @else
                <li>
                    <a href="{{ route('login') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-greenjabar md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Login</a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-greenjabar md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Register</a>
                </li>
                @endif
                </ul>
            </div>
            </div>
        </nav>


        <div class="
        @if(Route::currentRouteName() == 'homepage.index')
        w-full h-full
        @else
        py-4 px-6 lg:mb-[20%]
        @endif">
            @yield('content')
        </div>





        <footer class="bg-black">
            <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
                <div class="md:flex md:justify-between">
                  <div class="mb-6 md:mb-0">
                        <img src="{{ asset('img/bgblack.png') }}" alt="Logo" class="max-w-[10rem] lg:max-w-[15rem]">
                  </div>
                  <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                      <div>
                          <h2 class="mb-6 text-sm font-semibold text-white uppercase">Pages</h2>
                          <ul class="text-white font-medium">
                              <li class="mb-4">
                                  <a href="
                                    @if(Auth::check())
                                        {{route('homepage.book.index')}}
                                    @else
                                        {{ route('login') }}
                                    @endif" class="hover:underline hover:text-greenjabar">Books</a>
                              </li>
                              {{-- <li>
                                  <a href="#" class="hover:underline hover:text-greenjabar">Categories</a>
                              </li> --}}
                          </ul>
                      </div>
                  </div>
              </div>
              <hr class="my-6 border-greenjabar sm:mx-auto lg:my-8" />
              <div class="sm:flex sm:items-center sm:justify-between">
                  <span class="text-sm text-white sm:text-center dark">© 2024 Priyatama Techno Creation. All Rights Reserved.
                  </span>
              </div>
            </div>
        </footer>

    </body>


    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</html>
