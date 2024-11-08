<!DOCTYPE html>
<html lang="en">
<head>
    <title>IATBD</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    @vite('resources/sass/app.scss')
</head>

@include('sections.header')

<div class="o-container">
    <div class="my-16">
        <h1 class="text-xl text-black">Welcome, {{ auth()->user()->name }}</h1>
            <h1 class="text-xl text-gradient">Jouw aanvragen</h1>
            <div class="grid grid-cols-3 gap-8">
                @foreach($ownerRequests as $request)
                    <div class="flex flex-col p-6 shadow-md">
                        <p class="text-xl text-gradient">{{ $request->pet->name }}</p>
                        <p>door</p>
                        <p class="underline">{{ $request->sitter->name }}</p>
                        <div class="flex flex-row gap-2 my-2">
                            @if($request->status === 'pending')
                                <form action="{{ route('requests.update', $request->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="accepted">
                                    <button type="submit" class="c-btn c-btn-success c-btn-small">Accepteren</button>
                                </form>

                                <form action="{{ route('requests.update', $request->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="c-btn c-btn-danger c-btn-small">Weigeren</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        <div class="my-8">
            @if(auth()->user()->role == 'owner')
                @if($pets->isEmpty())
                    <h1 class="text-5xl font-bold text-gradient h-16">Je hebt nog geen huisdieren toegevoegd</h1>
                @else
                    <h1 class="text-5xl font-bold text-gradient">Jouw huisdieren</h1>
                    <div class="grid grid-cols-3 gap-4 my-16">
                        @foreach($pets as $pet)
                            <x-pet-card
                                id="{{ $pet->id }}"
                                image="{{ $pet->image }}"
                                name="{{ $pet->name }}"
                                age="{{ $pet->age }}"
                                type="{{ $pet->species }}"
                                startdate="{{ $pet->start_date }}"
                                enddate="{{ $pet->end_date }}"
                                hourlyrate="{{ $pet->hourly_rate }}"
                                userid="{{ $pet->user_id }}"
                            />
                        @endforeach
                    </div>
                @endif
            @else
                @if($houseImages->isEmpty())
                    <h1 class="text-5xl font-bold text-gradient h-16">Je hebt nog geen huisfoto's toegevoegd</h1>
                @else
                    <h1 class="text-5xl font-bold text-gradient">Jouw huisfoto's</h1>
                    <div class="grid grid-cols-3 gap-4 my-16">
                        @foreach($houseImages as $image)
                            <img class="aspect-square w-full h-full" src="{{ $image->image_path }}" alt="">
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
        @if( auth()->user()->role == 'owner')
            <div class="my-8">
                @if($ownerRequests)
                    <div class="p-8 bg-gray-100">
                        <h2 class="text-xl text-gradient">Laat een review achter</h2>
                        <form action="{{ route('reviews.store', $sitterId) }}" method="POST" class="flex flex-col gap-4">
                            @csrf
                            <label for="rating">Rating( 1-5 ):</label>
                            <input type="number" name="rating" min="1" max="5" class="border border-1 border-gray-300" required>
                            <label for="comment">Comment:</label>
                            <textarea name="comment" class="border border-1 border-gray-300 max-h-[300px] h-full"></textarea>
                            <button class="c-btn c-btn-primary" type="submit">Submit Review</button>
                        </form>
                    </div>
                @endif
            </div>
        @endif
        @if((auth()->user()->role == 'sitter'))
            <div class="my-8">
                @if($reviews && $reviews->count() > 0)
                    <h2 class="text-2xl text-gradient pb-4">Reviews:</h2>
                    <div class="grid grid-cols-4 gap-4">
                        @foreach($reviews as $review)
                            <div class="flex flex-col gap-4 p-4 shadow-md bg-blue-200 rounded-md">
                                <p><strong>Rating:</strong> {{ $review->rating }}/5</p>
                                <p><strong>Comment:</strong> {{ $review->comment }}</p>
                                @php
                                    $owner = App\Models\User::find($review->owner_id);
                                @endphp
                                <p><strong>From:</strong> {{ $owner->name }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>No reviews available yet.</p>
                @endif
            </div>
        @endif
    </div>
</div>
