<?php

/**
 * Author: Amirul Momenin
 * Desc:Subscription Model
 */
class Subscription_model extends CI_Model
{
	protected $subscription = 'subscription';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get subscription by id
	 *@param $id - primary key to get record
	 *
     */
    function get_subscription($id){
        $result = $this->db->get_where('subscription',array('id'=>$id))->row_array();
		if(!(array)$result){
			$fields = $this->db->list_fields('subscription');
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
	
    /** Get all subscription
	 *
     */
    function get_all_subscription(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('subscription')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit subscription
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_subscription($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('subscription')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count subscription rows
	 *
     */
	function get_count_subscription(){
       $result = $this->db->from("subscription")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	
	 /** Get all users-subscription
	 *
     */
    function get_all_users_subscription(){
        $this->db->order_by('id', 'desc');
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('subscription')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit users-subscription
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_users_subscription($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('subscription')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count users-subscription rows
	 *
     */
	function get_count_users_subscription(){
	   $this->db->where('users_id', $this->session->userdata('id'));
       $result = $this->db->from("subscription")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new subscription
	 *@param $params - data set to add record
	 *
     */
    function add_subscription($params){
        $this->db->insert('subscription',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update subscription
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_subscription($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('subscription',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete subscription
	 *@param $id - primary key to delete record
	 *
     */
    function delete_subscription($id){
        $status = $this->db->delete('subscription',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}
