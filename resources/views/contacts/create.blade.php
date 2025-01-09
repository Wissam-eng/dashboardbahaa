@extends('layouts.app')

@section('title', 'الصفحة الرئيسية')

@section('content')

    <div class="container mt-4">

        @if (session('success'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        @elseif (session('error'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        @endif

        <div class="container">
            <div class="alert alert-warning text-center" role="alert">
                Contact us
            </div>

            <form action="{{ route('contacts.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-sm">
                        <input
                            type="text"
                            class="form-control"
                            name="name"
                            placeholder="Name"
                            value="{{ old('name') }}"
                            required
                            minlength="3"
                        >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm">
                        <input
                            type="email"
                            class="form-control"
                            name="email"
                            placeholder="Email"
                            value="{{ old('email') }}"
                            required
                        >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm">
                        <textarea
                            class="form-control"
                            name="message"
                            placeholder="Message"
                            rows="4"
                            required
                        >{{ old('message') }}</textarea>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>


    </div>
    <script>
        $(document).ready(function() {
            setCurrentDateTimeById('visit_date');
        });
    </script>
@endsection
