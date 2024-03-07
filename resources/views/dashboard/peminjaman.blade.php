@extends('./components/layout')

@section('title', 'Peminjaman Buku')

@section('content')



<div class="space-y-4">
  <div class="card-header pb-0">
    <!-- Modal toggle -->
    <button data-modal-target="crudmodal" data-modal-toggle="crudmodal" class="block text-white bg-greenjabar hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
      Tambah Data Buku
    </button>
  </div>
  


  <div class="relative overflow-y-auto max-h-[70vh] scroll-smooth shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-black">
      <thead class="text-xs text-black text-center uppercase bg-white">
        <tr>        
          <th scope="col" class="px-6 py-3">
            No.
          </th>
          <th scope="col" class="px-6 py-3">
              Peminjam
          </th>
          <th scope="col" class="px-6 py-3">
              Buku Terpinjam
          </th>
          <th scope="col" class="px-6 py-3">
              Tanggal Peminjaman
          </th>
          <th scope="col" class="px-6 py-3">
              Tanggal Pengembalian
          </th>
          <th scope="col" class="px-6 py-3">
              Status Peminjaman
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
        @foreach ($peminjaman as $pj)
        <tr class="bg-white border-b hover:bg-slate-200 text-center">
          <td class="px-6 py-4">
            {{ $no }}
          </td>
          <td class="px-6 py-4">
            {{ $pj->user->namalengkap }}
          </td>
          <td class="px-6 py-4">
            {{ $pj->buku->Judul }}
          </td>
          <td class="px-6 py-4">
            {{ $pj->TanggalPeminjaman }}
          </td>
          <td class="px-6 py-4">
            {{ $pj->TanggalPengembalian }}
          </td>
          <td class="px-6 py-4">
            <div class=" flex flex-row flex-1 items-center justify-center">
              @if ($pj->StatusPeminjaman == 'Masa Aktif')
                <div class="h-[10px] w-[10px] bg-yellowjabar bg-opacity-50 border border-yellowjabar rounded-full mr-2"></div>
                <span class="text-yellowjabar">{{ $pj->StatusPeminjaman }}</span>
              @elseif ($pj->StatusPeminjaman == 'Kedaluwarsa')
                  <div class="h-[10px] w-[10px] bg-red-500 bg-opacity-50 border border-red-500 rounded-full mr-2"></div>
                  <span class="text-red-500">{{ $pj->StatusPeminjaman }}</span>
              @elseif ($pj->StatusPeminjaman == 'Dikembalikan')
                  <div class="h-[10px] w-[10px] bg-greenjabar bg-opacity-50 border border-greenjabar rounded-full mr-2"></div>
                  <span class="text-greenjabar">{{ $pj->StatusPeminjaman }}</span>
              @else
                  <span>{{ $pj->StatusPeminjaman }}</span>
              @endif
            </div>
          </td>                   
          <td class="px-6 py-4">
            <div class="flex space-x-1 items-center justify-center">
              @if(Route::currentRouteName() == 'peminjaman.kedaluwarsa.index')
                <a href="kedaluwarsa/{{ $pj->PeminjamanID }}" class="block text-white bg-yellowjabar font-medium rounded-lg text-sm px-3 py-2.5 text-center">
                    <i class="fa-regular fa-eye"></i>
                </a>
              @elseif(Route::currentRouteName() == 'peminjaman.dikembalikan.index')
                  <a href="diterima/{{ $pj->PeminjamanID }}" class="block text-white bg-yellowjabar font-medium rounded-lg text-sm px-3 py-2.5 text-center">
                      <i class="fa-regular fa-eye"></i>
                  </a>
              @else
                  <a href="peminjaman/{{ $pj->PeminjamanID }}" class="block text-white bg-yellowjabar font-medium rounded-lg text-sm px-3 py-2.5 text-center">
                      <i class="fa-regular fa-eye"></i>
                  </a>
              @endif          
              <button data-id="{{ $pj->PeminjamanID }}" data-modal-target="editmodal-{{ $pj->PeminjamanID }}" data-modal-toggle="editmodal-{{ $pj->PeminjamanID }}" class="block text-white bg-bluejabar hover:bg-darkbluejabar focus:ring-4 focus:outline-none focus:ring-bluejabar font-medium rounded-lg text-sm px-3 py-2.5 text-center">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>
              <button data-id="{{ $pj->PeminjamanID }}" data-modal-target="deletemodal-{{ $pj->PeminjamanID }}" data-modal-toggle="deletemodal-{{ $pj->PeminjamanID }}" class="block text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center">
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
                    Tambah Data Peminjaman
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crudmodal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">X</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('peminjaman.create') }}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
              @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                      <div class="col-span-2">
                          <label for="userid" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User</label>
                          <select name="userid" id="userid" style="width: 100%; padding: 10px;"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan User" required>
                          @foreach($user as $u)
                              <option value="{{ $u->userid }}">{{ $u->namalengkap }}</option>
                          @endforeach
                          </select>
                      </div>
                      <div class="col-span-2">
                          <label for="BukuID" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Buku</label>
                          <select name="BukuID" id="BukuID" style="width: 100%; padding: 10px;" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan User" required>
                          @foreach($buku as $b)
                              <option value="{{ $b->BukuID }}">{{ $b->Judul }}</option>
                          @endforeach
                          </select>
                      </div>
                      <div class="col-span-2">
                          <label for="TanggalPeminjaman" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Peminjaman Buku</label>
                          <input type="datetime-local" name="TanggalPeminjaman" id="TanggalPeminjaman" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Tanggal Peminjaman Buku" required>
                      </div>
                      <div class="col-span-2">
                          <label for="TanggalPengembalian" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Pengembalian Buku</label>
                          <input type="datetime-local" name="TanggalPengembalian" id="TanggalPengembalian" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Tanggal Pengembalian Buku" readonly required>
                          <label for="StatusPeminjaman" class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Pengembalian Buku</label>
                          <input type="text" name="StatusPeminjaman" id="StatusPeminjaman" value="Masa Aktif" class="hidden bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Tanggal Pengembalian Buku" required>
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
  @foreach($peminjaman as $pj)
    <div id="editmodal-{{ $pj->PeminjamanID }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                      Ubah Data Buku
                  </h3>
                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editmodal-{{ $pj->PeminjamanID }}">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">X</span>
                  </button>
              </div>
              <!-- Modal body -->
              <form action="/dashboard/peminjaman/{{$pj->PeminjamanID}}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                @method('put')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                          <label for="userid" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User</label>
                          <select name="userid" id="userid_{{ $pj->PeminjamanID }}" style="width: 100%; padding: 10px;" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan User" disabled required>
                              @foreach($user as $u)
                                  <option value="{{ $u->userid }}" {{ $pj->userid == $u->userid ? 'selected' : '' }}>{{ $u->namalengkap }}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="col-span-2">
                          <label for="BukuID" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Buku</label>
                          <select name="BukuID" id="BukuID_{{ $pj->PeminjamanID }}" style="width: 100%; padding: 10px;" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan User" required>
                              @foreach($buku as $b)
                                  <option value="{{ $b->BukuID }}" {{ $pj->BukuID == $b->BukuID ? 'selected' : '' }}>{{ $b->Judul }}</option>
                              @endforeach
                          </select>
                      </div>                  
                      <div class="col-span-2">
                          <label for="TanggalPeminjaman" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Peminjaman Buku</label>
                          <input type="datetime-local" name="TanggalPeminjaman" id="TanggalPeminjaman" value="{{ $pj->TanggalPeminjaman }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Tanggal Peminjaman Buku" required>
                      </div>
                      <div class="col-span-2">
                          <label for="TanggalPengembalian" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Pengembalian Buku</label>
                          <input type="datetime-local" name="TanggalPengembalian" id="TanggalPengembalian" value="{{ $pj->TanggalPengembalian }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Tanggal Pengembalian Buku" required>
                      </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Ubah
                    </button>
                  </div>
              </form>
          </div>
      </div>
    </div>
  
  
    <!-- Modal Delete -->
    <div id="deletemodal-{{ $pj->PeminjamanID }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
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
              <form action="/dashboard/peminjaman/{{$pj->PeminjamanID}}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
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
                    <button type="button" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center" data-modal-toggle="deletemodal-{{ $pj->PeminjamanID }}">
                      Tutup
                    </button>
                  </div>
              </form>
          </div>
      </div>
    </div> 
  @endforeach 

  <script>
    document.getElementById('TanggalPeminjaman').addEventListener('input', function() {
        var tanggalPeminjaman = new Date(this.value);
        var tanggalPengembalian = new Date(tanggalPeminjaman.getTime() + (14 * 24 * 60 * 60 * 1000));
        var formattedTanggalPengembalian = tanggalPengembalian.toISOString().slice(0, 16);
        document.getElementById('TanggalPengembalian').value = formattedTanggalPengembalian;
    });
    $(document).ready(function() {
        $('#userid').select2();
      });
    $(document).ready(function() {
        $('#BukuID').select2();
      });
    $(document).ready(function() {
        $('[id^="userid_"]').select2();
      });
    $(document).ready(function() {
        $('[id^="BukuID_"]').select2();
      });
  </script>

  </html>
@endsection