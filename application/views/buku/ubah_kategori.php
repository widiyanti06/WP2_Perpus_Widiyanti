<div class="container-fluid">
    <h3>Edit Kategori</h3>
    <hr>
    <br>
    <form method="post" action="<?= base_url('buku/proses_ubah_data');?>">
        <input type="hidden" name="id_kategori" value="<?= $kategori['id_kategori'];?>">
        <div class="form-group row">
            <label for="nama_kategori" class="col-sm-2 col-form-label">Nama Kategori</label> 
            <div class="col-sm-5"> 
                <input type="text" class="form-control"  name="nama_kategori" value="<?= $kategori['nama_kategori']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="kategori" class="col-sm-2 col-form-label"></label> 
            <div class="col-sm-5">
                <button type="submit" class="btn btn-info"><i class="fas fa-check"></i> Ubah</button> 
                <button class="btn btn-secondary"><i class="fas fa-ban"></i> Close</button>
            </div>
        </div>
    </form>
</div>