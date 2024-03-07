@extends('./components/layoutpeminjam')

@section('title', 'Peminjamanmu')

@section('content')

<div class="p-6 bg-white font-montserrat space-y-5">

    <button data-modal-target="crudmodal" data-modal-toggle="crudmodal" class="block text-white bg-greenjabar hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
        Buat Peminjaman
    </button>

    <div class="block m-auto font-montserrat max-w-[95%] p-4 bg-white border border-gray-300 rounded-lg">
    

        <div class="md:flex">
            <ul class="flex-column space-y space-y-4 text-sm font-medium text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                <li role="presentation">
                    <button class="inline-flex items-center px-4 py-3 rounded-lg bg-gray-50 hover:bg-gray-100 w-full" id="aktif-tab" data-tabs-target="#aktif" type="button" role="tab" aria-controls="aktif" aria-selected="true">
                        <i class="fa-solid fa-circle-check mr-3"></i>
                        Masa Aktif
                    </button>
                </li>
                <li role="presentation">
                    <button class="inline-flex items-center px-4 py-3 rounded-lg bg-gray-50 hover:bg-gray-100 w-full" id="kedaluwarsa-tab" data-tabs-target="#kedaluwarsa" type="button" role="tab" aria-controls="kedaluwarsa" aria-selected="false">
                        <i class="fa-solid fa-circle-xmark mr-3"></i>
                        Kedaluwarsa
                    </button>
                </li>
                <li role="presentation">
                    <button class="inline-flex items-center px-4 py-3 rounded-lg bg-gray-50 hover:bg-gray-100 w-full" id="dikembalikan-tab" data-tabs-target="#dikembalikan" type="button" role="tab" aria-controls="dikembalikan" aria-selected="false">
                        <i class="fa-solid fa-right-left mr-3"></i>
                        Dikembalikan
                    </button>
                </li>
            </ul>
            <div id="default-tab-content" class="p-6 bg-gray-50 text-medium text-gray-500 rounded-lg w-full">
                <div class="hidden p-4 rounded-lg bg-gray-50 grid-cols-2 gap-6 grid" id="aktif" role="tabpanel" aria-labelledby="aktif-tab">      
                    <!-- Konten untuk tab Masa Aktif -->
                    @foreach ($peminjamanaktif as $pa)
                        <a href="/homepage/buku/{{ $pa->buku->BukuID }}" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100">
                            <img class="object-cover w-full rounded-t-lg h-full md:h-auto md:w-52 md:rounded-none md:rounded-s-lg" src="{{asset($pa->buku->ImgBuku)}}" alt="a">
                            <div class="flex flex-col justify-between p-4 leading-normal">
                                <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900">{{$pa->buku->Judul}}</h5>
                                <p class="mb-3 text-md font-normal text-gray-700">{{$pa->buku->Penulis}}</p>
                                <p class="mb-3 text-sm font-normal text-gray-700">Dipinjam pada: <br> <span class="font-bold">{{$pa->TanggalPeminjaman}}</span></p>
                                <p class="mb-3 text-sm font-normal text-gray-700">Baik dikembalikan sebelum: <br> <span class="font-bold">{{$pa->TanggalPengembalian}}</span></p>
                                
                                <div class=" flex flex-row flex-1 items-center justify-start text-sm">
                                    <div class="h-[10px] w-[10px] bg-yellowjabar bg-opacity-50 border border-yellowjabar rounded-full mr-2"></div>
                                    <span class="text-yellowjabar">{{ $pa->StatusPeminjaman }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
        
        
                <div class="hidden p-4 rounded-lg bg-gray-50 grid grid-cols-2" id="kedaluwarsa" role="tabpanel" aria-labelledby="kedaluwarsa-tab">      
                    <!-- Konten untuk tab Kedaluwarsa -->
                    @foreach ($peminjamankedaluwarsa as $pk)
                        <a href="/homepage/buku/{{ $pk->buku->BukuID }}" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100">
                            <img class="object-cover w-full rounded-t-lg h-full md:h-auto md:w-52 md:rounded-none md:rounded-s-lg" src="{{asset($pk->buku->ImgBuku)}}" alt="a">
                            <div class="flex flex-col justify-between p-4 leading-normal">
                                <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900">{{$pk->buku->Judul}}</h5>
                                <p class="mb-3 text-md font-normal text-gray-700">{{$pk->buku->Penulis}}</p>
                                <p class="mb-3 text-sm font-normal text-gray-700">Dipinjam pada: <br> <span class="font-bold">{{$pk->TanggalPeminjaman}}</span></p>
                                <p class="mb-3 text-sm font-normal text-gray-700">Baik dikembalikan sebelum: <br> <span class="font-bold">{{$pk->TanggalPengembalian}}</span></p>
                                <p class="mb-3 text-sm font-normal text-gray-700">Denda: Rp.  <br> <span class="font-bold">{{$pk->Denda}}</span></p>
                                
                                <div class=" flex flex-row flex-1 items-center justify-start text-sm">
                                    <div class="h-[10px] w-[10px] bg-red-100 bg-opacity-50 border border-red-500 rounded-full mr-2"></div>
                                    <span class="text-red-500">{{ $pk->StatusPeminjaman }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
        
                
                <div class="hidden p-4 rounded-lg bg-gray-50 grid grid-cols-2" id="dikembalikan" role="tabpanel" aria-labelledby="dikembalikan-tab">      
                    <!-- Konten untuk tab Dikembalikan -->
                    @foreach ($peminjamandikembalikan as $pd)
                        <a href="/homepage/buku/{{ $pd->buku->BukuID }}" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100">
                            <img class="object-cover w-full rounded-t-lg h-full md:h-auto md:w-52 md:rounded-none md:rounded-s-lg" src="{{asset($pd->buku->ImgBuku)}}" alt="a">
                            <div class="flex flex-col justify-between p-4 leading-normal">
                                <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900">{{$pd->buku->Judul}}</h5>
                                <p class="mb-3 text-md font-normal text-gray-700">{{$pd->buku->Penulis}}</p>
                                <p class="mb-3 text-sm font-normal text-gray-700">Dipinjam pada: <br> <span class="font-bold">{{$pd->TanggalPeminjaman}}</span></p>
                                <p class="mb-3 text-sm font-normal text-gray-700">Baik dikembalikan sebelum: <br> <span class="font-bold">{{$pd->TanggalPengembalian}}</span></p>
                                
                                <div class=" flex flex-row flex-1 items-center justify-start text-sm">
                                    <div class="h-[10px] w-[10px] bg-greenjabar bg-opacity-50 border border-greenjabar rounded-full mr-2"></div>
                                    <span class="text-greenjabar">{{ $pd->StatusPeminjaman }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
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
            <form action="{{ route('user.peminjaman.create') }}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
              @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                      <div class="col-span-2">
                          <label for="userid" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User</label>
                          <select name="userid" id="userid" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan User" disabled required>
                            @foreach($peminjaman as $p)
                                @foreach($user as $u)
                                    <option value="{{ $u->userid }}" {{ $p->userid == $u->userid ? 'selected' : '' }}>{{ $u->namalengkap }}</option>
                                @endforeach
                            @endforeach
                        </select>
                      </div>
                      <div class="col-span-2">
                          <label for="BukuID" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Buku</label>
                          <select name="BukuID" id="BukuID"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan User" required>
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