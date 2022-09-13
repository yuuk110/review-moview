@extends('layouts.app')

@section('content')
<h1 class='pagetitle'>レビュー投稿画面</h1>


<div class="row justify-content-center container">
    <div class="col-md-10">
        <form method='POST' action="{{ route('store') }}" enctype="multipart/form-data">
            @csrf
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
                        <label>レビュー内容</label>
                        <textarea class='description form-control' name='content' placeholder='本文を入力'></textarea>
                    </div>
                    <input type='submit' class='btn btn-primary' value='投稿'>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection