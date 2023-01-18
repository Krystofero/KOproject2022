@extends('layouts.app')
@section('additives')
    @include('constant/dataTable')
@endsection
@section('content')
<div class="container">
    <div class="card">
        <div class="row" id="titlerow">
            <div class="col-6 text-white">
                <h1><i class="fas fa-users"></i> {{ __('Podsumowanie zamówienień') }}</h1>
            </div>
        </div>
        <table class="text-white display responsive nowrap" id="myTable" style="width:100%">
            <thead>
            <tr>
                <th scope="col">Kwota</th>
                <th scope="col">Imię</th>
                <th scope="col">Nazwisko</th>
                <th scope="col">Email</th>
                <th scope="col">Telefon</th>
                <th scope="col">Wykupione ubezpieczenie</th>
                <th scope="col">Utworzono</th>
            </tr>
            </thead>
            <tbody class="text-dark">
            @foreach($orders as $order)
                <tr>
                    {{-- <th scope="row">{{ $offert->title }}</th> --}}
                    <td>{{ $order->price }} zł</td>
                    <td>{{ $order->firstname }}</td>
                    <td>{{ $order->lastname }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->tel }}</td>
                    <td>
                        @if($order->insurance == true)
                            TAK
                        @else
                            NIE
                        @endif
                    </td>
                    <td>{{ $order->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="{{asset('/js/orderslist.js')}}"></script>
@endsection