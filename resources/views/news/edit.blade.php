@extends('layouts.bootstrap')

@section('title')
Update Berita
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-secondary">
            <div class="card-header">
                <h3>Update Berita</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('news.index') }}" class="btn btn-outline-dark " role="button" aria-pressed="true">Kembali</a>

                <form method="post" action="{{ route('news.update',[$news->id]) }}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="card-body col-8">


                        <div class="form-group">
                            <label for="category_id">Kategori</label>
                           
                            <select class="form-control" name="category_id" id="category_id">
                                @foreach ($category as $row)
                                <option value="{{ $row->id }}" @if($news->category_id == $row->id) selected @endif >{{ $row->name }}</option>    
                                @endforeach

                            </select>
                            <span class="error invalid-feedback">{{$errors->first('category_id')}}</span>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Pilih Kategori yang sesuai dengan jenis berita
                                </span>
                            </div>
                        </div>

                        <br>

                        <div class="form-group">
                            <label for="user_id">Kolumnis</label>
                           
                            <select class="form-control" name="user_id" id="user_id">
                                @foreach ($users as $row)
                                <option value="{{ $row->id }}" @if($news->user_id == $row->id) selected @endif>{{ $row->name }}</option>    
                                @endforeach

                            </select>
                            <span class="error invalid-feedback">{{$errors->first('user_id')}}</span>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Pilih Kolumnis yang sesuai
                                </span>
                            </div>
                        </div>

                        <br>

                        <div class="form-group">
                            <label for="name">Redaksi</label>
                            <input type="text" value="{{ $news->name }}" class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}" name="name" id="name">
                           
                            <span class="error invalid-feedback">{{$errors->first('name')}}</span>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Redaksi Berita
                                </span>
                            </div>
                        </div>

                        <br>

                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" value="{{ $news->author }}" class="form-control {{$errors->first('author') ? 'is-invalid' : ''}}" name="author" id="author">
                           
                            <span class="error invalid-feedback">{{$errors->first('author')}}</span>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Author Sumber Redaksi 
                                </span>
                            </div>
                        </div>

                        <br>

                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input type="text" value="{{ $news->title }}" class="form-control {{$errors->first('title') ? 'is-invalid' : ''}}" name="title" id="title">
                           
                            <span class="error invalid-feedback">{{$errors->first('title')}}</span>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Masukkan judul berita
                                </span>
                            </div>
                        </div>

                        <br>

                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" id="description" class="form-control {{$errors->first('description') ? 'is-invalid' : ''}} " cols="30" rows="10">{{ $news->description }} </textarea>
                           
                            <span class="error invalid-feedback">{{$errors->first('description')}}</span>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Masukkan Deskripsi mengenai berita
                                </span>
                            </div>
                        </div>

                        <br>

                        <div class="form-group">
                            <label for="url">Url</label>
                            <input type="text" value="{{ $news->url }}" class="form-control {{$errors->first('url') ? 'is-invalid' : ''}}" name="url" id="url">
                           
                            <span class="error invalid-feedback">{{$errors->first('url')}}</span>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Masukkan URL Berita dari Resource
                                </span>
                            </div>
                        </div>

                        <br>

                        <div class="form-group">
                            <label for="urlToImage">Url Gambar</label>
                            <input type="text" value="{{ $news->urlToImage }}" class="form-control {{$errors->first('urlToImage') ? 'is-invalid' : ''}}" name="urlToImage" id="urlToImage">
                           
                            <span class="error invalid-feedback">{{$errors->first('urlToImage')}}</span>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Masukkan URL Gambar Berita dari Resource
                                </span>
                            </div>
                        </div>

                        <br>

                        <div class="form-group">
                            <label for="publishedAt">Kode Rilis</label>
                            <input type="text" value="{{ $news->publishedAt }}" class="form-control {{$errors->first('publishedAt') ? 'is-invalid' : ''}}" name="publishedAt" id="publishedAt">
                           
                            <span class="error invalid-feedback">{{$errors->first('publishedAt')}}</span>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Masukkan Kode Rilis dari source
                                </span>
                            </div>
                        </div>

                        <br>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" class="form-control {{$errors->first('content') ? 'is-invalid' : ''}} " cols="30" rows="10"> {{ $news->content }} </textarea>
                           
                            <span class="error invalid-feedback">{{$errors->first('content')}}</span>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Isi sesuai content
                                </span>
                            </div>
                        </div>

                        

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-secondary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('costum-script')
<link rel="stylesheet" href="{{ asset('fajarnet/vendors/summernote/summernote-bs4.min.css') }}">
<script src="{{ asset('fajarnet/vendors/summernote/summernote-bs4.min.js') }}"></script>
<script>
    $(document).ready(function(){
$("#description").summernote({
toolbar: [
// [groupName, [list of button]]
['style', ['bold', 'italic', 'underline', 'clear']],
['font', ['strikethrough', 'superscript', 'subscript']],
['fontsize', ['fontsize']],
['color', ['color']],
['para', ['ul', 'ol', 'paragraph']],
['height', ['height']]
]
});
});

</script>

<script>
    $(document).ready(function(){
$("#content").summernote({
toolbar: [
// [groupName, [list of button]]
['style', ['bold', 'italic', 'underline', 'clear']],
['font', ['strikethrough', 'superscript', 'subscript']],
['fontsize', ['fontsize']],
['color', ['color']],
['para', ['ul', 'ol', 'paragraph']],
['height', ['height']]
]
});
});

</script>

@endsection