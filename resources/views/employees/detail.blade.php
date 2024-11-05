@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Employee Detail</h1>

        <div class="mb-4">
            <strong>Name:</strong> {{ $employee->name }}
        </div>
        <div class="mb-4">
            <strong>Position:</strong> {{ $employee->position }}
        </div>
        <div class="mb-4">
            <strong>Join Date:</strong> {{ \Carbon\Carbon::parse($employee->join_date)->format('d M Y') }}
        </div>
        <div class="mb-4">
            <strong>Salary:</strong> ${{ number_format($employee->salary, 2) }}
        </div>
        @if($employee->photo)
            <div class="mb-4">
                <strong>Photo:</strong><br>
                <img src="{{ asset('photos/' . $employee->photo) }}" alt="Employee Photo" class="w-32 h-32 object-cover rounded">
            </div>
        @endif

        <a href="{{ route('employees.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
            Back to Employee List
        </a>
    </div>
</div>
@endsection