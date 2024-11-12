<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_penjualan extends CI_Model {

    // Fungsi untuk mendapatkan kode unik penjualan
    public function getkodeunik() {
        $q = $this->db->query("SELECT MAX(RIGHT(idPenjualan, 2)) AS idmax FROM penjualan");
        $kd = ""; //kode awal
        if ($q->num_rows() > 0) { // jika data ada
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->idmax) + 1; // string kode diset ke integer dan ditambahkan 1 dari kode terakhir
                $kd = sprintf("%02s", $tmp); // kode ambil 2 karakter terakhir
            }
        } else { // jika data kosong diset ke kode awal
            $kd = "01";
        }
        $kar = "T"; // karakter depan kodenya
        return $kar . $kd;
    }

    // Fungsi untuk menambah penjualan
    public function tambah() {
        $idPenjualan = $this->input->post('idPenjualan');
        $idBarang = $this->input->post('idBarang');
        $qty = $this->input->post('qty');
        $tgl = date('Y/m/d');
        $idPetugas = $this->session->userdata('id');
        $this->load->model('m_barang');
        $harga = $this->m_barang->selectBarang($idBarang)->row();
        $total = $qty * $harga->harga;
        $data = array(
            'idPenjualan' => $idPenjualan,
            'idBarang' => $idBarang,
            'tglTransaksi' => $tgl,
            'qty' => $qty,
            'idUser' => $idPetugas
        );
        $this->db->insert('penjualan', $data);
        $this->db->query("UPDATE barang SET stok=stok-'$qty' WHERE idBarang= '$idBarang'");
        $this->session->set_flashdata('info', "Transaksi Berhasil, Total: Rp $total");
    }

    // Fungsi untuk mendapatkan penjualan berdasarkan petugas
    public function getPenjualanPetugas() {
        $idUser = $this->session->userdata('id');
        $this->db->select('penjualan.*, barang.*, user.nama');
        $this->db->from('penjualan');
        $this->db->join('barang', 'penjualan.idBarang = barang.idBarang');
        $this->db->join('user', 'penjualan.idUser = user.idUser');
        $this->db->where('penjualan.idUser', $idUser);
        $this->db->order_by('penjualan.idPenjualan');
        $query = $this->db->get();
        return $query;
    }

    // Fungsi untuk menghapus data penjualan
    public function hapus($idPenjualan) {
        $this->db->where('idPenjualan', $idPenjualan);
        $this->db->delete('penjualan');
    }
}
?>
