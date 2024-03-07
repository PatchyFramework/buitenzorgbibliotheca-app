@extends('./components/layoutpeminjam')

@section('title', 'Ulasanmu')

@section('content')

    <div class="p-6 bg-white font-montserrat space-y-5">
        <div class="flex flex-row items-center justify-between w-[95%] mx-auto">
            <p class="font-bold text-xl">Ulasan Bukumu</p>
        
            <button data-modal-target="crudmodal" data-modal-toggle="crudmodal" class="block text-white bg-greenjabar hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded text-xs px-3 py-2 text-center" type="button">
                <i class="fa-solid fa-plus text-sm mr-3"></i>
                Tambah Ulasan
            </button>
        </div>        

        <div class="block m-auto font-montserrat max-w-[95%] p-4 bg-white border border-gray-300 rounded-lg overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-black">
                <thead class="text-xs text-black text-center uppercase bg-white">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Judul Buku
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Kategori
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Penulis
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tahun Terbit
                        </th>
                        <th scope="col" class="px-4 py-3">
                            Rating
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ulasan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tools
                        </th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  ?>
                  @foreach ($ulasan as $u)
                    <tr class="bg-white border-b hover:bg-slate-200 text-center">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                          {{ $no }}
                        </th>
                        <td class="px-6 py-4">
                           <a href="/homepage/buku/{{ $u->buku->BukuID }}" class="text-none hover:underline hover:text-greenjabar">{{ $u->buku->Judul }}</a>
                        </td>
                        <td class="px-6 py-4">
                            @foreach($kategoribuku->where('BukuID', $u->buku->BukuID) as $k)
                                @if($k->kategoriBuku)
                                    <p class="text-sm font-normal">{{ $k->kategoriBuku->NamaKategori }}</p>
                                    @break
                                @endif
                            @endforeach
                        </td>
                        <td class="px-6 py-4">
                          {{ $u->buku->Penulis }}
                        </td>
                        <td class="px-6 py-4">
                          {{ $u->buku->TahunTerbit }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-row flex-1 justify-center items-center text-yellowjabar">
                                <i class="fa-regular fa-star text-xs mr-3"></i>
                                {{ $u->Rating }}
                            </div>
                        </td>
                        <td class="px-6 py-4 w-20 h-20">
                            <div class="truncate" style="max-width: 6rem;">
                                {{ $u->Ulasan }}
                            </div>
                        </td>                        
                        <td class="px-6 py-4">
                          <div class="flex space-x-1 items-center justify-center">
                            <button data-id="{{ $u->UlasanID }}" data-modal-target="editmodal-{{ $u->UlasanID }}" data-modal-toggle="editmodal-{{ $u->UlasanID }}" class="block text-white bg-bluejabar hover:bg-darkbluejabar focus:ring-4 focus:outline-none focus:ring-bluejabar font-medium rounded-lg text-sm px-3 py-2.5 text-center">
                              <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button data-id="{{ $u->UlasanID }}" data-modal-target="deletemodal-{{ $u->UlasanID }}" data-modal-toggle="deletemodal-{{ $u->UlasanID }}" class="block text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center">
                              <i class="fa-solid fa-trash-can"></i>
                            </button>
                          </div>
                        </td>
                    </tr>
                    <?php
                    $no++;
                    ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal Create -->
    <div id="crudmodal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full font-montserrat">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Tambah Data Buku Baru
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crudmodal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">X</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('user.ulasan.create') }}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <input type="hidden" name="userid" value="{{ Auth::id() }}">

                            <label for="BukuID" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Buku</label>
                            <select name="BukuID" id="BukuID"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Buku" required>
                            @foreach($buku as $b)
                                <option value="{{ $b->BukuID }}">{{ $b->Judul }}</option>
                            @endforeach
                            </select>
                        </div>   
                        <div class="col-span-2">
                            <label for="Ulasan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ulasan Buku</label>
                            <input type="text" name="Ulasan" id="Ulasan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Ulasan Buku" required>
                        </div>
                        <div class="col-span-2">
                            <label for="Rating" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rating Buku</label>
                            <input type="number" min="0" max="10" value="0" step=".01" name="Rating" id="Rating" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Rating Buku" required>
                        </div>               
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Tambah
                    </button>
                </form>
            </div>
        </div>
    </div>



    <!-- Modal Edit -->
    @foreach($ulasan as $u)
    <div id="editmodal-{{ $u->UlasanID }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Ubah Data Buku
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editmodal-{{ $u->UlasanID }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">X</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="/homepage/ulasan/{{$u->UlasanID}}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                @method('put')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <input type="hidden" name="userid" value="{{ Auth::id() }}">

                            <label for="BukuID" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Buku</label>
                            <select name="BukuID" id="BukuID"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Buku" required>
                            @foreach($buku as $b)
                                <option value="{{ $b->BukuID }}" {{ $u->BukuID == $b->BukuID ? 'selected' : '' }}>{{ $b->Judul }}</option>
                            @endforeach
                            </select>
                        </div>   
                        <div class="col-span-2">
                            <label for="Ulasan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ulasan Buku</label>
                            <input type="text" name="Ulasan" id="Ulasan" value="{{ $u->Ulasan }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Ulasan Buku" required>
                        </div>
                        <div class="col-span-2">
                            <label for="Rating" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rating Buku</label>
                            <input type="number" min="0" max="10" value="{{ $u->Rating }}" step=".01" name="Rating" id="Rating" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Rating Buku" required>
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
    <div id="deletemodal-{{ $u->UlasanID }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Hapus Data Buku
                    </h3>
                </div>
                <!-- Modal body -->
                <form action="/homepage/ulasan/{{$u->UlasanID}}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                @method('delete')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                        <p class="flex justify-center items-center">
                            Apakah anda yakin untuk hapus data?
                        </p>
                        </div>
                    </div>
                    <div class="flex justify-center items-center space-x-1">
                    <button type="submit" class="text-white flex items-center justify-center bg-red-600 hover:bg-red-800  focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Hapus Data
                    </button>
                    <button type="button" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center" data-modal-toggle="deletemodal-{{ $u->UlasanID }}">
                        Tutup
                    </button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
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