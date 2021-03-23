<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CollectionsModel extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }



    function getCollections(){
        $this->db->select("Id,AlbumId,Collectionname");
        $this->db->from('collections');
        $this->db->order_by("Id","asc");//由大到小排序
        $query = $this->db->get();

        return $query->result(); //無資料時回傳 null
    }

    function del($id){
        $this->db->delete('collections', array('Id' => $id));
    }

    function update($id,$collectionname,$albumname){
        $data = array('AlbumId' =>$albumname,
        'Collectionname' => $collectionname
        );
        $this->db->where('Id', $id);
        $this->db->update('collections', $data);
        return 'updated';
    }

}
