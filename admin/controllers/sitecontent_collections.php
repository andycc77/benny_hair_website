<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitecontent_collections extends CI_Controller {
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
        $this->load->model("CollectionsModel");
        $results = $this->CollectionsModel->getCollections();
        $this->data['data'] = json_decode(json_encode($results), true);
        $this->load->model("AlbumModel");
        $albumitem = $this->AlbumModel->getAlbumlistOption();
        $this->data['albumitem'] = json_decode(json_encode($albumitem), true);

        //$this->data['albumitem'] = $this->albumlistOption();
        $this->data['pageTitle'] = "管理系統 - 精選作品";
        $this->data['subview'] = 'sitecontent/sitecontent_collections';
        $this->load->view('admin/_main',$this->data);
    }

    public function modify($id){
        $collectionname = $this->input->post("collectionname");
        $albumname = $this->input->post("albumname");
        $json['id']=$id;
        $json['collectionname']=$collectionname;
        $this->load->model("CollectionsModel");
        $result = $this->CollectionsModel->update($id,$collectionname,$albumname);
        $json['result'] = $result;
        echo json_encode($json);
        //redirect(site_url("/sitecontent_picture?result=modify"));
    }

    public function albumlistOption(){
        $this->load->model("AlbumModel");
        $results = $this->AlbumModel->getAlbumlistOption();
        $array = json_decode(json_encode($results), true);
        $html = '';
        if (is_array($array)) {
            foreach ($array as $k => $v) {
                $html .= "<option selected value=\"{$v['Id']}\">{$v['Name']}</option>";
            }
        }
        return $html;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */