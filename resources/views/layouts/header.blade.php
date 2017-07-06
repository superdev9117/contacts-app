@extends('layouts.base')

@section('stylesheets')


@endsection

@section('header')
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper">
                <a href="#" class="brand-logo"><img src="{{ url('img/logowhite.png') }}"></a>

                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <!-- Dropdown1 Trigger -->
                    <li>
                        <a class="dropdown-button" href="#!" data-activates="dropdown1">
                            <div style="clear:both"></div>
                            <span class="user-name">{{ request()->user()->name }}</span>
                            <i class="material-icons right">arrow_drop_down</i></a>
                    </li>
                </ul>

                <ul id="dropdown1" class="dropdown-content">
                    <li><a href="{{ url('/logout') }}"><i class="material-icons">lock_open</i>Log out</a></li>
                </ul>

                <!-- sliding responsive navbar -->

                <ul id="slide-out" class="side-nav">
                    <li>
                        <div class="userView">
                            <div class="background">
                                <img src="css/bg.jpg">
                            </div>
                            <a href="#!name"><span class="slide-text name">{{ request()->user()->name }}</span></a>
                            <a href="#!email"><span class="slide-text email">{{ request()->user()->email }}</span></a>
                        </div>
                    </li>

                    <li><a href="{{ url('/logout') }}"><i class="material-icons">lock_open</i>Log out</a></li>
                </ul>
                <a href="#" data-activates="slide-out" class="button-collapse "><i class="material-icons">menu</i></a>
            </div>
        </nav>
    </div>
@endsection

