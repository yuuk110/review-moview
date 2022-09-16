@extends('layouts.app')

@section('content')
@if (Auth::check())
<div class="row justify-content-center container">
    <div class="card">
        <div class="card-body">
            <h1>ようこそ{{ Auth::user()->name}}さん</h1>
        </div>
    </div>
</div>
@else

    
<div class="row justify-content-center container">
    
    @foreach($reviews as $review)
    
    <div class="col-md-4">
        <div class="card mb50">
            <div class="card-body">
                @if (Auth::check())
                  <h3>{{ Auth::user()->name }}</h3>
                @endif
                
                <div class='image-wrapper'><img class='movie-image' src="{{ Storage::disk('s3')->url('uploads/'.$review->image) }}"></div>
                
                
                
                <h3 class='h3 movie-title'>{{ $review->title }}</h3>
                <p class="description">
                    {{ $review->content }}
                </p>
                <a href="{{ route('show', ['id' => $review->id ]) }}" class='btn btn-secondary detail-btn'>詳細</a>
            </div>
        </div>
    </div>
   
    
    @endforeach
</div>
{{ $reviews->links() }}
 @endif
 
 
@endsection
