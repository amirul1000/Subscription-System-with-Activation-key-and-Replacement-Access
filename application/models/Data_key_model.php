<?php

/**
 * Author: Amirul Momenin
 * Desc:Data_key Model
 */
class Data_key_model extends CI_Model
{
	protected $data_key = 'data_key';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get data_key by id
	 *@param $id - primary key to get record
	 *
     */
    function get_data_key($id){
        $result = $this->db->get_where('data_key',array('id'=>$id))->row_array();
		if(!(array)$result){
			$fields = $this->db->list_fields('data_key');
			foreach ($fields as $field)
			{
			   $result[$field] = ''; 	  
			}
		}
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    } 
	
    /** Get all data_key
	 *
     */
    function get_all_data_key(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('data_key')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit data_key
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_data_key($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('data_key')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count data_key rows
	 *
     */
	function get_count_data_key(){
       $result = $this->db->from("data_key")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	
	 /** Get all users-data_key
	 *
     */
    function get_all_users_data_key(){
        $this->db->order_by('id', 'desc');
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('data_key')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit users-data_key
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_users_data_key($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('data_key')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count users-data_key rows
	 *
     */
	function get_count_users_data_key(){
	   $this->db->where('users_id', $this->session->userdata('id'));
       $result = $this->db->from("data_key")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new data_key
	 *@param $params - data set to add record
	 *
     */
    function add_data_key($params){
        $this->db->insert('data_key',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update data_key
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_data_key($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('data_key',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete data_key
	 *@param $id - primary key to delete record
	 *
     */
    function delete_data_key($id){
        $status = $this->db->delete('data_key',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}
