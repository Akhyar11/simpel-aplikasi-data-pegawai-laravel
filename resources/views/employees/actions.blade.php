<div class="flex space-x-2">
    <a href="{{ route('employees.detail', $row->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
        Detail
    </a>
    <form action="{{ route('employees.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
            Delete
        </button>
    </form>
</div>