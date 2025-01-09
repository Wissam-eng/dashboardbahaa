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


        <div class="alert alert-warning text-center" role="alert">
            booking your date
        </div>

        <form action="{{ route('bookes.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-sm">
                    <input type="text" class="form-control" name="first_name" placeholder="First Name">
                </div>
                <div class="col-sm">
                    <input type="text" class="form-control" name="second_name" placeholder="Last Name">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm">
                    <input type="text" class="form-control" name="mobile" placeholder="Mobile">
                </div>
                <div class="col-sm">
                    <input type="text" class="form-control" name="address" placeholder="Address">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm">
                    <input type="datetime-local" class="form-control" name="visit_date" placeholder="Visit Date"
                        id="visit_date">
                </div>


                <div class="col-sm">
                    <textarea class="form-control" name="note" placeholder="Note"></textarea>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            setCurrentDateTimeById('visit_date');
        });
    </script>
@endsection
