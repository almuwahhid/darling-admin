<div class="dashboard-ecommerce" style="
    min-height: 565px;">
  <div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h2 class="pageheader-title">Laporan Tahunan </h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('laporan'); ?>" class="breadcrumb-link">Laporan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan Tahunan</li>
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
            <h5 class="card-header">Pilih Tahun</h5>
            <form action="<?=base_url('laporan')?>" method="post">
            <select class="form-control" id="sel1" name="year">

              <?php
              foreach ($data['year'] as $k => $year) { ?>
                <option <?php if($year == $data['selectedyear']) echo 'selected="selected"';?> name="" ><?= $year ?></option>
                <input type="submit" href="#" class="centerHorizontal btn btn-primary" value="Tampilkan"></a>
                <?php }?>
            </select>
            </form>
            <a href="<?= base_url()."laporan?tahun=".$data['selectedyear']; ?>" class="btn btn-brand">Cetak</>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table">
                  <thead class="bg-light">
                    <tr class="border-0">
                      <th class="border-0 centerHorizontal" style="width:20px">No</th>
                      <th class="border-0">Kode Booking</th>
                      <th class="border-0">Nama Penyewa</th>
                      <th class="border-0">Merk Mobil</th>
                      <th class="border-0">Tanggal Sewa</th>
                      <th class="border-0">Tanggal Kembali</th>
                      <th class="border-0">Biaya</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($data['booking'] as $k => $booking) { ?>
                      <tr>
                        <td class="centerHorizontal text-center">
                          <?= ++$no;?>
                        </td>
                        <td>
                          <?= $booking->kode_booking ?>
                        </td>
                        <td>
                          <?= $booking->nama_lengkap ?>
                        </td>
                        <td>
                          <?= $booking->merk ?>
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
                      </tr>
                      <?php }?>
                  </tbody>
                </table>
              </div>
            </div>
            <a href="<?= base_url()."laporan/detailTahunan?tahun=".$data['selectedyear']; ?>" class="btn btn-brand">Cetak</>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
