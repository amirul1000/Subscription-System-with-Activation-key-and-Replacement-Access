<?php

/**
 * Author: Amirul Momenin
 * Desc:Subscription_history Model
 */
class Subscription_history_model extends CI_Model
{
	protected $subscription_history = 'subscription_history';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get subscription_history by id
	 *@param $id - primary key to get record
	 *
     */
    function get_subscription_history($id){
        $result = $this->db->get_where('subscription_history',array('id'=>$id))->row_array();
		if(!(array)$result){
			$fields = $this->db->list_fields('subscription_history');
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
	
    /** Get all subscription_history
	 *
     */
    function get_all_subscription_history(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('subscription_history')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit subscription_history
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_subscription_history($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('subscription_history')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count subscription_history rows
	 *
     */
	function get_count_subscription_history(){
       $result = $this->db->from("subscription_history")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	
	 /** Get all users-subscription_history
	 *
     */
    function get_all_users_subscription_history(){
        $this->db->order_by('id', 'desc');
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('subscription_history')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit users-subscription_history
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_users_subscription_history($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('subscription_history')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count users-subscription_history rows
	 *
     */
	function get_count_users_subscription_history(){
	   $this->db->where('users_id', $this->session->userdata('id'));
       $result = $this->db->from("subscription_history")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new subscription_history
	 *@param $params - data set to add record
	 *
     */
    function add_subscription_history($params){
        $this->db->insert('subscription_history',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update subscription_history
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_subscription_history($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('subscription_history',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete subscription_history
	 *@param $id - primary key to delete record
	 *
     */
    function delete_subscription_history($id){
        $status = $this->db->delete('subscription_history',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}
