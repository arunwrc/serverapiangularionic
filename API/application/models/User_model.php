<?php
class User_model extends CI_Model {

    public function get_all(){
        $this->db->order_by("id", "desc");
        $query = $this->db->get('user');
        return $query->result();
    }

    public function get_by_id($id){
        $query = $this->db->get_where('user_types',array('id' => $id));
        return $query->row_array();
    }

    public function update($id,$data){
        $this->db->where('id',$id);
        $this->db->update('user',$data);
    }

    public function delete_data($id){
        $this->db->where('id', $id);
        $this->db->delete('user');
    }

}