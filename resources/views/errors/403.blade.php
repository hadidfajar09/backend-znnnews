@extends('layouts.bootstrap')

@section('title')
    Error 403
@endsection

@section('content')
<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- page content -->
        <div class="col-md-12">
          <div class="col-middle">
            <div class="text-center text-center">
              <h1 class="error-number">403</h1>
              <h2>Access denied</h2>
              <p>Pastikan anda mendapatkan izin akses ke menu ini! 
              </p>
              <div class="mid_center">
                
                  <div class="  form-group pull-middle top_search">
                      
                      <span class="input-group-btn">
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">Home</a>
                        
                          </span>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
      </div>
    </div>
</body>
@endsection