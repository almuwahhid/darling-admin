<div class="dashboard-ecommerce">
  <div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h2 class="pageheader-title">Mengubah Password </h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url()?>" class="breadcrumb-link">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ubah Password</li>
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
            <h5 class="card-header">Ubah password dibawah ini!</h5>
            <?php
                  if(($this->session->flashdata('alert')) !== null){
                      $message = $this->session->flashdata('alert');
                      $this->load->view('bodyview/alert', ['class' => $message['class'], 'message' => $message['message']]);
                  }
              ?>
            <div class="card-body">
              <form action="<?=base_url('admin/ubah')?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="tambah">
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Password saat ini</label>
                  <input required name="password" id="inputText3" type="password" class="form-control"/>
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Password baru</label>
                  <input required name="password_baru" id="inputText3" type="password" class="form-control"/>
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Ulangi password baru</label>
                  <input required name="ulangi_password" id="inputText3" type="password" class="form-control">
                </div>
                <div class="custom-file mb-3">
                  <input type="submit" href="#" class="centerHorizontal btn btn-primary" value="Ubah password"></a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
