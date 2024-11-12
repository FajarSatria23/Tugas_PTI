<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model {
    // Fungsi untuk mendapatkan data user berdasarkan email
    public function getEmailUser($email) {
        $this->db->select('*');
        $this->db->from('users'); // Gantilah 'users' dengan nama tabel Anda
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row(); // Mengembalikan satu baris data
    }

    // Fungsi untuk mendapatkan data user berdasarkan password
    public function getPassUser($password) {
        $this->db->select('*');
        $this->db->from('users'); // Gantilah 'users' dengan nama tabel Anda
        $this->db->where('password', $password);
        $query = $this->db->get();
        return $query->row(); // Mengembalikan satu baris data
    }

    // Fungsi untuk mengubah password berdasarkan email
    public function ubahPasswordUser($email, $data) {
        $this->db->set($data);
        $this->db->where('email', $email);
        $this->db->update('users'); // Gantilah 'users' dengan nama tabel Anda
    }

    // Fungsi untuk mendapatkan data admin berdasarkan email
    public function selectAdmin() {
        $email = $this->session->userdata('email');
        $this->db->select('*');
        $this->db->from('users'); // Gantilah 'users' dengan nama tabel Anda
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query;
    }

    // Fungsi untuk mendapatkan data petugas berdasarkan email
    public function selectPetugas() {
        $email = $this->session->userdata('email');
        $this->db->select('*');
        $this->db->from('users'); // Gantilah 'users' dengan nama tabel Anda
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query;
    }

    // Fungsi untuk mendapatkan ID unik petugas
    public function getkodeunik() {
        $q = $this->db->query("SELECT MAX(RIGHT(idUser, 2)) AS idmax FROM users"); // Gantilah 'users' dengan nama tabel Anda
        $kd = ""; //kode awal
        if ($q->num_rows() > 0) { // jika data ada
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->idmax) + 1; // string kode diset ke integer dan ditambahkan 1 dari kode terakhir
                $kd = sprintf("%02s", $tmp); // kode ambil 2 karakter terakhir
            }
        } else { // jika data kosong diset ke kode awal
            $kd = "01";
        }
        $kar = "P"; // karakter depan kodenya
        // gabungkan string dengan kode yang telah dibuat tadi
        return $kar . $kd;
    }

    // Fungsi untuk menambah petugas
    public function tambah() {
        $idPetugas = $this->input->post('idPetugas');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $data = array(
            'idUser' => $idPetugas,
            'nama' => $nama,
            'email' => $email,
            'password' => md5($password),
            'level' => 'Petugas'
        );
        $this->db->insert('users', $data); // Gantilah 'users' dengan nama tabel Anda
    }

    // Fungsi untuk mendapatkan semua petugas
    public function getPetugas() {
        $this->db->select('*');
        $this->db->from('users'); // Gantilah 'users' dengan nama tabel Anda
        $this->db->where('level', 'Petugas');
        $query = $this->db->get();
        return $query;
    }

    // Fungsi untuk mengubah data petugas
    public function ubahPetugas() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->db->set('password', md5($password));
        $this->db->where('email', $email);
        $this->db->update('users'); // Gantilah 'users' dengan nama tabel Anda
    }
}
?>
