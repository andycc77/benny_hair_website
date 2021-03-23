<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitecontent_picture extends CI_Controller {
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
        $this->load->model("BannerModel");
        $results = $this->BannerModel->getBanner();
        $this->data['data'] = json_decode(json_encode($results), true);
        $this->data['pageTitle'] = "管理系統 - 首頁Banner";
        $this->data['subview'] = 'sitecontent/sitecontent_picture';
        $this->load->view('admin/_main',$this->data);
    }

    public function del($id){
        $this->load->model("BannerModel");
        $this->BannerModel->del($id);
        redirect(site_url("/sitecontent_picture?result=del"));
    }
    public function modify($id,$status,$order){
        $json['id']=$id;
        $json['status']=$status;
        $json['order']=$order;
        $this->load->model("BannerModel");
        $result = $this->BannerModel->update($id,$status,$order);
        $json['result'] = $result;
        echo json_encode($json);
        //redirect(site_url("/sitecontent_picture?result=modify"));
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */