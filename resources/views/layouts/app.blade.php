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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])






    <!-- link dashboard -->


    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Soft UI Dashboard 3 by Creative Tim
    </title>



    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!-- jQuery and SweetAlert for image preview and confirmation -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .frm {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-content: center;
            justify-content: space-between;

        }

        button,
        .btn-primary {
            background-color: #907457 !important;
        }


        @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");

        :root {
            --header-height: 3rem;
            --nav-width: 68px;
            --first-color: #4723D9;
            --first-color-light: #AFA5D9;
            --white-color: #F7F6FB;
            --body-font: 'Nunito', sans-serif;
            --normal-font-size: 1rem;
            --z-fixed: 100
        }

        *,
        ::before,
        ::after {
            box-sizing: border-box
        }

        body {
            position: relative;
            margin: var(--header-height) 0 0 0;
            padding: 0 1rem;
            font-family: var(--body-font);
            font-size: var(--normal-font-size);
            transition: .5s
        }

        a {
            text-decoration: none
        }

        .header {
            width: 100%;
            height: var(--header-height);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1rem;
            background-color: var(--white-color);
            z-index: var(--z-fixed);
            transition: .5s
        }

        .header_toggle {
            color: #907457;
            font-size: 1.5rem;
            cursor: pointer
        }

        .header_img {
            width: 35px;
            height: 35px;
            display: flex;
            justify-content: center;
            border-radius: 50%;
            overflow: hidden
        }

        .header_img img {
            width: 40px
        }

        .l-navbar {
            position: fixed;
            top: 0;
            left: -30%;
            width: var(--nav-width);
            height: 100vh;
            background-color: #907457;
            padding: .5rem 1rem 0 0;
            transition: .5s;
            z-index: var(--z-fixed)
        }

        .nav {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden
        }

        .nav_logo,
        .nav_link {
            display: grid;
            grid-template-columns: max-content max-content;
            align-items: center;
            column-gap: 1rem;
            padding: .5rem 0 .5rem 1.5rem
        }

        .nav_logo {
            margin-bottom: 2rem
        }

        .nav_logo-icon {
            font-size: 1.25rem;
            color: var(--white-color)
        }

        .nav_logo-name {
            color: var(--white-color);
            font-weight: 700
        }

        .nav_link {
            position: relative;
            color: var(--first-color-light);
            margin-bottom: 1.5rem;
            transition: .3s
        }

        .nav_link:hover {
            color: var(--white-color)
        }

        .nav_icon {
            font-size: 1.25rem
        }

        .show {
            left: 0
        }

        .body-pd {
            padding-left: calc(var(--nav-width) + 1rem)
        }

        .active {
            color: var(--white-color)
        }

        .active::before {
            content: '';
            position: absolute;
            left: 0;
            width: 2px;
            height: 32px;
            background-color: var(--white-color)
        }

        .height-100 {
            height: 100vh
        }

        @media screen and (min-width: 768px) {
            body {
                margin: calc(var(--header-height) + 1rem) 0 0 0;
                padding-left: calc(var(--nav-width) + 2rem)
            }

            .header {
                height: calc(var(--header-height) + 1rem);
                padding: 0 2rem 0 calc(var(--nav-width) + 2rem)
            }

            .header_img {
                width: 40px;
                height: 40px
            }

            .header_img img {
                width: 45px
            }

            .l-navbar {
                left: 0;
                padding: 1rem 1rem 0 0
            }

            .show {
                width: calc(var(--nav-width) + 156px)
            }

            .body-pd {
                padding-left: calc(var(--nav-width) + 188px)
            }
        }
    </style>

</head>

<body>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <div id="app">

        <body id="body-pd">
            <header class="header" id="header">
                <div class="header_toggle">
                    <i class="bx bx-menu" id="header-toggle"></i>
                </div>
                <div class="header_img">
                    @if (auth()->check() && auth()->user()->img)
                        <img src="{{ asset('bahaa/storage/app/public/' . auth()->user()->img) }}" alt="User Image" />
                    @else
                    <img src="https://i.imgur.com/hczKIze.jpg" alt />
                    @endif

                </div>
            </header>
            <div class="l-navbar" id="nav-bar">
                <nav class="nav">
                    <div>
                        <a href="#" class="nav_logo">
                            {{-- <i class="bx bx-layer nav_logo-icon"></i> --}}
                            <img src="{{ asset('../../bahaa/public/assets/img/logo.png') }}" alt="">
                            {{-- <span class="nav_logo-name">BBBootstrap</span> --}}
                        </a>
                        <div class="nav_list">
                            <a href="{{ route('dashboard.index') }}" class="nav_link active">
                                <i class="bx bx-grid-alt nav_icon"></i>
                                <span class="nav_name">Dashboard</span>
                            </a>
                            <a href="{{ route('users.index') }}" class="nav_link">
                                <i class="bx bx-user nav_icon"></i>
                                <span class="nav_name">Users</span>
                            </a>
                            <a href="{{ route('bookes.index') }}" class="nav_link">
                                <i class="bx bx-message-square-detail nav_icon"></i>
                                <span class="nav_name">Bookes</span>
                            </a>
                            <a href="{{ route('contacts.index') }}" class="nav_link">
                                <i class="fa-regular fa-id-badge"></i>
                                <span class="nav_name">Contacts</span>
                            </a>
                            {{-- <a href="#" class="nav_link">
                                <i class="bx bx-folder nav_icon"></i>
                                <span class="nav_name">Files</span>
                            </a>
                            <a href="#" class="nav_link">
                                <i class="bx bx-bar-chart-alt-2 nav_icon"></i>
                                <span class="nav_name">Stats</span>
                            </a> --}}
                        </div>
                    </div>
                    {{-- <a href="{{ route('logout') }}" class="nav_link" method="POST">
                  <i class="bx bx-log-out nav_icon"></i>
                  <span class="nav_name">SignOut</span>
                </a> --}}




                    <a class="nav_link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        <i class="bx bx-log-out nav_icon"></i>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>


                </nav>
            </div>


            <main class="py-4">

                @yield('content')

            </main>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            const showNavbar = (toggleId, navId, bodyId, headerId) => {
                const toggle = document.getElementById(toggleId),
                    nav = document.getElementById(navId),
                    bodypd = document.getElementById(bodyId),
                    headerpd = document.getElementById(headerId);

                // Validate that all variables exist
                if (toggle && nav && bodypd && headerpd) {
                    toggle.addEventListener("click", () => {
                        // show navbar
                        nav.classList.toggle("show");
                        // change icon
                        toggle.classList.toggle("bx-x");
                        // add padding to body
                        bodypd.classList.toggle("body-pd");
                        // add padding to header
                        headerpd.classList.toggle("body-pd");
                    });
                }
            };

            showNavbar("header-toggle", "nav-bar", "body-pd", "header");

            /*===== LINK ACTIVE =====*/
            const linkColor = document.querySelectorAll(".nav_link");

            function colorLink() {
                if (linkColor) {
                    linkColor.forEach((l) => l.classList.remove("active"));
                    this.classList.add("active");
                }
            }
            linkColor.forEach((l) => l.addEventListener("click", colorLink));

            // Your code to run since DOM is loaded and ready
        });
    </script>
    <script>
        function setCurrentDateTimeById(elementId) {
            var currentDate = new Date().toISOString().slice(0, 16);
            $('#' + elementId).val(currentDate);
        }
    </script>


    <script>
        $(document).ready(function() {
            $('#uploadImage, #uploadButton').click(function() {
                $('#fileInput').click();
            });

            $('#fileInput').change(function(event) {
                const file = event.target.files[0];
                if (file) {
                    console.log("File selected:", file.name);
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('input[name="rating"]').on('change', function() {
                var ratingValue = $(this).val();
                console.log('Selected rating: ' + ratingValue + ' stars');
                $('#rate').val(ratingValue);
            });
        });


        $('.card').each(function() {
            var slideId = $(this).data('id');
            var hiddenValue = $('#rate-' + slideId).val();
            console.log(hiddenValue);

            // Set the correct radio button based on hidden value
            $('input[id="rating-' + slideId + '-' + hiddenValue + '"]').prop('checked', true);
        });
    </script>


    <style>
        img {
            max-height: 250px;
        }

        .card-body form button {
            width: 100%
        }

        form button {
            width: 92%
        }

        body {

            background-color: #f7f6f6;
        }

        .card {

            width: 350px;
            border: none;
            box-shadow: 5px 6px 6px 2px #e9ecef;
            border-radius: 12px;
        }

        .circle-image img {

            border: 6px solid #fff;
            border-radius: 100%;
            padding: 0px;
            top: -28px;
            position: relative;
            width: 70px;
            height: 70px;
            border-radius: 100%;
            z-index: 1;
            background: #e7d184;
            cursor: pointer;

        }


        .dot {
            height: 18px;
            width: 18px;
            background-color: blue;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            border: 3px solid #fff;
            top: -48px;
            left: 186px;
            z-index: 1000;
        }

        .name {
            margin-top: -21px;
            font-size: 18px;
        }


        .fw-500 {
            font-weight: 500 !important;
        }


        .start {

            color: green;
        }

        .stop {
            color: red;
        }


        .rate {

            border-bottom-right-radius: 12px;
            border-bottom-left-radius: 12px;
            background-color: white;

        }



        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center
        }

        .rating>input {
            display: none
        }

        .rating>label {
            position: relative;
            width: 1em;
            font-size: 30px;
            font-weight: 300;
            color: #FFD600;
            cursor: pointer
        }

        .rating>label::before {
            content: "\2605";
            position: absolute;
            opacity: 0
        }

        .rating>label:hover:before,
        .rating>label:hover~label:before {
            opacity: 1 !important
        }

        .rating>input:checked~label:before {
            opacity: 1
        }

        .rating:hover>input:checked~label:before {
            opacity: 0.4
        }


        .buttons {
            top: 36px;
            position: relative;
        }


        .rating-submit {
            border-radius: 15px;
            color: #fff;
            height: 49px;
        }


        .rating-submit:hover {

            color: #fff;
        }
    </style>

</body>

</html>
