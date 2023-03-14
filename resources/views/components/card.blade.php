<div class="card">
    <a 
        class="card-image {{$size}} {{$className}}"
        href="{{$link}}"
        @if($external) target="_blank" @endif
    >
        @isset($image)
            <img src="{{$image}}" alt="{{$title}}" />
        @endif
        <div class="card-hover">
            @if ($icon === 'magnifier')
                <svg width="30" height="31" viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.75 24.125C19.2728 24.125 23.75 19.6478 23.75 14.125C23.75 8.60215 19.2728 4.125 13.75 4.125C8.22715 4.125 3.75 8.60215 3.75 14.125C3.75 19.6478 8.22715 24.125 13.75 24.125Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M26.25 26.625L20.8125 21.1875" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            @elseif($icon === 'link') 
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link">
                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                </svg>
            @elseif($icon === 'video')
                <svg width="41" height="29" viewBox="0 0 41 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M39.8307 4.7131C39.3706 2.98093 38.0152 1.61672 36.2942 1.15376C33.1749 0.3125 20.6665 0.3125 20.6665 0.3125C20.6665 0.3125 8.15822 0.3125 5.03876 1.15376C3.31779 1.6168 1.96238 2.98093 1.50234 4.7131C0.666504 7.85277 0.666504 14.4034 0.666504 14.4034C0.666504 14.4034 0.666504 20.954 1.50234 24.0937C1.96238 25.8259 3.31779 27.1332 5.03876 27.5962C8.15822 28.4375 20.6665 28.4375 20.6665 28.4375C20.6665 28.4375 33.1748 28.4375 36.2942 27.5962C38.0152 27.1332 39.3706 25.8259 39.8307 24.0937C40.6665 20.954 40.6665 14.4034 40.6665 14.4034C40.6665 14.4034 40.6665 7.85277 39.8307 4.7131ZM16.5756 20.3509V8.45592L27.0301 14.4035L16.5756 20.3509Z" fill="white"/>
                </svg>
            @elseif($icon === 'readMore')
                <span>Ətraflı</span>
            @endif
        </div>
    </a>
    @if($showTitle)
    <div class="card-content">
        <a
            class="card-title"
            href="{{$link}}"
            @if($external) target="_blank" @endif
        >{{$title}}</a>
        <div class="card-meta"></div>
    </div>
    @endif
</div>