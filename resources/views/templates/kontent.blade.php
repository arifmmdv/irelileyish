@extends('layouts.web')

@section('content')
<div class="page-header">
    <div class="container narrow">
        <div class="titleWrapper">
            <h1>{{$page->title}}</h1>
            @if($fields['page_title'])
            <p>{{$fields['page_title']}}</p>
            @endif
        </div>
    </div>
    <div class="container">
        <div class="meta">
            <ul class="breadcrumbs">
                <li><a href="#">Ana Səhifə</a></li>
                <li><a href="#">Haqqımızda</a></li>
                <li><a href="#">İrəliləyiş nədir?</a></li>
            </ul>

            <div class="date">
                <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1 6H13V13C13 13.5523 12.5523 14 12 14H2C1.44772 14 1 13.5523 1 13V6Z" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1 6H13V4C13 3.44772 12.5523 3 12 3H2C1.44772 3 1 3.44772 1 4V6Z" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10.2002 3V1" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4 3V1" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>24 Fevral 2023</span>
            </div>
        </div>
    </div>
</div>

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

<div class="container">
    <div class="row">
        <div class="col col-3">
            <div class="card">
                <div class="card-image">
                    <img src="/images/news.jpg" alt="">
                    <div class="card-hover">
                        <svg width="30" height="31" viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.75 24.125C19.2728 24.125 23.75 19.6478 23.75 14.125C23.75 8.60215 19.2728 4.125 13.75 4.125C8.22715 4.125 3.75 8.60215 3.75 14.125C3.75 19.6478 8.22715 24.125 13.75 24.125Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M26.25 26.625L20.8125 21.1875" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="card-content">
                    <p class="card-title">"İrəliləyİş" layihəsinə start verildi</p>
                    <div class="card-meta"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection