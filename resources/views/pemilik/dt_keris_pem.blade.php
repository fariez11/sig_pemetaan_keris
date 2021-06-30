@extends('layout.laymilik')

@section('content')
    
    <section class="content">
        <div class="container-fluid">
                <?php
                    $id = Session::get('AKUN');
                    $pro = DB::SELECT("SELECT*FROM keris k, det_keris d,pemiliks p where k.KERIS_ID = d.DETAIL_ID and d.PEMILIK_ID = p.PEMILIK_ID and p.AKUN_ID = '$id'");
                ?>
                @if($pro==null)
                <center>
                    <button type="button" class="btn btn-success btijo" style="margin-bottom: 10px;" data-toggle="modal" data-target="#addker"><i class="fa fa-plus-circle"></i> Tambah Keris</button>
                </center>    
                @else


                <center>
                <?php
                    $id = Session::get('AKUN');
                    $pro = DB::SELECT("SELECT*FROM keris k, det_keris d,pemiliks p where k.KERIS_ID = d.DETAIL_ID and d.PEMILIK_ID = p.PEMILIK_ID and p.AKUN_ID = '$id'");
                ?>
                @foreach($pro as $fil)
                <div class="col-md-8">
                    <div class="card card-primary card-outline">
                      <div class="card-body col-md-12">
                        <div style="width: 100%;display: inline-flex;">
                        <img src="images/{{$fil->FOTO}}" width="220" height="330" style="margin-left: 10px;margin-right: 70px;">
                            <style type="text/css">
                                tr {
                                    border-bottom: 1px solid #CCC;
                                }
                                tr td{
                                    padding: 8px;
                                }
                            </style>
                           <table style="display: inline-grid;width: 100%;">
                            <tr>
                                <td style="width: 150px"><b>NAMA</b></td>
                                <td style="width: 210px;text-align: right;">{{$fil->NAMA}}</td>
                            </tr>
                            <tr>
                                <td><b>JENIS</b></td>
                                <td style="text-align: right;">{{$fil->JENIS}}</td>
                            </tr>
                            <tr>
                                <td><b>NAMA PEMILIK</b></td>
                                <td style="text-align: right;">{{$fil->NAMA_LENGKAP}}</td>
                            </tr>
                            <tr>
                                <td><b>GENDER PEMILIK</b></td>
                                <td style="text-align: right;">{{$fil->GENDER}}</td>
                            </tr>
                            <tr>
                                <td><b>KECAMATAN</b></td>
                                <td style="text-align: right;">{{$fil->KECAMATAN}}</td>
                            </tr>
                            <tr>
                                <td><b>ALAMAT</b></td>
                                <td style="text-align: right;">{{$fil->ALAMAT}}</td>
                            </tr>
                            <tr>
                                <td><b>EMAIL</b></td>
                                <td style="text-align: right;">{{$fil->EMAIL}}</td>
                            </tr>
                            <tr>
                                <td><b>NO TELP</b></td>
                                <td style="text-align: right;">{{$fil->NO_TELP}}</td>
                            </tr>
                        </table>
                        </div>

                        <br>
                        <br>
                         <a href="#"class="btn btn-warning" data-toggle="modal" data-target="#editker{{$fil->KERIS_ID}}"><i class="fa fa-pencil"></i></a>
                        <a href="/pker:hapus={{$fil->KERIS_ID}}" class="btn btn-danger" onclick="return(confirm('Anda Yakin ?'));"><i class="fa fa-trash"></i></a></td>
                      </div>
                       
                    </div>
                </div>
                @endforeach
            </center>
            @endif

        </div>
    </section>
              
        <div class="modal fade" id="addker" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="border-radius: 10px;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Tambah Keris</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{url('/act_tmb_pker')}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{csrf_field()}}
                            <style type="text/css">
                                td{
                                    padding: 5px;
                                }
                            </style>
                                <table>
                                    
                                    <tr>                            
                                        <td><b></td>
                                        <td></td>
                                        <td width="277">
                                          <?php 
                                            $idk = DB::select("select*from keris order by KERIS_ID DESC limit 1")
                                          ?>
                                          @if($idk==null)
                                                <input type="hidden" class="form-control" name="id_ker" value="1" required="" readonly="">
                                          @else
                                              @foreach($idk as $da)
                                                <input type="hidden" class="form-control" name="id_ker" value="{{$da->KERIS_ID+1}}" required="" readonly="">
                                              @endforeach
                                          @endif
                                        </td>
                                        <td class="jarak"></td>
                                        <td style="width: 120px"><b></td>
                                        <td></td>
                                        <td width="277">
                                            <input type="hidden" name="nam" value="{{Session::get('AKUN')}}">
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
                    <form action="/act_ed_pker={{$ed->KERIS_ID}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{csrf_field()}}
                            <style type="text/css">
                                .r{
                                    border-bottom: 0px;
                                }
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
                                    <tr class="r">                            
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
                                    <tr class="r">                            
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
                                    <tr class="r">                         
                                        <td><b>KECAMATAN</td>
                                        <td>:</td>
                                        <td width="277"><input class="form-control" name="kec" value="{{$edit->KECAMATAN}}" autocomplete="off" required=""></td>
                                        <td class="jarak"></td>
                                        <td><b>ALAMAT</td>
                                        <td>:</td>
                                        <td width="277"><input class="form-control" name="alam" value="{{$edit->ALAMAT}}" autocomplete="off" required=""></td>
                                    </tr>
                                    <tr class="r">
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
        
        <div class="modal fade" id="map" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="border-radius:10px;width: 1080px;margin-left:-150px;margin-top: -15px;margin-bottom: -15px;">
                     <div id="googleMap" style="width:100%;height:510px;"></div>

                    <div class="modal-footer">
                         <button type="button" class="btn btn-info btn-block" data-dismiss="modal"><i class="fa fa-check-circle"></i> Selesai</button>
                    </div>

                </div>
            </div>
        </div>

    </div>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD9qrkGVP3Udc6Jd9KteihJQ-bnr1nd2M4" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>

<script>

var marker; 
function taruhMarker(peta, posisiTitik){
    if( marker ){
      // pindahkan marker
      marker.setPosition(posisiTitik);
    } else {
      // buat marker baru
      marker = new google.maps.Marker({
        position: posisiTitik,
        map: peta
      });
    }
    document.getElementById("lat").value = posisiTitik.lat();
    document.getElementById("lng").value = posisiTitik.lng();
    document.getElementById("elat").value = posisiTitik.lat();
    document.getElementById("elng").value = posisiTitik.lng();
}

function initialize() {
  var propertiPeta = {
    center:new google.maps.LatLng(-7.8232397,112.1907122),
    zoom:12,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  
  var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
  
  // even listner ketika peta diklik
  google.maps.event.addListener(peta, 'click', function(event) {
    taruhMarker(this, event.latLng);
  });
}  
google.maps.event.addDomListener(window, 'load', initialize);

    function previewImage() {
    document.getElementById("image-preview").style.display = "inline";
    var oFReader = new FileReader();
     oFReader.readAsDataURL(document.getElementById("image-source").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview").src = oFREvent.target.result;
        };
      };
</script>
@endsection