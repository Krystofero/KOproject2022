@extends('layouts.app')
{{-- @section('additives')
    <!-- Bigger Pictures -->
    @vite('BiggerPicture');
@endsection --}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @if(session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif

            <div class="card">
                <div class="card-header h4">Edycja oferty: {{ $offert->title }}</div>
                <p class="right">* - pole obowiązkowe</p>
                <div class="card-body">
                    <form method="POST" action="{{ route('offertsModerator.update', $offert->id) }}" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        @csrf

                        <div class="form-group">
                            <label for="title">Nazwa*</label>
                            <input name="title" id="title" class="form-control" value="{{$offert->title}}" type="text" aria-describedby="titleHelp" placeholder="Wprowadź tytuł" required autocomplete="title" autofocus>
                            <small id="titleHelp" class="form-text text-muted2">Nazwa oferty.</small>

                            @error('title')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror    
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8">
                                <label for="country">Kraj*</label>
                                <input name="country" id="title" class="form-control" value="{{$offert->country}}" type="text" aria-describedby="countryHelp" placeholder="Wprowadź kraj" required autocomplete="country" autofocus>
                                <small id="countryHelp" class="form-text text-muted2">Kraj oferty.</small>

                                @error('country')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror    
                            </div>
                            <div class="col-md-4">
                                <label for="price">Cena za osobę*</label>
                                <input name="price" id="price" class="form-control" onchange="calculateValue('promo','promotionprice')" value="{{$offert->price}}" type="number" min="0" step=".01" aria-describedby="priceHelp" placeholder="Wprowadź cenę" autocomplete="price" required autofocus>
                                <small id="priceHelp" class="form-text text-muted2">Cena oferty za osobę.</small>
    
                                @error('price')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror   
                            </div> 
                        </div>
                        <div class="form-group">
                            <label for="description">Krótki opis</label>
                            <textarea maxlength="500" name="description" id="description" class="form-control" value="{{$offert->description}}" type="text" aria-describedby="descriptionHelp" placeholder="Wprowadź krótki opis" autocomplete="description" autofocus>{{$offert->description}}</textarea>
                            <small id="descriptionHelp" class="form-text text-muted2">Krótki opis widoczny przy ofercie (max 500 znaków).</small>

                            @error('description')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror    
                        </div>
                        <div class="form-group row mb-0 ">
                            <div class="col-md-5">
                                <label for="startdateturnus">Data początkowa czasu trwania turnusu*</label>
                                <input name="startdateturnus" id="startdateturnus" class="form-control" value="{{$offert->startdateturnus}}" type="date" aria-describedby="startdateturnusHelp" placeholder="Wprowadź datę początkową turnusu" required autocomplete="startdateturnus" autofocus>
                                <small id="startdateturnusHelp" class="form-text text-muted2">Data określająca początek turnusu.</small>

                                @error('startdateturnus')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror    
                            </div>
                            <div class="col-md-5">
                                <label for="enddateturnus">Data końcowa czasu trwania turnusu*</label>
                                <input name="enddateturnus" id="enddateturnus" class="form-control" value="{{$offert->enddateturnus}}" type="date" aria-describedby="enddateturnusHelp" placeholder="Wprowadź datę końcową turnusu" required autocomplete="enddateturnus" autofocus>
                                <small id="enddateturnusHelp" class="form-text text-muted2">Data określająca koniec turnusu.</small>

                                @error('enddateturnus')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror  
                            </div>
                            <div class="col-md-2">
                                <label for="nights">Łącznie ilość nocy</label>
                                <input type="number" min="0" name="nights" class="form-control" id="nights" value="{{$offert->nights}}" aria-describedby="nightsHelp" autocomplete="nights" autofocus readonly>
                                <small id="nightsHelp" class="form-text text-muted2"></small>

                                @error('nights')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror  
                            </div>
                        </div>
                        <div class="form-group row mb-0 ">
                            <div class="col-md-6">
                                <label for="startdate">Data początkowa czasu trwania oferty*</label>
                                <input name="startdate" id="startdate" class="form-control" value="{{$offert->startdate}}" type="date" aria-describedby="startdateHelp" placeholder="Wprowadź datę początkową oferty" required autocomplete="startdate" autofocus>
                                <small id="startdateHelp" class="form-text text-muted2">Data określająca początek możliwości wyświetlania oferty.</small>

                                @error('startdate')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror    
                            </div>
                            <div class="col-md-6">
                                <label for="enddate">Data końcowa czasu trwania oferty*</label>
                                <input name="enddate" id="enddate" class="form-control" value="{{$offert->enddate}}" type="date" aria-describedby="enddateHelp" placeholder="Wprowadź datę końcową oferty" required autocomplete="enddate" autofocus>
                                <small id="enddateHelp" class="form-text text-muted2">Data określająca koniec możliwości wyświetlania oferty.</small>

                                @error('enddate')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror  
                            </div>
                        </div>
                        <div class="form-group row mb-0 ">
                            <div class="col-md-2">
                                <input type="checkbox" name="lastminute" class="bigcheckbox" id="lastminute" @if($offert->lastminute == true) checked @endif value="{{$offert->lastminute}}" aria-describedby="lastminuteHelp" autocomplete="lastminute" autofocus>
                                <label for="lastminute">Last minute</label>
                                <br>
                                <small id="lastminuteHelp" class="form-text text-muted2">Zaznacz jeżeli oferta ma pojawiać się w dziale "Last minute"</small>

                                @error('lastminute')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror    
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" name="promotion" class="bigcheckbox" id="promotion" @if($offert->promotion == true) checked @endif onchange="enableInput2('promotion', 'promo', 'promotionprice')" value="{{$offert->promotion}}" aria-describedby="promotionHelp" autocomplete="promotion" autofocus>
                                <label for="promotion">Promocja</label>
                                <br>
                                <small id="promotionHelp" class="form-text text-muted2">Zaznacz jeżeli oferta ma być w promocji</small>

                                @error('promotion')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror  
                            </div>
                            <div class="col-md-2">
                                <label for="promo">Promocja w %</label>
                                <input name="promo" id="promo" class="form-control" onchange="calculateValue('promo','promotionprice')" onkeyup=enforceMinMax(this) value="{{$offert->promo}}" type="number" min="0" max="99" step="1" aria-describedby="promoHelp" autocomplete="promo" disabled autofocus>
                                <small id="promoHelp" class="form-text text-muted2">Wprowadź ilość procentów promocji oferty (cena zostanie wyliczona automatycznie).</small>

                                @error('promo')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror 
                            </div>
                            <div class="col-md-3">
                                <label for="promotionprice">Cena promocyjna</label>
                                <input name="promotionprice" id="promotionprice" class="form-control" value="{{$offert->promotionprice}}" type="number" min="0" step=".01" aria-describedby="promotionpriceHelp" autocomplete="promotionprice" readonly autofocus>
                                <small id="promotionpriceHelp" class="form-text text-muted2">Wprowadź cenę promocyjną oferty.</small>

                                @error('promotionprice')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror  
                            </div>
                            <div class="col-md-3">
                                <label for="insuranceprice">Cena z dodatkowym ubezpieczeniem</label>
                                <input name="insuranceprice" id="insuranceprice" class="form-control" value="{{$offert->insuranceprice}}" type="number" min="0" step=".01" aria-describedby="insurancepriceHelp" autocomplete="insuranceprice" autofocus>
                                <small id="insurancepriceHelp" class="form-text text-muted2">Wprowadź cenę oferty z dodatkowym ubezpieczeniem.</small>

                                @error('insuranceprice')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror  
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                <label for="region">Region*</label>
                                <input name="region" id="region" class="form-control" value="{{$offert->region}}" type="text" aria-describedby="regionHelp" placeholder="Wprowadź region" required autocomplete="region" autofocus>
                                <small id="regionHelp" class="form-text text-muted2">Podaj region oferty (np. Wyspy Kanaryjskie)</small>

                                @error('region')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror    
                            </div>
                            <div class="col-md-6">
                                <label for="city">Miasto*</label>
                                <input name="city" id="city" class="form-control" value="{{$offert->city}}" type="text" aria-describedby="cityHelp" placeholder="Wprowadź miasto" required autocomplete="city" autofocus>
                                <small id="cityHelp" class="form-text text-muted2"></small>

                                @error('city')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror    
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-2">
                                <input type="checkbox" name="allinclusive" @if($offert->allinclusive == true) checked @endif onchange="enableInput('allinclusive','allindescription')" class="bigcheckbox" id="allinclusive" value="{{$offert->allinclusive}}" aria-describedby="allinclusiveHelp" autocomplete="allinclusive" autofocus>
                                <label for="allinclusive">All inclusive</label>
                                <br>
                                <small id="allinclusiveHelp" class="form-text text-muted2">Zaznacz jeżeli oferta jest "All inclusive"</small>

                                @error('allinclusive')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror    
                            </div>
                            <div class="col-md-10">
                                <label for="allindescription">Opis all inclusive</label>
                                <textarea maxlength="500" name="allindescription" id="allindescription" class="form-control" type="text" aria-describedby="allindescriptionHelp" placeholder="Wprowadź opis oferty all inclusive" autocomplete="allindescription" autofocus disabled>{{$offert->allindescription}}</textarea>
                                <small id="allindescriptionHelp" class="form-text text-muted2">(max 500 znaków)</small>

                                @error('allindescription')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror    
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                <label for="placedescription">Opis miejsca pobytu</label>
                                <textarea maxlength="500" name="placedescription" id="placedescription" class="form-control" type="text" aria-describedby="placedescriptionHelp" placeholder="Wprowadź opis miejsca pobytu" autocomplete="placedescription" autofocus>{{$offert->placedescription}}</textarea>
                                <small id="placedescriptionHelp" class="form-text text-muted2">(max 500 znaków)</small>

                                @error('placedescription')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror    
                            </div>
                            <div class="col-md-6">
                                <label for="pricedescription">W cenie</label>
                                <textarea maxlength="500" name="pricedescription" id="pricedescription" class="form-control" type="text" aria-describedby="pricedescriptionHelp" placeholder="Wprowadź co jest w cenie podróży" autocomplete="pricedescription" autofocus>{{$offert->pricedescription}}</textarea>
                                <small id="pricedescriptionHelp" class="form-text text-muted2">Wprowadź co wyświetlić w dziale "w cenie" (max 500 znaków)</small>

                                @error('pricedescription')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror    
                            </div>
                        </div>
                        <div class="form-group row mb-0 ">
                            <div class="col-md-2">
                                <label for="persnum">Ilość osób*</label>
                                <input type="number" min="0" name="persnum" class="form-control" id="persnum" value="{{$offert->persnum}}" aria-describedby="persnumHelp" autocomplete="persnum" autofocus required>
                                <small id="persnum" class="form-text text-muted2"></small>

                                @error('persnum')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror  
                            </div>
                            <div class="col-md-5">
                                <label for="hemail">Email hotelu*</label>
                                <input name="hemail" id="hemail" class="form-control" value="{{$offert->hemail}}" type="email" aria-describedby="hemailHelp" autocomplete="hemail" autofocus required>
                                <small id="hemailHelp" class="form-text text-muted2">Wprowadź email hotelu.</small>

                                @error('hemail')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror  
                            </div>
                            <div class="col-md-5">
                                <label for="htel">Telefon hotelu*</label>
                                <input name="htel" id="htel" class="form-control" value="{{$offert->htel}}" type="tel" maxlength="15" aria-describedby="htelHelp" autocomplete="htel" autofocus required>
                                <small id="htelHelp" class="form-text text-muted2">Wprowadź telefon hotelu.</small>

                                @error('htel')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror  
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                <label for="hoteldescription">Opis hotelu</label>
                                <textarea maxlength="500" name="hoteldescription" id="hoteldescription" class="form-control" type="text" aria-describedby="hoteldescriptionHelp" placeholder="Wprowadź opis hotelu" autocomplete="hoteldescription" autofocus>{{$offert->hoteldescription}}</textarea>
                                <small id="hoteldescriptionHelp" class="form-text text-muted2">(max 500 znaków)</small>

                                @error('hoteldescription')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror    
                            </div>
                            <div class="col-md-6">
                                <label for="roomsdescription">Opis zakwaterowania</label>
                                <textarea maxlength="500" name="roomsdescription" id="roomsdescription" class="form-control" type="text" aria-describedby="roomsdescriptionHelp" placeholder="Wprowadź opis zakwaterowania" autocomplete="roomsdescription" autofocus>{{$offert->roomsdescription}}</textarea>
                                <small id="roomsdescriptionHelp" class="form-text text-muted2">Opis wyglądu pokojów, np. ile łóżek (max 500 znaków)</small>

                                @error('roomsdescription')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror    
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-10">
                                <label for="disdescription">Opis przystosowania oferty do osób niepełnosprawnych</label>
                                <textarea maxlength="500" name="disdescription" id="disdescription" class="form-control" type="text" aria-describedby="disdescriptionHelp" placeholder="Wprowadź opis" autocomplete="disdescription" autofocus>{{$offert->disdescription}}</textarea>
                                <small id="disdescriptionHelp" class="form-text text-muted2">(max 500 znaków)</small>

                                @error('disdescription')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror    
                            </div>
                            <div class="col-md-2">
                                <label for="amount">Ilość ofert:</label>
                                <input type="number" min="0" max="10000" name="amount" class="form-control" id="amount" value="{{$offert->amount}}" aria-describedby="amountHelp" autocomplete="amount" autofocus required>
                                <small id="amountHelp" class="form-text text-muted2"></small>

                                @error('amount')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror    
                            </div>
                        </div>
                        <br>
                        @if($images->isEmpty())
                            <div class="form-group">
                                <p><strong>Brak zdjęć</strong></p>
                                <div class="col-md-2">
                                    <label for="image">Wybierz inne zdjęcie główne</label>
                                    <input type="file" name="image" id="image">
                                    @error('image')
                                        <small class="form-text text-danger">{{$message}}</small>
                                    @enderror  
                                </div>
                                <div class="col-md-2">
                                    <label for="images">Wybierz pozostałe zdjęcia</label>
                                    <input type="file" name="images[]" multiple>
                                    @error('images')
                                        <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div> 
                            </div>
                        @else
                            @foreach($images as $image)
                                @if($image->is_main == true)
                                    <div class="form-group mpc row">
                                            <label for="mainimage">Zdjęcie główne</label>
                                            <img src="{{ asset($image->url) }}" class="mainimage" id="mainimage" alt="Zdjęcie główne" title="Zdjęcie główne">
                                        <div class="col-md-2">
                                            <label for="image">Wybierz inne zdjęcie główne</label>
                                            <input type="file" name="image" id="image">
                                            <small id="imageHelp" class="form-text text-muted2">(jeśli pozostawisz puste stare zdjęcie pozostanie niezmienione)</small>
                                            @error('image')
                                                <small class="form-text text-danger">{{$message}}</small>
                                            @enderror  
                                        </div>
                                    </div>
                                    <div id="myModal{{ $image->id }}" class="modal">
                                        <span class="close" id="close{{ $image->id }}">&times;</span>
                                        <img class="modal-content" id="img{{ $image->id }}">
                                    </div>
                                @endif
                            @endforeach
                            @if($images->count() > 2)
                                <label for="gallery">Pozostałe zdjęcia</label>
                                <div class="form-group">
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
                                    <label for="images">Wybierz inne pozostałe zdjęcia</label>
                                    <input type="file" name="images[]" multiple>
                                    <small id="imagesHelp" class="form-text text-muted2">(jeśli pozostawisz puste stare zdjęcia pozostaną niezmienione)</small>
                                    @error('images')
                                        <small class="form-text text-danger">{{$message}}</small>
                                    @enderror 
                                </div>
                            @elseif(($images->count() == 1))
                                <br>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="images">Wybierz inne pozostałe zdjęcia</label>
                                        <input type="file" name="images[]" multiple>
                                        @error('images')
                                            <small class="form-text text-danger">{{$message}}</small>
                                        @enderror 
                                    </div>
                                </div>
                            @else
                                @foreach($images as $image)
                                    @if($image->is_main == false)
                                        <div class="form-group row">
                                            <label for="image2">Zdjęcie poboczne</label>
                                            <img src="{{ asset($image->url) }}" class="image2" id="{{ $image->id }}" onclick="openModal({{ $image->id }})" alt="Zdjęcie poboczne" title="Zdjęcie poboczne" loading="lazy">
                                            <div id="myModal{{ $image->id }}" class="modal">
                                                <span class="close" id="close{{ $image->id }}">&times;</span>
                                                <img class="modal-content" id="img{{ $image->id }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="images">Wybierz inne pozostałe zdjęcia</label>
                                                <input type="file" name="images[]" multiple>
                                                <small id="imagesHelp" class="form-text text-muted2">(jeśli pozostawisz puste stare zdjęcia pozostaną niezmienione)</small>
                                                @error('images')
                                                    <small class="form-text text-danger">{{$message}}</small>
                                                @enderror 
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        @endif
                        <br>
                        <div class="form-group row mb-0 text-center">
                            <div class="col-md-6">
                                <a href="{{ route('offertsModerator.index') }}" class="btn btn-danger">
                                    {{ __('Anuluj') }}
                                </a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Zapisz') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('/js/editoffert.js')}}"></script>
@endsection