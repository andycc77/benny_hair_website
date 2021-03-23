<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contactmodel extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
    function getContacts(){
        $this->db->select("Id,Time,Name,Email,Phone,Main");
        $this->db->from('contact');
        $this->db->order_by("Id","Desc");//由大到小排序
        $query = $this->db->get();

        return $query->result(); //無資料時回傳 null
    }
}
