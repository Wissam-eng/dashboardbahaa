@extends('layouts.app')
@section('content')
    <style>
        hr {
            border: none;
            border-top: 3px double #333;
            color: #333;
            overflow: visible;
            text-align: center;
            height: 5px;
        }

        hr::after {
            background: #fff;
            content: "§";
            padding: 0 4px;
            position: relative;
            top: -13px;
        }

        .bg-gradient-primary {
            background: linear-gradient(to bottom, #1976d2, #0d47a1);
        }

        .nav-link {

            font-size: 1rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .nav-link i {
            margin-right: 10px;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }

        .sidebar .text-center img {
            border: 2px solid white;
        }

        .heart-container {
            position: relative;
            display: inline-block;
            font-size: 62px;
        }

        .heart-container .fa-heart {
            color: red;
        }

        .heart-container .text {
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .search-container {
            display: flex;
            align-items: center;
        }

        .search-form {
            display: none;
            margin-left: 10px;
        }

        .search-icon {
            cursor: pointer;
        }

        .trash_it,
        .delete_it {
            /* color: red; */
            cursor: pointer
        }

        .edit_it,
        .restor_it {
            color: green;
            cursor: pointer
        }

        a {
            text-decoration: auto;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            padding: 1rem;
            justify-content: center;
        }

        .card {
            height: 100px;
            flex: 0 0 auto;
            width: 100px;
            margin-right: 10px;
            scroll-snap-align: start;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);




        }

        .card-header {
            position: relative;
        }

        .card-img {
            width: 100%;
            height: 200px;
            margin-top: 8%;
            object-fit: cover;
        }

        .card-actions {
            position: absolute;
            top: 2px;
            right: 10px;
            display: flex;
            gap: 0.5rem;
            align-items: flex-end;

        }

        .card-actions a,
        .card-actions i {
            color: #315883;
            text-decoration: none;
            font-size: 1.2rem;
        }

        .card-body {
            padding: 1rem;
        }

        .card-title {
            margin: 0;
            font-size: 1.2rem;
        }

        .card-text {
            margin: 0.5rem 0;
        }

        .search-container {
            display: flex;
            align-items: center;
        }

        .search-form {
            display: none;
            margin-left: 10px;
        }

        .search-icon {
            cursor: pointer;
        }
    </style>



    <div class="d-flex">
        <div class="content flex-grow-1 p-3">
            <div class="container">
                <div class="card-body">

                    <div class="card-container">


                        <div class="card">
                            <div class="card-header" style="text-align: center;">
                                <a href="{{ url('slides/1') }}">
                                    <i class="fa-regular fa-image"
                                        style="font-size: 300%;color: #0dcaf0; cursor: pointer;"></i>
                                </a>

                                <div class="card-actions">


                                </div>
                            </div>

                            <div class="dd">
                                <h5 class="card-title"><i class="fa-solid fa-hashtag"></i>Slides </h5>
                                <a title="View Student"><i class="fa-solid fa-circle-info" style="cursor: pointer;"></i></a>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" style="text-align: center;">
                                <a href="{{ url('gallery/2') }}">
                                    <i class="fa-brands fa-google"
                                        style="font-size: 300%;color: #0dcaf0; cursor: pointer;"></i>
                                </a>

                                <div class="card-actions">


                                </div>
                            </div>

                            <div class="dd">
                                <h5 class="card-title"><i class="fa-solid fa-hashtag"></i>Gallery </h5>
                                <a title="View Student"><i class="fa-solid fa-circle-info" style="cursor: pointer;"></i></a>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" style="text-align: center;">
                                <a href="{{ url('gallery/3') }}" <i class="fa-solid fa-users-rectangle"
                                    style="font-size: 300%;color: #0dcaf0; cursor: pointer;"></i>
                                </a>

                                <div class="card-actions">


                                </div>
                            </div>

                            <div class="dd">
                                <h5 class="card-title"><i class="fa-solid fa-hashtag"></i>Our Group </h5>
                                <a title="View Student"><i class="fa-solid fa-circle-info" style="cursor: pointer;"></i></a>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" style="text-align: center;">
                                <a href="{{ url('slides/4') }}">
                                    <i class="fa-brands fa-facebook-f"
                                        style="font-size: 300%;color: #31bfa6; cursor: pointer;"></i>
                                </a>
                                <div class="card-actions">


                                </div>
                            </div>

                            <div class="dd">
                                <h5 class="card-title"><i class="fa-solid fa-hashtag"></i>FAQ </h5>
                                <a title="View Student"><i class="fa-solid fa-circle-info" style="cursor: pointer;"></i></a>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" style="text-align: center;">
                                <a href="{{ url('gallery/5') }}">
                                    <i class="fa-solid fa-play"
                                        style="font-size: 300%;color: #3163bf; cursor: pointer;"></i>
                                </a>
                                <div class="card-actions">


                                </div>
                            </div>

                            <div class="dd">
                                <h5 class="card-title"><i class="fa-solid fa-hashtag"></i>Video </h5>
                                <a title="View Student"><i class="fa-solid fa-circle-info" style="cursor: pointer;"></i></a>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header" style="text-align: center;">
                                <a href="{{ url('slides/6') }}">
                                    <i class="fa-solid fa-street-view"
                                        style="font-size: 300%;color: #ad652f; cursor: pointer;"></i>
                                </a>
                                <div class="card-actions">


                                </div>
                            </div>

                            <div class="dd">
                                <h5 class="card-title"><i class="fa-solid fa-hashtag"></i>Customer Opinions </h5>
                                <a title="View Student"><i class="fa-solid fa-circle-info" style="cursor: pointer;"></i></a>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header" style="text-align: center;">
                                <a href="{{ url('slides/7') }}">
                                    <i class="fa-solid fa-paperclip"
                                        style="font-size: 300%;color: #3163bf; cursor: pointer;"></i>
                                </a>
                                <div class="card-actions">


                                </div>
                            </div>

                            <div class="dd">
                                <h5 class="card-title"><i class="fa-solid fa-hashtag"></i>Blog </h5>
                                <a title="View Student"><i class="fa-solid fa-circle-info" style="cursor: pointer;"></i></a>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" style="text-align: center;">
                                <a href="{{ url('slides/8') }}">
                                    <i class="fa-solid fa-database"
                                        style="font-size: 300%;color: #198754; cursor: pointer;"></i>
                                </a>
                                <div class="card-actions">


                                </div>
                            </div>

                            <div class="dd">
                                <h5 class="card-title"><i class="fa-solid fa-hashtag"></i>Services </h5>
                                <a title="View Student"><i class="fa-solid fa-circle-info"
                                        style="cursor: pointer;"></i></a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" style="text-align: center;">
                                <a href="{{ url('slides/9') }}">
                                    <i class="fa-regular fa-circle-question"
                                        style="font-size: 300%;color: #198754; cursor: pointer;"></i>
                                </a>
                                <div class="card-actions">


                                </div>
                            </div>

                            <div class="dd">
                                <h5 class="card-title"><i class="fa-solid fa-hashtag"></i>why bahaa? </h5>
                                <a title="View Student"><i class="fa-solid fa-circle-info"
                                        style="cursor: pointer;"></i></a>
                            </div>
                        </div>




                        <style>
                            .dd {
                                display: flex;
                                align-items: center;
                                justify-content: space-around;
                                height: 86px;
                                color: #0dcaf0;
                            }
                        </style>




                    </div>
                </div>
            </div>
        </div>




    </div>
@endsection
