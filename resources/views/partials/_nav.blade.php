<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <strong>CIT LIBRARY SYSTEM</strong>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li><a href="{{ route('login') }}"><i class="fa fa-key"></i>Login</a></li>
                    <li><a href="{{ route('register') }}"><i class="fa fa-registered"></i> Register</a></li>
                @else

                    @if(Auth::user()->role_id == 1)
                       <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                               {{--  {{ Auth::user()->name }}  --}}<i class="fa fa-unlock"></i> Admin <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li><a href="{{ route('genres.index') }}">All Genres</a></li>
                                {{-- <li><a href="{{ route('tasks.index') }}"><i class="fa fa-tasks"></i> All Tasks</a></li> --}}
                                <li><a href="{{ route('books.index') }}">All Books</a></li>
                                <li><a href="{{ route('users.index') }}">All Users</a></li>
                                {{-- <li><a href="{{ route('roles.index') }}">All Roles</a></li> --}}
                            </ul>
                        </li> 
                    @endif

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true"><i class="fa fa-user" aria-hidden="true"></i> 
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="{{ route('genres.index') }}"><i class="fa fa-building"></i> Genres</a></li>
                            {{-- <li><a href="{{ route('tasks.index') }}"><i class="fa fa-tasks" aria-hidden="true"></i> Tasks</a></li> --}}
                            <li><a href="{{ route('books.index') }}"><i class="fa fa-edit" aria-hidden="true"></i> Books</a></li>
                            <hr>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"><i class="fa fa-minus-circle"></i>
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>