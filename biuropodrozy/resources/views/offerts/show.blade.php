@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header h3 text-center">{{ __('Podgląd oferty:') }} {{ $offert->title }}</div>
                <div class="card-body">
                    
                    


                    <div class="form-group row mb-0 text-center">
                        <div class="col-md-6">
                            <a href="{{ route('offertsModerator.index') }}" class="btn btn-danger">
                                <i class="fas fa-arrow-left"></i>{{ __(' Powrót') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection