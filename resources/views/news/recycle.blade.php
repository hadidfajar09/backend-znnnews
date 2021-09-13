@extends('layouts.bootstrap')

@section('title')
Recycle Berita  
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-secondary">
            <div class="card-header">
                <h3>Recycle Berita    
                </h3>
            </div>
            <div class="card-body table-responsive">
                @include('alert.success')
                <br>

               


                <hr>
                <form method="get" action="{{ route('users.index') }}">
                    <div class="row col-6">
                        <b>Cari Berita : </b>
                        <br> 
                        <div class="col-3">
                            <input type="text" placeholder="Cari Berita .." value="{{ Request::get('keyword') }}" name="keyword" id="keyword">
                        </div>

                        <div class="col-4">
                            <input type="submit" value="Search">
                        </div>

                        
                            <a class="btn btn-outline-success" href="{{ route('news.index') }}">Semua</a>
                            <a class="btn btn-success" href="{{ route('news.recycle') }}">Recycle</a>
                        
                    </div>

                    
                </form>

                

           
            <hr>

                </form>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Kolumnis</th>
                            <th>Redaksi</th>
                            <th>Author</th>
                            <th>Judul</th>
                            <th>Url</th>
                            <th>Rilis</th>
                            <th>Alat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($news as $row)
                        <tr>
                            <td>{{ $loop->iteration + ($news->perPage() * ($news->currentPage() - 1)  )  }}</td>
                            <td>{{ $row->category->name }}</td>
                            <td>{{ $row->user->name }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->author }}</td>
                            <td>{{ $row->title }}</td>
                            <td>{{ $row->url }}</td>
                            <td>{{ $row->publishedAt }}</td>
                            <td>
                                <h5>
                                    <a href="{{ route('news.restore',[$row->id]) }}" class="btn btn-outline-secondary btn-sm">Restore</a>
                                    <form class="d-inline" action="{{ route('news.delete',[$row->id]) }}" method="post" onsubmit="return confirm('Delete Permanen Berita Ini?')">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <input type="submit" class="btn btn-dark btn-sm" value="Delete Permanen" />
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
                {{ $news->appends(Request::all())->links() }}

            </div>
        </div>
    </div>
</div>
@endsection