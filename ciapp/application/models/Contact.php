<?php

class Contact extends CI_Model {

    public $id;
    public $name;
    public $phone;
    public $note;

    public function exists($id)
    {
        $query = $this->db->query(
            'SELECT name FROM entries WHERE id='.$id.' LIMIT 0,1'
        );
        $result = $query->result_array();
        if(isset($result[0])) {
            //___debug($result[0]['name']);
            return true;
        }
        return false;
    }

    public function search($query, $start_time, $end_time, $offset=0, $limit=10)
    {

        $this->db->select('*');
        //$this->db->from('entries');
        $where = '';

        if($query != null) {
            $where.= 'name LIKE "%'.$query.'%" OR phone LIKE "%'.$query.'%" OR note LIKE "%'.$query.'%" ';
        }
        if($start_time != null) {
            if($where) { $where.= 'AND '; }
            $start = date("Y-m-d", strtotime($start_time)) . ' 00:00:00';
            $where.= 'created_at >= "'.$start.'" ';
        }
        if($end_time) {
            if($where) { $where.= 'AND '; }
            $end = date("Y-m-d", strtotime($end_time)) . ' 23:59:59';
            $where.= 'created_at <= "'.$end.'" ';
        }
        if($where) {
            $this->db->where($where);
        }
        $this->db->limit($limit, $offset);

        $result = $this->db->get("entries");
        return $result->result_array();

    }

    public function count_all()
    {
        return $this->db->count_all("entries");
    }

    public function add($data)
    {
        return $this->db->insert('entries', array(
            'name'          => $data['name'],
            'phone'         => $data['phone'],
            'note'          => $data['note'],
            'created_at'    => date('Y-m-d H:i:s')
        ));
    }

    public function update($id, $data)
    {
        if($this->exists($id) == false) {
            // We can also throw an exception over here
            // instead of adding a new entry
            return $this->add($data);
        }
        return $this->db->update('entries', array(
            'name'          => $data['name'],
            'phone'         => $data['phone'],
            'note'          => $data['note']
        ), 'id = '.$id);
    }

    public function delete($id)
    {
        return $this->db->delete('entries', 'id = ' .$id);
    }

}