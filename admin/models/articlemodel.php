<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ArticleModel extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function insert($name,$kind,$time_from,$Hpic,$main,$top){
        $this->db->insert("article",
            Array(
            "Title" =>  $name,
            "blog_kind_id" => $kind,
            "Time" => $time_from,
            "Pic" => $Hpic,
            "Content" => $main,
            "Author" => '1',
            "articleOrder" => $top
        ));
    }

    function getArticles(){
        $this->db->select("ArticleID,Pic,Author,Title,Content,blog_kind_id,Time");
        $this->db->from('article');
        //$this->db->order_by("ArticleID","ASC");//由大到小排序
        $this->db->order_by("articleOrder Desc,Time Desc,ArticleID Desc");//由大到小排序
        $query = $this->db->get();

        return $query->result(); //無資料時回傳 null
    }

    function del($id){
        $this->db->delete('article', array('ArticleID' => $id));
    }

    function getArticleById($id){
        $this->db->select("ArticleID,Pic,Author,Title,Content,blog_kind_id,Time,articleOrder");
        $this->db->where('ArticleID', $id);
        $this->db->from('article');
        $query = $this->db->get();

        return $query->result(); //無資料時回傳 null
    }

    function update($id,$name,$kind,$time_from,$Hpic,$main,$top){
        $data = array(
        'Title' => $name,
        'blog_kind_id' => $kind,
        'Time' => $time_from,
        'Pic' => $Hpic,
        'Content' => $main,
        'articleOrder' => $top,
        );

        $this->db->where('ArticleID', $id);
        $this->db->update('article', $data);
        return 'updated';
    }
}
