<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Album extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('web');
    }
    public function index()
    {
        $this->load->model("AlbumModel");
        $results = $this->AlbumModel->getAlbums_orderbytime();
        $this->data['data'] = json_decode(json_encode($results), true);
        $this->load->view('album',$this->data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */