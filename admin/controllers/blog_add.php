<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog_add extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('web');
        session_start();
        if(!isset($_SESSION["user"]) && $_SESSION["user"] == null){ //已經登入的話直接回首頁
            redirect(site_url("/admin")); //轉回首頁
            return true;
        }
        $this->load->library('ckeditor');
        $this->load->library('ckfinder');
        $this->ckeditor->basePath = base_url().'asset/ckeditor/';
        $this->ckeditor->config['toolbar'] = array(
                        array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
                                                            );
        $this->ckeditor->config['width'] = '730px';
        $this->ckeditor->config['height'] = '300px';
        $this->ckeditor->config['language'] = 'zh-tw';
        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../asset/ckfinder/');
    }
    public function index(){
        $this->load->model("AlbumModel");
        $this->data['data']['blogkinditem'] = $this->blogkindlistOption();
        $this->data['pageTitle'] = "部落格 - 新增文章";
        $this->data['subview'] = 'blog/add';
        $this->load->view('admin/_main',$this->data);
    }

    public function add(){
        $name = $this->input->post("name");
        $kind= $this->input->post("kind");
        $time_from= $this->input->post("time_from");
        $time_from= strtotime($time_from)+28800;
        $Hpic= $this->input->post("Hpic");
        $main = $this->input->post("main");
        $top = $this->input->post("top");
        $this->load->model("ArticleModel");
        $this->ArticleModel->insert($name,$kind,$time_from,$Hpic,$main,$top); //完成新增動作
        redirect(site_url("/blog_list?result=success"));

    }

    public function blogkindlistOption(){
        $this->load->model("Blog_kindModel");
        $results = $this->Blog_kindModel->getblogkindlistOption();
        $array = json_decode(json_encode($results), true);
        $html = '';
        if (is_array($array)) {
            foreach ($array as $k => $v) {
                $html .= "<option value=\"{$v['Id']}\">{$v['Name']}</option>";
            }
        }
        return $html;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */