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
                <input type="hidden" name="action" value="tambah">
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Merk Kendaraan</label>
                  <input required name="merk" id="inputText3" type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Model</label>
                  <select class="form-control" id="sel1" name="model">
                    <?php
                    foreach ($data as $k => $tipe) {
                    ?>
                    <option value="<?= $tipe->id_model?>"><?= $tipe->nama_model?></option>
                  <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Plat Nomor</label>
                  <input required name="plat_nomor" id="inputText3" type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Tipe</label>
                  <input required name="tipe" id="inputText3" type="text" class="form-control">
                </div>

                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Tahun Pembuatan</label>
                  <input required id="datepicker" name="tahun_pembuatan" id="inputText3" type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Isi Silinder</label>
                  <input required name="isi_silinder" id="inputText3" type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Nomor Rangka</label>
                  <input required name="nomor_rangka" id="inputText3" type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Nomor Mesin</label>
                  <input required name="nomor_mesin" id="inputText3" type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Tarif Kendaraan per hari</label>
                  <input required name="tarif" id="tarif" type="text" class="uang form-control">
                </div>
                <div class="custom-file mb-3">
                  <input type="submit" href="#" class="centerHorizontal btn btn-primary" value="Tambahkan"></a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
