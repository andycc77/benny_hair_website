<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog_kindModel extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }


    function getKinds(){
        $this->db->select("Id,Name");
        $this->db->from('blog_kind');
        $this->db->order_by("Id","Asc");//由大到小排序
        $query = $this->db->get();

        return $query->result(); //無資料時回傳 null
    }

    function getblogkindlistOption(){
        $this->db->select("Id,Name");
        $this->db->from('blog_kind');
        $this->db->order_by("Id","Asc");//由大到小排序
        $query = $this->db->get();

        return $query->result(); //無資料時回傳 null
    }

    function del($id){
        $this->db->delete('blog_kind', array('Id' => $id));
    }

    function modify($id,$name){
        $data = array(
        'Name' => $name
        );

        $this->db->where('Id', $id);
        $this->db->update('blog_kind', $data);
        return 'updated';
    }
}
