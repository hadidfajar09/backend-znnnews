@extends('layouts.bootstrap')

@section('title')
Home
@endsection

@section('content')
   
            <div class="row">
              <div class="col-md-12">
                  
                <div class="">
                    <h3>Preview</h3>
                  <hr>
                  <div class="x_content">
                    <div class="row">
                      <div class="animated flipInY col-lg-4 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-users"></i>
                          </div>
                          <div class="count">
                              {{ $kolumnis }}
                          </div>
                          <h3>Kolumnis</h3>
                          <p>User yang dapat mengelola Berita</p>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-4 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-table"></i>
                          </div>
                          <div class="count">
                            {{ $category }}
                          </div>

                          <h3>Kategori</h3>
                          <p>Jumlah Kategori</p>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-4 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-bar-chart-o"></i>
                          </div>
                          <div class="count">
                            {{ $News }}
                          </div>

                          <h3>Berita</h3>
                          <p>Jumlah Berita</p>
                        </div>
                      </div>
                      
                    </div>
                    
                    <br />
                    
                  </div>
                </div>
              </div>
            </div>
        
        

  
@endsection