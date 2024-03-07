@extends('./components/layout')

@section('title', 'Kategori')

@section('content')



<div class="space-y-5">
  <div class="card-header pb-0">
    <!-- Modal toggle -->
    <button data-modal-target="crudmodal" data-modal-toggle="crudmodal" class="block text-white bg-greenjabar hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
      Tambah Data Kategori
    </button>
  </div>


  <div class="relative overflow-y-auto max-h-[70vh] scroll-smooth shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-black">
      <thead class="text-xs text-black text-center uppercase bg-white">
        <tr>
          <tr>
            <th scope="col" class="px-6 py-3">
                No.
            </th>
            <th scope="col" class="px-6 py-3">
                Nama Kategori
            </th>
            <th scope="col" class="px-6 py-3">
                Tools
            </th>
          </tr>
        </tr>
      </thead>
      <tbody>
        <?php
          $no = 1;
        ?>
        @foreach ($kategori as $k)
        <tr class="bg-white border-b hover:bg-slate-200 text-center">
          <td class="px-6 py-4">
            {{ $no }}
          </td>
          <td class="px-6 py-4">
            {{ $k->NamaKategori }}
          </td>                
          <td class="align-middle">
            <div class="flex space-x-1 items-center justify-center">
              <button data-id="{{ $k->KategoriID }}" data-modal-target="editmodal-{{ $k->KategoriID }}" data-modal-toggle="editmodal-{{ $k->KategoriID }}" class="block text-white bg-bluejabar hover:bg-darkbluejabar focus:ring-4 focus:outline-none focus:ring-bluejabar font-medium rounded-lg text-sm px-3 py-2.5 text-center">
                <i class="fa-solid fa-pen-to-square"></i> Ubah Data Kategori
              </button>
              <button data-id="{{ $k->KategoriID }}" data-modal-target="deletemodal-{{ $k->KategoriID }}" data-modal-toggle="deletemodal-{{ $k->KategoriID }}" class="block text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center">
                <i class="fa-solid fa-trash"></i> Hapus
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
  <div id="crudmodal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Tambah Data Kategori Baru
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crudmodal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">X</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('kategori.create') }}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
              @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="NamaKategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kategori Buku</label>
                        <input type="text" name="NamaKategori" id="NamaKategori" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Kategori Buku" required>
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
  @foreach($kategori as $k)
    <div id="editmodal-{{ $k->KategoriID }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                      Ubah Data Kategori
                  </h3>
                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editmodal-{{ $k->KategoriID }}">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">X</span>
                  </button>
              </div>
              <!-- Modal body -->
              <form action="/dashboard/kategori/{{$k->KategoriID}}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                @method('put')
                  <div class="grid gap-4 mb-4 grid-cols-2">
                      <div class="col-span-2">
                          <label for="NamaKategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kategori Buku</label>
                          <input type="text" name="NamaKategori" id="NamaKategori" value="{{ $k->NamaKategori }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Kategori Buku" required>
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
    <div id="deletemodal-{{ $k->KategoriID }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                      Hapus Data Kategori
                  </h3>
              </div>
              <!-- Modal body -->
              <form action="/dashboard/kategori/{{$k->KategoriID}}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
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
                    <button type="button" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center" data-modal-toggle="deletemodal-{{ $k->KategoriID }}">
                      Tutup
                    </button>
                  </div>
              </form>
          </div>
      </div>
    </div> 
  @endforeach 


  
</html>
@endsection
  