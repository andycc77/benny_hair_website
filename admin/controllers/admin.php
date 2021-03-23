<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('web');
    }
    public function index(){
        $this->data['subview'] = 'admin/login';
        $this->load->view('admin/_main',$this->data);
    }
    public function register()
    {
        $this->data['subview'] = 'admin/register';
        $this->load->view('admin/_main',$this->data);
    }

    public function registering(){
        $account = $this->input->post("username");
        $password= $this->input->post("password");
        $passwordrt= $this->input->post("passwordrt");

       if( trim($password) =="" || trim($account) =="" ){
            $this->data['account'] = $account;
            $this->data['errorMessage'] = "Account or Password shouldn't be empty,please check!";
            $this->data['subview'] = 'admin/register';
            $this->load->view('admin/_main',$this->data);
            return false;
        }

        if( $password != $passwordrt ){
            //如果不一致，我們讀取 register view，
            //但將 $account 跟錯誤訊息帶入作為處理
            $this->data['account'] = $account;
            $this->data['errorMessage'] = "Password doesn't match re-type password,please check yout input!";
            $this->data['subview'] = 'admin/register';
            $this->load->view('admin/_main',$this->data);
            return false;
        }

        $this->load->model("UserModel");
        if($this->UserModel->checkUserExist(trim($account))){ //檢查帳號是否重複
            $this->data['account'] = $account;
            $this->data['errorMessage'] = "This account is already in used.";
            $this->data['subview'] = 'admin/register';
            $this->load->view('admin/_main',$this->data);
            return false;
        }
        $this->UserModel->insert(trim($account),trim($password)); //完成新增動作
        $this->data['account'] = $account;
        $this->data['subview'] = 'admin/register_success';
        $this->load->view('admin/_main',$this->data);

    }

    public function login(){
        session_start();
        if(isset($_SESSION["user"]) && $_SESSION["user"] != null){ //已經登入的話直接回首頁
            redirect(site_url("/sitecontent_picture")); //轉回首頁
            return true;
        }

        $this->data['pageTitle'] = "管理系統 - 登入";
        $this->data['subview'] = 'admin/login';
        $this->load->view('admin/_main',$this->data);
    }
    public function logining(){
        session_start();
        if(isset($_SESSION["user"]) && $_SESSION["user"] != null){ //已經登入的話直接回首頁
            redirect(site_url("/sitecontent_picture")); //轉回首頁
            return true;
        }

        $account = trim($this->input->post("username"));
        $password = md5(trim($this->input->post("password")));

        $this->load->model("UserModel");
        $user = $this->UserModel->getUser($account,$password);
        if($user == null or !isset($user)){
            $this->data['debug'] = $user.'-'.$password;
            $this->data['account'] = $account;
            $this->data['pageTitle'] = "管理系統 - 登入";
            $this->data['errorMessage'] = "使用者或密碼錯誤";
            $this->data['subview'] = 'admin/login';
            $this->load->view('admin/_main',$this->data);
            return true;
        }
        $_SESSION["user"] = $user;
        $_SESSION["upload_folder"] = base_url('public/upload_file/');
        redirect(site_url("/sitecontent_picture")); //轉回首頁
    }

    public function logout(){
        session_start();
        session_destroy();
        redirect(site_url("/admin/login")); //轉回登入頁
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */