@extends('layouts.master-advance')

@section('container')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default panel-c">
                <div class="panel-heading">Prijava</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST">
                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Korisničko ime</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Korisničko ime">
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Šifra</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" placeholder="Šifra">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>Prijavi se
                                </button>
                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Zaboravili ste šifru?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {!! Html::style('/css/login.css') !!}
@endsection
