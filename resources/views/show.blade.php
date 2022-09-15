@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center container">
      <h1 class='pagetitle'>レビュー詳細</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <section class='review-main'>
                 <h2 class='h2'>映画の画像</h2>
                  <img class='movie-image' src="{{ asset('storage/uploads/' . $review->image) }}">
                 <h2 class='h2'>映画のタイトル</h2>
                 <p class='h2 mb20'>{{ $review->title }}</p>
                 <h2 class='h2'>レビュー内容</h2>
                 <p>{{ $review->content }}</p>
            </section>
        </div>
        @if (Auth::check())
        <a href="{{ route('usersreview') }}" class='btn btn-info btn-back mb20'>一覧へ戻る</a>
        @else
        <a href="{{ route('index') }}" class='btn btn-info btn-back mb20'>一覧へ戻る</a>
        @endif
        @if (Auth::check())
                   <div>
                        @if (Auth::user()->is_favorites($review->id))
                        {!! Form::open(['route' => ['favorites.unfavorite', $review->id], 'method' => 'delete']) !!}
                            {!! Form::submit('お気に入り解除', ['class' => "btn btn-outline-success btn-sm mr-2"]) !!}
                        {!! Form::close() !!}
                        @else
                        {!! Form::open(['route' => ['favorites.favorite', $review->id]]) !!}
                            {!! Form::submit('  お気に入り  ', ['class' => "btn btn-outline-primary btn-sm mr-2"]) !!}
                        {!! Form::close() !!}
                        @endif
                        
                        @if (Auth::id() == $review->user_id)
                            {{-- 投稿削除ボタンのフォーム --}}
                            {!! Form::open(['route' => ['destroy', $review->id], 'method' => 'delete']) !!}
                                {!! Form::submit('投稿削除', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
        @endif
    </div>
</div>
@endsection