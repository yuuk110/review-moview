@extends('layouts.app')
@section('content')

<div class="row justify-content-center container">
    
    @foreach($reviews as $review)
    @if (Auth::check())
    <div class="col-md-4">
        <div class="card mb50">
            <div class="card-body">
                
                
                <div class='image-wrapper'><img class='movie-image' src="{{ asset('storage/images/'.$review->image) }}"></div>
                
                
                
                <h3 class='h3 movie-title'>{{ $review->title }}</h3>
                <p class="description">
                    {{ $review->content }}
                </p>
                <a href="{{ route('show', ['id' => $review->id ]) }}" class='btn btn-secondary detail-btn'>詳細</a>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>
{{ $reviews->links() }}
@endsection