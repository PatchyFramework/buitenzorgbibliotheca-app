<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | Buitenzorg Bibliotheca</title>

    <!-- Tailwind CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Font Import --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Icon Import --}}
    <script src="https://kit.fontawesome.com/2356e25dd7.js" crossorigin="anonymous"></script>

    <style>
  
        .background-animate {
          background-size: 400%;
      
          -webkit-animation: AnimationName 3s ease infinite;
          -moz-animation: AnimationName 3s ease infinite;
          animation: AnimationName 3s ease infinite;
        }
      
        @keyframes AnimationName {
          0%,
          100% {
            background-position: 0% 50%;
          }
          50% {
            background-position: 100% 50%;
          }
        }
      </style> 


</head>
<body class="font-montserrat">
    <div class="w-screen h-screen flex items-center justify-center">
                
        <div class="w-full h-full flex items-center justify-center">         
            <div class="w-full max-w-md p-6 bg-white drop-shadow-lg rounded-lg">
                <form action="{{ route('registeradmin.post')}}" method="post" enctype="multipart/form-data" class="space-y-3">
                    @csrf
                    <div>
                        <label for="username" class="block text-lg font-bold text-solidorange">Username</label>
                        <input type="username" name="username" id="username" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-tealblue peer" placeholder="Masukkan Username atau Username....">
                    </div>
                    <div>
                        <label for="password" class="block text-lg font-bold text-tealblue">Password</label>
                        <input type="password" name="password" id="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-solidorange peer" placeholder="Masukkan Password....">
                    </div>
                    <div>
                        <label for="email" class="block text-lg font-bold text-tealblue">Email</label>
                        <input type="email" name="email" id="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-solidorange peer" placeholder="Masukkan Email....">
                    </div>
                    <div>
                        <label for="namalengkap" class="block text-lg font-bold text-tealblue">Nama Lengkap</label>
                        <input type="namalengkap" name="namalengkap" id="namalengkap" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-solidorange peer" placeholder="Masukkan Nama Lengkap....">
                    </div>
                    <div>
                        <label for="alamat" class="block text-lg font-bold text-tealblue">Alamat</label>
                        <textarea name="alamat" id="alamat" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-solidorange peer" placeholder="Masukkan Alamat....">
                        </textarea>
                    </div>
                    <div class="col-span-2">
                        <label for="imguser" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Profile</label>
                        <input type="file" name="imguser" id="imguser" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" required>
                    </div>
                  
                    <button type="submit" class="w-full p-1 text-white bg-yellowjabar font-normal text-lg rounded-lg cursor-pointer focus:ring-4">
                        Register
                    </button>
                </form>  

                <div class="flex flex-row space-x-2 items-center justify-center mt-2">
                    <hr class="w-[50%] h-0.5 bg-gray-400/50">
                    <span class="text-md font-normal text-gray-400/50 text-center mb-2">or</span>
                    <hr class="w-[50%] h-0.5 bg-gray-400/50">
                </div>



                <a href="{{ route('register') }}" class="block text-white bg-bluejabar hover:bg-darkbluejabar focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2 text-center">
                    Sign up as User
                </a>
            </div>
                              

            
        </div>
        
        
        <div class="w-[98%] h-[98%] relative m-auto">
            <img src="/img/library2.jpg" class="w-full h-full object-cover rounded-l-xl z-0"/>
            <div class="absolute inset-0 bg-greenjabar/35 rounded-l-xl z-10"></div>
            <div class="absolute bottom-0 left-0 right-0 h-[40%] bg-greenjabar/15 blur-md rounded-lg z-20"></div>
            <div class="absolute bottom-4 left-4 text-white z-30 p-5 font-playfair">
                <p class="text-4xl font-bold">“I declare after all there is no enjoyment like reading! How much sooner one tires of any thing than of a book! -- When I have a house of my own, I shall be miserable if I have not an excellent library.”</p>
                <p class="txt-lg font-normal">― Jane Austen, Pride and Prejudice</p>
            </div>
        </div>
        
        
    </div>


    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>