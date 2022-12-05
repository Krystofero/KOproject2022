@extends('layouts.app')

@section('additives')
    @include('constant/dataTable')
@endsection

@section('content')
<div class="container">
    <div class="card">
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
                    {{-- Status oferty: --}}
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
                        <button class="btn btn-danger btn-sm delete" title="Usunięcie oferty" data-id="{{ $offert->id }}">
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
                    <button class="border border-secondary btn btn-primary" style="color: white;"><i class="far fa-edit"></i>Utwórz nową ofertę</button>
                </a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" > const deleteUrl = "{{ url('offertsModerator') }}/"; </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{asset('/js/offertsmanagelist.js')}}"></script>
@endsection