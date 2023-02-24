<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masyarakat extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('M_masyarakat');
        $this->load->model('M_petugas');
    }

	public function index()
	{
        $this->load->view('masyarakat/header');
		$this->load->view('masyarakat/header_register');
        //jika variabel session login_status == ok maka tampilkan aduan
        if ($this->session->userdata('login_status')=='ok'){
            // $this->load->view('masyarakat/aduan');
            $data['pengaduan']=$this->M_masyarakat->tampilAduan();
            $this->load->view('masyarakat/aduan',$data);
        //jika tidak munculkan login
        }else{
            $this->load->view('masyarakat/login');
        }

		$this->load->view('masyarakat/footer_register');
        $this->load->view('masyarakat/footer');
	}

    public function registrasi()
	{
        $this->load->view('masyarakat/header');
		$this->load->view('masyarakat/header_register');
		$this->load->view('masyarakat/registrasi');
		$this->load->view('masyarakat/footer_register');
        $this->load->view('masyarakat/footer');
	}
    public function registrasi_user(){
    //panggil validasi form
    $this->validasi_form();

    //jika form validation bermasalah maka dikembalikan ke method registrasi dengan pesan eror
    if($this->form_validation->run()==FALSE){
        $this->registrasi();
    
    //jika tidak bermasalah maka simpan ke database
    }else{
            $pass=md5($_POST['password']);
            $data=array(
                'nik'=> $_POST['nik'],
                'nama'=>$_POST['nama'],
                'username'=>$_POST['username'],
                'password'=>$pass,
                'telp'=>$_POST['telp']
        );
        //untuk pengecekan ke database
        if ($this->M_masyarakat->tambah_masyarakat($data)){
            $this->index();
    }
}
}
    //validasi form
    public function validasi_form(){
        $this->form_validation->set_rules('nik','NIK','required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('telp', 'Telp', 'required');
    }

    public function login(){
        //panggil validasi form
        $this->validasi_form_login();

        //jika form validation bermasalah maka dikembalikan ke method index dengan pesan eror
        if ($this->form_validation->run()==FALSE){
            $this->index();

        //jika tidak bermasalah maka simpan ke database
        }else{
            $pass=md5($_POST['password']);
            $data=array(
                'username'=>$_POST['username'],
                'password'=>$pass
            );

            $data=$this->M_masyarakat->login($data);

            if(count($data)>0){
                    $this->session->set_userdata('login_status','ok');
                    $this->session->set_userdata('nik', $data[0]['nik']);
                    $this->session->set_userdata('nama', $data[0]['nama']);

                    $this->index();
            }else{
                $this->index();
            }
        }
    }
    public function validasi_form_login(){
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    }

    public function logout(){
        unset(
            $_SESSION['login_status'],
            $_SESSION['nik'],
            $_SESSION['nama']
    );

    $this->index();
    }

    public function form_aduan(){
        if($this->session->login_status=='ok'){
        $this->load->view('masyarakat/header');
        $this->load->view('masyarakat/header_register');
		$this->load->view('masyarakat/form_aduan');
        $this->load->view('masyarakat/footer_register');
        $this->load->view('masyarakat/footer');
    }else{
        redirect('masyarakat');
    }
}
public function simpan_aduan(){
    $this->form_validation->set_rules('isi_laporan', 'isi_laporan', 'required');
    
    if($this->form_validation->run()==FALSE){
        // redirect('masyarakat/form_aduan');
        $this->load->view('masyarakat/header');
        $this->load->view('masyarakat/header_register');
		$this->load->view('masyarakat/form_aduan');
        $this->load->view('masyarakat/footer_register');
        $this->load->view('masyarakat/footer');
    }else{
        $config['upload_path']='./img/';
        $config['allowed_types']='gif|jpg|jpeg|png';

        $this->load->library('upload',$config);
        if(!$this->upload->do_upload('foto')){
            $error=array('error'=>$this->upload->display_errors());

            $this->load->view('masyarakat/header');
            $this->load->view('masyarakat/header_register');
            $this->load->view('masyarakat/form_aduan',$error);
            $this->load->view('masyarakat/footer_register');
            $this->load->view('masyarakat/footer');
        }else{
            $data =$this->upload->data();
            $filename=$data['file_name'];

            $data=array(
                'tgl_pengaduan'     => date('Y-m-d'),
                'nik'               => $this->session->userdata['nik'],
                'isi_laporan'       => $_POST['isi_laporan'],
                'foto'              => $filename
            );

            //simpan kedatabase
            if($this->M_masyarakat->tambahAduan($data)){
                
                redirect('masyarakat/tampilAduan');
        
            }else{
                $error=array('error'=>'Gagal Simpan Data Pengaduan');
                    $this->load->view('masyarakat/header');
                    $this->load->view('masyarakat/header_register');
                    $this->load->view('masyarakat/form_aduan',$error);
                    $this->load->view('masyarakat/footer_register');
                    $this->load->view('masyarakat/footer');
                }
            }
    }
}
public function tampilAduan(){
    $data['pengaduan']=$this->M_masyarakat->tampilAduan();
    $this->load->view('masyarakat/header');
    $this->load->view('masyarakat/header_register');
    $this->load->view('masyarakat/aduan',$data);
    $this->load->view('masyarakat/footer_register');
    $this->load->view('masyarakat/footer');
}

public function tanggapan($id){
    $data['detailaduan']=$this->M_masyarakat->tampilAduan2($id);
    $data['tampil_tanggapan']=$this->M_masyarakat->tampilAduanTanggapan($id);
        $this->load->view('masyarakat/header');
        $this->load->view('masyarakat/header_register');
        $this->load->view('masyarakat/tanggapan',$data);
        $this->load->view('masyarakat/footer_register');
        $this->load->view('masyarakat/footer');
}
}