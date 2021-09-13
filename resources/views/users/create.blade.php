@extends('layouts.bootstrap')

@section('title')
Tambah User
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-secondary">
            <div class="card-header">
                <h3>Tambah User</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('users.index') }}" class="btn btn-outline-dark " role="button" aria-pressed="true">Kembali</a>

                <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body col-8">

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control {{$errors->first('email') ? 'is-invalid' : ''}}" name="email" id="email" value="{{ old('email') }}">
                            <span class="error invalid-feedback">{{$errors->first('email')}}</span>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Masukkan Email Yang Unik contoh : zero@zeronine.com
                                </span>
                            </div>
                        </div>

                        <br>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control {{$errors->first('password') ? 'is-invalid' : ''}}" name="password" id="password">
                            <span class="error invalid-feedback">{{$errors->first('password')}}</span>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Minimal 8-12 digit ex : hadidfajar09
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}" name="name" id="name" value="{{ old('name') }}">
                            <span class="error invalid-feedback">{{$errors->first('name')}}</span>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Masukkan Nama Lengkap anda jangan nama panggilan
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="fungsi">Sebagai</label>
                            <select name="fungsi" id="fungsi" class="form-control {{$errors->first('fungsi') ? 'is-invalid' : ''}}">
                                <option selected>Pilih</option>
                                <option value="admin">Admin</option>
                                <option value="kolumnis">Kolumnis</option>
                            </select>
                            <span class="error invalid-feedback">{{$errors->first('fungsi')}}</span>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Pilih sesuai posisi anda
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="kelamin">Jenis Kelamin</label>
                            <select name="kelamin" id="kelamin" class="form-control {{$errors->first('kelamin') ? 'is-invalid' : ''}}">
                                <option selected>Pilih</option>
                                <option value="pria">Pria</option>
                                <option value="wanita">Wanita</option>
                            </select>
                            <span class="error invalid-feedback">{{$errors->first('kelamin')}}</span>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Pilih Jenis Kelamin anda yang bener
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="nomer">Nomor HP/WA</label>
                            <input type="text" class="form-control {{$errors->first('nomer') ? 'is-invalid' : ''}}" name="nomer" id="nomer" value="{{ old('nomer') }}">
                            <span class="error invalid-feedback">{{$errors->first('nomer')}}</span>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Minimal 10-12 digits ex : 085796124090
                                </span>
                            </div>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control {{$errors->first('alamat') ? 'is-invalid' : ''}}" id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                            <span class="error invalid-feedback">{{$errors->first('alamat')}}</span>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Masukkan Alamat lengkap rumah anda ex : Jl.BTN Tabaria
                                </span>
                            </div>
                        </div>
                        <br>

                        <div class="file-upload-wrapper">
                            <label for="picture">Foto Profil</label>
                            <input type="file" class="form-control {{$errors->first('picture') ? 'is-invalid' : ''}}" name="picture" id="picture">
                            <span class="error invalid-feedback">{{$errors->first('picture')}}</span>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Upload Foto Identitas anda
                                </span>
                            </div>
                        </div>
                        <br>

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