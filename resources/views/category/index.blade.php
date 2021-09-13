@extends('layouts.bootstrap')

@section('title')
    Kategori
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Data Kategori</h3>
        </div>
        <div class="card-body table-responsive">
            @include('alert.success')
            <a href="{{ route('category.create') }}" class="btn btn-outline-secondary " role="button" aria-pressed="true">Tambah</a>

            <hr>
            <div class="row">
                <div class="col-3">
                    <a class="btn btn-success" href="{{ route('category.index') }}">Semua</a>
                    <a class="btn btn-outline-success" href="{{ route('category.recycle') }}">Recycle</a>
                </div>
            </div>
            <hr>
            <table class="table table-bordered">
		<thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Gambar</th>
                    <th>Alat</th>
                </tr>
		</thead>
                <tbody>
                    @foreach ($category as $row)
                    <tr>
                        <td>{{ $loop->iteration + ($category->perPage() * ($category->currentPage() - 1)  )  }}</td>
                        <td>{{ $row->name }}</td>
                        <td><img class="img-circle" src="{{ asset('uploads/'.$row->picture) }}" width="100px"></td>
                        <td>
                            <h5>
                            <a href="{{ route('category.edit',[$row->id]) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                            <form class="d-inline" action="{{ route('category.destroy',[$row->id]) }}" method="post" onsubmit="return confirm('Delete Kategori Ini ke dalam Recycle?')">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input type="submit" class="btn btn-dark btn-sm" value="Recycle" />
                            </form>
                        </h5>
                        </td>
                    </tr>        
                    @endforeach
                
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $category->appends(Request::all())->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection