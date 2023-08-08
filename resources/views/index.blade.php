<!DOCTYPE html>
<html dir="ltr" lang="{{app()->getLocale()}}">

<head>
    {{ Vite::useBuildDirectory('/frontend') }}
    <meta charset="utf-8" />
    <title>{{$site->name}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Welcome!" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-title" content="Ionic PWA" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta http-equiv="x-ua-compatible" content="IE=Edge" />

    
    @vite(['resources/assets/sass/front.scss','resources/assets/js/front.js'])
    @livewireStyles
</head>

<body>
    <div class="site">
        <header class="header">
            <div class="header-top">
                <div class="header-top-wrap">
                    <div class="header-catalog-mobile">
                        <button class="header-catalog-btn btn-menu--js">
                            <span class="header-catalog-btn-icon">
                                <img onclick="openMenu();" class="logo" src="/images/icons/icon-burger-catalog.svg" alt="menu">
                            </span>
                        </button>
                    </div>
                    <div class="header-logo">
                        <div class="header-logo-item">
                            <a href="#">
                                <img class="logo" src="{{$site->logo}}">
                            </a>
                        </div>
                    </div>
                    <div class="header-menu">
                        <div class="header-menu-nav">
                            <ul class="nav-ul">
                                <li class="nav-li">
                                    <a class="nav-link" href="{{$site->google_map_link}}">
                                        {!!$site->address!!}
                                    </a>
                                </li>
                                <li class="nav-li">
                                    <a class="nav-link" href="tel:{{$site->phone}}">
                                        {{$site->phone}}
                                        <div>{{__('phones.cooperation')}}</div>
                                    </a>
                                </li>
                                <li class="nav-li">
                                    <a class="nav-link" href="tel:{{$site->phone_driver}}">
                                        {{$site->phone_driver}}
                                        <div>{{__('phones.drivers')}}</div>
                                    </a>
                                </li>
                                <li class="nav-li">
                                    <a class="nav-link" href="mailto:{{$site->email}}">{{$site->email}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="header-right">
                        <div class="header-lang">
                            @foreach($langs as $lang)
                            <a href="{{localized_route('home', [], $lang->code)}}" @class([ 'active'=> App::getLocale()
                                !== $lang->code,'header-lang-item'])>
                                {{Str::upper($lang->name)}}
                            </a>
                            @if ($loop->odd)
                            <span class="delim"></span>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div id="menu" class="header-mobile header-mobile--js">
                <div class="header-mobile-wrap">
                    <div class="header-mobile-top">
                        <div class="header-mobile-lang">
                            @foreach($langs as $lang)
                                <a href="{{localized_route('home', [], $lang->code)}}" @class([ 'active'=> App::getLocale()
                                    !== $lang->code,'header-lang-item'])>
                                    {{Str::upper($lang->name)}}
                                </a>
                                @if ($loop->odd)
                                <span class="delim"></span>
                                @endif
                            @endforeach
                        </div>
                        <div class="header-mobile-close">
                            <button class="btn-sub-catalog btn-sub-catalog--js">
                                <span class="btn-sub-catalog-icon">
                                    <img onclick="closeMenu();" class="img" src="/images/icons/icon-close.svg" alt="">
                                </span>
                            </button>
                        </div>
                    </div>

                    <div class="header-mobile-catalog" style="padding-left: 10px; padding-top: 15px;">
                        <div class="header-mobile-phones-content">
                            <div class="header-mobile-phones-item">
                                <a class="header-mobile-phones-link" href="{{$site->google_map_link}}">
                                    {!!$site->address!!}
                                </a>
                            </div>
                            <div class="header-mobile-phones-item">
                                <a class="header-mobile-phones-link" href="tel:{{$site->phone}}">{{$site->phone}}
                                    <div>{{__('phones.cooperation')}}</div>
                                </a>
                            </div>
                            <div class="header-mobile-phones-item">
                                <a class="header-mobile-phones-link"
                                    href="tel:{{$site->phone_driver}}">{{$site->phone_driver}}
                                    <div>{{__('phones.drivers')}}</div>
                                </a>
                            </div>
                            <div class="header-mobile-phones-item">
                                <a class="header-mobile-phones-link" href="mailto:{{$site->email}}">{{$site->email}}
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <livewire:search />
        </header>
        <div class="p-home p-page">
            <div id="video" class="vcontent">
                <livewire:cars />
                <video loop autoplay muted>
                    <source src="{{$site->video}}" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</body>
@livewireScripts
<script>


function openMenu() {
   const menu = document.getElementById('menu');
   menu.classList.add('open');
    const videoBlock = document.getElementById('video');
    videoBlock.style.cssText = 'display:none;';
}

function closeMenu() {
    const menu = document.getElementById('menu');
    menu.classList.remove('open');

    const videoBlock = document.getElementById('video');
    videoBlock.style.cssText = '';
}

</script>
</html>
