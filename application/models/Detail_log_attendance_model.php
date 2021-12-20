<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Detail_log_attendance_model extends CI_Model
{

    public $table = 'detail_log_attendance';
    public $id = '';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_log_attendance,id_student,description');
        $this->datatables->from('detail_log_attendance');
        //add this line for join
        //$this->datatables->join('table2', 'detail_log_attendance.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('detail_log_attendance/read/$1'),'Read')." | ".anchor(site_url('detail_log_attendance/update/$1'),'Update')." | ".anchor(site_url('detail_log_attendance/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), '');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('', $q);
	$this->db->or_like('id_log_attendance', $q);
	$this->db->or_like('id_student', $q);
	$this->db->or_like('description', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('', $q);
	$this->db->or_like('id_log_attendance', $q);
	$this->db->or_like('id_student', $q);
	$this->db->or_like('description', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Detail_log_attendance_model.php */
/* Location: ./application/models/Detail_log_attendance_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-12-20 19:59:46 */
/* http://harviacode.com */