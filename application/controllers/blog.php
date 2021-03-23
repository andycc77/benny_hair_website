<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('web');
    }
    public function index($blog_kind_id=null)
    {
        if(isset($blog_kind_id)){
            $this->load->model("ArticleModel");
            $news = $this->ArticleModel->getArticlesbykind($blog_kind_id);
            $this->data['data']['news'] = json_decode(json_encode($news), true);
        }else if(isset($_POST['keyword'])){
            $keyword = $_POST['keyword'];
            $this->load->model("ArticleModel");
            $news = $this->ArticleModel->getArticlesbykeyword($keyword);
            $this->data['data']['news'] = json_decode(json_encode($news), true);
        }else{
            $this->load->model("ArticleModel");
            $news = $this->ArticleModel->getArticles();
            $this->data['data']['news'] = json_decode(json_encode($news), true);
        }
        $this->load->view('blog',$this->data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */