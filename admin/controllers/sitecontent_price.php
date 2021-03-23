<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitecontent_price extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('image_moo') ;
        $this->load->helper('url');
        $this->load->helper('web');
        session_start();
        if(!isset($_SESSION["user"]) && $_SESSION["user"] == null){ //已經登入的話直接回首頁
            redirect(site_url("/admin")); //轉回首頁
            return true;
        }
    }
    public function index(){
        $this->load->model("PriceModel");
        $results = $this->PriceModel->getImg();
        $this->data['data'] = json_decode(json_encode($results), true);
        $this->data['pageTitle'] = "管理系統 - 價目表";
        $this->data['subview'] = 'sitecontent/sitecontent_price';
        $this->load->view('admin/_main',$this->data);
    }
}
