@extends('./components/layoutpeminjam')

@section('title', $KoleksiID->NamaKoleksi ?? 'Koleksimu')

@section('content')

<div class="p-6  font-montserrat space-y-5">
    <div class="flex flex-col items-center justify-center w-[90%] mx-auto space-y-5">
        @foreach($koleksipribadi as $kp)
            <p class="font-bold text-xl">Koleksi : {{ $kp->NamaKoleksi }}</p>
            @break
        @endforeach

        <button data-modal-target="crudmodal" data-modal-toggle="crudmodal" class="block text-white bg-greenjabar hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded text-xs px-3 py-2 text-center" type="button">
            <i class="fa-solid fa-plus text-sm mr-3"></i>
            Tambah Buku
        </button>
    </div>

    <div class="block m-auto font-montserrat max-w-[90%] p-4 bg-white border border-gray-300 rounded-lg">
        <div class="flex flex-col lg:grid lg:grid-cols-4 gap-3 place-items-center">          
            @foreach($koleksipribadi as $kp)
                @if($kp->buku->isNotEmpty())
                    @foreach($kp->buku as $kpb)
                    <div class="w-full bg-white border border-gray-200 rounded-lg relative">
                        <button id="dropdownMenuIconHorizontalButton-{{$kpb->BukuID}}" data-dropdown-toggle="dropdownDotsHorizontal-{{$kpb->BukuID}}" class="absolute top-2 right-2 inline-flex items-center p-2 text-sm font-medium text-center text-black bg-white rounded-lg" type="button"> 
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                            </svg>
                        </button>
                    
                        <a href="/homepage/buku/{{ $kpb->BukuID }}">
                            <img class="rounded-t-lg h-80 w-full object-cover object-center" src="{{ asset($kpb->ImgBuku) }}" alt="" />
                        </a>
                        <div class="p-5">
                            <div class="flex flex-row items-center space-x-2 mb-2">
                                @foreach($kategoribuku->where('BukuID', $kpb->BukuID) as $k)
                                    @if($k->kategoriBuku)
                                        <i class="fa-regular fa-folder text-xs"></i>
                                        <p class="text-sm font-normal">{{ $k->kategoriBuku->NamaKategori }}</p>
                                        @break
                                    @endif
                                @endforeach
                            </div>
                            <a href="/homepage/buku/{{ $kpb->BukuID }}">
                                <h5 class="mb-2 text-md font-bold tracking-tight text-gray-900 truncate max-w-[15rem]">{{ $kpb->Judul }}</h5>
                            </a>
                            <p class="mb-2 text-sm font-normal text-gray-700 dark:text-gray-400">{{ $kpb->Penulis }}</p>            
                        </div>
                    </div>                      
                    @endforeach
                @else
                    <div class="w-fit h-fit bg-white border border-gray-200 rounded-lg">
                        <!-- Jika buku tidak ditemukan -->
                        <p class="text-red-500">Buku tidak ditemukan</p>
                    </div>
                @endif
            @endforeach            
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
                    Tambah Buku untuk Koleksi
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crudmodal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">X</span>
                </button>
            </div>
            <!-- Modal body -->
            @foreach($koleksipribadi as $kp)
                <form action="/homepage/createkoleksi/{{$kp->KoleksiID}}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                @method('post')

                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="BukuID" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Buku</label>
                            <select name="BukuID" id="BukuID"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan User" required>
                            @foreach($buku as $b)
                                <option value="{{ $b->BukuID }}">{{ $b->Judul }}</option>
                            @endforeach
                            </select>
                        </div>              
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <i class="fa-solid fa-pen-to-square text-sm mr-3"></i>
                        Tambah
                    </button>
                </form>
            @endforeach
        </div>
    </div>
</div>



<!-- Modal Edit -->
@foreach($koleksipribadi as $kp)
    @foreach($kp->buku as $kpb)
        <div id="editmodal-{{ $kpb->BukuID }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Ubah Buku untuk Koleksi
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editmodal-{{ $kpb->BukuID }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">X</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form action="{{ route('koleksi.buku.update', ['KoleksiID' => $kp->KoleksiID]) }}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
                    @csrf
                    @method('put')
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="BukuID" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Buku</label>
                                <select name="BukuID" id="BukuID"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Buku" required>
                                @foreach($buku as $b)
                                    <option value="{{ $b->BukuID }}" {{ $kpb->BukuID == $b->BukuID ? 'selected' : '' }}>{{ $b->Judul }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                            Ubah
                        </button>
                    </form>
                </div>
            </div>
        </div>


        <!-- Modal Delete -->
        <div id="deletemodal-{{ $kpb->BukuID }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Hapus Data Buku
                        </h3>
                    </div>
                    <form action="{{ route('koleksi.buku.delete', ['KoleksiID' => $kp->KoleksiID]) }}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
                        @csrf
                        @method('delete')
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <p class="flex justify-center items-center">
                                    Apakah Anda yakin untuk menghapus data?
                                </p>
                            </div>
                        </div>
                        <div class="flex justify-center items-center space-x-1">
                            <button type="submit" class="text-white flex items-center justify-center bg-red-600 hover:bg-red-800  focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Hapus Data
                            </button>
                            <button type="button" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center" data-modal-toggle="deletemodal-{{ $kpb->BukuID }}">
                                Tutup
                            </button>
                        </div>
                        <input type="hidden" name="BukuID" value="{{ $kpb->BukuID }}">
                    </form>
                    
                </div>
            </div>
        </div>




        <!-- Dropdown menu -->
        <div id="dropdownDotsHorizontal-{{$kpb->BukuID}}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-fit">
            <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownMenuIconHorizontalButton-{{$kpb->BukuID}}">
            <li>
                <button data-id="{{ $kpb->BukuID }}" data-modal-target="editmodal-{{ $kpb->BukuID }}" data-modal-toggle="editmodal-{{ $kpb->BukuID }}" class="w-full px-4 py-2 text-xs hover:bg-gray-100" type="button">
                    Edit Buku
                </button>
            </li>
            <li>
                <button data-id="{{ $kpb->BukuID }}" data-modal-target="deletemodal-{{ $kpb->BukuID }}" data-modal-toggle="deletemodal-{{ $kpb->BukuID }}" class="px-4 py-2 text-xs hover:bg-red-50 hover:text-red-500" type="button">
                    Hapus Buku dari Koleksi
                </button>
            </li>
            </ul>
        </div>
    @endforeach
@endforeach

<script>
    $(document).ready(function() {
        $('#BukuID').select2();
      });
    $(document).ready(function() {
        $('[id^="BukuID_"]').select2();
      });
</script>

@endsection