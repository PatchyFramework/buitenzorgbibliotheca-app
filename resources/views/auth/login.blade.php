<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Buitenzorg Bibliotheca</title>

    <!-- Tailwind CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Font Import --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Icon Import --}}
    <script src="https://kit.fontawesome.com/2356e25dd7.js" crossorigin="anonymous"></script>



</head>
<body class="font-montserrat">
    <div class="w-screen h-screen flex items-center justify-center bg-greenjabar/15 lg:bg-white">
        <div class="flex flex-col flex-1 items-center justify-center m-5">
            <img src="{{ asset('img/nobg.png') }}" alt="Logo" class="max-w-[10rem] lg:max-w-[15rem]">

            <div class="w-full h-full flex items-center justify-center">
                <div class="w-full max-w-md p-6 bg-white drop-shadow-lg rounded-lg">
                    <form action="{{ route('login.post')}}" method="post" class="space-y-4">
                        @csrf
                        <div>
                            <label for="email" class="block text-lg font-bold text-solidorange">Email</label>
                            <input type="email" name="email" id="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-tealblue peer" placeholder="Masukkan Email atau Username....">
                        </div>
                        <div>
                            <label for="password" class="block text-lg font-bold text-tealblue">Password</label>
                            <input type="password" name="password" id="password"  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-solidorange peer" placeholder="Masukkan Password....">
                        </div>

                        <button type="submit" class="w-full block text-white bg-bluejabar hover:bg-darkbluejabar focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2 text-center">
                            Login
                        </button>
                    </form>

                    <div class="flex flex-row space-x-2 items-center justify-center mt-2">
                        <hr class="w-[50%] h-0.5 bg-gray-400/50">
                        <span class="text-md font-normal text-gray-400/50 text-center mb-2">or</span>
                        <hr class="w-[50%] h-0.5 bg-gray-400/50">
                    </div>

                    <a href="{{ route('register') }}" class="block text-white bg-yellowjabar hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2 text-center">
                        Register
                    </a>
                </div>

            </div>
        </div>



        <div class="hidden lg:block lg:w-[50%] lg:h-[98%] lg:relative lg:m-auto">
            <img src="/img/library1.jpg" class="w-full h-full object-cover rounded-l-xl z-0"/>
            <div class="absolute inset-0 bg-greenjabar/35 rounded-l-xl z-10"></div>
            <div class="absolute bottom-0 left-0 right-0 h-[40%] bg-greenjabar/30 blur-md rounded-lg z-20"></div>
            <div class="absolute bottom-4 left-4 text-white z-30 p-5 font-playfair">
                <p class="text-4xl font-bold">“Fairy tales are more than true: not because they tell us that dragons exist, but because they tell us that dragons can be beaten.”</p>
                <p class="txt-lg font-normal">- Neil Gaiman</p>
            </div>
        </div>



    </div>


    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
