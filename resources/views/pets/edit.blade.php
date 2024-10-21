<!DOCTYPE html>
<html lang="en">
<head>
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
        <div class="w-full flex flex-col gap-12 justify-center">
            <h1 class="text-4xl font-bold text-gradient">Huisdier wijzigen: {{ $pet->name }}</h1>
            <form action="{{ route('pets.update', $pet->id) }}" method="POST" class="c-form rounded shadow-md p-8">
                @csrf
                @method('PUT')

                <div class="flex gap-4">
                    <label class="c-form-label" for="name">Naam huisdier:</label>
                    <input class="c-form-input__light" type="text" name="name" id="name" value="{{ $pet->name }}" required>
                </div>

                <div class="flex gap-4">
                    <label class="c-form-label" for="type">Soort huisdier:</label>
                    <input class="c-form-input__light" type="text" name="type" id="type" value="{{ $pet->type }}" required>
                </div>

                <button type="submit" class="c-btn c-btn-primary">Opslaan</button>
            </form>
        </div>
    </div>
</div>
