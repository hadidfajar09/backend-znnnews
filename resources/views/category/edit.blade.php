@extends('layouts.bootstrap')

@section('title')
    Edit Kategori
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-secondary">
            <div class="card-header">
                <h3>Edit Kategori</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('category.index') }}" class="btn btn-outline-dark " role="button" aria-pressed="true">Kembali</a>

                <form method="post" action="{{ route('category.update',[$category->id]) }}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="card-body col-8">

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}" name="name" id="name" value=" {{$category->name}}">
                            <span class="error invalid-feedback">{{$errors->first('name')}}</span>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Masukkan nama kategori yang umum
                                </span>
                            </div>
                        </div>

                        <br>
                    
                        <div class="file-upload-wrapper">
                            <label for="picture">Foto Kategori</label>
                            
                            <div class="input-group">
                                <img class="img-rounded" src="{{ asset('uploads/'.$category->picture) }}" width="150px">
                            </div>
                        </div>

                        <div class="file-upload-wrapper">
                            <label for="picture"></label>
                            <input type="file" class="form-control {{$errors->first('picture') ? 'is-invalid' : ''}}" name="picture" id="picture">
                            <span class="error invalid-feedback">{{$errors->first('picture')}}</span>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Upload Foto Kategori
                                </span>
                            </div>
                        </div>
                        <br>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-secondary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection