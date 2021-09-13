@extends('layouts.bootstrap')

@section('title')
Users
@endsection


@section('content')

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Data Users</h3>
            </div>
            <div class="card-body table-responsive">
                @include('alert.success')
                <br>

                @if(Request::get('keyword'))
                <a href="{{ route('users.index') }}" class="btn btn-outline-dark " role="button" aria-pressed="true">Kembali</a>
                @else
                <a href="{{ route('users.create') }}" class="btn btn-outline-secondary " role="button" aria-pressed="true">Tambah</a>
                @endif


                <hr>
                <form method="get" action="{{ route('users.index') }}">
                    <div class="row col-6">
                        <b>Cari Data User : </b>
                        <br>
                        <div class="col-3">
                            <input type="text" placeholder="Cari Nama .." value="{{ Request::get('keyword') }}" name="keyword" id="keyword">
                        </div>

                        <div class="col-3">
                            <input type="submit" value="Search">
                        </div>
                    </div>
                </form>

                <br />
                <hr>

                </form>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Sebagai</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Nomor HP</th>
                            <th>Foto</th>
                            <th>Alat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $row)
                        <tr>
                            <td>{{ $loop->iteration + ($users->perPage() * ($users->currentPage() - 1)  )  }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->fungsi }}</td>
                            <td>{{ $row->kelamin }}</td>
                            <td>{{ $row->alamat }}</td>
                            <td>{{ $row->nomer }}</td>
                            <td><img class="img-circle" src="{{ asset('uploads/'.$row->picture) }}" width="100px"></td>
                            <td>
                                <h5>
                                    <a href="{{ route('users.edit',[$row->id]) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                                    <form class="d-inline" action="{{ route('users.destroy',[$row->id]) }}" method="post" onsubmit="return confirm('Delete User Ini?')">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <input type="submit" class="btn btn-dark btn-sm" value="Delete" />
                                    </form>


                                </h5>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <!-- untuk pagination -->
                {{ $users->appends(Request::all())->links() }}

            </div>
        </div>
    </div>
</div>
@endsection