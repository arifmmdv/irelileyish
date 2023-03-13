@extends('layouts.web')

@section('content')
@include('components.page-header')

<div class="container">
    <div class="row">
        @foreach($page->children as $child)
            <div class="col col-3">
                <div class="card">
                    <a class="card-image size-1-1" href="#" target="_blank">
                        @if($child->getFirstMedia('main') != null)
                        <img src="{{$child->getFirstMediaUrl('main')}}" alt="{{$page->title}}">
                        @endif
                        <div class="card-hover">
                            <svg width="30" height="31" viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.75 24.125C19.2728 24.125 23.75 19.6478 23.75 14.125C23.75 8.60215 19.2728 4.125 13.75 4.125C8.22715 4.125 3.75 8.60215 3.75 14.125C3.75 19.6478 8.22715 24.125 13.75 24.125Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M26.25 26.625L20.8125 21.1875" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection