<div class="dashboard-ecommerce">
  <div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h2 class="pageheader-title">Tambah Kendaraan </h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Kendaraan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Kendaraan</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- end pageheader  -->
    <!-- ============================================================== -->
    <div class="ecommerce-widget">
      <div class="row">
        <!-- ============================================================== -->

        <!-- ============================================================== -->

        <!-- recent orders  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="card">
            <h5 class="card-header">Masukkan seluruh data dengan benar!</h5>
            <?php
                  if(($this->session->flashdata('alert')) !== null){
                      $message = $this->session->flashdata('alert');
                      $this->load->view('bodyview/alert', ['class' => $message['class'], 'message' => $message['message']]);
                  }
              ?>

            <div class="card-body">
              <form action="<?=base_url('kendaraan/simpan')?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id_kendaraan" value="<?= $data['kendaraan']->id_kendaraan ?>">
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Merk Kendaraan</label>
                  <input required name="merk" id="inputText3" type="text" class="form-control" value="<?= $data['kendaraan']->merk ?>">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Model</label>
                  <select class="form-control" id="sel1" name="model">
                    <?php
                    foreach ($data['model'] as $k => $tipe) {
                    ?>
                    <option <?php if($tipe->id_model == $data['kendaraan']->id_model) echo 'selected="selected"'; ?> value="<?= $tipe->id_model?>"><?= $tipe->nama_model?></option>
                  <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Plat Nomor</label>
                  <input required name="plat_nomor" id="inputText3" type="text" class="form-control" value="<?= $data['kendaraan']->plat_nomor ?>">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Tipe</label>
                  <input required name="tipe" id="inputText3" type="text" class="form-control" value="<?= $data['kendaraan']->tipe ?>">
                </div>

                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Tahun Pembuatan</label>
                  <input required id="datepicker" name="tahun_pembuatan" id="inputText3" type="text" class="form-control" value="<?= $data['kendaraan']->tahun_pembuatan ?>">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Isi Silinder</label>
                  <input required name="isi_silinder" id="inputText3" type="text" class="form-control" value="<?= $data['kendaraan']->isi_silinder ?>">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Nomor Rangka</label>
                  <input required name="nomor_rangka" id="inputText3" type="text" class="form-control" value="<?= $data['kendaraan']->nomor_rangka ?>">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Nomor Mesin</label>
                  <input required name="nomor_mesin" id="inputText3" type="text" class="form-control" value="<?= $data['kendaraan']->nomor_mesin ?>">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Tarif Kendaraan per hari</label>
                  <input required name="tarif" type="text" class="uang form-control" value="<?= $data['kendaraan']->tarif ?>">
                </div>
                <div class="custom-file mb-3">
                  <input type="submit" href="#" class="centerHorizontal btn btn-primary" value="UPDATE"></a>
                </div>
              </form>
            </div>
          </div>
        </div>

          <!-- ini gambarnya -->
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="card">
            <h5 class="card-header">Foto - foto Kendaraan</h5>
            <div class="card-body">
              <div class="w-100">
                <?php
                foreach ($data['album'] as $k => $img) {
                ?>
                    <div class="col-md-2" style="float:left">
                      <div class="w-100 heightRect bayang layout-img-icon bg" style="background-image: url('<?= base_url()."datas/".$img -> photo ?>');">
                        <div class="pointer heightParent widthParent layout-hapus" onclick="redirect('<?= base_url()?>kendaraan/deletefoto?id_kendaraan=<?= $img->id_kendaraan?>&id=<?php echo $img->id_album; ?>')">
                          <div class="col-md-12 tengah-text" style="padding-top:60px"><b>HAPUS</b></div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
              </div>
              <!-- <?php echo form_open_multipart('kendaraan/simpanphoto');?> -->
              <form action="<?= base_url('kendaraan/simpanphoto')?>" method="post" enctype="multipart/form-data">
                <input name="id_kendaraan" type="hidden" class="form-control" value="<?php echo $data['id_kendaraan'];  ?>">
                <div class="custom-file mb-3" style="margin-top:20px">
                  <input name="photo" type="file" class="custom-file-input" id="customFile">
                  <label class="custom-file-label" for="customFile" style="text-align:center">Klik untuk memilih gambar kendaraan</label>
                </div>
                <div class="custom-file mb-3">
                  <input type="submit" href="#" class="col-xl-4 centerHorizontal btn btn-primary" value="Tambahkan gambar"></a>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
