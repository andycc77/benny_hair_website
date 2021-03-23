<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class BannerModel extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function insert($pic,$order,$status){
        $this->db->insert("banner",
            Array(
            "pic" =>  $pic,
            "order" => $order,
            "status" => $status
        ));
    }

    function getBanner(){
        $this->db->select("Id,Pic,Order,Status");
        $this->db->from('banner');
        $this->db->where('Status', 1);
        $this->db->order_by("Order Desc,Id Desc");//由大到小排序
        $query = $this->db->get();

        return $query->result(); //無資料時回傳 null
    }

    function del($id){
        $this->db->delete('banner', array('Id' => $id));
    }

    function update($id,$status,$order){
        $data = array(
        'Status' => $status,
        'Order' => $order
        );

        $this->db->where('Id', $id);
        $this->db->update('banner', $data);
        return 'updated';
    }

}
