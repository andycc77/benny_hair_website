<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class PriceModel extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function getImg(){
        $this->db->select("url,name");
        $this->db->from('header');
        $this->db->order_by("sno","asc");//由小到大排序
        $query = $this->db->get();

        return $query->result(); //無資料時回傳 null
    }

}
