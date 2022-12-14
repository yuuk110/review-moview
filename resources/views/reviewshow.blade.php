@extends('layouts.app')
@section('content')
<div class="row justify-content-center container">
 <h2>{{ Auth::user()->name}}さんの投稿一覧</h2>
</div>
<div class="row justify-content-center container">
    
    @foreach($reviews as $review)
    @if (Auth::check())
    <div class="col-md-4">
        <div class="card mb50">
            <div class="card-body">
                
                
                <div class='image-wrapper'><img class='movie-image' src="{{ Storage::disk('s3')->url('uploads/' . $review->image) }}"></div>
                
                
                
                <h3 class='h3 movie-title'>{{ $review->title }}</h3>
                <h3 class='h3 movie-recommend'>おすすめ度{{ $review->recommend }}</h2>
                <p class="description">
                    {!! nl2br(e($review->content)) !!}
                </p>
                <a href="{{ route('show', ['id' => $review->id ]) }}" class='btn btn-secondary detail-btn'>詳細</a>
                <a href="{{ route('edit', ['id' => $review->id ]) }}" class='btn btn-secondary detail-btn'>編集</a>
                
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>
{{ $reviews->links() }}
@endsection