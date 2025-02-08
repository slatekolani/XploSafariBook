@php
$flag = [
    'en' => 'england',
    'sw' => 'tz',
];
@endphp
<ul class="nav nav-pills">
    <li class="nav-item dropdown">
        <a class="nav-link" href="#" role="button" id="dropdownLanguage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{ url("img/blank.gif") }}" class="flag flag-{{ $flag[app()->getLocale()] }}" alt="{{ __('menu.language-picker.langs.' . app()->getLocale()) }}"> {{ __('menu.language-picker.langs.' . app()->getLocale()) }}
            <i class="fas fa-angle-down"></i>
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownLanguage" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
            @foreach (array_keys(config('locale.languages')) as $lang)
                <a class="dropdown-item" href="{{ url('lang/' . $lang) }}">
                    <img src="{{ url("img/blank.gif") }}" class="flag flag-{{ $flag[$lang] }}" alt="{{ __('menu.language-picker.langs.'.$lang) }}"> {{ __('menu.language-picker.langs.'.$lang) }}
                </a>
            @endforeach
        </div>
    </li>
</ul>
