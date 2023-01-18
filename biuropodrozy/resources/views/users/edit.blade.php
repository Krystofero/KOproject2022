@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header h4">Edycja użytkownika: {{ $user->firstname }} {{ $user->lastname }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        {{ method_field('PUT') }}
                        @csrf

                        <div class="row mb-3">
                            <label for="user_level" class="col-md-2 col-form-label text-md-end"><i class="fas fa-user"></i> {{ __('Rola:') }} </label>
                            <div class="col-md-8">
                                <select class="form-select" aria-label=".form-select-lg example" name="user_level" id="user_level">
                                    @foreach ($users_level_list as $key => $val)
                                        <option value={{$val}} @if (isset($user->user_level) && $user->user_level == $val) selected @endif>{{$val}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0 text-center">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Zapisz') }}
                                </button>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('users.index') }}" class="btn btn-danger">
                                    {{ __('Anuluj') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection