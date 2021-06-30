@extends('layout.layadmin')

@section('content') 

<section class="content">
    <div class="container-fluid">

    	<div id="map-canvas" style="width: 100%; height: 500px;margin-bottom: 10px;"></div>
    	<center>
    		<a href="/data_keris" class="btn btn-danger"><!-- <i class="fa fa-back"></i> --> BACK</a>
    	</center>
    </div>
</section>

@endsection

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD9qrkGVP3Udc6Jd9KteihJQ-bnr1nd2M4"></script>
    <script type="text/javascript">
    var marker;
      function initialize() {
          
        // Variabel untuk menyimpan informasi (desc)
        var infoWindow = new google.maps.InfoWindow;
        
        //  Variabel untuk menyimpan peta Roadmap
        var mapOptions = {
          mapTypeId: google.maps.MapTypeId.ROADMAP
        } 
        
        // Pembuatan petanya
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
              
        // Variabel untuk menyimpan batas kordinat
        var bounds = new google.maps.LatLngBounds();

        // Pengambilan data dari database
        <?php
            foreach($data as $dat)
            {
                $nama = $dat->NAMA;
                $kec = $dat->KECAMATAN;
                $nam = $dat->NAMA_LENGKAP;
                $jen = $dat->JENIS;
                $ala = $dat->ALAMAT;
                $no = $dat->NO_TELP;
                $lat = $dat->LATITUDE;
                $lon = $dat->LONGITUDE;
                $gam = $dat->FOTO;             

                echo ("addMarker($lat, $lon, '<center><img src=images/$gam width=100 ></center><br><table><tr><td>NAMA</td><td>:</td><td>$nama</td></tr><tr><td>JENIS</td><td>:</td><td>$jen</td></tr><tr><td>NAMA PEMILIK</td><td>:</td><td>$nam</td></tr><tr><td>KECAMATAN</td><td>:</td><td>$kec</td></tr><tr><td>ALAMAT</td><td>:</td><td>$ala</td></tr><tr><td>NO TELP</td><td>:</td><td>$no</td></tr></table>');\n");         
            }
          ?>

        function addMarker(lat, lng, info) {
            var lokasi = new google.maps.LatLng(lat, lng);
            bounds.extend(lokasi);
            var marker = new google.maps.Marker({
                map: map,
                position: lokasi
            });       
            map.fitBounds(bounds);
            bindInfoWindow(marker, map, infoWindow, info);
         }
        
        // Menampilkan informasi pada masing-masing marker yang diklik
        function bindInfoWindow(marker, map, infoWindow, html) {
          google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(map, marker);
          });
        }
 
        }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>