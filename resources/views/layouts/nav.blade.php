<nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Forum') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fa fa-th-list"></span> Browse </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/threads">All Threads</a></li>

                        @if (auth()->check())
                            <li><a class="dropdown-item" href="/threads?by={{ auth()->user()->name }}">My threads</a></li>
                        @endif

                        <li><a class="dropdown-item" href="/threads?popular=1">Popular Threads</a></li>
                        <li><a class="dropdown-item" href="/threads?unanswered=1">Unanswered Threads</a></li>
                    </ul>
                </li>

                <a class="nav-link" href="/threads/create"><span class="fa fa-plus-circle"></span> New Thread</a>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fa fa-clipboard-list"></span> Channels </a>

                    <ul class="dropdown-menu">
                        @foreach ($channels as $channel)
                            <li><a class="dropdown-item" href="/threads/{{ $channel->slug }}">{{ $channel->name }}</a></li>
                        @endforeach
                    </ul>
                </li>

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <user-notifications></user-notifications>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span class="fa fa-user"></span>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <!-- <li> -->
                                <a class="dropdown-item" href="{{ route('profile', Auth::user()) }}">My profile</a>
                            <!-- </li> -->

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
