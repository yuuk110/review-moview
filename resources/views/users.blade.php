@extends('layouts.app')

@section('content')

<h1>ユーザ詳細</h1>
<div class="user_name">
   @if (Auth::check())
  <h2>{{ Auth::user()->name }}</h2>
  @endif
</div>

<div class="user_body">
  

</div>

@endsection