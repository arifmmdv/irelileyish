@extends('layouts.web')

@section('content')
@include('components.page-header')

<div class="container narrow">
    @if($page->getFirstMedia('images') != null)
    <div class="page-image">
        <img src="{{$page->getFirstMediaUrl('images')}}" alt="{{$page->title}}">
    </div>
    @endif

    <div class="page-content">
        <div class="content">
            {!! html_entity_decode($page->getTranslation('content', app()->getLocale())) !!}
        </div>

    @if(count($page->getMedia('images')) > 1)
        <div class="gallery">
            <div class="row">
            @foreach($page->getMedia('images') as $key => $image)
            @if($key != 0)
                <div class="col col-2">
                    <a class="image" href="{{$image->getUrl()}}">
                        <img src="{{$image->getUrl()}}" alt="{{$page->title}}">
                    </a>
                </div>
            @endif
            @endforeach 
            </div>
        </div>
    @endif
    </div>
</div>

@if(count($page->getMedia('images')) > 1)
<script>
    var lightboxVideo = GLightbox({
        selector: '.image'
    });
</script>
@endif

@endsection