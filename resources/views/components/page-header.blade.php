@include('components.background')
<div class="page-header">
    <div class="container narrow">
        <div class="titleWrapper">
            <h1>{{$page->title}}</h1>
            @isset($fields['page_title'])
            <p>{!! $fields['page_title'] !!}</p>
            @endif
        </div>
    </div>
    <div class="container">
        <div class="meta">

            <ul class="breadcrumbs">
                <li>
                    <a href="/">
                        <span>Ana Səhifə</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </a>
                </li>
                @if($page->parent_id != 0)
                    @php
                        $slug = '/'.$page->parent->slug;
                        
                        if (isset($page->parent->parent->slug)) {
                            $slug = '/'.$page->parent->parent->slug.'/'.$page->parent->slug;
                        }
                    @endphp
                <li>
                    <a href="{{$slug}}">
                        <span>{{$page->parent->title}}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </a>
                </li>
                @endif
                <li>
                    <span>{{$page->title}}</span>
                </li>
            </ul>

            {{-- <div class="date">
                <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1 6H13V13C13 13.5523 12.5523 14 12 14H2C1.44772 14 1 13.5523 1 13V6Z" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1 6H13V4C13 3.44772 12.5523 3 12 3H2C1.44772 3 1 3.44772 1 4V6Z" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10.2002 3V1" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4 3V1" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>24 Fevral 2023</span>
            </div> --}}
        </div>
    </div>
</div>