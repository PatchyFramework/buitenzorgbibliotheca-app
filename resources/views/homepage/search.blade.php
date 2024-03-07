@extends('./components/layoutpeminjam')

@section('title', 'Kumpulan Buku')

@section('content')

<div class="block m-auto font-montserrat max-w-[95%]">
    <p class="font-bold text-xl text-black text-center">Hasil Pencarian dari: {{ $search }}</p>


    <div class="book-container flex flex-col lg:grid lg:grid-cols-6 gap-3 place-items-center">
        @forelse($results as $b)
            <div class="w-full bg-white border border-gray-200 rounded-lg relative hover:-translate-y-1 hover:scale-110 duration-300 transition ease-in-out">
                <a href="/homepage/buku/{{ $b->BukuID }}">
                    <img class="rounded-t-lg h-80 w-full object-cover object-center" src="{{ asset($b->ImgBuku) }}" alt="" />
                </a>
                <div class="p-5">
                    <div class="flex flex-row items-center space-x-2 mb-2">
                        @foreach($kategoribuku->where('BukuID', $b->BukuID) as $k)
                            @if($k->kategoriBuku)
                                <i class="fa-regular fa-folder text-xs"></i>
                                <p class="text-sm font-normal">{{ $k->kategoriBuku->NamaKategori }}</p>
                                @break
                            @endif
                        @endforeach
                    </div>
                    <a href="/homepage/buku/{{ $b->BukuID }}">
                        <h5 class="mb-2 text-md font-bold tracking-tight text-gray-900 truncate max-w-[15rem]">{{ $b->Judul }}</h5>
                    </a>
                    <p class="mb-2 text-sm font-normal text-gray-700 max-w-[15rem] truncate">{{ $b->Penulis }}</p>
                </div>
            </div>
        @empty
            <p class="text-gray-600">Tidak ada hasil pencarian.</p>
        @endforelse
    </div>
</div>

@endsection
