@extends('layouts.bootstrap')

@section('title')
    Detail Berita
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Detail Berita</h3>
        </div>
        <div class="card-body table-responsive">
            <a href="{{ route('news.index') }}" class="btn btn-outline-dark">Back</a>
            <hr>
            <table class="table table-bordered">
		 <tr>
             <td>Judul</td>
             <td>:</td>
             <td>{{ $news->title }}</td>
         </tr>

         <tr>
            <td>Kategori</td>
            <td>:</td>
            <td>{{ $news->category->name }}</td>
        </tr>

        <tr>
            <td>Kolumnis</td>
            <td>:</td>
            <td>{{ $news->user->name }}</td>
        </tr>

        <tr>
            <td>Redaksi</td>
            <td>:</td>
            <td>{{ $news->name }}</td>
        </tr>

        <tr>
            <td>Author</td>
            <td>:</td>
            <td>{{ $news->author }}</td>
        </tr>

        <tr>
            <td>Deskripsi</td>
            <td>:</td>
            <td>{!!$news->description!!}</td>
        </tr>

        <tr>
            <td>URL</td>
            <td>:</td>
            <td>{{ $news->url }}</td>
        </tr>

        <tr>
            <td>URL Gambar</td>
            <td>:</td>
            <td>{{ $news->urlToImage }}</td>
        </tr>

        <tr>
            <td>Rilis</td>
            <td>:</td>
            <td>{{ $news->publishedAt }}</td>
        </tr>

        <tr>
            <td>Content</td>
            <td>:</td>
            <td>{!!$news->content!!}</td>
        </tr>

        
            </table>
        </div>
        <div class="card-footer">
        </div>
      </div>
    </div>
  </div>
  
@endsection