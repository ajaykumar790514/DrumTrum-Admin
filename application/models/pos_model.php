<?php
defined('BASEPATH') or exit('No direct script access allowed');
#[\AllowDynamicProperties]
class Pos_model extends CI_Model
{
    function index()
    {
        echo 'This is model index function';
    }
    function __construct()
    {
        $this->tbl1 = '';
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
    function updateRow($id, $data = array())
    {
        $this->db->where($this->tbl1 . '.' . 'id', $id);
        $result = $this->db->update($this->tbl1, $data);
        return $result;
    }
    function deleteRow($id)
    {
        $this->db->where($this->tbl1 . '.' . 'id', $id);
        $result = $this->db->delete($this->tbl1);
        return $result;
    }
    // function getItem($search, $shop_id)
    // {

    //     $response = array();

    //     if (isset($search['search'])) {
    //         $query = "SELECT `t1`.*,`t1`.`tax_value` as `tax_value_new` , `t2`.*, CONCAT(`t3`.`fname`, ' ', `t3`.`lname`) AS `vendor_name`,`t4`.*
    //                     FROM `products_subcategory` `t1`
    //                     JOIN `shops_inventory` `t2` ON `t2`.`product_id` = `t1`.`id`
    //                     LEFT JOIN `customers` `t3` ON `t3`.`id` = `t2`.`vendor_id`
    //                     JOIN `shops_coupons_offers` `t4` ON `t4`.`product_id` = `t1`.`id`
    //                     WHERE `t2`.`shop_id` = {$shop_id}
    //                     AND `t2`.`is_deleted` = 'NOT_DELETED'
    //                     AND `t2`.`qty` != 0
    //                     AND  (`t1`.`product_code` LIKE '%{$search['search']}%' OR  `t1`.`name` LIKE '%{$search['search']}%' OR  `t2`.`selling_rate` LIKE '%{$search['search']}%')
    //                     ORDER BY `t1`.`name` ASC";

            
    //         $records = $this->db->query($query)->result();
           
    //     //   echo _prx($records);die();

    //         foreach ($records as $row) {
    //             $response[] = array(
    //                         "value" => $row->product_id,
    //                         "inventory_id"=>$row->id, 
    //                         "label" => $row->name.' - '.$row->unit_value.$row->unit_type .' - '.$row->vendor_name .' [Total Stock : '.$row->qty.']' , 
    //                         "product_code" => $row->product_code,
    //                         "purchase_rate" => $row->purchase_rate ,
    //                         "mrp" => $row->mrp, 
    //                         "description" => $row->description, 
    //                         "qty" => $row->qty, 
    //                         "AdditionalDiscount" => $row->AdditionalDiscount, 
    //                         "discount_type" => $row->discount_type,
    //                         "offer_upto" => $row->offer_upto,
    //                         "tax_value" => $row->tax_value_new);
    //         }
    //     }
    //     return $response;
    // }
    function getItem($search, $shop_id)
    {
        $response = array();
    
        if (isset($search['search'])) {
            // Clean the search term to prevent SQL injection
            $searchTerm = $this->db->escape_like_str($search['search']);
    
            // Select only the necessary columns
            $query = "SELECT 
                        t1.id AS product_id,
                        t1.name,
                        t1.unit_value,
                        t1.unit_type,
                        t1.product_code,
                        t1.description,
                        t1.tax_value AS tax_value_new,
                        t2.id AS inventory_id,
                        t2.purchase_rate,
                        t2.mrp,
                        t2.qty,
                        CONCAT(t3.fname, ' ', t3.lname) AS vendor_name,
                        t2.AdditionalDiscount,
                        t4.discount_type,
                        t4.offer_upto
                    FROM 
                        products_subcategory t1
                    JOIN 
                        shops_inventory t2 ON t2.product_id = t1.id
                    LEFT JOIN 
                        customers t3 ON t3.id = t2.vendor_id
                    JOIN 
                        shops_coupons_offers t4 ON t4.product_id = t1.id
                    WHERE 
                        t2.shop_id = ?
                        AND t2.is_deleted = 'NOT_DELETED'
                        AND t1.is_deleted = 'NOT_DELETED'
                        AND t1.active = '1'
                        AND t2.qty != 0
                        AND (
                            t1.product_code LIKE ? 
                            OR t1.name LIKE ? 
                            OR t2.selling_rate LIKE ?
                        )
                    ORDER BY 
                        t1.name ASC";
    
            // Bind parameters to prevent SQL injection
            $queryParams = [
                $shop_id,
                "%$searchTerm%",
                "%$searchTerm%",
                "%$searchTerm%"
            ];
    
            // Execute the query
            $records = $this->db->query($query, $queryParams)->result();
    
            foreach ($records as $row) {
                $response[] = array(
                    "value" => $row->product_id,
                    "inventory_id" => $row->inventory_id,
                    "label" => $row->name . ' - ' . $row->unit_value . $row->unit_type . ' - ' . $row->vendor_name . ' [Total Stock : ' . $row->qty . ']',
                    "product_code" => $row->product_code,
                    "purchase_rate" => $row->purchase_rate,
                    "mrp" => $row->mrp,
                    "description" => $row->description,
                    "qty" => $row->qty,
                    "AdditionalDiscount" => $row->AdditionalDiscount,
                    "discount_type" => $row->discount_type,
                    "offer_upto" => $row->offer_upto,
                    "tax_value" => $row->tax_value_new
                );
            }
        }
        return $response;
    }
    

    function getcustomer($search, $shop_id)
    {
        $response = array();

        if (isset($search['search'])) {
            // Select record
            $this->db->select('*')
                ->from('customers t1')
                ->where(['shop_id' => $shop_id, 'is_deleted' => 'NOT_DELETED', 'isActive' => '1', "user_type" => "customer"])
                ->order_by('fname', 'asc');
            $this->db->like('fname', $search['search']);
            $records = $this->db->get()->result();

            foreach ($records as $row) {
                
                $response[] = array("value" => $row->id, "label" => $row->fname.' '.$row->lname, "mobile" => $row->mobile, "gstin" => $row->gstin, "vendor_code" => $row->vendor_code,  "contact_person_name" => $row->contact_person_name,  "email" => $row->email, "email" => $row->email, "address" => $row->address);
            }
        }
        return $response;
    }


    public function get_customer_code($vendor_code)
    {
        $query = $this->db->select("vendor_code")
            ->from('customers')
            ->where(['vendor_code'=>$vendor_code,'user_type'=>'customer'])
            ->get();
        return $query->row();
    }


    // ankit Verma

    public function save_order($data)
    {
        if ($this->db->insert('pos_orders',$data)) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function update_order($data,$id)
    {
        $this->db->where('id',$id);
        if ($this->db->update('pos_orders',$data)) {
            return true;
        }
        return false;
    }

    public function update_inventry($cond,$qty)
    {
        $inventry = $this->db->get_where('shops_inventory',$cond)->row();
        $update_inventry['qty'] = $inventry->qty - $qty;
        $this->db->where($cond);
        $this->db->update('shops_inventory',$update_inventry);
        $data_shop_inventry_log = array(
            'product_id'=>$cond['product_id'],
            'qty'=>$qty,
            'purchase_rate'=>$inventry->purchase_rate,
            'mrp'=>$inventry->mrp,
            'selling_rate'=>$inventry->selling_rate,
            'shop_id'=>$cond['shop_id'],
            'tax_value'=>$inventry->tax_value,
            'total_value'=>$inventry->total_value,
            'total_tax'=>$inventry->total_tax,
            );
            logs($cond['shop_id'],$inventry->id,'EDIT','Edit POS Sale Inventory');
            $data_shop_inventry_log['action']="ADD_INVENTORY";
            $data_shop_inventry_log['shops_inventory_id']=$inventry->id;
            $this->master_model->add_data('shop_inventory_logs', $data_shop_inventry_log);
    }
    public function update_inventry_edit($cond, $qty, $exist_qty)
    {
        // Calculate the remaining quantity
        $remain =  $exist_qty-$qty;
        $product_id= $cond['product_id'];
        $id= $cond['id'];
        $shop_id= $cond['shop_id'];
        if ($remain != 0) {
            // Fetch the inventory record
            $inventry = $this->db->get_where('shops_inventory',['product_id'=>$product_id,'id'=>$id])->row();
    
            if ($inventry) {
                // print_r($inventry);
                // Update the inventory quantity
                $update_inventry['qty'] = abs(($inventry->qty) + ($remain));
                $this->db->where($cond);
                $this->db->update('shops_inventory', $update_inventry);
    
                // Log the inventory update
                $data_shop_inventry_log = array(
                    'product_id' => $cond['product_id'],
                    'qty' => $qty,
                    'purchase_rate' => $inventry->purchase_rate,
                    'mrp' => $inventry->mrp,
                    'selling_rate' => $inventry->selling_rate,
                    'shop_id' => $cond['shop_id'],
                    'tax_value' => $inventry->tax_value,
                    'total_value' => $inventry->total_value,
                    'total_tax' => $inventry->total_tax,
                    'action' => "EDIT_INVENTORY",
                    'shops_inventory_id' => $inventry->id
                );
                $this->master_model->add_data('shop_inventory_logs', $data_shop_inventry_log);
    
                // Additional logging if needed
                logs($cond['shop_id'], $inventry->id, 'EDIT', 'edit POS Sale Inventory');
            }
        }
    }
    
     // Method to get available coupons
    public function get_available_coupons() {
        $current_date = date('Y-m-d');
        $this->db->where('active', '1');
        $this->db->where('coupan_or_offer', '0');
        $this->db->where('start_date <=', $current_date);
        $this->db->where('expiry_date >=', $current_date);
        $query = $this->db->get('coupons_and_offers');
        return $query->result();
    }

    // Method to apply a coupon
    public function apply_coupon($coupon_code,$net_amount, $customer_id) {
        $coupon = $this->get_coupon_details($coupon_code);
        if (!$coupon) {
            return array('success' => false, 'message' => 'Invalid coupon code');
        }
        
        if ($net_amount < $coupon['minimum_coupan_amount']) {
            return array('success' => false, 'message' => 'Minimum amount required to apply this coupon is ' . $coupon['minimum_coupan_amount']);
        }
        if ($coupon['discount_type'] == 1) { 
            $discount_value = ($net_amount * $coupon['value']) / 100;
        } else { 
            $discount_value = $coupon['value'];
        }
    
        if (isset($coupon['maximum_coupan_discount_value']) && $discount_value > $coupon['maximum_coupan_discount_value']) {
            $discount_value = $coupon['maximum_coupan_discount_value'];
        }
         // Store the applied coupon in session (optional)
         $this->session->set_userdata('applied_coupon_' . $customer_id, $coupon_code);
        
        return array(
            'success' => true,
            'value' => $discount_value,
            'total' => $net_amount-$discount_value,
            'discount_type' => $coupon['discount_type'],
            'discount_value' => $coupon['value'],
            'minimum_coupan_amount' => $coupon['minimum_coupan_amount'],
            'maximum_coupan_discount_value' => $coupon['maximum_coupan_discount_value']
        );
    }
    public function get_coupon_details($coupon_code) {
        $this->db->select('title, value, discount_type, minimum_coupan_amount, maximum_coupan_discount_value, start_date, expiry_date, active');
        $this->db->from('coupons_and_offers');
        $this->db->where('code', $coupon_code);
        $this->db->where('active', 1);
        $this->db->where('start_date <=', date('Y-m-d'));
        $this->db->where('expiry_date >=', date('Y-m-d'));
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }
    
    

    
}
