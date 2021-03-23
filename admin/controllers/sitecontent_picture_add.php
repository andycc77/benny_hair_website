<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitecontent_picture_add extends CI_Controller {
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
        $this->data['upload_path']        = $upload_path          = "public/upload/real/" ;
        $this->data['destination_thumbs'] = $destination_thumbs   = "public/upload/thumbs/" ;

        $this->data['large_photo_exists'] = $this->data['thumb_photo_exists'] = $this->data['error'] = NULL ;
        $this->data['thumb_width']        = "950";
        $this->data['thumb_height']       = "420";
        //第一層
        if (!empty($_POST['upload'])) {
            $config['upload_path']  = $upload_path ;
            $config['allowed_types']= 'gif|jpg|png|jpeg';
            $config['max_size']     = '20000';
            $config['max_width']    = '200000';
            $config['max_height']   = '200000';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload("image")) {
                $this->data['img'] = $this->upload->data();
                $this->data['large_photo_exists']  = "<img src=\"".base_url() . $upload_path.$this->data['img']['file_name']."\" alt=\"Large Image\"/>";
            }
        }
        elseif (!empty($_POST['upload_thumbnail'])) {
            //第二層
            $x1 = $this->input->post('x1',TRUE) ;
            $y1 = $this->input->post('y1',TRUE) ;
            $x2 = $this->input->post('x2',TRUE) ;
            $y2 = $this->input->post('y2',TRUE) ;
            $w  = $this->input->post('w',TRUE) ;
            $h  = $this->input->post('h',TRUE) ;

            $file_name  = $this->input->post('file_name',TRUE) ;

            if ($file_name) {
                $this->image_moo
                    ->load($upload_path . $file_name)
                    ->crop($x1,$y1,$x2,$y2)
                    ->save($destination_thumbs . $file_name) ;

                if ($this->image_moo->errors) {
                    $this->data['error'] = $this->image_moo->display_errors() ;
                }
                else {
                    $this->data['thumb_photo_exists'] =$file_name;
                    $this->data['large_photo_exists'] = "<img src=\"".base_url() . $upload_path.$file_name."\" alt=\"Large Image\"/>";
                }
            }

        }
        $this->data['pageTitle'] = "管理系統 - 首頁Banner-新增";
        $this->data['subview'] = 'sitecontent/sitecontent_picture_add';
        $this->load->view('admin/_main',$this->data);
    }

    public function add(){
        $pic = $this->input->post("pic");
        $order= $this->input->post("order");
        $status= $this->input->post("status");
        $this->load->model("BannerModel");
        $this->BannerModel->insert($pic,$order,$status); //完成新增動作
        redirect(site_url("/sitecontent_picture?result=success"));

    }
}
