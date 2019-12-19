<div class="dashboard-ecommerce" style="
    min-height: 565px;">
  <div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h2 class="pageheader-title">Laporan Bulanan </h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('laporan'); ?>" class="breadcrumb-link">Laporan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan Bulanan</li>
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
          <div class="card">
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table">
                  <thead class="bg-light">
                    <tr class="border-0">
                      <th class="border-0">Bulan</th>
                      <th style="width:100px" class="text-center border-0">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($data as $k => $datas) { ?>
                      <tr>
                        <td colspan="2">
                          &nbsp;&nbsp;&nbsp;&nbsp;<b><?= $datas['tahun'] ?></b>
                        </td>
                      </tr>
                        <?php
                        foreach ($datas['datas'] as $k => $bulan) { ?>
                          <tr>
                            <td>
                              <?= date('F', mktime(0, 0, 0, $bulan->bulan, 10)); ?>
                            </td>
                            <td class="text-center">
                              <a class="btn btn-success" target="_blank" href='<?= base_url()."/laporan/detail_laporan_bulanan?tahun=".$datas['tahun']."&bulan=".$bulan->bulan; ?>'>
                                <i class="fas fa-print"></i>
                              </a>
                            </td>
                          </tr>
                      <?php }?>
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
