<!-- DataTales Example -->
<div class="card shadow mb-5">
    <div class="card-header py-3">
    
<div class="p-3">
<div class="row row-cols-1 row-cols-md-3 g-4 pt-3">
  <?php
  validation_errors();
  if($detailaduan[0]['status']=='0'){
    $status='menunggu';
  }else{
    $status=$detailaduan[0]['status'];
  }

      echo '
      <div class="card">
        <img src="'.base_url('img/').$detailaduan[0]['foto'].'" class="card-img-top" alt="foto">
        <div class="card-body">
          <h5 class="card-title">Laporan dari : '.$detailaduan[0]['nama'].' </h5>
          <p class="card-text">'.$detailaduan[0]['isi_laporan'].'</p>
          <p class="card-text">Status : '.$status.'</p></div>';
          foreach($tanggapan as $tgp){
            echo'<div class="card-footer">
          <p>'.$tgp['tgl_tanggapan'].'</p>
          <p>'.$tgp['tanggapan'].'</p>
          </div>';
          }
        echo'<div class="footer">
        <form action="'.base_url('petugas/tambahtanggapan/').$detailaduan[0]['id_pengaduan'].'" method="POST">
        <div class="form-floating">
        <textarea class="form-control" id="tanggapan" name="tanggapan" required></textarea>
        <label for="tanggapan">Tanggapan Petugas</label>
        <button type="submit" class="btn btn-sm btn-primary mb-3 mt-3 float-end">Kirim</button>
        </div>
        </form>
        </div>';

      echo'</div>';
  

    ?>
  </div>
  </div>
</div>
</div>