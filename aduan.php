<!-- DataTales Example -->
<div class="card shadow mb-5">
    <div class="card-header py-3">
      <h2> Welcome <?= $this->session->nama ?></h2>
    
<div class="p-3">
<a href="<?= base_url('masyarakat/form_aduan')?>" class="btn btn-lg btn-primary">Tambah Pengaduan</a>
<div class="row row-cols-1 row-cols-md-3 g-4 pt-3">
  <?php
    foreach ($pengaduan as $data){

      if($data['status']==0){
      $status='Menunggu';
    }else{
      $status=$data['status'];
    }

      echo ' <div class="col">
      <div class="card">
        <img src="'.base_url('img/').$data['foto'].'" class="card-img-top" alt="foto">
        <div class="card-body">
          <h5 class="card-title">Status : '.$status.'</h5>
          <p class="card-text">Laporan : '.$data['isi_laporan'].'</p>
      </div>
      <div class="card-footer">
  <a href="'.base_url('masyarakat/tanggapan/').$data['id_pengaduan'].'" class="btn btn-sm btn-primary float-end">Tanggapan</a>
  </div>
  </div>
  </div>
     

    ';
    }
  ?>

  </div>
  </div>
</div>