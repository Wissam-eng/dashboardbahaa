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




















        <div class="alert alert-primary hed" role="alert">

            <a href="{{ url('users') }}">
                <i class="fa-solid fa-border-all"></i>
            </a>


            <p style="margin: 0px;">usere Trash</p>



        </div>



{{--
    <script>
        $(document).ready(function() {
            // Open SweetAlert Modal on Button Click
            $('#openFormModal').on('click', function() {
                Swal.fire({
                    title: "Submit Your Details",
                    html: `
                        <form id="usereForm" enctype="multipart/form-data">
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
                            <input type="hidden" id="type" name="type" value="{{ $id }}">
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
                        const form = $('#usereForm')[0];
                        const formData = new FormData(form);

                        return $.ajax({
                            url: "{{ route('useres.store') }}",
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
    </script> --}}



    @if (!$users->isEmpty())
        <div class="container-fluid py-4">
            <div class="container text-center">
                <div class="d-flex justify-content-center flex-wrap">
                    @foreach ($users as $user)
                        <div class="card mx-2 mb-3" style="width: 18rem;" data-id="{{ $user->id }}">

                            <div class="card-header">



                                <form action="{{ route('users.restore', ['id' => $user->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-arrow-rotate-left"></i>
                                    </button>
                                </form>


                                <div class="card-body">



                                        <div class="img-container"
                                            onclick="document.getElementById('fileInput{{ $user->id }}').click();">
                                            <img src="{{ asset('../../bahaa/public/storage/' . $user->img) }}"
                                                class="card-img-top" alt="..." id="uploadImage{{ $user->id }}">
                                        </div>


                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="title" name="title"
                                                value="{{ $user->name }}" placeholder="Title">
                                            <label for="title">name</label>
                                        </div>


                                        <div class="form-floating mt-3">
                                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea{{ $user->id }}"
                                                name="text">{{ $user->email }}</textarea>
                                            <label for="floatingTextarea{{ $user->id }}">email</label>
                                        </div>





                                    <form id="delete-form-{{ $user->id }}"
                                        action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger mt-2"
                                            onclick="confirmDelete('{{ $user->id }}')">
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
        function confirmDelete(usereId) {
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
                    $('#delete-form-' + usereId).submit();
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
