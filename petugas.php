<!-- DataTales Example -->
<div class="card shadow mb-5">
    <div class="card-header py-3">

<a href="<?= base_url('petugas/tambahPetugas')?>" class="btn btn-lg btn-primary mb-5">Tambah Petugas</a>

<table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Petugas</th>
                <th>Username</th>
                <th>Telepon</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $no=1;
            foreach ($petugas as $data){

                echo '<tr>
                <td>'.$no.'</td>
                <td>'.$data['nama'].'</td>
                <td>'.$data['username'].'</td>
                <td>'.$data['telp'].'</td>

            </tr>';

            $no++;
            }
            
?>
            </tbody>
    </table>

        </div>
        </div>