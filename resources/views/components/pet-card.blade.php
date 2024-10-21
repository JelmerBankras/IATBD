<div class="flex flex-col rounded overflow-hidden bg-white shadow-md">
    <img class="object-cover object-center aspect-[5/3]" src="{{ asset( $image ) }}" alt="{{ $name }}"/>
    <div class="flex flex-col px-6 py-4">
        <div class="font-bold text-xl mb-2">{{ $name }}</div>
        <p class="text-gray-700 text-base">Leeftijd: {{ $age }}</p>
        <p class="text-gray-700 text-base">Soort: {{ $type }}</p>
        <p class="text-gray-700 text-base">Toegevoegd op: {{ $added }}</p>
        <p class="text-gray-700 text-base">Aangepast op: {{ $updated }}</p>
        <div class="flex flex-row gap-4 items-center my-4">
            <a href="{{ route('pets.edit', $id) }}" class="c-btn c-btn-primary">Edit</a>
            <form action="{{ route('pets.destroy', $id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this pet?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
