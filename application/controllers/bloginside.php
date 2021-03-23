<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bloginside extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('web');
    }
    public function index($id)
    {
        $this->load->model("ArticleModel");
        $results = $this->ArticleModel->getArticleById($id);
        $this->data['data'] = json_decode(json_encode($results[0]), true);

        //all album
        $this->load->model("AlbumModel");
        $albums = $this->AlbumModel->getAlbumslimit6();
        $this->data['data']['albums'] = json_decode(json_encode($albums), true);
        //all article
        $this->load->model("ArticleModel");
        $articless = $this->ArticleModel->getarticless();
        $this->data['data']['all'] = json_decode(json_encode($articless), true);
        //分類
        $blog_kind = $this->ArticleModel->blog_kind();
        $this->data['data']['blog_kind'] =json_decode(json_encode($blog_kind), true);

        //留言
        $this->load->model("CommentsModel");
        $comments = $this->CommentsModel->getCommentByblogid($id);
        $this->data['data']['comments'] = json_decode(json_encode($comments), true);
        $this->load->view('blog-inside',$this->data);
    }

    public function insertmessage(){
        $name = $this->input->post("name");
        $email = $this->input->post("email");
        $phone = $this->input->post("phone");
        $message = $this->input->post("message");
        $ArticleID = $this->input->post("ArticleID");
        $this->db->insert('comments',array('Name'=>$name,'Email'=>$email,'Phone'=>$phone,'Main'=>$message,'Time'=>time()+28800,'ArticleID'=>$ArticleID));
        $json['result'] = 'success';
        echo json_encode($json);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */