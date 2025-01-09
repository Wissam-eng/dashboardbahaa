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
            justify-content: space-around;
        }
    </style>



















    @if ($id == 1)
        <div class="alert alert-primary hed" role="alert">

            <a href="{{ url('slides/1') }}">
                <i class="fa-solid fa-border-all"></i>
            </a>


            <p style="margin: 0px;">Slide Trash</p>


            {{-- <i id="openFormModal" style="cursor: pointer" class="fa-regular fa-square-plus"></i> --}}

        </div>
    @elseif ($id == 2)
        <div class="alert alert-primary hed" role="alert">



            <a href="{{ url('gallery/2') }}">
                <i class="fa-solid fa-border-all"></i>
            </a>


            <p style="margin: 0px;">Gallery Trash</p>


        </div>
    @elseif ($id == 3)
        <div class="alert alert-primary hed" role="alert">



            <a href="{{ url('gallery/3') }}">
                <i class="fa-solid fa-border-all"></i>
            </a>


            <p style="margin: 0px;"> Our Group Trash</p>

        </div>
    @elseif ($id == 4)
        <div class="alert alert-danger" role="alert">
            Why Bahaa?
        </div>
    @elseif ($id == 5)
        <div class="alert alert-primary hed" role="alert">



            <a href="{{ url('gallery/5') }}">
                <i class="fa-solid fa-border-all"></i>
            </a>


            <p style="margin: 0px;">video Trash</p>

        </div>
    @elseif ($id == 6)
        <div class="alert alert-info" role="alert">
            Customer opinions
        </div>
    @elseif ($id == 7)
        <div class="alert alert-info" role="alert">
            blog
        </div>
    @elseif ($id == 8)
        <div class="alert alert-info" role="alert">
            services
        </div>
    @endif




    <script>
        $(document).ready(function() {
            // Open SweetAlert Modal on Button Click
            $('#openFormModal').on('click', function() {
                Swal.fire({
                    title: "Submit Your Details",
                    html: `
                        <form id="slideForm" enctype="multipart/form-data">
                            @csrf
                            <!-- Image Preview -->
                            <img src="{{ asset('../../bahaa/public/assets/img/download.jpg') }}"
                                 id="uploadImage" style="max-height: 200px; display:block; margin:auto; cursor: pointer;"
                                 alt="Click to upload" title="Click to upload" />

                            <!-- Title Input -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                                <label for="title">Title</label>
                            </div>

                            <!-- Paragraph Input -->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="paragraph" name="text" placeholder="Paragraph"></textarea>
                                <label for="paragraph">Paragraph</label>
                            </div>

                            <!-- File Input (hidden) -->
                            <input type="file" id="fileInput" name="img" class="form-control mb-3" style="display: none;">

                            <!-- Hidden Input -->
                            <input type="hidden" id="type" name="type" value="1">
                        </form>
                    `,
                    showCancelButton: true,
                    confirmButtonText: "Submit",
                    cancelButtonText: "Cancel",
                    didOpen: () => {
                        // Add click event to the image
                        $('#uploadImage').on('click', function() {
                            $('#fileInput').trigger('click'); // Open file dialog
                        });

                        // Update the image preview when a file is selected
                        $('#fileInput').on('change', function(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    $('#uploadImage').attr('src', e.target
                                        .result); // Update the image source
                                };
                                reader.readAsDataURL(file);
                            }
                        });
                    },
                    preConfirm: () => {
                        // Send the form data using AJAX
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



    @if (!$slides->isEmpty())
        <div class="container-fluid py-4">
            <div class="container text-center">
                <div class="d-flex justify-content-center flex-wrap">
                    @foreach ($slides as $slid)
                        <div class="card mx-2 mb-3" style="width: 18rem;" data-id="{{ $slid->id }}">

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

                                    {{-- <div class="form-floating mt-3">
                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea{{ $slid->id }}"
                                            name="text">{{ $slid->text }}</textarea>
                                        <label for="floatingTextarea{{ $slid->id }}">Text</label>
                                    </div> --}}



                                    {{-- @if ($id == 6)
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
                                    @endif --}}



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
