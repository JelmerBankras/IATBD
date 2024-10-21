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
        <div class="my-8">
            @if(auth()->user()->role == 'owner')
                @if($pets->isEmpty())
                    <h1 class="text-5xl font-bold text-gradient h-16">Je hebt nog geen huisdieren toegevoegd</h1>
                @else
                    <h1 class="text-5xl font-bold text-gradient">Jouw huisdieren</h1>
                    <div class="grid grid-cols-3 gap-4 my-16">
                        @foreach($pets as $pet)
                            <x-pet-card id="{{ $pet->id }}" image="{{ $pet->image }}" name="{{ $pet->name }}" age="{{ $pet->age }}" type="{{ $pet->species }}" added="{{ $pet->created_at->format('d F, H:i:s') }}" updated="{{ $pet->updated_at->format('d F, H:i:s') }}" />
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
    </div>
</div>
