@extends('layouts.front_layout.front_layout')

@section('content')

<div class="span9">
<ul class="breadcrumb">
    <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
    <li class="active">Login/Register</li>
</ul>
<h3>Login / Register</h3> 
<hr class="soft">
@if(Session::has('error_message'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('error_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="row">
    <div class="span4">        
        <div class="well">
        <h5>CREATE YOUR ACCOUNT</h5><br>
        Enter your name and e-mail address to create an account.<br><br>
        <form action="{{ url('register') }}" method="post" id="registerForm">
            @csrf
            <div class="control-group">
                <label class="control-label" for="name">Name</label>
                <div class="controls">
                    <input class="span3" type="text" name="name" id="name" placeholder="Enter your name..">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="mobile">Mobile</label>
                <div class="controls">
                    <input class="span3" type="text" name="mobile" id="mobile" placeholder="Enter your mobile..">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="email">E-mail address</label>
                <div class="controls">
                    <input class="span3" type="text" name="email" id="email" placeholder="Enter your email..">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="password">Choose Password</label>
                <div class="controls">
                    <input type="password" class="span3" name="password" id="password" placeholder="Choose Your password..">
                </div>
            </div>
            <div class="controls">
                <button type="submit" class="btn block">Create Your Account</button>
            </div>
        </form>
    </div>
    </div>
    <div class="span1"> &nbsp;</div>
    <div class="span4">
        <div class="well">
        <h5>ALREADY REGISTERED ?</h5>
        <form action="{{ url('login') }}" method="post" id="loginForm">
            @csrf
            <div class="control-group">
                <label class="control-label" for="email">E-mail address</label>
                <div class="controls">
                    <input class="span3" type="text" name="email" id="email" placeholder="Enter your email..">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="password">Choose Password</label>
                <div class="controls">
                    <input type="password" class="span3" name="password" id="password" placeholder="Choose Your password..">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn">Sign in</button> <a href="">Forgot password?</a>
                </div>
            </div>
        </form>
    </div>
    </div>
</div>  
    
</div>

@endsection