@extends('layouts.web')

@section('content')
@include('components.page-header')

<div class="container">
    <div class="row">
        @foreach($page->children as $key => $child)
            <div class="col col-3">
                @include('components.card', [
                    'title' => $child->title,
                    'link' => $child->getFirstMediaUrl('images'),
                    'icon' => 'magnifier',
                    'size' => '',
                    'showTitle' => true,
                    'image' => $child->getFirstMediaUrl('images'),
                    'external' => false,
                    'className' => 'photos'.$key
                ])
            </div>
        @endforeach
    </div>
</div>

<script>
    @foreach($page->children as $key => $child)
        var lightboxVideo = GLightbox({
            selector: ".photos{{$key}}",
        });
        lightboxVideo.setElements([
            @foreach($child->getMedia('images') as $image)
            {
                'href': '{{$image->getUrl()}}',
                'type': 'image',
            },
            @endforeach
        ]);
    @endforeach
</script>
@endsection