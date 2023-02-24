<!-- DataTales Example -->
<div class="card shadow mb-5">
    <div class="card-header py-3">
    
<div class="p-3">
<div class="row row-cols-1 row-cols-md-3 g-4 pt-3">
  <?php

      echo '
      <div class="card">
        <img src="'.base_url('img/').$detailaduan[0]['foto'].'" class="card-img-top" alt="foto">
        <div class="card-body">
          <h5 class="card-title">Laporan dari : '.$detailaduan[0]['nama'].' </h5>
          <p class="card-text">'.$detailaduan[0]['isi_laporan'].'</p>
          <p class="card-text">
          <form method="POST" action="'.base_url('petugas/ubahstatus/').$detailaduan[0]['id_pengaduan'].'">
          <div class="row g-5 align-items-center">
          <div class="col-auto">
            <label for="status" class="col-form-label">Status</label>
          </div>
          <div class="col-auto">
          <select name="status" id="status" class="form-select">
          <option value="0"'; if($detailaduan[0]['status']=='0') {echo "selected";} echo'>Menunggu</option>
          <option value="proses"'; if($detailaduan[0]['status']=='proses') {echo "selected";} echo '>Proses</option>
          <option value="selesai"'; if($detailaduan[0]['status']=='selesai') {echo "selected";} echo'>Selesai</option>
          </select>
          </div>
          <div class="col-auto">
          <button type="submit" class="btn btn-sm btn-primary">ubah status </button>
          </div>
        </div>
          </form>
          </p>
      </div>
  </div>';

    ?>
  </div>
  </div>
</div>
</div>