<?php

class Buku extends CI_Controller
{
    public function __construct() 
    { 
        parent::__construct();
        cek_login();
    }

    public function index() 
    { 
        $data['judul'] = 'Data Buku'; 
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(); 
        $data['buku'] = $this->ModelBuku->getBuku()->result_array();
        $data['kategori'] = $this->ModelBuku->getKategori()->result_array();
        
        $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required|min_length[3]', [ 
            'required' => 'Judul Buku harus diisi', 
            'min_length' => 'Judul buku terlalu pendek' 
        ]); 
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [ 
            'required' => 'Nama pengarang harus diisi', 
        ]); 
        $this->form_validation->set_rules('pengarang', 'Nama Pengarang', 'required|min_length[3]', [ 
            'required' => 'Nama pengarang harus diisi', 
            'min_length' => 'Nama pengarang terlalu pendek' 
        ]); 
        $this->form_validation->set_rules('penerbit', 'Nama Penerbit', 'required|min_length[3]', [ 
            'required' => 'Nama penerbit harus diisi', 
            'min_length' => 'Nama penerbit terlalu pendek' 
        ]); 
        $this->form_validation->set_rules('tahun', 'Tahun Terbit', 'required|min_length[3]|max_length[4]|numeric', [ 
            'required' => 'Tahun terbit harus diisi', 
            'min_length' => 'Tahun terbit terlalu pendek', 
            'max_length' => 'Tahun terbit terlalu panjang', 'numeric' => 'Hanya boleh diisi angka' 
        ]); 
        $this->form_validation->set_rules('isbn', 'Nomor ISBN', 'required|min_length[3]|numeric', [ 
            'required' => 'Nama ISBN harus diisi', 
            'min_length' => 'Nama ISBN terlalu pendek', 
            'numeric' => 'Yang anda masukan bukan angka'
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric', [ 
            'required' => 'Stok harus diisi', 
            'numeric' => 'Yang anda masukan bukan angka' 
        ]);

        //konfigurasi sebelum gambar diupload 
        $config['upload_path'] = './assets/img/upload/'; 
        $config['allowed_types'] = 'jpg|png|jpeg'; 
        $config['max_size'] = '3000'; 
        $config['max_width'] = '1024'; 
        $config['max_height'] = '1000'; 
        $config['file_name'] = 'img' . time();

        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) { 
            $this->load->view('templates/header', $data); 
            $this->load->view('templates/sidebar', $data); 
            $this->load->view('templates/topbar', $data); 
            $this->load->view('buku/index', $data); 
            $this->load->view('templates/footer'); 
        } else {
            if($this->upload->do_upload('image')){
                $image = $this->upload->data();
                $gambar = $image['file_name'];
            } else {
                $gambar = '';
            }

            $data = [
                'judul_buku' => $this->input->post('judul_buku', true), 
                'id_kategori' => $this->input->post('id_kategori', true), 
                'pengarang' => $this->input->post('pengarang', true), 
                'penerbit' => $this->input->post('penerbit', true), 
                'tahun_terbit' => $this->input->post('tahun', true),
                'isbn' => $this->input->post('isbn', true), 
                'stok' => $this->input->post('stok', true),
                'dipinjam' => 0,
                'dibooking' => 0,
                'image' => $gambar
            ];

            $this->ModelBuku->simpanBuku($data); 
            redirect('buku'); 
        } 
    }

    public function ubahBuku($id_buku) 
    { 
        $where = array('id' => $id_buku);
        $data['judul'] = 'Edit Data Buku'; 
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['buku'] = $this->ModelBuku->edit_buku($where, 'buku')->result();

        $this->load->view('templates/header', $data ); 
        $this->load->view('templates/sidebar', $data); 
        $this->load->view('templates/topbar', $data); 
        $this->load->view('buku/ubah_buku', $data); 
        $this->load->view('templates/footer'); 
    }

    public function proses_ubah_buku()
    {
        $id_buku        = $this->input->post('id');
        $judul_buku     = $this->input->post('judul_buku');
        $id_kategori    = $this->input->post('id_kategori');
        $pengarang      = $this->input->post('pengarang');
        $penerbit       = $this->input->post('penerbit');
        $tahun_terbit   = $this->input->post('tahun_terbit');
        $isbn           = $this->input->post('isbn');
        $stok           = $this->input->post('stok');
        $image          = $_FILES['image']['name'];
        if ($image =''){}else{
            $config ['upload_path'] = 'assets/img/upload';
            $config ['allowed_types'] = 'jpg|jpeg|png|gif';

            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('image')){
                echo "Gambar Gagal diupload";
            }else{
                $image = $this->upload->data('file_name');
            }
        }
        
        $data = array(
            'judul_buku'      => $judul_buku,
            'pengarang'       => $pengarang,
            'penerbit'        => $penerbit,
            'tahun_terbit'    => $tahun_terbit,
            'isbn'            => $isbn,
            'stok'            => $stok,
            'image'           => $image
        );

        $where = array(
            'id' => $id_buku
        );

        $this->ModelBuku->update_buku($where, $data, 'buku');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil Mengedit Data Buku</div>'); 
        redirect('buku');
    }

    public function hapusBuku() { 
        $where = ['id' => $this->uri->segment(3)]; 
        $this->ModelBuku->hapusBuku($where);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil Menghapus Buku</div>');  
        redirect('buku'); 
    }

    public function kategori() { 
        $data['judul'] = 'Kategori Buku'; 
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(); 
        $data['kategori'] = $this->ModelBuku->getKategori()->result_array(); 
        
        $this->form_validation->set_rules('nama_kategori','Nama Kategori','required', [
                'required' => 'Kategori Harus diisi'
        ]);

        if ($this->form_validation->run() == false) { 
            $this->load->view('templates/header', $data); 
            $this->load->view('templates/sidebar', $data); 
            $this->load->view('templates/topbar', $data); 
            $this->load->view('buku/kategori', $data); 
            $this->load->view('templates/footer'); 
        } else { 
            $data = [
                'nama_kategori' => $this->input->post('nama_kategori', true)
            ]; 
            
            $this->ModelBuku->simpanKategori($data); 
            redirect('buku/kategori');
        }
    }

    public function ubahKategori($id_kategori)
    { 
        $data['judul'] = 'Ubah Kategori'; 
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(); 
        $data['kategori'] = $this->ModelBuku->ubah_data($id_kategori);
        
        $this->load->view('templates/header', $data); 
        $this->load->view('templates/sidebar', $data); 
        $this->load->view('templates/topbar', $data); 
        $this->load->view('buku/ubah_kategori', $data); 
        $this->load->view('templates/footer');
    }

    public function proses_ubah_data()
    {
        $this->ModelBuku->proses_ubah_data();
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil Mengedit Kategori</div>');
        redirect('buku/kategori');
    }

    public function hapusKategori() { 
        $where = ['id_kategori' => $this->uri->segment(3)]; 
        $this->ModelBuku->hapusKategori($where);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil Menghapus Kategori</div>');  
        redirect('buku/kategori'); 
    }

}