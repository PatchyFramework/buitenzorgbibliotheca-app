@extends('./components/layout')

@section('title', 'Detail Peminjaman Buku')

@section('content')

    <div class="font-semibold p-2 bg-greenjabar text-white rounded w-fit text-sm ml-3">
        <i class="fa-solid fa-bars mr-3"></i>
        Detail Buku
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div class="p-2">
            <img src="{{ asset($peminjaman->buku->ImgBuku) }}" class="h-[200px] w-[150px] rounded object-cover m-auto" alt="">
        </div>


        <div class="p-2 m-auto">
            <table class="w-full table-fixed text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="font-bold px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white">
                            Barcode
                        </th>
                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$peminjaman->buku->Barcode}}
                        </th>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="font-bold px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white">
                            Judul Buku
                        </th>
                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$peminjaman->buku->Judul}}
                        </th>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="font-bold px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white">
                            Kategori
                        </th>
                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$kategori->kategoriBuku->NamaKategori}}
                        </th>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="font-bold px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white">
                            Pengarang
                        </th>
                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$peminjaman->buku->Penulis}}
                        </th>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="font-bold px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white">
                            Penerbit
                        </th>
                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$peminjaman->buku->Penerbit}}
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="font-semibold p-2 bg-greenjabar text-white rounded w-fit text-sm ml-3">
        <i class="fa-solid fa-bars mr-3"></i>
        Detail Peminjam
    </div>
    <div class="grid grid-cols-3 gap-4">
        <div class="p-2">
            <img src="{{ asset($peminjaman->user->imguser) }}" class="h-[200px] w-[150px] rounded object-cover m-auto" alt="">
        </div>

        <div class="p-2 m-auto">
            <table class="w-full table-fixed text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800">
                        <th scope="row" class="font-bold px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white">
                            Nama Peminjam
                        </th>
                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$peminjaman->user->namalengkap}}
                        </th>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800">
                        <th scope="row" class="font-bold px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white">
                            Tanggal Peminjaman
                        </th>
                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$peminjaman->TanggalPeminjaman}}
                        </th>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800">
                        <th scope="row" class="font-bold px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white">
                            Tanggal <br> Pengembalian
                        </th>
                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$peminjaman->TanggalPengembalian}}
                        </th>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800">
                        <th scope="row" class="font-bold px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white">
                            Status Peminjaman
                        </th>
                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$peminjaman->StatusPeminjaman}}
                        </th>
                    </tr>
                    @if(Route::currentRouteName() == 'peminjaman.kedaluwarsa.show')
                    <tr class="bg-white border-b dark:bg-gray-800">
                        <th scope="row" class="font-bold px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white">
                            Denda
                        </th>
                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Rp. {{$peminjaman->Denda}}
                        </th>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>


        <div class="space-y-3 flex flex-col items-center justify-end">
            @if(Route::currentRouteName() == 'peminjaman.show')
                <button data-modal-target="crudmodal" data-modal-toggle="crudmodal" class="block w-full text-white bg-greenjabar hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                    Setujui Penerimaan Buku
                </button>
            @elseif(Route::currentRouteName() == 'peminjaman.kedaluwarsa.show')
                <button data-modal-target="crudmodal" data-modal-toggle="crudmodal" class="block w-full text-white bg-greenjabar hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                    Setujui Penerimaan Buku
                </button>
            @endif


            @if(Route::currentRouteName() == 'peminjaman.show')

                <button data-id="perpanjangmodal" data-modal-target="perpanjangmodal" data-modal-toggle="perpanjangmodal" class="block text-white bg-bluejabar hover:bg-darkbluejabar focus:ring-4 focus:outline-none focus:ring-bluejabar font-medium rounded-lg text-sm px-3 py-2.5 text-center w-full">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Perpanjang Tanggal Peminjaman
                </button>
            @endif




            @if(Route::currentRouteName() == 'peminjaman.show')
                <a href="{{ route('peminjaman.index') }}" class="block text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center w-full">
                    <i class="fa-solid fa-rotate-left"></i>
                    Kembali
                </a>
            @elseif(Route::currentRouteName() == 'peminjaman.kedaluwarsa.show')
                <a href="{{ route('peminjaman.kedaluwarsa.index') }}" class="block text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center w-full">
                    <i class="fa-solid fa-rotate-left"></i>
                    Kembali
                </a>
            @elseif(Route::currentRouteName() == 'peminjaman.dikembalikan.show')
                <a href="{{ route('peminjaman.dikembalikan.index') }}" class="block text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center w-full">
                    <i class="fa-solid fa-rotate-left"></i>
                    Kembali
                </a>
            @endif
        </div>
    </div>





    <div id="crudmodal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Setujui Buku
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crudmodal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">X</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('peminjaman.updatestatus', $peminjaman->PeminjamanID) }}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                @method('put')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                        <p class="flex justify-center items-center">
                            Apakah anda yakin?
                        </p>
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Setuju
                    </button>
                </form>
            </div>
        </div>
    </div>


    <div id="perpanjangmodal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Perpanjang Masa Pinjam
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="perpanjangmodal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">X</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('peminjaman.update', $peminjaman->PeminjamanID) }}}}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                @method('put')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="TanggalPeminjaman" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Peminjaman Buku</label>
                            <input type="datetime-local" name="TanggalPeminjaman" id="TanggalPeminjaman" value="{{ $peminjaman->TanggalPeminjaman }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Tanggal Peminjaman Buku" required>
                        </div>
                        <div class="col-span-2">
                            <label for="TanggalPengembalian" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Peminjaman Buku</label>
                            <input type="datetime-local" name="TanggalPengembalian" id="TanggalPengembalian" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Tanggal Peminjaman Buku" readonly required>
                        </div>
                    <button type="submit" class="block text-white bg-bluejabar hover:bg-darkbluejabar focus:ring-4 focus:outline-none focus:ring-bluejabar font-medium rounded-lg text-sm px-3 py-2.5 text-center w-full">
                        + Tambah
                    </button>
                </form>
            </div>
        </div>
    </div>



<script>
    document.getElementById('TanggalPeminjaman').addEventListener('input', function() {
        var tanggalPeminjaman = new Date(this.value);
        var tanggalPengembalian = new Date(tanggalPeminjaman.getTime() + (14 * 24 * 60 * 60 * 1000));
        var formattedTanggalPengembalian = tanggalPengembalian.toISOString().slice(0, 16);
        document.getElementById('TanggalPengembalian').value = formattedTanggalPengembalian;
    });
</script>

@endsection
