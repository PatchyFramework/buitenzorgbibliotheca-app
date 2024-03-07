@extends('./components/layoutpeminjam')

@section('title', 'Homepage')

@section('content')

    <div class="font-montserrat scroll-smooth">


        <section class="bg-greenjabar flex flex-row flex-1 lg:pt-16 lg:pb-[20%] lg:px-16">
            <div data-aos="fade-right" class="py-8 px-4 m-auto text-left">
                <div class="flex flex-col flex-1 px-20">
                    <img src="{{asset('img/nobg.png')}}" class="w-[30%] h-full my-3 px-1.5 py-1 bg-white rounded" alt="">
                    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-3xl lg:text-5xl">Discover the convenience of digitalization</h1>
                    <p class="mb-8 text-lg font-normal text-gray-200 lg:text-lg">Welcome to Buitenzorg Bibliotheca! Where the wonders of the world provided with books.</p>
                    <div class="flex justify-start space-x-4">
                        <a href="
                        @if(Auth::check())
                            {{route('homepage.book.index')}}
                        @else
                            {{ route('login') }}
                        @endif" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-greenjabar rounded-lg bg-white hover:bg-slate-800 focus:ring-4 focus:ring-slate-300 dark:focus:ring-slate-900">
                            Search your Book
                            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>



            <!-- Swiper -->
            {{-- <div class="relative"> --}}
                <div data-aos="fade-down" class=" hidden lg:block swiper mySwiper max-w-[50%] z-0">
                    <div class="swiper-wrapper">
                        @foreach($buku as $b)
                            <div class="swiper-slide">
                                <img class="rounded-lg h-full max-w-full object-cover" src="{{ asset($b->ImgBuku) }}" alt="" />
                            </div>
                        @endforeach
                    </div>
                </div>
            {{-- </div> --}}

        </section>


        <div data-aos="fade-down" class="w-full h-full m-auto lg:pb-[15%]">
            <div class="flex flex-col m-5 lg:flex-row flex-1 items-center justify-center lg:space-x-5 lg:mb-[10%]">
                <div class="block lg:-mt-24 max-w-sm p-6 bg-white text-center border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <i class="fa-solid fa-user-check text-greenjabar lg:text-4xl lg:mx-auto lg:text-center"></i>
                    <p class="font-bold text-greenjabar text-lg">User-Friendly</p>
                    <p class="font-normal text-gray-700">We assure you that this website is user-friendly, and easy to use for users.</p>
                </div>

                <div class="block lg:-mt-24 max-w-sm p-6 bg-white text-center border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <i class="fa-solid fa-mobile text-yellowjabar lg:text-4xl lg:mx-auto lg:text-center"></i>
                    <p class="font-bold text-yellowjabar text-lg">Mobile Responsive</p>
                    <p class="font-normal text-gray-700">You can also access this website through mobile website browser.</p>
                </div>

                <div class="block lg:-mt-24 max-w-sm p-6 bg-white text-center border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <i class="fa-solid fa-gears text-bluejabar lg:text-4xl lg:mx-auto lg:text-center"></i>
                    <p class="font-bold text-bluejabar text-lg">Easy and Practical</p>
                    <p class="font-normal text-gray-700">You can use this web application in ease and functional.</p>
                </div>
            </div>


            <div data-aos="fade-left" class="flex flex-col flex-1 items-center justify-center">
                <p class="font-bold text-greenjabar lg:text-3xl mb-10 pb-2 border-b-2 px-5 border-yellowjabar">Featured Trending Books</p>

                <div class="flex flex-row flex-1 w-[90%] z-0 justify-between flex-wrap">
                    @foreach($ulasantrending as $index => $ut)
                        @if($index < 5)
                        <div class="w-fit h-fit bg-white border border-gray-200 rounded-lg shadow hover:-translate-y-1 hover:scale-110 duration-300 transition ease-in-out relative">
                            <div class="absolute -ml-10 -mt-5 rounded-full
                            @if($index == 0)
                                bg-yellowjabar
                            @elseif($index == 1)
                                bg-gray-300
                            @elseif($index == 2)
                                bg-[#cd7f32]
                            @else
                                bg-slate-600
                            @endif
                            text-white  p-5 text-3xl font-bold">#{{ $index + 1 }}</div>
                            <a href="{{ Auth::check() ? 'homepage/buku/'.$ut->BukuID : route('login') }}">
                                <img class="rounded-t-lg h-[20rem] max-w-[15rem] object-cover" src="{{ asset($ut->buku->ImgBuku) }}" alt="" />
                                <div class="p-5">
                                    <div class="flex flex-row flex-1 items-center space-x-2 mb-2">
                                        @foreach($kategoribuku->where('BukuID', $ut->BukuID) as $k)
                                            @if($k->kategoriBuku)
                                                <i class="fa-regular fa-folder text-xs"></i>
                                                <p class="text-sm font-normal">{{ $k->kategoriBuku->NamaKategori }}</p>
                                                @break
                                            @endif
                                        @endforeach
                                    </div>
                                    <h5 class="mb-2 text-md font-bold tracking-tight text-gray-900 truncate max-w-[150px] max-h-10">{{ $ut->buku->Judul }}</h5>
                                    <p class="mb-2 text-sm font-normal text-gray-700">{{ $ut->buku->Penulis }}</p>
                                </div>
                            </a>
                        </div>



                        @endif
                    @endforeach
                </div>

            </div>

        </div>

        <div class="w-full h-full bg-greenjabar m-auto lg:pb-[15%]">


            <div class="flex flex-col flex-1 items-center justify-center">
                <p class="font-bold text-white lg:text-3xl lg:my-10 lg:mt-20 pb-2 border-b-2 px-5 py-6 border-yellowjabar">Featured Reviews</p>

                <div class="flex flex-col lg:flex-row flex-1 lg:space-x-5 items-center">
                    @foreach($ulasan as $index => $b)
                        @if($index < 3) <!-- Hanya memunculkan 5 data -->
                            <div class="w-[50%] h-[50%] m-10 mx-40 lg:m-auto lg:w-fit lg:h-fit bg-white border border-gray-200 rounded-lg shadow hover:-translate-y-1 hover:scale-110 duration-300 transition ease-in-out">
                                <a href="homepage/buku/{{ $b->buku->BukuID }}" class="flex flex-row">
                                    <img class="rounded-lg h-[20rem] max-w-[15rem] object-cover" src="{{ asset($b->buku->ImgBuku) }}" alt="" />
                                    <div class="p-5 flex flex-col items-start justify-between flex-grow">
                                        <div class="flex flex-row items-center space-x-2 mb-2">
                                            <i class="fa-solid fa-star text-yellowjabar"></i>
                                            <p class="font-semibold text-sm text-yellowjabar">{{$b->Rating}}</p>
                                        </div>
                                        <h5 class="mb-2 text-md text-wrap font-bold tracking-tight text-gray-900 truncate max-w-[7rem] lg:max-w-[10rem] lg:max-h-[15rem]">{{ $b->Ulasan }}</h5>
                                        <p class="mb-2 text-sm font-normal text-gray-700">{{ $b->Penulis }}</p>
                                        <figcaption class="flex items-center mt-6 space-x-3 rtl:space-x-reverse">
                                            <img class="w-6 h-6 rounded-full" src="{{ asset($b->user->imguser) }}" alt="profile picture">
                                            <div class="flex items-center divide-x-2 rtl:divide-x-reverse divide-gray-300">
                                                <cite class="pe-3 font-medium text-sm text-gray-900">{{ $b->user->username }}</cite>
                                                <cite class="ps-3 text-xs text-gray-500 max-w-14 truncate">{{ $b->buku->Judul }}</cite>
                                            </div>
                                        </figcaption>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>


            </div>

        </div>

        <div class="w-full h-full lg:py-[5%] bg-bluejabar text-white px-10 lg:m-auto">
            <div class="flex flex-row justify-between items-center">

                <p class="font-bold text-white lg:text-3xl my-10 lg:px-20">What are you waiting for? <br> Join now and register!</p>


                <div class="flex space-x-3 lg:px-20">
                    <a href="{{ route('login') }}" class="px-3 py-2 bg-white text-black hover:text-greenjabar hover:underline rounded-lg">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="px-3 py-2 bg-greenjabar hover:bg-green-800 text-white rounded-lg">
                        Register
                    </a>
                </div>
            </div>
        </div>
    </div>


<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 2,
            centeredSlides: true,
            spaceBetween: 20,
            autoplay: {
            delay: 3000,
            },
        });
    </script>
    <script>
        var swiper = new Swiper(".mySwiper2", {
            slidesPerView: 5,
            spaceBetween: 3,
        });
    </script>
    <script>
        var swiper = new Swiper(".mySwiper3", {
            slidesPerView: 5,
            spaceBetween: 30,
        });
    </script>

@endsection
