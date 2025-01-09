@extends('layouts.app')

@section('title', 'الصفحة الرئيسية')

@section('content')




<div class="alert alert-warning text-center" style="font-weight: bold;" role="alert">
    Bookes
</div>



    <table id="bookesTable" class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Second Name</th>
                <th scope="col">Mobile</th>
                <th scope="col">Address</th>
                <th scope="col">Visit Date</th>
                <th scope="col">Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookes as $index => $booke)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $booke->first_name }}</td>
                    <td>{{ $booke->second_name }}</td>
                    <td>{{ $booke->mobile }}</td>
                    <td>{{ $booke->address }}</td>
                    <td>{{ $booke->visit_date }}</td>
                    <td>{{ $booke->note }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Initialize DataTable -->
    <script>
        $(document).ready(function() {
            $('#bookesTable').DataTable();
        });

        $('#bookesTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            order: [[0, 'desc']],
            
        });
    </script>
@endsection
