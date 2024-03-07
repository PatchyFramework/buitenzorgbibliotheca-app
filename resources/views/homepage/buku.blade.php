@extends('./components/layoutpeminjam')

@section('title', 'Kumpulan Buku')

@section('content')


<div class="block m-auto font-montserrat max-w-[95%]">
    <div class="flex flex-row flex-1 items-center justify-between mb-[2%]">
        <div class="flex flex-col flex-1">
            <p class="font-bold text-xl text-black">Book Collections</p>
            <p class="font-normal text-lg text-black">Find your desired books!</p>
        </div>
        
        

        <select id="sort" name="sort" class="px-4 py-2.5 text-xs lg:text-sm rounded form-select" onchange="sortBooks(this.value)">
            <option value="latest" selected>Terbaru</option>
            <option value="oldest">Terlama</option>
            <option value="title_asc">Judul A-Z</option>
            <option value="title_desc">Judul Z-A</option>
        </select>
    </div>


    <div class="book-container flex flex-col lg:grid lg:grid-cols-6 gap-3 place-items-center">          
        @foreach($buku as $b)
                <div class="w-full bg-white border border-gray-200 rounded-lg relative hover:-translate-y-1 hover:scale-110 duration-300 transition ease-in-out">
                    <a href="/homepage/buku/{{ $b->BukuID }}">
                        <img class="rounded-t-lg h-80 w-full object-cover object-center" src="{{ asset($b->ImgBuku) }}" alt="" />
                    </a>
                    <div id="containerdesc" class="p-5">
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
        @endforeach            
    </div>        
</div>


<script>
    function sortBooks() {
        var sortOption = document.getElementById('sort').value;
        
        fetch('{{ route("homepage.book.sort") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ sort: sortOption })
        })
        .then(response => response.json())
        .then(data => {
            // Perbarui tampilan dengan data yang sudah disortir
            updateBookView(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function updateBookView(data) {
        var bookContainer = document.querySelector('.book-container');
        bookContainer.innerHTML = ''; // Kosongkan isi kontainer buku sebelum menambahkan buku yang sudah disortir

        data.forEach(book => {
            var bookDiv = document.createElement('div');
            bookDiv.classList.add('w-full', 'bg-white', 'border', 'border-gray-200', 'rounded-lg', 'relative', 'hover:-translate-y-1', 'hover:scale-110', 'duration-300', 'transition', 'ease-in-out');

            var bookLink = document.createElement('a');
            bookLink.href = '/homepage/buku/' + book.BukuID;

            var bookImg = document.createElement('img');
            bookImg.classList.add('rounded-t-lg', 'h-80', 'w-full', 'object-cover', 'object-center');
            bookImg.src = '{{ asset('') }}' + book.ImgBuku;

            var bookInfoDiv = document.createElement('div');
            bookInfoDiv.classList.add('p-5');

            var bookCategoryDiv = document.createElement('div');
            bookCategoryDiv.classList.add('flex', 'flex-row', 'items-center', 'space-x-2', 'mb-2');

            var bookCategoryIcon = document.createElement('i');
            bookCategoryIcon.classList.add('fa-regular', 'fa-folder', 'text-xs');
            bookCategoryDiv.appendChild(bookCategoryIcon);

            var bookCategoryPara = document.createElement('p');
            bookCategoryPara.classList.add('text-sm', 'font-normal');

            data.forEach(book => {
                if (book.kategoriBuku) {
                    var categoryText = document.createTextNode(book.kategoriBuku.NamaKategori);
                    bookCategoryPara.appendChild(categoryText);
                    return; // Keluar dari forEach setelah menemukan kategori buku
                }
            });

            bookCategoryDiv.appendChild(bookCategoryPara);


            bookCategoryDiv.appendChild(bookCategoryPara);

            var bookTitleLink = document.createElement('a');
            bookTitleLink.href = '/homepage/buku/' + book.BukuID;
            bookTitleLink.innerHTML = '<h5 class="mb-2 text-md font-bold tracking-tight text-gray-900 truncate max-w-[15rem]">' + book.Judul + '</h5>';

            var bookAuthorPara = document.createElement('p');
            bookAuthorPara.classList.add('mb-2', 'text-sm', 'font-normal', 'text-gray-700', 'max-w-[15rem]', 'truncate');
            bookAuthorPara.textContent = book.Penulis;

            bookLink.appendChild(bookImg);
            bookDiv.appendChild(bookLink);
            bookDiv.appendChild(bookInfoDiv);
            bookDiv.appendChild(bookCategoryDiv);
            bookDiv.appendChild(bookTitleLink);
            bookDiv.appendChild(bookAuthorPara);

            bookContainer.appendChild(bookDiv);
        });
    }


</script>







@endsection