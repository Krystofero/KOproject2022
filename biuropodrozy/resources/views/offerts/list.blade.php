@extends('layouts.app')

@section('content')
<div class="container2 row">
    <!-- Left Side: Browser and Filters -->
    <div class="col-md-3 leftside animated fadeInLeft">
        <h3>Wyszukaj oferty</h3>
        <form id="filters">
            <div class="form-group">
                <label for="search">Szukaj:</label>
                <input type="text" class="form-control" id="search">
            </div>
            <div class="form-group">
                <label for="country">Kraj:</label>
                <select class="form-control" id="country">
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
                <select class="form-control" id="region">
                    <option value="">Wszystkie</option>
                    @foreach ($regions as $region)
                        <option value="{{ $region->region }}">{{ $region->region }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="city">Miasto:</label>
                <select class="form-control" id="city">
                    <option value="">Wszystkie</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->city }}">{{ $city->city }}</option>
                    @endforeach
                    {{-- <option value="Paryż">Paryż</option>
                    <option value="Rzym">Rzym</option>
                    <option value="Ateny">Ateny</option> --}}
                </select>
            </div>
            
            <div class="form-group">
                <label for="price">Zakres cenowy za osobę:</label>
                <input type="range" min="0" max="10000" step="100" value="0" class="form-control" id="price">
                <span id="price-value">0 - 10000 zł</span>
                </input>
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
                <input type="range" min="0" max="10" step="1" value="0" class="form-control" id="persnum">
                <span id="persnum-value">0 - 10 osób</span>
                </input>
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
                <input type="date" class="form-control" id="startdate"
                @if(request()->lato == 1)
                    value='{{ $latostart }}'
                @endif>
            </div>
            <div class="form-group">
                <label for="enddate">Data końcowa:</label>
                <input type="date" class="form-control" id="enddate"
                @if(request()->lato == 1)
                    value='{{ $latoend }}'
                @endif>
            </div>
            <div class="form-check">
                <input
                @if(request()->promotion == 1)
                    checked
                @endif
                 type="checkbox" class="form-check-input" id="promotion" value="promotion" onchange="enableInput('promotion','promo')">
                <label class="form-check-label" for="promotion">Promocja</label>
            </div>
            <div class="form-group">
                <label for="promo">% Promocji:</label>
                <input type="range" min="0" max="100" step="1" value="0" class="form-control" id="promo" 
                @if(request()->promotion != 1)
                    disabled
                @endif>
                <span id="promo-value">0 - 100 %</span>
                </input>
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
                <input type="checkbox" class="form-check-input" id="lastminute" value="lastminute">
                <label class="form-check-label" for="lastminute"
                @if(request()->promotion != 1)
                    disabled
                @endif>Last Minute</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="allinclusive" value="allinclusive">
                <label class="form-check-label" for="allinclusive"
                @if(request()->allinclusive != 1)
                    disabled
                @endif>All Inclusive</label>
            </div>
            {{-- <button type="submit" class="btn btn-primary">Filtruj</button> --}}
        </form>
    </div>

    <!-- Middle: Offerts -->
    <div class="col-md-6 animated fadeInUp" id="offerts">
        <h3>Oto nasze oferty</h3>
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
                        <div id="myModal{{ $offert->id }}" class="modal">
                            <span class="close" id="close{{ $offert->id }}">&times;</span>
                            <img class="modal-content" id="img{{ $offert->id }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body5">
                            <h5 class="card-title tt">{{ $offert->title }}</h5>
                            <p class="card-text"><small>
                                <div class="form-group row upperlinks">
                                    {{-- tutaj przekierowanie do filtrowania ofert z tym krajem --}}
                                    <a class="nav-link2" href="{{ route('offerts.index', ['ccountry' => $offert->country]) }}" id="country-link">{{ $offert->country }}</a>
                                        {{-- {{ $offert->country }} --}}
                                    /
                                    {{-- tutaj przekierowanie --}}
                                        {{ $offert->region }}
                                    /
                                    {{-- tutaj przekierowanie --}}
                                        {{ $offert->city }}
                                </div>
                            </small></p>
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

    



    {{-- <div class="card">
        <div class="row" id="titlerow">
            <div class="col-6 text-white">
                <h1><i class="fas fa-users"></i> {{ __('Zarządzanie ofertami') }}</h1>
            </div>
        </div>
        <table class="text-white display responsive nowrap" id="myTable" style="width:100%">
            <thead>
            <tr>
                <th scope="col">Nazwa</th>
                <th scope="col">Państwo</th>
                <th scope="col">Data początkowa turnusu</th>
                <th scope="col">Data końcowa turnusu</th>
                <th scope="col">Cena</th>
                <th scope="col">Data początkowa trwania oferty</th>
                <th scope="col">Data końcowa trwania oferty</th>
                <th scope="col">Status</th>
                <th scope="col">Akcje</th>
            </tr>
            </thead>
            <tbody class="text-dark">
            @foreach($offerts as $offert)
                <tr>
                    <th scope="row">{{ $offert->title }}</th>
                    <td>{{ $offert->country }}</td>
                    <td>{{ $offert->startdateturnus }}</td>
                    <td>{{ $offert->enddateturnus }}</td>
                    <td>{{ $offert->price }} zł</td>
                    <td>{{ $offert->startdate }}</td>
                    <td>{{ $offert->enddate }}</td>
                    @if($offert->startdate > now()) 
                        <td>Nie rozpoczęto</td>
                    @elseif ($offert->enddate < now())
                        <td>Zakończono</td>
                    @else
                        <td>W trakcie</td>
                    @endif
                    <td class="text-center">
                        <a href="{{ route('offertsModerator.show',  $offert->id) }}">
                            <button class="btn btn-info btn-sm" title="Podgląd oferty"><i class="fas fa-newspaper"></i></button>
                        </a>
                        <a href="{{ route('offertsModerator.edit', $offert->id) }}">
                            <button class="btn btn-success btn-sm" title="Edycja oferty"><i class="far fa-edit"></i></button>
                        </a>
                        <button class="btn btn-danger btn-sm delete" title="Usunięcie oferty" onclick="usunOferte({{ $offert->id }})" data-id="{{ $offert->id }}">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="form-group row mt-2 mb-2 text-center">
            <div class="col-md-3">
                <a href="{{ route('offertsModerator.create') }}">
                    <button class="border border-secondary btn btn-primary2" style="color: white;"><i class="far fa-edit"></i>Utwórz nową ofertę</button>
                </a>
            </div>
        </div>
    </div> --}}


    
</div>
<script>
var promotion = '{{ request()->promotion }}';
var lastminute = '{{ request()->lastminute }}';
var allinclusive = '{{ request()->allinclusive }}';
var latostart = '{{ $latostart }}';
var latoend = '{{ $latoend }}';
var lato = '{{ request()->lato }}';
var ccountry = '{{ request()->ccountry }}';
</script>
<script src="{{asset('/js/listoffert.js')}}"></script>
@endsection