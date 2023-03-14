@extends('layouts.web')

@section('content')
@include('components.page-header')

<div class="container narrow">
   <div class="row center">
    @foreach($page->children as $child)
        <div class="col col-6">
            <a class="listing" href="/{{$page->slug}}/{{$child->slug}}">
                <span>{{$child->title}}</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 12H19" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12 5L19 12L12 19" stroke="#184176" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
    @endforeach
   </div>
</div>

@endsection