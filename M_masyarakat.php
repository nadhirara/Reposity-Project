<?php

class M_masyarakat extends CI_Model{

    public function tambah_masyarakat($data){
       return $this->db->insert('masyarakat',$data);
    }

    public function login($data){
        $this->db->select('nik,nama');
        $this->db->from('masyarakat');
        $this->db->where($data);
        $query=$this->db->get();
        return $query->result_array();
    }

    public function tambahAduan($data){
        return $this->db->insert('pengaduan',$data);
     }

     public function tampilAduan(){
        $this->db->where('nik',$_SESSION['nik']);
        
        $query=$this->db->get('pengaduan');
        return $query->result_array();
     } 

     public function tampilAduan2($id){
      $this->db->where('nik',$_SESSION['nik']);
      $this->db->where('id_pengaduan',$id);
      $query=$this->db->get('pengaduan');
      return $query->result_array();
   }  

   public function tampilAduanTanggapan($id){
    $this->db->select('tgl_tanggapan,tanggapan');
    $this->db->where('id_pengaduan=',$id);
    $query=$this->db->get('tanggapan');
    return $query->result_array();
}
}