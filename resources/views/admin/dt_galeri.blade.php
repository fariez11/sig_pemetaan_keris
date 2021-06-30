@extends('layout.layadmin')

@section('content') 

<section class="content">
    <div class="container-fluid">

    	<div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Keris</h3>
            </div>
            <div class="card-body">
            	<button type="button" class="btn btn-success btijo" style="margin-bottom: 10px;" data-toggle="modal" data-target="#addker"><i class="fa fa-plus-circle"></i> Tambah Keris</button>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>NAMA </th>
                  <th>FOTO</th>
                  <th>ACTION</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $ker)
                <tr>
                  <td style="text-align:center;">{{$ker->KERIS_ID}}</td>
                  <td>{{$ker->NAMA}}</td>
                  <td>{{$ker->FOTO}}</td>
                  <td style="width: 180px;">
                        <a href="#"class="btn btn-warning" data-toggle="modal" data-target="#editker{{$ker->KERIS_ID}}"><i class="fa fa-pencil"></i></a>
                        <a href="/ker:hapus={{$ker->KERIS_ID}}" class="btn btn-danger" onclick="return(confirm('Anda Yakin ?'));"><i class="fa fa-trash"></i></a></td>
                </tr>
                @endforeach
                </tbody>
               <!--  <tfoot>
                <tr>
                  <th>ID KERIS </th>
                  <th>NAMA </th>
                  <th>KECAMATAN</th>
                  <th>LONGITUDE</th>
                  <th>LATITUDE</th>
                  <th>ACTION</th>
                </tr>
                </tfoot> -->
              </table>
            </div>
        </div>

      <div class="modal fade" id="addker" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="border-radius: 10px;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Tambah Keris</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{url('/act_tmb_ker')}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{csrf_field()}}
                            <style type="text/css">
                                td{
                                    padding: 5px;
                                }
                            </style>
                                <table>
                                    
                                    <tr>                            
                                        <td><b>ID KERIS</td>
                                        <td>:</td>
                                        <td width="277">
                                          <?php 
                                            $idk = DB::select("select*from keris order by KERIS_ID DESC limit 1")
                                          ?>
                                          @if($idk==null)
                                                <input class="form-control" name="id_ker" value="1" required="" readonly="">
                                          @else
                                              @foreach($idk as $da)
                                                <input class="form-control" name="id_ker" value="{{$da->KERIS_ID+1}}" required="" readonly="">
                                              @endforeach
                                          @endif
                                        </td>
                                        <td class="jarak"></td>
                                        <td style="width: 120px"><b>NAMA PEMILIK</td>
                                        <td>:</td>
                                        <td width="277">
                                            <select class="form-control" name="nam" required="">
                                                <option></option>
                                                <?php 
                                                    $ip = DB::select("select*from pemiliks where PEMILIK_ID not like '1'")
                                                ?>
                                                @foreach($ip as $ipe)
                                                <option value="{{$ipe->PEMILIK_ID}}">{{$ipe->NAMA_LENGKAP}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>                            
                                        <td><b>NAMA</td>
                                        <td>:</td>
                                        <td width="277"><input class="form-control" name="namak" placeholder="nama keris" autocomplete="off" required=""></td>
                                        <td class="jarak"></td>
                                        <td><b>JENIS</td>
                                        <td>:</td>
                                        <td width="277">
                                            <select class="form-control" name="jen" required="">
                                                <option></option>
                                                <option>AGEMAN</option>
                                                <option>TAYUHAN</option>
                                                <option>AKSESORIS</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>                         
                                        <td><b>KECAMATAN</td>
                                        <td>:</td>
                                        <td width="277"><input class="form-control" name="kec" placeholder="kecamatan" autocomplete="off" required=""></td>
                                        <td class="jarak"></td>
                                        <td><b>ALAMAT</td>
                                        <td>:</td>
                                        <td width="277"><input class="form-control" name="alam" placeholder="alamat" autocomplete="off" required=""></td>
                                    </tr>
                                    <tr>
                                        <td><b>MAP</b></td>
                                        <td>:</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btnmap" data-toggle="modal" data-target="#map" style="display: block;">
                                                <i class="fa fa-map"></i> Map
                                            </a>
                                            <input type="hidden" id="lng" name="long">
                                            <input type="hidden" id="lat" name="lati">
                                        </td>
                                        <td class="jarak"></td>
                                        <td><b>GAMBAR</b></td>
                                        <td>:</td>
                                        <td>
                                            <input type="file" class="form-control" name="gam" id="image-source" onchange="previewImage();" style="width: 90%; display: inline;" required="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><img id="image-preview" style="width: 15s0px; height: 150px;"></td>
                                        
                                    </tr>
                                </table>
                          </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Tutup</button>
                        <button class="btn btn-success btijo"><i class="fa fa-check-circle"></i> Simpan</button>
                      </div>

                  </form>
                </div>
            </div>
        </div> 


        @foreach($data as $ed)
        <div class="modal fade" id="editker{{$ed->KERIS_ID}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="border-radius: 10px;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Edit Keris</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/act_ed_ker={{$ed->KERIS_ID}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{csrf_field()}}
                            <style type="text/css">
                                td{
                                    padding: 5px;
                                }
                            </style>
                              <?php
                                $id = $ed->KERIS_ID;
                                $edker = DB::select("SELECT*FROM keris k, det_keris d where k.KERIS_ID = d.DETAIL_ID AND k.KERIS_ID = $id")
                              ?>
                              @foreach($edker as $edit)
                                <table>
                                    <tr>                            
                                        <td><b>ID KERIS</td>
                                        <td>:</td>
                                        <td width="277">
                                        <input class="form-control" name="id_ker" value="{{$edit->KERIS_ID}}" required="" readonly="">
                                        </td>
                                        <td class="jarak"></td>
                                        <td style="width: 120px"><b>NAMA PEMILIK</td>
                                        <td>:</td>
                                        <td width="277"><input class="form-control" name="namap" value="{{$edit->PEMILIK_ID}}" autocomplete="off" required=""></td>
                                    </tr>
                                    <tr>                            
                                        <td><b>NAMA</td>
                                        <td>:</td>
                                        <td width="277"><input class="form-control" name="nama" value="{{$edit->NAMA}}" autocomplete="off" required=""></td>
                                        <td class="jarak"></td>
                                        <td><b>JENIS</td>
                                        <td>:</td>
                                        <td width="277">
                                            <select class="form-control" name="jen">
                                                <option>{{$edit->JENIS}}</option>
                                                <option>AGEMAN</option>
                                                <option>TAYUHAN</option>
                                                <option>AKSESORIS</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>                         
                                        <td><b>KECAMATAN</td>
                                        <td>:</td>
                                        <td width="277"><input class="form-control" name="kec" value="{{$edit->KECAMATAN}}" autocomplete="off" required=""></td>
                                        <td class="jarak"></td>
                                        <td><b>ALAMAT</td>
                                        <td>:</td>
                                        <td width="277"><input class="form-control" name="alam" value="{{$edit->ALAMAT}}" autocomplete="off" required=""></td>
                                    </tr>
                                    <tr>
                                        <td><b>MAP</b></td>
                                        <td>:</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btnmap" data-toggle="modal" data-target="#map" style="display: block;">
                                                <i class="fa fa-map"></i> Map
                                            </a>
                                            <input type="hidden" id="elng" name="long" value="{{$edit->LONGITUDE}}">
                                            <input type="hidden" id="elat" name="lati" value="{{$edit->LATITUDE}}">
                                        </td>
                                        <td class="jarak"></td>
                                        <td><b>GAMBAR</b></td>
                                        <td>:</td>
                                        <td>
                                            <input type="file" class="form-control" name="gam" style="display: inline;" required="">
                                        </td>
                                    </tr>
                                    </tr>
                                </table>
                                @endforeach
                          </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Tutup</button>
                        <button class="btn btn-success btijo"><i class="fa fa-check-circle"></i> Simpan</button>
                      </div>

                  </form>
                </div>
            </div>
        </div> 
        @endforeach
      
 	</div>
</section>


@endsection