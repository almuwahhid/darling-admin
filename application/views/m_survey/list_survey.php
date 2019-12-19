<div class="dashboard-ecommerce" style="min-height: 760px;">
  <div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h2 class="pageheader-title">Detail Survey </h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('survey') ?>" class="breadcrumb-link">Survey</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $data['user']->nama ?></li>
              </ol>
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
            <!-- <a target="_blank" href="<?= base_url('laporan/laporansurvey/')."?id_user=".$data['id_user'] ?>" class="btn btn-primary">Download Laporan</a> -->
            <a target="_blank" href="<?= base_url('laporan/laporansurvey/').$data['id_user'] ?>" class="btn btn-primary">Download Laporan</a>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="card">
            <h5 class="card-header">Daftar Survey</h5>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table">
                  <thead class="bg-light">
                    <tr class="border-0">
                      <th class="border-0 centerHorizontal" style="width:20px">No</th>
                      <th class="border-0">Tanggal Survey</th>
                      <th class="border-0 text-center">Eksplorasi</th>
                      <th class="border-0 text-center">Komitmen</th>
                      <th class="border-0">Hasil Survey</th>
                      <!-- <th class="border-0">Deskripsi</th> -->
                      <th class="border-0 centerHorizontal text-center">Detail</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 0;
                    foreach ($data['survey'] as $k => $datas) { ?>
                      <tr>
                        <td class="centerHorizontal text-center">
                          <?= ++$no;?>
                        </td>
                        <td>
                          <?php
                            $timestamp = strtotime($datas->tanggal_survey);
                            echo date('m/d/Y H:i:s', $timestamp)
                          ?>
                        </td>
                        <?php foreach($datas->identitas_survey as $x): ?>
                          <td class="centerHorizontal text-center">
                            <?= $x->score ?>
                          </td>
                        <?php endforeach; ?>
                        <td>
                          <?= $datas->nama_status ?>
                        </td>
                        <td class="centerHorizontal text-center">
                          <a href='<?= base_url()."survey/pertanyaan/".$datas->id_survey."?id_user=".$data['id_user']; ?>'>
                            <i class="fas fa-search"></i>
                          </a> &nbsp;&nbsp;
                        </td>
                      </tr>
                      <?php }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>
