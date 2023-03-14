@extends('layouts.web')

@section('content')
@include('components.page-header')

<div class="container">
    <div class="row">
        @foreach($children as $child)
            <div class="col col-3">
                @include('components.card', [
                    'title' => $child['title'],
                    'link' => $child['fields']['video_link'],
                    'icon' => 'video',
                    'size' => 's-56',
                    'showTitle' => true,
                    'image' => $child['image'],
                    'external' => false,
                    'className' => 'glightboxVideo'
                ])
            </div>
        @endforeach
    </div>
</div>

<script>
    var lightboxVideo = GLightbox({
        selector: '.glightboxVideo'
    });
</script>
@endsection