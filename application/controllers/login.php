<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_user'); // Memuat model m_user
        $this->load->library('session'); // Memuat library session
        $this->load->library('email'); // Memuat library email
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index() {
        if ($this->session->userdata('level') == 'Admin') {
            redirect('admin', 'refresh');
        } elseif ($this->session->userdata('level') == 'Petugas') {
            redirect('petugas', 'refresh');
        } else {
            $this->load->view('login'); // Memuat view login
        }
    }

    public function login_act() {
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $cekEmailUser = $this->m_user->getEmailUser($email);
        $cekPassUser = $this->m_user->getPassUser($password);

        if ($this->input->method() != 'post') {
            redirect('login');
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->session->set_flashdata('peringatan', 'Format email salah');
            redirect('login');
        } elseif ($cekEmailUser == NULL) {
            $this->session->set_flashdata('peringatan', 'Email tidak ditemukan');
            redirect('login');
        } elseif ($cekPassUser == NULL) {
            $this->session->set_flashdata('peringatan', 'Password salah');
            redirect('login');
        } else {
            $data_user = array();
            foreach ($cekEmailUser->result() as $data) {
                $data_user['id'] = $data->id;
                $data_user['nama'] = $data->nama;
                $data_user['email'] = $data->email;
                $data_user['level'] = $data->level; // Tambahkan data level user
            }
            $this->session->set_userdata($data_user);

            if ($data_user['level'] == "Petugas") {
                redirect('petugas');
            } elseif ($data_user['level'] == "Admin") {
                redirect('admin');
            } else {
                $this->session->set_flashdata('peringatan', 'Level user tidak valid');
                redirect('login');
            }
        }
    }

    public function lupaPassword() {
        if ($this->session->userdata('level') == 'Admin') {
            redirect('admin');
        } elseif ($this->session->userdata('level') == 'Petugas') {
            redirect('petugas');
        } else {
            $this->load->view('lupaPassword');
        }
    }

    public function lupaPassword_act() {
        $email = $this->input->post('email');
        $cekEmailUser = $this->m_user->getEmailUser($email);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->session->set_flashdata('peringatan', 'Format email salah');
            redirect('login/lupaPassword');
        } elseif ($cekEmailUser == NULL) {
            $this->session->set_flashdata('peringatan', 'Email tidak ditemukan');
            redirect('login/lupaPassword');
        } else {
            // Password baru
            $pass = "129FAasdsk25kwBjakjDlff";
            $panjang = 8;
            $len = strlen($pass);
            $start = $len - $panjang;
            $xx = rand(0, $start);
            $yy = str_shuffle($pass);
            $passwordbaru = substr($yy, $xx, $panjang);

            // Konfigurasi email
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'smtp.example.com', // Gantilah dengan host SMTP Anda
                'smtp_port' => 587, // Gantilah dengan port SMTP yang sesuai
                'smtp_user' => 'email@example.com', // Gantilah dengan email Anda
                'smtp_pass' => 'password', // Gantilah dengan password email Anda
                'mailtype' => 'html',
                'charset' => 'iso-8859-1'
            );

            // Inisialisasi email
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");

            // Alamat pengirim
            $this->email->from('email@example.com', 'Nama Pengirim');
            // Alamat penerima
            $this->email->to($email);
            // Subjek email
            $this->email->subject('Lupa Password');
            // Pesan email
            $message = "<p>Kami telah mengatur ulang password Anda, berikut password baru Anda:</p>";
            $message .= "<p>Password Baru: <b>" . $passwordbaru . "</b></p>";
            $message .= "<p>Anda dapat login kembali dengan password baru Anda <a href='" . base_url() . "login' target='_blank' style='text-decoration:none;font-weight:bold;'>disini</a>.</p>";
            $this->email->message($message);

            if ($this->email->send()) {
                $data = array('password' => md5($passwordbaru));
                $this->m_user->ubahPasswordUser($email, $data);
                $this->session->set_flashdata('peringatan', 'Email berhasil terkirim. Silakan cek email Anda untuk password baru.');
                redirect('login');
            } else {
                $this->session->set_flashdata('peringatan', 'Email gagal terkirim. Periksa koneksi internet Anda.');
                redirect('login/lupaPassword');
            }
        }
    }
}
