<!DOCTYPE html>
<html>
<head>
  <title>Report Table</title>
  <style type="text/css">
    #outtable{
      padding: 20px;
      border:1px solid #e3e3e3;
      width:650px;
      border-radius: 5px;
    }
    .short{

    }

    table{
      font-family: arial;
      color:#5E5B5C;

    }
    thead th{
      text-align: left;
      padding: 10px;
    }
    tbody td{
      border-top: 1px solid #e3e3e3;
      padding: 10px;
    }
    tbody tr:nth-child(even){
      background: #F6F5FA;
    }
    tr{
      font-size: 12px;
    }
    tbody tr:hover{
      background: #EAE9F5
    }
    .text-center{
      text-align: : center
    }
  </style>
</head>
<body>
  <!-- In production server. If you choose this, then comment the local server and uncomment this one-->
  <!-- <img src="<?php // echo $_SERVER['DOCUMENT_ROOT']."/media/dist/img/no-signal.png"; ?>" alt=""> -->
  <!-- In your local server -->

  <!-- <img src="<?php echo base_url('assets/images/logo.png')?>" alt="" style="height:30px;width:30px;margin-top:-5px" class="user-avatar-md rounded-circle"> &nbsp; &nbsp;  -->
  <?php
  setlocale(LC_ALL, 'IND');
  ?>

  <h2 style="text-align:center">Laporan Tahun <?= $data['tahun'] ?></h2>
	<div id="outtable">
	  <table style="border-color:black">
	  	<thead>
	  		<tr>
	  			<th class="short" style="text-align:center">No</th>
	  			<th class="normal" style="text-align:center">Kode Booking</th>
	  			<th class="normal" style="text-align:center">Nama Penyewa</th>
	  			<th class="normal" style="text-align:center">Merk Mobil</th>
	  			<th class="normal" style="text-align:center">Tanggal Sewa</th>
	  			<th class="normal" style="text-align:center">Tanggal Kembali</th>
	  			<th class="normal" style="text-align:center">Biaya</th>
	  		</tr>
	  	</thead>
	  	<tbody>
	  		<?php $no=1; ?>
        <?php foreach($data['tahunan'] as $k => $data_tahunan): ?>
          <tr >
            <td style="text-align:center" colspan="7"><b><?php echo date('F', mktime(0, 0, 0, $data_tahunan['bulan']->bulan, 10)); ?></b></td>
          </tr>
          <?php foreach($data_tahunan['datas'] as $booking): ?>
  	  		  <tr>
              <td style="text-align:center" class="centerHorizontal text-center">
                <?= $no;?>
              </td>
              <td style="text-align:center">
                <?= $booking->kode_booking ?>
              </td>
              <td>
                <?= $booking->nama_lengkap ?>
              </td>
              <td style="text-align:center">
                <?= $booking->merk ?>
              </td>
              <td>
                <?php
                  $timestamp = strtotime($booking->begin_date);
                  echo date('m/d/Y H:i:s', $timestamp)
                ?>
              </td>
              <td>
                <?php
                $timestamp = strtotime($booking->due_date);
                echo date('m/d/Y H:i:s', $timestamp)
                 ?>
              </td>
              <td>
                Rp. <?= number_format($booking->biaya,2,',','.') ?>
              </td>
  	  		  </tr>
  	  		<?php $no++; ?>
  	  		<?php endforeach; ?>
        <?php endforeach; ?>
	  	</tbody>
	  </table>
	 </div>
   <div style="width:700px;text-align:center;margin-top:20px">
     Persewaan Kendaraan, <?= strftime('%d %B %Y') ?>
     <br><br><br><br>
     Admin
   </div>
</body>
</html>
