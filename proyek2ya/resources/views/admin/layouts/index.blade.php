<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/db.css">
    <title>Market Point</title>
    <style>
        .sidebar {
            min-height: 100vh;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background-color: #212529;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,.8);
            padding: 0.8rem 1rem;
            border-radius: 0.375rem;
            margin-bottom: 0.3rem;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: #fff;
        }

        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: white;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: -280px;
                height: 100vh;
                z-index: 1000;
                transition: 0.3s;
            }

            .sidebar.show {
                left: 0;
            }

            .main-content {
                margin-left: 0 !important;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <div class="main-content flex-grow-1 p-3 p-lg-4">
            @include('admin.layouts.navbar')

            <!-- Content -->
            <div class="bg-white rounded shadow-sm p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const toggleBtn = document.querySelector('.btn-dark');

            if (window.innerWidth < 992) {
                if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });
    </script>
</body>
</html>
