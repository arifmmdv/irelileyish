@extends('layouts.web')

@section('content')
@include('components.page-header')

<div class="container">
    <div class="row">
        @foreach($children as $child)
            <div class="col col-3">
                @include('components.card', [
                    'title' => $child['title'],
                    'link' => $child['slug'],
                    'icon' => 'readMore',
                    'size' => 's-100',
                    'showTitle' => true,
                    'image' => $child['image'],
                    'external' => false,
                    'className' => ''
                ])
            </div>
        @endforeach
    </div>
</div>
@endsection