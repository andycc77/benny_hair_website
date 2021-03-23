<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitecontent_contact extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('web');
    }

    public function index()
    {
        session_start();
        $this->load->model("Contactmodel");
        $results = $this->Contactmodel->getContacts();
        $this->data['data'] = json_decode(json_encode($results), true);
        $this->data['pageTitle'] = "管理系統 - 聯絡我們";
        $this->data['subview'] = 'sitecontent/sitecontent_contact';
        $this->load->view('admin/_main',$this->data);
    }
    /*
    public function edit($id)
    {
        session_start();
        $this->load->model("CommentsModel");
        $results = $this->CommentsModel->getCommentById($id);
        $this->data['data'] = json_decode(json_encode($results[0]), true);
        $this->data['pageTitle'] = "管理系統 - 留言列表";
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
        $result = $this->CommentsModel->modify($id,$status,$display);
        $json['result'] = $result;
        echo json_encode($json);
        //redirect(site_url("/sitecontent_picture?result=modify"));
    }

    public function update($id){
        $status = $this->input->post("status");
        $display = $this->input->post("display");
        $reply = $this->input->post("reply");
        $this->load->model("CommentsModel");
        $data = array('status' => $status,'display' => $display,'reply' => $reply);
        $this->db->where('Id', $id);
        $this->db->update('comments', $data);
        redirect(site_url("/comments_list?result=modify"));
    }
*/
}