@extends('layouts.app')
@section('content')
<div class="container2 row">
    <!-- Left Side: Browser and Filters -->
    <div class="col-md-3 leftside animated fadeInLeft">
        <h3>Wyszukaj oferty</h3>
        <form id="filters" method="get">
            @csrf
            <div class="form-group">
                <label for="search">Szukaj:</label>
                <input type="text" class="form-control" id="search" name="search" value="{{Request::get('search')}}">
            </div>
            <div class="form-group">
                <label for="country">Kraj:</label>
                <select class="form-control" id="country" name="country">
                    <option value="">Wszystkie</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->country }}" 
                            @if($country->country == $ccountry)
                                selected
                            @endif>{{ $country->country }}</option>
                    @endforeach
                    {{-- <option value="Grecja">Grecja</option>
                    <option value="Włochy">Włochy</option>
                    <option value="Polska">Polska</option> --}}
                </select>
            </div>
            <div class="form-group">
                <label for="region">Region:</label>
                <select class="form-control" id="region" name="region">
                    <option value="">Wszystkie</option>
                    @foreach ($regions as $region)
                        <option value="{{ $region->region }}"
                            @if($region->region == $rregion)
                                selected
                            @endif>{{ $region->region }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="city">Miasto:</label>
                <select class="form-control" id="city" name="city">
                    <option value="">Wszystkie</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->city }}"
                            @if($city->city == $ccity)
                                selected
                            @endif>{{ $city->city }}</option>
                    @endforeach
                    {{-- <option value="Paryż">Paryż</option>
                    <option value="Rzym">Rzym</option>
                    <option value="Ateny">Ateny</option> --}}
                </select>
            </div>
            
            <div class="form-group">
                <label for="price">Zakres cenowy za osobę:</label>
                <input type="range" min="1" max="10000" step="100" class="form-control" id="price" name="price"
                @if($pprice != null)
                    value = "{{Request::get('price')}}"
                @else 
                    value = "1"
                @endif>
                
                @if($pprice!= null)
                    <span id="price-value">{{Request::get('price')}} - 10000 zł</span>
                    {{-- <span id="price-value">1 - {{Request::get('price')}} zł</span> --}}
                @else
                    <span id="price-value">1 - 10000 zł</span>
                @endif
                {{-- <select class="form-control" id="price">
                    <option value="">Wszystkie</option>
                    <option value="0-500">0zł - 500zł</option>
                    <option value="500-1000">500zł - 1000zł</option>
                    <option value="1000-2000">1000zł - 2000zł</option>
                    <option value="2500-5000">2500zł - 5000zł</option>
                    <option value="5000-7500">5000zł - 7500zł</option>
                    <option value="7500-10000">7500zł - 10000zł</option>
                    <option value="10000+">10000zł+</option>
                </select> --}}
            </div>
            <div class="form-group">
                <label for="persnum">Ilość osób:</label>
                <input type="range" min="1" max="10" step="1" class="form-control" id="persnum" name="persnum"
                @if($ppersnum != null)
                    value = "{{Request::get('persnum')}}"
                @else 
                    value = "1"
                @endif>
                
                @if($ppersnum != null)
                    <span id="persnum-value">{{Request::get('persnum')}} - 10 osób</span>
                @else
                    <span id="persnum-value">1 - 10 osób</span>
                @endif
                {{-- <select class="form-control" id="price">
                    <option value="">Wszystkie</option>
                    <option value="0-500">0zł - 500zł</option>
                    <option value="500-1000">500zł - 1000zł</option>
                    <option value="1000-2000">1000zł - 2000zł</option>
                    <option value="2500-5000">2500zł - 5000zł</option>
                    <option value="5000-7500">5000zł - 7500zł</option>
                    <option value="7500-10000">7500zł - 10000zł</option>
                    <option value="10000+">10000zł+</option>
                </select> --}}
            </div>
            <div class="form-group">
                <label for="startdate">Data początkowa:</label>
                <input type="date" class="form-control" id="startdate" name="startdate"
                @if(request()->lato == 1 || request()->latostart != null)
                    value='{{ $latostart }}'
                @endif>
            </div>
            <div class="form-group">
                <label for="enddate">Data końcowa:</label>
                <input type="date" class="form-control" id="enddate" name="enddate"
                @if(request()->lato == 1 || request()->latoend != null)
                    value='{{ $latoend }}'
                @endif>
            </div>
            <div class="form-check">
                <input
                @if(request()->promotion == 1)
                    checked
                @endif
                 type="checkbox" class="form-check-input" id="promotion" name="promotion" onchange="enableInput('promotion','promo')"
                 @if(request()->promotion)
                    checked
                 @endif>
                <label class="form-check-label" for="promotion">Promocja</label>
            </div>
            <div class="form-group">
                <label for="promo">% Promocji:</label>
                <input type="range" min="1" max="100" step="1"  class="form-control" id="promo" name="promo" 
                @if(request()->promotion != 1)
                    disabled value="0"
                @else
                    value = "{{Request::get('promo')}}"
                @endif>
                
                @if($ppromo != null)
                    <span id="promo-value">{{Request::get('promo')}} - 100 %</span>
                @else
                    <span id="promo-value">1 - 100 %</span>
                @endif
                {{-- <select class="form-control" id="promo" disabled>
                    <option value="">Wszystkie</option>
                    <option value="1-5%">1-15%</option>
                    <option value="15-25%">15-25%</option>
                    <option value="25-50%">25-50%</option>
                    <option value="50-75%">50-75%</option>
                    <option value="75%+">75%+</option>
                </select> --}}
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="lastminute" name="lastminute"
                @if(request()->lastminute)
                    checked
                @endif>
                
                <label class="form-check-label" for="lastminute">Last Minute</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="allinclusive" name="allinclusive"
                @if(request()->allinclusive)
                    checked
                @endif>
                <label class="form-check-label" for="allinclusive">All Inclusive</label>
            </div>
            <button type="submit" class="btn btn-primary">Szukaj</button>
        </form>
    </div>

    <!-- Middle: Offerts -->
    <div class="col-md-6 animated fadeInUp" id="offerts">
    @if(count($offerts) > 0)
        <h3>Oto nasze oferty</h3>
        <input id="order" value="{{request()->order}}" hidden></input>
        <p>Sortowanie: 
        <a href="#" data-sort="title" class="sort @if(request()->sort == "title") active @endif">Nazwa</a>
        <a href="#" data-sort="country" class="sort @if(request()->sort == "country") active @endif">Kraj</a>
        <a href="#" data-sort="region" class="sort @if(request()->sort == "region") active @endif">Region</a>
        <a href="#" data-sort="city" class="sort @if(request()->sort == "city") active @endif">Miasto</a>
        </p>
        @foreach($offerts as $offert)
            <div class="card mb-3" style="max-width: 940px;"
            data-country="{{ $offert->country }}" data-city="{{ $offert->city }}" data-region="{{ $offert->region }}" data-persnum="{{ $offert->persnum }}"
            @if($offert->promotion == true)
                data-price="{{ $offert->promotionprice }}"
            @else
                data-price="{{ $offert->price }}"
            @endif
            data-startdate="{{ $offert->startdateturnus }}" data-enddate="{{ $offert->enddateturnus }}" data-promo="{{ $offert->promo }}" 
            data-promotion="{{ $offert->promotion }}" data-lastminute="{{ $offert->lastminute }}" data-allinclusive="{{ $offert->allinclusive }}">
                <div class="row no-gutters">
                    <div class="col-md-5 photo">
                        <img src="{{ asset($offert->url) }}" class="card-img" id="{{ $offert->id }}" onclick="openModal({{ $offert->id }})" alt="{{ $offert->city }}">
                        {{-- <div id="myModal{{ $offert->id }}" class="modal">
                            <span class="close" id="close{{ $offert->id }}">&times;</span>
                            <img class="modal-content" id="img{{ $offert->id }}">
                        </div> --}}
                    </div>
                    <div class="col-md-4">
                        <div class="card-body5">
                            <h5 class="card-title tt">{{ $offert->title }}</h5>
                            <p class="card-text">
                                <small>
                                <div class="form-group row upperlinks">
                                    <a class="nav-link2" href="{{ route('offerts.index', ['ccountry' => $offert->country]) }}" id="country-link">{{ $offert->country }}</a>
                                        {{-- {{ $offert->country }} --}}
                                    /
                                    <a class="nav-link2" href="{{ route('offerts.index', ['rregion' => $offert->region]) }}" id="region-link">{{ $offert->region }}</a>
                                        {{-- {{ $offert->region }} --}}
                                    /
                                    <a class="nav-link2" href="{{ route('offerts.index', ['ccity' => $offert->city]) }}" id="city-link">{{ $offert->city }}</a>
                                        {{-- {{ $offert->city }} --}}
                                </div>
                                </small>
                            </p>
                            @if($offert->persnum == 1)
                                <p class="card-text">{{ $offert->persnum }} osoba</p>
                            @else
                                <p class="card-text">{{ $offert->persnum }} osoby</p>
                            @endif
                            @if($offert->lastminute == true)
                                <p class="card-text lastmin2"><i class="fas fa-clock"></i> Last minute</p>
                            @endif
                            <p class="card-text"><i class="far fa-calendar"></i> {{ $offert->startdateturnus }} - {{ $offert->enddateturnus }}<br>({{ $offert->nights}} noclegów)</p>
                            <p class="card-text">{{ $offert->description }}</p>
                        </div>
                    </div>
                    <div class="col-md-3 righbox2">
                            <div class="card-body4">
                            @if($offert->allinclusive == true)
                                <p class="card-text allin"><i class="fas fa-wine-glass"></i> All inclusive</p>
                            @endif
                            @if($offert->promotion == true && $offert->promotionprice != null)
                                <small><del>{{ $offert->price }} zł/os</del></small>
                                <div class="pricing2">
                                    {{ $offert->promotionprice }} <sup>zł/os</sup>
                                </div> 
                            @else
                                Cena: 
                                <div class="pricing2">
                                    {{ $offert->price }} <sup>zł/os</sup>
                                </div> 
                            @endif
                            <div class="buybutton">
                                <a href="{{ route('offerts.show',  $offert->offert_id) }}">
                                    <button class="btn2 btn-primary">Zobacz</button>
                                </a>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="row">{{ $offerts->links() }}</div>
        <div class="row">Pokazuję od {{$offerts->firstItem()}} do {{$offerts->lastItem()}} ofert z {{$offerts->total()}}</div>
        @else
            <p>Brak ofert spełniających podane kryteria.</p>
        @endif
    </div>

    <!-- Right Side: Ad -->
    <div class="col-md-3 animated fadeInRight">
        <h3>Aktualności</h3>
        <div class="card mb-3" style="max-width: 300px;">
            <img src="img/reklama1.webp" class="card-img-top" alt="Ad">
            <div class="card-body">
                <h5 class="card-title">Tańsze loty</h5>
                <p class="card-text">Zrelaksuj się i nie czekaj już dłużej, bo nadszedł czas na tańsze loty!</p>
                <a href="#" class="btn btn-primary">Dowiedz się więcej</a>
            </div>
        </div>
        <div class="card mb-3" style="max-width: 300px;">
            <img src="img/smak-wakacji-logo1.svg" class="card-img-top" alt="Ad">
            <div class="card-body">
                <h5 class="card-title">Nowy rozdział</h5>
                <p class="card-text">Nowe otwarcie naszego biura w Warszawie.</p>
                <a href="#" class="btn btn-primary">Dowiedz się więcej</a>
            </div>
        </div>
        <div class="card mb-3" style="max-width: 300px;">
            <img src="img/smak-wakacji-logo3.svg" class="card-img-top" alt="Ad">
            <div class="card-body">
                <h5 class="card-title">Tańsze loty</h5>
                <p class="card-text">Już dziś razem z nami poczuj Smak Wakacji.</p>
                <a href="#" class="btn btn-primary">Dowiedz się więcej</a>
            </div>
        </div>
    </div>
</div>
{{-- <script>
// var promotion = '{{ request()->promotion }}';
// var lastminute = '{{ request()->lastminute }}';
// var allinclusive = '{{ request()->allinclusive }}';
// var latostart = '{{ $latostart }}';
// var latoend = '{{ $latoend }}';
// var lato = '{{ request()->lato }}';
// var ccountry = '{{ request()->ccountry }}';
// var ccity = '{{ request()->ccity }}';
// var rregion = '{{ request()->rregion }}';
// var ppersnum = '{{Request::get('persnum')}}';
// var ppersnum = '{{ request()->persnum }}';
// var ppromo = '{{ request()->ppromo }}';
</script> --}}
<script src="{{asset('/js/listoffert.js')}}"></script>
@endsection