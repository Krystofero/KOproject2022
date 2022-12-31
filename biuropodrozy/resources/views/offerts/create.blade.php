@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header h3 text-center">{{ __('Tworzenie nowej oferty') }}</div>
                <div class="card-body">
                    <form method="post" action="{{ route('offertsModerator.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Nazwa</label>
                            <input name="title" id="title" class="form-control" type="text" aria-describedby="titleHelp" placeholder="Wprowadź tytuł" required autocomplete="title" autofocus>
                            <small id="titleHelp" class="form-text text-muted">Podaj unikalną nazwę oferty.</small>

                            @error('title')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror    
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8">
                                <label for="country">Kraj</label>
                                <input name="country" id="title" class="form-control" type="text" aria-describedby="countryHelp" placeholder="Wprowadź kraj" required autocomplete="title" autofocus>
                                <small id="countryHelp" class="form-text text-muted">Podaj kraj oferty.</small>

                                @error('country')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror    
                            </div>
                            <div class="col-md-4">
                                <label for="price">Cena</label>
                                <input name="price" id="price" class="form-control" type="number" step=".01" aria-describedby="priceHelp" placeholder="Wprowadź cenę" autocomplete="price" autofocus></input>
                                <small id="priceHelp" class="form-text text-muted">Wprowadź cenę oferty.</small>

                                @error('price')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror  
                            </div>  
                        </div>
                        <div class="form-group">
                            <label for="description">Opis</label>
                            <textarea name="description" id="description" class="form-control" type="text" aria-describedby="descriptionHelp" placeholder="Wprowadź opis" autocomplete="description" autofocus></textarea>
                            <small id="descriptionHelp" class="form-text text-muted">Wprowadź opis widoczny przy ofercie.</small>

                            @error('description')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror    
                        </div>
                        <div class="form-group row mb-0 ">
                            <div class="col-md-6">
                                <label for="startdateturnus">Data początkowa czasu trwania turnusu</label>
                                <input name="startdateturnus" id="startdateturnus" class="form-control" type="date" aria-describedby="startdateturnusHelp" placeholder="Wprowadź datę początkową turnusu" required autocomplete="startdateturnus" autofocus>
                                <small id="startdateturnusHelp" class="form-text text-muted">Data określająca początek turnusu.</small>

                                @error('startdateturnus')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror    
                            </div>
                            <div class="col-md-6">
                                <label for="enddateturnus">Data końcowa czasu trwania turnusu</label>
                                <input name="enddateturnus" id="enddateturnus" class="form-control" type="date" aria-describedby="enddateturnusHelp" placeholder="Wprowadź datę końcową turnusu" required autocomplete="enddateturnus" autofocus>
                                <small id="enddateturnusHelp" class="form-text text-muted">Data określająca koniec turnusu.</small>

                                @error('enddateturnus')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror  
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0 ">
                            <div class="col-md-6">
                                <label for="startdate">Data początkowa czasu trwania oferty</label>
                                <input name="startdate" id="startdate" class="form-control" type="date" aria-describedby="startdateHelp" placeholder="Wprowadź datę początkową oferty" required autocomplete="startdate" autofocus>
                                <small id="startdateHelp" class="form-text text-muted">Data określająca początek możliwości wyświetlania oferty.</small>

                                @error('startdate')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror    
                            </div>
                            <div class="col-md-6">
                                <label for="enddate">Data końcowa czasu trwania oferty</label>
                                <input name="enddate" id="enddate" class="form-control" type="date" aria-describedby="enddateHelp" placeholder="Wprowadź datę końcową oferty" required autocomplete="enddate" autofocus>
                                <small id="enddateHelp" class="form-text text-muted">Data określająca koniec możliwości wyświetlania oferty.</small>

                                @error('enddate')
                                    <small class="form-text text-danger">{{$message}}</small>
                                @enderror  
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="image">Wybierz zdjęcie główne</label>
                            <input type="file" name="image" id="image" required>
                            @error('image')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror  
                        </div>
                        <div class="col-md-12 mb-2" id="mainphoto">
                            <img id="preview-image-before-upload" url="/img/image-not-found.jpg" 
                            alt="brak zdjęcia głównego" style="max-height: 250px;">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="images">Wybierz pozostałe zdjęcia</label>
                            <input type="file" name="images[]" multiple>
                            @error('images')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror 
                        </div>
                        <br>
                        {{-- <div class="form-group">
                            <label for="photos">Podpięte zdjęcia</label>
                            <div class="col-md-12">
                               
                            </div>
                            <small id="photosHelp" class="form-text text-muted">Wstaw zdjęcia dotyczące oferty.</small>
                        </div> --}}

                        
                        <div class="form-group row mb-0 text-center">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">Utwórz ofertę</button>
                            </div>
                            <div class="col-md-6">
                                <a href="{{  route('offertsModerator.index') }}" class="btn btn-danger">
                                    {{ __('Anuluj') }}
                                </a>
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
        // $('#preview-image-before-upload').show();       
        let reader = new FileReader();
     
        reader.onload = (e) => { 
     
          $('#preview-image-before-upload').attr('src', e.target.result); 
        }
        reader.readAsDataURL(this.files[0]); 
       
       });
       
    });
     
</script>
@endsection