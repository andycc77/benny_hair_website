<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitecontent_about extends CI_Controller {
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
        $this->load->model("AboutModel");
        $query = $this->db->get('about');
        foreach ($query->result() as $row)
        {
            $rule = $row->Rule;
            $content = $row->Content;
        }
        $this->data['pageTitle'] = "管理系統 - 關於我";
        $this->data['subview'] = 'sitecontent/sitecontent_about';
        $this->data['data']['rule'] = $rule;
        $this->data['data']['content'] = $content;
        $this->load->view('admin/_main',$this->data);
    }

    public function update(){
        $content = $this->input->post("content");
        $rule = $this->input->post("rule");
        $rule = implode(';;;',$rule);
        $this->load->model("VideoModel");
        $data = array('Content' => $content,'Rule' => $rule);
        $this->db->update('about', $data);
        redirect(site_url("/sitecontent_about?result=success"));
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */