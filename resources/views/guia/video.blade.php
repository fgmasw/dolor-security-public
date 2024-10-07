@extends('layouts.app')

@section('title', 'Guía en Vídeo')

@section('content')
<div class="container mx-auto mt-6">
    <div class="text-center">
        <h1 class="text-4xl font-bold mb-4">Guía en Vídeo</h1>
        <p class="text-lg text-gray-600">Aprende más con nuestro video tutorial</p>
    </div>

    <div class="w-full max-w-4xl mx-auto mt-6">
        <div class="relative" style="padding-bottom: 56.25%; height: 0;">
            <iframe
                class="absolute top-0 left-0 w-full h-full"
                src="https://www.youtube.com/embed/L6QxvUqY01c?vq=hd1080"
                title="Guía en Video"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>
    </div>
</div>
@endsection
