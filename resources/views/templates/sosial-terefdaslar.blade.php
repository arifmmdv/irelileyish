@extends('layouts.web')

@section('content')
@include('components.page-header')

<div class="container">
    <div class="row">
        @foreach($children as $child)
            <div class="col col-20">
                @include('components.card',[
                    'image' => $child['image'],
                    'title' => $child['title'],
                    'link' => $child['fields']['link'],
                    'icon' => 'link',
                    'size' => 's-100',
                    'showTitle' => false,
                    'external' => true,
                    'className' => ''
                ])
            </div>
        @endforeach
    </div>
</div>
@endsection