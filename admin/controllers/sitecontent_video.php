<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitecontent_video extends CI_Controller {
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
        $url ='';
        $this->load->model("VideoModel");
        $query = $this->db->get('video');
        foreach ($query->result() as $row)
        {
            $url[] = $row->Url;
        }
        //print_r($url);
        //exit();
        $this->data['pageTitle'] = "管理系統 - 首頁影片";
        $this->data['subview'] = 'sitecontent/sitecontent_video';
        $this->data['data']['url'] = $url;
        $this->load->view('admin/_main',$this->data);
    }

    public function update(){
        $url1 = $this->input->post("url1");
        $url2 = $this->input->post("url2");
        $this->load->model("VideoModel");
        $data = array('Url' => $url1);
        $this->db->where('Id', 1);
        $this->db->update('video', $data);
        $data = array('Url' => $url2);
        $this->db->where('Id', 2);
        $this->db->update('video', $data);
        redirect(site_url("/sitecontent_video?result=success"));
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */