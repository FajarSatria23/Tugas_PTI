<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_barang extends CI_Model {

    // Fungsi untuk menambah stok barang
    public function tambahStok($idBarang) {
        $query = "UPDATE barang SET stok = stok + 1 WHERE idBarang = '$idBarang'";
        return $this->db->query($query);
    }

    // Fungsi untuk mengurangi stok barang
    public function kurangStok($idBarang) {
        $query = "UPDATE barang SET stok = stok - 1 WHERE idBarang = '$idBarang'";
        return $this->db->query($query);
    }

    // Fungsi yang ada sebelumnya
    public function getkodeunik() {
        $q = $this->db->query("SELECT MAX(RIGHT(idBarang, 2)) AS idmax FROM barang");
        $kd = ""; //kode awal
        if ($q->num_rows() > 0) { // jika data ada
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->idmax) + 1; // string kode diset ke integer dan ditambahkan 1 dari kode terakhir
                $kd = sprintf("%02s", $tmp); // kode ambil 2 karakter terakhir
            }
        } else { // jika data kosong diset ke kode awal
            $kd = "01";
        }
        $kar = "B"; // karakter depan kodenya
        return $kar . $kd;
    }

    public function tambah() {
        $id = $this->input->post('id');
        $nama = $this->input->post('namaBarang');
        $harga = $this->input->post('harga');
        $stok = $this->input->post('stok');
        $foto = $_FILES['foto']['name'];

        $this->load->library('upload');
        $config['upload_path'] = './assets/gambar'; // path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; // tipe file yang dapat diunggah
        $config['file_name'] = $nama; // nama file yang terunggah nantinya
        $this->upload->initialize($config);

        if ($_FILES['foto']['name']) {
            if ($this->upload->do_upload('foto')) {
                $gbr = $this->upload->data();
                define('WP_MEMORY_LIMIT', '256M');
                $source_url = $config['upload_path'] . '/' . $gbr['file_name'];
                $image = imagecreatefromjpeg($source_url);
                imagejpeg($image, $config['upload_path'] . '/' . $gbr['file_name'], 50);
                $data = array(
                    'idBarang' => $id,
                    'namaBarang' => $nama,
                    'harga' => $harga,
                    'stok' => $stok,
                    'foto' => $gbr['file_name']
                );
                $this->db->insert('barang', $data);
            }
        }
    }

    public function ubah($idBarang) {
        $nama = $this->input->post('namaBarang');
        $harga = $this->input->post('harga');
        $data = array(
            'namaBarang' => $nama,
            'harga' => $harga
        );
        $this->db->set($data);
        $this->db->where('idBarang', $idBarang);
        $this->db->update('barang');
    }

    public function getBarang() {
        $this->db->select('*');
        $this->db->from('barang');
        $query = $this->db->get();
        return $query;
    }

    public function selectBarang($idBarang) {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('idBarang', $idBarang);
        $query = $this->db->get();
        return $query;
    }
}
?>
