<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author: Amirul Momenin
 * Desc:Landing Page
 */
class Homecontroller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->helper(array(
            'cookie',
            'url'
        ));
		$this->load->model('Subscription_model');
		$this->load->model('Subscription_history_model');
        $this->load->database();
        if (! $this->session->userdata('validated')) {
            redirect('member/login/index');
        }
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $data['_view'] = 'member_homepage';
        $this->load->view('layouts/member/body', $data);
    }
	
	/*function load_activation_key(){
		$this->db->order_by('activation_key', 'asc');
		$this->db->where('service_type_id', $this->input->post('service_type_id'));
		$this->db->where('status', 'open');
        $result = $this->db->get('data_key')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		echo json_encode($result);
	}*/
	
	function active_key(){
		//$service_type_id = $this->input->post('service_type_id');
		//$subscriptionid = $this->input->post('subscriptionid');
		$activation_key = $this->input->post('activation_key');
		
		//check subscriptionid
		//$this->db->where('users_id', $this->session->userdata('id'));
		$this->db->where('activation_key', $activation_key);
		//$this->db->where('service_type_id', $service_type_id);
        $result = $this->db->get('subscription')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		$data = array();
		if(empty($result)){
			  $data[0]['msg'] = "No data exists with this activation key";
			  echo json_encode($data);
			  exit;
		}
		$id = $result[0]['id'];
		$expiration_date_time = $result[0]['expiration_date_time'];
		$used_count = $result[0]['used_count'];
		$limit_count = $result[0]['limit_count'];
		$current_date_time = date("Y-m-d H:i:s");
		$service_type_id = $result[0]['service_type_id'];
		
		
		
		if(strtotime($current_date_time)>strtotime($expiration_date_time)){
			$data[0]['msg'] = "Expired:Your expired date time :".$result[0]['expiration_date_time'];
		    $data[0]['access'] = '';
			$data[0]['status'] = 'fail';
			 echo json_encode($data);
			 exit;
		}
		else if($used_count>0){
			$data[0]['msg'] = "You already used  this key.please replace from subscription";
			$data[0]['access'] = '';
			$data[0]['status'] = 'fail';
			 echo json_encode($data);
			 exit;
		}
		else if(count($result)>0){
			$obj_data_key =  $this->get_activation_key($service_type_id);
			$data_key_id = '';
			if(empty($obj_data_key)){
				$data[0]['msg'] = "No Open Activation Key";
				$data[0]['access'] = '';
				$data[0]['status'] = 'fail';
			    echo json_encode($data);
			    exit;
			}
			else{
			    $data_key_id = $obj_data_key[0]['id'];
			}
			
			//update
              $updated_at = date("Y-m-d H:i:s");
			  $used_count = $used_count+1;
		      $params = array(
					 'users_id' => $this->session->userdata('id'),
					 'activation_key' => $activation_key, 
					 'used_count' => $used_count,
					 'updated_at' =>$updated_at
					);
					
			 $this->Subscription_model->update_subscription($id,$params);
			 //history
			 	/*$params = array(
		             'users_id' => $this->session->userdata('id'),
					 'subscriptionid' => $subscriptionid,
					 'activation_key' =>$activation_key,
					 'created_at' => date("Y-m-d H:i:s"),
				);
			$this->Subscription_history_model->add_subscription_history($params);*/

			 //update open/close
			     $params =array(
					 'used' => '1',
					 'used_by_users_id' => $this->session->userdata('id'),
					 'used_by_activation_key' => $activation_key,
					 'updated_at' =>$updated_at
					);
			    $this->db->where('id',$data_key_id);
				$status = $this->db->update('data_key',$params);
				$db_error = $this->db->error();
				if (!empty($db_error['code'])){
					echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
					exit;
				}
			 
			 $data[0]['msg'] = "Subscription has been updated successfully";
			 $data[0]['access'] = $obj_data_key;
			 $data[0]['status'] = 'success';
			 echo json_encode($data);		

		}
		
		
		
	}
	
	function get_activation_key($service_type_id){
		$this->db->order_by('id', 'asc');
		$this->db->where('service_type_id', $service_type_id);
		$this->db->where('used', '0');
        $result = $this->db->get('data_key')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		return $result;
	}
	
	
	function replace_key(){
		$this->db->where('id', $this->input->post('id'));
		$this->db->where('service_type_id', $this->input->post('service_type_id'));
        $result = $this->db->get('subscription')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		$data = array();
		if(empty($result)){
			  $data[0]['msg'] = "No data exists with this activation key";
			  echo json_encode($data);
			  exit;
		}
		$id = $result[0]['id'];
		$expiration_date_time = $result[0]['expiration_date_time'];
		$used_count = $result[0]['used_count'];
		$limit_count = $result[0]['limit_count'];
		$current_date_time = date("Y-m-d H:i:s");
		$service_type_id = $result[0]['service_type_id'];
		$activation_key = $result[0]['activation_key'];
		
		
		
		if(strtotime($current_date_time)>strtotime($expiration_date_time)){
			$data[0]['msg'] = "Expired:Your expired date time :".$result[0]['expiration_date_time'];
		    $data[0]['access'] = '';
			$data[0]['status'] = 'fail';
			 echo json_encode($data);
			 exit;
		}
		else if($used_count==$limit_count){
			$data[0]['msg'] = "Your limit already has been touched to your used";
			$data[0]['access'] = '';
			$data[0]['status'] = 'fail';
			 echo json_encode($data);
			 exit;
		}
		else{
			$obj_data_key =  $this->get_activation_key($service_type_id);
			$data_key_id = '';
			if(empty($obj_data_key)){
				$data[0]['msg'] = "No Key is open to be used";
				$data[0]['access'] = '';
				$data[0]['status'] = 'fail';
			    echo json_encode($data);
			    exit;
			}
			else{
			    $data_key_id = $obj_data_key[0]['id'];
			}
			
			//update
              $updated_at = date("Y-m-d H:i:s");
			  $used_count = $used_count+1;
		      $params = array(
					 'users_id' => $this->session->userdata('id'),
					 'used_count' => $used_count,
					 'updated_at' =>$updated_at
					);
					
			 $this->Subscription_model->update_subscription($id,$params);
			 //history
			 	/*$params = array(
		             'users_id' => $this->session->userdata('id'),
					 'subscriptionid' => $subscriptionid,
					 'activation_key' =>$activation_key,
					 'created_at' => date("Y-m-d H:i:s"),
				);
			$this->Subscription_history_model->add_subscription_history($params);*/

			 //update open/close
			     $params =array(
					 'used' => '1',
					 'used_by_users_id' => $this->session->userdata('id'),
					 'used_by_activation_key' => $activation_key,
					 'updated_at' =>$updated_at
					);
			    $this->db->where('id',$data_key_id);
				$status = $this->db->update('data_key',$params);
				$db_error = $this->db->error();
				if (!empty($db_error['code'])){
					echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
					exit;
				}
			 
			 $data[0]['msg'] = "Data has been updated successfully";
			 $data[0]['access'] = $obj_data_key;
			 $data[0]['status'] = 'success';
			 echo json_encode($data);		

		}
		
	}
}
