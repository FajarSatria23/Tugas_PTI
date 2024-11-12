<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_member', 'm_user'));
        date_default_timezone_set('Asia/Jakarta');
    }

    public function dataMember() {
        if ($this->session->userdata('level') != 'Admin') {
            redirect('login');
        } else {
            $data['admin'] = $this->m_user->selectAdmin()->row();
            $data['member'] = $this->m_member->getMember()->result();
            $this->load->view('admin/header', $data);
            $this->load->view('admin/dataMember');
            $this->load->view('admin/footer');
        }
    }

    public function tambah($data) {
        $this->db->insert_batch('member', $data);
    }
    

    public function import() {
        if ($this->session->userdata('level') != 'Admin') {
            redirect('login');
        } else {
            $data['admin'] = $this->m_user->selectAdmin()->row();

            if (isset($_POST['preview'])) { // Jika user menekan tombol Preview pada form
                // Lakukan upload file dengan memanggil function upload yang ada di M_member.php
                $upload = $this->m_member->upload_file($this->filename);

                if ($upload['result'] == "success") { // Jika proses upload sukses
                    // Load plugin PHPExcel nya
                    $excelreader = new PHPExcel_Reader_Excel2007();
                    $loadexcel = $excelreader->load('excel/' . $this->filename . '.xlsx'); // Load file yang tadi diupload ke folder excel
                    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

                    // Masukkan variabel $sheet ke dalam array data yang nantinya akan dikirim ke file form.php
                    // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudah diupload sebelumnya
                    $data['sheet'] = $sheet;
                } else { // Jika proses upload gagal
                    $data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
                }
            }

            $data['member'] = $this->m_member->getMember()->result();
            $this->load->view('admin/header', $data);
            $this->load->view('admin/import', $data);
            $this->load->view('admin/footer');
        }
    }
    public function tambah() {
        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
    
        // Buat sebuah variabel array untuk menampung array data yang akan kita insert ke database
        $data = [];
        $numrow = 1;
        foreach($sheet as $row) {
            // Cek numrow apakah lebih dari 1
            // Artinya karena baris pertama adalah nama-nama kolom
            // Jadi dilewat saja, tidak usah diimport
            if($numrow > 1) {
                // Kita push (add) array data ke variabel data
                array_push($data, [
                    'idMember' => "", // Insert data id dari kolom A di excel
                    'nama' => $row['B'], // Insert data nama dari kolom B di excel
                    'jk' => $row['C'], // Insert data jenis kelamin dari kolom C di excel
                    'alamat' => $row['D'], // Insert data alamat dari kolom D di excel
                ]);
            }
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Panggil fungsi tambah yang ada di model m_member
        $this->m_member->tambah($data);
    
        // Beri informasi jika data berhasil diimport
        $this->session->set_flashdata('info', 'Data berhasil ditambah');
        
        // Redirect ke halaman awal (ke controller member fungsi dataMember)
        redirect("member/dataMember");
    }
    
}
?>
