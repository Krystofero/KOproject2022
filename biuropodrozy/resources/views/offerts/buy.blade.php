@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header h3 text-center">{{ __('Kupno oferty:') }} {{ $offert->title }}</div>
                <div class="card-body3">
                    <form method="post" action="{{ route('offerts.store') }}" class="animated fadeIn">
                    {{-- <form method="post" action="{{ route('offerts.store', ['id' => 1]) }}" class="animated fadeIn"> --}}
                        @csrf
                        <input type="hidden" name="offert_id" value="{{ $offert->id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="firstname">Imię</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname', Auth::user()->firstname) }}" required>
                                @error('firstname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="lastname">Nazwisko</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname', Auth::user()->lastname) }}" required>
                                @error('lastname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tel">Telefon</label>
                                <input type="text" class="form-control" id="tel" name="tel" value="{{ old('tel', Auth::user()->tel) }}" required>
                                @error('tel')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="card-header"><h5><i class="fas fa-hotel"></i> Wariant podstawowy</h5></div>
                            <div class="form-check2">
                                <input type="checkbox" class="form-check2-input" id="basic" name="basic" value="basic" checked>
                                <label class="form-check-label" for="basic">Wybierz</label>
                            </div>
                            <div class="col-md-5">
                                <label for="price">Cena za osobę</label>
                                @if($offert->promotionprice)
                                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $offert->promotionprice) }}" readonly>
                                @else
                                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $offert->price) }}" readonly>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <label for="persnum">Ilość osób</label>
                                <input type="number" class="form-control" id="persnum" name="persnum" value="{{ old('persnum', $offert->persnum) }}" readonly>
                            </div>
                            <div class="col-md-5">
                                <label for="sumprice">Łącznie do zapłaty</label>
                                <input type="number" class="form-control" id="sumprice" name="sumprice" value="{{ old('sumprice', $sumprice) }}" readonly>
                            </div>
                        </div>
                        @if($offert->insuranceprice != null)
                            <div class="form-group row">
                                <div class="card-header"><h5><i class="fas fa-hospital"></i> Wariant z dodatkowym ubezpieczeniem</h5></div>
                                <div class="form-check2">
                                    <input type="checkbox" class="form-check2-input" id="insurance" name="insurance" value="insurance">
                                    <label class="form-check-label" for="insurance">Wybierz</label>
                                </div>
                                <div class="col-md-5">
                                    <label for="insuranceprice">Cena za osobę</label>
                                    <input type="number" class="form-control" id="insuranceprice" name="insuranceprice" value="{{ old('insuranceprice', $offert->insuranceprice) }}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="persnum">Ilość osób</label>
                                    <input type="number" class="form-control" id="persnum" name="persnum" value="{{ old('persnum', $offert->persnum) }}" readonly>
                                </div>
                                <div class="col-md-5">
                                    <label for="inssumprice">Łącznie do zapłaty</label>
                                    <input type="number" class="form-control" id="inssumprice" name="inssumprice" value="{{ old('inssumprice', $inssumprice) }}" readonly>
                                </div>
                            </div>
                        @endif

                        <div class="form-group row mb-0 text-center">
                            <div class="col-md-6">
                                <a href="{{  route('offerts.index') }}" class="btn btn-danger biggerbtn">
                                    {{ __('Anuluj') }}
                                </a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn2 btn-primary">Potwierdź</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('/js/buy.js')}}"></script>
@endsection