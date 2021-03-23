<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {
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
        $this->data['subview'] = 'blog/list';
        $this->load->view('admin/_main',$this->data);
    }
}