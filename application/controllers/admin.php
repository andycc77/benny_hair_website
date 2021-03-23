<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('web');
    }

    public function index()
    {
        //if($this->session->userdata('username')){
            //redirect($this->link);
       // }
        $this->data['subview'] = 'admin/login';
        $this->load->view('admin/_main',$this->data);
    }

    public function in()
    {
        $username = trim( $_POST['username'] );
        $password = trim( $_POST['password'] );

        $result = api_login($username, $password);

        if(empty($result) || !isset($result['staff_id'])) {
            $this->session->set_flashdata('error', 'Login/Password incorrect.');
            redirect('login/index');
        }

        $this->session->set_userdata($result);
        redirect($this->link);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */