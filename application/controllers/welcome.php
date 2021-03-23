<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('web');
    }
	public function index()
	{
        //banner
        $this->load->model("BannerModel");
        $banner = $this->BannerModel->getBanner();
        $this->data['data']['banner'] = json_decode(json_encode($banner), true);

        //video
        $this->load->model("VideoModel");
        $query = $this->db->get('video');
        foreach ($query->result() as $row)
        {
            $video[] = $row->Url;
        }
        $this->data['data']['video'] = $video;

        //about
        $this->load->model("AboutModel");
        $query = $this->db->get('about');
        foreach ($query->result() as $row)
        {
            $rule = $row->Rule;
            $content = $row->Content;
        }
        $this->data['data']['rule'] = $rule;
        $this->data['data']['content'] = $content;
        $this->load->model("PriceModel");
        $results = $this->PriceModel->getImg();
        $this->data['data']['price'] = json_decode(json_encode($results), true);
        //pic1
        $this->load->model("CollectionsModel");
        $pic1 = $this->CollectionsModel->getCollections_1();
        $this->data['data']['pic1'] = json_decode(json_encode($pic1), true);
        $this->load->model("AlbumModel");
        $pic1Ary = explode(',', $this->data['data']['pic1'][0]['AlbumId']);
        $albums = $this->AlbumModel->getAlbumInId($pic1Ary);
        $this->data['data']['pic1']['albums'] = json_decode(json_encode($albums), true);

        //pic2
        $this->load->model("CollectionsModel");
        $pic2 = $this->CollectionsModel->getCollections_2();
        $this->data['data']['pic2'] = json_decode(json_encode($pic2), true);
        $this->load->model("AlbumModel");
        $pic2Ary = explode(',', $this->data['data']['pic2'][0]['AlbumId']);
        $albums = $this->AlbumModel->getAlbumInId($pic2Ary);
        $this->data['data']['pic2']['albums'] = json_decode(json_encode($albums), true);

        //pic3
        $this->load->model("CollectionsModel");
        $pic3 = $this->CollectionsModel->getCollections_3();
        $this->data['data']['pic3'] = json_decode(json_encode($pic3), true);
        $this->load->model("AlbumModel");
        $pic3Ary = explode(',', $this->data['data']['pic3'][0]['AlbumId']);
        $albums = $this->AlbumModel->getAlbumInId($pic3Ary);
        $this->data['data']['pic3']['albums'] = json_decode(json_encode($albums), true);

        //pic4
        $this->load->model("CollectionsModel");
        $pic4 = $this->CollectionsModel->getCollections_4();
        $this->data['data']['pic4'] = json_decode(json_encode($pic4), true);
        $this->load->model("AlbumModel");
        $pic4Ary = explode(',', $this->data['data']['pic4'][0]['AlbumId']);
        $albums = $this->AlbumModel->getAlbumInId($pic4Ary);
        $this->data['data']['pic4']['albums'] = json_decode(json_encode($albums), true);

        //news
        $this->load->model("ArticleModel");
        $news = $this->ArticleModel->getArticless();
        $this->data['data']['news'] = json_decode(json_encode($news), true);

		$this->load->view('main',$this->data);
	}

    public function insertmessage(){
        $name = $this->input->post("name");
        $email = $this->input->post("email");
        $phone = $this->input->post("phone");
        $message = $this->input->post("message");
        $this->db->insert('contact',array('Name'=>$name,'Email'=>$email,'Phone'=>$phone,'Main'=>$message,'Time'=>time()+28800));
        $json['result'] = 'success';
        echo json_encode($json);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */