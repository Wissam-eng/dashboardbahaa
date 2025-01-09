@extends('layouts.app')

@section('title', 'الصفحة الرئيسية')

@section('content')
    <style>
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
    </style>

    @if ($id == 1)
        <div class="alert alert-primary" role="alert">
            Slide
        </div>
    @elseif ($id == 2)
        <div class="alert alert-secondary" role="alert">
            Gallery
        </div>
    @elseif ($id == 3)
        <div class="alert alert-success" role="alert">
            Our Group
        </div>
    @elseif ($id == 4)
        <div class="alert alert-danger" role="alert">
            Why Bahaa?
        </div>
    @elseif ($id == 5)
        <div class="alert alert-warning" role="alert">
            Blog
        </div>
    @elseif ($id == 6)
        <div class="alert alert-info" role="alert">
            Services
        </div>
    @elseif ($id == 7)
        <div class="alert alert-info" role="alert">
            Video
        </div>
    @elseif ($id == 8)
        <div class="alert alert-info" role="alert">
            Views
        </div>
    @endif









    @dd($type_page)





    <div class="container-fluid py-4">
        <div class="container text-center">
            <div class="d-flex justify-content-center flex-wrap">
                @foreach ($slides as $slid)
                    <div class="card mx-2 mb-3" style="width: 18rem;">
                        <div class="card-header">
                            @if ($type_page == 'untrashed')
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $slid->id }})">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            @elseif ($type_page == 'trash')
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $slid->id }})">
                                    <i class="fa-solid fa-arrow-rotate-left"></i> </button>
                            @endif
                        </div>
                        <div class="card-body">
                            <form action="{{ route('dashboard.slides.update', $slid->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="img-container"
                                    onclick="document.getElementById('fileInput{{ $slid->id }}').click();">
                                    <img src="{{ asset('storage/' . $slid->img) }}" class="card-img-top" alt="..."
                                        id="uploadImage{{ $slid->id }}">
                                </div>

                                <div class="form-floating mt-3">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea{{ $slid->id }}"
                                        name="text">{{ $slid->text }}</textarea>
                                    <label for="floatingTextarea{{ $slid->id }}">Text</label>
                                </div>

                                <br>

                                <input type="file" id="fileInput{{ $slid->id }}" name="img"
                                    onchange="previewImage(event, {{ $slid->id }})">

                                <button class="btn btn-primary mt-2">Update</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                    deleteSlide(slideId);
                }
            });
        }

        function deleteSlide(slideId) {
            var form = $('<form>', {
                method: 'POST',
                action: '/dashboard/slides/' + slideId
            });

            form.append($('<input>', {
                type: 'hidden',
                name: '_token',
                value: "{{ csrf_token() }}"
            }));

            form.append($('<input>', {
                type: 'hidden',
                name: '_method',
                value: 'DELETE'
            }));

            $('body').append(form);
            form.submit();
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
