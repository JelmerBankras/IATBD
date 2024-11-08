<div class="flex flex-col rounded overflow-hidden bg-white shadow-md">
    <img class="object-cover object-center aspect-[5/3]" src="{{ asset( $image ) }}" alt="{{ $name }}"/>
    <div class="flex flex-col justify-between h-full px-6 py-4">
        <div class="flex flex-col">
            <div class="font-bold text-xl mb-2">{{ $name }}</div>
            <p class="text-gray-700 text-base">Leeftijd: {{ $age }}</p>
            <p class="text-gray-700 text-base">Soort: {{ $type }}</p>
            @if($hourlyrate)
            <p class="text-base text-gray-700">Uurtarief: €{{ $hourlyrate }}</p>
            @endif
            @if($startdate && $enddate)
            <div class="flex flex-row gap-2">
                <p class="text-base text-gray-700">Beschikbaar van <p class="underline text-base text-gray-700">{{ $startdate }}</p> tot <p class="underline text-base text-gray-700">{{ $enddate }}</p></p>
            </div>
            @endif
        </div>
        @if(Auth::id() != $userid)
            <form action="{{ route('pets.requestSitting', $id) }}" method="POST">
                @csrf
                <button type="submit" class="c-btn c-btn-primary">Stuur Aanvraag</button>
            </form>
        @endif
        @if(auth()->check() && auth()->user()->id == $userid)
            <div class="flex flex-row gap-4 items-center my-4">
                <a href="{{ route('pets.edit', $id) }}" class="underline">Edit</a>
                <form action="{{ route('pets.destroy', $id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this pet?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-danger underline">Delete</button>
                </form>
            </div>
        @endif
    </div>
</div>
