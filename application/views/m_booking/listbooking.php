<div class="dashboard-ecommerce" style="
    min-height: 565px;">
  <div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h2 class="pageheader-title">Daftar Booking </h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('booking'); ?>" class="breadcrumb-link">Booking</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Booking</li>
              </ol>
              <div class="col-md-12" style="position:absolute; padding-right: 50px">
                <button id="btn_search" class="btn btn-danger" style="float:right">Cari Booking</button>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="ecommerce-widget">
      <div class="row">
        <!-- ============================================================== -->

        <!-- ============================================================== -->

        <!-- recent orders  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="card">
            <h5 class="card-header">Booking kendaraan yang masuk</h5>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table">
                  <thead class="bg-light">
                    <tr class="border-0">
                      <th class="border-0 centerHorizontal" style="width:20px">No</th>
                      <th class="border-0">Nama Penyewa</th>
                      <th class="border-0">Kode Booking</th>
                      <th class="border-0">Tanggal Sewa</th>
                      <th class="border-0">Tanggal Kembali</th>
                      <th class="border-0">Biaya</th>
                      <th class="border-0">Status</th>
                      <th class="border-0 text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(isset($data['page'])){
                      $no = $data['page']*4-4;
                    } else {
                      $no = 0;
                    }
                    foreach ($data['booking'] as $k => $booking) { ?>
                      <tr>
                        <td class="centerHorizontal text-center">
                          <?= ++$no;?>
                        </td>
                        <td>
                          <?= $booking->nama_lengkap ?>
                        </td>
                        <td>
                          <?= $booking->kode_booking ?>
                        </td>
                        <td>
                          <?= $booking->begin_date ?>
                        </td>
                        <td>
                          <?= $booking->due_date ?>
                        </td>
                        <td>
                          Rp. <?= number_format($booking->biaya,2,',','.') ?>
                        </td>
                        <td>
                          <?php
                          $s = 0;
                            if($booking->confirmed == "Y"){
                              if($booking->deleted_at != ""){
                                echo "Dibatalkan";
                              } else {
                                echo "Diterima";
                              }
                            } else {
                              if($booking->deleted_at != ""){
                                echo "Ditolak";
                              } else {
                                echo "Belum dikonfirmasi";
                              }
                            }
                           ?>
                        </td>
                        <td class="text-center">
                          <a class="btn btn-success" href="<?= base_url()."booking/detail/".$booking->id_booking; ?>">
                            <i class="fas fa-search"></i>
                          </a> &nbsp;&nbsp;
                          <?php
                            if($booking->deleted_at == "" && $booking->confirmed == "N"){
                              ?>
                              <a href="#" class="btn btn-brand" onclick="redirectMessage('<?= base_url()."booking/konfirmasi?id=".$booking->id_booking."&status=1"; ?>', 'Apakah Anda yakin ingin mengkonfirmasi booking ini')">
                                konfirmasi
                              </a>&nbsp;&nbsp;
                              <a href="#" class="btn btn-danger" onclick="redirectMessage('<?= base_url()."booking/konfirmasi?id=".$booking->id_booking."&status=2"; ?>', 'Apakah Anda yakin ingin menolak booking ini')">
                                Tolak
                              </a>
                              <?php
                            }
                          ?>
                        </td>
                      </tr>
                      <?php }?>
                  </tbody>
                </table>
              </div>
              <div class="col-md-12">
                <nav aria-label="Page navigation">
                  <ul class="pagination">
                    <?php
                    if($data['jumlah']>1){
                      for($i=1;$i<=$data['jumlah'];$i++){
                        if(isset($data['page'])){
                          if($data['page']==$i){
                            echo '<li class="page-item active"><a class="page-link">'.$i.'</a></li>';
                          }else{
                            echo "<li class='page-item'><a class='page-link' href='?p=".$i."'>".$i."</a></li>";
                          }
                        }else{
                          if($i==1){
                            echo '<li class="active page-item"><a class="page-link">'.$i.'</a></li>';
                          }else{
                            echo "<li class='page-item'><a class='page-link' href='?p=".$i."'>".$i."</a></li>";
                          }
                        }
                      }
                    }
                    ?>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="popup-booking" class="w-60 popup centerVerticalWindow centerHorizontalWindow pad10-l-r" style="display:none;box-shadow: 0px 0.01px 8px #636968">
      <div class="row">
        <div class="bar-container col-md-10" style="margin-top:20px">
          <input style="width:350px;display:inline;height:45px; margin-right:-5px" id="input-search" class="form-control" type="text" name="" value="" placeholder="Tulis kode booking disini"/>
          <input id="url" type="hidden" value="<?= base_url('api/booking/searchbookingAll'); ?>"/>
          <input id="url2" type="hidden" value="<?= base_url(); ?>"/>
          <button id="btn_search_booking" class="btn btn-success"><i class="fas fa-search"></i></button>
        </div>
        <div class="col-md-2">
          <button id="btn_close" class="btn btn-info" style="float:right"><i class="fas fa-window-close"></i></button>
        </div>
        <div class="col-md-12">
          <table class="table" style="overflow: scroll;">
            <thead>
              <tr class="border-0">
                <th class="border-0 centerHorizontal" style="width:20px">No</th>
                <th class="border-0">Nama Penyewa</th>
                <th class="border-0">Kode Booking</th>
                <th class="border-0">Tanggal Sewa</th>
                <th class="border-0">Tanggal Kembali</th>
                <th class="border-0">Biaya</th>
                <th class="border-0">Status</th>
                <th class="border-0 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody id="table-search">
            </tbody>
          </table>
        </div>
      </div>
      <span style="position:absolute;display:none" class="centerHorizontal centerVertical" id="loading">
        Tunggu dulu...
      </span>
    </div>

  </div>
</div>

<script>
$(function() {
  $('#btn_search').click(function(){
    $('#popup-booking').show();
    removeData();
    $('#input-search').val("")
  });
  $('#btn_close').click(function(){
    $('#popup-booking').hide();
  });
  $('#btn_search_booking').click(function(){
    if($('#input-search').val()==""){
      alert("Isi terlebih dahulu kode booking")
    } else {
        searchBooking($('#input-search').val());
    }
  });
});

function searchBooking(keyword){
  var url = $("#url").val() + "?kode_booking="+keyword;
  console.log("url "+ url);
  $.ajax({
    method: "GET",
    beforeSend: function() {
      $("#loading").html("Tunggu dulu...")
      $("#loading").show();
    },
    url: url
  }).done(function(result) {
    $("#loading").hide();
    removeData();
    this.datas = JSON.parse(result);
    console.log(this.datas.status+" hii ok");
    console.log(result);
    if(this.datas.status == 200){
      appendData(this.datas.data);
    } else {
      $("#loading").html("Data tidak ditemukan...")
      $("#loading").show();
    }
    console.log(result);
  });
}

function konfirmasi(data){
  var konfirmasi = "";
  console.log("iki loo "+data);
  if(data.delete == "" && data.confirmed == "N"){
    konfirmasi = '<a href="#" class="btn btn-brand" onclick="'+redirectMessage($("#url2").val()+'booking/konfirmasi?id='+data.id_booking+'&status=1', 'Apakah Anda yakin ingin mengkonfirmasi booking ini')+'">'+
      'konfirmasi'+
    '</a>&nbsp;&nbsp;'+
    '<a href="#" class="btn btn-danger" onclick="'+redirectMessage($("#url2").val()+'booking/konfirmasi?id='+data.id_booking+'&status=2', 'Apakah Anda yakin ingin menolak booking ini')+'">'+
      'Tolak'+
    '</a>';
  }
  return konfirmasi;
}

function appendData(result){
  // if(result.terdekat == true){
  //   var header = '<h6 class="header-title">'+result.nama+' / Jarak : '+result.jarak+' km</h6>';
  //   $("#"+id).append(header);
  // }

  var dibatalkan = "";
  if(result.confirmed == "Y"){
    if(result.delete != ""){
      dibatalkan = "Dibatalkan";
    } else {
      dibatalkan = "Diterima";
    }
  } else {
    if(result.delete != ""){
      dibatalkan =  "Ditolak";
    } else {
      dibatalkan = "Belum dikonfirmasi";
    }
  }
  var component = '<tr>'+
    '<td class="centerHorizontal text-center">'+
      1+
    '</td>'+
    '<td>'+
      result.nama_lengkap+
    '</td>'+
    '<td>'+
      result.kode_booking+
    '</td>'+
    '<td>'+
      result.begin_date+
    '</td>'+
    '<td>'+
      result.due_date+
    '</td>'+
    '<td>Rp. '+
      result.biaya+
    '</td>'+
    '<td>'+
      dibatalkan+
    '</td>'+
    '<td class="text-center">'+
      '<a class="btn btn-success" href="'+$("#url2").val()+'booking/detail/'+result.id_booking+'">'+
        '<i class="fas fa-search"></i>'+
      '</a> &nbsp;&nbsp;'+
      konfirmasi(result)+
    '</td>'+
  '</tr>';
  $("#table-search").append(component);

}

function removeData(){
  $("#table-search").empty();
}
</script>
