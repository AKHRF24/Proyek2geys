<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/custome.css">
    <title>Toko Online</title>
</head>

<body>
    <main class="d-flex flex-row px-2">
        @include('admin.layouts.sidebar')
        <div style="margin-left: 280px; width:100%; margin-top:10px;">
            @include('admin.layouts.navbar')
            <hr>
            <div class="mt-4">
                <section>
                    <article>
                        @yield('content')
                    </article>
                </section>
            </div>
            <hr>
        </div>
    </main>
</body>
</html>
