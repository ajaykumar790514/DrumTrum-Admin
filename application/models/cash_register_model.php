<?php
defined('BASEPATH') or exit('No direct script access allowed');

#[\AllowDynamicProperties]
class cash_register_model extends CI_Model
{
	function index()
	{
		echo 'This is model index function';
	}
	function __construct()
	{
		$this->tbl1 = 'cash_register';
		$this->load->database();
	}
	function getRows($data = array())
	{
		$this->db->select("*");
		$this->db->from($this->tbl1);
		if (array_key_exists("conditions", $data)) {
			foreach ($data['conditions'] as $key => $value) {
				$this->db->where($key, $value);
			}
		}
		$query = $this->db->get();
		$result = ($query->num_rows() > 0) ? $query->result_array() : FALSE;
		return $result;
	}
	function insertRow($data = array())
	{
		$result = $this->db->insert($this->tbl1, $data);
		return $result;
	}

	public function updateCash($table, $data, $order_id) {
		$this->db->where('order_id', $order_id);
		return $this->db->update($table, $data);
	}
	
	
	function updateRow($id, $data = array())
	{
		if (is_array($id)) {
			$this->db->where($id);
		}
		else{
			$this->db->where($this->tbl1 . '.' . 'id', $id);
		}
		
		$result = $this->db->update($this->tbl1, $data);
		return $result;
	}
	
	function isDeleteRow($id)
	{
		if (is_array($id)) {
			$this->db->where($id);
		}
		else{
			$this->db->where($this->tbl1 . '.' . 'inventory_id', $id);
		}
		$result = $this->db->update($this->tbl1,['is_deleted'=>'DELETED']);
		return $result;
	}

	function deleteRow($id)
	{
		if (is_array($id)) {
			$this->db->where($id);
		}
		else{
			$this->db->where($this->tbl1 . '.' . 'id', $id);
		}
		$result = $this->db->delete($this->tbl1);
		return $result;
	}

	public function getvendor()
	{
		$data['user'] = $user =  $this->checkShopLogin();
        $shop_id     = $user->id;
		$this->db->select("*,CONCAT(fname, ' ', lname) as name")
			->from('customers')
			->where('user_type', 'supplier')
			->where('is_deleted', 'NOT_DELETED')
			->where('isActive', '1')
			->where('shop_id', $shop_id);
		return $this->db->get()->result();
	}

	public	function getcustomer()
	{
		$data['user'] = $user =  $this->checkShopLogin();
        $shop_id     = $user->id;
		$this->db->select("*")
			->from('customers')
			->where('is_deleted', 'NOT_DELETED')
			->where('isActive', '1')
			->where('b2b_b2c', 'b2b')
			->where('user_type', 'customer')
			->where('shop_id', $shop_id);
		return $this->db->get()->result();
	}
	public	function getaccounts()
	{
		$data['user'] = $user =  $this->checkShopLogin();
        $shop_id     = $user->id;
		$this->db->select("*")
			->from('accounts_master')
			->where('is_deleted', 'NOT_DELETED')
			->where('active', '1')
			->where('shop_id', $shop_id);
		return $this->db->get()->result();
	}
	

	public function checkrefno($ref)
	{
		$query =	$this->db->select("reference_no")
			->from('cash_register')
			->where('reference_no', $ref)
			->where('is_deleted','NOT_DELETED')
			->get();
		return $query->row();
	}

	public function editcheckrefno($id, $ref)
	{
		$query =	$this->db->select("reference_no")
			->from('cash_register')
			->where('reference_no', $ref)
			->where('id!=', $id)
			->get();
		return $query->row();
	}

	public function getBankData($id)
	{
		$query =	$this->db->select("a.*,b.user_type")
			->from('cash_register a')
			->join('customers b','b.id=a.customer_id','left')
			->where('a.id', $id)
			->get();
		return $query->result();
	}
	public function getcashEdit($id)
	{
		$query =	$this->db->select("a.*,b.user_type")
			->from('cash_register a')
			->join('customers b','b.id=a.customer_id','left')
			->where('a.id', $id)
			->get();
		return $query->result_array();
	}
	
	
	public function getcashlist($fromdate, $todate, $vendorId = null, $customerId = null, $getvendor=null, $getcustomer = null,$accounts = null, $limit=null,$start=null)
	{
		if ($limit!=null) { 
            
            $this->db->limit($limit, $start);
        }
		$txn_types = '1';
		$this->db->select("t1.*,t3.bank_name,CONCAT(t2.fname, ' ', t2.lname) as name,t4.title")
			->from('cash_register t1')
			->join('customers t2','t2.id=t1.customer_id','left')
			->join('shop_bank_accounts t3', 't3.id = t1.bank_account','LEFT')
			->join('accounts_master t4','t4.id=t1.customer_id','left')
			->where('t1.is_deleted!=', 'DELETED')
			->where('t1.active', '1')
			->where('t1.txn_type', $txn_types);
			if ($getvendor != "null") {
				$this->db->where('t1.customer_id', $getvendor);
			}
			if ($getcustomer != "null") {
				$this->db->where('t1.customer_id', $getcustomer);
			}
			if ($todate != "null") {
				$this->db->where('t1.PaymentDate >=', $fromdate);
				$this->db->where('t1.PaymentDate <=', $todate);
			}
			if ($accounts != "null") {
				$this->db->where('t1.customer_id', $accounts);
			}
			if($limit!=null)
						return $this->db->get()->result();
					else
						return $this->db->get()->num_rows();
	}
	public function getcashamount($fromdate, $todate, $vendorId = null, $customerId = null,$getvendor=null,$getcustomer =null,$accounts =null, $limit=null,$start=null)
	{
		// if ($limit!=null) { 
            
        //     $this->db->limit($limit, $start);
        // }
		$txn_types = '1';
		$this->db->select("( SUM(cr) - (SUM(dr)*-1) ) as balance_amount")
			->from('cash_register')
			->where('is_deleted!=', 'DELETED')
			->where('active', '1')
			->where('txn_type', $txn_types);
		
		if ($getvendor != "null") {
			$this->db->where('customer_id', $getvendor);
		}
		if ($getcustomer != "null") {
			$this->db->where('customer_id', $getcustomer);
		}
		if ($todate != "null") {
			$this->db->where(' PaymentDate >=', $fromdate);
			$this->db->where(' PaymentDate <=', $todate);
		}
		if ($accounts != "null") {
			$this->db->where('customer_id', $accounts);
		}
		// if($limit!=null)
        //             return $this->db->get()->result();
        //         else
        //             return $this->db->get()->num_rows();
		$return = $this->db->get()->result();

		// echo _prx($return);

		return $return;
	}
	public function getbanktb($fromdate, $todate, $vendorId = null, $customerId = null, $getvendor=null, $getcustomer = null,$accounts = null, $limit=null,$start=null)
	{
		if ($limit!=null) { 
            
            $this->db->limit($limit, $start);
        }
		$txn_types = '2'; 
		$this->db->select("t1.*,CONCAT(t2.fname, ' ', t2.lname) as name,t3.title")
			->from('cash_register t1')
			->join('customers t2','t2.id=t1.customer_id','left')
			->join('accounts_master t3','t3.id=t1.customer_id','left')
			->where(['t1.active'=>'1','t1.is_deleted'=>'NOT_DELETED'])
			->where('t1.txn_type', $txn_types);
		if ($getvendor != "null") {
			$this->db->where('t1.customer_id', $getvendor);
		}
		if ($getcustomer != "null") {
			$this->db->where('t1.customer_id', $getcustomer);
		}
		if ($accounts != "null") {
			$this->db->where('t1.customer_id', $accounts);
		}
		
		if ($todate != "null") {
			$this->db->where('t1.PaymentDate >=', $fromdate);
			$this->db->where('t1.PaymentDate <=', $todate);
		}
		// echo $this->db->last_query();die();
		if($limit!=null)
                    return $this->db->get()->result();
                else
                    return $this->db->get()->num_rows();
		// return $this->db->get()->result();
	}
	public function getamount($fromdate, $todate, $vendorId = null, $customerId = null,$getvendor=null,$getcustomer =null,$accounts = null, $limit=null,$start=null)
	{
		// if ($limit!=null) { 
            
        //     $this->db->limit($limit, $start);
        // }
		$txn_types = '2'; 
		$this->db->select("( SUM(cr) - (SUM(dr)*-1) ) as balance_amount")
			->from('cash_register')
			->where('is_deleted!=', 'DELETED')
			->where('active', '1')
			->where('txn_type', $txn_types);
		
		if ($getvendor != "null") {
			$this->db->where('customer_id', $getvendor);
		}
		if ($getcustomer != "null") {
			$this->db->where('customer_id', $getcustomer);
		}
		if ($accounts != "null") {
			$this->db->where('customer_id', $accounts);
		}
		if ($todate != "null") {
			$this->db->where(' PaymentDate >=', $fromdate);
			$this->db->where(' PaymentDate <=', $todate);
		}
		// if($limit!=null)
        //             return $this->db->get()->result();
        //         else
        //             return $this->db->get()->num_rows();
		return $this->db->get()->result();
	}

    
	public function getexpensetb($fromdate, $todate,  $getvendor=null, $accounts = null, $limit=null,$start=null)
	{
		if ($limit!=null) { 
            
            $this->db->limit($limit, $start);
        }
		$txn_types = '8'; 
		$this->db->select("t1.*,CONCAT(t2.fname, ' ', t2.lname) as name,t3.title")
			->from('cash_register t1')
			->join('customers t2','t2.id=t1.customer_id','left')
			->join('accounts_master t3','t3.id=t1.order_id','left')
			->where(['t1.active'=>'1','t1.is_deleted'=>'NOT_DELETED'])
			->where('t1.txn_type', $txn_types);
		if (!empty($getvendor) && $getvendor != "null") {
			$this->db->where('t1.customer_id', $getvendor);
		}
		if (!empty($accounts) && $accounts != "null") {
			$this->db->where('t1.order_id', $accounts);
		}
		
		if ($todate != "null") {
			$this->db->where('t1.PaymentDate >=', $fromdate);
			$this->db->where('t1.PaymentDate <=', $todate);
		}
		// echo $this->db->last_query();die();
		if($limit!=null)
                    return $this->db->get()->result();
                else
                    return $this->db->get()->num_rows();
		// return $this->db->get()->result();
	}


	public function getexpenseamount($fromdate, $todate, $getvendor=null,$accounts = null, $limit=null,$start=null)
	{
		// if ($limit!=null) { 
            
        //     $this->db->limit($limit, $start);
        // }
		$txn_types = '8'; 
		$this->db->select("( SUM(cr) - (SUM(dr)*-1) ) as balance_amount")
			->from('cash_register')
			->where('is_deleted!=', 'DELETED')
			->where('active', '1')
			->where('txn_type', $txn_types);
		
			if (!empty($getvendor) && $getvendor != "null") {
				$this->db->where('customer_id', $getvendor);
			}
			if (!empty($accounts) && $accounts != "null") {
				$this->db->where('order_id', $accounts);
			}
		if ($todate != "null") {
			$this->db->where(' PaymentDate >=', $fromdate);
			$this->db->where(' PaymentDate <=', $todate);
		}
		// if($limit!=null)
        //             return $this->db->get()->result();
        //         else
        //             return $this->db->get()->num_rows();
		return $this->db->get()->result();
	}
	
    function checkCookie(){
        $loggedin = false;
        if (get_cookie('63a490ed05b42') && get_cookie('63a490ed05b43') && get_cookie('63a490ed05b44')) {
            $user_id = value_encryption(get_cookie('63a490ed05b42'),'decrypt');
            $user_nm = value_encryption(get_cookie('63a490ed05b43'),'decrypt');
            if (is_numeric($user_id) && !is_numeric($user_nm)) {
                $loggedin = true;
            }
        }

        if ($loggedin) {
            return true;
        }
        else{
            delete_cookie('63a490ed05b42');	
            delete_cookie('63a490ed05b43');	
            delete_cookie('63a490ed05b44');	
            delete_cookie('63a490ed05b45');	
            redirect(base_url().'');
        }
    }
    
        function checkShopLogin(){
            $loggedin = false;
            if (get_cookie('63a490ed05b42') && get_cookie('63a490ed05b43') && get_cookie('63a490ed05b44')) {
                $user_id = value_encryption(get_cookie('63a490ed05b42'),'decrypt');
                $user_nm = value_encryption(get_cookie('63a490ed05b43'),'decrypt');
                $type    = value_encryption(get_cookie('63a490ed05b44'),'decrypt');
                if (is_numeric($user_id) && !empty($user_nm)) {
                    $check['id'] 	   = $user_id;
                    $check['contact'] = $user_nm;
                    if ($type=='shop') {
                        // $user = $this->admin_model->getRow('admin',$check);
                        $CI =& get_instance();
                       $user = $CI->db->get_where('shops',$check)->row();
                      
                    }
                    else{
                        $user = false;
                    }
                    
                    if ($user) {
                        if ($user->isActive==1) {
                            $user->type = $type;
                            $loggedin = true;
                        }
                    }
                    
                }
                
            }
            if ($loggedin) {
                return $user;
            }
            else{
                
                delete_cookie('63a490ed05b42');	
                delete_cookie('63a490ed05b43');	
                delete_cookie('63a490ed05b44');	
                delete_cookie('63a490ed05b45');	
                redirect(base_url().'');
            }
        }
}
