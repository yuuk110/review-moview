@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ログイン画面') }}</div>
                
                <div class="card-body">
                    {!! Form::open(['route' => 'login.post']) !!}
               <div class="form-group">
                   {!! Form::label('email', 'メールアドレス') !!}
                   {!! Form::email('email', null, ['class' => 'form-control']) !!}
               </div>
               
               <div class="form-group">
                   {!! Form::label('password', 'パスワード') !!}
                   {!! Form::password('password', ['class' => 'form-control']) !!}
               </div>
               
               {!! Form::submit('ログイン', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection