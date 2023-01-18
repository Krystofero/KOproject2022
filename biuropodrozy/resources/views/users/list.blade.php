@extends('layouts.app')
@section('additives')
    @include('constant/dataTable')
@endsection
@section('content')
<div class="container">
    <div class="card">
        {{-- @include('helpers.flash-messages') --}}
        <div class="row" id="titlerow">
            <div class="col-6 text-white">
                <h1><i class="fas fa-users"></i> {{ __('Lista użytkowników') }}</h1>
            </div>
        </div>
        <table class="text-white display responsive nowrap" id="myTable" style="width:100%">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Imię</th>
                <th scope="col">Nazwisko</th>
                <th scope="col">Status</th>
                <th scope="col">Telefon</th>
                <th scope="col">e-mail</th>
                <th scope="col">Akcje</th>
            </tr>
            </thead>
            <tbody class="text-dark">
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->firstname }}</td>
                    <td>{{ $user->lastname }}</td>
                    <td>{{ $user->user_level }}</td>
                    <td>{{ $user->tel }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}">
                            <button class="btn btn-success btn-sm" title="Edycja danych użytkownika"><i class="far fa-edit"></i></button>
                        </a>
                        <button class="btn btn-danger btn-sm delete" title="Usunięcie użytkownika" data-id="{{ $user->id }}">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript" > const deleteUrl = "{{ url('users') }}/"; </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{asset('/js/userslist.js')}}"></script>
@endsection