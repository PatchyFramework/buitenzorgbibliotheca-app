@extends('./components/layout')

@section('title', 'Pengguna')

@section('content')


<div class="space-y-3">
  <div class="card-header pb-0 flex flex-row flex-1 space-x-4">
    <!-- Modal toggle -->
    <button data-modal-target="crudmodal" data-modal-toggle="crudmodal" class="block text-white bg-greenjabar hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
      Tambah Data Pengguna
    </button>
    {{-- <a href="/dashboardprint" target="_blank" class="block text-white bg-greenjabar hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
      Laporan Pengguna
    </a> --}}
  </div>


  <div class="relative overflow-y-auto max-h-[70vh] scroll-smooth shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-black">
        <thead class="text-xs text-black text-center uppercase bg-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No.
                </th>
                <th scope="col" class="px-6 py-3">
                    Username
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Lengkap
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Alamat
                </th>
                <th scope="col" class="px-4 py-3">
                    Photo Profile
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
          @foreach ($user as $u)
            <tr class="bg-white border-b hover:bg-slate-200 text-center">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                  {{ $no }}
                </th>
                <td class="px-6 py-4">
                  <div class="flex flex-col items-center justify-center">
                    <div>
                      {{ $u->username }}
                    </div>

                    <div class="flex flex-row items-center flex-1">
                      @if($u->email_verified_at == 1)
                          <div class="h-[10px] w-[10px] bg-greenjabar bg-opacity-50 border border-greenjabar rounded-full mr-2"></div>
                          <span class="text-greenjabar">
                              Terverifikasi
                          </span>
                      @else
                          <div class="h-[10px] w-[10px] bg-red-200 bg-opacity-50 border border-red-600 rounded-full mr-1"></div>
                          <span class="text-red-500 text-xs w-fit">
                              Tidak Verifikasi
                          </span>
                      @endif
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4">
                  {{ $u->namalengkap }}
                </td>
                <td class="px-6 py-4">
                  {{ $u->email }}
                </td>
                <td class="px-6 py-4">
                  {{ $u->alamat }}
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-center">
                      <img src="{{ asset($u->imguser) }}" alt="" class="rounded-lg w-30 h-20 object-cover">
                    </div>
                  </td>
                <td class="px-6 py-4">
                  <div class="flex space-x-1 items-center justify-center">
                    {{-- <a href=/{{ $u->userid }}" class="block text-white bg-yellowjabar font-medium rounded-lg text-sm px-3 py-2.5 text-center">
                      <i class="fa-regular fa-eye"></i>
                    </a> --}}
                    <button data-id="{{ $u->userid }}" data-modal-target="editmodal-{{ $u->userid }}" data-modal-toggle="editmodal-{{ $u->userid }}" class="block text-white bg-bluejabar hover:bg-darkbluejabar focus:ring-4 focus:outline-none focus:ring-bluejabar font-medium rounded-lg text-sm px-3 py-2.5 text-center">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    {{-- <button data-id="{{ $u->userid }}" data-modal-target="deletemodal-{{ $u->userid }}" data-modal-toggle="deletemodal-{{ $u->userid }}" class="block text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center">
                      <i class="fa-solid fa-trash-can"></i>
                    </button> --}}
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
                      Tambah Data Pengguna Baru
                  </h3>
                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crudmodal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">X</span>
                  </button>
              </div>
              <!-- Modal body -->
              <form action="{{ route('users.create') }}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                  <div class="grid gap-4 mb-4 grid-cols-2">
                      <div class="col-span-2">
                          <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                          <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan username" required>
                      </div>
                      <div class="col-span-2">
                          <label for="namalengkap" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
                          <input type="text" name="namalengkap" id="namalengkap" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan namalengkap" required>
                      </div>
                      <div class="col-span-2">
                          <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                          <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan namalengkap" required>
                      </div>
                      <div class="col-span-2">
                          <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                          <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan namalengkap" required>
                      </div>
                      <div class="col-span-2">
                          <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                          <input type="text" name="alamat" id="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan alamat" required>
                      </div>
                      <div class="col-span-2">
                          <label for="imguser" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Profile</label>
                          <input type="file" accept="image/*" name="imguser" id="imguser" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan imguser" required>
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
  @foreach($user as $u)
    <div id="editmodal-{{ $u->userid }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                      Ubah Data
                  </h3>
                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editmodal-{{ $u->userid }}">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">X</span>
                  </button>
              </div>
              <!-- Modal body -->
              <form action="/dashboard/users/{{$u->userid}}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                @method('put')
                  <div class="grid gap-4 mb-4 grid-cols-2">
                      <div class="col-span-2">
                          <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                          <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan username" required
                          value="{{ $u->username }}">
                      </div>
                      <div class="col-span-2">
                          <label for="namalengkap" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
                          <input type="text" name="namalengkap" id="namalengkap" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan namalengkap" required
                          value="{{ $u->namalengkap }}">
                      </div>
                    {{-- <div class="col-span-2">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password" value="{{ $u->password }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan namalengkap" required>
                    </div> --}}
                      <div class="col-span-2">
                          <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                          <input type="text" name="alamat" id="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan alamat" required
                          value="{{ $u->alamat }}">
                      </div>
                      <div class="col-span-2">
                        <label for="imguser" class="block mb-2 text-sm font-medium text-gray-900 ">Foto Profile</label>
                        <input type="file" accept="image/*" name="imguser" id="imguser" value="{{ $u->imguser }}" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 file:bg-greenjabar focus:outline-none ">
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
    <div id="deletemodal-{{ $u->userid }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                      Hapus Data
                  </h3>
              </div>
              <!-- Modal body -->
              <form action="/dashboard/users/{{$u->userid}}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
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
                    <button type="button" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center" data-modal-toggle="deletemodal-{{ $u->userid }}">
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
