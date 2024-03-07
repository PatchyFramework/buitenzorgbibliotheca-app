<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | Dashboard BB</title>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Tailwind CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Font Import --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Icon Import --}}
    <script src="https://kit.fontawesome.com/2356e25dd7.js" crossorigin="anonymous"></script>
</head>
<body class="bg-slate-50 font-montserrat flex flex-row">
    <div class="absolute z-[0] bg-greenjabar w-[100vw] h-[300px]"></div>
    <aside class="relative h-[91vh] w-[300px] transform left-[1%] bg-white rounded-xl my-5 ms-4">
        <div class="flex flex-row space-x-2.5 header h-[5rem] bg-transparent items-center justify-center">
            <a class="m-0" href="{{route('dashboard.index')}}">
                <img src="{{ asset('img/nobg.png') }}" alt="Logo" class="w-[150px]">
            </a>
        </div>

        <hr class="font-bold mt-0">
        <div class="w-auto ">
            <ul class="flex flex-col justify-center m-auto list-none">
                <li class="relative py-3 px-5 m-3 rounded-lg text-greenjabar bg-white hover:bg-greenjabar/25 hover:bg-blur-xl hover:border-none hover:transition hover:duration-300 hover:font-bold transform hover:-translate-y-px font-normal  items-center justify-center">
                    <a href="{{ route('dashboard.index') }}" class="align-middle transition-all rounded-lg cursor-pointer bg-blue-500/0 leading-normal text-xs ease-in tracking-tight-rem bg-150 bg-x-25 hover:bg-blue-500/25 hover:-translate-y-px active:bg-blue/45">
                        <div class="icon icon-shape text-sm space-x-3 float-left rounded-md text-center me-2 d-flex items-center justify-center">
                            <i class="fa-solid fa-gauge"></i>
                            <span class="">Dashboard</span>
                        </div>
                    </a>
                </li>

                <li class="relative py-3 px-5 m-3 rounded-lg text-yellowjabar bg-white hover:bg-yellowjabar/25 hover:bg-blur-xl hover:border-none hover:transition hover:duration-300 hover:font-bold transform hover:-translate-y-px font-normal  items-center justify-center">
                    <a href="{{ route('kategori.index') }}" class="align-middle transition-all rounded-lg cursor-pointer bg-blue-500/0 leading-normal text-xs ease-in tracking-tight-rem bg-150 bg-x-25 hover:bg-blue-500/25 hover:-translate-y-px active:bg-blue/45">
                        <div class="icon icon-shape text-sm space-x-3 float-left rounded-md text-center me-2 d-flex items-center justify-center">
                            <i class="fa-solid fa-layer-group"></i>
                            <span class="">Data Kategori</span>
                        </div>
                    </a>
                </li>

                <li class="relative py-3 px-5 m-3 rounded-lg text-bluejabar bg-white hover:bg-bluejabar/25 hover:bg-blur-xl hover:border-none hover:transition hover:duration-300 hover:font-bold transform hover:-translate-y-px font-normal  items-center justify-center">
                    <a href="{{ route('buku.index') }}" class="align-middle transition-all rounded-lg cursor-pointer bg-blue-500/0 leading-normal text-xs ease-in tracking-tight-rem bg-150 bg-x-25 hover:bg-blue-500/25 hover:-translate-y-px active:bg-blue/45">
                        <div class="icon icon-shape text-sm space-x-3 float-left rounded-md text-center me-2 d-flex items-center justify-center">
                            <i class="fa-solid fa-book"></i>
                            <span class="">Data Buku</span>
                        </div>
                    </a>
                </li>

                
                @role('admin')
                    <li class="relative py-3 px-5 m-3 rounded-lg text-darkbluejabar bg-white hover:bg-darkbluejabar/25 hover:bg-blur-xl hover:border-none hover:transition hover:duration-300 hover:font-bold transform hover:-translate-y-px font-normal items-center justify-center">
                        <a href="{{ route('users.index') }}" class="align-middle transition-all rounded-lg cursor-pointer bg-blue-500/0 leading-normal text-xs ease-in tracking-tight-rem bg-150 bg-x-25 hover:bg-blue-500/25 hover:-translate-y-px active:bg-blue/45">
                            <div class="icon icon-shape text-sm space-x-3 float-left rounded-md text-center me-2 d-flex items-center justify-center">
                                <i class="fa-solid fa-users"></i>
                                <span class="text-[10px]">Pengelolaan Pengguna</span>
                            </div>
                        </a>
                    </li>
                @endrole
            

                <li class="relative py-3 px-5 m-3 rounded-lg text-darkbluejabar bg-white hover:bg-darkbluejabar/25 hover:bg-blur-xl hover:border-none hover:transition hover:duration-300 hover:font-bold transform hover:-translate-y-px font-normal  items-center justify-center">
                    <a href="{{ route('peminjaman.index') }}" class="align-middle transition-all rounded-lg cursor-pointer bg-blue-500/0 leading-normal text-xs ease-in tracking-tight-rem bg-150 bg-x-25 hover:bg-blue-500/25 hover:-translate-y-px active:bg-blue/45">
                        <div class="icon icon-shape text-sm space-x-3 float-left rounded-md text-center me-2 d-flex items-center justify-center">
                            <i class="fa-solid fa-file-signature"></i>
                            <span class="text-[10px]">Pengelolaan Peminjaman Buku</span>
                        </div>
                    </a>
                </li>

                <li id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="relative cursor-pointer py-3 px-5 m-3 rounded-lg text-darkbluejabar bg-white hover:bg-darkbluejabar/25 hover:bg-blur-xl hover:border-none hover:transition hover:duration-300 hover:font-bold transform hover:-translate-y-px font-normal  items-center justify-center">
                    <div class="icon icon-shape text-sm space-x-3 float-left rounded-md text-center me-2 d-flex items-center justify-center hover:transition hover:duration-300">
                        <i class="fa-solid fa-file-signature"></i>
                        <span class="text-[10px]">Pengelolaan Peminjaman</span>
                    </div>
                </li>

                <!-- Dropdown menu -->
                <div id="dropdown" class="z-50 hidden bg-white divide-y divide-gray-100 rounded-lg shadow relative p-2 m-2 w-[90%] space-y-3 dark:bg-gray-700">
                    <ul class=" text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li class="px-2 py-3 m-2 rounded-lg text-darkbluejabar bg-white hover:bg-darkbluejabar/25 hover:bg-blur-xl hover:border-none hover:transition hover:duration-300 hover:font-bold transform hover:-translate-y-px font-normal flex flex-col items-center justify-between">
                            <a href="{{ route('peminjaman.kedaluwarsa.index') }}" class="align-middle transition-all rounded-lg cursor-pointer bg-blue-500/0 leading-normal text-xs ease-in tracking-tight-rem bg-150 bg-x-25 hover:-translate-y-px active:bg-blue/45">
                                <div class="icon icon-shape text-sm space-x-3 float-left rounded-md text-center me-2 d-flex items-center justify-center">
                                    <i class="fa-solid fa-file-signature"></i>
                                    <span class="text-[10px]">Peminjaman Buku Kedaluwarsa</span>
                                </div>
                            </a>
                        </li>

                        <li class="px-2 py-3 m-2 rounded-lg text-darkbluejabar bg-white hover:bg-darkbluejabar/25 hover:bg-blur-xl hover:border-none hover:transition hover:duration-300 hover:font-bold transform hover:-translate-y-px font-normal flex flex-col items-center justify-between">
                            <a href="{{ route('peminjaman.dikembalikan.index') }}" class="align-middle transition-all rounded-lg cursor-pointer bg-blue-500/0 leading-normal text-xs ease-in tracking-tight-rem bg-150 bg-x-25 hover:-translate-y-px active:bg-blue/45">
                                <div class="icon icon-shape text-sm space-x-3 float-left rounded-md text-center me-2 d-flex items-center justify-center">
                                    <i class="fa-solid fa-file-signature"></i>
                                    <span class="text-[10px]">Peminjaman Buku Dikembalikan</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </ul>
        </div>      
    </aside>

    <div class="relative flex-1 flex flex-col items-center ml-10 my-5 space-y-2">
        <nav class="text-white px-0 mx-4 shadow-none rounded-xl my-[2%] left-0 w-full relative">
            <div class="flex flex-wrap items-center">
                <ol class="flex flex-wrap list-none bg-transparent mb-0 ml-1 pb-0 pt-1 px-0">
                    <li class="text-sm"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                    <li class="text-sm">/</li>
                    <h6 class="text-sm font-semibold mb-0">@yield('title')</h6>
                </ol>
        
                <div class="absolute right-5">
                    <ul class="flex flex-row items-center justify-center m-auto list-none">
                        <li class="relative m-2 rounded-lg bg-slate-50 font-normal bg-transparent items-center justify-center flex">
                            <div class="flex items-center space-x-3">
                                @if (Auth::user()->imguser)
                                {{-- Jika imguser tidak null --}}
                                <img src="{{ asset(Auth::user()->imguser) }}" alt="Admin Photo" class="h-10 max-h-md object-cover rounded-xl aspect-square mr-2"/>
                                @else
                                    {{-- Jika imguser null --}}
                                    <img src="{{ asset('img/user.png') }}" alt="Admin Photo" class="h-10 max-h-md object-cover rounded-xl aspect-square"/>
                                @endif   
                    
                                <!-- Nama Lengkap -->
                                <p class="text-xs font-normal">Hi, <span class="font-bold">{{ Auth::user()->username }}</span></p> 
                                
                                <!-- Tombol Logout -->
                                <a href="{{ route('logout') }}" class="bg-red-600 text-white hover:bg-black hover:text-white hover:border-none hover:transition hover:duration-300 text-xs p-2 font-bold rounded ml-2">
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
          

        <div class="container-fluid py-3 mr-4 
        @if(Route::currentRouteName() !== 'dashboard.index') 
        bg-white rounded-lg 
        @endif 
        p-3 max-w-full w-full">
            @yield('content')
        </div>
    </div>




    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>