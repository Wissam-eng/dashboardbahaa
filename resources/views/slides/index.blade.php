@extends('layouts.app')

@section('title', 'الصفحة الرئيسية')

@section('content')
    <style>
        .frm {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-content: center;
            justify-content: space-between;

        }

        .alert {
            text-align: center;
            font-weight: bold;
        }

        .img-container {
            cursor: pointer;
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 5px;
        }

        .img-container:hover {
            border-color: #007bff;
        }

        input[type="file"] {
            display: none;
        }

        .hed {
            display: flex;
            justify-content: space-between;
        }
    </style>





    @php
        $items = [
            1 => 'Slide',
            4 => 'FAQ',
            6 => 'Customer opinions',
            7 => 'blog',
            8 => 'services',
            9 => 'why bahaa ?',
        ];
    @endphp

    @if (isset($items[$id]))
        <div class="alert alert-primary hed" role="alert">
            <a href="{{ url('slides/trash/' . $id) }}">
                <i class="fa-regular fa-trash-can"></i>
            </a>
            <p style="margin: 0px;">{{ $items[$id] }}</p>
            <i id="openFormModal" style="cursor: pointer" class="fa-regular fa-square-plus"></i>
        </div>
    @endif





    <script>
        $(document).ready(function() {
            const formHtml = `
            <form id="slideForm" enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('../../bahaa/public/assets/img/download.jpg') }}"
                     id="uploadImage" style="max-height: 200px; display:block; margin:auto; cursor: pointer;"
                     alt="Click to upload" title="Click to upload" />
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                    <label for="title">Title</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" id="paragraph" name="text" placeholder="Paragraph"></textarea>
                    <label for="paragraph">Paragraph</label>
                </div>


                @if ($id == 7)
                    <div class="form-floating mt-3">

                        <input type="text"
                            class="form-control" id="tag"
                            name="tag">

                        <label for="tag">tag</label>
                    </div>

                    <div class="form-floating mt-3">

                        <input type="text"
                            class="form-control" id="blogUrl"
                            name="blogUrl">

                        <label for="blogUrl">blogUrl</label>
                    </div>
                @endif



                <input type="file" id="fileInput" name="img" class="form-control mb-3" style="display: none;">
                <input type="hidden" id="type" name="type" value="{{ $id }}">
                @if ($id == 6)
                    <div class="rating" style="text-align: center;">
                        <input type="radio" name="rating" value="5" id="rating-5">
                        <label for="rating-5">☆</label>
                        <input type="radio" name="rating" value="4" id="rating-4">
                        <label for="rating-4">☆</label>
                        <input type="radio" name="rating" value="3" id="rating-3">
                        <label for="rating-3">☆</label>
                        <input type="radio" name="rating" value="2" id="rating-2">
                        <label for="rating-2">☆</label>
                        <input type="radio" name="rating" value="1" id="rating-1">
                        <label for="rating-1">☆</label>
                    </div>
                    <input type="hidden" id="rate" name="rate">
                @endif
            </form>
        `;

            $('#openFormModal').on('click', function() {
                Swal.fire({
                    title: "Submit Your Details",
                    html: formHtml,
                    showCancelButton: true,
                    confirmButtonText: "Submit",
                    cancelButtonText: "Cancel",
                    didOpen: () => {
                        $('#uploadImage').on('click', function() {
                            $('#fileInput').trigger('click');
                        });

                        $('#fileInput').on('change', function(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    $('#uploadImage').attr('src', e.target.result);
                                };
                                reader.readAsDataURL(file);
                            }
                        });

                        @if ($id == 6)
                            $('input[name="rating"]').on('change', function() {
                                const ratingValue = $(this).val();
                                $('#rate').val(ratingValue);
                            });
                        @endif
                    },
                    preConfirm: () => {
                        const form = $('#slideForm')[0];
                        const formData = new FormData(form);

                        return $.ajax({
                            url: "{{ route('slides.store') }}",
                            method: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Success",
                                    text: "Your details have been saved successfully.",
                                    icon: "success"
                                }).then(() => {
                                    window.location.reload();
                                });
                            },
                            error: function(xhr) {
                                const errorMsg = xhr.responseJSON?.message ||
                                    "An error occurred during submission.";
                                Swal.fire({
                                    title: "Error",
                                    text: errorMsg,
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>








    @if (session('message_flash'))
        <div style="width: 50%;margin:auto;" class="alert alert-success hed" role="alert">
            {{ session('message_flash') }}
        </div>
    @endif


    @if (!$slides->isEmpty())
        <div class="container-fluid py-4">
            <div class="container text-center">
                <div class="d-flex justify-content-center flex-wrap">
                    @foreach ($slides as $slid)
                        <div class="card mx-2 mb-3" style="width: 18rem;" data-id="{{ $slid->id }}">
                            @if ($type_page == 'untrashed')
                                <div class="card-header">
                                    <form id="delete-form-{{ $slid->id }}"
                                        action="{{ route('slides.delete', $slid->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger mt-2"
                                            onclick="confirmDelete('{{ $slid->id }}')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>

                                <div class="card-body">
                                    <form class="frm" action="{{ route('slides.update', $slid->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')


                                        @if ($id == 4)
                                            <!-- Title Input -->
                                            <div class="all">


                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="title" name="title"
                                                        value="{{ $slid->title }}" placeholder="Title">
                                                    <label for="title">Question</label>
                                                </div>

                                                <div class="form-floating mt-3">
                                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea{{ $slid->id }}"
                                                        name="text">{{ $slid->text }}</textarea>
                                                    <label for="floatingTextarea{{ $slid->id }}">Answer</label>
                                                </div>
                                                <!-- Hidden Input -->


                                                @if ($id == 6)
                                                    <div class="rating">
                                                        <input type="radio" name="rating" value="5"
                                                            id="rating-{{ $slid->id }}-5">
                                                        <label for="rating-{{ $slid->id }}-5">☆</label>

                                                        <input type="radio" name="rating" value="4"
                                                            id="rating-{{ $slid->id }}-4">
                                                        <label for="rating-{{ $slid->id }}-4">☆</label>

                                                        <input type="radio" name="rating" value="3"
                                                            id="rating-{{ $slid->id }}-3">
                                                        <label for="rating-{{ $slid->id }}-3">☆</label>

                                                        <input type="radio" name="rating" value="2"
                                                            id="rating-{{ $slid->id }}-2">
                                                        <label for="rating-{{ $slid->id }}-2">☆</label>

                                                        <input type="radio" name="rating" value="1"
                                                            id="rating-{{ $slid->id }}-1">
                                                        <label for="rating-{{ $slid->id }}-1">☆</label>
                                                    </div>
                                                    <input id="rate-{{ $slid->id }}" type="hidden" name="rate"
                                                        value="{{ $slid->rate }}">
                                                @endif




                                                <input type="file" id="fileInput{{ $slid->id }}" name="img"
                                                    onchange="previewImage(event, {{ $slid->id }})">

                                                <button class="btn btn-primary mt-2"><i
                                                        class="fa-solid fa-pen-to-square"></i></button>
                                            </div>
                                        @else
                                            <div class="img-container"
                                                onclick="document.getElementById('fileInput{{ $slid->id }}').click();">
                                                <img src="{{ asset('../../bahaa/public/storage/' . $slid->img) }}"
                                                    class="card-img-top" alt="..."
                                                    id="uploadImage{{ $slid->id }}">
                                            </div>
                                            <!-- Title Input -->
                                            <div class="all">


                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="title" name="title"
                                                        value="{{ $slid->title }}" placeholder="Title">
                                                    <label for="title">Title</label>
                                                </div>

                                                <div class="form-floating mt-3">
                                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea{{ $slid->id }}"
                                                        name="text">{{ $slid->text }}</textarea>
                                                    <label for="floatingTextarea{{ $slid->id }}">Text</label>
                                                </div>


                                                @if ($id == 7)
                                                    <div class="form-floating mt-3">

                                                        <input type="text" value="{{ $slid->tag }}"
                                                            class="form-control" id="tag{{ $slid->id }}"
                                                            name="tag">

                                                        <label for="tag{{ $slid->id }}">tag</label>
                                                    </div>

                                                    <div class="form-floating mt-3">

                                                        <input type="text" value="/get_blog_data/{{ $slid->blogUrl }}"
                                                            class="form-control" id="blogUrl{{ $slid->id }}"
                                                            name="blogUrl">

                                                        <label for="blogUrl{{ $slid->id }}">blogUrl</label>
                                                    </div>
                                                @endif


                                                @if ($id == 6)
                                                    <div class="rating">
                                                        <input type="radio" name="rating" value="5"
                                                            id="rating-{{ $slid->id }}-5">
                                                        <label for="rating-{{ $slid->id }}-5">☆</label>

                                                        <input type="radio" name="rating" value="4"
                                                            id="rating-{{ $slid->id }}-4">
                                                        <label for="rating-{{ $slid->id }}-4">☆</label>

                                                        <input type="radio" name="rating" value="3"
                                                            id="rating-{{ $slid->id }}-3">
                                                        <label for="rating-{{ $slid->id }}-3">☆</label>

                                                        <input type="radio" name="rating" value="2"
                                                            id="rating-{{ $slid->id }}-2">
                                                        <label for="rating-{{ $slid->id }}-2">☆</label>

                                                        <input type="radio" name="rating" value="1"
                                                            id="rating-{{ $slid->id }}-1">
                                                        <label for="rating-{{ $slid->id }}-1">☆</label>
                                                    </div>
                                                    <input id="rate-{{ $slid->id }}" type="hidden" name="rate"
                                                        value="{{ $slid->rate }}">
                                                @endif




                                                <input type="file" id="fileInput{{ $slid->id }}" name="img"
                                                    onchange="previewImage(event, {{ $slid->id }})">

                                                <button class="btn btn-primary mt-2"><i
                                                        class="fa-solid fa-pen-to-square"></i></button>
                                            </div>
                                        @endif
                                        <input type="hidden" id="type" name="type"
                                            value="{{ $id }}">
                                    </form>
                                </div>
                            @elseif ($type_page == 'trashed')
                                <div class="card-header">



                                    <form action="{{ route('slides.restore', $slid->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-arrow-rotate-left"></i>
                                        </button>
                                    </form>


                                    <div class="card-body">
                                        <div class="img-container"
                                            onclick="document.getElementById('fileInput{{ $slid->id }}').click();">
                                            <img src="{{ asset('../../bahaa/public/storage/' . $slid->img) }}"
                                                class="card-img-top" alt="..." id="uploadImage{{ $slid->id }}">
                                        </div>

                                        <div class="form-floating mt-3">
                                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea{{ $slid->id }}"
                                                name="text">{{ $slid->text }}</textarea>
                                            <label for="floatingTextarea{{ $slid->id }}">Text</label>
                                        </div>



                                        @if ($id == 6)
                                            <div class="rating">
                                                <input type="radio" name="rating" value="5"
                                                    id="rating-{{ $slid->id }}-5">
                                                <label for="rating-{{ $slid->id }}-5">☆</label>

                                                <input type="radio" name="rating" value="4"
                                                    id="rating-{{ $slid->id }}-4">
                                                <label for="rating-{{ $slid->id }}-4">☆</label>

                                                <input type="radio" name="rating" value="3"
                                                    id="rating-{{ $slid->id }}-3">
                                                <label for="rating-{{ $slid->id }}-3">☆</label>

                                                <input type="radio" name="rating" value="2"
                                                    id="rating-{{ $slid->id }}-2">
                                                <label for="rating-{{ $slid->id }}-2">☆</label>

                                                <input type="radio" name="rating" value="1"
                                                    id="rating-{{ $slid->id }}-1">
                                                <label for="rating-{{ $slid->id }}-1">☆</label>
                                            </div>
                                            <input id="rate-{{ $slid->id }}" type="hidden" name="rate"
                                                value="{{ $slid->rate }}">
                                        @endif



                                        <form id="delete-form-{{ $slid->id }}"
                                            action="{{ route('slides.destroy', $slid->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger mt-2"
                                                onclick="confirmDelete('{{ $slid->id }}')">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>



                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif







    <script>
        function confirmDelete(slideId) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-form-' + slideId).submit();
                }
            });
        }

        function previewImage(event, id) {
            var reader = new FileReader();
            reader.onload = function() {
                $('#uploadImage' + id).attr('src', reader.result);
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>



@endsection
