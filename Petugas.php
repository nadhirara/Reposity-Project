<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('M_petugas');
    }

	public function index()
	{
        //jika login_status_petugas== ok maka tampilkan halaman utama
        if ($this->session->login_status_petugas=='ok'){
            
            redirect('petugas/dashboard');
        }else{
        //jika tidak munculkan login
        $this->load->view('petugas/header');
		$this->load->view('petugas/header_register');
		$this->load->view('petugas/login');
		$this->load->view('petugas/footer_register');
        $this->load->view('petugas/footer');

        }

	}

    public function dashboard(){
        $this->load->view('petugas/header');
		$this->load->view('petugas/header_register');
		$this->load->view('petugas/dashboard');
		$this->load->view('petugas/footer_register');
        $this->load->view('petugas/footer');
    }

    public function login(){
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run()==FALSE){
        $this->load->view('petugas/header');
		$this->load->view('petugas/header_register');
		$this->load->view('petugas/login');
		$this->load->view('petugas/footer_register');
        $this->load->view('petugas/footer');
        }else{
            $pass=md5($this->input->post('password'));
            $data=array(
                'username'  => $this->input->post('username'),
                'password'  => $pass
            );
            $data_login=$this->M_petugas->login($data);
            
            if(count($data_login)>0){
                //data login ada
                $this->session->set_userdata('login_petugas_status','ok');
                $this->session->set_userdata('id_petugas',$data_login[0]['id_petugas']);
                $this->session->set_userdata('nama',$data_login[0]['nama']);
                $this->session->set_userdata('level',$data_login[0]['level']);
                redirect('petugas/dashboard');
            }else{
                $data['error']='Username atau Password Salah';
                $this->load->view('petugas/header');
                $this->load->view('petugas/header_register');
                $this->load->view('petugas/login',$data);
                $this->load->view('petugas/footer_register');
                $this->load->view('petugas/footer');
                }
        }
    }

    public function logout(){
        unset(
            $_SESSION['login_petugas_status'],
            $_SESSION['id_petugas'],
            $_SESSION['nama'],
            $_SESSION['level'],
        );
        redirect('petugas/index');
    }

    public function pengaduan(){
        $data['pengaduan']=$this->M_petugas->tampilPengaduan();
        $this->load->view('petugas/header');
        $this->load->view('petugas/header_register');
        $this->load->view('petugas/tabel_pengaduan',$data);
        $this->load->view('petugas/footer_register');
        $this->load->view('petugas/footer');
    }

    public function detailaduan($id){
        $data['detailaduan']=$this->M_petugas->tampilDetailAduan($id);
        $this->load->view('petugas/header');
        $this->load->view('petugas/header_register');
        $this->load->view('petugas/detailaduan',$data);
        $this->load->view('petugas/footer_register');
        $this->load->view('petugas/footer');
    }

    public function ubahstatus($id){
        $this->form_validation->set_rules('status','Status','required');
        if($this->form_validation->run()==FALSE){

            $data['detailaduan']=$this->M_petugas->tampilDetailAduan($id);
            $this->load->view('petugas/header');
            $this->load->view('petugas/header_register');
            $this->load->view('petugas/detailaduan',$data);
            $this->load->view('petugas/footer_register');
            $this->load->view('petugas/footer');
            }else{
            $data=array(
                
                'status'              => $this->input->post('status'));

           if($this->M_petugas->ubahStatusAduan($id,$data)){
               redirect ('petugas/pengaduan');

           }else{
            echo "Gagal Ubah Status";
           }
        }
    }

    public function tanggapan($id){
        $data['detailaduan']=$this->M_petugas->tampilDetailAduan($id);
        $data['tanggapan']=$this->M_petugas->tampilAduanTanggapan($id);
            $this->load->view('petugas/header');
            $this->load->view('petugas/header_register');
            $this->load->view('petugas/tanggapan', $data);
            $this->load->view('petugas/footer_register');
            $this->load->view('petugas/footer');
    }

    public function tambahtanggapan($id){
        $this->form_validation->set_rules('tanggapan','Tanggapan','required');
        if($this->form_validation->run()==FALSE){

            $data['detailaduan']=$this->M_petugas->tampilDetailAduan($id);
            $data['tanggapan']=$this->M_petugas->tampilTanggapan($id);
            $this->load->view('petugas/header');
            $this->load->view('petugas/header_register');
            $this->load->view('petugas/tanggapan',$data);
            $this->load->view('petugas/footer_register');
            $this->load->view('petugas/footer');
            }else{
            $data=array(
                
                'tgl_tanggapan'=>date('Y-m-d'),
                'id_pengaduan'=>$id,
                'tanggapan'=>$this->input->post('tanggapan'),
                'id_petugas'=>$this->session->id_petugas
            );

           if($this->M_petugas->tambahtanggapan($data)){
               redirect ('petugas/tanggapan/'.$id);

           }else{
            echo "Gagal Tambah Tanggapan";
           }
        }
    }

    public function petugas(){
        $data['petugas']=$this->M_petugas->tampilPetugas();
        $this->load->view('petugas/header');
        $this->load->view('petugas/header_register');
        $this->load->view('petugas/petugas',$data);
        $this->load->view('petugas/footer_register');
        $this->load->view('petugas/footer');
    }

    public function tambahPetugas(){
        $this->load->view('petugas/header');
        $this->load->view('petugas/header_register');
        $this->load->view('petugas/form_petugas');
        $this->load->view('petugas/footer_register');
        $this->load->view('petugas/footer');
    }

    public function registrasi_petugas(){
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('telp', 'telp', 'required');

        if($this->form_validation->run()==FALSE){
            $this->load->view('petugas/header');
            $this->load->view('petugas/header_register');
            $this->load->view('petugas/form_petugas');
            $this->load->view('petugas/footer_register');
            $this->load->view('petugas/footer');
        }else{
            $data=array(
                'nama'=>$this->input->post('nama'),
                'username'=>$this->input->post('username'),
                'password'=>md5($this->input->post('password')),
                'telp'=>$this->input->post('telp'),
                'level'=>'petugas'
            );

            if($this->M_petugas->registrasi_petugas($data)){
                redirect('petugas/petugas');
            }else{
                echo "Gagal Tambah Data Petugas";
            }
        }
    }

    public function cetakLaporan(){
        $data['pengaduan']=$this->M_petugas->tampilPengaduan();
        $this->load->view('petugas/laporan',$data);
    }
}
