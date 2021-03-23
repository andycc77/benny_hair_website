<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog_kind extends CI_Controller {
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
        $this->load->model("Blog_kindModel");
        $results = $this->Blog_kindModel->getKinds();
        $this->data['data'] = json_decode(json_encode($results), true);
        $this->data['pageTitle'] = "部落格 - 文章分類";
        $this->data['subview'] = 'blog/kind';
        $this->load->view('admin/_main',$this->data);
    }

    public function add(){
        $name = $this->input->post("name");
        $this->db->insert('blog_kind',array('Name'=>$name));
        redirect(site_url("/blog_kind?result=success"));

    }
    public function del($id){
        $this->load->model("Blog_kindModel");
        $this->Blog_kindModel->del($id);
        redirect(site_url("/blog_kind?result=del"));
    }
    public function modify($id){
        $json['id']=$id;
        $name=$_POST['name'];
        $this->load->model("Blog_kindModel");
        $result = $this->Blog_kindModel->modify($id,$name);
        $json['result'] = 'updated';
        echo json_encode($json);
        //redirect(site_url("/sitecontent_picture?result=modify"));
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */