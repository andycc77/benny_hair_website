<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Album_picModel extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function insert($name,$desc,$time_from,$time_to,$Hpic,$Lpic){
        $this->db->insert("album_pic",
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
        $this->db->from('album_pic');
        $this->db->order_by("Id","Desc");//由大到小排序
        $query = $this->db->get();

        return $query->result(); //無資料時回傳 null
    }

    function delitem($id){
        //$this->db->delete('album_pic', array('Id' => $id));
        $data = array(
        'display' => 'N'
        );

        $this->db->where('Id', $id);
        $this->db->update('album_pic', $data);
    }

    function getPicById($id){
        $this->db->select("Id,Name,AlbumId");
        $this->db->where('AlbumId', $id);
        $this->db->where('display', 'Y');
        $this->db->from('album_pic');
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
        $this->db->update('album_pic', $data);
    }

}
