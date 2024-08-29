<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#[\AllowDynamicProperties]
class shops_model extends CI_Model
{
	function index(){
		echo 'This is model index function';
	}
	function __construct(){
		$this->tbl1 = 'shops';
		$this->load->database();
	}
	function getRows($data = array()){
		$this->db->select("*");
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
	public function shop_cash_account($shop_id)
	{
		return $this->db->get_where('shop_cash_account',['shop_id' => $shop_id])->row();
	}
	public function save_cash_account($shop_id)
	{
		$p = $this->input->post();
		$this->db->where('shop_id',$shop_id);
		return $this->db->update('shop_cash_account',['dr_cr'=>$p['dr_cr'],'amount'=>$p['amount'],'remark'=>$p['remark']]);
	}
	public function save_new_cash_account($shop_id)
	{
		$p = $this->input->post();
		 $this->db->insert('shop_cash_account',['shop_id'=>$shop_id,'dr_cr'=>$p['dr_cr'],'amount'=>$p['amount'],'remark'=>$p['remark']]);
		 return $this->db->insert_id();
	}
	public function shop_bank_accounts($shop_id)
	{
		$query = $this->db
		->select('t1.*')
		->from('shop_bank_accounts t1')      
		->where(['t1.shop_id' => $shop_id,'t1.is_deleted'=>'NOT_DELETED'])
		->get();
		return $query->result();
	}
	public function shop_expanse_accounts($shop_id)
	{
		$query = $this->db
		->select('t1.*,t2.dr_cr,t2.amount,t2.remark')
		->from('accounts_master t1')    
		->join('vendors_opening t2','t2.user_id=t1.id AND t2.type="2"','left')      
		->where(['t1.shop_id' => $shop_id,'t1.is_deleted'=>'NOT_DELETED'])
		->get();
		return $query->result();
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

    public function edit_shop_profile($data,$id)
    {

        $config['file_name'] = rand(10000, 10000000000);
        $config['upload_path'] = UPLOAD_PATH.'shop_photo/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!empty($_FILES['logo']['name'])) {
            //upload images
            $_FILES['logos']['name'] = $_FILES['logo']['name'];
            $_FILES['logos']['type'] = $_FILES['logo']['type'];
            $_FILES['logos']['tmp_name'] = $_FILES['logo']['tmp_name'];
            $_FILES['logos']['size'] = $_FILES['logo']['size'];
            $_FILES['logos']['error'] = $_FILES['logo']['error'];
			
            if ($this->upload->do_upload('logos')) {
				
                $image_data = $this->upload->data();
                $fileName = "shop_photo/" . $image_data['file_name'];
            }

			$data['logo'] = $fileName;
            if (!empty($fileName)) 
            {
				$data2 = $this->db->get_where('shops', ['id' =>$id])->row();
                if (!empty($data2->logo))
                {
					if(is_file(DELETE_PATH.$data2->logo))
					{
						unlink(DELETE_PATH.$data2->logo);
					}
                }
            } 
			// die();
            
        }

        		return $this->db->where('id', $id)->update('shops', $data); 

    }
   public function get_shop_detail($shop_id)
    {
        $this->db
        ->select('t1.*,t2.*, t3.name as city_name,t4.name state_name')
        ->from('shops t1')     
        ->join('layout_settings t2', 't2.shop_id = t1.id','left')
        ->join('cities t3', 't3.id = t1.city','left')
		->join('states t4', 't4.id = t1.state','left')
        ->where(['t1.is_deleted' => 'NOT_DELETED','t1.id' =>$shop_id]);   

        return $this->db->get()->row();
    }
	public function get_shop_data($shop_id)
	{
		// $query = $this->db->get_where('shops', ['id' => $shop_id]);
		// return $query->row();
		$query = $this->db
        ->select('t1.*,t2.image,t2.id as img_id,t3.*,t3.id as layout_id')
        ->from('shops t1')
        ->join('shops_photo t2', 't2.shop_id = t1.id AND t2.is_cover = 1')        
        ->join('layout_settings t3', 't3.shop_id = t1.id','left')        
        ->where(['t1.is_deleted' => 'NOT_DELETED','t1.id' => $shop_id])
        ->get();
		return $query->row();
	}
	public function shop_social($shop_id)
	{
		$query = $this->db
		->select('t1.*,t2.shop_name,t2.business_id')
		->from('shop_social t1')
		->join('shops t2', 't2.id = t1.shop_id')        
		->where(['t1.is_deleted' => 'NOT_DELETED','t1.shop_id' => $shop_id])
		->get();
		return $query->result();
	}
	//shop login
	public function shop_login($contact, $password) { 
		$this->db->where('contact', $contact);
		$this->db->where('password', $password);
		$query = $this->db->get('shops');
		if($query->num_rows()==1){
			return TRUE;
		}
		else{
			return FALSE;
		}    
	}
	public function check_old_password($old_pass,$shop_id)
	{
		$query = $this->db->where(['id' => $shop_id ,'password' =>$old_pass])->get('shops');
		if($query->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
	}

	public function fetch_data($start_date , $end_date)
	{

	$this->db
    ->select('SUM(t1.total_value) as total_value_sum, SUM(t1.delivery_charges) as delivery_charges_sum')
    ->from('orders t1')       
    ->where(['DATE(t1.added) >=' => $start_date , 'DATE(t1.added) <=' => $end_date]);

	$query0 = $this->db->get();

	if ($query0->num_rows() > 0) {
		$result = $query0->row();
		$TotalOnlineSales = round_price($result->total_value_sum+$result->delivery_charges_sum);
	} else {
		$TotalOnlineSales = 0;
	}
	
	$this->db
    ->select('SUM(t1.total_value) as total_value_sum')
    ->from('pos_orders t1')       
    ->where(['t1.datetime >=' => $start_date , 't1.datetime <=' => $end_date]);

	$quer = $this->db->get();

	if ($quer->num_rows() > 0) {
		$result = $quer->row();
		$TotalPosSales = round_price($result->total_value_sum);
	} else {
		$TotalPosSales = 0;
	}


	$this->db
    ->select('SUM(t1.total) as total_sum')
    ->from('sales_return t1')       
    ->where(['t1.date >=' => $start_date, 't1.date <=' => $end_date]); 

	$query01 = $this->db->get();

	if ($query01->num_rows() > 0) {
		$result = $query01->row();
		$totalSalesReturn = $result->total_sum;
	} else {
		$totalSalesReturn = 0;
	}


	$this->db
    ->select('SUM(t1.total) as total_sum')
    ->from('purchase_return t1')
    ->where(['t1.date >=' => $start_date, 't1.date <=' => $end_date]);

	$query02 = $this->db->get();

	if ($query02->num_rows() > 0) {
		$result = $query02->row();
		$totalPurchaseReturn = $result->total_sum;
	} else {
		$totalPurchaseReturn = 0;
	}


		 $this->db
		 ->select('t1.*')
		 ->from('customers t1')       
		 ->where(['user_type'=>'customer','DATE(t1.added) >='=>$start_date , 'DATE(t1.added) <='=>$end_date]);
		  $customerCount = $this->db->get()->num_rows();

		  
		 $this->db
		 ->select('t1.*')
		 ->from('customers t1')       
		 ->where(['user_type'=>'supplier','DATE(t1.added) >='=>$start_date , 'DATE(t1.added) <='=>$end_date]);
		  $supplierCount = $this->db->get()->num_rows();

		  $this->db
		  ->select('t1.*')
		  ->from('products_subcategory t1')       
		  ->where(['t1.active'=>'1','t1.is_deleted'=>'NOT_DELETED','DATE(t1.added) >='=>$start_date , 'DATE(t1.added) <='=>$end_date]);
		   $productCount = $this->db->get()->num_rows();

		   $this->db
		   ->select('SUM(t1.total_amount) as total_amount')
		   ->from('purchase t1')
		   ->where([
			   't1.is_deleted' => 'NOT_DELETED',
			   't1.purchase_order_date >=' => $start_date,
			   't1.purchase_order_date <=' => $end_date
		   ]);
	   
			$query3 = $this->db->get();
			$total_purchase_result = $query3->row();
			
			if ($total_purchase_result) {
				$totalPurchase = $total_purchase_result->total_amount;
			} else {
				$totalPurchase = 0;
			}
	   


			$this->db
			->select('SUM(t1.amount) as totalBankAmount')
			->from('shop_bank_accounts t1')       
			->where(['t1.is_deleted' => 'NOT_DELETED', 't1.active' => '1']);
		
			$query = $this->db->get();
			$shop_bank_accounts = $query->num_rows();
			
			if($shop_bank_accounts > 0)
			{
				$result = $query->row(); // Fetch the single row result
				$totalBankAmount = $result->totalBankAmount; // Access the totalBankAmount property
			}

			

			$this->db
			->select('SUM(t1.cr) as totalcr, SUM(t1.dr) as totaldr')
			->from('cash_register t1')       
			->where([
				't1.is_deleted' => 'NOT_DELETED', 
				't1.active' => '1',
				'txn_type' => '8',
				't1.PaymentDate >=' => $start_date, 
				't1.PaymentDate <=' => $end_date
			]);

		$query2 = $this->db->get();
		$cash_register_count = $query2->num_rows();

		if ($cash_register_count > 0) {
			$cash_register_result = $query2->row();
			// print_r($cash_register_result);
			$expenseAmount = $cash_register_result->totaldr - $cash_register_result->totalcr; 
		}


		$this->db
		->select('SUM(t1.total_qty) as total_qty')
		->from('purchase t1')
		->where([
			't1.is_deleted' => 'NOT_DELETED',
			't1.purchase_order_date >=' => $start_date,
			't1.purchase_order_date <=' => $end_date
		]);
	
		 $query4 = $this->db->get();
		 $purchaseQty_result = $query4->row();
		 
		 if ($purchaseQty_result) {
			 $purchaseQty = $purchaseQty_result->total_qty;
		 } else {
			 $purchaseQty = 0;
		 }


		 $this->db
		->select('SUM(t2.qty) as total_qty')
		->from('products_subcategory t1')
		->join('shops_inventory t2','t2.product_id=t1.id')
		->where([
			't1.is_deleted' => 'NOT_DELETED',
			't2.is_deleted' => 'NOT_DELETED',
			't1.active' => '1',
			't2.status' => '1',
			'DATE(t1.added) >=' => $start_date,
			'DATE(t1.added) <=' => $end_date
		]);
		 $query5 = $this->db->get();
		 $StockQty_result = $query5->row();
		 if ($StockQty_result) {
			 $StockQty = $StockQty_result->total_qty;
		 } else {
			 $StockQty = 0;
		 }

		 $this->db
		 ->select('SUM(t2.total_value) as total_value')
		 ->from('products_subcategory t1')
		 ->join('shops_inventory t2','t2.product_id=t1.id')
		 ->where([
			 't1.is_deleted' => 'NOT_DELETED',
			 't2.is_deleted' => 'NOT_DELETED',
			 't1.active' => '1',
			 't2.status' => '1',
			 'DATE(t1.added) >=' => $start_date,
			 'DATE(t1.added) <=' => $end_date
		 ]);
		  $query6 = $this->db->get();
		  $stockAmount_result = $query6->row();
		  if ($stockAmount_result) {
			  $stockAmount = $stockAmount_result->total_value;
		  } else {
			  $stockAmount = 0;
		  }

		  $this->db
		  ->select('t1.*')
		  ->from('orders t1')       
		  ->where(['t1.status'=>'4','DATE(t1.added) >=' => $start_date , 'DATE(t1.added) <=' => $end_date]);
		   $TotalOnlineInvoice = $this->db->get()->num_rows();

		   $this->db
		   ->select('t1.*')
		   ->from('pos_orders t1')       
		   ->where(['t1.status'=>'4','t1.datetime >=' => $start_date , 't1.datetime <=' => $end_date]);
			$TotalPosInvoice = $this->db->get()->num_rows();

			$this->db
			->select('SUM(t2.qty) as total_qty')
			->from('orders t1')
			->join('order_items t2','t2.order_id=t1.id','left')
			->where([
				't1.status' => '4',
				'DATE(t1.added) >=' => $start_date,
				'DATE(t1.added) <=' => $end_date
			]);
			 $query7 = $this->db->get();
			 $totalSoldQty_result = $query7->row();
			 if ($totalSoldQty_result) {
				 $totalSoldQty = $totalSoldQty_result->total_qty;
			 } else {
				 $totalSoldQty = 0;
			 }

			 $this->db
			->select('t1.qty,t2.selling_rate,t3.offer_upto,t3.discount_type')
			->from('cart t1')
			->join('shops_inventory t2','t2.id=t1.product_id','left')
			->join('shops_coupons_offers t3','t3.product_id=t2.product_id','left')
			->where([
				'DATE(t1.added) >=' => $start_date,
				'DATE(t1.added) <=' => $end_date
			]);
			 $query8 = $this->db->get();
			 $averageCartValueCount_result = $query8->result();
			 if ($averageCartValueCount_result) {
				$finalperlist=$finalamountlist=$averageCartValueCount=$averageCartValueAmount=$averageCartValueQty=0;
				
				foreach($averageCartValueCount_result as $car)
				{
					if($car->discount_type==1)
					{
						$finalperlist = $car->selling_rate*$car->offer_upto/100;
						$finalamountlist = $car->selling_rate-$finalperlist;
					}elseif($car->discount_type==0)
					{
						$finalamountlist = ($car->selling_rate-$car->offer_upto);
					}else{
						$finalamountlist=$car->selling_rate;
					} 
					$averageCartValueAmount = $averageCartValueAmount +$finalamountlist; 
					$averageCartValueQty = $averageCartValueQty +$car->qty; 
				}
				
				$averageCartValueCount = round_price($averageCartValueAmount/$averageCartValueQty);
				// print_r($averageCartValueCount);die();
			 } else {
				 $averageCartValueCount = 0;
			 }
		
		 
		     $return = [
			'TotalPosSales' => $TotalPosSales ? $TotalPosSales : 0,
		    'TotalOnlineSales'=>$TotalOnlineSales ? $TotalOnlineSales : 0,
			'totalSalesReturn' => $totalSalesReturn ? $totalSalesReturn : 0,
			'salesDueAmount' => 0,
			'TotalPosInvoice' => $TotalPosInvoice ? $TotalPosInvoice : 0,
		    'TotalOnlineInvoice' => $TotalOnlineInvoice ? $TotalOnlineInvoice : 0,
			'totalSoldQty' => $totalSoldQty ? $totalSoldQty : 0,
			'customerCount' => $customerCount ? $customerCount : 0,
			'supplierCount' => $supplierCount ? $supplierCount : 0,
			'totalPurchase' => $totalPurchase ? $totalPurchase : 0,
			'totalPurchaseReturn' =>$totalPurchaseReturn ? $totalPurchaseReturn : 0,
			'purchaseQty' => $purchaseQty ? $purchaseQty : 0,
			'PurchasePaidAmount' => 0,
			'PurchaseDueAmount' => 0,
			'TotalPosBills' => $TotalPosInvoice ? $TotalPosInvoice : 0,
	    	'TotalOnlineBills' =>$TotalOnlineInvoice ? $TotalOnlineInvoice : 0,
			'productCount' => $productCount ? $productCount : 0,
			'StockQty' => $StockQty ? $StockQty : 0,
			'stockAmount' => $stockAmount ? $stockAmount : 0,
			'expenseAmount' => $expenseAmount ? $expenseAmount : 0,
			'averageBillsCount' => 0,
			'averageCartValueCount' => $averageCartValueCount  ? $averageCartValueCount : 0,
			'averageMarginInPercentage' => 0,
			'grossProfitData' => 0,
			'ProfitMargin' => 0,
			'totalBankAmount'=>$totalBankAmount ? $totalBankAmount : 0,
		];

		return $return;
	}


	

}
?>