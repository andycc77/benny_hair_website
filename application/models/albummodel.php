<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class AlbumModel extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function insert($name,$desc,$time_from,$time_to,$Hpic,$Lpic){
        $this->db->insert("album",
            Array(
            "name" =>  $name,
            "desc" => $desc,
            "time_from" => $time_from,
            "time_to" => $time_to,
            "Hpic" => $Hpic,
            "Lpic" => $Lpic
        ));
    }

    function getAlbums(){
        $this->db->select("Id,Name,Desc,Time_from,Time_to,Hpic,Lpic,Like");
        $this->db->from('album');
        $this->db->order_by("albumOrder Desc,Id Desc");//由大到小排序
        $query = $this->db->get();

        return $query->result(); //無資料時回傳 null
    }

    function del($id){
        $this->db->delete('album', array('Id' => $id));
    }

    function getAlbumById($id){
        $this->db->select("Id,Name,Desc,Time_from,Time_to,Hpic,Lpic,Like");
        $this->db->where('Id', $id);
        $this->db->from('album');
        $this->db->order_by("Id","Desc");//由大到小排序
        $query = $this->db->get();

        return $query->result(); //無資料時回傳 null
    }

    function update($id,$name,$desc,$time_from,$time_to,$Hpic,$Lpic){
        $data = array(
        'Name' => $name,
        'Desc' => $desc,
        'Time_from' => $time_from,
        'Time_to' => $time_to,
        'Hpic' => $Hpic,
        'Lpic' => $Lpic
        );

        $this->db->where('Id', $id);
        $this->db->update('album', $data);
    }

    function getAlbumlistOption(){
        $this->db->select("Id,Name");
        $this->db->from('album');
        $this->db->order_by("Id","Desc");//由大到小排序
        $query = $this->db->get();

        return $query->result(); //無資料時回傳 null
    }

    function getAlbumInId($ids){
        $this->db->select("Id,Name,Desc,Time_from,Time_to,Hpic,Lpic,Like");
        $this->db->where_in('Id', $ids);
        $this->db->from('album');
        $this->db->limit(2);
        $this->db->order_by("Id","Desc");//由大到小排序
        $query = $this->db->get();

        return $query->result(); //無資料時回傳 null
    }

    function getAlbumslimit6(){
        $this->db->select("Id,Name,Desc,Time_from,Time_to,Hpic,Lpic,Like");
        $this->db->from('album');
        $this->db->order_by("Id","Desc");//由大到小排序
        $this->db->limit(6);
        $query = $this->db->get();

        return $query->result(); //無資料時回傳 null
    }

    function getAlbums_orderbytime(){
        $this->db->select("Id,Name,Desc,Time_from,Time_to,Hpic,Lpic,Like");
        $this->db->from('album');

        $this->db->order_by("albumOrder Desc,Time_from Desc,Id Desc");//由大到小排序
        $query = $this->db->get();

        return $query->result(); //無資料時回傳 null
    }
}
