{{-- Navigation Bar on the up site - included in files --}}
<nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top">
    <div class="container">
        <!-- Logo -->
        {{-- <img src="{{URL::asset('/image/Logo.png')}}" width="45" height="40"> --}}
        <a class="navbar-brand logo" href="{{url('')}}">QuestionIS?</a>
        {{-- Responsive button --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="nav-item collapse navbar-collapse menu" id="navbarSupportedContent">
           <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                @auth
                    @can('isStudent')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('questionnaires.index') }}">Moje ankiety</a>
                        </li>
                    @endcan
                    @can('isModer')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('questionnairesModerator.index') }}">Zarządzaj ankietami</a>
                        </li>
                    @endcan
                    @can('isAdmin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                Panel administratora
                            </a>
                            <div class="dropdown-menu bg-dark">
                                {{-- <a class="dropdown-item nav-link navbar-collapse" href="{{ route('questionnairesModerator.index') }}">Zarządzaj ankietami</a> --}}
                                <a class="dropdown-item nav-link navbar-collapse" href="{{ route('users.index') }}">Zarządzaj użytkownikami</a>
                            </div>
                        </li>
                    @endcan
                @endauth
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                {{-- @if($user->logged == true)
                <a class="navbar-brand loger d-flex" href="/" style="margin-left: auto;">Wyloguj się</a>
                 @else --}}
                {{-- <a class="navbar-brand loger d-flex" href="{{url('/logowanie')}}" style="margin-left: auto;">Zaloguj się</a> --}}
                {{-- @endif --}}

                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link loger" href="{{ route('login') }}">{{ __('Zaloguj się') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link loger" href="{{ route('register') }}">{{ __('Zarejestruj się') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                        </a>

                        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Wyloguj się') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest


            </ul>
        </div>
        
    </div>
</nav>
<script>
    $(document).ready(function() {
        // dropdown animation
        $('.dropdown').on('show.bs.dropdown', function(e) {
            $(this).find('.dropdown-menu').first().stop(true, true).slideDown(400);
        });
        $('.dropdown').on('hide.bs.dropdown', function(e) {
            $(this).find('.dropdown-menu').first().stop(true, true).slideUp(200);
        });
    });
</script>
