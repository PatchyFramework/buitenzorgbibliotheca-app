@extends('./components/layoutpeminjam')

@section('title', 'Profile')

@section('content')


    <div class="block m-auto font-montserrat lg:max-w-[75%] p-4 bg-white border border-gray-300 rounded-lg mb-10">
        <div class="flex flex-col lg:flex-row flex-1 justify-between">
            <div class="text-center lg:text-left">
                @if (Auth::user()->imguser)
                {{-- Jika imguser tidak null --}}
                <img src="{{ asset(Auth::user()->imguser) }}" alt="Admin Photo" class="w-36 h-36 sm:m-auto object-cover rounded lg:mr-5"/> <!-- Tambahkan kelas 'mx-auto' untuk membuat gambar berada di tengah secara horizontal -->
                @else
                    {{-- Jika imguser null --}}
                    <img src="{{ asset('img/user.png') }}" alt="Admin Photo" class="w-36 h-36 mx-auto object-cover rounded lg:mr-5"/> <!-- Tambahkan kelas 'mx-auto' untuk membuat gambar berada di tengah secara horizontal -->
                @endif  
            </div>
            <div class="flex flex-col flex-1 space-y-4">
                <div class="flex flex-col lg:flex-row space-x-2 items-center">
                    <p class="text-lg font-semibold text-black">{{Auth::user()->namalengkap}}</p>
                    @if(Auth::user()->email_verified_at === 1)
                    <div class="flex flex-row flex-1 items-center space-x-3">
                        <i class="fa-regular fa-circle-check text-greenjabar"></i>
                        <div class="px-2 py-1 font-semibold rounded bg-green-100 border-greenjabar border text-xs text-greenjabar">
                            Akun terverifikasi
                        </div>
                    </div>
                    @else
                        <i class="fa-regular fa-circle-xmark text-red-500"></i>
                        <div class="px-2 py-1 font-semibold rounded bg-red-100 border-red-500 border text-xs text-red-500">
                            Akun belum terverifikasi
                        </div>
                    @endif
                </div>

                <div class="flex flex-col items-center justify-center lg:justify-start lg:items-start lg:flex-row lg:space-x-3 space-y-3 lg:space-y-0">
                    <div class="flex flex-row flex-1 space-x-2 items-center">
                        <i class="fa-solid fa-id-card text-xs lg:text-sm text-slate-500"></i>
                        <p class="text-xs lg:text-sm text-slate-500">
                            Bergabung sejak:
                        </p>
                        <p class="text-xs lg:text-sm text-slate-500">{{Auth::user()->created_at}}</p>
                    </div>
                
                    <div class="flex flex-col lg:flex-row lg:space-x-3 lg:space-y-0 space-y-3">
                        <div class="flex flex-row items-center space-x-3 p-2 rounded border border-greenjabar">
                            <i class="fa-solid fa-check-to-slot text-greenjabar text-md p-2 rounded-full bg-green-100"></i>
                            <div class="flex flex-col">
                                <p class="text-sm text-greenjabar font-semibold">{{ $pinjamcount }}</p>
                                <p class="text-sm font-normal text-black">Peminjaman</p>
                            </div>
                        </div>
                        <div class="flex flex-row items-center space-x-3 p-2 rounded border border-yellowjabar">
                            <i class="fa-solid fa-table-cells-large text-yellowjabar text-md p-2 rounded-full bg-yellow-100"></i>
                            <div class="flex flex-col">
                                <p class="text-sm text-yellowjabar font-semibold">{{ $koleksicount }}</p>
                                <p class="text-sm font-normal text-black">Koleksi</p>
                            </div>
                        </div>
                        <div class="flex flex-row items-center space-x-3 p-2 rounded border border-darkbluejabar">
                            <i class="fa-regular fa-comments text-darkbluejabar text-md p-2 rounded-full bg-bluejabar/20"></i>
                            <div class="flex flex-col">
                                <p class="text-sm text-darkbluejabar font-semibold">{{ $ulasancount }}</p>
                                <p class="text-sm font-normal text-black">Ulasan</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-6 items-center justify-between m-auto font-montserrat lg:max-w-[75%]">

        <div class="block lg:w-[50%] w-full h-fit p-6 bg-white border border-gray-300 rounded-lg">
            <div class="flex flex-row justify-between items-center mb-5">
                <h5 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white">Biodata</h5>
                <button data-modal-target="crudmodal" data-modal-toggle="crudmodal" class="block text-white bg-darkbluejabar hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-2 text-center" type="button">
                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                    Ubah Biodata
                </button>
            </div>

            <hr class="w-full bg-gray-400 my-4">

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <div class="text-md font-semibold">Username</div>
                    <div class="text-md font-normal">{{Auth::user()->username}}</div>
                </div>
                <div>
                    <div class="text-md font-semibold">Email</div>
                    <div class="flex flex-row flex-1 items-center text-md font-normal overflow-x-scroll
                    @if(Auth::user()->email_verified_at === 1)
                        text-greenjabar
                    @else
                        text-red-400
                    @endif">
                    @if(Auth::user()->email_verified_at === 1)
                        <i class="fa-regular fa-circle-check text-greenjabar mr-2"></i>
                    @else
                        <i class="fa-regular fa-circle-xmark text-red-500 mr-2"></i>
                    @endif
                    {{Auth::user()->email}}
                    </div>
                </div>
                <div>
                    <div class="text-md font-semibold">Nama Lengkap</div>
                    <div class="text-md font-normal">{{Auth::user()->namalengkap}}</div>
                </div>
                <div>
                    <div class="text-md font-semibold">Alamat</div>
                    <div class="text-md font-normal">{{Auth::user()->alamat}}</div>
                </div>
                <div>
                    <div class="text-md font-semibold">Bergabung pada</div>
                    <div class="text-md font-normal">{{Auth::user()->created_at}}</div>
                </div>
            </div>
        </div>
            

        <div class="block lg:w-[50%] w-full h-[300px] p-6 bg-white border border-gray-300 rounded-lg">
            <div class="flex flex-row justify-between items-center mb-4">
                <h5 class="text-lg font-bold tracking-tight text-gray-900 items-center flex">Histori</h5>
                <div class="flex items-end border-b border-gray-300">
                    <ul class="flex flex-wrap -mb-px text-[10px] lg:text-sm font-medium text-center overflow-auto" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                        <li role="presentation">
                            <button class="inline-block p-2 px-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Peminjaman</button>
                        </li>
                        <li role="presentation">
                            <button class="inline-block p-2 px-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Koleksi</button>
                        </li>
                        <li role="presentation">
                            <button class="inline-block p-2 px-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Ulasan</button>
                        </li>
                    </ul>
                </div>
            </div>


            <hr class="w-full bg-gray-400 mb-4">



            <div id="default-tab-content">
                <div class="hidden p-1 overflow-y-scroll h-[200px]" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    @if($detailbuku->isEmpty())
                        <p class="text-sm font-medium text-gray-500">Tidak ada peminjaman</p>
                    @else
                        @foreach($detailbuku as $db)
                            <div class="flex flex-row flex-1 p-4 items-center mb-4 bg-white border border-gray-200 rounded-lg shadow">
                                <img src="{{ asset($db->buku->ImgBuku) }}" alt="" class="w-16 h-16 object-cover rounded mr-5">
                        
                                <div class="flex flex-col justify-between space-y-2 flex-1">
                                    <div>
                                        <p class="text-xs font-medium text-black">{{ $db->buku->Barcode }}</p>
                                        <p class="text-xs font-semibold text-black">{{ $db->buku->Judul }}</p>
                                        <p class="text-xs font-medium text-black">{{ $db->buku->Penulis }}</p>
                                    </div>
                                </div>
                                <div class="ml-auto">
                                    <p class="text-xs font-semibold text-black">Dipinjam pada: <br> {{ $db->buku->created_at }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>                
                <div class="hidden p-1 overflow-y-scroll h-[200px]" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    @if($koleksipribadi->isEmpty())
                        <p class="text-sm font-medium text-gray-500">Tidak ada Koleksi</p>
                    @else
                        @foreach($koleksipribadi as $kp)
                            @foreach($kp->buku as $buku)
                                <div class="flex flex-row flex-1 p-4 items-center mb-4 bg-white border border-gray-300 rounded-lg">
                                    <img src="{{ asset($buku->ImgBuku) }}" alt="" class="w-16 h-16 object-cover rounded mr-5">
                            
                                    <div class="flex flex-col justify-between space-y-2 flex-1">
                                        <div>
                                            <p class="text-xs font-medium text-black">{{ $buku->Barcode }}</p>
                                            <p class="text-xs font-semibold text-black">{{ $buku->Judul }}</p>
                                            <p class="text-xs font-medium text-black">{{ $buku->Penulis }}</p>
                                        </div>
                                    </div>
                                    <div class="ml-auto">
                                        <p class="text-xs font-semibold text-black">Dikoleksi pada: <br> {{ $buku->created_at }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach                
                    @endif
                </div>
                <div class="hidden p-1 overflow-y-scroll h-[200px]" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                    @if($ulasanbuku->isEmpty())
                        <p class="text-sm font-medium text-gray-500">Tidak ada ulasan</p>
                    @else
                        @foreach($ulasanbuku as $ub)
                            <div class="flex flex-row flex-1 p-4 items-center justify-between mb-4 bg-white border border-gray-300 rounded-lg">
                                <img src="{{ asset($ub->buku->ImgBuku) }}" alt="" class="w-16 h-16 object-cover rounded mr-5">
                            
                                <div class="flex flex-col justify-between space-y-2 flex-1 mr-5">
                                    <div>
                                        <p class="text-xs font-medium text-black">{{ $ub->buku->Barcode }}</p>
                                        <p class="text-xs font-semibold text-black">{{ $ub->buku->Judul }}</p>
                                        <p class="text-xs font-medium text-black">{{ $ub->buku->Penulis }}</p>
                                    </div>
                                </div>
                                <div class="ml-auto">
                                    <p class="text-xs font-semibold">
                                        <span class="flex flex-row flex-1 text-yellowjabar">
                                            <i class="fa-regular fa-star text-xs mr-3"></i>
                                            {{ $ub->Rating }} 
                                        </span>
                                        <br> {{ $ub->Ulasan }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
            
    </div>



    <!-- Modal Create -->
    <div id="crudmodal" tabindex="-1" aria-hidden="true" class="font-montserrat hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Ubah Biodata
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crudmodal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">X</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="/homepage/profile/{{Auth::user()->userid}}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                @method('put')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <input type="text" name="username" id="username" value="{{ Auth::user()->username }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Username" required>
                        </div>                
                    </div>
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="namalengkap" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
                            <input type="text" name="namalengkap" id="namalengkap" value="{{ Auth::user()->namalengkap }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Nama Lengkap" required>
                        </div>                
                    </div>
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="text" name="email" id="email" value="{{ Auth::user()->email }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Email" required>
                        </div>                
                    </div>
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                            <input type="text" name="alamat" id="alamat" value="{{ Auth::user()->alamat }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Alamat" required>
                        </div>                
                    </div>
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="imguser" class="block mb-2 text-sm font-medium text-gray-900 ">Foto Profile</label>
                            <input type="file" accept="image/*" name="imguser" id="imguser" value="{{ Auth::user()->imguser }}" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 file:bg-greenjabar focus:outline-none ">
                        </div> 
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <i class="fa-solid fa-pen-to-square text-sm mr-3"></i>
                        Ubah
                    </button>
                </form>
            </div>
        </div>
    </div> 
    

@endsection