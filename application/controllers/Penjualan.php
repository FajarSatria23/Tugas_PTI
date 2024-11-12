<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_penjualan', 'm_user', 'm_barang'));
        date_default_timezone_set('Asia/Jakarta');
    }

    public function tambahPenjualan() {
        $data['kodeunik'] = $this->m_penjualan->getkodeunik();
        $data['dataBarang'] = $this->m_barang->getBarang()->result();
        
        if ($this->input->method() == 'post') {
            $this->m_penjualan->tambah();
            $this->session->set_flashdata('info', 'Transaksi Berhasil');
            redirect('penjualan/tambahPenjualan');
        }
        
        $this->load->view('petugas/header');
        $this->load->view('petugas/tambahPenjualan', $data);
        $this->load->view('petugas/footer');
    }

    public function penjualan() {
        $data['dataPenjualan'] = $this->m_penjualan->getPenjualanPetugas()->result();
        $this->load->view('petugas/header');
        $this->load->view('petugas/dataPenjualan', $data);
        $this->load->view('petugas/footer');
    }

    public function dataPenjualan() {
        if ($this->session->userdata('level') != 'Admin') {
            redirect('login');
        } else {
            $data['admin'] = $this->m_user->selectAdmin()->row();
            $data['dataPenjualan'] = $this->m_penjualan->getPenjualan()->result();
            $this->load->view('admin/header', $data);
            $this->load->view('admin/dataPenjualan', $data);
            $this->load->view('admin/footer');
        }
    }

    public function hapus($idPenjualan) {
        if ($this->session->userdata('level') != 'Admin') {
            redirect('login');
        } else {
            $this->m_penjualan->hapus($idPenjualan);
            $this->session->set_flashdata('info', 'SUKSESS : Berhasil di Hapus');
            redirect('penjualan/dataPenjualan');
        }
    }
    function exportPDF(){
        $data['dataPenjualan'] = $this->m_penjualan->getPenjualan()->result();
        $this->pdf->load_view('admin/laporan/laporanPenjualan',$data);
        $tgl = date("d/m/Y");
        $this->pdf->render();
        $this->pdf->stream("Laporan-Penjualan_".$tgl.".pdf");
    }
}
?>
