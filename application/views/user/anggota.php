<!-- Begin Page Content --> 
<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>  
    <div class="row">
        <div class="col-lg-12">
        <a href=""></a> 
            <table class="table table-border"> 
                <thead> 
                    <tr>
                        <th scope="col">Nama Anggota</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tanggal Bergabung</th>
                        <th scope="col">Pilihan</th>
                    </tr>
                </thead> 
                <tbody> 
                    <?php 
                        $a = 1; 
                        foreach ($anggota as $b){ ?> 
                    <tr>
                        <td><?= $b['nama']; ?></td>
                        <td><?= $b['email']; ?></td>
                        <td><?= date('d F Y', $b['tanggal_input']); ?></td>
                        <td>
                            <a href="<?= base_url('buku/ubah_user/').$b['id'];?>" class="badge badge-info"><i class="fas fa-edit"></i> Edit</a> 
                            <a href="<?= base_url('buku/hapus_user/').$b['id'];?>" onclick="return confirm('Kamu yakin akan menghapus <?= $judul.' '.$b['nama'];?> ?');" class="badge badge-danger"><i class="fas fa-trash"></i> Hapus</a> 
                        </td> 
                    </tr> 
                    <?php } ?> 
                </tbody> 
            </table> 
        </div> 
    </div>
</div>

<!-- Modal Tambah montir baru--> 
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true"> 
    <div class="modal-dialog" role="document"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <h5 class="modal-title" id="tambahModalLabel">Form Tambah Montir</h5> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                    <span aria-hidden="true">&times;</span> 
                </button> 
            </div>
            <form action="<?= base_url('user/tambah_anggota'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Anggota</label>
                        <input type="text" class="form-control" id="nama" name="nama"></input>
                        <?= form_error('nama','<small class="text-danger pl-3">', '</small>'); ?> 
                    </div>
                    <div class="form-group">
                        <label>Tempat, Tanggal Lahir</label>
                        <input type="text" class="form-control" id="ttl" name="ttl"></input>
                        <?= form_error('ttl','<small class="text-danger pl-3">', '</small>'); ?> 
                    </div>
                    <div class="form-group">
                        <label>Umur</label>
                        <input type="text" class="form-control" id="umur" name="umur"></input>
                        <?= form_error('umur','<small class="text-danger pl-3">', '</small>'); ?> 
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" class="form-control" id="image" name="image"></input>
                        <?= form_error('image','<small class="text-danger pl-3">', '</small>'); ?> 
                    </div>
                </div>
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button> 
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </form>
        </div> 
    </div> 
</div> 
<!-- End of Modal Tambah Mneu --> 