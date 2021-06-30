@extends('layout.laymilik')

@section('content') 

<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <?php
        $id = Session::get('AKUN');
          $data = DB::SELECT("SELECT*FROM keris k, det_keris d,pemiliks p where k.KERIS_ID = d.DETAIL_ID and d.PEMILIK_ID = p.PEMILIK_ID and p.AKUN_ID = '$id'");
        ?>
        @foreach($data as $akun)
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>KEC</h3>

                <p>{{$akun->KECAMATAN}}</p>
              </div>
              <div class="icon">
                <i class="fa fa-map-marker"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>ALAMAT</h3>

                <p>{{$akun->ALAMAT}}</p>
              </div>
              <div class="icon">
                <i class="fa fa-map-pin"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>PHONE</h3>

                <p>{{$akun->NO_TELP}}</p>
              </div>
              <div class="icon">
                <i class="fa fa-phone"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>E-MAIL</h3>

                <p>{{$akun->EMAIL}}</p>
              </div>
              <div class="icon">
                <i class="fa fa-at"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
        </div>
        @endforeach
        
      </div>
    </section>

@endsection