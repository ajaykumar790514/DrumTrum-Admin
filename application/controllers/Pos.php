<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->checkShopLogin();
        $this->check_role_menu();
        $this->load->model('pos_model');
    }

    public function isLoggedIn(){
        $is_logged_in = $this->session->userdata('shop_logged_in');
        if(!isset($is_logged_in) || $is_logged_in!==TRUE)
        {
            redirect(base_url());
            exit;
        }
    } 
    public function check_role_menu(){
        $data['user'] = $user =  $this->checkShopLogin();
        $shop_role_id = $user->role_id;
        $uri = $this->uri->segment(1);
        $role_menus = $this->admin_model->all_role_menu_data($shop_role_id);
        $url_array = array();
        if(!empty($role_menus))
        {
            foreach($role_menus as $menus)
            {
                array_push($url_array,$menus->url);
            }
            if(!in_array($uri,$url_array))
            {
                redirect(base_url());
            }
        }
        else
        {
            redirect(base_url());
            exit;
        }      
    } 

    public function header_and_footer($page, $data)
    {
        $data['user'] = $user =  $this->checkShopLogin();
        $shop_id     = $user->id;
        $shop_role_id     = $user->role_id;
        $data['shop_menus'] = $this->admin_model->get_role_menu_data($shop_role_id);        
        $data['all_menus'] = $this->admin_model->get_data1('tb_admin_menu','status','1');
		$shop_details = $this->shops_model->get_shop_data($shop_id);
        $uri = $this->uri->segment(1);
        $template_data = array(
        'menu'=> $this->load->view('template/menu',$data,TRUE),
        'main_body_data'=> $this->load->view($page,$data,TRUE),
        'shop_photo'=>$shop_details->logo,
        'uri'=>$uri
        );
            $this->load->view('template/main_template',$template_data);
    }
    public function pos_data($action = null, $p1 = null, $p2 = null, $p3 = null, $p4 = null, $p5 = null, $p6 = null, $p7 = null)
    {
        $data['user'] = $user =  $this->checkShopLogin();
        switch ($action) {
            case null:
                $data['title']          = 'POS';
                $data['states']  = $this->shops_vendor_model->view_data('states');
                $data['cities']  = $this->shops_vendor_model->view_data('cities');
                $data['mode']  = $this->master_model->getData('pos_payment_mode',0,'ASC','order');
                $data['modemultipay']  = $this->master_model->getData('pos_payment_mode',['id!='=>'4'],'ASC','order');
                $data['accounts']  = $this->master_model->getData('shop_bank_accounts',['is_deleted'=>'NOT_DELETED','active'=>'1'],'ASC','bank_name');
                // $page                   = 'shop/pos/pos_index';
                $page                   = 'shop/pos/index';
                $data['new_customer']        = base_url() . 'shop-pos/new_customer';
                $data['menu_url'] = $this->uri->segment(1);
                $data['breadcrumb']    = generate_breadcrumb($data['menu_url']); 
                
                $this->header_and_footer($page, $data);
                break;
                case 'edit_pos':
                    $data['order_id'] = $order_id =$p1;
                    $data['title']          = 'Edit POS';
                    $data['states']  = $this->shops_vendor_model->view_data('states');
                    $data['cities']  = $this->shops_vendor_model->view_data('cities');
                    $data['mode']  = $this->master_model->getData('pos_payment_mode',0,'ASC','order');
                    $data['modemultipay']  = $this->master_model->getData('pos_payment_mode',['id!='=>'4'],'ASC','order');
                    $data['accounts']  = $this->master_model->getData('shop_bank_accounts',['is_deleted'=>'NOT_DELETED','active'=>'1'],'ASC','bank_name');
                    $page                   = 'shop/pos/edit_pos';
                    $data['new_customer']        = base_url() . 'shop-pos/new_customer';
                    $data['menu_url'] = $this->uri->segment(1);
                    $data['breadcrumb']    = generate_breadcrumb($data['menu_url']); 
                    $this->header_and_footer($page, $data);
                 break;   
                 case 'EditPosDetails':
                    $response = array(
                        'success' => false,
                        'msg' => 'Unable to fetch the edit pos details.'
                    );
                    $data['invoice'] = $this->pos_orders_model->billDetails($p1);
                    if ($data['invoice']) {
                        $response['success'] = true;
                        $response['invoice'] =$data['invoice'];
                        $response['msg'] = 'Edit pos details fetch successfully.';
                    } else {
                        $response['msg'] = 'Failed to fetch edit pos details. It may not exist.';
                    }
                    echo json_encode($response);
                 break;   
                 case 'deleteItem':
                    $item_id=$p1;
                    $item_count = $this->pos_orders_model->getItemCount($p1);
                    if ($item_count > 0) {
                        $deleted = $this->pos_orders_model->deleteItem($item_id);
                        if ($deleted) {
                            echo json_encode(['success' => true]);
                        } else {
                            echo json_encode(['success' => false]);
                        }
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Cannot delete the only item']);
                    }
                break;
                case 'new_customer':
                    $data['remote']             = base_url() . 'shop-master-data/remote/customer/';
                    $data['action_url']         = base_url() . 'shop-pos/save_customer';
                    $data['states']  = $this->shops_vendor_model->getData('states',['is_deleted'=>'NOT_DELETED','country_id'=>'101']);
                    $data['cities']  = $this->shops_vendor_model->view_data('cities');
                    $page                       = 'shop/pos/add_customer';
                    $this->load->view($page, $data);
                    break;
                    case 'getitem':
                        $shop_id     = $user->id;
                        $search = $this->input->post();
                        // Get data
                        $data = $this->pos_model->getItem($search, $shop_id);
                        echo json_encode($data);
                        break;
                    case 'getcustomer':
                        $shop_id     = $user->id;
                        $search = $this->input->post();
                        // Get data
                        $data = $this->pos_model->getcustomer($search, $shop_id);

                        

                        echo json_encode($data);
                        break;
              case 'fetch_city':
                    if($this->input->post('state'))
                    {
                        $sid= $this->input->post('state');
                        $this->master_model->fetch_city($sid);
                    }
             break;
            case 'save_customer':
                $return['res'] = 'error';
                $return['msg'] = 'Not Saved!';

                if ($this->input->server('REQUEST_METHOD') == 'POST') {
                    $shop_id     = $user->id;
                    $data = array(
                        'fname'     => $this->input->post('fname'),
                        'lname'     => $this->input->post('lname'),
                        'dob'     => $this->input->post('dob'),
                        'mobile'              => $this->input->post('mobile'),
                        'alternate_mobile'   => $this->input->post('alternate_mobile'),
                        'state'      => $this->input->post('state'),
                        'city'        => $this->input->post('city'),
                        'address'       => $this->input->post('address'),
                        'email'        => $this->input->post('email'),
                        'gstin'        => $this->input->post('gstin'),
                        'shop_id'        => $shop_id,
                        'vendor_code'        => $this->input->post('vendor_code'),
                        'pincode'        => $this->input->post('pincode'),
                        'aadhar_no'        => $this->input->post('aadhar_no'),
                        'credit_limit'        => $this->input->post('credit_limit'),
                        'user_type'        =>'customer',
                        'isActive'        =>'1',
                        'b2b_b2c'        => $this->input->post('b2b_b2c') ? $this->input->post('b2b_b2c') : 'b2c',
                    );
                    $this->db->where('mobile', $this->input->post('mobile'));
                    $this->db->where(['user_type'=>'customer','is_deleted'=>'NOT_DELETED']);
                    $count = $this->db->count_all_results('customers');
                    if ($count > 0) {
                        $return['res'] = 'error';
                        $return['msg'] = 'Failed! Mobile Number  already exist.';
                    }
                    else{
                        if ($user_id = $this->shops_vendor_model->add_data('customers', $data)) {
                            $opening = array(
                                'user_id' => $user_id,
                                'dr_cr' => $this->input->post('dr_cr'),
                                'amount' => $this->input->post('amount'),
                                'remark' => $this->input->post('remark'),
                                );
                                $this->shops_vendor_model->vendor_opening($opening);
                                $userdata = $this->master_model->getRow('customers',['id'=>$user_id]);
                                $return['res'] = 'success';
                                $return['msg'] = 'Customer add successfully!.';
                                $return['row'] = $userdata;
                        }else{
                            $return['res'] = 'error';
                            $return['msg'] = 'Failed! Customer not add.';
                        } 
                    }  
                }
                echo json_encode($return);
                break;
             case 'check_customer_code':
                if ($this->input->post('vendor_code')) {
                    $vendor_code = $this->input->post('vendor_code');
                    if ($this->pos_model->get_customer_code($vendor_code)) {
                        echo 1;
                    }
                }
             break;
             case 'check_order_id':
             
                 $responce['res'] = 'success';
                 $responce['msg'] = 'Order Number available!';
                 if (!$this->pos_orders_model->check_order_id()) {
                     $responce['res'] = 'error';
                     $responce['msg'] = 'Order Number not available!';
                 }
                 echo json_encode($responce);
             break;
             case 'getHoldOrders':
                $search = $this->input->get('search', true);
                $responce['success'] = false;
                $responce['msg'] = 'Order Data Not Available!';
                $data['orders']  = $this->pos_orders_model->getHoldOrders($search);
                if ($data['orders']) {
                    $responce['success'] = true;
                    $responce['orders'] = $data['orders'];
                }
                echo json_encode($responce);
            break;
            case 'check_upi_status':
                $shop_id = $user->id;
                $responce['success'] = false;
                $responce['msg'] = 'Failed to fetch Bank UPI';
                $status = $this->pos_orders_model->get_upi_status($shop_id);
                if ($status) {
                    $responce['success'] = true;
                    $responce['status'] = $status;
                }
                echo json_encode($responce);
            break;
            case 'deleteHoldBill':
                $response = array(
                    'success' => false,
                    'msg' => 'Unable to delete the hold bill.'
                );
                if ($this->input->post('id')) {
                    $id = $this->input->post('id');
                    $result = $this->pos_orders_model->deleteHoldBill($id);
        
                    if ($result) {
                        $response['success'] = true;
                        $response['msg'] = 'Hold bill deleted successfully.';
                    } else {
                        $response['msg'] = 'Failed to delete hold bill. It may not exist.';
                    }
                } else {
                    $response['msg'] = 'No ID provided.';
                }
                echo json_encode($response);
            break;
            case 'printHoldInvoice':
                $invoice = $this->pos_orders_model->invoice_details($p1);
                $data['shop']   = $invoice['shop'];
            $data['invoice'] = $this->pos_orders_model->invoice_details_new($p1);
            $this->load->view('template/pos_order_bill_print_layout_on_hold',$data);
            break;
            case 'getBillDetails':
                $response = array(
                    'success' => false,
                    'msg' => 'Unable to fetch the hold bill.'
                );
                $data['invoice'] = $this->pos_orders_model->billDetails($p1);
                if ($data['invoice']) {
                    $response['success'] = true;
                    $response['invoice'] =$data['invoice'];
                    $response['msg'] = 'Hold bill fetch successfully.';
                } else {
                    $response['msg'] = 'Failed to fetch hold bill. It may not exist.';
                }
                echo json_encode($response);
            break;    
            case 'getLastBill':
                $response = array(
                    'success' => false,
                    'msg' => 'Unable to fetch the last bill.'
                );
                $data['bill'] = $this->pos_orders_model->lastBill();
                if ($data['bill']) {
                    $response['success'] = true;
                    $response['bill'] =$data['bill'];
                    $response['msg'] = 'Last  bill fetch successfully.';
                } else {
                    $response['msg'] = 'Failed to fetch last  bill. It may not exist.';
                }
                echo json_encode($response);
            break;
             case 'check_customer_credit_limit':
                 $customer_id  = @$_POST['business_id'];
                 if($customer_id !=''){
                $customer=$this->pos_orders_model->getRow('customers',['id'=>$customer_id]);  
                if(@$customer->b2b_b2c=='b2c'){
                    $responce['res'] = 'success';
                } else{
                 $_POST['from_date']     = date('Y-m-d');
                 $_POST['to_date']       = date('Y-m-d');
                 $totalValue             = $_POST['TotalValue'];
                
                 $this->load->model('ladger_model','ladger_m');
                 $opening = $this->ladger_m->party_opening();
                 $credit_limit     = $opening['credit_limit'];
                 $acredit_limit    = $opening['credit_limit'] - $opening['total_balance'];
                 $balance          = $opening['total_balance'] + $totalValue;
         
                 if ($credit_limit >= $balance ) {
                     $responce['res'] = 'success';
                 }
                 else{
                     $responce['res'] = 'error';
                     $responce['msg'] = "Credit limit exceeded ( Credit Limit =  $credit_limit , Available credit limit = $acredit_limit )";
                 }
                }
                }else{
                    $responce['res'] = 'error';
                    $responce['msg'] = "Please select customer";
                }
         
                 echo json_encode($responce);
                 // echo json_encode($opening); 
                 // echo _prx($rows); die;
            break;
            case  'save_order':
                $responce['res'] = 'error';
                $responce['msg'] = 'Not Saved!';
                $shop_id = $user->id;
                $is_hold = $_POST['is_hold'];
                if(@$is_hold=='1'){


                        $orderData['payment_method'] = $_POST['payment_method'];
                        $orderData['reference_no_or_remark'] = $_POST['ref_no_or_remark'];
                        $transArray = array(
                            'customer_id' => $_POST['user_id'],
                            'dr' => $_POST['total_value'],
                            'order_id' => '',
                            'reference_no' => $_POST['ref_no_or_remark'],
                            'txn_type' => 1,
                            'PaymentDate' => '',
                            'narration' => $this->input->post('narration'),
                            'shop_id' => $shop_id,
                            'updated' => '',
                            'type' => 'Sale',
                        );
                    

                    $OrderTransArray = array(
                        'customer_id' => $_POST['user_id'],
                        'dr' => $_POST['total_value'],
                        'order_id' => '',
                        'reference_no' => $_POST['ref_no_or_remark'],
                        'txn_type' => 3,
                        'PaymentDate' => '',
                        'narration' => $this->input->post('narration'),
                        'shop_id' => $shop_id,
                        'updated' => '',
                        'type' => 'Sale',
                    );

                    $orderData['same_as_billing'] = $_POST['same_as_billing'];
                    if (@$_POST['same_as_billing'] == 1) {
                        $orderData['shipping_address'] = null;
                    } else {
                        $orderData['shipping_address'] = $_POST['shipping_address'];
                    }

                    $shop_state = $this->shops_model->get_shop_data($shop_id)->state;
                    $cus_state = $this->shops_vendor_model->customers($_POST['user_id'])->state;
                    $igst = ($shop_state == $cus_state) ? 0 : 1;

                    $oldData = $this->db->get_where('pos_orders', ['orderid' => $_POST['orderId']])->row();
                    $orderid = strtoupper('CK' . date('M') . '00000');
                    $orderDate = (@$_POST['order_date']) ? $_POST['order_date'] : date('Y-m-d');
                    $orderData['orderid'] = $orderid;
                    $orderData['shop_id'] = $shop_id;
                    $orderData['user_id'] = $_POST['user_id'];
                    $orderData['invoice_no'] = NULL;
                    $orderData['datetime'] = $orderDate;
                    $orderData['payment_mode'] = $_POST['payment_method'];
                    $orderData['status'] = 17;
                    $orderData['total_value'] = $_POST['total_value'];
                    $orderData['tax'] = $_POST['total_tax'];
                    $orderData['round_off'] = $_POST['RoundOff'];
                    $orderData['total_savings'] = '';
                    $orderData['remark'] = NULL;
                    $orderData['added'] = date('Y-m-d H:i:s');
                    $orderData['payment_transaction_code'] = NULL;
                    $orderData['address_id'] = NULL;
                    $orderData['random_address'] = $_POST['random_address'];
                    $orderData['timeslot_starttime'] = NULL;
                    $orderData['timeslot_endtime'] = NULL;
                    $orderData['time_slot_id'] = NULL;
                    $orderData['razorpay_order_id'] = NULL;
                    $orderData['razorpay_payment_id'] = NULL;
                    $orderData['razorpay_signature'] = NULL;
                    $orderData['booking_name'] = NULL;
                    $orderData['booking_contact'] = NULL;
                    $orderData['bank_name'] = NULL;
                    $orderData['is_igst'] = $igst;
                    $orderData['cancellation_reason_id'] = NULL;
                    $orderData['cancellation_comment'] = NULL;
                    $orderData['narration'] = $this->input->post('narration');
                    $orderData['reference_no_or_remark'] = $this->input->post('ref_no_or_remark');
                    $orderData['due_amount'] = $this->input->post('due_amount');
                    $orderData['tendered_amount'] = $this->input->post('tendered_amount');
                    $orderData['change_amount'] = $this->input->post('change_amount');
                    $orderData['order_type']    = $this->input->post('orderType');
                    $id = $oldData->id;

                    if ($this->pos_model->update_order($orderData, $id)) {
                        $payment = [
                            'order_id'              => $id,
                            'amount'                => $_POST['total_value'],
                            'payment_mode'           =>$_POST['payment_method'],
                        ];
                        $this->db->insert('pos_order_payments', $payment);
                        // Insert or update coupon
                        if($this->input->post('coupon_net_amount') > 0){
                        $coupon = array(
                            'order_id' => $id,
                            'order_type' => '1',
                            'coupon_type' => '2',
                            'coupon_value_type' => $this->input->post('coupon_type'),
                            'coupon_value' => $this->input->post('coupon_value'),
                            'amount' => $this->input->post('coupon_net_amount'),
                            'discount_amount' => $this->input->post('coupon_discount_amount'),
                        );
                        $this->insert_or_update_coupon($coupon);
                    }

                    $flat_value=$this->input->post('flat_value');
                    $flat_type=$this->input->post('flat_type');

                        $responce['res'] = 'success';
                        $responce['msg'] = 'Saved!';
                        $responce['invoice_url'] = base_url('pos_orders/print/bill/' . $id);
                        $responce['new_order'] = base_url('shop-pos');

                        if (@$_POST['orderId'] != '') {
                            $idlen = strlen($id);
                            $orderid = substr_replace($orderid, '', -$idlen) . $id;
                            $udata['orderid'] = $orderid;
                            $this->pos_model->update_order($udata, $id);
                        }

                        foreach ($_POST as $key => $value) {
                            $_POST[$key] = explode(',', $value);
                        }

                        $orderItem = [];
                        foreach ($_POST['product_id'] as $key => $value) {
                            $html = "";
                            $res = $this->pos_model->product_props($value);
                            if (count($res) > 0) {
                                foreach ($res as $row) {
                                    $html = $html . "<h6><span class='text-danger'>" . $row->name . " " . $row->value . "</span></h6>";
                                }
                            }
                            $orderItemTmp = array(
                                'inventory_id' => $_POST['inventory_id'][$key],
                                'product_id' => $_POST['product_id'][$key],
                                'order_id' => $id,
                                'qty' => $_POST['qty'][$key],
                                'price_per_unit' => $_POST['price_per_unit'][$key],
                                'purchase_rate' => $_POST['purchase_rate'][$key],
                                'mrp' => $_POST['mrp'][$key],
                                'total_price' => $_POST['total_price'][$key],
                                'tax' => $_POST['tax'][$key],
                                'tax_value' => $_POST['tax_value'][$key],
                                'offer_applied' => $_POST['offer_applied'][$key],
                                'discount_type' => $_POST['discount_type'][$key],
                                'offer_applied2' => $_POST['offer_applied2'][$key],
                                'discount_type2' => $_POST['discount_type2'][$key],
                                'flat_discount' => $flat_value,
                                'flat_discount_type' => $flat_type,
                                'item_props_value' => $html
                            );

                            // Check if item already exists
                            $existingItem = $this->db->get_where('pos_order_items', array(
                                'order_id' => $id,
                                'product_id' =>$_POST['product_id'][$key]
                            ))->row();

                            if ($existingItem) {
                                // Update existing item
                                $this->db->where('id', $existingItem->id);
                                $this->db->update('pos_order_items', $orderItemTmp);
                            } else {
                                // Insert new item
                                $orderItem[] = $orderItemTmp;
                            }
                        }

                        if (count($orderItem) > 0 && $this->db->insert_batch('pos_order_items', $orderItem)) {
                            foreach ($_POST['product_id'] as $key => $value) {
                                $inventryCond['id']         = $_POST['inventory_id'][$key];
                                $inventryCond['product_id'] = $_POST['product_id'][$key];
                                $inventryCond['shop_id'] = $shop_id;
                                $qty = $_POST['qty'][$key];
                                $qty = (int)$qty;
                                $this->pos_model->update_inventry($inventryCond,$qty);
                            }
                        }
                    }

                }else{
              // New Order 
                    $orderData['payment_method']         = $_POST['payment_method'];
                    $orderData['reference_no_or_remark'] = $_POST['ref_no_or_remark'];
                 
                    $transArray = array(
                        'customer_id'       => $_POST['user_id'],
                        'dr'                => $_POST['total_value'],
                        'order_id'          => '',
                        'reference_no'      => $_POST['ref_no_or_remark'],
                        'txn_type'          => 1,
                        'PaymentDate'       => '',
                        'narration'         => $this->input->post('narration'),
                        'shop_id'           => $shop_id,
                        'updated'           => '',
                        'type'              => 'Sale',
                    );
                    
        
                $OrderTransArray = array(
                        'customer_id'       => $_POST['user_id'],
                        'dr'                => $_POST['total_value'],
                        'order_id'          => '',
                        'reference_no'      => $_POST['ref_no_or_remark'],
                        'txn_type'          => 3,
                        'PaymentDate'       => '',
                        'narration'         => $this->input->post('narration'),
                        'shop_id'           => $shop_id,
                        'updated'           => '',
                        'type'              => 'Sale',
                    );
        
                $orderData['same_as_billing'] = $_POST['same_as_billing'];
                if (@$_POST['same_as_billing']==1) {
                    $orderData['shipping_address'] = null;
                }
                else{
                    $orderData['shipping_address'] = $_POST['shipping_address'];
                }
                $shop_state = $this->shops_model->get_shop_data($shop_id)->state;
                $cus_state = $this->shops_vendor_model->customers($_POST['user_id'])->state;
                $igst = ($shop_state==$cus_state) ? 0 : 1;
                 
                $orderid    = strtoupper('CK'.date('M').'00000');
                if ($_POST['orderId']!='') {
                    $orderid = $_POST['orderId'];
                    if (!$this->pos_orders_model->check_order_id()) {
                        $responce['res'] = 'error';
                        $responce['msg'] = 'Order Number not available!';
                        echo json_encode($responce);
                        die();

                    }
                }
        
                $orderDate = (@$_POST['order_date']) ? $_POST['order_date'] : date('Y-m-d');
                
                $orderData['orderid']                   = $orderid;
                $orderData['shop_id']                   = $shop_id;
                $orderData['user_id']                   = $_POST['user_id'];
                $orderData['invoice_no']                = NULL;
                $orderData['datetime']                  = $orderDate;
                $orderData['payment_mode']              = $_POST['payment_method'];
                $orderData['status']                    = 17;
                $orderData['total_value']               = $_POST['total_value'];
                $orderData['tax']                       = $_POST['total_tax'];
                $orderData['round_off']                 = $_POST['RoundOff'];
                $orderData['total_savings']             = '';
                $orderData['remark']                    = NULL;
                $orderData['added']                     = date('Y-m-d H:s:i');
                $orderData['payment_transaction_code']  = NULL;
                $orderData['address_id']                = NULL;
                $orderData['random_address']            = $_POST['random_address'];
                $orderData['timeslot_starttime']        = NULL;
                $orderData['timeslot_endtime']          = NULL;
                $orderData['time_slot_id']              = NULL;
                $orderData['razorpay_order_id']         = NULL;
                $orderData['razorpay_payment_id']       = NULL;
                $orderData['razorpay_signature']        = NULL;
                $orderData['booking_name']              = NULL;
                $orderData['booking_contact']           = NULL;
                $orderData['bank_name']                 = NULL;
                $orderData['is_igst']                   = $igst;
                $orderData['cancellation_reason_id']    = NULL;
                $orderData['cancellation_comment']      = NULL;
                $orderData['narration']                 = $this->input->post('narration');
                $orderData['reference_no_or_remark']    = $this->input->post('ref_no_or_remark');
                $orderData['due_amount']    = $this->input->post('due_amount');
                $orderData['tendered_amount']    = $this->input->post('tendered_amount');
                $orderData['change_amount']    = $this->input->post('change_amount');
                $orderData['order_type']    = $this->input->post('orderType');
                if ($id = $this->pos_model->save_order($orderData)) {

                $payment = [
                    'order_id'              => $id,
                    'amount'                => $_POST['total_value'],
                    'payment_mode'           =>$_POST['payment_method'],
                ];
                    $this->db->insert('pos_order_payments', $payment);

                //  Insert Coupon 
                if($this->input->post('coupon_net_amount') > 0){
                $coupon = array(
                'order_id'=>$id,
                'order_type'=>'1',
                'coupon_type'=>'2',
                'coupon_value_type'=>$this->input->post('coupon_type'),
                'coupon_value'=>$this->input->post('coupon_value'),
                'amount'=>$this->input->post('coupon_net_amount'),
                'discount_amount'=>$this->input->post('coupon_discount_amount'),
                );
                $this->db->insert('order_coupons',$coupon);
               }
               $flat_value=$this->input->post('flat_value');
            $flat_type=$this->input->post('flat_type');
    
                        $responce['res'] = 'success';
                        $responce['msg'] = 'Saved!';
                        $responce['invoice_url'] = base_url('pos_orders/print/bill/'.$id);
                        $responce['new_order'] = base_url('shop-pos');
            
                        if(@$_POST['orderId']=='') {
                            $idlen  = strlen($id);
                            $orderid    = substr_replace($orderid, '', -$idlen).$id;
                            $udata['orderid'] = $orderid;
                            $this->pos_model->update_order($udata,$id);
                        }
            
                        $OrderTransArray['order_id'] = $id;
                        $OrderTransArray['PaymentDate'] = $orderDate;
                        $this->load->model('cash_register_model');
                        $this->cash_register_model->add_data('cash_register', $OrderTransArray);
            
                        if (@$transArray) {
                            $transArray['order_id'] = $id;
                            $transArray['PaymentDate'] = $orderDate;
                            $this->cash_register_model->add_data('cash_register', $transArray);
                        }
                        foreach ($_POST as $key => $value) {
                            $_POST[$key] = explode(',', $value);
                        }
            
                        $orderItem = [];
                        foreach ($_POST['product_id'] as $key => $value) {
                            $html="";
                            $res=$this->pos_model->product_props($value);
                             {
                                if(count($res)>0)
                                {
                                  foreach($res as $row)
                                  {
                                   $html=$html."<h6><span class='text-danger'>".$row->name." ".$row->value."</span></h6>";
                                  }
                                }
                             }
                            $orderItemTmp['inventory_id']   = $_POST['inventory_id'][$key];
                            $orderItemTmp['product_id']     = $_POST['product_id'][$key];
                            $orderItemTmp['order_id']       = $id;
                            $orderItemTmp['qty']            = $_POST['qty'][$key];
                            // $orderItemTmp['free']           = $_POST['free'][$key];
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
                            $orderItemTmp['item_props_value']=$html;
                            $orderItemTmp['flat_discount'] = $flat_value;
                            $orderItemTmp['flat_discount_type'] = $flat_type;
                            $orderItem[] = $orderItemTmp;
                            unset($orderItemTmp);
            
                        }
            
                        if($this->db->insert_batch('pos_order_items', $orderItem)){
                            foreach ($_POST['product_id'] as $key => $value) {
                                $inventryCond['id']         = $_POST['inventory_id'][$key];
                                $inventryCond['product_id'] = $_POST['product_id'][$key];
                                $inventryCond['shop_id'] = $shop_id;
                                $qty = $_POST['qty'][$key];
                                $qty = (int)$qty;
                                $this->pos_model->update_inventry($inventryCond,$qty);
                            }
                        }
                      }  
                }
                
                echo json_encode($responce);
          break;
          case 'save_order_edit':
                $responce['res'] = 'error';
                $responce['msg'] = 'Not Saved!';
                $shop_id = $user->id;
                $oid=  $_POST['oid'];
                if(!empty($oid)){
                    $orderData['payment_method']         = $_POST['payment_method'];
                    $orderData['reference_no_or_remark'] = $_POST['ref_no_or_remark'];
                
                    $transArray = array(
                        'customer_id'       => $_POST['user_id'],
                        'dr'                => $_POST['total_value'],
                        'order_id'          => '',
                        'reference_no'      => $_POST['ref_no_or_remark'],
                        'txn_type'          => 1,
                        'PaymentDate'       => '',
                        'narration'         => $this->input->post('narration'),
                        'shop_id'           => $shop_id,
                        'updated'           => '',
                        'type'              => 'Sale',
                    );
        
                $OrderTransArray = array(
                        'customer_id'       => $_POST['user_id'],
                        'dr'                => $_POST['total_value'],
                        'order_id'          => '',
                        'reference_no'      => $_POST['ref_no_or_remark'],
                        'txn_type'          => 3,
                        'PaymentDate'       => '',
                        'narration'         => $this->input->post('narration'),
                        'shop_id'           => $shop_id,
                        'updated'           => '',
                        'type'              => 'Sale',
                    );
        
                $orderData['same_as_billing'] = $_POST['same_as_billing'];
                if (@$_POST['same_as_billing']==1) {
                    $orderData['shipping_address'] = null;
                }
                else{
                    $orderData['shipping_address'] = $_POST['shipping_address'];
                }
                $shop_state = $this->shops_model->get_shop_data($shop_id)->state;
                $cus_state = $this->shops_vendor_model->customers($_POST['user_id'])->state;
                $igst = ($shop_state==$cus_state) ? 0 : 1;
                
                if ($_POST['orderId']!='') {
                    $orderid = $_POST['orderId'];
                    if (!$this->pos_orders_model->check_order_id_new($oid)) {
                        $responce['res'] = 'error';
                        $responce['msg'] = 'Order Number not available!';
                        echo json_encode($responce);
                        die();

                    }
                }
        
                $orderDate = (@$_POST['order_date']) ? $_POST['order_date'] : date('Y-m-d');
                
                $orderData['orderid']                   = $orderid;
                $orderData['shop_id']                   = $shop_id;
                $orderData['user_id']                   = $_POST['user_id'];
                $orderData['invoice_no']                = NULL;
                $orderData['datetime']                  = $orderDate;
                $orderData['payment_mode']              = $_POST['payment_method'];
                $orderData['status']                    = 17;
                $orderData['total_value']               = $_POST['total_value'];
                $orderData['tax']                       = $_POST['total_tax'];
                $orderData['round_off']                 = $_POST['RoundOff'];
                $orderData['total_savings']             = '';
                $orderData['remark']                    = NULL;
                $orderData['added']                     = date('Y-m-d H:s:i');
                $orderData['payment_transaction_code']  = NULL;
                $orderData['address_id']                = NULL;
                $orderData['random_address']            = $_POST['random_address'];
                $orderData['timeslot_starttime']        = NULL;
                $orderData['timeslot_endtime']          = NULL;
                $orderData['time_slot_id']              = NULL;
                $orderData['razorpay_order_id']         = NULL;
                $orderData['razorpay_payment_id']       = NULL;
                $orderData['razorpay_signature']        = NULL;
                $orderData['booking_name']              = NULL;
                $orderData['booking_contact']           = NULL;
                $orderData['bank_name']                 = NULL;
                $orderData['is_igst']                   = $igst;
                $orderData['cancellation_reason_id']    = NULL;
                $orderData['cancellation_comment']      = NULL;
                $orderData['narration']                 = $this->input->post('narration');
                $orderData['reference_no_or_remark']    = $this->input->post('ref_no_or_remark');
                $orderData['due_amount']    = $this->input->post('due_amount');
                $orderData['tendered_amount']    = $this->input->post('tendered_amount');
                $orderData['change_amount']    = $this->input->post('change_amount');
                $orderData['order_type']    = $this->input->post('orderType');
                if ($this->pos_model->update_order($orderData,$oid)) {
                $id = $oid;
                $this->db->where('order_id', $id)->delete('pos_order_payments');
                $payment = [
                    'order_id'              => $id,
                    'amount'                => $_POST['total_value'],
                    'payment_mode'           =>$_POST['payment_method'],
                ];
                
                if ($this->check_existing_payment($id,$_POST['payment_method'])) {
                    $this->db->where('order_id', $id);
                    $this->db->where('payment_mode',$_POST['payment_method']);
                    $this->db->update('pos_order_payments', $payment);
                } else {
                    $this->db->insert('pos_order_payments', $payment);
                }
                //  Insert Coupon 
                if($this->input->post('coupon_net_amount') > 0){
                $coupon = array(
                'order_id'=>$id,
                'order_type'=>'1',
                'coupon_type'=>'2',
                'coupon_value_type'=>$this->input->post('coupon_type'),
                'coupon_value'=>$this->input->post('coupon_value'),
                'amount'=>$this->input->post('coupon_net_amount'),
                'discount_amount'=>$this->input->post('coupon_discount_amount'),
                );
                    $this->db->where('order_id', $id);
                    $this->db->where('order_type', '1');
                    $query = $this->db->get('order_coupons');

                    if ($query->num_rows() > 0) {
                        $this->db->where('order_id', $id);
                        $this->db->where('order_type', '1');
                        $this->db->update('order_coupons', $coupon);
                    } else {
                        $this->db->insert('order_coupons', $coupon);
                }
            }
                    $flat_value=$this->input->post('flat_value');
                    $flat_type=$this->input->post('flat_type');

                        $responce['res'] = 'success';
                        $responce['msg'] = 'Saved!';
                        $responce['invoice_url'] = base_url('pos_orders/print/bill/'.$id);
                        $responce['new_order'] = base_url('shop-pos');
            
                      
            
                        $OrderTransArray['order_id'] = $id;
                        $OrderTransArray['PaymentDate'] = $orderDate;
                        $this->load->model('cash_register_model');
                        $this->cash_register_model->updateCash('cash_register', $OrderTransArray, $id);
                        
                        if (@$transArray) {
                            $transArray['order_id'] = $id;
                            $transArray['PaymentDate'] = $orderDate;
                            $this->cash_register_model->updateCash('cash_register', $transArray, $id);
                        }
                        
                        foreach ($_POST as $key => $value) {
                            $_POST[$key] = explode(',', $value);
                        }
            
                        foreach ($_POST['product_id'] as $key => $value) {
                            $html = "";
                            $res = $this->pos_model->product_props($value);
                            if (count($res) > 0) {
                                foreach ($res as $row) {
                                    $html = $html."<h6><span class='text-danger'>".$row->name." ".$row->value."</span></h6>";
                                }
                            }
                        
                            $orderItemTmp = [
                                'inventory_id'        => $_POST['inventory_id'][$key],
                                'product_id'          => $_POST['product_id'][$key],
                                'order_id'            => $id,
                                'qty'                 => $_POST['qty'][$key],
                                'price_per_unit'      => $_POST['price_per_unit'][$key],
                                'purchase_rate'       => $_POST['purchase_rate'][$key],
                                'mrp'                 => $_POST['mrp'][$key],
                                'total_price'         => $_POST['total_price'][$key],
                                'tax'                 => $_POST['tax'][$key],
                                'tax_value'           => $_POST['tax_value'][$key],
                                'offer_applied'       => $_POST['offer_applied'][$key],
                                'discount_type'       => $_POST['discount_type'][$key],
                                'offer_applied2'      => $_POST['offer_applied2'][$key],
                                'discount_type2'      => $_POST['discount_type2'][$key],
                                'item_props_value'    => $html,
                                'flat_discount'       => $flat_value,
                                'flat_discount_type'  => $flat_type,
                            ];
                        
                            $existingProduct = $this->db->get_where('pos_order_items', [
                                'order_id'   => $id,
                                'product_id' => $_POST['product_id'][$key],
                            ])->row_array();
                        
                            if ($existingProduct) {
                                $this->db->where([
                                    'order_id'   => $id,
                                    'product_id' => $_POST['product_id'][$key],
                                ]);
                                $this->db->update('pos_order_items', $orderItemTmp);
                                $inventryCond = [
                                    'id'         => $_POST['inventory_id'][$key],
                                    'product_id' => $_POST['product_id'][$key],
                                    'shop_id' => $shop_id,
                                ];
                                $qty = (int)$_POST['qty'][$key];
                                $exist_qty=$existingProduct['qty'];
                                $this->pos_model->update_inventry_edit($inventryCond, $qty,$exist_qty);
                            } else {
                                $this->db->insert('pos_order_items', $orderItemTmp);
                                $inventryCond = [
                                    'id'         => $_POST['inventory_id'][$key],
                                    'product_id' => $_POST['product_id'][$key],
                                    'shop_id' => $shop_id,
                                ];
                                $qty = (int)$_POST['qty'][$key];
                                $this->pos_model->update_inventry($inventryCond, $qty);
                            }
                        
                          
                        }
                        
                    }  
                }else{
                    $responce['res'] = 'error';
                    $responce['msg'] = 'Sorry order updation failed!';
                }
                echo json_encode($responce);
          break;
          case 'holdbillBill':
            $responce['res'] = 'error';
            $responce['msg'] = 'Not Saved!';
            $orderid    = strtoupper('HOLD'.date('M').'00000');
            $shop_id = $user->id;
                $orderData['payment_method']         = $_POST['payment_method'];
                $orderData['reference_no_or_remark'] = $_POST['ref_no_or_remark'];
             
                $transArray = array(
                    'customer_id'       => $_POST['user_id'],
                    'dr'                => $_POST['total_value'],
                    'order_id'          => '',
                    'reference_no'      => $_POST['ref_no_or_remark'],
                    'txn_type'          => 1,
                    'PaymentDate'       => '',
                    'narration'         => $this->input->post('narration'),
                    'shop_id'           => $shop_id,
                    'updated'           => '',
                    'type'              => 'Sale',
                );
                
            $OrderTransArray = array(
                    'customer_id'       => $_POST['user_id'],
                    'dr'                => $_POST['total_value'],
                    'order_id'          => '',
                    'reference_no'      => $_POST['ref_no_or_remark'],
                    'txn_type'          => 3,
                    'PaymentDate'       => '',
                    'narration'         => $this->input->post('narration'),
                    'shop_id'           => $shop_id,
                    'updated'           => '',
                    'type'              => 'Sale',
                );
    
            $orderData['same_as_billing'] = $_POST['same_as_billing'];
            if (@$_POST['same_as_billing']==1) {
                $orderData['shipping_address'] = null;
            }
            else{
                $orderData['shipping_address'] = $_POST['shipping_address'];
            }
    
            $shop_state = $this->shops_model->get_shop_data($shop_id)->state;
            $cus_state = $this->shops_vendor_model->customers($_POST['user_id'])->state;
            $igst = ($shop_state==$cus_state) ? 0 : 1;
    
            if ($_POST['orderId']!='') {
                $orderid = $_POST['orderId'];
                if (!$this->pos_orders_model->check_order_id()) {
                    $responce['res'] = 'error';
                    $responce['msg'] = 'Order Number not available!';
                    echo json_encode($responce);
                    die();
                }
            }
            $orderDate = (@$_POST['order_date']) ? $_POST['order_date'] : date('Y-m-d');
            $orderData['orderid']                   = $orderid;
            $orderData['shop_id']                   = $shop_id;
            $orderData['user_id']                   = $_POST['user_id'];
            $orderData['invoice_no']                = NULL;
            $orderData['datetime']                  = $orderDate;
            $orderData['payment_mode']              = $_POST['payment_method'];
            $orderData['status']                    = 21;
            $orderData['total_value']               = $_POST['total_value'];
            $orderData['tax']                       = $_POST['total_tax'];
            $orderData['round_off']                 = $_POST['RoundOff'];
            $orderData['total_savings']             = '';
            $orderData['remark']                    = NULL;
            $orderData['added']                     = date('Y-m-d H:s:i');
            $orderData['payment_transaction_code']  = NULL;
            $orderData['address_id']                = NULL;
            $orderData['random_address']            = $_POST['random_address'];
            $orderData['timeslot_starttime']        = NULL;
            $orderData['timeslot_endtime']          = NULL;
            $orderData['time_slot_id']              = NULL;
            $orderData['razorpay_order_id']         = NULL;
            $orderData['razorpay_payment_id']       = NULL;
            $orderData['razorpay_signature']        = NULL;
            $orderData['booking_name']              = NULL;
            $orderData['booking_contact']           = NULL;
            $orderData['bank_name']                 = NULL;
            $orderData['is_igst']                   = $igst;
            $orderData['cancellation_reason_id']    = NULL;
            $orderData['cancellation_comment']      = NULL;
            $orderData['narration']                 = $this->input->post('narration');
            $orderData['reference_no_or_remark']    = $this->input->post('ref_no_or_remark');
            $orderData['due_amount']    = $this->input->post('due_amount');
            $orderData['tendered_amount']    = $this->input->post('tendered_amount');
            $orderData['change_amount']    = $this->input->post('change_amount');
            $orderData['order_type']    = $this->input->post('orderType');

            if ($id = $this->pos_model->save_order($orderData)) {
    
                //  Insert Coupon 
                if($this->input->post('coupon_net_amount') > 0){
                $coupon = array(
                   'order_id'=>$id,
                   'order_type'=>'1',
                   'coupon_type'=>'2',
                   'coupon_value_type'=>$this->input->post('coupon_type'),
                   'coupon_value'=>$this->input->post('coupon_value'),
                   'amount'=>$this->input->post('coupon_net_amount'),
                   'discount_amount'=>$this->input->post('coupon_discount_amount'),
                );
               $this->db->insert('order_coupons',$coupon);
            }

            $flat_value=$this->input->post('flat_value');
            $flat_type=$this->input->post('flat_type');
               

                $responce['res'] = 'success';
                $responce['msg'] = 'Saved!';
                $responce['invoice_url'] = base_url('pos_orders/print/holdbill/'.$id);
                $responce['new_order'] = base_url('shop-pos');
    
                if (@$_POST['orderId']=='') {
                    $idlen  = strlen($id);
                    $orderid    = substr_replace($orderid, '', -$idlen).$id;
                    $udata['orderid'] = $orderid;
                    $this->pos_model->update_order($udata,$id);
                }
    
                $OrderTransArray['order_id'] = $id;
                $OrderTransArray['PaymentDate'] = $orderDate;
                $this->load->model('cash_register_model');
                $this->cash_register_model->add_data('cash_register', $OrderTransArray);
    
                if (@$transArray) {
                    $transArray['order_id'] = $id;
                    $transArray['PaymentDate'] = $orderDate;
                    $this->cash_register_model->add_data('cash_register', $transArray);
                }
                
                foreach ($_POST as $key => $value) {
                    $_POST[$key] = explode(',', $value);
                }
    
                $orderItem = [];
                foreach ($_POST['product_id'] as $key => $value) {
                    $html="";
                    $res=$this->pos_model->product_props($value);
                     {
                        if(count($res)>0)
                        {
                          foreach($res as $row)
                          {
                           $html=$html."<h6><span class='text-danger'>".$row->name." ".$row->value."</span></h6>";
                          }
                        }
                     }
                    $orderItemTmp['inventory_id']   = $_POST['inventory_id'][$key];
                    $orderItemTmp['product_id']     = $_POST['product_id'][$key];
                    $orderItemTmp['order_id']       = $id;
                    $orderItemTmp['qty']            = $_POST['qty'][$key];
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
                    $orderItemTmp['item_props_value']=$html;
                    $orderItemTmp['flat_discount'] = $flat_value;
                    $orderItemTmp['flat_discount_type'] = $flat_type;
                    $orderItem[] = $orderItemTmp;
                    unset($orderItemTmp);
    
                }
    
                if($this->db->insert_batch('pos_order_items', $orderItem)){
                    foreach ($_POST['product_id'] as $key => $value) {
                        $inventryCond['id']         = $_POST['inventory_id'][$key];
                        $inventryCond['product_id'] = $_POST['product_id'][$key];
                        $qty = $_POST['qty'][$key];
                        $qty = (int)$qty;
                        if (@$_POST['free'][$key]) {
                            $qty = $qty + (int)$_POST['free'][$key];
                        }
                        // $this->pos_model->update_inventry($inventryCond,$qty);
                    }
                }
    
            }
            echo json_encode($responce);
          break;
          case 'save_card_order':
                $responce['res'] = 'error';
                $responce['msg'] = 'Not Saved!'
                ;
                $shop_id = $user->id;
                $is_hold = $_POST['is_hold'];
                    $orderData['payment_method']         = $_POST['payment_method'];
                    $orderData['reference_no_or_remark'] = $_POST['ref_no_or_remark'];
                
                    $transArray = array(
                        'customer_id'       => $_POST['user_id'],
                        'dr'                => $_POST['total_value'],
                        'order_id'          => '',
                        'reference_no'      => $_POST['ref_no_or_remark'],
                        'txn_type'          => 1,
                        'PaymentDate'       => '',
                        'narration'         => $this->input->post('narration'),
                        'shop_id'           => $shop_id,
                        'updated'           => '',
                        'type'              => 'Sale',
                    );
        
                $OrderTransArray = array(
                        'customer_id'       => $_POST['user_id'],
                        'dr'                => $_POST['total_value'],
                        'order_id'          => '',
                        'reference_no'      => $_POST['ref_no_or_remark'],
                        'txn_type'          => 3,
                        'PaymentDate'       => '',
                        'narration'         => $this->input->post('narration'),
                        'shop_id'           => $shop_id,
                        'updated'           => '',
                        'type'              => 'Sale',
                    );
        
                $orderData['same_as_billing'] = $_POST['same_as_billing'];
                if (@$_POST['same_as_billing']==1) {
                    $orderData['shipping_address'] = null;
                }
                else{
                    $orderData['shipping_address'] = $_POST['shipping_address'];
                }
                $shop_state = $this->shops_model->get_shop_data($shop_id)->state;
                $cus_state = $this->shops_vendor_model->customers($_POST['user_id'])->state;
                $igst = ($shop_state==$cus_state) ? 0 : 1;
                
                $orderid    = strtoupper('CK'.date('M').'00000');
                if ($_POST['orderId']!='') {
                    $orderid = $_POST['orderId'];
                    if (!$this->pos_orders_model->check_order_id()) {
                        $responce['res'] = 'error';
                        $responce['msg'] = 'Order Number not available!';
                        echo json_encode($responce);
                        die();

                    }
                }
        
                $orderDate = (@$_POST['order_date']) ? $_POST['order_date'] : date('Y-m-d');
                
                $orderData['orderid']                   = $orderid;
                $orderData['shop_id']                   = $shop_id;
                $orderData['user_id']                   = $_POST['user_id'];
                $orderData['invoice_no']                = NULL;
                $orderData['datetime']                  = $orderDate;
                $orderData['payment_mode']              = $_POST['payment_method'];
                $orderData['status']                    = 17;
                $orderData['total_value']               = $_POST['total_value'];
                $orderData['tax']                       = $_POST['total_tax'];
                $orderData['round_off']                 = $_POST['RoundOff'];
                $orderData['total_savings']             = '';
                $orderData['remark']                    = NULL;
                $orderData['added']                     = date('Y-m-d H:s:i');
                $orderData['payment_transaction_code']  = NULL;
                $orderData['address_id']                = NULL;
                $orderData['random_address']            = $_POST['random_address'];
                $orderData['timeslot_starttime']        = NULL;
                $orderData['timeslot_endtime']          = NULL;
                $orderData['time_slot_id']              = NULL;
                $orderData['razorpay_order_id']         = NULL;
                $orderData['razorpay_payment_id']       = NULL;
                $orderData['razorpay_signature']        = NULL;
                $orderData['booking_name']              = NULL;
                $orderData['booking_contact']           = NULL;
                $orderData['bank_name']                 = NULL;
                $orderData['is_igst']                   = $igst;
                $orderData['cancellation_reason_id']    = NULL;
                $orderData['cancellation_comment']      = NULL;
                $orderData['narration']                 = $this->input->post('narration');
                $orderData['reference_no_or_remark']    = $this->input->post('ref_no_or_remark');
                $orderData['due_amount']    = $this->input->post('due_amount');
                $orderData['tendered_amount']    = $this->input->post('tendered_amount');
                $orderData['change_amount']    = $this->input->post('change_amount');
                $orderData['order_type']    = $this->input->post('orderType');
               
                if ($id = $this->pos_model->save_order($orderData)) {
                // Insertion of payments
                $cashAmount = $_POST['total_value'] - $this->input->post('CardAmount');
                $payment = [
                    'order_id'                => $id,
                    'bank_id'                 => $this->input->post('BankId'),
                    'customer_bank_name'      => $this->input->post('CardBank'),
                    'card_holder_name'        => $this->input->post('CardHolder'),
                    'card_tr_no'              => $this->input->post('TrNo')
                ];

                if ($_POST['total_value'] == $this->input->post('CardAmount')) {
                    $payment['amount'] = $this->input->post('CardAmount');
                    $payment['payment_mode'] = $_POST['payment_method'];
                    $payment['card_payment_amount'] = $this->input->post('CardAmount');
                    $this->db->insert('pos_order_payments', $payment);
                } elseif ($_POST['total_value'] > $this->input->post('CardAmount')) {
                    $payment['amount'] = $this->input->post('CardAmount');
                    $payment['payment_mode'] = $_POST['payment_method'];
                    $payment['card_payment_amount'] = $this->input->post('CardAmount');
                    $this->db->insert('pos_order_payments', $payment);

                    $cashPayment = $payment; 
                    $cashPayment['amount'] = $cashAmount; 
                    $cashPayment['payment_mode'] = '1';
                    $cashPayment['card_payment_amount'] = 0; 
                    $this->db->insert('pos_order_payments', $cashPayment);
                }

               
                //  Insert Coupon 
                if($this->input->post('coupon_net_amount') > 0){
                $coupon = array(
                'order_id'=>$id,
                'order_type'=>'1',
                'coupon_type'=>'2',
                'coupon_value_type'=>$this->input->post('coupon_type'),
                'coupon_value'=>$this->input->post('coupon_value'),
                'amount'=>$this->input->post('coupon_net_amount'),
                'discount_amount'=>$this->input->post('coupon_discount_amount'),
                );
                $this->db->insert('order_coupons',$coupon);
            }
            $flat_value=$this->input->post('flat_value');
            $flat_type=$this->input->post('flat_type');

                    $responce['res'] = 'success';
                    $responce['msg'] = 'Saved!';
                    $responce['invoice_url'] = base_url('pos_orders/print/bill/'.$id);
                    $responce['new_order'] = base_url('shop-pos');
        
                    if(@$_POST['orderId']=='') {
                        $idlen  = strlen($id);
                        $orderid    = substr_replace($orderid, '', -$idlen).$id;
                        $udata['orderid'] = $orderid;
                        $this->pos_model->update_order($udata,$id);
                    }
        
                    $OrderTransArray['order_id'] = $id;
                    $OrderTransArray['PaymentDate'] = $orderDate;
                    $this->load->model('cash_register_model');
                    $this->cash_register_model->add_data('cash_register', $OrderTransArray);
        
                    if (@$transArray) {
                        $transArray['order_id'] = $id;
                        $transArray['PaymentDate'] = $orderDate;
                        $this->cash_register_model->add_data('cash_register', $transArray);
                    }
                    
                    foreach ($_POST as $key => $value) {
                        $_POST[$key] = explode(',', $value);
                    }
        
                    $orderItem = [];
                    foreach ($_POST['product_id'] as $key => $value) {
                        $html="";
                        $res=$this->pos_model->product_props($value);
                         {
                            if(count($res)>0)
                            {
                              foreach($res as $row)
                              {
                               $html=$html."<h6><span class='text-danger'>".$row->name." ".$row->value."</span></h6>";
                              }
                            }
                         }
                        $orderItemTmp['inventory_id']   = $_POST['inventory_id'][$key];
                        $orderItemTmp['product_id']     = $_POST['product_id'][$key];
                        $orderItemTmp['order_id']       = $id;
                        $orderItemTmp['qty']            = $_POST['qty'][$key];
                        // $orderItemTmp['free']           = $_POST['free'][$key];
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
                        $orderItemTmp['item_props_value']=$html;
                        $orderItemTmp['flat_discount'] = $flat_value;
                        $orderItemTmp['flat_discount_type'] = $flat_type;
                        $orderItem[] = $orderItemTmp;
                        unset($orderItemTmp);
        
                    }
        
                    if($this->db->insert_batch('pos_order_items', $orderItem)){
                        foreach ($_POST['product_id'] as $key => $value) {
                            $inventryCond['id']         = $_POST['inventory_id'][$key];
                            $inventryCond['product_id'] = $_POST['product_id'][$key];
                            $inventryCond['shop_id'] = $shop_id;
                            $qty = $_POST['qty'][$key];
                            $qty = (int)$qty;
                            $this->pos_model->update_inventry($inventryCond,$qty);
                        }
                    }
                  }  
               echo json_encode($responce);
            break;
            case 'save_card_order_edit':
                $responce['res'] = 'error';
                $responce['msg'] = 'Not Saved!';
                $shop_id = $user->id;
                $oid   = $_POST['oid'];
                    $orderData['payment_method']         = $_POST['payment_method'];
                    $orderData['reference_no_or_remark'] = $_POST['ref_no_or_remark'];
                
                    $transArray = array(
                        'customer_id'       => $_POST['user_id'],
                        'dr'                => $_POST['total_value'],
                        'order_id'          => '',
                        'reference_no'      => $_POST['ref_no_or_remark'],
                        'txn_type'          => 1,
                        'PaymentDate'       => '',
                        'narration'         => $this->input->post('narration'),
                        'shop_id'           => $shop_id,
                        'updated'           => '',
                        'type'              => 'Sale',
                    );
        
                $OrderTransArray = array(
                        'customer_id'       => $_POST['user_id'],
                        'dr'                => $_POST['total_value'],
                        'order_id'          => '',
                        'reference_no'      => $_POST['ref_no_or_remark'],
                        'txn_type'          => 3,
                        'PaymentDate'       => '',
                        'narration'         => $this->input->post('narration'),
                        'shop_id'           => $shop_id,
                        'updated'           => '',
                        'type'              => 'Sale',
                    );
        
                $orderData['same_as_billing'] = $_POST['same_as_billing'];
                if (@$_POST['same_as_billing']==1) {
                    $orderData['shipping_address'] = null;
                }
                else{
                    $orderData['shipping_address'] = $_POST['shipping_address'];
                }
                $shop_state = $this->shops_model->get_shop_data($shop_id)->state;
                $cus_state = $this->shops_vendor_model->customers($_POST['user_id'])->state;
                $igst = ($shop_state==$cus_state) ? 0 : 1;
                
                if ($_POST['orderId']!='') {
                    $orderid = $_POST['orderId'];
                    if (!$this->pos_orders_model->check_order_id_new($oid)) {
                        $responce['res'] = 'error';
                        $responce['msg'] = 'Order Number not available!';
                        echo json_encode($responce);
                        die();

                    }
                }
        
                $orderDate = (@$_POST['order_date']) ? $_POST['order_date'] : date('Y-m-d');
                
                $orderData['orderid']                   = $orderid;
                $orderData['shop_id']                   = $shop_id;
                $orderData['user_id']                   = $_POST['user_id'];
                $orderData['invoice_no']                = NULL;
                $orderData['datetime']                  = $orderDate;
                $orderData['payment_mode']              = $_POST['payment_method'];
                $orderData['status']                    = 17;
                $orderData['total_value']               = $_POST['total_value'];
                $orderData['tax']                       = $_POST['total_tax'];
                $orderData['round_off']                 = $_POST['RoundOff'];
                $orderData['total_savings']             = '';
                $orderData['remark']                    = NULL;
                $orderData['added']                     = date('Y-m-d H:s:i');
                $orderData['payment_transaction_code']  = NULL;
                $orderData['address_id']                = NULL;
                $orderData['random_address']            = $_POST['random_address'];
                $orderData['timeslot_starttime']        = NULL;
                $orderData['timeslot_endtime']          = NULL;
                $orderData['time_slot_id']              = NULL;
                $orderData['razorpay_order_id']         = NULL;
                $orderData['razorpay_payment_id']       = NULL;
                $orderData['razorpay_signature']        = NULL;
                $orderData['booking_name']              = NULL;
                $orderData['booking_contact']           = NULL;
                $orderData['bank_name']                 = NULL;
                $orderData['is_igst']                   = $igst;
                $orderData['cancellation_reason_id']    = NULL;
                $orderData['cancellation_comment']      = NULL;
                $orderData['narration']                 = $this->input->post('narration');
                $orderData['reference_no_or_remark']    = $this->input->post('ref_no_or_remark');
                $orderData['due_amount']    = $this->input->post('due_amount');
                $orderData['tendered_amount']    = $this->input->post('tendered_amount');
                $orderData['change_amount']    = $this->input->post('change_amount');
                $orderData['order_type']    = $this->input->post('orderType');
               
                if ($this->pos_model->update_order($orderData,$oid)) {
                    $id = $oid;
                    $this->db->where('order_id', $id)->delete('pos_order_payments');
                // Insertion of payments
                $cashAmount = $_POST['total_value'] - $this->input->post('CardAmount');
                $payment = [
                    'order_id'                => $id,
                    'bank_id'                 => $this->input->post('BankId'),
                    'customer_bank_name'      => $this->input->post('CardBank'),
                    'card_holder_name'        => $this->input->post('CardHolder'),
                    'card_tr_no'              => $this->input->post('TrNo')
                ];
                
                if ($_POST['total_value'] == $this->input->post('CardAmount')) {
                    $payment['amount'] = $this->input->post('CardAmount');
                    $payment['payment_mode'] = $_POST['payment_method'];
                    $payment['card_payment_amount'] = $this->input->post('CardAmount');
                    
                    if ($this->check_existing_payment($id, $_POST['payment_method'])) {
                        $this->db->where('order_id', $id);
                        $this->db->where('payment_mode', $_POST['payment_method']);
                        $this->db->update('pos_order_payments', $payment);
                    } else {
                        $this->db->insert('pos_order_payments', $payment);
                    }
                } elseif ($_POST['total_value'] > $this->input->post('CardAmount')) {
                    $payment['amount'] = $this->input->post('CardAmount');
                    $payment['payment_mode'] = $_POST['payment_method'];
                    $payment['card_payment_amount'] = $this->input->post('CardAmount');
                    
                    if ($this->check_existing_payment($id, $_POST['payment_method'])) {
                        $this->db->where('order_id', $id);
                        $this->db->where('payment_mode', $_POST['payment_method']);
                        $this->db->update('pos_order_payments', $payment);
                    } else {
                        $this->db->insert('pos_order_payments', $payment);
                    }
                
                    $cashPayment = $payment; 
                    $cashPayment['amount'] = $cashAmount; 
                    $cashPayment['payment_mode'] = '1';
                    $cashPayment['card_payment_amount'] = 0; 
                    
                    if ($this->check_existing_payment($id, '1')) {
                        $this->db->where('order_id', $id);
                        $this->db->where('payment_mode', '1');
                        $this->db->update('pos_order_payments', $cashPayment);
                    } else {
                        $this->db->insert('pos_order_payments', $cashPayment);
                    }
                }
                

                //  Insert Coupon
                $this->db->where(['order_id'=>$id,'order_type'=>'1'])->delete('order_coupons'); 
                if($this->input->post('coupon_net_amount') > 0){
                  
                    $coupon = array(
                    'order_id'=>$id,
                    'order_type'=>'1',
                    'coupon_type'=>'2',
                    'coupon_value_type'=>$this->input->post('coupon_type'),
                    'coupon_value'=>$this->input->post('coupon_value'),
                    'amount'=>$this->input->post('coupon_net_amount'),
                    'discount_amount'=>$this->input->post('coupon_discount_amount'),
                    );
                    $this->db->where('order_id', $id);
                    $this->db->where('order_type', '1');
                    $query = $this->db->get('order_coupons');

                    if ($query->num_rows() > 0) {
                        $this->db->where('order_id', $id);
                        $this->db->where('order_type', '1');
                        $this->db->update('order_coupons', $coupon);
                    } else {
                        $this->db->insert('order_coupons', $coupon);
                }
                }
                        $flat_value=$this->input->post('flat_value');
                        $flat_type=$this->input->post('flat_type');
    
                            $responce['res'] = 'success';
                            $responce['msg'] = 'Saved!';
                            $responce['invoice_url'] = base_url('pos_orders/print/bill/'.$id);
                            $responce['new_order'] = base_url('shop-pos');
                
                          
                
                            $OrderTransArray['order_id'] = $id;
                            $OrderTransArray['PaymentDate'] = $orderDate;
                            $this->load->model('cash_register_model');
                            $this->cash_register_model->updateCash('cash_register', $OrderTransArray, $id);
                            
                            if (@$transArray) {
                                $transArray['order_id'] = $id;
                                $transArray['PaymentDate'] = $orderDate;
                                $this->cash_register_model->updateCash('cash_register', $transArray, $id);
                            }
                            
                            foreach ($_POST as $key => $value) {
                                $_POST[$key] = explode(',', $value);
                            }
                
                            foreach ($_POST['product_id'] as $key => $value) {
                                $html = "";
                                $res = $this->pos_model->product_props($value);
                                if (count($res) > 0) {
                                    foreach ($res as $row) {
                                        $html = $html."<h6><span class='text-danger'>".$row->name." ".$row->value."</span></h6>";
                                    }
                                }
                            
                                $orderItemTmp = [
                                    'inventory_id'        => $_POST['inventory_id'][$key],
                                    'product_id'          => $_POST['product_id'][$key],
                                    'order_id'            => $id,
                                    'qty'                 => $_POST['qty'][$key],
                                    'price_per_unit'      => $_POST['price_per_unit'][$key],
                                    'purchase_rate'       => $_POST['purchase_rate'][$key],
                                    'mrp'                 => $_POST['mrp'][$key],
                                    'total_price'         => $_POST['total_price'][$key],
                                    'tax'                 => $_POST['tax'][$key],
                                    'tax_value'           => $_POST['tax_value'][$key],
                                    'offer_applied'       => $_POST['offer_applied'][$key],
                                    'discount_type'       => $_POST['discount_type'][$key],
                                    'offer_applied2'      => $_POST['offer_applied2'][$key],
                                    'discount_type2'      => $_POST['discount_type2'][$key],
                                    'item_props_value'    => $html,
                                    'flat_discount'       => $flat_value,
                                    'flat_discount_type'  => $flat_type,
                                ];
                            
                                $existingProduct = $this->db->get_where('pos_order_items', [
                                    'order_id'   => $id,
                                    'product_id' => $_POST['product_id'][$key],
                                ])->row_array();
                            
                                if ($existingProduct) {
                                    $this->db->where([
                                        'order_id'   => $id,
                                        'product_id' => $_POST['product_id'][$key],
                                    ]);
                                    $this->db->update('pos_order_items', $orderItemTmp);
                                    $inventryCond = [
                                        'id'         => $_POST['inventory_id'][$key],
                                        'product_id' => $_POST['product_id'][$key],
                                        'shop_id' => $shop_id,
                                    ];
                                    $qty = (int)$_POST['qty'][$key];
                                    $exist_qty=$existingProduct['qty'];
                                    $this->pos_model->update_inventry_edit($inventryCond, $qty,$exist_qty);
                                } else {
                                    $this->db->insert('pos_order_items', $orderItemTmp);
                                    $inventryCond = [
                                        'id'         => $_POST['inventory_id'][$key],
                                        'product_id' => $_POST['product_id'][$key],
                                        'shop_id' => $shop_id,
                                    ];
                                    $qty = (int)$_POST['qty'][$key];
                                    $this->pos_model->update_inventry($inventryCond, $qty);
                                }
                            
                              
                      }
                  }  
               echo json_encode($responce);
             break;   
            case 'save_upi_order':
                $responce['res'] = 'error';
                $responce['msg'] = 'Not Saved!';
                $shop_id = $user->id;
                if ($_POST['upi_account_id']) {
                    $orderData['payment_method']         = $_POST['payment_method'];
                    $orderData['reference_no_or_remark'] = $_POST['ref_no_or_remark'];
                
                    $transArray = array(
                        'customer_id'       => $_POST['user_id'],
                        'dr'                => $_POST['total_value'],
                        'order_id'          => '',
                        'reference_no'      => $_POST['ref_no_or_remark'],
                        'txn_type'          => 1,
                        'PaymentDate'       => '',
                        'narration'         => $this->input->post('narration'),
                        'shop_id'           => $shop_id,
                        'updated'           => '',
                        'type'              => 'Sale',
                    );
                    
        
                $OrderTransArray = array(
                        'customer_id'       => $_POST['user_id'],
                        'dr'                => $_POST['total_value'],
                        'order_id'          => '',
                        'reference_no'      => $_POST['ref_no_or_remark'],
                        'txn_type'          => 3,
                        'PaymentDate'       => '',
                        'narration'         => $this->input->post('narration'),
                        'shop_id'           => $shop_id,
                        'updated'           => '',
                        'type'              => 'Sale',
                    );
        
                $orderData['same_as_billing'] = $_POST['same_as_billing'];
                if (@$_POST['same_as_billing']==1) {
                    $orderData['shipping_address'] = null;
                }
                else{
                    $orderData['shipping_address'] = $_POST['shipping_address'];
                }
                $shop_state = $this->shops_model->get_shop_data($shop_id)->state;
                $cus_state = $this->shops_vendor_model->customers($_POST['user_id'])->state;
                $igst = ($shop_state==$cus_state) ? 0 : 1;
                
                $orderid    = strtoupper('CK'.date('M').'00000');
                if ($_POST['orderId']!='') {
                    $orderid = $_POST['orderId'];
                    if (!$this->pos_orders_model->check_order_id()) {
                        $responce['res'] = 'error';
                        $responce['msg'] = 'Order Number not available!';
                        echo json_encode($responce);
                        die();

                    }
                }
        
                $orderDate = (@$_POST['order_date']) ? $_POST['order_date'] : date('Y-m-d');
                
                $orderData['orderid']                   = $orderid;
                $orderData['shop_id']                   = $shop_id;
                $orderData['user_id']                   = $_POST['user_id'];
                $orderData['invoice_no']                = NULL;
                $orderData['datetime']                  = $orderDate;
                $orderData['payment_mode']              = $_POST['payment_method'];
                $orderData['status']                    = 17;
                $orderData['total_value']               = $_POST['total_value'];
                $orderData['tax']                       = $_POST['total_tax'];
                $orderData['round_off']                 = $_POST['RoundOff'];
                $orderData['total_savings']             = '';
                $orderData['remark']                    = NULL;
                $orderData['added']                     = date('Y-m-d H:s:i');
                $orderData['payment_transaction_code']  = NULL;
                $orderData['address_id']                = NULL;
                $orderData['random_address']            = $_POST['random_address'];
                $orderData['timeslot_starttime']        = NULL;
                $orderData['timeslot_endtime']          = NULL;
                $orderData['time_slot_id']              = NULL;
                $orderData['razorpay_order_id']         = NULL;
                $orderData['razorpay_payment_id']       = NULL;
                $orderData['razorpay_signature']        = NULL;
                $orderData['booking_name']              = NULL;
                $orderData['booking_contact']           = NULL;
                $orderData['bank_name']                 = NULL;
                $orderData['is_igst']                   = $igst;
                $orderData['cancellation_reason_id']    = NULL;
                $orderData['cancellation_comment']      = NULL;
                $orderData['narration']                 = $this->input->post('narration');
                $orderData['reference_no_or_remark']    = $this->input->post('ref_no_or_remark');
                $orderData['due_amount']    = $this->input->post('due_amount');
                $orderData['tendered_amount']    = $this->input->post('tendered_amount');
                $orderData['change_amount']    = $this->input->post('change_amount');
                $orderData['order_type']    = $this->input->post('orderType');
               
                if ($id = $this->pos_model->save_order($orderData)) {
                // Insertion of payments
                $payment = [
                    'order_id'              => $id,
                    'amount'                => $_POST['total_value'],
                    'payment_mode'           =>$_POST['payment_method'],
                    'bank_id'                =>$_POST['upi_account_id'],
                ];
                    $this->db->insert('pos_order_payments', $payment);

               
                //  Insert Coupon 
                if($this->input->post('coupon_net_amount') > 0){
                $coupon = array(
                'order_id'=>$id,
                'order_type'=>'1',
                'coupon_type'=>'2',
                'coupon_value_type'=>$this->input->post('coupon_type'),
                'coupon_value'=>$this->input->post('coupon_value'),
                'amount'=>$this->input->post('coupon_net_amount'),
                'discount_amount'=>$this->input->post('coupon_discount_amount'),
                );
                $this->db->insert('order_coupons',$coupon);
            }
             

            $flat_value=$this->input->post('flat_value');
            $flat_type=$this->input->post('flat_type');
                    $responce['res'] = 'success';
                    $responce['msg'] = 'Saved!';
                    $responce['invoice_url'] = base_url('pos_orders/print/bill/'.$id);
                    $responce['new_order'] = base_url('shop-pos');
        
                    if(@$_POST['orderId']=='') {
                        $idlen  = strlen($id);
                        $orderid    = substr_replace($orderid, '', -$idlen).$id;
                        $udata['orderid'] = $orderid;
                        $this->pos_model->update_order($udata,$id);
                    }
        
                    $OrderTransArray['order_id'] = $id;
                    $OrderTransArray['PaymentDate'] = $orderDate;
                    $this->load->model('cash_register_model');
                    $this->cash_register_model->add_data('cash_register', $OrderTransArray);
        
                    if (@$transArray) {
                        $transArray['order_id'] = $id;
                        $transArray['PaymentDate'] = $orderDate;
                        $this->cash_register_model->add_data('cash_register', $transArray);
                    }
                    foreach ($_POST as $key => $value) {
                        $_POST[$key] = explode(',', $value);
                    }
        
                    $orderItem = [];
                    foreach ($_POST['product_id'] as $key => $value) {
                        $html="";
                        $res=$this->pos_model->product_props($value);
                         {
                            if(count($res)>0)
                            {
                              foreach($res as $row)
                              {
                               $html=$html."<h6><span class='text-danger'>".$row->name." ".$row->value."</span></h6>";
                              }
                            }
                         }
                        $orderItemTmp['inventory_id']   = $_POST['inventory_id'][$key];
                        $orderItemTmp['product_id']     = $_POST['product_id'][$key];
                        $orderItemTmp['order_id']       = $id;
                        $orderItemTmp['qty']            = $_POST['qty'][$key];
                        // $orderItemTmp['free']           = $_POST['free'][$key];
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
                        $orderItemTmp['item_props_value']=$html;
                        $orderItemTmp['flat_discount'] = $flat_value;
                        $orderItemTmp['flat_discount_type'] = $flat_type;
                        $orderItem[] = $orderItemTmp;
                        unset($orderItemTmp);
        
                    }
        
                    if($this->db->insert_batch('pos_order_items', $orderItem)){
                        foreach ($_POST['product_id'] as $key => $value) {
                            $inventryCond['id']         = $_POST['inventory_id'][$key];
                            $inventryCond['product_id'] = $_POST['product_id'][$key];
                            $inventryCond['shop_id'] = $shop_id;
                            $qty = $_POST['qty'][$key];
                            $qty = (int)$qty;
                            $this->pos_model->update_inventry($inventryCond,$qty);
                        }
                    }
                  }  
                }else{
                    $responce['res'] = 'error';
                    $responce['msg'] = 'Add at least one UPI and then refresh this page';
                }
               echo json_encode($responce);
            break;    
            case 'save_upi_order_edit':
                $responce['res'] = 'error';
                $responce['msg'] = 'Not Saved!';
                $shop_id = $user->id;
                $oid   = $_POST['oid'];
                if ($_POST['upi_account_id']) {
                    $orderData['payment_method']         = $_POST['payment_method'];
                    $orderData['reference_no_or_remark'] = $_POST['ref_no_or_remark'];
                
                    $transArray = array(
                        'customer_id'       => $_POST['user_id'],
                        'dr'                => $_POST['total_value'],
                        'order_id'          => '',
                        'reference_no'      => $_POST['ref_no_or_remark'],
                        'txn_type'          => 1,
                        'PaymentDate'       => '',
                        'narration'         => $this->input->post('narration'),
                        'shop_id'           => $shop_id,
                        'updated'           => '',
                        'type'              => 'Sale',
                    );
                    
        
                $OrderTransArray = array(
                        'customer_id'       => $_POST['user_id'],
                        'dr'                => $_POST['total_value'],
                        'order_id'          => '',
                        'reference_no'      => $_POST['ref_no_or_remark'],
                        'txn_type'          => 3,
                        'PaymentDate'       => '',
                        'narration'         => $this->input->post('narration'),
                        'shop_id'           => $shop_id,
                        'updated'           => '',
                        'type'              => 'Sale',
                    );
        
                $orderData['same_as_billing'] = $_POST['same_as_billing'];
                if (@$_POST['same_as_billing']==1) {
                    $orderData['shipping_address'] = null;
                }
                else{
                    $orderData['shipping_address'] = $_POST['shipping_address'];
                }
                $shop_state = $this->shops_model->get_shop_data($shop_id)->state;
                $cus_state = $this->shops_vendor_model->customers($_POST['user_id'])->state;
                $igst = ($shop_state==$cus_state) ? 0 : 1;
                
                if ($_POST['orderId']!='') {
                    $orderid = $_POST['orderId'];
                    if (!$this->pos_orders_model->check_order_id_new($oid)) {
                        $responce['res'] = 'error';
                        $responce['msg'] = 'Order Number not available!';
                        echo json_encode($responce);
                        die();

                    }
                }
        
                $orderDate = (@$_POST['order_date']) ? $_POST['order_date'] : date('Y-m-d');
                
                $orderData['orderid']                   = $orderid;
                $orderData['shop_id']                   = $shop_id;
                $orderData['user_id']                   = $_POST['user_id'];
                $orderData['invoice_no']                = NULL;
                $orderData['datetime']                  = $orderDate;
                $orderData['payment_mode']              = $_POST['payment_method'];
                $orderData['status']                    = 17;
                $orderData['total_value']               = $_POST['total_value'];
                $orderData['tax']                       = $_POST['total_tax'];
                $orderData['round_off']                 = $_POST['RoundOff'];
                $orderData['total_savings']             = '';
                $orderData['remark']                    = NULL;
                $orderData['added']                     = date('Y-m-d H:s:i');
                $orderData['payment_transaction_code']  = NULL;
                $orderData['address_id']                = NULL;
                $orderData['random_address']            = $_POST['random_address'];
                $orderData['timeslot_starttime']        = NULL;
                $orderData['timeslot_endtime']          = NULL;
                $orderData['time_slot_id']              = NULL;
                $orderData['razorpay_order_id']         = NULL;
                $orderData['razorpay_payment_id']       = NULL;
                $orderData['razorpay_signature']        = NULL;
                $orderData['booking_name']              = NULL;
                $orderData['booking_contact']           = NULL;
                $orderData['bank_name']                 = NULL;
                $orderData['is_igst']                   = $igst;
                $orderData['cancellation_reason_id']    = NULL;
                $orderData['cancellation_comment']      = NULL;
                $orderData['narration']                 = $this->input->post('narration');
                $orderData['reference_no_or_remark']    = $this->input->post('ref_no_or_remark');
                $orderData['due_amount']    = $this->input->post('due_amount');
                $orderData['tendered_amount']    = $this->input->post('tendered_amount');
                $orderData['change_amount']    = $this->input->post('change_amount');
                $orderData['order_type']    = $this->input->post('orderType');
               
                if ($this->pos_model->update_order($orderData,$oid)) {
                    $id = $oid;
                    $this->db->where('order_id', $id)->delete('pos_order_payments');
                // Insertion of payments
                $payment = [
                    'order_id'              => $id,
                    'amount'                => $_POST['total_value'],
                    'payment_mode'           =>$_POST['payment_method'],
                    'bank_id'                =>$_POST['upi_account_id'],
                ];
                if ($this->check_existing_payment($id,$_POST['payment_method'])) {
                    $this->db->where('order_id', $id);
                    $this->db->where('payment_mode',$_POST['payment_method']);
                    $this->db->update('pos_order_payments', $payment);
                } else {
                    $this->db->insert('pos_order_payments', $payment);
                }

               
                //  Insert Coupon 
                $this->db->where(['order_id'=>$id,'order_type'=>'1'])->delete('order_coupons');
                if($this->input->post('coupon_net_amount') > 0){
                
                $coupon = array(
                'order_id'=>$id,
                'order_type'=>'1',
                'coupon_type'=>'2',
                'coupon_value_type'=>$this->input->post('coupon_type'),
                'coupon_value'=>$this->input->post('coupon_value'),
                'amount'=>$this->input->post('coupon_net_amount'),
                'discount_amount'=>$this->input->post('coupon_discount_amount'),
                );
                $this->db->where('order_id', $id);
                $this->db->where('order_type', '1');
                $query = $this->db->get('order_coupons');

                if ($query->num_rows() > 0) {
                    $this->db->where('order_id', $id);
                    $this->db->where('order_type', '1');
                    $this->db->update('order_coupons', $coupon);
                } else {
                    $this->db->insert('order_coupons', $coupon);
            }
            }
             

                    $flat_value=$this->input->post('flat_value');
                    $flat_type=$this->input->post('flat_type');
                    $responce['res'] = 'success';
                    $responce['msg'] = 'Saved!';
                    $responce['invoice_url'] = base_url('pos_orders/print/bill/'.$id);
                    $responce['new_order'] = base_url('shop-pos');
        
        
                    $OrderTransArray['order_id'] = $id;
                    $OrderTransArray['PaymentDate'] = $orderDate;
                    $this->load->model('cash_register_model');
                    $this->cash_register_model->updateCash('cash_register', $OrderTransArray, $id);
                    
                    if (@$transArray) {
                        $transArray['order_id'] = $id;
                        $transArray['PaymentDate'] = $orderDate;
                        $this->cash_register_model->updateCash('cash_register', $transArray, $id);
                    }
                    
                    foreach ($_POST as $key => $value) {
                        $_POST[$key] = explode(',', $value);
                    }
        
                    foreach ($_POST['product_id'] as $key => $value) {
                        $html = "";
                        $res = $this->pos_model->product_props($value);
                        if (count($res) > 0) {
                            foreach ($res as $row) {
                                $html = $html."<h6><span class='text-danger'>".$row->name." ".$row->value."</span></h6>";
                            }
                        }
                    
                        $orderItemTmp = [
                            'inventory_id'        => $_POST['inventory_id'][$key],
                            'product_id'          => $_POST['product_id'][$key],
                            'order_id'            => $id,
                            'qty'                 => $_POST['qty'][$key],
                            'price_per_unit'      => $_POST['price_per_unit'][$key],
                            'purchase_rate'       => $_POST['purchase_rate'][$key],
                            'mrp'                 => $_POST['mrp'][$key],
                            'total_price'         => $_POST['total_price'][$key],
                            'tax'                 => $_POST['tax'][$key],
                            'tax_value'           => $_POST['tax_value'][$key],
                            'offer_applied'       => $_POST['offer_applied'][$key],
                            'discount_type'       => $_POST['discount_type'][$key],
                            'offer_applied2'      => $_POST['offer_applied2'][$key],
                            'discount_type2'      => $_POST['discount_type2'][$key],
                            'item_props_value'    => $html,
                            'flat_discount'       => $flat_value,
                            'flat_discount_type'  => $flat_type,
                        ];
                    
                        $existingProduct = $this->db->get_where('pos_order_items', [
                            'order_id'   => $id,
                            'product_id' => $_POST['product_id'][$key],
                        ])->row_array();
                    
                        if ($existingProduct) {
                            $this->db->where([
                                'order_id'   => $id,
                                'product_id' => $_POST['product_id'][$key],
                            ]);
                            $this->db->update('pos_order_items', $orderItemTmp);
                            $inventryCond = [
                                'id'         => $_POST['inventory_id'][$key],
                                'product_id' => $_POST['product_id'][$key],
                                'shop_id' => $shop_id,
                            ];
                            $qty = (int)$_POST['qty'][$key];
                            $exist_qty=$existingProduct['qty'];
                            $this->pos_model->update_inventry_edit($inventryCond, $qty,$exist_qty);
                        } else {
                            $this->db->insert('pos_order_items', $orderItemTmp);
                            $inventryCond = [
                                'id'         => $_POST['inventory_id'][$key],
                                'product_id' => $_POST['product_id'][$key],
                                'shop_id' => $shop_id,
                            ];
                            $qty = (int)$_POST['qty'][$key];
                            $this->pos_model->update_inventry($inventryCond, $qty);
                        }
                     }
                  }  
                }else{
                    $responce['res'] = 'error';
                    $responce['msg'] = 'Add at least one UPI and then refresh this page';
                }
               echo json_encode($responce);
            break;    
            case 'save_payater_order':
                $responce['res'] = 'error';
                $responce['msg'] = 'Not Saved!';
                $shop_id = $user->id;
                $_POST['is_pay_later']=1;
                if (@$_POST['is_pay_later']==1) :
                    $orderData['due_date']               = $_POST['due_date'];
                    $orderData['payment_method']         = NULL;
                else:
                    $orderData['payment_method']         = $_POST['payment_method'];
                    $orderData['reference_no_or_remark'] = $_POST['ref_no_or_remark'];
                
                    $transArray = array(
                        'customer_id'       => $_POST['user_id'],
                        'dr'                => $_POST['total_value'],
                        'order_id'          => '',
                        'reference_no'      => $_POST['ref_no_or_remark'],
                        'txn_type'          => 1,
                        'PaymentDate'       => '',
                        'narration'         => $this->input->post('narration'),
                        'shop_id'           => $shop_id,
                        'updated'           => '',
                        'type'              => 'Sale',
                    );
                    
                endif;
        
                $OrderTransArray = array(
                        'customer_id'       => $_POST['user_id'],
                        'dr'                => $_POST['total_value'],
                        'order_id'          => '',
                        'reference_no'      => $_POST['ref_no_or_remark'],
                        'txn_type'          => 3,
                        'PaymentDate'       => '',
                        'narration'         => $this->input->post('narration'),
                        'shop_id'           => $shop_id,
                        'updated'           => '',
                        'type'              => 'Sale',
                    );
        
                $orderData['same_as_billing'] = $_POST['same_as_billing'];
                if (@$_POST['same_as_billing']==1) {
                    $orderData['shipping_address'] = null;
                }
                else{
                    $orderData['shipping_address'] = $_POST['shipping_address'];
                }
                $shop_state = $this->shops_model->get_shop_data($shop_id)->state;
                $cus_state = $this->shops_vendor_model->customers($_POST['user_id'])->state;
                $igst = ($shop_state==$cus_state) ? 0 : 1;
                
                $orderid    = strtoupper('CK'.date('M').'00000');
                if ($_POST['orderId']!='') {
                    $orderid = $_POST['orderId'];
                    if (!$this->pos_orders_model->check_order_id()) {
                        $responce['res'] = 'error';
                        $responce['msg'] = 'Order Number not available!';
                        echo json_encode($responce);
                        die();

                    }
                }
        
                $orderDate = (@$_POST['order_date']) ? $_POST['order_date'] : date('Y-m-d');
                
                $orderData['is_pay_later']              = @$_POST['is_pay_later'];
                $orderData['orderid']                   = $orderid;
                $orderData['shop_id']                   = $shop_id;
                $orderData['user_id']                   = $_POST['user_id'];
                $orderData['invoice_no']                = NULL;
                $orderData['datetime']                  = $orderDate;
                $orderData['payment_mode']              = $_POST['payment_method'];
                $orderData['status']                    = 17;
                $orderData['total_value']               = $_POST['total_value'];
                $orderData['tax']                       = $_POST['total_tax'];
                $orderData['round_off']                 = $_POST['RoundOff'];
                $orderData['total_savings']             = '';
                $orderData['remark']                    = NULL;
                $orderData['added']                     = date('Y-m-d H:s:i');
                $orderData['payment_transaction_code']  = NULL;
                $orderData['address_id']                = NULL;
                $orderData['random_address']            = $_POST['random_address'];
                $orderData['timeslot_starttime']        = NULL;
                $orderData['timeslot_endtime']          = NULL;
                $orderData['time_slot_id']              = NULL;
                $orderData['razorpay_order_id']         = NULL;
                $orderData['razorpay_payment_id']       = NULL;
                $orderData['razorpay_signature']        = NULL;
                $orderData['booking_name']              = NULL;
                $orderData['booking_contact']           = NULL;
                $orderData['bank_name']                 = NULL;
                $orderData['is_igst']                   = $igst;
                $orderData['cancellation_reason_id']    = NULL;
                $orderData['cancellation_comment']      = NULL;
                $orderData['narration']                 = $this->input->post('narration');
                $orderData['reference_no_or_remark']    = $this->input->post('ref_no_or_remark');
                $orderData['due_amount']    = $this->input->post('due_amount');
                $orderData['tendered_amount']    = $this->input->post('tendered_amount');
                $orderData['change_amount']    = $this->input->post('change_amount');
                $orderData['order_type']    = $this->input->post('orderType');
               
                if ($id = $this->pos_model->save_order($orderData)) {
                // Insertion of payments
                $paylater_due_date = $_POST['paylater_terms_due_date'];
                $dateParts = explode('/', $paylater_due_date);
                if (count($dateParts) == 3) {
                    $day = $dateParts[0];
                    $month = $dateParts[1];
                    $year = $dateParts[2];
                    $formattedDate = $year . '-' . $month . '-' . $day;
                } else {
                    $formattedDate = null; 
                }
                $payment = [
                    'order_id'              => $id,
                    'amount'                => $_POST['total_value'],
                    'payment_mode'           =>$_POST['payment_method'],
                    'paylater_terms'           =>$_POST['paylater_terms'],
                    'paylater_due_date'           =>$formattedDate,
                    'paylater_reminder'           =>$_POST['paylater_reminder'],
                ];
                 $this->db->insert('pos_order_payments', $payment);

               
                //  Insert Coupon 
                if($this->input->post('coupon_net_amount') > 0){
                $coupon = array(
                'order_id'=>$id,
                'order_type'=>'1',
                'coupon_type'=>'2',
                'coupon_value_type'=>$this->input->post('coupon_type'),
                'coupon_value'=>$this->input->post('coupon_value'),
                'amount'=>$this->input->post('coupon_net_amount'),
                'discount_amount'=>$this->input->post('coupon_discount_amount'),
                );
                $this->db->insert('order_coupons',$coupon);
            }
            $flat_value=$this->input->post('flat_value');
            $flat_type=$this->input->post('flat_type');

                    $responce['res'] = 'success';
                    $responce['msg'] = 'Saved!';
                    $responce['invoice_url'] = base_url('pos_orders/print/bill/'.$id);
                    $responce['new_order'] = base_url('shop-pos');
        
                    if(@$_POST['orderId']=='') {
                        $idlen  = strlen($id);
                        $orderid    = substr_replace($orderid, '', -$idlen).$id;
                        $udata['orderid'] = $orderid;
                        $this->pos_model->update_order($udata,$id);
                    }
        
                    $OrderTransArray['order_id'] = $id;
                    $OrderTransArray['PaymentDate'] = $orderDate;
                    $this->load->model('cash_register_model');
                    $this->cash_register_model->add_data('cash_register', $OrderTransArray);
        
                    if (@$transArray) {
                        $transArray['order_id'] = $id;
                        $transArray['PaymentDate'] = $orderDate;
                        $this->cash_register_model->add_data('cash_register', $transArray);
                    }
                    foreach ($_POST as $key => $value) {
                        $_POST[$key] = explode(',', $value);
                    }
        
                    $orderItem = [];
                    foreach ($_POST['product_id'] as $key => $value) {
                        $html="";
                        $res=$this->pos_model->product_props($value);
                         {
                            if(count($res)>0)
                            {
                              foreach($res as $row)
                              {
                               $html=$html."<h6><span class='text-danger'>".$row->name." ".$row->value."</span></h6>";
                              }
                            }
                         }
                        $orderItemTmp['inventory_id']   = $_POST['inventory_id'][$key];
                        $orderItemTmp['product_id']     = $_POST['product_id'][$key];
                        $orderItemTmp['order_id']       = $id;
                        $orderItemTmp['qty']            = $_POST['qty'][$key];
                        // $orderItemTmp['free']           = $_POST['free'][$key];
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
                        $orderItemTmp['item_props_value']=$html;
                        $orderItemTmp['flat_discount'] = $flat_value;
                        $orderItemTmp['flat_discount_type'] = $flat_type;
                        $orderItem[] = $orderItemTmp;
                        unset($orderItemTmp);
        
                    }
        
                    if($this->db->insert_batch('pos_order_items', $orderItem)){
                        foreach ($_POST['product_id'] as $key => $value) {
                            $inventryCond['id']         = $_POST['inventory_id'][$key];
                            $inventryCond['product_id'] = $_POST['product_id'][$key];
                            $inventryCond['shop_id'] = $shop_id;
                            $qty = $_POST['qty'][$key];
                            $qty = (int)$qty;
                            $this->pos_model->update_inventry($inventryCond,$qty);
                        }
                    }
                  }  
               echo json_encode($responce);
              break;  
              case 'save_payater_order_edit':
                $responce['res'] = 'error';
                $responce['msg'] = 'Not Saved!';
                $shop_id = $user->id;
                $oid   = $_POST['oid'];
                $_POST['is_pay_later']=1;
                if (@$_POST['is_pay_later']==1) :
                    $orderData['due_date']               = $_POST['due_date'];
                    $orderData['payment_method']         = NULL;
                else:
                    $orderData['payment_method']         = $_POST['payment_method'];
                    $orderData['reference_no_or_remark'] = $_POST['ref_no_or_remark'];
                
                    $transArray = array(
                        'customer_id'       => $_POST['user_id'],
                        'dr'                => $_POST['total_value'],
                        'order_id'          => '',
                        'reference_no'      => $_POST['ref_no_or_remark'],
                        'txn_type'          => 1,
                        'PaymentDate'       => '',
                        'narration'         => $this->input->post('narration'),
                        'shop_id'           => $shop_id,
                        'updated'           => '',
                        'type'              => 'Sale',
                    );
                    
                endif;
        
                $OrderTransArray = array(
                        'customer_id'       => $_POST['user_id'],
                        'dr'                => $_POST['total_value'],
                        'order_id'          => '',
                        'reference_no'      => $_POST['ref_no_or_remark'],
                        'txn_type'          => 3,
                        'PaymentDate'       => '',
                        'narration'         => $this->input->post('narration'),
                        'shop_id'           => $shop_id,
                        'updated'           => '',
                        'type'              => 'Sale',
                    );
        
                $orderData['same_as_billing'] = $_POST['same_as_billing'];
                if (@$_POST['same_as_billing']==1) {
                    $orderData['shipping_address'] = null;
                }
                else{
                    $orderData['shipping_address'] = $_POST['shipping_address'];
                }
                $shop_state = $this->shops_model->get_shop_data($shop_id)->state;
                $cus_state = $this->shops_vendor_model->customers($_POST['user_id'])->state;
                $igst = ($shop_state==$cus_state) ? 0 : 1;
                
                if ($_POST['orderId']!='') {
                    $orderid = $_POST['orderId'];
                    if (!$this->pos_orders_model->check_order_id_new($oid)) {
                        $responce['res'] = 'error';
                        $responce['msg'] = 'Order Number not available!';
                        echo json_encode($responce);
                        die();

                    }
                }
        
                $orderDate = (@$_POST['order_date']) ? $_POST['order_date'] : date('Y-m-d');
                
                $orderData['is_pay_later']              = @$_POST['is_pay_later'];
                $orderData['orderid']                   = $orderid;
                $orderData['shop_id']                   = $shop_id;
                $orderData['user_id']                   = $_POST['user_id'];
                $orderData['invoice_no']                = NULL;
                $orderData['datetime']                  = $orderDate;
                $orderData['payment_mode']              = $_POST['payment_method'];
                $orderData['status']                    = 17;
                $orderData['total_value']               = $_POST['total_value'];
                $orderData['tax']                       = $_POST['total_tax'];
                $orderData['round_off']                 = $_POST['RoundOff'];
                $orderData['total_savings']             = '';
                $orderData['remark']                    = NULL;
                $orderData['added']                     = date('Y-m-d H:s:i');
                $orderData['payment_transaction_code']  = NULL;
                $orderData['address_id']                = NULL;
                $orderData['random_address']            = $_POST['random_address'];
                $orderData['timeslot_starttime']        = NULL;
                $orderData['timeslot_endtime']          = NULL;
                $orderData['time_slot_id']              = NULL;
                $orderData['razorpay_order_id']         = NULL;
                $orderData['razorpay_payment_id']       = NULL;
                $orderData['razorpay_signature']        = NULL;
                $orderData['booking_name']              = NULL;
                $orderData['booking_contact']           = NULL;
                $orderData['bank_name']                 = NULL;
                $orderData['is_igst']                   = $igst;
                $orderData['cancellation_reason_id']    = NULL;
                $orderData['cancellation_comment']      = NULL;
                $orderData['narration']                 = $this->input->post('narration');
                $orderData['reference_no_or_remark']    = $this->input->post('ref_no_or_remark');
                $orderData['due_amount']    = $this->input->post('due_amount');
                $orderData['tendered_amount']    = $this->input->post('tendered_amount');
                $orderData['change_amount']    = $this->input->post('change_amount');
                $orderData['order_type']    = $this->input->post('orderType');
               
                if ($this->pos_model->update_order($orderData,$oid)) {
                    $id = $oid;
                    $this->db->where('order_id', $id)->delete('pos_order_payments');
                // Insertion of payments
                $paylater_due_date = $_POST['paylater_terms_due_date'];
                $dateParts = explode('/', $paylater_due_date);
                if (count($dateParts) == 3) {
                    $day = $dateParts[0];
                    $month = $dateParts[1];
                    $year = $dateParts[2];
                    $formattedDate = $year . '-' . $month . '-' . $day;
                } else {
                    $formattedDate = null; 
                }
                $payment = [
                    'order_id'              => $id,
                    'amount'                => $_POST['total_value'],
                    'payment_mode'           =>$_POST['payment_method'],
                    'paylater_terms'           =>$_POST['paylater_terms'],
                    'paylater_due_date'           =>$formattedDate,
                    'paylater_reminder'           =>$_POST['paylater_reminder'],
                ];
                if ($this->check_existing_payment($id,$_POST['payment_method'])) {
                    $this->db->where('order_id', $id);
                    $this->db->where('payment_mode',$_POST['payment_method']);
                    $this->db->update('pos_order_payments', $payment);
                } else {
                    $this->db->insert('pos_order_payments', $payment);
                }

               
                //  Insert Coupon 
                $this->db->where(['order_id'=>$id,'order_type'=>'1'])->delete('order_coupons');
                if($this->input->post('coupon_net_amount') > 0){
               
                $coupon = array(
                'order_id'=>$id,
                'order_type'=>'1',
                'coupon_type'=>'2',
                'coupon_value_type'=>$this->input->post('coupon_type'),
                'coupon_value'=>$this->input->post('coupon_value'),
                'amount'=>$this->input->post('coupon_net_amount'),
                'discount_amount'=>$this->input->post('coupon_discount_amount'),
                );
                $this->db->where('order_id', $id);
                $this->db->where('order_type', '1');
                $query = $this->db->get('order_coupons');

                if ($query->num_rows() > 0) {
                    $this->db->where('order_id', $id);
                    $this->db->where('order_type', '1');
                    $this->db->update('order_coupons', $coupon);
                } else {
                    $this->db->insert('order_coupons', $coupon);
            }
            }
            $flat_value=$this->input->post('flat_value');
            $flat_type=$this->input->post('flat_type');

                    $responce['res'] = 'success';
                    $responce['msg'] = 'Saved!';
                    $responce['invoice_url'] = base_url('pos_orders/print/bill/'.$id);
                    $responce['new_order'] = base_url('shop-pos');
        
                    $OrderTransArray['order_id'] = $id;
                    $OrderTransArray['PaymentDate'] = $orderDate;
                    $this->load->model('cash_register_model');
                    $this->cash_register_model->updateCash('cash_register', $OrderTransArray, $id);
                    
                    if (@$transArray) {
                        $transArray['order_id'] = $id;
                        $transArray['PaymentDate'] = $orderDate;
                        $this->cash_register_model->updateCash('cash_register', $transArray, $id);
                    }
                    
                    foreach ($_POST as $key => $value) {
                        $_POST[$key] = explode(',', $value);
                    }
        
                    foreach ($_POST['product_id'] as $key => $value) {
                        $html = "";
                        $res = $this->pos_model->product_props($value);
                        if (count($res) > 0) {
                            foreach ($res as $row) {
                                $html = $html."<h6><span class='text-danger'>".$row->name." ".$row->value."</span></h6>";
                            }
                        }
                    
                        $orderItemTmp = [
                            'inventory_id'        => $_POST['inventory_id'][$key],
                            'product_id'          => $_POST['product_id'][$key],
                            'order_id'            => $id,
                            'qty'                 => $_POST['qty'][$key],
                            'price_per_unit'      => $_POST['price_per_unit'][$key],
                            'purchase_rate'       => $_POST['purchase_rate'][$key],
                            'mrp'                 => $_POST['mrp'][$key],
                            'total_price'         => $_POST['total_price'][$key],
                            'tax'                 => $_POST['tax'][$key],
                            'tax_value'           => $_POST['tax_value'][$key],
                            'offer_applied'       => $_POST['offer_applied'][$key],
                            'discount_type'       => $_POST['discount_type'][$key],
                            'offer_applied2'      => $_POST['offer_applied2'][$key],
                            'discount_type2'      => $_POST['discount_type2'][$key],
                            'item_props_value'    => $html,
                            'flat_discount'       => $flat_value,
                            'flat_discount_type'  => $flat_type,
                        ];
                    
                        $existingProduct = $this->db->get_where('pos_order_items', [
                            'order_id'   => $id,
                            'product_id' => $_POST['product_id'][$key],
                        ])->row_array();
                    
                        if ($existingProduct) {
                            $this->db->where([
                                'order_id'   => $id,
                                'product_id' => $_POST['product_id'][$key],
                            ]);
                            $this->db->update('pos_order_items', $orderItemTmp);
                            $inventryCond = [
                                'id'         => $_POST['inventory_id'][$key],
                                'product_id' => $_POST['product_id'][$key],
                                'shop_id' => $shop_id,
                            ];
                            $qty = (int)$_POST['qty'][$key];
                            $exist_qty=$existingProduct['qty'];
                            $this->pos_model->update_inventry_edit($inventryCond, $qty,$exist_qty);
                        } else {
                            $this->db->insert('pos_order_items', $orderItemTmp);
                            $inventryCond = [
                                'id'         => $_POST['inventory_id'][$key],
                                'product_id' => $_POST['product_id'][$key],
                                'shop_id' => $shop_id,
                            ];
                            $qty = (int)$_POST['qty'][$key];
                            $this->pos_model->update_inventry($inventryCond, $qty);
                        }
                     }
                  }  
               echo json_encode($responce);
            break; 
              case 'saveMultiPayOrder':
                $responce['res'] = 'error';
                $responce['msg'] = 'Not Saved!';
                $shop_id = $user->id;
                if ($_POST['payment_method']) {
                    $orderData['payment_method']         = $_POST['payment_method'];
                    $orderData['reference_no_or_remark'] = $_POST['ref_no_or_remark'];
                
                    $transArray = array(
                        'customer_id'       => $_POST['user_id'],
                        'dr'                => $_POST['total_value'],
                        'order_id'          => '',
                        'reference_no'      => $_POST['ref_no_or_remark'],
                        'txn_type'          => 1,
                        'PaymentDate'       => '',
                        'narration'         => $this->input->post('narration'),
                        'shop_id'           => $shop_id,
                        'updated'           => '',
                        'type'              => 'Sale',
                    );
        
                $OrderTransArray = array(
                        'customer_id'       => $_POST['user_id'],
                        'dr'                => $_POST['total_value'],
                        'order_id'          => '',
                        'reference_no'      => $_POST['ref_no_or_remark'],
                        'txn_type'          => 3,
                        'PaymentDate'       => '',
                        'narration'         => $this->input->post('narration'),
                        'shop_id'           => $shop_id,
                        'updated'           => '',
                        'type'              => 'Sale',
                    );
        
                $orderData['same_as_billing'] = $_POST['same_as_billing'];
                if (@$_POST['same_as_billing']==1) {
                    $orderData['shipping_address'] = null;
                }
                else{
                    $orderData['shipping_address'] = $_POST['shipping_address'];
                }
                $shop_state = $this->shops_model->get_shop_data($shop_id)->state;
                $cus_state = $this->shops_vendor_model->customers($_POST['user_id'])->state;
                $igst = ($shop_state==$cus_state) ? 0 : 1;
                
                $orderid    = strtoupper('CK'.date('M').'00000');
                if ($_POST['orderId']!='') {
                    $orderid = $_POST['orderId'];
                    if (!$this->pos_orders_model->check_order_id()) {
                        $responce['res'] = 'error';
                        $responce['msg'] = 'Order Number not available!';
                        echo json_encode($responce);
                        die();

                    }
                }
        
                $orderDate = (@$_POST['order_date']) ? $_POST['order_date'] : date('Y-m-d');
                
                $orderData['orderid']                   = $orderid;
                $orderData['shop_id']                   = $shop_id;
                $orderData['user_id']                   = $_POST['user_id'];
                $orderData['invoice_no']                = NULL;
                $orderData['datetime']                  = $orderDate;
                $orderData['payment_mode']              = $_POST['payment_method'];
                $orderData['status']                    = 17;
                $orderData['total_value']               = $_POST['total_value'];
                $orderData['tax']                       = $_POST['total_tax'];
                $orderData['round_off']                 = $_POST['RoundOff'];
                $orderData['total_savings']             = '';
                $orderData['remark']                    = NULL;
                $orderData['added']                     = date('Y-m-d H:s:i');
                $orderData['payment_transaction_code']  = NULL;
                $orderData['address_id']                = NULL;
                $orderData['random_address']            = $_POST['random_address'];
                $orderData['timeslot_starttime']        = NULL;
                $orderData['timeslot_endtime']          = NULL;
                $orderData['time_slot_id']              = NULL;
                $orderData['razorpay_order_id']         = NULL;
                $orderData['razorpay_payment_id']       = NULL;
                $orderData['razorpay_signature']        = NULL;
                $orderData['booking_name']              = NULL;
                $orderData['booking_contact']           = NULL;
                $orderData['bank_name']                 = NULL;
                $orderData['is_igst']                   = $igst;
                $orderData['cancellation_reason_id']    = NULL;
                $orderData['cancellation_comment']      = NULL;
                $orderData['narration']                 = $this->input->post('narration');
                $orderData['reference_no_or_remark']    = $this->input->post('ref_no_or_remark');
                $orderData['due_amount']    = $this->input->post('due_amount');
                $orderData['tendered_amount']    = $this->input->post('tendered_amount');
                $orderData['change_amount']    = $this->input->post('change_amount');
                $orderData['order_type']    = $this->input->post('orderType');
                if ($id = $this->pos_model->save_order($orderData)) {
                // Insertion of payments
                $srno = $this->input->post('srno');
                $receivedAmount = $this->input->post('receivedAmount');
                $payment_method = $this->input->post('payment_method');
                $bankId = $this->input->post('bankId');
                $customer_bank_name = $this->input->post('customer_bank_name');
                $card_holder_name = $this->input->post('card_holder_name');
                $card_Transaction_no = $this->input->post('card_Transaction_no');
                if (is_string($srno)) {
                    $srno = explode(',', $srno);
                }
                if (is_string($receivedAmount)) {
                    $receivedAmount = explode(',', $receivedAmount);
                }
                if (is_string($payment_method)) {
                    $payment_method = explode(',', $payment_method);
                }
                if (is_string($bankId)) {
                    $bankId = explode(',', $bankId);
                }
                if (is_string($customer_bank_name)) {
                    $customer_bank_name = explode(',', $customer_bank_name);
                }
                if (is_string($card_holder_name)) {
                    $card_holder_name = explode(',', $card_holder_name);
                }
                if (is_string($card_Transaction_no)) {
                    $card_Transaction_no = explode(',', $card_Transaction_no);
                }
                foreach($srno as $key=>$value)
                {
                    if($payment_method[$key]=='1')
                    {
                        $payment = [
                            'order_id'              => $id,
                            'amount'                => $receivedAmount[$key],
                            'payment_mode'           =>$payment_method[$key],
                        ];
                      $this->db->insert('pos_order_payments', $payment);

                    }elseif($payment_method[$key]=='2')
                    {
                        $payment = [
                            'order_id'              => $id,
                            'amount'                => $receivedAmount[$key],
                            'payment_mode'           =>$payment_method[$key],
                            'customer_bank_name'           =>$customer_bank_name[$key],
                            'card_payment_amount'           =>$receivedAmount[$key],
                            'card_holder_name'           =>$card_holder_name[$key],
                            'card_tr_no'           =>$card_Transaction_no[$key],
                        ];
                      $this->db->insert('pos_order_payments', $payment);

                    }elseif($payment_method[$key]=='3')
                    {
                        $payment = [
                            'order_id'              => $id,
                            'amount'                => $receivedAmount[$key],
                            'payment_mode'           =>$payment_method[$key],
                            'bank_id'                =>$bankId[$key],
                        ];
                      $this->db->insert('pos_order_payments', $payment);

                    }
                   
                }
                $flat_value=$this->input->post('flat_value');
                $flat_type=$this->input->post('flat_type');

               
                //  Insert Coupon 
                if($this->input->post('coupon_net_amount') > 0){
                $coupon = array(
                'order_id'=>$id,
                'order_type'=>'1',
                'coupon_type'=>'2',
                'coupon_value_type'=>$this->input->post('coupon_type'),
                'coupon_value'=>$this->input->post('coupon_value'),
                'amount'=>$this->input->post('coupon_net_amount'),
                'discount_amount'=>$this->input->post('coupon_discount_amount'),
                );
                $this->db->insert('order_coupons',$coupon);
            }
               

                    $responce['res'] = 'success';
                    $responce['msg'] = 'Saved!';
                    $responce['invoice_url'] = base_url('pos_orders/print/bill/'.$id);
                    $responce['new_order'] = base_url('shop-pos');
        
                    if(@$_POST['orderId']=='') {
                        $idlen  = strlen($id);
                        $orderid    = substr_replace($orderid, '', -$idlen).$id;
                        $udata['orderid'] = $orderid;
                        $this->pos_model->update_order($udata,$id);
                    }
        
                    $OrderTransArray['order_id'] = $id;
                    $OrderTransArray['PaymentDate'] = $orderDate;
                    $this->load->model('cash_register_model');
                    $this->cash_register_model->add_data('cash_register', $OrderTransArray);
        
                    if (@$transArray) {
                        $transArray['order_id'] = $id;
                        $transArray['PaymentDate'] = $orderDate;
                        $this->cash_register_model->add_data('cash_register', $transArray);
                    }
                    foreach ($_POST as $key => $value) {
                        $_POST[$key] = explode(',', $value);
                    }
        
                    $orderItem = [];
                    foreach ($_POST['product_id'] as $key => $value) {
                        $html="";
                        $res=$this->pos_model->product_props($value);
                         {
                            if(count($res)>0)
                            {
                              foreach($res as $row)
                              {
                               $html=$html."<h6><span class='text-danger'>".$row->name." ".$row->value."</span></h6>";
                              }
                            }
                         }
                        $orderItemTmp['inventory_id']   = $_POST['inventory_id'][$key];
                        $orderItemTmp['product_id']     = $_POST['product_id'][$key];
                        $orderItemTmp['order_id']       = $id;
                        $orderItemTmp['qty']            = $_POST['qty'][$key];
                        // $orderItemTmp['free']           = $_POST['free'][$key];
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
                        $orderItemTmp['item_props_value']=$html;
                        $orderItemTmp['flat_discount'] = $flat_value;
                        $orderItemTmp['flat_discount_type'] = $flat_type;
                        $orderItem[] = $orderItemTmp;
                        unset($orderItemTmp);
        
                    }
        
                    if($this->db->insert_batch('pos_order_items', $orderItem)){
                        foreach ($_POST['product_id'] as $key => $value) {
                            $inventryCond['id']         = $_POST['inventory_id'][$key];
                            $inventryCond['product_id'] = $_POST['product_id'][$key];
                            $qty = $_POST['qty'][$key];
                            $qty = (int)$qty;
                            $inventryCond['shop_id'] = $shop_id;
                            $this->pos_model->update_inventry($inventryCond,$qty);
                        }
                    }
                  }  
                }else{
                    $responce['res'] = 'error';
                    $responce['msg'] = 'Add at least one payment method and then refresh this page';
                }
               echo json_encode($responce);
              break;
              case 'saveMultiPayOrder_edit':
                $responce['res'] = 'error';
                $responce['msg'] = 'Not Saved!';
                $shop_id = $user->id;
                $oid = $_POST['oid'];
                if ($_POST['payment_method']) {
                    $orderData['payment_method']         = $_POST['payment_method'];
                    $orderData['reference_no_or_remark'] = $_POST['ref_no_or_remark'];
                
                    $transArray = array(
                        'customer_id'       => $_POST['user_id'],
                        'dr'                => $_POST['total_value'],
                        'order_id'          => '',
                        'reference_no'      => $_POST['ref_no_or_remark'],
                        'txn_type'          => 1,
                        'PaymentDate'       => '',
                        'narration'         => $this->input->post('narration'),
                        'shop_id'           => $shop_id,
                        'updated'           => '',
                        'type'              => 'Sale',
                    );
        
                $OrderTransArray = array(
                        'customer_id'       => $_POST['user_id'],
                        'dr'                => $_POST['total_value'],
                        'order_id'          => '',
                        'reference_no'      => $_POST['ref_no_or_remark'],
                        'txn_type'          => 3,
                        'PaymentDate'       => '',
                        'narration'         => $this->input->post('narration'),
                        'shop_id'           => $shop_id,
                        'updated'           => '',
                        'type'              => 'Sale',
                    );
        
                $orderData['same_as_billing'] = $_POST['same_as_billing'];
                if (@$_POST['same_as_billing']==1) {
                    $orderData['shipping_address'] = null;
                }
                else{
                    $orderData['shipping_address'] = $_POST['shipping_address'];
                }
                $shop_state = $this->shops_model->get_shop_data($shop_id)->state;
                $cus_state = $this->shops_vendor_model->customers($_POST['user_id'])->state;
                $igst = ($shop_state==$cus_state) ? 0 : 1;
                
                if ($_POST['orderId']!='') {
                    $orderid = $_POST['orderId'];
                    if (!$this->pos_orders_model->check_order_id_new($oid)) {
                        $responce['res'] = 'error';
                        $responce['msg'] = 'Order Number not available!';
                        echo json_encode($responce);
                        die();

                    }
                }
        
                $orderDate = (@$_POST['order_date']) ? $_POST['order_date'] : date('Y-m-d');
                
                $orderData['orderid']                   = $orderid;
                $orderData['shop_id']                   = $shop_id;
                $orderData['user_id']                   = $_POST['user_id'];
                $orderData['invoice_no']                = NULL;
                $orderData['datetime']                  = $orderDate;
                $orderData['payment_mode']              = $_POST['payment_method'];
                $orderData['status']                    = 17;
                $orderData['total_value']               = $_POST['total_value'];
                $orderData['tax']                       = $_POST['total_tax'];
                $orderData['round_off']                 = $_POST['RoundOff'];
                $orderData['total_savings']             = '';
                $orderData['remark']                    = NULL;
                $orderData['added']                     = date('Y-m-d H:s:i');
                $orderData['payment_transaction_code']  = NULL;
                $orderData['address_id']                = NULL;
                $orderData['random_address']            = $_POST['random_address'];
                $orderData['timeslot_starttime']        = NULL;
                $orderData['timeslot_endtime']          = NULL;
                $orderData['time_slot_id']              = NULL;
                $orderData['razorpay_order_id']         = NULL;
                $orderData['razorpay_payment_id']       = NULL;
                $orderData['razorpay_signature']        = NULL;
                $orderData['booking_name']              = NULL;
                $orderData['booking_contact']           = NULL;
                $orderData['bank_name']                 = NULL;
                $orderData['is_igst']                   = $igst;
                $orderData['cancellation_reason_id']    = NULL;
                $orderData['cancellation_comment']      = NULL;
                $orderData['narration']                 = $this->input->post('narration');
                $orderData['reference_no_or_remark']    = $this->input->post('ref_no_or_remark');
                $orderData['due_amount']    = $this->input->post('due_amount');
                $orderData['tendered_amount']    = $this->input->post('tendered_amount');
                $orderData['change_amount']    = $this->input->post('change_amount');
                $orderData['order_type']    = $this->input->post('orderType');
                if ($this->pos_model->update_order($orderData,$oid)) {
                    $id = $oid;
                // Insertion of payments
                $srno = $this->input->post('srno');
                $receivedAmount = $this->input->post('receivedAmount');
                $payment_method = $this->input->post('payment_method');
                $bankId = $this->input->post('bankId');
                $customer_bank_name = $this->input->post('customer_bank_name');
                $card_holder_name = $this->input->post('card_holder_name');
                $card_Transaction_no = $this->input->post('card_Transaction_no');
                if (is_string($srno)) {
                    $srno = explode(',', $srno);
                }
                if (is_string($receivedAmount)) {
                    $receivedAmount = explode(',', $receivedAmount);
                }
                if (is_string($payment_method)) {
                    $payment_method = explode(',', $payment_method);
                }
                if (is_string($bankId)) {
                    $bankId = explode(',', $bankId);
                }
                if (is_string($customer_bank_name)) {
                    $customer_bank_name = explode(',', $customer_bank_name);
                }
                if (is_string($card_holder_name)) {
                    $card_holder_name = explode(',', $card_holder_name);
                }
                if (is_string($card_Transaction_no)) {
                    $card_Transaction_no = explode(',', $card_Transaction_no);
                }
                $this->db->where('order_id', $id)->delete('pos_order_payments');
                foreach($srno as $key=>$value)
                {
                    
                    if($payment_method[$key]=='1')
                    {
                        $payment = [
                            'order_id'              => $id,
                            'amount'                => $receivedAmount[$key],
                            'payment_mode'           =>$payment_method[$key],
                        ];
                        if ($this->check_existing_payment($id,$payment_method[$key])) {
                            $this->db->where('order_id', $id);
                            $this->db->where('payment_mode',$payment_method[$key]);
                            $this->db->update('pos_order_payments', $payment);
                        } else {
                            $this->db->insert('pos_order_payments', $payment);
                        }

                    }elseif($payment_method[$key]=='2')
                    {
                        $payment = [
                            'order_id'              => $id,
                            'amount'                => $receivedAmount[$key],
                            'payment_mode'           =>$payment_method[$key],
                            'customer_bank_name'           =>$customer_bank_name[$key],
                            'card_payment_amount'           =>$receivedAmount[$key],
                            'card_holder_name'           =>$card_holder_name[$key],
                            'card_tr_no'           =>$card_Transaction_no[$key],
                        ];
                        if ($this->check_existing_payment($id,$payment_method[$key])) {
                            $this->db->where('order_id', $id);
                            $this->db->where('payment_mode',$payment_method[$key]);
                            $this->db->update('pos_order_payments', $payment);
                        } else {
                            $this->db->insert('pos_order_payments', $payment);
                        }

                    }elseif($payment_method[$key]=='3')
                    {
                        $payment = [
                            'order_id'              => $id,
                            'amount'                => $receivedAmount[$key],
                            'payment_mode'           =>$payment_method[$key],
                            'bank_id'                =>$bankId[$key],
                        ];
                        if ($this->check_existing_payment($id,$payment_method[$key])) {
                            $this->db->where('order_id', $id);
                            $this->db->where('payment_mode',$payment_method[$key]);
                            $this->db->update('pos_order_payments', $payment);
                        } else {
                            $this->db->insert('pos_order_payments', $payment);
                        }

                    }
                   
                }
                $flat_value=$this->input->post('flat_value');
                $flat_type=$this->input->post('flat_type');

               
                //  Insert Coupon 
                $this->db->where(['order_id'=>$id,'order_type'=>'1'])->delete('order_coupons');
                if($this->input->post('coupon_net_amount') > 0){
               
                $coupon = array(
                'order_id'=>$id,
                'order_type'=>'1',
                'coupon_type'=>'2',
                'coupon_value_type'=>$this->input->post('coupon_type'),
                'coupon_value'=>$this->input->post('coupon_value'),
                'amount'=>$this->input->post('coupon_net_amount'),
                'discount_amount'=>$this->input->post('coupon_discount_amount'),
                );
                $this->db->where('order_id', $id);
                $this->db->where('order_type', '1');
                $query = $this->db->get('order_coupons');

                if ($query->num_rows() > 0) {
                    $this->db->where('order_id', $id);
                    $this->db->where('order_type', '1');
                    $this->db->update('order_coupons', $coupon);
                } else {
                    $this->db->insert('order_coupons', $coupon);
            }
            }
               

                    $responce['res'] = 'success';
                    $responce['msg'] = 'Saved!';
                    $responce['invoice_url'] = base_url('pos_orders/print/bill/'.$id);
                    $responce['new_order'] = base_url('shop-pos');
        
                    $OrderTransArray['order_id'] = $id;
                    $OrderTransArray['PaymentDate'] = $orderDate;
                    $this->load->model('cash_register_model');
                    $this->cash_register_model->updateCash('cash_register', $OrderTransArray, $id);
                    
                    if (@$transArray) {
                        $transArray['order_id'] = $id;
                        $transArray['PaymentDate'] = $orderDate;
                        $this->cash_register_model->updateCash('cash_register', $transArray, $id);
                    }
                    
                    foreach ($_POST as $key => $value) {
                        $_POST[$key] = explode(',', $value);
                    }
        
                    foreach ($_POST['product_id'] as $key => $value) {
                        $html = "";
                        $res = $this->pos_model->product_props($value);
                        if (count($res) > 0) {
                            foreach ($res as $row) {
                                $html = $html."<h6><span class='text-danger'>".$row->name." ".$row->value."</span></h6>";
                            }
                        }
                    
                        $orderItemTmp = [
                            'inventory_id'        => $_POST['inventory_id'][$key],
                            'product_id'          => $_POST['product_id'][$key],
                            'order_id'            => $id,
                            'qty'                 => $_POST['qty'][$key],
                            'price_per_unit'      => $_POST['price_per_unit'][$key],
                            'purchase_rate'       => $_POST['purchase_rate'][$key],
                            'mrp'                 => $_POST['mrp'][$key],
                            'total_price'         => $_POST['total_price'][$key],
                            'tax'                 => $_POST['tax'][$key],
                            'tax_value'           => $_POST['tax_value'][$key],
                            'offer_applied'       => $_POST['offer_applied'][$key],
                            'discount_type'       => $_POST['discount_type'][$key],
                            'offer_applied2'      => $_POST['offer_applied2'][$key],
                            'discount_type2'      => $_POST['discount_type2'][$key],
                            'item_props_value'    => $html,
                            'flat_discount'       => $flat_value,
                            'flat_discount_type'  => $flat_type,
                        ];
                    
                        $existingProduct = $this->db->get_where('pos_order_items', [
                            'order_id'   => $id,
                            'product_id' => $_POST['product_id'][$key],
                        ])->row_array();
                    
                        if ($existingProduct) {
                            $this->db->where([
                                'order_id'   => $id,
                                'product_id' => $_POST['product_id'][$key],
                            ]);
                            $this->db->update('pos_order_items', $orderItemTmp);
                            $inventryCond = [
                                'id'         => $_POST['inventory_id'][$key],
                                'product_id' => $_POST['product_id'][$key],
                                'shop_id' => $shop_id,
                            ];
                            $qty = (int)$_POST['qty'][$key];
                            $exist_qty=$existingProduct['qty'];
                            $this->pos_model->update_inventry_edit($inventryCond, $qty,$exist_qty);
                        } else {
                            $this->db->insert('pos_order_items', $orderItemTmp);
                            $inventryCond = [
                                'id'         => $_POST['inventory_id'][$key],
                                'product_id' => $_POST['product_id'][$key],
                                'shop_id' => $shop_id,
                            ];
                            $qty = (int)$_POST['qty'][$key];
                            $this->pos_model->update_inventry($inventryCond, $qty);
                        }
                     }
                  }  
                }else{
                    $responce['res'] = 'error';
                    $responce['msg'] = 'Add at least one payment method and then refresh this page';
                }
               echo json_encode($responce);
                break;
          case 'getCoupons':
            $coupons = $this->pos_model->get_available_coupons();
            $customer_id = $this->input->get('customer_id');
            $applied_coupon = $this->session->userdata('applied_coupon_' . $customer_id);
            if ($coupons) {
                $response = array(
                    'success' => true,
                    'coupons' => $coupons,
                    'applied_coupon' => $applied_coupon
                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'No coupons available'
                );
            }
            echo json_encode($response);
        break;
            case 'applyCoupon':
                $coupon_code = $this->input->post('coupon_code');
                $net_amount = $this->input->post('net_amount');
                $customer_id = $this->input->post('customer_id');
                $result = $this->pos_model->apply_coupon($coupon_code,$net_amount, $customer_id);
                if ($result['success']) {
                    $response = array(
                        'success' => true,
                        'value' => $result['value'],
                        'discount_type' => $result['discount_type'],
                        'min_amount' => $result['minimum_coupan_amount'],
                        'max_value' => $result['maximum_coupan_discount_value'],
                        'total' => $result['total'],
                        'discount_value'=>$result['discount_value'],
                    );
                } else {
                    $response = array(
                        'success' => false,
                        'message' => $result['message']
                    );
                }
                echo json_encode($response);
            break;
            case 'removeCoupon':
                $coupon_code = $this->input->post('coupon_code');
                $customer_id = $this->input->post('customer_id');
                $this->session->unset_userdata('applied_coupon_' . $customer_id);
                $response = array(
                    'success' => true,
                    'message' => 'Coupon removed successfully'
                );
                echo json_encode($response);
            break;
            case 'unsetCouponSession':
                $customer_id = $this->input->post('customer_id');

                if (empty($customer_id)) {
                    $response = array(
                        'success' => false,
                        'message' => 'Customer ID is required'
                    );
                    echo json_encode($response);
                    return;
                }
            
                $this->session->unset_userdata('applied_coupon_' . $customer_id);
                $response = array('success' => true);
                echo json_encode($response);
            break;     
            
        }
    }
    public function select_customer(){
        echo _prx($_GET);

        $this->db->order_by('name','asc');
        $vendors = $this->db->get('vendors')->result();
        $html = '';
        foreach ($vendors as $key => $value) {
        $html .= "<option value='$value->id'>$value->name</option>";
        }

        echo $html;

    }

  

  // Function to insert or update coupon
function insert_or_update_coupon($data) {
    // Check if the coupon already exists
    $this->db->where('order_id', $data['order_id']);
    $this->db->where('order_type', $data['order_type']);
    $query = $this->db->get('order_coupons');
    
    if ($query->num_rows() > 0) {
        // Coupon exists, update it
        $this->db->where('order_id', $data['order_id']);
        $this->db->where('order_type', $data['order_type']);
        $this->db->update('order_coupons', $data);
    } else {
        // Coupon does not exist, insert new record
        $this->db->insert('order_coupons', $data);
    }
}

// Function to insert or update order items
function insert_or_update_order_item($data) {
    // Check if the order item already exists
    $this->db->where('order_id', $data['order_id']);
    $this->db->where('product_id', $data['product_id']);
    $query = $this->db->get('pos_order_items');
    
    if ($query->num_rows() > 0) {
        // Order item exists, update it
        $this->db->where('order_id', $data['order_id']);
        $this->db->where('product_id', $data['product_id']);
        $this->db->update('pos_order_items', $data);
    } else {
        // Order item does not exist, insert new record
        $this->db->insert('pos_order_items', $data);
    }
}
  

 // Function to check if the payment record already exists
 function check_existing_payment($order_id, $payment_mode) {
    $this->db->where('order_id', $order_id);
    $this->db->where('payment_mode', $payment_mode);
    $query = $this->db->get('pos_order_payments');
    return $query->num_rows() > 0;
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
