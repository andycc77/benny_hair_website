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
        $this->db->select("ArticleID,Pic,Author,Title,Content,blog_kind_id,Time,articleOrder");
        $this->db->from('article');
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

    function update($id,$name,$kind,$time_from,$Lpic,$main,$top){
        $data = array(
        'Title' => $name,
        'blog_kind_id' => $kind,
        'Time' => $time_from,
        'Pic' => $Lpic,
        'Content' => $main,
        'articleOrder' => $top,
        );

        $this->db->where('ArticleID', $id);
        $this->db->update('article', $data);
        return 'updated';
    }

    function getArticless(){
        $this->db->select("ArticleID,Pic,Author,Title,Content,blog_kind_id,Time,articleOrder");
        $this->db->from('article');
        $this->db->limit(10);
        $this->db->order_by("articleOrder Desc,Time Desc,ArticleID Desc");//由大到小排序
        $query = $this->db->get();

        return $query->result(); //無資料時回傳 null
    }

   function blog_kind(){
        $return = array();
        $sqlstr = "select Id,Name,(select count(ArticleID) from article where blog_kind_id=Id) count from blog_kind";

        $results = $this->db->query($sqlstr);
        $results = $results->result();
        foreach ($results as $res){
            $return['name'][] = $res->Name;
            $return['id'][] = $res->Id;
            $return['count'][] = $res->count;
        }
        return $return;
    }

    function getArticlesbykind($blog_kind_id){
        $this->db->select("ArticleID,Pic,Author,Title,Content,blog_kind_id,Time,articleOrder");
        $this->db->from('article');
        $this->db->where('blog_kind_id', $blog_kind_id);
        $this->db->order_by("articleOrder Desc,Time Desc,ArticleID Desc");//由大到小排序
        $query = $this->db->get();

        return $query->result(); //無資料時回傳 null
    }

    function getArticlesbykeyword($keyword){
        $sqlstr = "select ArticleID,Pic,Author,Title,Content,blog_kind_id,Time,articleOrder from blog_kind where Title like "."%".$keyword."%";
        $this->db->select("ArticleID,Pic,Author,Title,Content,blog_kind_id,Time,articleOrder");
        $this->db->from('article');
        $this->db->like('Title', $keyword);
        $this->db->order_by("articleOrder Desc,Time Desc,ArticleID Desc");//由大到小排序
        $query = $this->db->get();

        return $query->result(); //無資料時回傳 null
    }
}
