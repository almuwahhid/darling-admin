<div class="dashboard-ecommerce" style="min-height: 760px;">
  <div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h2 class="pageheader-title">Task Intervensi </h2>
          <p class="pageheader-text">Task Intervensi.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('survey') ?>" class="breadcrumb-link">Survey</a></li>
                <li class="breadcrumb-item">
                  <a href="<?= base_url('survey/detail/'.$data['id_user']) ?>" class="breadcrumb-link">Detail</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  <a href="<?= base_url('survey/pertanyaan/'.$data['id_survey'])."?id_user=".$data['id_user']; ?>" class="breadcrumb-link"><?= $data['tanggal_survey'] ?></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Task Intervensi
                </li>
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
            <h5 class="card-header">Detail Task Intervensi</h5>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table">
                  <thead class="bg-light">
                    <tr class="border-0">
                      <th class="border-0">Pertanyaan</th>
                      <th class="border-0"><?= $data['detail']->intervensi_task ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="border-0">
                      <td class="border-0">Tanggal Task Intervensi</td>
                      <td class="border-0"><?= $data['detail']->tanggal_task ?></td>
                    </tr>
                    <tr class="border-0">
                      <td class="border-0">Jawaban</td>
                      <td class="border-0"><?php
                      if($data['detail']->status_task == "Y")
                        echo "Ya";
                      else
                        echo "Tidak";
                      ?></td>
                    </tr>
                    <?php
                    if($data['detail']->status_task == "T"){
                      ?>
                      <tr class="border-0">
                        <td class="border-0">Alasan</td>
                        <td class="border-0"><?= $data['detail']->komentar_pertanyaan ?></td>
                      </tr>
                      <?php
                    }
                     ?>
                     <tr class="border-0">
                       <td class="border-0">Dengan siapa dia mendiskusikan hal tersebut?</td>
                       <td class="border-0"><?= $data['detail']->keterangan ?></td>
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
</div>
