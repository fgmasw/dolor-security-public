@extends('layouts.app')

@section('title', 'Guía en Vídeo')

@section('content')
<div class="container mt-3">
    <div class="text-center">
        <h1 class="display-4 mb-2">Guía en Vídeo</h1>
        <p class="lead">Aprende más con nuestro video tutorial</p>
    </div>

    <div class="video-container video-large mb-4">
        <iframe
            src="https://www.youtube.com/embed/L6QxvUqY01c?vq=hd1080"
            title="Guía en Video"
            frameborder="0"
            allowfullscreen>
        </iframe>
    </div>
</div>
@endsection
