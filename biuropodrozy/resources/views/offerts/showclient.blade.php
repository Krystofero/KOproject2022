@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header h3 text-center">{{ __('Podgląd oferty:') }} {{ $offert->title }}</div>
                <div class="form-group row upperlinks">
                    {{-- tutaj przekierowanie do filtrowania ofert z tym krajem --}}
                    <div class="col-md-4">
                        Kraj podróży: <a class="nav-link2" href="{{ route('offerts.index', ['ccountry' => $offert->country]) }}" id="country-link">{{ $offert->country }}</a>
                        {{-- {{ $offert->country }} --}}
                    </div>
                    {{-- tutaj przekierowanie --}}
                    <div class="col-md-4">
                        Region: <a class="nav-link2" href="{{ route('offerts.index', ['rregion' => $offert->region]) }}" id="region-link">{{ $offert->region }}</a>
                        {{-- {{ $offert->region }} --}}
                    </div>
                    {{-- tutaj przekierowanie --}}
                    <div class="col-md-4">
                        Miasto: <a class="nav-link2" href="{{ route('offerts.index', ['ccity' => $offert->city]) }}" id="city-link">{{ $offert->city }}</a>
                        {{-- {{ $offert->city }} --}}
                    </div> 
                </div>
                <div class="boxes">
                    <div class="leftbox">
                        @foreach($images as $image)
                            @if($image->is_main == true)
                                {{-- <div class="col-md-8"> --}}
                                    <img src="{{ asset($image->url) }}" class="mainimagelook" id="image{{ $image->id }}" alt="Zdjęcie główne" title="Zdjęcie główne">
                                {{-- </div> --}}
                                <div id="myModal{{ $image->id }}" class="modal">
                                    <span class="close" id="close{{ $image->id }}">&times;</span>
                                    <img class="modal-content" id="img{{ $image->id }}">
                                </div>
                            @endif
                        @endforeach

                    </div>

                    <div class="rightbox">
                        <div class="card2">
                            <div class="card-body2">
                                @if($offert->lastminute == true)
                                    <div class="pricing lastmin">
                                        <i class="fas fa-clock"></i>
                                        &nbspLAST MINUTE!
                                    </div> 
                                @endif
                                @if($offert->promotion == false)
                                    Cena: 
                                    <div class="pricing">
                                        {{ $offert->price }} <sup>zł/os</sup>
                                    </div> 
                                @else
                                    Cena: 
                                    <div class="pricing">
                                        <del>{{ $offert->price }} zł/os</del>
                                    </div>
                                @endif
                                @if($offert->promotion == true && $offert->promotionprice != null)
                                    <div class="pricing prom">
                                        PROMOCJA {{ $offert->promo }}%
                                    </div> 
                                    Cena promocyjna:
                                    <div class="pricing">
                                        {{ $offert->promotionprice }} <sup>zł/os</sup>
                                    </div> 
                                @endif
                                @if($offert->insuranceprice != null)
                                    Cena z dodatkowym ubezpieczeniem:
                                    <div class="pricing">
                                        {{ $offert->insuranceprice }} <sup>zł/os</sup>
                                    </div> 
                                @endif
                                <div>
                                    <i class="fas fa-calendar"></i>
                                    Termin:<br>
                                    {{ $offert->startdateturnus }} - {{ $offert->enddateturnus }}
                                </div> 
                                <div>
                                    <i class="fas fa-moon"></i>
                                    ({{ $offert->nights}} noclegów)
                                </div> 
                                <div class="persons"> Osoby:
                                @if($offert->persnum == 1)
                                    {{ $offert->persnum }} osoba
                                @else
                                    {{ $offert->persnum }} osoby
                                @endif
                                </div>
                                @if($offert->allinclusive == true)
                                    <div class="allin">
                                        <i class="fas fa-wine-glass"></i>
                                        All inclusive
                                    </div>
                                @endif

                                <div class="buybutton">
                                    {{-- <form action="{{ route('offerts.buy') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="offert_id" value="{{ $offert->id }}">
                                        <button type="submit" class="btn2 btn-primary">Kup teraz</button>
                                    </form> --}}
                                    {{-- <a href="{{ route('offerts.buy',  $offert->id) }}"> --}}
                                    {{-- <a href="{{ route('offerts.buy', ['id' => $offert->id]) }}">
                                        <button class="btn2 btn-primary">Kup teraz</button>
                                    </a> --}}
                                    <form action="{{ route('offerts.buy', ['id' => $offert->id]) }}" method="GET">
                                        <button type="submit" class="btn2 btn-primary">Kup teraz</button>
                                    </form>
                                </div> 
                                
                                {{-- <div class="buybutton">
                                    <button class="btn2 btn-primary">Kup teraz</button>
                                </div>  --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body3">
                    @if($offert->description != null)
                        <div>
                            <div class="card-header"><h5><i class="fas fa-book"></i> Opis</h5></div>
                            <p>{{ $offert->description }}</p>
                        </div>
                    @endif
                    @if($offert->allinclusive == true && $offert->allindescription != null)
                        <div>
                            <div class="card-header"><h5><i class="fas fa-coins"></i> All inclusive</h5></div>
                            <p>{{ $offert->allindescription }}</p>
                        </div>
                    @endif
                    @if($offert->placedescription != null)
                        <div>
                            <div class="card-header"><h5><i class="fas fa-globe"></i> Położenie</h5></div>
                            <p>{{ $offert->placedescription }}</p>
                        </div>
                    @endif
                    @if($offert->pricedescription != null)
                        <div>
                            <div class="card-header"><h5><i class="fas fa-money-bill"></i> W cenie</h5></div>
                            <p>{{ $offert->pricedescription }}
                        </div>
                    @endif
                    @if($offert->hoteldescription != null)
                        <div>
                            <div class="card-header"><h5><i class="fas fa-hotel"></i> Hotel</h5></div>
                            <p>{{ $offert->hoteldescription }}</p>
                        </div>
                    @endif
                    @if($offert->roomsdescription != null)
                        <div>
                            <div class="card-header"><h5><i class="fas fa-door-closed"></i> Pokoje</h5></div>
                            <p>{{ $offert->roomsdescription }}</p>
                        </div>
                    @endif
                    @if($offert->disdescription != null)
                        <div>
                            <div class="card-header"><h5><i class="fas fa-hospital"></i> Udogodnienia dla osób niepełnosprawnych</h5></div>
                            <p>{{ $offert->disdescription }}</p>
                        </div>
                    @endif
                    <div>
                        <div class="card-header"><h5><i class="fas fa-phone"></i> Kontakt</div>
                        <p>{{ $offert->htel }} , {{ $offert->hemail }}</p>
                    </div>
                    @if($images->count() > 2)
                        <br>
                        <div class="form-group row">
                            <ul class="photos">
                                @foreach($images as $image)
                                    @if($image->is_main == false)
                                        <li class="tile">
                                                <img src="{{ asset($image->url) }}" id="{{ $image->id }}" onclick="openModal({{ $image->id }})" class="image" alt="zdjęcie" title="zdjęcie" loading="lazy">
                                                <div id="myModal{{ $image->id }}" class="modal">
                                                    <span class="close" id="close{{ $image->id }}">&times;</span>
                                                    <img class="modal-content" id="img{{ $image->id }}">
                                                </div>
                                        </li>
                                    @endif
                                @endforeach
                                <li></li>
                            </ul>
                        </div>
                    @elseif(($images->count() == 2))
                        <br>
                        @foreach($images as $image)
                            @if($image->is_main == false)
                                <div class="form-group row">
                                    <img src="{{ asset($image->url) }}" class="image2" id="{{ $image->id }}" onclick="openModal({{ $image->id }})" alt="Zdjęcie poboczne" title="Zdjęcie poboczne" loading="lazy">
                                    <div id="myModal{{ $image->id }}" class="modal">
                                        <span class="close" id="close{{ $image->id }}">&times;</span>
                                        <img class="modal-content" id="img{{ $image->id }}">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>

                    <div class="form-group row mb-0 text-center">
                        <div class="col-md-6">
                            <a href="{{ url()->previous() }}" class="btn btn-danger">
                                <i class="fas fa-arrow-left"></i>{{ __(' Powrót') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('/js/showoffert.js')}}"></script>
@endsection