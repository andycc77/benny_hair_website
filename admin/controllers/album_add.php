<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Album_add extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('web');
        session_start();
        if(!isset($_SESSION["user"]) && $_SESSION["user"] == null){ //已經登入的話直接回首頁
            redirect(site_url("/admin")); //轉回首頁
            return true;
        }
    }
    public function index(){
        $this->load->model("AlbumModel");
        $this->data['data'] = array();
        $this->data['pageTitle'] = "管理系統 - 作品集";
        $this->data['subview'] = 'album/add';
        $this->load->view('admin/_main',$this->data);
    }

    public function add(){
        $name = $this->input->post("name");
        $desc= $this->input->post("desc");
        $time_from= $this->input->post("time_from");
        $time_from= strtotime($time_from)+28800;
        $time_to= $this->input->post("time_to");
        $time_to= strtotime($time_to)+28800;
        $Hpic= $this->input->post("Hpic");
        $Lpic= $this->input->post("Lpic");
        $top = $this->input->post("top");
        $this->load->model("AlbumModel");
        $this->AlbumModel->insert($name,$desc,$time_from,$time_to,$Hpic,$Lpic,$top); //完成新增動作
        redirect(site_url("/album_list?result=success"));

    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */