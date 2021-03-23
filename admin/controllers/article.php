<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('web');
    }
    public function author()
    {
        $this->data['subview'] = 'article/article_author';
        $this->load->view('admin/_main',$this->data);
    }

    public function post(){
        $this->data['subview'] = 'article/article_post';
        $this->load->view('admin/_main',$this->data);
    }

    public function edit(){
        $this->data['subview'] = 'article/article_edit';
        $this->load->view('admin/_main',$this->data);
    }

}