<?php
function tanggal($tanggal){
  $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $pecahkan = explode('-', $tanggal);
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Laporan Survey Pengguna</title>
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
      border: 1px solid #e3e3e3;
    }
    .withborder td{
      border-bottom: 1px solid #e3e3e3;
      border-right: 1px solid #e3e3e3;
      padding: 10px;
    }
    .number{
      border-left: 1px solid #e3e3e3;
    }
    .bottom_border{
      border-bottom: 1px solid #e3e3e3;
    }
    tbody td{
      padding: 10px;
    }
    .withborder tr:nth-child(even){
      background: #F6F5FA;
    }
    tr{
      font-size: 12px;
    }
    .withbotder tr:hover{
      background: #EAE9F5
    }
    .text-center{
      text-align: : center
    }
    @print{
      @page :footer {color: #fff }
      @page :header {color: #fff}
    }
  </style>

  <script src="<?php echo base_url('assets/vendor/jquery/jquery-3.3.1.min.js')?>"></script>
  <!-- <script src="<?php echo base_url('assets/js/highcharts.js')?>"></script> -->
  <script src="http://code.highcharts.com/highcharts.js"></script>
  <script src="http://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/rgbcolor@^1/index.js"></script>
  <!-- Optional if you want blur -->
  <script src="https://cdn.jsdelivr.net/npm/stackblur-canvas@^1/dist/stackblur.min.js"></script>
  <!-- Main canvg code -->
  <script src="https://cdn.jsdelivr.net/npm/canvg/dist/browser/canvg.min.js"></script>

  <?php
    /* Mengambil query report*/
    foreach($data['grafik'] as $result){
        $tanggal[] = $result->tanggal_survey; //ambil bulan
        $value[] = (float) $result->nilai; //ambil nilai
    }
    /* end mengambil query*/

?>

  <script type="text/javascript">
  $(function () {
    var x = $('#report').highcharts({
      chart: {
        type: 'column',
        margin: 75,
        options3d: {
          enabled: false,
          alpha: 10,
          beta: 25,
          depth: 70
        }
      },
      title: {
        text: 'Grafik Survey',
        style: {
          fontSize: '18px',
          fontFamily: 'Verdana, sans-serif'
        }
      },
      subtitle: {
        text: 'Darling',
        style: {
          fontSize: '15px',
          fontFamily: 'Verdana, sans-serif'
        }
      },
      plotOptions: {
        column: {
          depth: 25
        }
      },
      credits: {
        enabled: false
      },
      xAxis: {
        categories:  <?php echo json_encode($tanggal);?>
      },
      exporting: {
        enabled: false
      },
      yAxis: {
        title: {
          text: 'Jumlah'
        },
      },
      tooltip: {
        formatter: function() {
          return 'The value for <b>' + this.x + '</b> is <b>' + Highcharts.numberFormat(this.y,0) + '</b>, in '+ this.series.name;
        }
      },
      plotOptions: {
        line: {
          animation: false
        }
      },
      series: [{
        name: 'Report Data',
        data: <?php echo json_encode($value);?>,
        shadow : true,
        dataLabels: {
          enabled: true,
          color: '#e3e3e3',
          align: 'center',
          formatter: function() {
            return Highcharts.numberFormat(this.y, 0);
          }, // one decimal
          y: 0, // 10 pixels down from the top
          style: {
            fontSize: '13px',
            fontFamily: 'Verdana, sans-serif'
          }
        }
      }]
    });

    // exportChart(x);
  });
  function exportChart(x) {
    console.log("exporting SVG");
    var svg = canvg(document.getElementById('canvas'), getSVG(x), {
      //ignoreDimensions: true
    });
  }

  function getSVG(x) {
    var chart = $('#report').highcharts();
    var svg = chart.getSVG();
    return svg;
  }
</script>

</head>
<body>
  <!-- In production server. If you choose this, then comment the local server and uncomment this one-->
  <!-- <img src="<?php // echo $_SERVER['DOCUMENT_ROOT']."/media/dist/img/no-signal.png"; ?>" alt=""> -->
  <!-- In your local server -->

  <!-- <img src="logo_horizontal.png" alt="" style="margin-top:-5px" class="user-avatar-md rounded-circle"> &nbsp; &nbsp;  -->
  <?php
  setlocale(LC_ALL, 'IND');
  ?>
  <div style="width:100%;position:absolute">
    <img style="height: 45px;float:left;margin-right:12px" src="<?php echo base_url('assets/images/logo.png'); ?>" alt="">
    <div style="float:left">
      <div style="font-size:18px">
        <span style="text-size:20px;text-align:center">MeetU</span>
      </div>
      <span style="font-size:12px;margin-bottom: 8px;text-align:center">TEMUKAN CINTA YANG SEBENARNYA</span>
    </div>
  </div>
  <div style="width:100%;position:relative;padding-top:50px">
    <hr>
    <br>
    <span style="text-size:12px;margin-bottom: 8px;text-align:center">A. Biodata Pengguna</span>
    <div style="margin-top: 20px;margin-left:10px">
      <table style="border-color:black">
        <tbody>
          <tr>
            <td style="width:150px" class="border-0">Email</td>
            <td style="width:2px">:</td>
            <td class="border-0" style="width : 450px"><?= $data['user']->email ?></td>
          </tr>
          <tr>
            <td style="width:150px" class="border-0">Nama Panjang</td>
            <td style="width:2px">:</td>
            <td class="border-0"><?= $data['user']->nama ?></td>
          </tr>
          <tr>
            <td style="width:150px" class="border-0">Jenis Kelamin</td>
            <td style="width:2px">:</td>
            <td class="border-0"><?= $data['user']->jenis_kelamin ?></td>
          </tr>
          <tr>
            <td style="width:150px" class="border-0">Tanggal Lahir</td>
            <td style="width:2px">:</td>
            <td class="border-0 w-100"><?php
            $timestamp = strtotime($data['user']->tgl_lahir);
            // echo date('m/d/Y', $timestamp)
            echo tanggal($data['user']->tgl_lahir);
            ?></td>
          </tr>
          <tr>
            <td style="width:150px" class="border-0">Fakultas</td>
            <td style="width:2px">:</td>
            <td class="border-0"><?= $data['user']->fakultas ?></td>
          </tr>
          <tr>
            <td style="width:150px" class="border-0">Alamat Asal</td>
            <td style="width:2px">:</td>
            <td class="border-0"><?= $data['user']->alamat_asal ?></td>
          </tr>
          <tr>
            <td style="width:150px" class="border-0">Alamat Tinggal</td>
            <td style="width:2px">:</td>
            <td class="border-0"><?= $data['user']->alamat_tinggal ?></td>
          </tr>
          <tr>
            <td style="width:150px" class="border-0">Status</td>
            <td style="width:2px">:</td>
            <td class="border-0"><?= $data['user']->nama_status ?></td>
          </tr>
          <tr>
            <td style="width:150px" class="border-0">Nomor WA</td>
            <td style="width:2px">:</td>
            <td class="border-0"><?= $data['user']->no_wa ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

   <br/><br/><br/><br/>
   <span style="text-size:12px;margin-bottom: 8px;text-align:center">B. Hasil Survey</span>
   <div id="outtable" style="margin-top: 20px;margin-left:10px">
 	  <table style="border-color:black">
      <thead class="withborder">
	  		<tr>
	  			<th class="short number" style="text-align:center">No</th>
	  			<th class="normal" style="text-align:center">Tanggal Survey</th>
	  			<th class="normal" style="text-align:center">Eksplorasi</th>
          <th class="normal" style="text-align:center">Komitmen</th>
	  			<th class="normal" style="text-align:center">Hasil Survey</th>
          <th class="normal" style="text-align:center">Deskripsi</th>
	  		</tr>
	  	</thead>
       <tbody class="withborder">
         <?php $no=1; ?>
         <?php foreach($data['survey'] as $datas): ?>
           <tr>
             <td style="text-align:center" class="number centerHorizontal text-center">
               <?= $no;?>
             </td>
             <td>
               <?php
                 $timestamp = strtotime($datas->tanggal_survey);
                 echo date('m/d/Y H:i:s', $timestamp)
               ?>
             </td>
             <?php foreach($datas->identitas_survey as $x): ?>
               <td style="text-align:center">
                 <?= $x->score ?>
               </td>
             <?php endforeach; ?>

             <td>
               <?= $datas->nama_status ?>
             </td>
             <td>
               <?= $datas->deskripsi_status ?>
             </td>
           </tr>
         <?php $no++; ?>
         <?php endforeach; ?>
       </tbody>
 	  </table>
 	 </div>

   <br/><br/><br/><br/>
   <span style="text-size:12px;margin-bottom: 8px;text-align:center">C. Grafik Survey</span>
   <div id="outtable" style="margin-top: 20px;margin-left:10px">
 	  <div id="report">

    </div>
    <!-- <canvas id="canvas" style="width: 100%; height: 300px; margin: 0 auto; border:1px solid blue;"></canvas> -->
 	 </div>
   <br/><br/><br/><br/>
   <div style="width:700px;text-align:right;;margin-top:20px">
     <!-- RIDE Application, <?= strftime('%d %B %Y') ?> -->
     Darling, <?= tanggal(date('Y-m-d')) ?>
     <br><br><br><br>
     Me, S.Kom. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   </div>
</body>

<script>
  setTimeout(myFunction, 1000);
  function myFunction(){
    print();
    // close();
    // open(location, '_self').close();
    // window.onafterprint = window.close();
  }
</script>
</html>
