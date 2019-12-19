<div class="dashboard-ecommerce" style="min-height: 760px;">
  <div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h2 class="pageheader-title">Daftar Survey Penguna </h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <!-- <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('wisata') ?>" class="breadcrumb-link">Wisata</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Survey Pengguna</li>
              </ol>
            </nav>
          </div> -->
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
            <h5 class="card-header">Daftar Pengguna</h5>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table">
                  <thead class="bg-light">
                    <tr class="border-0">
                      <th class="border-0 centerHorizontal" style="width:20px">No</th>
                      <th class="border-0">Email</th>
                      <th class="border-0">Nama</th>
                      <th class="border-0">Jenis Kelamin</th>
                      <th class="border-0">Alamat Tinggal</th>
                      <th class="border-0">Status</th>
                      <th class="border-0">Nomor WA</th>
                      <th class="border-0">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 0;
                    foreach ($data['user'] as $k => $user) { ?>
                      <tr>
                        <td class="centerHorizontal text-center">
                          <?= ++$no;?>
                        </td>
                        <td>
                          <?= $user->email ?>
                        </td>
                        <td>
                          <?= $user->nama ?>
                        </td>
                        <td>
                          <?= $user->jenis_kelamin ?>
                        </td>
                        <td>
                          <?= $user->alamat_tinggal ?>
                        </td>
                        <td>
                          <?= $user->nama_status ?>
                        </td>
                        <td>
                          <?= $user->no_wa ?>
                        </td>
                        <td>
                          <a href='<?= base_url()."survey/detail/".$user->id_user; ?>'>
                            <i class="fas fa-search"></i>
                          </a> &nbsp;&nbsp;
                          <!-- <a href="#" onclick="redirect('<?= base_url()."/wisata/delete?id=".$wisata->id_wisata; ?>')">
                            <i class="fas fa-trash"></i>
                          </a> -->
                        </td>
                      </tr>
                      <?php }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- <div class="col-md-12">
          <nav aria-label="Page navigation">
            <ul class="pagination">
              <?php
              if($data['jumlah']>1){
                for($i=1;$i<=$data['jumlah'];$i++){
                  if(isset($data['page'])){
                    if($data['page']==$i){
                      echo '<li class="page-item active"><a class="page-link">'.$i.'</a></li>';
                    }else{
                      echo "<li class='page-item'><a class='page-link' href='?p=".$i."'>".$i."</a></li>";
                    }
                  }else{
                    if($i==1){
                      echo '<li class="active page-item"><a class="page-link">'.$i.'</a></li>';
                    }else{
                      echo "<li class='page-item'><a class='page-link' href='?p=".$i."'>".$i."</a></li>";
                    }
                  }
                }
              }
              ?>
            </ul>
          </nav>
        </div> -->

      </div>
    </div>


  </div>
</div>
