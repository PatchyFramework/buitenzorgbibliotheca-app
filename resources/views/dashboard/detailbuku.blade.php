@extends('./components/layout')

@section('title', 'Detail Buku')

@section('content')

    <div class="grid grid-cols-3 gap-4 place-items-center">
        <div class="space-y-1">
            <p class="font-semibold text-lg">Buku</p>
            <img src="{{ asset($buku->ImgBuku) }}" class="h-[200px] w-[150px] rounded object-cover" alt="">
        </div>


        <div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$buku->Barcode}}
                        </th>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$buku->Judul}}
                        </th>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$buku->Penulis}}
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="space-y-3">
            <button class="block text-white bg-yellowjabar font-medium rounded-lg text-sm px-3 py-2.5 text-center w-full">
                <i class="fa-solid fa-check-to-slot"></i>
                Setuju Kembalikan
            </button>
            <button data-id="" data-modal-target="editmodal-" data-modal-toggle="editmodal-" class="block text-white bg-bluejabar hover:bg-darkbluejabar focus:ring-4 focus:outline-none focus:ring-bluejabar font-medium rounded-lg text-sm px-3 py-2.5 text-center w-full">
                <i class="fa-solid fa-pen-to-square"></i>
                Perpanjang Tanggal Peminjaman
            </button>
            <button data-id="" data-modal-target="deletemodal-" data-modal-toggle="deletemodal-" class="block text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center w-full">
                <i class="fa-solid fa-rotate-left"></i>
                Kembali
            </button>
        </div>
        
    </div>

@endsection