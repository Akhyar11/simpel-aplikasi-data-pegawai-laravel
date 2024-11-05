@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Employee List</h1>
            <a href="{{ route('employees.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
              Add Employee
            </a>
        </div>

        <div class="overflow-x-auto">
            <table id="employees-table" class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-4 border-b border-gray-200 text-left">Id</th>
                        <th class="py-3 px-4 border-b border-gray-200 text-left">Name</th>
                        <th class="py-3 px-4 border-b border-gray-200 text-left">Position</th>
                        <th class="py-3 px-4 border-b border-gray-200 text-left">Join Date</th>
                        <th class="py-3 px-4 border-b border-gray-200 text-left">Salary</th>
                        <th class="py-3 px-4 border-b border-gray-200 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    <!-- Data will be populated by DataTables -->
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    $('#employees-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('employees.data') }}",
        columns: [
            {data: 'id', name: 'id', class: "font-bold text-center p-3"},
            {data: 'name', name: 'name', class: "p-3"},
            {data: 'position', name: 'position', class: "text-left p-3"},
            {data: 'join_date', name: 'join_date', class: "p-3"},
            {data: 'salary', name: 'salary', class: "p-3"},
            {data: 'action', name: 'action', orderable: false, searchable: false, class: "p-3"}
        ],
        responsive: true,
        autoWidth: false,
        language: {
            processing: "<div class='loader'></div>",
            search: "Search:",
            lengthMenu: "Display _MENU_ records per page",
            info: "Showing page _PAGE_ of _PAGES_",
            infoEmpty: "No records available",
            infoFiltered: "(filtered from _MAX_ total records)",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous"
            }
        }
    });
});
</script>
@endpush
@endsection