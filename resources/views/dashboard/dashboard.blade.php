@extends('./components/layout')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-5">
    <div class="grid grid-cols-4 gap-3">
        <div class="p-5 bg-white rounded-lg flex flex-row justify-between">
            <div class="flex flex-col text-black">
                <div class="font-bold text-md">Total Buku Terdata</div>
                <div class="font-semibold text-md">{{ $bukucount }}</div>
            </div>
        
            <div class="w-12 h-12 bg-bluejabar text-gray-100 rounded-full flex justify-center items-center aspect-square">
                <i class="fa-solid fa-book-open-reader"></i>
            </div>
        </div>
        <div class="p-5 bg-white rounded-lg flex flex-row justify-between">
            <div class="flex flex-col items-start text-black">
                <div class="font-bold text-md">Total Kategori Buku Terdata</div>
                <div class="font-semibold text-md">{{ $kategoricount }}</div>
            </div>
        
            <div class="w-12 h-12 bg-yellowjabar text-gray-100 rounded-full flex justify-center items-center aspect-square">
                <i class="fa-solid fa-book-open-reader"></i>
            </div>
        </div>
        
        
        <div class="p-5 bg-white rounded-lg flex flex-row justify-between">
            <div class="flex flex-col text-black">
                <div class="font-bold text-md">Total Pengguna Terdata</div>
                <div class="font-semibold text-md">{{ $usercount }}</div>
            </div>
        
            <div class="w-12 h-12 bg-greenjabar text-gray-100 rounded-full flex justify-center items-center aspect-square">
                <i class="fa-solid fa-book-open-reader"></i>
            </div>
        </div>
        <div class="p-5 bg-white rounded-lg flex flex-row justify-between">
            <div class="flex flex-col text-black">
                <div class="font-bold text-md">Total Peminjaman Terdata</div>
                <div class="font-semibold text-md">{{ $peminjamancount }}</div>
            </div>
        
            <div class="w-12 h-12 bg-darkbluejabar text-gray-100 rounded-full flex justify-center items-center aspect-square">
                <i class="fa-solid fa-book-open-reader"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md w-full h-[450px] border-gray-300 border-opacity-50 border">
        <canvas class="" id="myChart"></canvas>
    </div>
</div>

<script>
    const ctx = document.getElementById('myChart');
  
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Buku', 'Kategori', 'Peminjaman', 'Pengguna'],
        datasets: [{
          label: '# of Votes',
          data: [{{$bukucount}}, {{$kategoricount}}, {{$peminjamancount}}, {{$usercount}}],
          borderWidth: 1
        }]
      },
      options: {
        layout: {
                padding: 15,
            },
        scales: {
          y: {
            beginAtZero: true,
            min: 0,
            max: 50,
          }
        }
      }
    });
</script>
  
@endsection