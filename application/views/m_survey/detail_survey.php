<div class="dashboard-ecommerce" style="min-height: 760px;">
  <div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h2 class="pageheader-title">Pertanyaan Survey </h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('survey') ?>" class="breadcrumb-link">Survey</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('survey/detail/'.$data['id_user']) ?>" class="breadcrumb-link">Detail</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= explode(" ",$data['survey']->tanggal_survey)[0] ?></li>
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
            <h5 class="card-header">Detail Survey</h5>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table">
                  <thead class="bg-light">
                    <tr class="border-0">
                      <th class="border-0 centerHorizontal" style="width:20px">No</th>
                      <th class="border-0">Pertanyaan</th>
                      <th class="border-0">Jawaban</th>
                      <th class="border-0">Nilai/Skor</th>
                      <th class="border-0">Tugas Intervensi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 0;
                    foreach ($data['detail'] as $k => $datas) { ?>
                      <tr>
                        <td class="centerHorizontal text-center">
                          <?= ++$no;?>
                        </td>
                        <td>
                          <?= $datas->nama_pernyataan ?>
                        </td>
                        <td>
                          <?= $datas->nama_nilai_pertanyaan ?>
                        </td>
                        <td class="centerHorizontal text-center">
                          <?= $datas->nilai_pertanyaan ?>
                        </td>
                        <td class="centerHorizontal text-center">
                          <?php
                          if($datas->tanggal_submit == "0000-00-00 00:00:00"){
                            echo "Belum dikerjakan";
                          } else if($datas->tanggal_submit == "-"){
                            echo "Tidak ada tugas";
                          } else {
                            ?>
                            <a href='<?= base_url()."survey/taskintervensi/".$datas->id_pertanyaan_survey."?id_user=".$data['id_user']; ?>&id_survey=<?= $data['survey']->id_survey?>&tanggal_survey=<?= explode(" ",$data['survey']->tanggal_survey)[0] ?>'>
                              <i class="fas fa-search"></i>
                            </a>
                            <?php
                          }
                           ?>
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
