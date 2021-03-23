<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog_list extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('web');
    }

    public function index()
    {
        session_start();
        $this->load->model("ArticleModel");
        $results = $this->ArticleModel->getArticles();
        $this->data['data'] = json_decode(json_encode($results), true);
        $this->data['pageTitle'] = "管理系統 - 文章管理";
        $this->data['subview'] = 'blog/list';
        $this->load->view('admin/_main',$this->data);
    }
    public function edit($id)
    {
        session_start();
        $this->load->model("ArticleModel");
        $results = $this->ArticleModel->getArticleById($id);
        $this->data['data'] = json_decode(json_encode($results[0]), true);
        $blog_kind_id = $this->data['data']['blog_kind_id'];
        $this->data['data']['blogkinditem'] = $this->blogkindlistOption($blog_kind_id);
        $this->data['pageTitle'] = "管理系統 - 留言列表";
        $this->data['subview'] = 'blog/edit';
        $this->load->view('admin/_main',$this->data);
    }
    public function del($id){
        $this->load->model("ArticleModel");
        $this->ArticleModel->del($id);
        redirect(site_url("/blog_list?result=del"));
    }
/*
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
*/
    public function update($id){
        $name = $this->input->post("name");
        $kind = $this->input->post("kind");
        $time_from = $this->input->post("time_from");
        $time_from= strtotime($time_from)+28800;
        $Hpic = $this->input->post("Hpic");
        $main = $this->input->post("main");
        $top = $this->input->post("top");
        $this->load->model("ArticleModel");
        $result = $this->ArticleModel->update($id,$name,$kind,$time_from,$Hpic,$main,$top);
        redirect(site_url("/blog_list?result=modify"));
    }

    public function blogkindlistOption($blog_kind_id){
        $this->load->model("Blog_kindModel");
        $results = $this->Blog_kindModel->getblogkindlistOption();
        $array = json_decode(json_encode($results), true);
        $html = '';
        if (is_array($array)) {
            foreach ($array as $k => $v) {
                if($v['Id']==$blog_kind_id){
                    $html .= "<option selected value=\"{$v['Id']}\">{$v['Name']}</option>";
                }else{
                    $html .= "<option value=\"{$v['Id']}\">{$v['Name']}</option>";
                }
            }
        }
        return $html;
    }
}