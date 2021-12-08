<div class="container-fluid">
    
    <form method="post" action="<?php base_url('buku/ubahKategori');?>">
        <div class="form-group row">
            <label for="namakategori" class="col-sm-2 col-form-label">Nama Kategori</label>
            <div class="col-sm-30">
                <input type="text" class="form-control" value="<?= $kategori['nama_kategori']?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="namakategori" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-30">
                <button type="submit" class="btn btn-info">Ubah</button>
                <button class="btn btn-danger" onclick="window.history.go(-1)">Kembali</button>
            </div>
        </div>
    </form>
</div>