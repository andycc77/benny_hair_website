<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CommentsModel extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }



    function getComments(){
        $this->db->select("Id,Time,Name,Email,Phone,Main,Status,Display,Reply");
        $this->db->from('comments');
        $this->db->order_by("Id","Desc");//由大到小排序
        $query = $this->db->get();

        return $query->result(); //無資料時回傳 null
    }

    function del($id){
        $this->db->delete('comments', array('Id' => $id));
    }

    function modify($id,$status,$display){
        $data = array(
        'Status' => $status,
        'Display' => $display
        );

        $this->db->where('Id', $id);
        $this->db->update('comments', $data);
        return 'updated';
    }

    function getCommentById($id){
        $this->db->select("Id,Time,Name,Email,Phone,Main,Status,Display,Reply");
        $this->db->where('Id', $id);
        $this->db->from('comments');
        $this->db->order_by("Id","Desc");//由大到小排序
        $query = $this->db->get();

        return $query->result(); //無資料時回傳 null
    }
    function getCommentByblogid($id){
        $this->db->select("Id,Time,Name,Email,Phone,Main,Status,Display,Reply");
        $this->db->from('comments');
        $this->db->where('Display', '1');
        $this->db->where('ArticleID', $id);
        $this->db->order_by("Id","Desc");//由大到小排序
        $query = $this->db->get();

        return $query->result(); //無資料時回傳 null
    }
    function update($id,$status,$display,$reply){
        $data = array(
        'Status' => $status,
        'Display' => $display,
        'Reply' => $reply,
        );

        $this->db->where('Id', $id);
        $this->db->update('comments', $data);
        return 'updated';
    }
}
