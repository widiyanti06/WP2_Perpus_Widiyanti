<?php
defined('BASEPATH') or exit('No durect script access allowed');
class ModelBuku extends CI_Model
{
    public function getBuku()
    {
        return $this->db->get('buku');
    }
    public function bukuWhere($where)
    {
        return $this->db->get_where('buku', $where);
    }
    public function simpanBuku($data = null)
    {
        $this->db->insert('buku', $data);
    }
    public function updateBuku($data = null, $where = null)
    {
        $this->db->update('buku', $data, $where);
    }
    public function hapusBuku($where = null)
    {
        $this->db->delete('buku', $where);
    }
    public function total($field, $where)
    {
        $this->db->select_sum($field);
        if(!empty($where) && count($where) > 0){
            $this->db->where($where);
        }
        $this->db->from('buku');
        return $this->db->get()->row($field);
    }

    public function getKategori()
    {
        return $this->db->get('kategori');
    }
    public function kategoriWhere($where)
    {
        return $this->db->get_where('kategori', $where);
    }
    public function simpanKategori($data = null)
    {
        $this->db->insert('kategori', $data);
    }
    public function hapusKategori($where = null)
    {
        $this->db->delete('kategori', $where);
    }
    public function updateKategori($where = null, $data = null)
    {
        $this->db->update('kategori', $data, $where);
    }
    public function joinKategoriBuku($where)
    {
        $this->db->select('buku.id_kategori,kategori.nama_kategori');
        $this->db->from('buku');
        $this->db->join('kategori','kategori.id_kategori=buku.id_kategori');
        $this->db->where($where);
        return $this->db->get();
    }

    public function ubah_data($id_kategori)
    {
        return $this->db->get_where('kategori', ['id_kategori' => $id_kategori])->row_array();
    }

    public function proses_ubah_data()
    {
        $data = [
            'nama_kategori' =>$this->input->post('nama_kategori'),
        ];

        $this->db->where('id_kategori', $this->input->post('id_kategori'));
        $this->db->update('kategori', $data);
    }

    public function edit_buku($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_buku($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function tambah_buku($data, $table)
    {
        $this->db->insert($table, $data);
    }
}
?>