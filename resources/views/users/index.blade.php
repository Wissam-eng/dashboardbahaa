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







    <div class="alert alert-primary hed" role="alert">
        <a href="{{ url('users/trash/') }}">
            <i class="fa-regular fa-trash-can"></i>
        </a>

        <p style="margin: 0px;">if you don't want to change password ..  keep it empty</p>
        <i id="openFormModal" style="cursor: pointer" class="fa-regular fa-square-plus"></i>
    </div>







    <script>
        $(document).ready(function() {
            $('#openFormModal').on('click', function() {
                Swal.fire({
                    title: "Submit Your Details",
                    html: `
                        <form id="slideForm"  enctype="multipart/form-data">
                            @csrf
                            <!-- Image Preview -->
                            <img src="{{ asset('../../bahaa/public/assets/img/download.jpg') }}"
                                 id="uploadImage" style="max-height: 200px; display:block; margin:auto; cursor: pointer;"
                                 alt="Click to upload" title="Click to upload" />

                            <!-- name Input -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" name="name" placeholder="name">
                                <label for="name">name</label>
                            </div>

                            <!-- email Input -->
                            <div class="form-floating mb-3">
                                <input class="form-control" type="email" id="email" name="email" placeholder="email">
                                <label for="email">email</label>
                            </div>


                            <!-- password Input -->
                            <div class="form-floating mb-3">
                                <input class="form-control" type="Password" id="password" name="password" placeholder="password">
                                <label for="password">password</label>
                            </div>


                            <!-- Password Input -->
                            <div class="form-floating mb-3">
                                <input class="form-control" type="Password" id="password_confirmation" name="password_confirmation" placeholder="password_confirmation">
                                <label for="password_confirmation">password_confirmation</label>
                            </div>

                            <!-- File Input (hidden) -->
                            <input type="file" id="fileInput" name="img" class="form-control mb-3" style="display: none;">

                            <!-- Hidden Input -->

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
                            url: "{{ route('users.store') }}",
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


    @if (!$users->isEmpty())
        <div class="container-fluid py-4">
            <div class="container text-center">
                <div class="d-flex justify-content-center flex-wrap">
                    @foreach ($users as $slid)
                        <div class="card mx-2 mb-3" style="width: 18rem;" data-id="{{ $slid->id }}">
                            <div class="card-header">
                                <form id="delete-form-{{ $slid->id }}" action="{{ route('users.delete', $slid->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger mt-2"
                                        onclick="confirmDelete('{{ $slid->id }}')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>

                            <div class="card-body">
                                <form class="frm" action="{{ route('users.update', $slid->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')


                                    <div class="img-container"
                                        onclick="document.getElementById('fileInput{{ $slid->id }}').click();">
                                        <img src="{{ asset('../../bahaa/public/storage/' . $slid->img) }}"
                                            class="card-img-top" alt="..." id="uploadImage{{ $slid->id }}">
                                    </div>
                                    <!-- Title Input -->
                                    <div class="all">


                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $slid->name }}" placeholder="name">
                                            <label for="name">name</label>
                                        </div>


                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ $slid->email }}" placeholder="email">
                                            <label for="email">email</label>
                                        </div>



                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="password" name="password" value="">
                                            <label for="password">password</label>
                                        </div>



                                        <input type="file" id="fileInput{{ $slid->id }}" name="img" onchange="previewImage(event, {{ $slid->id }})">


                                        <button class="btn btn-primary mt-2"><i class="fa-solid fa-pen-to-square"></i></button>
                                    </div>

                                </form>
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
