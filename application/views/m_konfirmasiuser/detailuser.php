<div class="dashboard-ecommerce">
  <div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h2 class="pageheader-title"><?= $data->nama_lengkap ?> </h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('user') ?>" class="breadcrumb-link">User</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $data->nama_lengkap ?></li>
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
            <h5 class="card-header">Detail!</h5>
            <div class="card-body">
              <table class="table">
                <tbody>
                  <tr>
                    <th scope="col">Email</th>
                    <td><?= $data->username ?></td>

                  </tr>
                  <tr>
                    <th scope="col">Nama Lengkap</th>
                    <td><?= $data->nama_lengkap ?></td>
                  </tr>
                  <tr>

                    <th scope="col">Nomor KTP</th>
                    <td><?= $data->no_ktp ?></td>

                  </tr>
                  <tr>
                    <th scope="col">Alamat</th>
                    <td><?= $data->alamat ?></td>

                  </tr>
                  <tr>
                    <th scope="col">Telp</th>
                    <td><?= $data->telp ?></td>

                  </tr>
                  <tr>
                    <th scope="col">Pekerjaan</th>
                    <td><?= $data->pekerjaan ?></td>

                  </tr>
                  <tr>
                    <th scope="col">Instansi</th>
                    <td><?= $data->instansi ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
