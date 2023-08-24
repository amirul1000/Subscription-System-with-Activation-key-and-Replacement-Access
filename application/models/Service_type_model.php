<?php

/**
 * Author: Amirul Momenin
 * Desc:Service_type Model
 */
class Service_type_model extends CI_Model
{
	protected $service_type = 'service_type';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get service_type by id
	 *@param $id - primary key to get record
	 *
     */
    function get_service_type($id){
        $result = $this->db->get_where('service_type',array('id'=>$id))->row_array();
		if(!(array)$result){
			$fields = $this->db->list_fields('service_type');
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
	
    /** Get all service_type
	 *
     */
    function get_all_service_type(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('service_type')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit service_type
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_service_type($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('service_type')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count service_type rows
	 *
     */
	function get_count_service_type(){
       $result = $this->db->from("service_type")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	
	 /** Get all users-service_type
	 *
     */
    function get_all_users_service_type(){
        $this->db->order_by('id', 'desc');
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('service_type')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit users-service_type
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_users_service_type($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('service_type')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count users-service_type rows
	 *
     */
	function get_count_users_service_type(){
	   $this->db->where('users_id', $this->session->userdata('id'));
       $result = $this->db->from("service_type")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new service_type
	 *@param $params - data set to add record
	 *
     */
    function add_service_type($params){
        $this->db->insert('service_type',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update service_type
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_service_type($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('service_type',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete service_type
	 *@param $id - primary key to delete record
	 *
     */
    function delete_service_type($id){
        $status = $this->db->delete('service_type',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}
