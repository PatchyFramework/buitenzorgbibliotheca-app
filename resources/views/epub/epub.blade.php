<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View ePub</title>
    {{-- <script src="{{ asset('js/epub.js') }}"></script> --}}
    <script src="../dist/epub.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.5/jszip.min.js"></script>
</head>
<body>
    <h1>View ePub</h1>
    <div id="area"></div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var book = ePub(asset("storage/buku/epub/sample1.epub"));
            var rendition = book.renderTo("viewer", { width: "100%", height: 600 });
            rendition.display();
        });
    </script>

    <script>
        var book = ePub("storage/buku/epub/sample1.epub");
        var rendition = book.renderTo("area", {width: 600, height: 400});
        var displayed = rendition.display();
    </script>


</body>
</html>
