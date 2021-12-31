<div class="container-fluid">
    <h3><i class="fas fa-edit"></i>Ubah Data Buku</h3>
    <hr>
    <?php foreach($buku as $m): ?>
        <form method="post" action="<?php echo base_url(). 'buku/proses_ubah_buku'; ?>" enctype="multipart/form-data">
            <div class="form-group col-4">
                <label>Judul Buku</label>
                <input type="hidden" class="form-control" name="id" value="<?php echo $m->id?>">
                <input type="text" class="form-control" name="judul_buku" value="<?php echo $m->judul_buku ?>">
            </div>
            <div class="form-group col-4">
                <label>Kategori</label>
                <select name="kategori" class="form-control"> 
                    <option value="">Pilih Kategori</option> 
                    <?php $k = ['Sains','Hobby','Komputer','Komunikasi','Hukum','Agama','Populer','Bahasa','Komik']; 
                        for ($i=0;$i<9;$i++) { ?> 
                        <option value="<?= $k[$i];?>"><?= $k[$i];?></option> 
                    <?php } ?> 
                </select>
            </div>
            <div class="form-group col-4">
                <label>Pengarang</label>
                <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?php echo $m->pengarang ?>"> 
            </div> 
            <div class="form-group col-4">
                <label>Penerbit</label>
                <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?php echo $m->penerbit ?>"> 
            </div> 
            <div class="form-group col-4">
                <label>Tahun</label>
                <input type="text" class="form-control" id="tahun_terbit" name="penerbit" value="<?php echo $m->tahun_terbit ?>"> 
            </div> 
            <div class="form-group col-4">
                <label>ISBN</label> 
                <input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo $m->isbn ?>"> 
            </div> 
            <div class="form-group col-4">
                <label>Stok</label>
                <input type="text" class="form-control" id="stok" name="stok" value="<?php echo $m->stok ?>"> 
            </div> 
            <div class="form-group col-4">
                <label>Gambar</label> 
                <input type="file" class="form-control" id="image" name="image" value="<?php echo $m->image ?>"> 
            </div> 
            <div class="form-group col-4">
                <button type="submit" class="btn btn-primary btn-sm-3">Simpan <i class="fas fa-check"></i></button>
            </div>
        </form>
    <?php endforeach; ?>
</div>