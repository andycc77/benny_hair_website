<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments_edit extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('web');
    }

    public function index($id)
    {
        session_start();
        $this->load->model("CommentsModel");
        $results = $this->CommentsModel->getComments();
        $this->data['data'] = json_decode(json_encode($results), true);
        $this->data['pageTitle'] = "管理系統 - 留言管理";
        $this->data['subview'] = 'comments/comments_edit';
        $this->load->view('admin/_main',$this->data);
    }

    public function del($id){
        $this->load->model("CommentsModel");
        $this->CommentsModel->del($id);
        redirect(site_url("/comments_list?result=del"));
    }

    public function modify($id,$status,$display){
        $json['id']=$id;
        $json['status']=$status;
        $json['display']=$display;
        $this->load->model("CommentsModel");
        $result = $this->CommentsModel->update($id,$status,$display);
        $json['result'] = $result;
        echo json_encode($json);
        //redirect(site_url("/sitecontent_picture?result=modify"));
    }
}