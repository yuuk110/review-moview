@extends('layouts.app')
@section('content')
<div class="row justify-content-center container">
    
    @foreach($reviews as $review)
    
    <div class="col-md-4">
        <div class="card mb50">
            <div class="card-body">
                
                
                <div class='image-wrapper'><img class='movie-image' src="{{ Storage::disk('s3')->url('uploads/' . $review->image) }}"></div>
                
                
                
                <h3 class='h3 movie-title'>{{ $review->title }}</h3>
                <h3 class="h3 movie-recommend">おすすめ度{{ $review->recommend }}</h3>
                <p class="description">
                    {!! nl2br(e($review->content)) !!}
                </p>
                <a href="{{ route('show', ['id' => $review->id ]) }}" class='btn btn-secondary detail-btn'>詳細</a>
                 @if (Auth::id() == $review->user_id)
                 　　<a href="{{ route('edit', ['id' => $review->id ]) }}" class='btn btn-secondary detail-btn'>編集</a>
                 @endif
            </div>
        </div>
    </div>
   
    
    @endforeach
</div>
{{ $reviews->links() }}
@endsection