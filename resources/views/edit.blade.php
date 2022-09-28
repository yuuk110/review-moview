@extends('layouts.app')
@section('content')

<h1 class='pagetitle'>レビュー編集画面</h1>

<div class="row justify-content-center container">
    <div class="col-md-10">
        <form method='POST' action="{{ route('update', $review->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label>映画のタイトル</label>
                        <input type='text' class='form-control' name='title' placeholder='タイトルを入力'>
                    </div>
                    <div class="form-group">
                        <label for="file1">映画の画像</label>
                　　　　<input type="file" id="file1" name='image' class="form-control-file">
                    </div>
                    
                    <div class="form-group">
                        <label>おすすめ度</label>
                        <div class="recommend-form">
                            <input id="star5" type="radio" name="recommend" value="5">
                            <label for="star5">★</label>
                            <input id="star4" type="radio" name="recommend" value="4">
                            <label for="star4">★</label>
                            <input id="star3" type="radio" name="recommend" value="3">
                            <label for="star3">★</label>
                            <input id="star2" type="radio" name="recommend" value="2">
                            <label for="star2">★</label>
                            <input id="star1" type="radio" name="recommend" value="1">
                            <label for="star1">★</label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>レビュー内容</label>
                        <textarea class='description form-control' name='content' placeholder='本文を入力'></textarea>
                    </div>
                    <input type='submit' class='btn btn-primary' value='レビュー編集'>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection