<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_barang', 'm_user'));
        date_default_timezone_set('Asia/Jakarta');
    }

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
        if ($this->session->userdata('level') != 'Petugas') {
            redirect('login');
        } else {
            if ($this->input->method() == 'post') {
                $this->m_barang->tambah();
                $this->session->set_flashdata('info', 'Data berhasil ditambah');
                redirect('barang/tambah');
            } else {
                $data['kodeunik'] = $this->getkodeunik();
                $this->load->view('petugas/header');
                $this->load->view('petugas/tambahBarang', $data);
                $this->load->view('petugas/footer');
            }
        }
    }

    public function dataBarang() {
        if ($this->session->userdata('level') != 'Admin') {
            redirect('login');
        } else {
            $data['admin'] = $this->m_user->selectAdmin()->row();
            $data['dataBarang'] = $this->m_barang->getBarang()->result();
            $this->load->view('admin/header', $data);
            $this->load->view('admin/dataBarang', $data);
            $this->load->view('admin/footer');
        }
    }

    public function ubah($idBarang) {
        if ($this->session->userdata('level') != 'Admin') {
            redirect('login');
        } else {
            if ($this->input->method() == 'post') {
                $this->m_barang->ubah($idBarang);
                $this->session->set_flashdata('info', 'Data berhasil diubah');
                redirect('barang/dataBarang');
            } else {
                $data['admin'] = $this->m_user->selectAdmin()->row();
                $data['dataBarang'] = $this->m_barang->selectBarang($idBarang)->row();
                $this->load->view('admin/header', $data);
                $this->load->view('admin/ubahBarang');
                $this->load->view('admin/footer');
            }
        }
    }

    public function stok() {
        if ($this->session->userdata('level') != 'Petugas') {
            redirect('login');
        } else {
            $data['dataBarang'] = $this->m_barang->getBarang()->result();
            $this->load->view('petugas/header');
            $this->load->view('petugas/stok', $data);
            $this->load->view('petugas/footer');
        }
    }

    public function exportPDF() { 
        $data['dataBarang'] = $this->m_barang->getBarang()->result(); 
        $tgl = date("Y/m/d"); $this->pdf->load_view('admin/laporan/laporanBarang', $data); 
        $this->pdf->render(); set_time_limit(500); 
        $this->pdf->stream("Laporan-Barang".$tgl.".pdf"); 
    }


    public function export() {
        if ($this->session->userdata('level') != 'Admin') {
            redirect('login');
        } else {
            // Panggil class PHPExcel nya
            $excel = new PHPExcel();
            $path = $_SERVER['DOCUMENT_ROOT'] . '/assets/gambar/';
            
            // Settingan awal file excel
            $excel->getProperties()->setCreator('XYZ')
                                   ->setLastModifiedBy('XYZ')
                                   ->setTitle("Data Barang")
                                   ->setSubject("Barang")
                                   ->setDescription("Laporan Semua Data Barang")
                                   ->setKeywords("Data Barang");
            
            // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
            $style_col = array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'E1E0F7'),
                ),
                'font' => array('bold' => true), // Set font nya jadi bold
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                    ),
                ),
            );
            
            // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
            $style_row = array(
                'alignment' => array(
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ),
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                    ),
                ),
            );
            
            $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA BARANG"); // Set kolom A1 dengan tulisan "DATA BARANG"
            $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
            $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
            $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
            $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
            
            // Buat header tabel nya pada baris ke 3
            $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
            $excel->setActiveSheetIndex(0)->setCellValue('B3', "Id Barang"); // Set kolom B3 dengan tulisan "Id Barang"
            $excel->setActiveSheetIndex(0)->setCellValue('C3', "Nama Barang"); // Set kolom C3 dengan tulisan "Nama Barang"
            $excel->setActiveSheetIndex(0)->setCellValue('D3', "Harga"); // Set kolom D3 dengan tulisan "Harga"
            $excel->setActiveSheetIndex(0)->setCellValue('E3', "Stok"); // Set kolom E3 dengan tulisan "Stok"
            
            // Apply style header yang telah kita buat tadi ke masing-masing kolom header
            $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
            
            // Panggil function view yang ada di Barang Model untuk menampilkan semua data barangnya
            $dataBarang = $this->m_barang->getBarang()->result();
            $no = 1; // Untuk penomoran tabel, di awal set dengan 1
            $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
            foreach($dataBarang as $data){ // Lakukan looping pada variabel barang
                $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
                $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->idBarang);
                $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->namaBarang);
                $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, 'Rp'. $data->harga);
                $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->stok);
                
                // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
               [_{{{CITATION{{{_1{](https://github.com/zaenury5868/webteleradiologi/tree/cf158402a476efe6f335ee7277cb23d1e9e72572/application%2Fmodels%2FPasien_model.php)[_{{{CITATION{{{_2{](https://github.com/rizkiagusti/bengkel/tree/17078925a4ed625c036217c889c6464865026728/application%2Fmodels%2Fm_armada.php)[_{{{CITATION{{{_3{](https://github.com/erwinmardinata/kpu/tree/5fb9a575a36942c19d0f252fff016e4691fbcec9/application%2Fmodules%2FLaporan%2Fcontrollers%2FLaporan.php)[_{{{CITATION{{{_4{](https://github.com/Keninnr/Keni-UjikomSpp/tree/d0b179e89ca86f990db7d44f92138a4d3f96786b/Ujikom2020%2Fapplication%2Fcontrollers%2FC_Excel.php)[_{{{CITATION{{{_5{](https://github.com/firman1367/ppsdm/tree/012014002814b3c36267948e5bea95a8f2fc9db5/export%2Fprovinsi.php)[_{{{CITATION{{{_6{](https://github.com/wawu-code-art/livemonitoring/tree/c2c586a3201d4000d8e87e65662df00810731c6d/application%2Fcontrollers%2FLiveMonitoringStock.php)[_{{{CITATION{{{_7{](https://github.com/san1196/aplikasi_penghitung_fee/tree/9997e1a151fde8296c023bc106e0dcaef5e3c867/id%2Fex_ca.php)[_{{{CITATION{{{_8{](https://github.com/san1196/aplikasi_penghitung_fee/tree/9997e1a151fde8296c023bc106e0dcaef5e3c867/id%2Fex.php)[_{{{CITATION{{{_9{](https://github.com/harioblackid/lms/tree/dd430035c7a45e739aca996d696ab959f6110419/application%2Fmodules%2FAbsen%2Fcontrollers%2FAbsen.php)[_{{{CITATION{{{_10{](https://github.com/putrapradesa/simit/tree/51142b2b91e74135c1df92f1df4f8dd85e9405d7/application%2Fcontrollers%2Fmaster%2Fdivisi.php)[_{{{CITATION{{{_11{](https://github.com/abdulchakam/Web-ECommerce-Kampung-Anggrek/tree/7ebc1a62f16938dd271e168d4dc830de8c7a4293/application%2Fcontrollers%2Fadmin%2FProduk.php)[_{{{CITATION{{{_12{](https://github.com/aderahmatn/trss/tree/a6383c06a94cf79d4c82deed0b7f085db9d7b73e/application%2Fcontrollers%2FReport.php)