@extends('./components/layoutpeminjam')

@section('title', 'Kategori Buku')

@section('content')


<div class="block m-auto font-montserrat max-w-[95%]">
    <div class="flex flex-col flex-1">
        <p class="font-bold text-3xl text-yellowjabar border-b-4 border-greenjabar w-fit mx-auto my-10 pb-2">Categories</p>
    </div>

    <div class="grid grid-cols-4 gap-3 place-items-center">
        @foreach($kategoribuku as $kb)
            <a href="/homepage/kategori/{{ $kb->KategoriID }}" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg w-full shadow md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">{{ $kb->NamaKategori }}</h5>
                </div>
            </a>
        @endforeach
    </div>
</div>





@endsection
