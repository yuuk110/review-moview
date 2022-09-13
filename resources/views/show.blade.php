@extends('layouts.app')

@section('content')


<div class="container">
    <h1 class='pagetitle'>レビュー詳細</h1>
    <div class="card">
        <div class="card-body">
            <section class='review-main'>
                 <h2 class='h2'>映画の画像</h2>
                 <img class='movie-image' src="{{ asset('/uploads'.$review->image) }}">
                 <h2 class='h2'>映画のタイトル</h2>
                 <p class='h2 mb20'>{{ $review->title }}</p>
                 <h2 class='h2'>レビュー内容</h2>
                 <p>{{ $review->content }}</p>
            </section>
        </div>
        <a href="{{ route('index') }}" class='btn btn-info btn-back mb20'>一覧へ戻る</a>
    </div>
</div>

@endsection