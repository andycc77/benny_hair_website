<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Album_list extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('web');
        $this->load->helper(array('url','html','form'));
        session_start();
        if(!isset($_SESSION["user"]) && $_SESSION["user"] == null){ //已經登入的話直接回首頁
            redirect(site_url("/admin")); //轉回首頁
            return true;
        }
    }
    public function index(){
        $this->load->model("AlbumModel");
        $results = $this->AlbumModel->getAlbums();
        $this->data['data'] = json_decode(json_encode($results), true);
        $this->data['pageTitle'] = "管理系統 - 相簿管理";
        $this->data['subview'] = 'album/list';
        $this->load->view('admin/_main',$this->data);
    }

    public function del($id){
        $this->load->model("AlbumModel");
        $this->AlbumModel->del($id);
                redirect(site_url("/album_list?result=del"));
    }
    public function modify($id){
        $name = $this->input->post("name");
        $desc= $this->input->post("desc");
        $time_from= $this->input->post("time_from");
        $time_from= strtotime($time_from)+28800;
        //$time_to= $this->input->post("time_to");
        //$time_to= strtotime($time_to)+28800;
        $Hpic= $this->input->post("Hpic");
        $Lpic= $this->input->post("Lpic");
        $top = $this->input->post("top");
        $this->load->model("AlbumModel");
        $result = $this->AlbumModel->update($id,$name,$desc,$time_from,$Hpic,$Lpic,$top);
        redirect(site_url("/album_list?result=modify"));
    }

    public function edit($id){
        $this->load->model("AlbumModel");
        $results = $this->AlbumModel->getAlbumById($id);
        $this->data['data'] = json_decode(json_encode($results[0]), true);
        $this->data['pageTitle'] = "管理系統 - 相簿管理";
        $this->data['subview'] = 'album/edit';
        $this->load->view('admin/_main',$this->data);
    }

    public function addPic(){
        $this->data['data']['albumitem'] = $this->albumlistOption();
        $this->data['pageTitle'] = "管理系統 - 相簿管理";
        $this->data['subview'] = 'album/addPic';
        $this->load->view('admin/_main',$this->data);
    }

    public function albumlistOption(){
        $this->load->model("AlbumModel");
        $results = $this->AlbumModel->getAlbumlistOption();
        $array = json_decode(json_encode($results), true);
        $html = '';
        if (is_array($array)) {
            foreach ($array as $k => $v) {
                $html .= "<option value=\"{$v['Id']}\">{$v['Name']}</option>";
            }
        }
        return $html;
    }

  public function upload() {
    sleep(2);
   if (!empty($_FILES)) {
    $albumid = $this->input->post("albumid");
    $tempFile = $_FILES['file']['tmp_name'];
    $nameAry = explode('.', $_FILES['file']['name']);
    $name = time().'.'.$nameAry[1];
    $fileName = $name;
    $rename = $_FILES['file']['name'];
    $fileType = $_FILES['file']['type'];

    $fileSize = $_FILES['file']['size'];

    $targetPath = './public/upload/album_pic/';

    $targetFile = $targetPath . $fileName ;

    move_uploaded_file($tempFile, $targetFile);

    // jika anda ingin menyimpannya ke dalam database

    // berikut adalah contoh model sederhana untuk menyimpan kdalam database.



    // sintak untuk menyimpan ke database :

    $this->db->insert('album_pic',array('Type' => $fileType, 'Name' => $fileName, 'Size' => $fileSize,'AlbumId'=>$albumid,'display'=>'Y','rename'=>$rename));

     }
}


    public function item($id){
        $this->load->model("AlbumModel");
        $results = $this->AlbumModel->getAlbumById($id);
        $this->data['data']['album'] = json_decode(json_encode($results[0]), true);
        $this->load->model("Album_picModel");
        $results = $this->Album_picModel->getPicById($id);
        $this->data['data']['pic'] = json_decode(json_encode($results), true);
        $this->data['pageTitle'] = "管理系統 - 相簿管理";
        $this->data['subview'] = 'album/item';
        $this->load->view('admin/_main',$this->data);
    }

    public function delitem($albumid,$id){
        $this->load->model("Album_picModel");
        $results = $this->Album_picModel->delitem($id);
        redirect(site_url("/album_list/item/{$albumid}?result=del"));
    }
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */