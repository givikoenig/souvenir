@extends('layouts.site')

@section('content')
<header class="header-area header-wrapper header-2">
    <div id="sticky-header" class="header-middle-area plr-185">
        <div class="container-fluid">
            <div class="full-width-mega-dropdown">
                <div class="row">
                    <!-- logo -->
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <div class="logo">
                            <a href="/">
                                <img src="{{ asset('assets') }}/images/logo/logo.png" alt="main logo">
                            </a>

                        </div>
                    </div>

                    <div class="col-md-8 hidden-sm hidden-xs">
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <nav id="primary-menu">
                            <ul class="main-menu text-center">
                                <li><a href="/"><i class="zmdi zmdi-home"></i> Главная</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</header>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 modal-dialog2">
            <div class="panel panel-default modal-content">
                <div class="panel-heading"><h3 class="modal-title">Изменить пароль</h3></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail адрес</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Новый пароль</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control pwd" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Повторите пароль</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control pwd" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6  col-md-offset-4 text-center">
                                <button type="submit" class="button extra-small mb-20">
                                    <span>Изменить пароль</span>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
