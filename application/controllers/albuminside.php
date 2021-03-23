<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Albuminside extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('web');
    }
    public function index($id)
    {
        $this->load->model("AlbumModel");
        $results = $this->AlbumModel->getAlbumById($id);
        $this->data['data']['album'] = json_decode(json_encode($results[0]), true);
        $this->load->model("Album_picModel");
        $results = $this->Album_picModel->getPicById($id);
        $this->data['data']['pic'] = json_decode(json_encode($results), true);
        $this->load->view('album-inside',$this->data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */