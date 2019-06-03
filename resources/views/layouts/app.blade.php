<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
    
    <style type="text/css">
        
#toastem{
  position: fixed;
  z-index: 999;
  top: 50px;
  right: 4px;
}
.notification{
  display: block;
  position: relative;
  overflow: hidden;
  margin-top: 10px;
  margin-right: 10px;
  padding: 10px;
  width: 300px;
  border-radius: 3px;
  right: -400px;
  /*box-shadow: 0px 1px 5px #bbbbbb;*/
}
a.message_new {
  text-decoration: none;
}
.normal{
  background: #3c3b3b;
}
.success{
  background: #d7e7dd;
}
.error{
  background: #c33c3c;
}

.header-menu-toggle {
    position: fixed;
    right: 38px;
    top: 24px;
    height: 42px;
    width: 42px;
    line-height: 42px;
    font-family: "montserrat-medium", sans-serif;
    font-size: 1.3rem;
    text-transform: uppercase;
    letter-spacing: .3rem;
    color: #39b54a;
    -webkit-transition: all 0.5s ease-in-out;
    transition: all 0.5s ease-in-out;
}

.header-menu-toggle.opaque {
    background-color: #000000;
}

.header-menu-toggle.opaque .header-menu-text {
    background-color: #000000;
}

.header-menu-toggle:hover, .header-menu-toggle:focus {
    color: #FFFFFF;
}




        #wrapper {
  padding-left: 0;
  -webkit-transition: all 0.5s ease;
  -moz-transition: all 0.5s ease;
  -o-transition: all 0.5s ease;
  transition: all 0.5s ease;
}

#wrapper.toggled {
  padding-left: 250px;
}

#sidebar-wrapper {
  z-index: 1000;
  position: fixed;
  left: 250px;
  width: 0;
  height: 100%;
  margin-left: -250px;
  overflow-y: auto;
  background: #000;
  -webkit-transition: all 0.5s ease;
  -moz-transition: all 0.5s ease;
  -o-transition: all 0.5s ease;
  transition: all 0.5s ease;
}

#wrapper.toggled #sidebar-wrapper {
  width: 250px;
}

#page-content-wrapper {
  width: 100%;
  position: absolute;
  padding: 15px;
}

#wrapper.toggled #page-content-wrapper {
  position: absolute;
  margin-right: -250px;
}


/* Sidebar Styles */

.sidebar-nav {
  position: absolute;
  top: 0;
  width: 250px;
  margin: 0;
  padding: 0;
  list-style: none;
}

.sidebar-nav li {
  text-indent: 20px;
  line-height: 40px;
}

.sidebar-nav li a {
  display: block;
  text-decoration: none;
  color: #999999;
}

.sidebar-nav li a:hover {
  text-decoration: none;
  color: #fff;
  background: rgba(255, 255, 255, 0.2);
}

.sidebar-nav li a:active, .sidebar-nav li a:focus {
  text-decoration: none;
}

.sidebar-nav>.sidebar-brand {
  height: 65px;
  font-size: 18px;
  line-height: 60px;
}

.sidebar-nav>.sidebar-brand a {
  color: #999999;
}

.sidebar-nav>.sidebar-brand a:hover {
  color: #fff;
  background: none;
}

@media(min-width:768px) {
  #wrapper {
    padding-left: 0;
  }
  #wrapper.toggled {
    padding-left: 250px;
  }
  #sidebar-wrapper {
    width: 0;
  }
  #wrapper.toggled #sidebar-wrapper {
    width: 250px;
  }
  #page-content-wrapper {
    padding: 20px;
    position: relative;
  }
  #wrapper.toggled #page-content-wrapper {
    position: relative;
    margin-right: 0;
  }
}

    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar-default navbar-static-top">
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
                        {{ config('app.name', 'Laravel') }}
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
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    
                                    <li>
                                        <a href="{{ route('home') }}">
                                            Home
                                        </a>
                                    </li>
                                   <!--  <li>
                                        <a href="/groups">
                                            Groups
                                        </a>
                                    </li> -->
                                    <li>
                                        <a href="/friends">
                                            Fiends
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/search">
                                            Seacrh
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>                                    
                                </ul>
                            </li>
                            <newmess :user="{{Auth::user()->id}}"></newmess>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>   

        <!-- Page Content -->
        <main class="py-3">
            @yield('content')
        </main>
        <!-- /#page-content-wrapper -->

        <div id="toastem"></div>        
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
