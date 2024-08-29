<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]
class pos_orders_model extends CI_Model
{
	function index(){
		echo 'This is model index function';
	}
	function __construct(){
		$this->tbl1 = 'pos_orders';
		$this->load->database();
	}
	function getRows($data = array()){
		$this->db->select("*,(SELECT shop_name FROM shops where id=pos_orders.shop_id) as \"shop_name\",
		(SELECT contact FROM shops where id=pos_orders.shop_id) as \"shop_mobile\",
		(SELECT name FROM vendors where id=pos_orders.user_id) as \"customer_name\",
		(SELECT address FROM vendors where id=pos_orders.user_id) as \"customer_address\",
		(SELECT mobile FROM vendors where id=pos_orders.user_id) as \"customer_mobile\"");
		$this->db->from($this->tbl1);
		if (array_key_exists("conditions", $data)) {
			foreach ($data['conditions'] as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		$query = $this->db->get();
		$result = ($query->num_rows() > 0)?$query->result_array():FALSE;
		return $result;
	}

	function getData($tb, $data = 0, $order = null, $order_by = null, $limit = null, $start = null)
    {

        if ($order != null) {
            if ($order_by != null) {
                $this->db->order_by($order_by, $order);
            } else {
                $this->db->order_by('id', $order);
            }
        }

        if ($limit != null) {
            $this->db->limit($limit, $start);
        }

        if ($data == 0 or $data == null) {
            return $this->db->get($tb)->result();
        }
        if (@$data['search']) {
            $search = $data['search'];
            unset($data['search']);
        }
        return $this->db->get_where($tb, $data)->result();
    }
	function select_customer($shop_id)
    {
        $this->db->select('*')
            ->from('customers t1')
            ->where(['shop_id' => $shop_id, 'is_deleted' => 'NOT_DELETED', 'isActive' => '1', "user_type" => "customer"])
            ->order_by('fname', 'asc');
        
        $records = $this->db->get()->result();
        return $records;
    }
	function getRow($tb,$data=0) {

        if ($data==0) {
            if($data=$this->db->get($tb)->row()){
                return $data;
            }else {
                return false;
            }
        }elseif(is_array($data)) {
            if($data=$this->db->get_where($tb, $data)){
                return $data->row();
            }else {
                return false;
            }
        }else {
            if($data=$this->db->get_where($tb,array('id'=>$data))){
                return $data->row();
            }else {
                return false;
            }
        }

    }
	function insertRow($data = array()){
		$result = $this->db->insert($this->tbl1,$data);
		return $result;
	}
	function updateRow($id,$data = array()){
		$this->db->where($this->tbl1.'.'.'id',$id);
		$result = $this->db->update($this->tbl1,$data);
		return $result;
	}
	function deleteRow($id){
		$this->db->where($this->tbl1.'.'.'id',$id);
		$result = $this->db->delete($this->tbl1);
		return $result;
	}
	function getOrdersData($data = array(), $mobile = null, $payment_mode = null, $orderid = null, $search_term = null){
		// echo('<pre>');
		// print_r($payment_mode[0]);
		// die();
		$this->db->select("
							pos_orders.id,
							pos_orders.orderid,
							pos_orders.invoice_no,
							pos_orders.order_type,
							pos_orders.payment_mode,
							pos_orders.narration,
							pos_orders.reference_no_or_remark,
							
							(SELECT shop_name FROM shops where id=pos_orders.shop_id) as \"shop_name\",
							
							pos_orders.datetime,
							CONCAT(datetime,' (',TIME_FORMAT(timeslot_starttime, \"%h:%i %p\"),' - ',TIME_FORMAT(timeslot_endtime, \"%h:%i %p\"),')') as \"delivery_slot\",
							pos_orders.address_id,
							pos_orders.random_address,
							pos_orders.total_value,
							pos_orders.total_savings,
							pos_orders.payment_method,
							pos_orders.status,
							pos_orders.added,
							pos_orders.due_date,
							customers.mobile,
							customers.fname as v_fname,
							customers.lname as v_lname,
							order_status_master.name as status_name,
							pos_payment_mode.name as pos_payment_mode_name,
						");
		$this->db->from($this->tbl1);
        $this->db->join('customers', 'customers.id = pos_orders.user_id');
        $this->db->join('order_status_master', 'order_status_master.id = pos_orders.status');
		$this->db->join('pos_payment_mode', 'pos_payment_mode.id = pos_orders.payment_mode');
		$this->db->where($this->tbl1.".".'status !=','21');
		if (array_key_exists("conditions", $data)) 
		{
			foreach ($data['conditions'] as $key => $value) {
				$this->db->where($this->tbl1.".".$key,$value);
			}
		}
		if ($mobile != 'null') {
				$this->db->where('customers.mobile',$mobile);
		}
		if ($search_term !== null) {
			$this->db->group_start();
			$this->db->like('pos_orders.orderid', $search_term);
			$this->db->or_like('pos_orders.reference_no_or_remark', $search_term);
			$this->db->or_like('pos_orders.narration', $search_term);
			$this->db->group_end();
		}
		if ($orderid != null) {
				$this->db->where('pos_orders.orderid',$orderid);
		}
		if ($payment_mode != 'null') {
			if ($payment_mode == 'cod') {
                $this->db->where('pos_orders.payment_method' , 'cod');
            }
			else if($payment_mode == 'online')
            {
                $this->db->where('pos_orders.payment_method!=' , 'cod');
            }
		}
		if(isset($_SESSION['order_table_filters']['from_date']) && $_SESSION['order_table_filters']['from_date']!==''){
			if (array_key_exists("order_date", $data)) {
				$from_date = DATE($data['order_date']['start_date']);
				$to_date = DATE($data['order_date']['end_date']);
				// print_r($from_date);
				$this->db->where(['DATE('.$this->tbl1.'.datetime) >='=>$from_date , 'DATE('.$this->tbl1.'.datetime) <='=>$to_date]);
				// $this->db->where(['DATE('.$this->tbl1.'.added) >='=>'2021-07-01' , 'DATE('.$this->tbl1.'.added) <='=>'2021-10-30']);
				$this->db->last_query();
			}
		}
		if (array_key_exists("conditions_join", $data)) {
			foreach ($data['conditions_join'] as $key => $value) {
				$this->db->where('customers'.".".$key,$value);
			}
		}
		// if (array_key_exists("conditions_like", $data)) {
		// 	foreach ($data['conditions_like'] as $key => $value) {
		// 		$this->db->like($this->tbl1.".".$key,$value);
		// 	}
		// }
		if (array_key_exists("conditions_in", $data)) {
			foreach ($data['conditions_in'] as $key => $value) {
				$this->db->where_in($this->tbl1.".".$key,$value);
			}
		}
		if(isset($data['order_field']) && isset($data['order'])){
			$this->db->order_by($data['order_field'],strtoupper($data['order']));
		}else{
			$this->db->order_by('pos_orders.added','DESC');
		}

		if(isset($data['limit']) && isset($data['offset'])){
			$this->db->limit($data['limit'],$data['offset']);
		}
		
		$query = $this->db->get();
		$result = ($query->num_rows() > 0)?$query->result_array():FALSE;
		
		return $result;
	}
	function getNewOrdersRows($data = array()){
		$this->db->select("*,(SELECT shop_name FROM shops where id=orders.shop_id) as \"shop_name\",
		(SELECT contact FROM shops where id=orders.shop_id) as \"shop_mobile\",
		(SELECT CONCAT(fname,' ',lname) FROM customers where id=orders.user_id) as \"customer_name\",
		(SELECT mobile FROM customers where id=orders.user_id) as \"customer_mobile\"");
		$this->db->from($this->tbl1);
		if (array_key_exists("conditions", $data)) {
			foreach ($data['conditions'] as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		$this->db->order_by('added','DESC');
		$query = $this->db->get();
		$result = ($query->num_rows() > 0)?$query->result_array():FALSE;
		return $result;
	}
	public function invoice_details($oid)
    {
  //       $query = $this->db
  //       ->select('t1.id as oid,t1.*,t1.added as order_date,t1.tax as order_tax,t2.qty as item_qty,t2.purchase_rate,t2.tax_value,t3.name as status_name,t4.id as product_id,t4.name as product_name,t4.unit_value,t4.unit_type,t5.img,t6.fname,t6.lname,t6.mobile,t6.email as cust_email,t7.address as cust_address,t7.contact_name,t7.contact,t8.*,t9.name as city_name,t10.name state_name')
  //       ->from('pos_orders t1')
  //       ->join('pos_order_items t2', 't2.order_id = t1.id','left')        
  //       ->join('order_status_master t3', 't3.id = t1.status','left')        
  //       ->join('products_subcategory t4', 't4.id = t2.product_id','left')        
		// ->join('products_photo t5', 't5.item_id = t4.id','left')  
		// ->join('customers t6', 't6.id = t1.user_id','left')  
		// ->join('customers_address t7', 't7.id = t1.address_id','left')  
		// ->join('shops t8', 't8.id = t1.shop_id','left')  
		// ->join('cities t9', 't9.id = t8.city','left')  
		// ->join('states t10', 't10.id = t8.state','left')  
  //       ->where(['t4.is_deleted' => 'NOT_DELETED','t1.id'=>$oid,'t5.is_cover' =>'1'])  
		// ->get();  

    	// order
		$order_query =" SELECT mtb.*, s.name as status_name
						FROM pos_orders mtb 
						LEFT JOIN order_status_master s on s.id = mtb.status
						WHERE mtb.id = $oid";
		$order = $this->db->query($order_query)->row();

		// vendor
		$vendor_query ="SELECT * FROM customers WHERE id = $order->user_id";
		$vendor = $this->db->query($vendor_query)->row();

		// shop
		$shop_query ="	SELECT mtb.*, c.name as city_name , s.name as state_name,
							sa.bank_name as bank_name,
							sa.bank_account as account_number,
							sa.account_name,
							sa.ifsc as ifsc,
							sa.branch_name as branch
						FROM shops mtb
						LEFT JOIN shops_account sa on sa.shop_id = mtb.id
						LEFT JOIN cities c on c.id = mtb.city
						LEFT JOIN states s on s.id = mtb.state
						WHERE mtb.id = $order->shop_id";
		$shop = $this->db->query($shop_query)->row();

    	// order items
		$order_query ="	SELECT mtb.*, item.*
						FROM pos_order_items mtb
						LEFT JOIN products_subcategory item on item.id = mtb.product_id
						WHERE order_id = $oid AND item.is_deleted = 'NOT_DELETED'";
		$items = $this->db->query($order_query)->result();







		$return['order'] = $order;
		$return['vendor'] = $vendor;
		$return['shop'] = $shop;
		$return['items'] = $items;

		return $return;
    }

	public function invoice_details_new($oid)
    {
        $query = $this->db
        ->select('t1.id as oid,t1.*,t1.added as order_date,t1.tax as order_tax,t2.item_props_value,t2.qty as item_qty,t2.purchase_rate,t2.tax_value,t3.name as status_name,t4.sku,t4.id as product_id,t4.name as product_name,t4.unit_value,t4.unit_type,t5.img,t6.fname,t6.lname,t6.mobile as cus_mobile,t6.email as cust_email,t6.address as cust_address,t6.pincode as cust_pincode,t6.mobile as cust_contact,t8.*,t9.name as city_name,t10.name state_name,t1.random_address,t2.mrp,t2.price_per_unit,t2.total_price,t1.remark as instructions,t6.id as customer_id,t11.selling_rate,t2.discount_type,t2.offer_applied,t2.discount_type2,t2.offer_applied2,states.name as cust_state,cities.name as cust_city,t2.flat_discount,t2.flat_discount_type')
        ->from('pos_orders t1')
        ->join('pos_order_items t2', 't2.order_id = t1.id','left')        
        ->join('order_status_master t3', 't3.id = t1.status','left')        
        ->join('products_subcategory t4', 't4.id = t2.product_id','left')        
		->join('products_photo t5', 't5.item_id = t4.id','left')  
		->join('customers t6', 't6.id = t1.user_id','left')  
		->join('states', 'states.id = t6.state','left') 
		->join('cities', 'cities.id = t6.city','left') 
		->join('shops t8', 't8.id = t1.shop_id','left')  
		->join('cities t9', 't9.id = t8.city','left')  
		->join('states t10', 't10.id = t8.state','left')  
		->join('shops_inventory t11', 't11.id = t2.inventory_id','left') 
        ->where(['t4.is_deleted' => 'NOT_DELETED','t1.id'=>$oid,'t5.is_cover' =>'1'])  
		->get();   
	//  echo $this->db->last_query();die();
		return $query->result_array();
    }

	public function OrderPayments($oid)
    {
        $query = $this->db
        ->select('t1.*,t2.name as mode_name,t3.bank_name,t3.branch_name')
        ->from('pos_order_payments t1')
        ->join('pos_payment_mode t2', 't2.id = t1.payment_mode','left')  
		->join('shop_bank_accounts t3', 't3.id = t1.bank_id','left')  
        ->where(['t1.order_id'=>$oid])  
		->get();   
		return $query->result_array();
    }
	public function lastBill()
    {
        $query = $this->db
        ->select('t1.*')
        ->from('pos_orders t1')
        ->where(['t1.status !='=>'21']) 
		->order_by('id','DESC')
		->limit(1) 
		->get();   
		return $query->row();
    }
	

	public function billDetails($oid)
	{
		// Query to get order details with status
		$order_query = "
			SELECT mtb.*, s.name as status_name
			FROM pos_orders mtb 
			LEFT JOIN order_status_master s ON s.id = mtb.status
			WHERE mtb.id = $oid
		";
		$order = $this->db->query($order_query)->row();
	
		// Query to get vendor details along with the default address
		$vendor_query = "
			SELECT c.*, ca.house_no, ca.address, ca.address_line_2, ca.address_line_3, ca.landmark, ca.apartment_name, ca.pincode, ca.city, sa.name as state_name
			FROM customers c
			LEFT JOIN customers_address ca ON ca.customer_id = c.id AND ca.is_default = 1
			LEFT JOIN states sa ON sa.id = c.state
			WHERE c.id = $order->user_id
		";
		$vendor = $this->db->query($vendor_query)->row();
	
		// Query to get shop details
		$shop_query = "
			SELECT mtb.*, c.name AS city_name, s.name AS state_name,
				sa.bank_name AS bank_name,
				sa.bank_account AS account_number,
				sa.account_name,
				sa.ifsc AS ifsc,
				sa.branch_name AS branch
			FROM shops mtb
			LEFT JOIN shops_account sa ON sa.shop_id = mtb.id
			LEFT JOIN cities c ON c.id = mtb.city
			LEFT JOIN states s ON s.id = mtb.state
			WHERE mtb.id = $order->shop_id
		";
		$shop = $this->db->query($shop_query)->row();
	
		// Query to get order items
		$items_query = "
			SELECT mtb.*, item.*,inventory.qty as stock_qty
			FROM pos_order_items mtb
			LEFT JOIN products_subcategory item ON item.id = mtb.product_id
			LEFT JOIN shops_inventory inventory ON item.id = inventory.product_id
			WHERE mtb.order_id = $oid AND item.is_deleted = 'NOT_DELETED'
		";
		$items = $this->db->query($items_query)->result();
	
		// Query to get order coupon
		$coupon_query = "
			SELECT mtb.*
			FROM `order_coupons` mtb
			WHERE mtb.order_id = $oid
		";
		$coupon = $this->db->query($coupon_query)->result();
	
		// Prepare the return array
		$return = [
			'order' => $order,
			'vendor' => $vendor,
			'shop' => $shop,
			'items' => $items,
			'coupon' => $coupon
		];
	
		return $return;
	}
	
	public function getItemCount($id) {
        $this->db->from('pos_order_items');
		$this->db->where('product_id',$id);
        return $this->db->count_all_results();
    }

    public function deleteItem($item_id) {
        $this->db->where('product_id', $item_id);
        return $this->db->delete('pos_order_items');
    }
	

	public function getHoldOrders($search = '') {
		$this->db->select('t1.id as oid, t1.*, t1.added as order_date, t1.tax as order_tax, t2.item_props_value, t2.qty as item_qty, t2.purchase_rate, t2.tax_value, t3.name as status_name, t4.sku, t4.id as product_id, t4.name as product_name, t4.unit_value, t4.unit_type, t5.img, t6.fname, t6.lname, t6.mobile as cus_mobile, t6.email as cust_email, t7.address as cust_address, t7.address_line_2, t7.address_line_3, t7.floor, t7.apartment_name, t7.city as cust_city, t7.pincode as cust_pincode, t7.contact_name, t7.contact as cust_contact, t8.*, t9.name as city_name, t10.name as state_name, t1.random_address, t2.mrp, t2.price_per_unit, t2.total_price, t1.remark as instructions, t6.id as customer_id, t11.selling_rate, t2.discount_type, t2.offer_applied, t2.discount_type2, t2.offer_applied2, states.name as cust_state, t7.house_no as cust_house_no,t2.flat_discount,t2.flat_discount_type');
		$this->db->from('pos_orders t1');
		$this->db->join('pos_order_items t2', 't2.order_id = t1.id', 'left');
		$this->db->join('order_status_master t3', 't3.id = t1.status', 'left');
		$this->db->join('products_subcategory t4', 't4.id = t2.product_id', 'left');
		$this->db->join('products_photo t5', 't5.item_id = t4.id', 'left');
		$this->db->join('customers t6', 't6.id = t1.user_id', 'left');
		$this->db->join('customers_address t7', 't7.customer_id = t6.id', 'left');
		$this->db->join('states', 'states.id = t7.state', 'left');
		$this->db->join('shops t8', 't8.id = t1.shop_id', 'left');
		$this->db->join('cities t9', 't9.id = t8.city', 'left');
		$this->db->join('states t10', 't10.id = t8.state', 'left');
		$this->db->join('shops_inventory t11', 't11.id = t2.inventory_id', 'left');
		$this->db->where(['t4.is_deleted' => 'NOT_DELETED', 't1.status' => '21', 't5.is_cover' => '1']);
		$this->db->group_by('t1.id');
	
		if ($search) {
			$this->db->group_start();
			$this->db->like('t1.orderid', $search);
			$this->db->or_like('t1.datetime', $search);
			$this->db->or_like('t6.fname', $search);
			$this->db->or_like('t6.lname', $search);
			$this->db->or_like('t6.mobile', $search);
			$this->db->group_end();
		}
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	
	public function deleteHoldBill($id) {
		$id = (int) $id;
	
		$this->db->trans_start();
	
		// Delete from pos_orders table
		$this->db->where('id', $id);
		$this->db->delete('pos_orders');
	
		// Delete from order_coupons table
		$this->db->where('order_id', $id);
		$this->db->delete('order_coupons');
	
		// Delete from pos_order_items table
		$this->db->where('order_id', $id);
		$this->db->delete('pos_order_items');
	
		$this->db->trans_complete();
	
		if ($this->db->trans_status() === FALSE) {
			return FALSE; 
		} else {
			return TRUE; 
		}
	}
	
    public function proforma_invoice_details()
    {
		$user = $this->checkShopLogin();
    	$shop_id = $user->id;
    	// $shop_state = $this->shops_model->get_shop_data($shop_id)->state;
     //    $cus_state  = $this->shops_vendor_model->customers($_POST['user_id'])->state;
    	// shop
		$shop_query ="	SELECT mtb.*, c.name as city_name , s.name as state_name,
							sa.bank_name as bank_name,
							sa.bank_account as account_number,
							sa.account_name,
							sa.ifsc as ifsc,
							sa.branch_name as branch
						FROM shops mtb
						LEFT JOIN shops_account sa on sa.shop_id = mtb.id
						LEFT JOIN cities c on c.id = mtb.city
						LEFT JOIN states s on s.id = mtb.state
						WHERE mtb.id = $shop_id";
		$shop = $this->db->query($shop_query)->row();
        // $shop = $this->shops_model->get_shop_data($shop_id);
        $cus  = $this->shops_vendor_model->customers($_POST['user_id']);
        $igst = ($shop->state==$cus->state) ? 0 : 1;

        // echo _prx($cus);

        $order['same_as_billing'] = $_POST['same_as_billing'];
        if (@$_POST['same_as_billing']==1) {
            $order['shipping_address'] = null;
        }
        else{
            $order['shipping_address'] = $_POST['shipping_address'];
        }
    	$order = array(
	    		'id' => 'N/A',
	            'orderid' => 'N/A',
	            'shop_id' => $shop_id,
	            'user_id' => $_POST['user_id'],
	            'datetime' => date('Y-m-d'),
	            'payment_mode' => 0,
	            'status' => 17,
	            'total_value' => $_POST['total_value'],
				'round_off' => $_POST['RoundOff'],
	            'tax' => $_POST['total_tax'],
	            'added' => date('Y-m-d H:s:i'),
	            'updated' => date('Y-m-d H:s:i'),
	            'random_address' => $_POST['random_address'],
	            'is_igst' => $igst,
	            'is_pay_later' => $_POST['is_pay_later'],
	            'due_date' => $_POST['due_date'],
	            'reference_no_or_remark' => $_POST['ref_no_or_remark'],
	            'shipping_address' => $_POST['shipping_address'],
	            'same_as_billing' => $_POST['same_as_billing'],
	            'narration' => $_POST['narration'],
	            'status_name' => 'Order Placed'
        );

        foreach ($_POST as $key => $value) {
            $_POST[$key] = explode(',', $value);
        }
        $items = [];
        foreach ($_POST['product_id'] as $key => $value) {
			$html="";
			$res=$this->product_props($value);
			 {
				if(count($res)>0)
				{
				  foreach($res as $row)
				  {
				   $html=$html."<h6><span class='text-danger'>".$row->name." ".$row->value."</span></h6>";
				  }
				}
			 }
        	$tmp_pro = $this->db->get_where('products_subcategory',['id'=>$value])->row();
            
        	$orderItemTmp['inventory_id']   = $_POST['inventory_id'][$key];
            $orderItemTmp['product_id']     = $_POST['product_id'][$key];
            $orderItemTmp['order_id']       = null;
            $orderItemTmp['qty']            = $_POST['qty'][$key];
            $orderItemTmp['free']           = @$_POST['free'][$key];
            $orderItemTmp['price_per_unit'] = $_POST['price_per_unit'][$key];
            $orderItemTmp['purchase_rate']  = $_POST['purchase_rate'][$key];
            $orderItemTmp['mrp']            = $_POST['mrp'][$key];
            $orderItemTmp['total_price']    = $_POST['total_price'][$key];
            $orderItemTmp['tax']            = $_POST['tax'][$key];
            $orderItemTmp['tax_value']      = $_POST['tax_value'][$key];
            $orderItemTmp['offer_applied']  = $_POST['offer_applied'][$key];
            $orderItemTmp['discount_type']  = $_POST['discount_type'][$key];
            $orderItemTmp['offer_applied2'] = $_POST['offer_applied2'][$key];
            $orderItemTmp['discount_type2'] = $_POST['discount_type2'][$key];
            $orderItemTmp['product_code'] 	= $tmp_pro->product_code;
            $orderItemTmp['name'] 			= $tmp_pro->name;
            $orderItemTmp['unit_type'] 		= $tmp_pro->unit_type;
            $orderItemTmp['unit_type_id'] 	= $tmp_pro->unit_type_id;
            $orderItemTmp['unit_value'] 	= $tmp_pro->unit_value;
            $orderItemTmp['sku'] 			= $tmp_pro->sku;
			$orderItemTmp['item_props_value'] = $html;


            $items[] = $orderItemTmp;
            unset($orderItemTmp);
        } 

        $return['order'] = $order;
        $return['vendor'] = $cus;
        $return['shop'] = $shop;
        $return['items'] = $items;
        // echo _prx($return);
        return $return;
    }

	public function getAmounts($amount) {
		$originalAmount = number_format((float)$amount, 2, '.', '');
		$roundedAmount = number_format(round($amount, 2), 2, '.', '');
		$newAmount = number_format(ceil($amount), 2, '.', '');
		$roundoff = number_format($newAmount - $roundedAmount, 2, '.', '');
		return [
			'originalAmount' => $originalAmount,
			'roundedAmount' => $roundedAmount,
			'newAmount' => $newAmount,
			'roundoff' => $roundoff
		];
	}
    public function check_order_id()
    {
    	if (@$_POST['orderId']) {
    		if($this->db->get_where('pos_orders',['orderid'=>$_POST['orderId']])->row()){
    			return false;
    		}
    	}
    	return true;
    	
    }
	public function check_order_id_new($id)
    {
    	if (@$_POST['orderId']) {
    		if($this->db->get_where('pos_orders',['orderid'=>$_POST['orderId'],'id !='=>$id])->row()){
    			return false;
    		}
    	}
    	return true;
    	
    }
	public function get_upi_status($shop_id)
    {
    	return $this->db->get_where('shop_bank_accounts',['shop_id'=>$shop_id,'is_deleted'=>'NOT_DELETED','active'=>'1','is_upi'=>'1'])->result();
    }
	
	public function orderCoupon($order_id) {
        $this->db->select('*');
        $this->db->from('order_coupons');
        $this->db->where('order_id', $order_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	public function product_props($pid)
    {
       $query=$this->db->select('product_props_master.name,product_props_value.value,t5.name as flavour')
       ->from('product_props')
       ->join('product_props_master','product_props.props_id=product_props_master.id') 
       ->join('product_props_value','product_props.value_id=product_props_value.id')
       ->join('products_subcategory t4', 't4.id = product_props.product_id','left')  
        ->join('flavour_master t5', 't5.id = t4.flavour_id','left') 
       ->where(['product_props.product_id'=>$pid,'product_props.is_deleted'=>'NOT_DELETED','product_props_master.is_selectable'=>'3'])
       ->get();
       //echo $this->db->last_query();
       if($query)
       {
       $output=$query->result();
       
       return $output;
       }
       else
       {
        return false;
       }
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
?>