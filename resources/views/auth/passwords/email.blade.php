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
                <div class="panel-heading "> <h3 class="modal-title">Сбросить пароль</h3></div>
                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                        <script>setTimeout(function(){location.href="/"} , 7000);</script>
                    </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-3 control-label">E-Mail адрес</label>

                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7  col-md-offset-3 text-center">
                                <button type="submit" class="button extra-small mb-20">
                                    <span>Отправить ссылку на сброс пароля</span>

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
