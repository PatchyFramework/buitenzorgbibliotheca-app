@extends('./components/layout')

@section('title', 'Buku')

@section('content')


<div class="space-y-3">
  <div class="card-header pb-0 flex flex-row flex-1 space-x-4">
    <!-- Modal toggle -->
    <button data-modal-target="crudmodal" data-modal-toggle="crudmodal" class="block text-white bg-greenjabar hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
      Tambah Data Buku
    </button>
    <a href="/dashboard/bukuprint" target="_blank" class="block text-white bg-greenjabar hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
      Tambah Data Print
    </a>
    <a href="/dashboard/bukuexcel" target="_blank" class="block text-white bg-greenjabar hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
      Export Excel
    </a>
  </div>


  <div class="relative overflow-y-auto max-h-[70vh] scroll-smooth shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-black">
        <thead class="text-xs text-black text-center uppercase bg-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No.
                </th>
                <th scope="col" class="px-6 py-3">
                    Barcode
                </th>
                <th scope="col" class="px-6 py-3">
                    Judul buku
                </th>
                <th scope="col" class="px-6 py-3">
                    Penulis
                </th>
                <th scope="col" class="px-6 py-3">
                    Penerbit
                </th>
                <th scope="col" class="px-4 py-3">
                    Tahun Terbit
                </th>
                <th scope="col" class="px-4 py-3">
                    Stock Buku
                </th>
                <th scope="col" class="px-6 py-3">
                    Cover Buku
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
          @foreach ($buku as $b)
            <tr class="bg-white border-b hover:bg-slate-200 text-center">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                  {{ $no }}
                </th>
                <td class="px-6 py-4">
                  {{ $b->Barcode }}
                </td>
                <td class="px-6 py-4">
                  {{ $b->Judul }}
                </td>
                <td class="px-6 py-4">
                  {{ $b->Penulis }}
                </td>
                <td class="px-6 py-4">
                  {{ $b->Penerbit }}
                </td>
                <td class="px-6 py-4">
                  {{ $b->TahunTerbit }}
                </td>
                <td class="px-6 py-4">
                  {{ $b->Stock }}
                </td>
                <td class="px-6 py-4">
                  <div class="flex items-center justify-center">
                    @if ($b->ImgBuku)
                      <img class="rounded-lg w-30 h-20" src="{{ asset($b->ImgBuku) }}" alt="" />
                    @else
                        <img src="{{ asset('img/notfound.png') }}" alt="Admin Photo" class="rounded-lg w-30 h-20"/>
                    @endif
                  </div>
                </td>
                <td class="px-6 py-4">
                  <div class="flex space-x-1 items-center justify-center">
                    {{-- <a href="buku/{{ $b->BukuID }}" class="block text-white bg-yellowjabar font-medium rounded-lg text-sm px-3 py-2.5 text-center">
                      <i class="fa-regular fa-eye"></i>
                    </a> --}}
                    <button data-id="{{ $b->BukuID }}" data-modal-target="editmodal-{{ $b->BukuID }}" data-modal-toggle="editmodal-{{ $b->BukuID }}" class="block text-white bg-bluejabar hover:bg-darkbluejabar focus:ring-4 focus:outline-none focus:ring-bluejabar font-medium rounded-lg text-sm px-3 py-2.5 text-center">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button data-id="{{ $b->BukuID }}" data-modal-target="deletemodal-{{ $b->BukuID }}" data-modal-toggle="deletemodal-{{ $b->BukuID }}" class="block text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center">
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
  <div id="crudmodal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
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
              <form action="{{ route('buku.create') }}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                  <div class="grid gap-4 mb-4 grid-cols-2">
                      <div class="col-span-2">
                          <label for="Barcode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barcode Buku</label>
                          <input type="text" name="Barcode" id="Barcode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Barcode Buku" required>
                      </div>
                      <div class="col-span-2">
                          <label for="Judul" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Buku</label>
                          <input type="text" name="Judul" id="Judul" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Judul Buku" required>
                      </div>
                      <div class="col-span-2">
                          <label for="Penulis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penulis Buku</label>
                          <input type="text" name="Penulis" id="Penulis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Penulis Buku" required>
                      </div>
                      <div class="col-span-2">
                          <label for="Penerbit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penerbit Buku</label>
                          <input type="text" name="Penerbit" id="Penerbit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Penerbit Buku" required>
                      </div>
                      <div class="col-span-2">
                          <label for="Synopsis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Synopsis Buku</label>
                          <input type="text" name="Synopsis" id="Synopsis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Penerbit Buku" required>
                      </div>
                      <div class="col-span-2">
                          <label for="KategoriID" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                          <select name="KategoriID" id="KategoriID" style="width: 100%; padding: 10px;"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan User" required>
                          @foreach($kategori as $k)
                              <option value="{{ $k->KategoriID }}">{{ $k->NamaKategori }}</option>
                          @endforeach
                          </select>
                      </div>
                      <div class="col-span-2">
                          <label for="TahunTerbit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun Terbit Buku</label>
                          <input type="number" placeholder="YYYY" pattern="\d{4}" min="1945" max="2099" name="TahunTerbit" id="TahunTerbit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Tahun Terbit Buku" required>
                      </div>
                      <div class="col-span-2">
                          <label for="Stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock Fisik Buku</label>
                          <input type="number" name="Stock" id="Stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Tahun Terbit Buku" required>
                      </div>
                      <div class="col-span-2">
                        <label for="ImgBuku" class="block mb-2 text-sm font-medium text-gray-900 ">Gambar Cover Buku</label>
                        <input type="file" accept="image/*" name="ImgBuku" id="ImgBuku" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 file:bg-greenjabar focus:outline-none ">
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
  @foreach($buku as $b)
    <div id="editmodal-{{ $b->BukuID }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                      Ubah Data Buku
                  </h3>
                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editmodal-{{ $b->BukuID }}">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">X</span>
                  </button>
              </div>
              <!-- Modal body -->
              <form action="/dashboard/buku/{{$b->BukuID}}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                @method('put')
                  <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                      <label for="Barcode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barcode Buku</label>
                      <input type="text" name="Barcode" value="{{ $b->Barcode }}" id="Barcode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Barcode Buku" required>
                    </div>
                    <div class="col-span-2">
                        <label for="Judul" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Buku</label>
                        <input type="text" name="Judul" value="{{ $b->Judul }}" id="Judul" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Judul Buku" required>
                    </div>
                    <div class="col-span-2">
                        <label for="Penulis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penulis Buku</label>
                        <input type="text" name="Penulis" value="{{ $b->Penulis }}" id="Penulis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Penulis Buku" required>
                    </div>
                    <div class="col-span-2">
                        <label for="Penerbit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penerbit Buku</label>
                        <input type="text" name="Penerbit" value="{{ $b->Penerbit }}" id="Penerbit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Penerbit Buku" required>
                    </div>
                    <div class="col-span-2">
                        <label for="Synopsis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Synopsis Buku</label>
                        <input type="text" name="Synopsis" value="{{ $b->Synopsis }}" id="Synopsis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Penerbit Buku" required>
                    </div>
                    <div class="col-span-2">
                        <label for="KategoriID" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                        <select name="KategoriID" id="KategoriID_{{ $b->BukuID }}" style="width: 100%; padding: 10px;"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan User" required>
                          @foreach($kategori as $k)
                              <option value="{{ $k->KategoriID }}" {{ $k->KategoriID == $kategorirelasi->where('BukuID', $b->BukuID)->first()->kategoriBuku->KategoriID ? 'selected' : '' }}>{{ $k->NamaKategori }}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="TahunTerbit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun Terbit Buku</label>
                        <input type="number" placeholder="YYYY" pattern="\d{4}" min="1945" max="2099" name="TahunTerbit" value="{{ $b->TahunTerbit }}" id="TahunTerbit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Tahun Terbit Buku" required>
                    </div>
                    <div class="col-span-2">
                        <label for="Stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tambah Stock Fisik Buku</label>
                        <input type="number" name="Stock" id="Stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Taruh nominal stock" required>
                    </div>
                    <div class="col-span-2">
                      <label for="ImgBuku" class="block mb-2 text-sm font-medium text-gray-900 ">Gambar Cover Buku</label>
                      <input type="file" accept="image/*" name="ImgBuku" value="{{ $b->ImgBuku }}" id="ImgBuku" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 file:bg-greenjabar focus:outline-none ">
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
    <div id="deletemodal-{{ $b->BukuID }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
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
              <form action="/dashboard/buku/{{$b->BukuID}}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
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
                    <button type="button" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center" data-modal-toggle="deletemodal-{{ $b->BukuID }}">
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
        $('#KategoriID').select2();
    });
    $(document).ready(function() {
      $('[id^="KategoriID_"]').select2();
    });
  </script>


  </html>
@endsection
