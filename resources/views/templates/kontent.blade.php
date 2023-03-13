@extends('layouts.web')

@section('content')
@include('components.page-header')

<div class="container narrow">
    @if($page->getFirstMedia('main') != null)
    <div class="page-image">
        <img src="/images/content.jpg" alt="">
    </div>
    @endif

    <div class="page-content">
        <div class="content">
            {!! html_entity_decode($page->getTranslation('content', app()->getLocale())) !!}
        </div>
    </div>
</div>

@endsection