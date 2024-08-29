<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#[\AllowDynamicProperties]
class shops_vendor_model extends CI_Model
{
    public function vendors($limit=null,$start=null)
    {
        if ($limit!=null) {
            $this->db->limit($limit, $start);
        }
        $this->db
        ->select('t1.*,t2.name as state_name,t3.name as city_name')
        ->from('customers t1')
        ->join('states t2', 't2.id = t1.state','left')        
        ->join('cities t3', 't3.id = t1.city','left')        
        ->where(['t1.is_deleted' => 'NOT_DELETED','t1.user_type'=>'supplier'])
        ->order_by('t1.added','desc');
        if (@$_POST['search']) {
            $data['search'] = $_POST['search'];
            $this->db->group_start();
            $this->db->like('t1.fname', $_POST['search']);
            $this->db->or_like('t1.vendor_code', $_POST['search']);
            $this->db->or_like('t1.mobile', $_POST['search']);
            $this->db->or_like('t1.gstin', $_POST['search']);
            $this->db->where('t1.user_type', 'supplier');
            $this->db->group_end();
		}
        
	
        if($limit!=null)
            return $this->db->get()->result();
        else
            return $this->db->get()->num_rows();
		return $this->db->get()->result();
    }
    public function customer($limit=null,$start=null)
    {
        if ($limit!=null) {
            $this->db->limit($limit, $start);
        }
        $this->db
        ->select('t1.*,t1.fname as vendor_fname,t1.lname as vendor_lname,t2.name as state_name,t3.name as city_name')
        ->from('customers t1')
        ->join('states t2', 't2.id = t1.state','left')        
        ->join('cities t3', 't3.id = t1.city','left')        
        ->where(['t1.is_deleted' => 'NOT_DELETED'])
        ->where(['t1.user_type' => 'customer'])
        ->order_by('t1.added','desc');
        if (@$_POST['search']) {
			$data['search'] = $_POST['search'];
            $this->db->group_start();
			$this->db->like('t1.fname', $_POST['search']);
			$this->db->or_like('t1.vendor_code', $_POST['search']);
            $this->db->or_like('t1.mobile', $_POST['search']);
            $this->db->or_like('t1.gstin', $_POST['search']);
            $this->db->where(['t1.is_deleted'=>'NOT_DELETED','t1.user_type'=>'customer']);
            $this->db->group_end();
		}
        if($limit!=null)
            return $this->db->get()->result();
        else
            return $this->db->get()->num_rows();
		return $this->db->get()->result();
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
    
    public function Purchase($limit=null,$start=null)
    {
        if ($limit!=null) {
            $this->db->limit($limit, $start);
        }
        $this->db
        ->select("A1.id as purchase_id,A1.*,t1.*,CONCAT(t1.fname, ' ', t1.lname) AS vendor_name,t2.name as state_name,t3.name as city_name,t4.name as status_name")
        ->from('purchase A1')
        ->join('customers t1', 't1.id = A1.supplier_id','left') 
        ->join('states t2', 't2.id = t1.state','left')        
        ->join('cities t3', 't3.id = t1.city','left') 
        ->join('purchase_order_status t4', 't4.id = A1.status','left')  
        ->where(['A1.is_deleted'=>'NOT_DELETED','t1.user_type'=>'supplier'])  
        ->order_by('A1.added','DESC');
        if (@$_POST['search']) {
			$this->db->like('t1.fname', $_POST['search']);
            $this->db->or_like('t1.mobile', $_POST['search']);
			$this->db->or_like('t1.vendor_code', $_POST['search']);
            $this->db->or_like('A1.purchase_order_no', $_POST['search']);
            $this->db->or_like('t1.gstin', $_POST['search']);
		}
        if (@$_POST['status']) {
			$this->db->where('A1.status',$_POST['status']);
		}


		if (@$_POST['from_date']) {
			$from_date = $_POST['from_date'] .' 00:00:00';    
			$this->db->where('A1.purchase_order_date >=',$from_date);
		}

		if (@$_POST['end_date']) {
			$end_date = $_POST['end_date'] . ' 23:59:59';
			$this->db->where('A1.purchase_order_date <=',$end_date);
		}
        if($limit!=null)
            return $this->db->get()->result();
        else
            return $this->db->get()->num_rows();
    }
    public function get_vendor_opening($user_id)
    {
        $this->db->where('user_id',$user_id);
         $this->db->where('type','1');
        return $this->db->get('vendors_opening')->row();
    }
    public function customers($id)
    {
        $query = $this->db
        ->select('t1.*,t2.name as cust_state_name,ca.city as cust_city_name,t4.business_id,t4.id as shop_id,t4.shop_name,ca.address as cust_address,ca.house_no,ca.address_line_2,ca.address_line_3,ca.apartment_name,ca.floor,ca.pincode as cust_pincode')
        ->from('customers t1')
        ->join('customers_address ca', 'ca.customer_id = t1.id','left')  
        ->join('states t2', 't2.id = ca.state','left')        
        ->join('shops t4', 't4.id = t1.shop_id','left')        
		->where(['t1.is_deleted' => 'NOT_DELETED','t1.id'=>$id])    
        ->get();
        // echo $this->db->last_query();die();
		return $query->row();
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
    public function vendor_opening($data,$user_id=null)
    {
        if ($this->get_vendor_opening($user_id)) {
            $this->db->where('user_id',$user_id);
            $this->db->update('vendors_opening',$data);
        }
        else{
            $this->db->insert('vendors_opening',$data);
        }
    }
     public function vendor_opening_new($data,$user_id=null)
    {
        if ($this->get_vendor_opening($user_id)) {
            $this->db->where(['user_id'=>$user_id,'type'=>'2']);
            $this->db->update('vendors_opening',$data);
        }
        else{
            $this->db->insert('vendors_opening',$data);
        }
    }
      public function vendor_opening_new2($data,$user_id=null)
    {
        if ($this->get_vendor_opening($user_id)) {
            $this->db->where(['user_id'=>$user_id,'type'=>'1']);
            $this->db->update('vendors_opening',$data);
        }
        else{
            $this->db->insert('vendors_opening',$data);
        }
    }
    
    public function vendor($id)
    {
        $query = $this->db
        ->select('t1.*,t2.name as state_name,t3.name as city_name,t4.business_id,t4.id as shop_id,t4.shop_name')
        ->from('vendors t1')
        ->join('states t2', 't2.id = t1.state','left')        
        ->join('cities t3', 't3.id = t1.city','left')        
        ->join('shops t4', 't4.id = t1.shop_id','left')        
		->where(['t1.is_deleted' => 'NOT_DELETED','t1.id'=>$id])    
        ->get();
		return $query->row();
    }
    public function customers_row($id)
    {
        $query = $this->db
        ->select('t1.*,t2.name as state_name,t3.name as city_name,t4.business_id,t4.id as shop_id,t4.shop_name')
        ->from('customers t1')
        ->join('states t2', 't2.id = t1.state','left')        
        ->join('cities t3', 't3.id = t1.city','left')        
        ->join('shops t4', 't4.id = t1.shop_id','left')        
		->where(['t1.is_deleted' => 'NOT_DELETED','t1.id'=>$id])    
        ->get();
		return $query->row();
    }
    public function search_supplier($name) {
        $this->db->like('fname', $name, 'both');
        $this->db->where(['user_type'=>'supplier','isActive'=>'1','is_deleted' => 'NOT_DELETED']);
        $query = $this->db->get('customers');
        return $query->result();
    }
    public function search_product($name) {
        $this->db->like('name', $name, 'both');
        $this->db->where(['is_deleted'=>'NOT_DELETED','active'=>'1']);
        $query = $this->db->get('products_subcategory');
        return $query->result();
    }
    
    public function get_supplier_details($supplierId) {
        $this->db
        ->select("t1.*, CONCAT(t1.fname, ' ', t1.lname) as name, t2.name as state_name, t3.name as city_name")
        ->from('customers t1')
        ->join('states t2', 't1.state = t2.id')
        ->join('cities t3', 't1.city = t3.id')
        ->where(['t1.isActive'=>'1','t1.is_deleted' => 'NOT_DELETED','t1.user_type'=>'supplier','t1.id'=>$supplierId]);
        $query = $this->db->get();
        return $query->row();
    }
    public function getItemCodeData($name) {
        $this->db->like('t1.product_code', $name);
        $this->db
        ->select('t1.*,t1.id as product_id,t2.mrp,t2.selling_rate,t2.qty,t3.offer_upto,t3.discount_type')
        ->from('products_subcategory t1')
        ->join('shops_inventory t2', 't2.product_id = t1.id','left')
        ->join('shops_coupons_offers t3', 't3.product_id = t1.id','left')
        ->where(['t1.is_deleted'=>'NOT_DELETED']);
        $query = $this->db->get();
        return $query->row();
    }
    public function getItemCodeDataInventory($product_id) {
        $this->db
        ->select('t1.*')
        ->from('shops_inventory t1')
        ->where('t1.product_id',$product_id);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function getItemIDData($id) {
        
        $this->db
        ->select('t1.*,t1.id as product_id,t2.mrp,t2.selling_rate,t2.qty,t3.offer_upto,t3.discount_type')
        ->from('products_subcategory t1')
        ->join('shops_inventory t2', 't2.product_id = t1.id','left')
        ->join('shops_coupons_offers t3', 't3.product_id = t1.id','left')
        ->where(['t1.id'=>$id,'t1.is_deleted'=>'NOT_DELETED','t1.active'=>'1']);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function getItemIDDataNew($id) {
        $this->db
        ->select('t1.*,t1.id as product_id')
        ->from('products_subcategory t1')
        ->where(['t1.id'=>$id,'t1.is_deleted'=>'NOT_DELETED']);
        $query = $this->db->get();
        return $query->row();
    }

    public function getPurchasedetails($id)
    {
        
        $this->db
        ->select("t1.*,t1.id as purchase_id, CONCAT(t2.fname, ' ', t2.lname) as vendor_name,t3.name as state_name,t4.name as city_name,t2.mobile,t2.address,t2.gstin,t2.pincode")
        ->from('purchase t1')
        ->join('customers t2', 't2.id = t1.supplier_id','left')
        ->join('states t3', 't2.state = t3.id')
        ->join('cities t4', 't2.city = t4.id')
        ->where('t1.id', $id);
        $query = $this->db->get();
        return $query->row_array();
        
    }
    public function getPurchaseItemdetails($id,$vendor_id)
    {
        
        $this->db
        ->select('t1.*,t3.name,t3.product_code,t3.unit_type,t3.unit_type_id,t3.tax_value,t4.discount_type,t4.offer_upto,t5.id as inventtory_id,t5.qty as inventory_qty')
        ->from('purchase_items t1')
        ->join('purchase t2', 't2.id = t1.purchase_id','left')
        ->join('products_subcategory t3', 't3.id = t1.item_id','left')
        ->join('shops_coupons_offers t4', 't4.product_id = t1.item_id','left')
        ->join('shops_inventory t5', 't1.id = t5.purchase_item_id','left')
        ->where(['t1.purchase_id'=>$id]);
        $query = $this->db->get();
        return $query->result_array();
        
    }
    public function product($id)
    {
        $query = $this->db
        ->select('t1.*,t1.parent_cat_id,t2.id as cat_id,t2.name as cat_name,t2.is_parent,t3.id as main_cat_id,t3.name as main_cat_name,t3.is_parent as main_is_parent')
        ->from('products_subcategory t1')
        ->join('products_category t2', 't2.id = t1.parent_cat_id','left')        
        ->join('products_category t3', 't3.id = t1.sub_cat_id','left')        
        ->where(['t1.is_deleted' => 'NOT_DELETED','t1.id'=>$id])
        ->get();
		return $query->row();
        // return $this->db->get_where('products_subcategory',['id'=>$id])->row();
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
    public function delete_purchase($id)
    {
        $is_deleted = array('is_deleted' => 'DELETED');
        return $this->db->where('id', $id)->update('purchase', $is_deleted);
    }
    public function delete_inventory($id)
    {
        $is_deleted = array('is_deleted' => 'DELETED');
        return $this->db->where('id', $id)->update('shops_inventory', $is_deleted);
    }
    public function delete_inventory_log($data)
    {
        
        return $this->db->insert('shop_inventory_logs', $data);
    }
    public function delete_product($id)
    {
        $is_deleted = array('is_deleted' => 'DELETED');
        return $this->db->where('id', $id)->update('products_subcategory', $is_deleted);
    }
}
?>