@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Add New Employee</h1>

        <form id="employee-form" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm border-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm border-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Position</label>
                    <select name="position" class="select2 mt-1 block w-full rounded-md border-gray-300 shadow-sm border-2">
                        <option value="">Select Position</option>
                        <option value="Manager">Manager</option>
                        <option value="Developer">Developer</option>
                        <option value="Designer">Designer</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Join Date</label>
                    <input type="text" name="join_date" class="datepicker mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm border-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Salary</label>
                    <input type="number" name="salary" class="mt-1 block w-full p-2 rounded-md border-gray-300 shadow-sm border-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm border-2">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Address</label>
                <textarea name="address" rows="3" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm border-2"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Photo</label>
                <input type="file" name="photo" class="file-input">
            </div>

            <div class="flex justify-end space-x-4">
                <button type="button" onclick="window.history.back()" 
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Cancel
                </button>
                <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2({
        theme: 'bootstrap'
    });

    // Initialize Datepicker
    $('.datepicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: {
            format: 'YYYY-MM-DD'
        }
    });

    // Initialize File Input
    $('.file-input').fileinput({
        theme: 'fas',
        showUpload: false,
        showCaption: true,
        browseClass: "btn btn-primary",
        fileType: "any",
        previewFileIcon: "<i class='fa fa-king'></i>"
    });

    // Initialize Form Validation
    $('#employee-form').validate({
        rules: {
            name: 'required',
            email: {
                required: true,
                email: true
            },
            position: 'required',
            join_date: 'required',
            salary: {
                required: true,
                number: true,
                min: 0
            }
        },
        submitHandler: function(form) {
            var formData = new FormData(form);
            
            $.ajax({
                url: "{{ route('employees.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        }).then((result) => {
                            window.location.href = "{{ route('employees.index') }}";
                        });
                    }
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = '';
                    
                    $.each(errors, function(key, value) {
                        errorMessage += value[0] + '\n';
                    });

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage
                    });
                }
            });
        }
    });
});
</script>
@endpush
@endsection