@extends('layouts.base')

@section('title')
    Login
@endsection

@section('stylesheets')
    <link rel="stylesheet" href="{{ url('css/login.css') }}">
@endsection

@section('content')
    <div class="row login_page">
        <div class="col m6 s12">
            <img class="logo" src="{{ url('img/logo.png') }}">
            <p >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
        </div>
        <div class="col m6 s12">
            <div class="panel">
                <h2>LOGIN</h2>
                <div class="formset">
                    <form id="login" onsubmit="login(event)" method="post" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="email" id="email" type="email" required>
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field col s12">
                                <input name="password" id="password" type="password" required>
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <button type="submit" t class="waves-effect waves-light btn" >Login</button>
                    </form>
                    <a href="#">Forgot Your Password?</a>
                </div>
                <form onsubmit="register(event)" id="register" method="post" action="{{ url('/register') }}"
                      class="register-form"><i class="close">×</i>
                    {{ csrf_field() }}
                    <h2>REGISTER</h2>
                    <div class="formset">
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="name" id="user_name" type="text" required>
                                <label for="user_name">Name</label>
                            </div>
                            <div class="input-field col s12">
                                <input name="email" id="email_reg" type="email" required>
                                <label for="email_reg">Email</label>
                            </div>
                            <div class="input-field col s12">
                                <input name="password" id="paaword_reg" type="password" required>
                                <label for="password_reg">Password</label>
                            </div>
                        </div>
                        <button class="btn regist">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div style="clear:both"></div>

@endsection

@section('scripts')

    <script src="{{ url('js/login.js') }}"></script>


@endsection
