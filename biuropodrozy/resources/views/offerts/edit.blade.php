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

                <div class="card-body">
                    <form method="POST" action="{{ route('offertsModerator.update', $offert->id) }}" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        @csrf

                        <div class="form-group">
                            <label for="title">Nazwa</label>
                            <input name="title" id="title" class="form-control" value="{{$offert->title}}" type="text" aria-describedby="titleHelp" placeholder="Wprowadź tytuł" required autocomplete="title" autofocus>
                            <small id="titleHelp" class="form-text text-muted">Nazwa oferty.</small>

                            @error('title')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror    
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8">
                                <label for="country">Kraj</label>
                                <input name="country" id="title" class="form-control" value="{{$offert->country}}" type="text" aria-describedby="countryHelp" placeholder="Wprowadź kraj" required autocomplete="title" autofocus>
                                <small id="countryHelp" class="form-text text-muted">Kraj oferty.</small>

                                @error('country')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror    
                            </div>
                            <div class="col-md-4">
                                <label for="price">Cena</label>
                                <input name="price" id="price" class="form-control" value="{{$offert->price}}" type="number" step=".01" aria-describedby="priceHelp" placeholder="Wprowadź cenę" autocomplete="price" autofocus></input>
                                <small id="priceHelp" class="form-text text-muted">Cena oferty.</small>
    
                                @error('price')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror   
                            </div> 
                        </div>
                        <div class="form-group">
                            <label for="description">Opis</label>
                            <textarea name="description" id="description" class="form-control" value="{{$offert->description}}" type="text" aria-describedby="descriptionHelp" placeholder="Wprowadź opis" autocomplete="description" autofocus>{{$offert->description}}</textarea>
                            <small id="descriptionHelp" class="form-text text-muted">Opis widoczny przy ofercie.</small>

                            @error('description')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror    
                        </div>
                        <div class="form-group row mb-0 ">
                            <div class="col-md-6">
                                <label for="startdateturnus">Data początkowa czasu trwania turnusu</label>
                                <input name="startdateturnus" id="startdateturnus" class="form-control" value="{{$offert->startdateturnus}}" type="date" aria-describedby="startdateturnusHelp" placeholder="Wprowadź datę początkową turnusu" required autocomplete="startdateturnus" autofocus>
                                <small id="startdateturnusHelp" class="form-text text-muted">Data określająca początek turnusu.</small>

                                @error('startdateturnus')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror    
                            </div>
                            <div class="col-md-6">
                                <label for="enddateturnus">Data końcowa czasu trwania turnusu</label>
                                <input name="enddateturnus" id="enddateturnus" class="form-control" value="{{$offert->enddateturnus}}" type="date" aria-describedby="enddateturnusHelp" placeholder="Wprowadź datę końcową turnusu" required autocomplete="enddateturnus" autofocus>
                                <small id="enddateturnusHelp" class="form-text text-muted">Data określająca koniec turnusu.</small>

                                @error('enddateturnus')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror  
                            </div>
                        </div>
                        <div class="form-group row mb-0 ">
                            <div class="col-md-6">
                                <label for="startdate">Data początkowa czasu trwania oferty</label>
                                <input name="startdate" id="startdate" class="form-control" value="{{$offert->startdate}}" type="date" aria-describedby="startdateHelp" placeholder="Wprowadź datę początkową oferty" required autocomplete="startdate" autofocus>
                                <small id="startdateHelp" class="form-text text-muted">Data określająca początek możliwości wyświetlania oferty.</small>

                                @error('startdate')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror    
                            </div>
                            <div class="col-md-6">
                                <label for="enddate">Data końcowa czasu trwania oferty</label>
                                <input name="enddate" id="enddate" class="form-control" value="{{$offert->enddate}}" type="date" aria-describedby="enddateHelp" placeholder="Wprowadź datę końcową oferty" required autocomplete="enddate" autofocus>
                                <small id="enddateHelp" class="form-text text-muted">Data określająca koniec możliwości wyświetlania oferty.</small>

                                @error('enddate')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror  
                            </div>
                        </div>


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
                                            @error('image')
                                                <small class="form-text text-danger">{{$message}}</small>
                                            @enderror  
                                        </div>
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
                                                    {{-- <a
                                                        data-thumb="{{ asset($image->url) }}"
                                                        data-alt="zdjęcie"
                                                        data-height="2000"
                                                        data-width="3000"
                                                    > --}}
                                                        <img src="{{ asset($image->url) }}" class="image" alt="zdjęcie" title="zdjęcie" loading="lazy">
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                        <li></li>
                                    </ul>
                                    <label for="images">Wybierz inne pozostałe zdjęcia</label>
                                    <input type="file" name="images[]" multiple>
                                    @error('images')
                                        <small class="form-text text-danger">{{$message}}</small>
                                    @enderror 
                                </div>
                            @else
                                @foreach($images as $image)
                                    @if($image->is_main == false)
                                        <div class="form-group">
                                            <label for="image2">Zdjęcie poboczne</label>
                                            <img src="{{ asset($image->url) }}" class="image2" alt="Zdjęcie poboczne" title="Zdjęcie poboczne" loading="lazy">
                                        
                                            <label for="images">Wybierz inne pozostałe zdjęcia</label>
                                            <input type="file" name="images[]" multiple>
                                            @error('images')
                                                <small class="form-text text-danger">{{$message}}</small>
                                            @enderror 
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
<script type="text/javascript">
      
    $(document).ready(function (e) {
     
       $('#image').change(function(){      
        let reader = new FileReader();
     
        reader.onload = (e) => { 
     
          $('#mainimage').attr('src', e.target.result); 
        }
        reader.readAsDataURL(this.files[0]); 
       
       });
       
    });
     
</script>
{{-- <script type="text/javascript">

    // // initialize
    let bp = BiggerPicture({
        target: document.body,
    })
    // let bp = @vite('BiggerPicture');

    // grab image links
    let imageLinks = document.querySelectorAll('#photos > li > a')

    // add click listener to open BiggerPicture
    for (let link of imageLinks) {
    link.addEventListener("click", openGallery);
    }

    // function to open BiggerPicture
    function openGallery(e) {
        e.preventDefault()
        bp.open({
            items: imageLinks,
            el: e.currentTarget,
        })
    }

</script> --}}
@endsection