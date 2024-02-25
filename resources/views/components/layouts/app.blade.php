<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css', 'resources/css/navbar.css', 'resources/css/sidebar.css'])
    @livewireStyles
</head>
<body style="background-color: #E9E9E9;">
<script>
        document.addEventListener("DOMContentLoaded", function() {
            var dropdownToggle = document.getElementById("navbarDropdown");
            var dropdownMenu = document.querySelector(".dropdown-menu");

            dropdownToggle.addEventListener("click", function() {
                dropdownMenu.classList.toggle("show");
            });

            window.addEventListener("click", function(event) {
                if (!dropdownToggle.contains(event.target)) {
                    dropdownMenu.classList.remove("show");
                }
            });
        });

        function open_sidebar() {
            var sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("open");

            var navbar = document.querySelector(".navbar");
            navbar.classList.toggle("sidebar-open");

            toggleSidebar();
        }

        function close_sidebar() {
            document.getElementById("sidebar").style.display = "none";
        }

        function toggleSidebar() {
            var sidebar = document.getElementById("sidebar");
            var rabContainer = document.querySelector(".rab-container");

            if (sidebar.classList.contains("open")) {
                rabContainer.style.marginLeft = "250px";
            } else {
                rabContainer.style.marginLeft = "0";
            }
        }
    </script>
    <x-navbar />
    <x-sidebar/>
    <div >
        <main class="w-100 h-100">
            @yield('content')
        </main>
    </div>
    @livewireScripts
</body>
</html>
