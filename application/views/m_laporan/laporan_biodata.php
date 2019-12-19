<!DOCTYPE html>
<html>
<head>
  <title>Biodata Pengguna</title>
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

  <!-- <img src="logo_horizontal.png" alt="" style="margin-top:-5px" class="user-avatar-md rounded-circle"> &nbsp; &nbsp;  -->
  <?php
  setlocale(LC_ALL, 'IND');
  ?>
  <div style="font-size:24px">
    <span style="text-size:20px;text-align:center">MeetU</span>
  </div>
  <span style="font-size:12px;margin-bottom: 8px;text-align:center">Temukan Cinta yang Sebenarnya </span>
  <hr>
  <br>
  <span style="text-size:18px;margin-bottom: 8px;text-align:center">Biodata Pengguna</span>
	<div id="outtable" style="margin-top: 20px">
	  <table style="border-color:black">
      <tbody>
        <tr>
          <td style="width:150px" class="border-0">Email</td>
          <td class="border-0" style="width : 450px"><?= $data->email ?></td>
        </tr>
        <tr>
          <td style="width:150px" class="border-0">Nama Panjang</td>
          <td class="border-0"><?= $data->nama ?></td>
        </tr>
        <tr>
          <td style="width:150px" class="border-0">Jenis Kelamin</td>
          <td class="border-0"><?= $data->jenis_kelamin ?></td>
        </tr>
        <tr>
          <td style="width:150px" class="border-0">Tanggal Lahir</td>
          <td class="border-0 w-100"><?php
            $timestamp = strtotime($data->tgl_lahir);
            echo date('m/d/Y', $timestamp)
          ?></td>
        </tr>
        <tr>
          <td style="width:150px" class="border-0">Fakultas</td>
          <td class="border-0"><?= $data->fakultas ?></td>
        </tr>
        <tr>
          <td style="width:150px" class="border-0">Alamat Asal</td>
          <td class="border-0"><?= $data->alamat_asal ?></td>
        </tr>
        <tr>
          <td style="width:150px" class="border-0">Alamat Tinggal</td>
          <td class="border-0"><?= $data->alamat_tinggal ?></td>
        </tr>
        <tr>
          <td style="width:150px" class="border-0">Status</td>
          <td class="border-0"><?= $data->nama_status ?></td>
        </tr>
        <tr>
          <td style="width:150px" class="border-0">Nomor WA</td>
          <td class="border-0"><?= $data->no_wa ?></td>
        </tr>
      </tbody>
	  </table>
	 </div>
   <div style="width:700px;text-align:right;;margin-top:20px">
     BeRes Application, <?= strftime('%d %B %Y') ?>
     <br><br><br><br>
     Aulia Diah Pratiwi, S. Pd. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   </div>
</body>
</html>
