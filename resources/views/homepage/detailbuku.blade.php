@extends('./components/layoutpeminjam')

@section('title', $buku->Judul ?? 'Homepage')

@section('content')

    <div class="p-10 bg-white px-16 flex flex-row flex-1 justify-center font-montserrat space-x-10 rounded-lg lg:mb-[3%]">
        <img src="{{ asset($buku->ImgBuku) }}" alt="" class="h-[550px] w-[350px] object-cover rounded p-2 border-4 border-greenjabar">

        <div class="flex flex-col space-y-3 w-[50%]">
            <p class="font-bold text-3xl text-greenjabar">{{ $buku->Judul }}</p>

            <table class="w-full table-fixed text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="font-bold px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white">
                            Barcode
                        </th>
                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$buku->Barcode}}
                        </th>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="font-bold px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white">
                            Kategori
                        </th>
                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$detailbuku->kategoriBuku->NamaKategori}}
                        </th>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="font-bold px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white">
                            Pengarang
                        </th>
                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$buku->Penulis}}
                        </th>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="font-bold px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white">
                            Penerbit
                        </th>
                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$buku->Penerbit}}
                        </th>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="font-bold px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white">
                            Tahun Terbit
                        </th>
                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$buku->TahunTerbit}}
                        </th>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="font-bold px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white">
                            Ketersediaan Buku
                        </th>
                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$buku->StatusKetersediaan}}
                        </th>
                    </tr>
                </tbody>
            </table>
            <p class="font-semibold text-lg text-black">Sinopsis</p>
            <div class="p-3 w-full h-fit bg-greenjabar/10 rounded text-black text-justify overflow-auto">
                {{ $buku->Synopsis }}
            </div>
        </div>

        <div class="w-[300px] p-4 h-[20%] bg-gray-100 rounded-lg space-y-2 mx-auto">
            <p class="font-bold text-md">Pinjam Buku</p>
            <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="py-3 px-5 w-full min-w-[120px] bg-greenjabar text-white font-bold rounded-lg">
                + Pinjam
            </button>
            {{-- <button data-modal-target="crudmodal" data-modal-toggle="crudmodal" class=" py-3 px-5 w-full min-w-[120px] bg-darkbluejabar text-white font-bold rounded-lg">
                Simpan Koleksi
            </button> --}}
        </div>

    </div>


    <div class="p-10 bg-white px-16 flex flex-row flex-1 justify-center font-montserrat space-x-10 rounded-lg mb-[3%]">
        <div class="flex flex-col flex-1">
            <p class="text-greenjabar text-xl font-bold w-fit mb-[3%] border-b-2 pb-1 border-yellowjabar">Ulasan tentang Buku Ini</p>
            @if($ulasanbuku->isEmpty())
                <p class="text-sm font-medium text-gray-500">Tidak ada ulasan</p>
            @else
                @foreach($ulasanbuku as $ub)
                    <div class="flex flex-row flex-1 mb-[2%]">
                        <div class="flex flex-col flex-1 items-start mr-5">
                            @if ($ub->user->imguser)
                                <img src="{{ asset($ub->user->imguser) }}" alt="Admin Photo" class="max-h-md h-16 object-cover rounded-xl aspect-square mr-3"/>
                            @else
                                <img src="{{ asset('img/user.png') }}" alt="Admin Photo" class="max-h-md h-16 object-cover rounded-xl aspect-square mr-3"/>
                            @endif
                            <p class="text-sm font-semibold text-greenjabar">{{$ub->user->username}}</p>
                            <div class="flex flex-row flex-1 justify-center items-center text-yellowjabar">
                                <i class="fa-regular fa-star text-xs mr-3"></i>
                                {{ $ub->Rating }}
                            </div>
                            <p class="text-xs font-normal text-gray-300">{{$ub->created_at}}</p>
                        </div>

                        <div class="p-3 w-[90%] h-fit bg-greenjabar/10 rounded text-black text-justify overflow-auto">
                            {{ $ub->Ulasan }}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="p-10 bg-white px-16 flex flex-row flex-1 justify-center font-montserrat space-x-10 rounded-lg">
        <div class="flex flex-col flex-1">
            <p class="text-bluejabar text-xl font-bold w-fit mb-[3%] border-b-2 pb-1 border-greenjabar">Buku Lainnya dari: {{$buku->Penulis}}</p>
            @if($rekomendasi->isEmpty())
                <p class="text-sm font-medium text-gray-500">Buku belum tersedia</p>
            @else
                <div class="book-container flex flex-col lg:grid lg:grid-cols-6 gap-3 place-items-center">
                    @foreach($rekomendasi as $b)
                            <div class="w-full bg-white border border-gray-200 rounded-lg relative hover:-translate-y-1 hover:scale-110 duration-300 transition ease-in-out">
                                <a href="/homepage/buku/{{ $b->BukuID }}">
                                    <img class="rounded-t-lg h-80 w-full object-cover object-center" src="{{ asset($b->ImgBuku) }}" alt="" />
                                </a>
                                <div class="p-5">
                                    <div class="flex flex-row items-center space-x-2 mb-2">
                                        <i class="fa-regular fa-folder text-xs"></i>
                                        <p class="text-sm font-normal">{{$detailbuku->kategoriBuku->NamaKategori}}</p>
                                    </div>
                                    <a href="/homepage/buku/{{ $b->BukuID }}">
                                        <h5 class="mb-2 text-md font-bold tracking-tight text-gray-900 truncate max-w-[15rem]">{{ $b->Judul }}</h5>
                                    </a>
                                    <p class="mb-2 text-sm font-normal text-gray-700 max-w-[15rem] truncate">{{ $b->Penulis }}</p>
                                </div>
                            </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>



    <!-- Main modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Pinjam Buku
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('pinjam.create') }}" method="post" class="p-4 md:p-5">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2" hidden>
                            <label for="BukuID" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">BukuID</label>
                            <input type="number" name="BukuID" id="BukuID" value="{{ $detailbuku->buku->BukuID }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan BukuID Buku" required>
                        </div>
                        <div class="col-span-2 hidden">
                            <label for="BukuID" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">BukuID Buku</label>
                            <input type="number" name="BukuID" id="BukuID" value="{{ $detailbuku->buku->BukuID }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan BukuID Buku" required>
                        </div>
                        <div class="col-span-2">
                            <label for="TanggalPeminjaman" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Peminjaman Buku</label>
                            <input type="datetime-local" name="TanggalPeminjaman" id="TanggalPeminjaman" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Tanggal Peminjaman Buku" required>
                        </div>
                        <div class="col-span-2">
                            <label for="TanggalPengembalian" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Pengembalian Buku</label>
                            <input type="datetime-local" name="TanggalPengembalian" id="TanggalPengembalian" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Tanggal Pengembalian Buku" readonly required>
                        </div>
                    </div>
                <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        @if ($buku->StatusKetersediaan == 'Tidak Tersedia' || $pinjamcount == 5 || Auth::user()->email_verified_at == 0)
                        disabled
                        @endif>
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                            Pinjam
                        </button>
                    </div>
                </form>
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
                @foreach($koleksipribadi as $collection)
                <form action="/homepage/createkoleksi/{{$collection->KoleksiID}}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
                    @csrf
                    @method('post')

                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="KoleksiID" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Koleksi</label>
                            <select name="KoleksiID" id="KoleksiID" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                @foreach($koleksipribadi as $collection)
                                <option value="{{ $collection->KoleksiID }}">{{ $collection->NamaKoleksi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <i class="fa-solid fa-pen-to-square text-sm mr-3"></i>
                        Tambah
                    </button>
                </form>
                @break
                @endforeach
            </div>
        </div>
    </div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('add-collection-form').addEventListener('submit', function(event) {
            event.preventDefault();
            var form = event.target;
            var formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                window.location.href = data.redirect;
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });

    document.getElementById('TanggalPeminjaman').addEventListener('input', function() {
        var tanggalPeminjaman = new Date(this.value);
        var tanggalPengembalian = new Date(tanggalPeminjaman.getTime() + (14 * 24 * 60 * 60 * 1000));
        var formattedTanggalPengembalian = tanggalPengembalian.toISOString().slice(0, 16);
        document.getElementById('TanggalPengembalian').value = formattedTanggalPengembalian;
    });
</script>


@endsection
