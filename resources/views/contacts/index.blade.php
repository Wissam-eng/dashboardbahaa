@extends('layouts.app')

@section('title', 'الصفحة الرئيسية')

@section('content')

<div class="alert alert-warning text-center" style="font-weight: bold;" role="alert">
    Contacts
</div>
    <table id="bookesTable" class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"> Name</th>
                <th scope="col">Email </th>
                <th scope="col">Message</th>
                <th scope="col">Contact Date</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $index => $contact)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->message }}</td>
                    <td>{{ $contact->created_at }}</td>

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
