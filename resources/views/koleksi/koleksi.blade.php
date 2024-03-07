@extends('./components/layoutpeminjam')

@section('title', 'Koleksimu')

@section('content')

    <div class="p-6 bg-white font-montserrat space-y-5">
        <div class="flex flex-row items-center justify-between w-[95%] mx-auto">
            <p class="font-bold text-xl">Koleksi Bukumu</p>
        
            <button data-modal-target="crudmodal" data-modal-toggle="crudmodal" class="block text-white bg-greenjabar hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded text-xs px-3 py-2 text-center" type="button">
                <i class="fa-solid fa-plus text-sm mr-3"></i>
                Tambah Koleksi
            </button>
        </div>        

        <div class="block m-auto font-montserrat max-w-[95%] p-4 bg-white border border-gray-300 rounded-lg">
            <div class="flex flex-col lg:grid lg:grid-cols-6 gap-3">
                @foreach($koleksipribadi as $kp)
                    <a href="/homepage/koleksi/{{ $kp->KoleksiID }}" class="w-full h-fit bg-white border border-gray-200 rounded-lg">
                        @if ($kp->ImgKoleksi)
                            <img class="rounded-t-lg h-[10rem] w-full object-cover" src="{{ asset($kp->ImgKoleksi) }}" alt="" />
                        @else
                            <img src="{{ asset('img/notfound.png') }}" alt="Admin Photo" class="rounded-t-lg h-[10rem] w-full object-cover"/>
                        @endif  
                        
                        
                        <div class="p-5">
                            <h5 class="mb-2 text-md font-bold tracking-tight text-gray-900 truncate max-w-[150px] max-h-10">{{ $kp->NamaKoleksi }}</h5>
                            <p class="mb-2 text-sm font-normal text-gray-700 dark:text-gray-400">{{ $kp->user->username }}</p>            
                        </div>
                    </a>
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
                <form action="{{ route('koleksi.create') }}" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                @method('post')
                    <input type="hidden" name="userid" value="{{ Auth::id() }}">

                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="NamaKoleksi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Koleksi Buku</label>
                            <input type="text" name="NamaKoleksi" id="NamaKoleksi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan Nama Koleksi Buku" required>
                        </div>
                        <div class="col-span-2">
                            <label for="ImgKoleksi" class="block mb-2 text-sm font-medium text-gray-900 ">Gambar Cover Koleksi</label>
                            <input type="file" accept="image/*" name="ImgKoleksi" id="ImgKoleksi" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 file:bg-greenjabar focus:outline-none">
                        </div>                
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <i class="fa-solid fa-pen-to-square text-sm mr-3"></i>
                        Tambah
                    </button>
                </form>
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
    </script>

@endsection