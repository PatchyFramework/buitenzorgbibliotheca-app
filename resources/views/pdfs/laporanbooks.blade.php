<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Report - @yield('title', 'Books') - {{ date('F') }} {{ date('Y') }}</title>

        <style type="text/css">
            @page {
                margin: 0px;
            }

            body {
                margin: 0px;
            }

            * {
                font-family: Verdana, Arial, sans-serif;
            }

            a {
                color: #fff;
                text-decoration: none;
            }

            .invoice table {
            border-spacing: 1;
            border-collapse: collapse;
            background:white;
            border-radius:6px;
            overflow:hidden;
            max-width:800px;
            width:100%;
            margin:0 auto;
            padding-left: 30px;
            padding-right: 30px;


            td,th           { padding-left:8px}

            thead tr        {
                height:60px;
                background:black;
                color: white;
                font-size:16px;
            }

            tbody tr        { height:48px; border-bottom:1px solid grey ;
                &:last-child  { border:0; }
            }

                .invoice td,th 					{ text-align:center;
                    &.l 					{ text-align:right }
                    &.c 					{ text-align:center }
                    &.r 					{ text-align:center }
                }
            }

            table {
                font-size: x-small;
            }

            tfoot tr td {
                font-weight: bold;
                font-size: x-small;
            }

            .invoice h3 {
                margin-left: 15px;
                margin-bottom: 25px;
            }

            .information {
                background-color: black;
                color: #FFF;
            }

            .information .logo {
                margin: 5px;
            }

            .information table {
                padding: 10px;
            }
            .divider {
                margin-top: 20px;
                padding-top: 20px;
            }
        </style>

    </head>
    <body>
        <div class="information">
            <table width="100%">
                <tr>
                    <td align="left" style="width: 50%;">
                        <img src="img/bgblack.png" alt="Logo" width="150" class="logo"/>
                        <pre>
                            21st Muslihat Capt. Street
                            Bogor
                            Indonesia
                            <br />
                            Logged as : {{ Auth::user()->username }}
                            Date: {{ date('Y-m-d') }}
                        </pre>
                    </td>
                    <td align="right" style="width: 50%;">
                        <h3></h3>
                        <pre>
                            3rd Veteran Street
                            Bogor
                            Indonesia
                        </pre>
                    </td>
                </tr>
            </table>
        </div>



        <br/>

        <div class="invoice">
            <h3>Table Report : @yield('title', 'Added Books'), {{ date('F') }} {{ date('Y') }}</h3>
            <table width="100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Barcode</th>
                        <th>Category</th>
                        <th>Book Name</th>
                        <th>Author</th>
                        <th>Publisher</th>
                        <th>Publish Year</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach($kategorirelasi as $relasi)
                <tr align="center">
                    <td>{{ $no }}</td>
                    <td>{{ $relasi->buku->Barcode }}</td>
                    <td>{{ $relasi->kategoriBuku->NamaKategori }}</td>
                    <td>{{ $relasi->buku->Judul }}</td>
                    <td>{{ $relasi->buku->Penulis }}</td>
                    <td>{{ $relasi->buku->Penerbit }}</td>
                    <td>{{ $relasi->buku->TahunTerbit }}</td>
                </tr>
                @php $no++; @endphp
                @endforeach
                </tbody>

                <tfoot>
                <tr align="center">
                    <td colspan="5"></td>
                    <td>Total</td>
                    <td class="gray">{{ count($kategorirelasi) }}</td>
                </tr>
                </tfoot>
            </table>
        </div>

        <br class="divider"/>
        <div style="page-break-before: always;"></div>

        <div class="invoice">
            <h3>Table Report : @yield('title', 'Book Loans'), {{ date('F') }} {{ date('Y') }}</h3>
            <table width="100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Barcode</th>
                        <th>Book Name</th>
                        <th>Author</th>
                        <th>Publisher</th>
                        <th>Publish Year</th>
                        <th>Total Loans</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach($peminjaman as $relasi)
                <tr align="center">
                    <td>{{ $no }}</td>
                    <td>{{ $relasi->buku->Barcode }}</td>
                    <td>{{ $relasi->buku->Judul }}</td>
                    <td>{{ $relasi->buku->Penulis }}</td>
                    <td>{{ $relasi->buku->Penerbit }}</td>
                    <td>{{ $relasi->buku->TahunTerbit }}</td>
                    <td>{{ $relasi->total_peminjaman }}</td>
                </tr>
                @php $no++; @endphp
                @endforeach
                </tbody>

                <tfoot>
                <tr align="center">
                    <td colspan="5"></td>
                    <td>Total</td>
                    <td class="gray">{{ $peminjaman->sum('total_peminjaman') }}</td>
                </tr>
                </tfoot>
            </table>
        </div>

        <div class="information" style="position: absolute; bottom: 0; width: 100%;">
            <table width="100%">
                <tr>
                    <td align="left" style="width: 50%;">
                        &copy; {{ date('Y') }} Buitenzorg Bibliotheca - All rights reserved.
                    </td>
                    <td align="right" style="width: 50%;">
                        Priyatama Techno Creation
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
