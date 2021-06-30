@extends('layout.layadmin')

@section('content') 

<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data pemilik</h3>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-success btijo" style="margin-bottom: 10px;" data-toggle="modal" data-target="#addker"><i class="fa fa-plus-circle"></i> Tambah pemilik</button>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>NAMA </th>
                  <th>GENDER</th>
                  <th>NO_TELP</th>
                  <th>EMAIL</th>
                  <th>ACTION</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $pem)
                <tr>
                  <td style="text-align:center;">{{$pem->PEMILIK_ID}}</td>
                  <td>{{$pem->NAMA_LENGKAP}}</td>
                  <td>{{$pem->GENDER}}</td>
                  <td>{{$pem->NO_TELP}}</td>
                  <td>{{$pem->EMAIL}}</td>
                  <td style="width: 90px;">
                        <a href="#"class="btn btn-warning" data-toggle="modal" data-target="#editpem{{$pem->PEMILIK_ID}}"><i class="fa fa-pencil"></i></a>
                        <a href="/pem:hapus={{$pem->PEMILIK_ID}}" class="btn btn-danger" onclick="return(confirm('Anda Yakin ?'));"><i class="fa fa-trash"></i></a></td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
        </div>

        <div class="modal fade" id="addker" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content" style="border-radius: 10px;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Tambah pemilik</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{url('/act_tmb_pem')}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{csrf_field()}}
                            <style type="text/css">
                                td{
                                    padding: 5px;
                                }
                            </style>
                                <table>
                                    <tr>                            
                                        <td><b>ID PEMILIK</td>
                                        <td>:</td>
                                        <td width="277">
                                          <?php 
                                            $idk = DB::select("select*from pemiliks order by PEMILIK_ID DESC limit 1")
                                          ?>
                                          @if($idk==null)
                                                <input class="form-control" name="id_pem" value="1" required="" readonly="">
                                          @else
                                              @foreach($idk as $da)
                                                <input class="form-control" name="id_pem" value="{{$da->PEMILIK_ID+1}}" required="" readonly="">
                                              @endforeach
                                          @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 120px"><b>NAMA PEMILIK</td>
                                        <td>:</td>
                                        <td width="277"><input class="form-control" name="nama" placeholder="nama pemilik" autocomplete="off" required=""></td>
                                    </tr>
                                    <tr>                         
                                        <td><b>GENDER</b></td>
                                        <td>:</td>
                                        <td>
                                            <input  type="radio" name="gen" <?php if (isset($gender) && $gender=="L") echo "checked";?> value="L" style="width: 15px;height: 15px;" required>Laki-Laki&nbsp&nbsp
                                            <input type="radio" name="gen" <?php if (isset($gender) && $gender=="P") echo "checked";?> value="P" style="width: 15px;height: 15px;">Perempuan
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>NO TELP</td>
                                        <td>:</td>
                                        <td width="277"><input type="text" class="form-control" name="no" required="" maxlength="16" placeholder="no telp" autocomplete="off"></td>
                                    </tr>
                                    <tr>
                                        <td><b>EMAIL</td>
                                        <td>:</td>
                                        <td width="277"><input type="text" class="form-control" name="email" required="" placeholder="email" autocomplete="off"></td>
                                    </tr>
                                    <tr>
                                        <td><b>USERNAME</td>
                                        <td>:</td>
                                        <td width="277"><input type="text" class="form-control" name="user" required="" maxlength="16" placeholder="username" autocomplete="off"></td>
                                    </tr>
                                    <tr>
                                        <td><b>PASSWORD</td>
                                        <td>:</td>
                                        <td width="277"><input type="password" class="form-control" name="pass" required="" maxlength="16" placeholder="password" autocomplete="off"></td>
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
        <div class="modal fade" id="editpem<?= $ed->PEMILIK_ID?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content" style="border-radius: 10px;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Edit Pemilik</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/act_ed_pem={{$ed->PEMILIK_ID}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{csrf_field()}}
                            <style type="text/css">
                                td{
                                    padding: 5px;
                                }
                            </style>
                            <?php
                              $id = $ed->PEMILIK_ID;
                              $edit = DB::SELECT("select*from pemiliks p, akuns a where p.AKUN_ID = a.AKUN_ID AND p.PEMILIK_ID = '$id'");                       
                            ?>
                            @foreach($edit as $key)
                                <table>
                                    <tr>                            
                                        <td><b>ID PEMILIK</td>
                                        <td>:</td>
                                        <td width="277">
                                                <input class="form-control" name="id_pem" value="{{$key->PEMILIK_ID}}" required="" readonly="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 120px"><b>NAMA PEMILIK</td>
                                        <td>:</td>
                                        <td width="277"><input class="form-control" name="namp" value="{{$key->NAMA_LENGKAP}}" autocomplete="off" required=""></td>
                                    </tr>
                                    <tr>                         
                                        <td><b>GENDER</b></td>
                                        <td>:</td>
                                        <td>
                                            <input  type="radio" name="gender" <?php if (isset($gender) && $gender=="L") echo "checked";?> value="L" style="width: 15px;height: 15px;" required>Laki-Laki &nbsp&nbsp
                                            <input type="radio" name="gender" <?php if (isset($gender) && $gender=="P") echo "checked";?> value="P" style="width: 15px;height: 15px;">Perempuan
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>NO TELP</td>
                                        <td>:</td>
                                        <td width="277"><input type="text" class="form-control" name="no"maxlength="16" value="{{$key->NO_TELP}}" autocomplete="off"></td>
                                    </tr>
                                    <tr>
                                        <td><b>EMAIL</td>
                                        <td>:</td>
                                        <td width="277"><input type="text" class="form-control" name="email" value="{{$key->EMAIL}}" placeholder="email" autocomplete="off"></td>
                                    </tr>
                                    <tr>
                                        <td><b>USERNAME</td>
                                        <td>:</td>
                                        <td width="277"><input type="text" class="form-control" name="user" value="{{$key->USERNAME}}" autocomplete="off"></td>
                                    </tr>
                                    <tr>
                                        <td><b>PASSWORD</td>
                                        <td>:</td>
                                        <td width="277"><input type="text" class="form-control" name="pass" value="{{$key->PASSWORD}}" autocomplete="off"></td>
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

<script>
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