<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                        <?php echo $breadcrumb;?>
                    </div>
                    <!-- <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            
                            <div class="">
                                <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10">
                                    <i style="animation-play-state: paused !important;" class="mdi mdi-filter text-white"></i>
                                </button>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- .left-right-aside-column-->
                            <div class="card-body">
                                <h4 class="card-title">All Orders</h4>   
                                <div class="row">
                                    <div class="col-lg-2 col-md-6">
                                        <div class="form-group">
                                            <label for="example-date-input" class="control-label">From date</label>
                                            <input class="form-control form-control-sm" type="date" value="<?php if(isset($_SESSION['order_table_filters']['from_date'])){ echo $_SESSION['order_table_filters']['from_date'];} ?>" id="from-date">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-6">
                                        <div class="form-group">
                                        <label for="example-date-input" class="control-label">To date</label>
                                            <input class="form-control form-control-sm" type="date" value="<?php if(isset($_SESSION['order_table_filters']['to_date'])){ echo $_SESSION['order_table_filters']['to_date']; }?>" id="end-date">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Order Status:</label>
                                            <select class="form-control form-control-sm" style="width:100%;" id="order-status" data-placeholder="Choose">
                                                <option value="">Select</option>
                                                <?php if(isset($orderStatus) && $orderStatus!==FALSE){ ?>
                                                    <?php foreach ($orderStatus as $status) { ?>
                                                    <option value="<?php echo $status['id']; ?>" <?php if(isset($_SESSION['order_table_filters']['status_ids']) &&  $status['id'] == $_SESSION['order_table_filters']['status_ids']) {echo "selected"; } ?>>
                                                        <?php echo $status['name']; ?>
                                                    </option>
                                                <?php } } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Payment Method:</label>
                                            <select class="form-control form-control-sm" style="width:100%;" id="payment-method" data-placeholder="Choose">
                                                <option value="">Select</option>
                                                <option value="cod" <?php if(isset($_SESSION['order_table_filters']['payment_method'])){if($_SESSION['order_table_filters']['payment_method'] == 'cod'){echo "selected";}
                                                    }?>>COD</option>
                                                    <option value="online" <?php if(isset($_SESSION['order_table_filters']['payment_method'])){if($_SESSION['order_table_filters']['payment_method'] == 'online'){echo "selected";}
                                                    }?>>Online</option>
                                                <!-- <?php
                                                    if($orderPaymentStatusMaster!==FALSE){
                                                        foreach($orderPaymentStatusMaster as $paymentmode){
                                                            echo '<option value="'.$paymentmode['name'].'">'.$paymentmode['name'].'</option>';
                                                        }
                                                    }
                                                ?> -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Delivery Boy:</label>
                                            <select name="delivery_boy" style="width:100%;" class="form-control form-control-sm" id="delivery-boy">
                                                <option value="">-- Select --</option>
                                                <?php foreach ($delivery_boys as $dbrow) { ?>
                                                    <option value="<?=$dbrow->id?>" 
                                                        <?php if(isset($_SESSION['order_table_filters']['delivery_boy'])){
                                                            if($_SESSION['order_table_filters']['delivery_boy'] == $dbrow->id){ echo "selected"; }
                                                        } ?> >
                                                        <?=$dbrow->full_name?> (<?=$dbrow->contact_number?>)
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Customer Mobile:</label>
                                            <input class="form-control form-control-sm" type="text" value="<?php if(isset($_SESSION['order_table_filters']['customer_mobile'])){ echo $_SESSION['order_table_filters']['customer_mobile']; }?>" id="customer-mobile">
                                        </div>
                                    </div>
                                    <div class="col-4 mb-2">
                                    <a href="javascript:void(0)" class="btn clear-filter btn-primary btn-sm mb-3 mt-3 mr-3" id="reset-data" title="Reset"><i class="fas fa-retweet"></i></a>
                                        <button class="btn btn-sm btn-primary apply-filter">Apply Filters</button>
                                    </div>
                                </div>                     
                                <div class="contact-page-aside">
                                    <div id="table-responsive">
                                        
                                    </div>
                                    <!-- .left-aside-column-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <script>
                    /*$(document).ready(function() {
                        $('.printPopUp').click(function(e) {*/
                    function printPopUp(id){
                        if (id === 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'You cannot print bill for this order!'
                            })
                        }else{
                            var newwindow = window.open('orders/print/bill/'+id, '', 'height=1000,width=950');
                            if (window.focus) {
                                newwindow.focus();
                            }
                            return false;
                        }
                    }        
                            /*e.preventDefault();
                            
                        });
                    });*/
         function printPopUpShipment(id,waybill) {
        if (waybill === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Way bill not generated!'
            });
        } else {
            Swal.fire({
                title: 'Loading Please Wait...',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: "<?=base_url();?>orders/proAPIPrintLabel",
                type: "POST",
                data: { waybill: waybill,oid:id },
                success: function (data) {
                    Swal.close(); 
                    if (data == 'FALSE') {
                    } else {
                        var newWindow = window.open();
                    newWindow.document.write('<iframe width="100%" height="100%" src="' + data + '"></iframe>');

                        return false;
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error occurred while fetching data!'
                    });
                }
            });
        }
    }
     function printManageShipAlready(waybill) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'You are already generated this shipment!'
            });
    }
    function printManageShipReturnAlready(waybill) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'You are already generated this shipment!'
            });
    }
    
    function printManageShipCancelled(waybill) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'You are already cancelled this shipment!'
            });
    }
    function printManageShipReturnCancelled(waybill) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'You are already cancelled this shipment!'
            });
    }
    
    function printManageShipCreate(id) {
    if (id === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'You cannot generate shipment for this order!'
        });
    } else {
        Swal.fire({
            title: 'Are you sure?',
            html: 'You want to generate shipment for this order?<br/><br/><strong>This action cannot be undone.</strong>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, generate shipment!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Loading Please Wait...',
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: "<?= base_url(); ?>orders/proAPICreateShipment",
                    type: "POST",
                    data: { id: id },
                    dataType: 'json',
                    success: function (data) {
                        Swal.close();
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: data.message
                            });
                            $("#table-responsive").jsGrid("loadData");
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.message
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error occurred while fetching data!'
                        });
                    }
                });
            }
        });
    }
}




 function printManageReturnShipCreate(id) {
    if (id === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'You cannot generate shipment for this order!'
        });
    } else {
        Swal.fire({
            title: 'Are you sure?',
            html: 'You want to generate return shipment for this order?<br/><br/><strong>This action cannot be undone.</strong>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, generate shipment!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Loading Please Wait...',
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: "<?= base_url(); ?>orders/proAPICreateShipmentReturn",
                    type: "POST",
                    data: { id: id },
                    dataType: 'json',
                    success: function (data) {
                        Swal.close();
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: data.message
                            });
                            $("#table-responsive").jsGrid("loadData");
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.message
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error occurred while fetching data!'
                        });
                    }
                });
            }
        });
    }
}
//     function printManageShipCreate(id) {
//     if (id === 0) {
//         Swal.fire({
//             icon: 'error',
//             title: 'Oops...',
//             text: 'You cannot generate shipment for this order!'
//         });
//     } else {
//         Swal.fire({
//             title: 'Loading Please Wait...',
//             allowOutsideClick: false,
//             onBeforeOpen: () => {
//                 Swal.showLoading();
//             }
//         });

//         $.ajax({
//             url: "<?=base_url();?>orders/proAPICreateShipment",
//             type: "POST",
//             data: { id: id },
//             dataType: 'json',
//             success: function (data) {
//                 Swal.close();
//                    if (data.status=='success') {
//                     Swal.fire({
//                         icon: 'success',
//                         title: 'Success!',
//                         text: data.message
//                     });
//                      $("#table-responsive").jsGrid("loadData");
//                 } else {
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Oops...',
//                         text: data.message
//                     });
//                 }
//             },
//             error: function () {
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Oops...',
//                     text: 'Error occurred while fetching data!'
//                 });
//             }
//         });
//     }
// }



function printManageShipCancel(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You are about to cancel the shipment for this order. This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, cancel it!'
    }).then((result) => {
        if (result.isConfirmed) {
            proceedWithCancellation(id);
        }
    });
}
function printManageShipReturnCancel(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You are about to cancel the shipment for this order. This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, cancel it!'
    }).then((result) => {
        if (result.isConfirmed) {
            proceedWithCancellationReturn(id);
        }
    });
}


function proceedWithCancellationReturn(id) {
    if (id === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'You cannot cancel shipment for this order!'
        });
    } else {
        Swal.fire({
            title: 'Loading Please Wait...',
            allowOutsideClick: false,
            onBeforeOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: "<?=base_url();?>orders/proceedWithCancellationReturn",
            type: "POST",
            data: { id: id },
            dataType: 'json',
            success: function (data) {
                Swal.close();
                if (data.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message
                    });
                    $("#table-responsive").jsGrid("loadData");
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error occurred while fetching data!'
                });
            }
        });
    }
}


function proceedWithCancellation(id) {
    if (id === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'You cannot cancel shipment for this order!'
        });
    } else {
        Swal.fire({
            title: 'Loading Please Wait...',
            allowOutsideClick: false,
            onBeforeOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: "<?=base_url();?>orders/proAPICancelShipment",
            type: "POST",
            data: { id: id },
            dataType: 'json',
            success: function (data) {
                Swal.close();
                if (data.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message
                    });
                    $("#table-responsive").jsGrid("loadData");
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error occurred while fetching data!'
                });
            }
        });
    }
}


    
                    //   function printPopUpShipment(waybill){
                    //     if (waybill === 0) {
                    //         Swal.fire({
                    //             icon: 'error',
                    //             title: 'Oops...',
                    //             text: 'Way bill not generated!'
                    //         })
                    //     }else{
                    //         $.ajax({
                    //             url:"<?=base_url();?>orders/proAPIPrintLabel",
                    //             type:"POST",
                    //             data:{waybill:waybill},
                    //             success:function(data){
                    //                 if(data=='FALSE')
                    //                 {

                    //                 }else{
                    //                  var newwindow = window.open(data, 'height=1000,width=950');
                    //                     if (window.focus) {
                    //                         newwindow.focus();
                    //                     }
                    //                     return false;   
                    //                 }
                    //             }
                    //         })
                           
                    //     }
                    // }
                    // function printPopUpShip(id){
                    //     if (id === 0) {
                    //         Swal.fire({
                    //             icon: 'error',
                    //             title: 'Oops...',
                    //             text: 'You cannot print bill for this order!'
                    //         })
                    //     }else{
                    //         var newwindow = window.open('orders/print/shipbill/'+id, '', 'height=1000,width=950');
                    //         if (window.focus) {
                    //             newwindow.focus();
                    //         }
                    //         return false;
                    //     }
                    // } 

                    var product_list = function () {
                        var tmp = null;
                        $.ajax({
                            'async': false,
                            'type': "POST",
                            'global': false,
                            'url': "orders/getOrderStatus",
                            'success': function (data) {
                                tmp = data;
                                var ele = document.getElementById('product_list_add_new');
                                $.each(JSON.parse(data), function(index,value){
                                    ele.innerHTML = ele.innerHTML + '<option value="' + value.id + '">' + value.name + '</option>';
                                });
                            }
                        });
                        return tmp;
                    }();

                    $("#table-responsive").jsGrid({
                        filtering: true,
                        width: "100%",
                        height:"auto", 
                        sorting:true,
                        paging:true,
                        pageLoading: true,
                        autoload:true,
                        pageSize:10,
                        pageButtonCount: 5,
                        controller: {
                            loadData :  function(filter){
                                var d = $.Deferred();
                                $.ajax({
                                    type:"GET",
                                    url: "orders/getOrders",
                                    data: {filter:filter,shop_id:"<?php echo $user->id;?>"},
                                    dataType: "json"
                                }).done(function(response) {
                                    d.resolve(response);
                                });
                                return d.promise();
                            },
                           
                        },
                        fields: [
                            {
                                name:"id",
                                type:"hidden",
                                css:"hide"
                            },
                            {
                                name: "order_id",
                                title: "ID",
                                itemTemplate: function(val ) { 
                                    // return $("<a>").attr("href", 'orders/'+val.row_id).text(val.order);
                                    return $("<a>").attr({
                                    href: 'orders/orderDetails/'+val.row_id,
                                    target: '_blank',
                                    }).text(val.order);
                                    
                                },
                                align: "center",
                                width: 120
                            },
                            {
                                name: "orderid",
                                title: "Order ID",
                                itemTemplate: function(val ) {
                                    return $("<p>").text(val);
                                },
                                align: "center",
                                width: 120
                                 
                            },
                            // {
                            //     name: "invoice_no",
                            //     title: "Bill No",
                            //     itemTemplate: function(val ) {
                            //         return $("<p>").text(val);
                            //     },
                            //     align: "center",
                            //     width: 120
                            // },
                            // {
                            //     name: "shop_name",
                            //     title: "Shop Name",
                            //     itemTemplate: function(val ) {
                            //         return $("<p>").text(val);
                            //     },
                            //     align: "center",
                            //     width: 120
                            // },
                            {
                                name: "customer_name",
                                title: "Customer Name",
                                // type: "text",
                                // itemTemplate: function(val ) {
                                //     return $("<p>").text(val);
                                // },
                                align: "center",
                                width: 120
                            },
                            {
                                name: "order_date",
                                title: "Order Date",
                                itemTemplate: function(val ) {
                                    return $("<p>").text(val);
                                },
                                align: "center",
                                width: 120
                            },
                            // {
                            //     name: "delivery_slot",
                            //     title: "Delivery Slot",
                            //     itemTemplate: function(val ) {
                            //         return $("<p>").text(val);
                            //     },
                            //     align: "center",
                            //     width: 120
                            // },
                            {
                                name: "total_value",
                                title: "Total Value",
                                itemTemplate: function(val ) {
                                    return $("<p>").text(val);
                                },
                                align: "center",
                                width: 120
                            },
                            // {
                            //     name: "total_savings",
                            //     title: "Total Savings",
                            //     itemTemplate: function(val ) {
                            //         return $("<p>").text(val);
                            //     },
                            //     align: "center",
                            //     width: 120
                            // },
                            // {
                            //     name: "payment_method",
                            //     title: "Payment Method",
                            //     itemTemplate: function(val ) {
                            //         return $("<p>").text(val);
                            //     },
                            //     align: "center",
                            //     width: 120
                            // },
                            {
                                name: "status_name",
                                title: "Status",
                                // type: "select",
                                // width: 100,
                                // items:  JSON.parse(product_list),
                                // valueField: "id",
                                // textField: "name",
                                // validate:"required"
                            },
                            // {
                            //     name: "delivery_boy",
                            //     title: "Delivery Boy",
                            //     itemTemplate: function(val ) {
                            //         if (val.delivery_boy) {
                            //             return $("<p id='delivery_boy"+val.row_id+"' delivery_boy='"+val.delivery_boy_id+"'>").attr("onclick","delivery_boy("+val.row_id+","+val.status+")").append(val.delivery_boy);
                            //         }
                            //         else{
                            //             return $("<p id='delivery_boy"+val.row_id+"' >").attr("onclick","delivery_boy("+val.row_id+","+val.status+")").append('<i class="mdi mdi-plus text-warning" style="font-size:30px;"></i>');
                            //             // return val
                            //         }
                                    
                            //     },
                            //     align: "center",
                            //     width: 120
                            //     // type: "select",
                            //     // width: 100,
                            //     // items:  JSON.parse(product_list),
                            //     // valueField: "id",
                            //     // textField: "name",
                            //     // validate:"required"
                            // },
                            {
                                name: "print_bill",
                                title: "Print Bill",
                                itemTemplate: function(val ) {
                                    return $("<p>").attr("onclick","printPopUp("+val.row_id+")").append('<i class="mdi mdi-printer text-warning" style="font-size:30px;"></i>');
                                },
                                align: "center",
                                width: 120
                            },
                            // {
                            //     name: "print_shipto_bill",
                            //     title: "To Print Slip",
                            //     itemTemplate: function(val ) {
                            //         return $("<p>").attr("onclick","printPopUpShip("+val.row_id+")").append('<i class="mdi mdi-file text-warning" style="font-size:30px;"></i>');
                            //     },
                            //     align: "center",
                            //     width: 120
                            // },
                             {
                                name: "print_shipto_bill",
                                title: "To Print Slip",
                                itemTemplate: function(val) {
                                    return $("<p>").attr("onclick","printPopUpShipment(" + val.order + ", '" + val.waybill + "')").append('<i class="mdi mdi-file text-warning" style="font-size:30px;"></i>');
                                },
                                align: "center",
                                width: 120
                            },
                             {
                                name: "manage_shipment",
                                title: "Manage Forward Shipment",
                                itemTemplate: function(val ) {
                                    if(val.waybill_cancel){
                                        return $("<p>").attr("onclick","printManageShipCancelled("+val.row_id+")").append('<button class="btn btn-sm btn-info">Cancelled '+val.waybill+'</button>');
                                    }else{
                                    if(val.waybill){
                                    return $("<p>")
                                    .append(
                                        $('<button class="btn btn-sm btn-success">Created ' + val.waybill + '</button>')
                                            .attr("onclick", "printManageShipAlready(" + val.row_id + ")")
                                    )
                                    .append(
                                        $('<button class="btn mt-2 btn-sm btn-warning">Cancel Shipment</button>')
                                            .attr("onclick", "printManageShipCancel(" + val.row_id + ")")
                                    );
                                    }else
                                    {
                                        if(val.is_order=='17'){
                                       return $("<p>").attr("onclick","printManageShipCreate("+val.row_id+")").append('<button class="btn btn-sm btn-danger">Create Shipment</button>');
                                       }else
                                       {
                                        return "NA";
                                       }   
                                    }
                                   }
                                },
                                align: "center",
                                width: 120
                            },
                              {
                                name: "manage_return_shipment",
                                title: "Manage Return Shipment",
                                itemTemplate: function(val ) {
                                    if(val.waybill_cancel){
                                        return $("<p>").attr("onclick","printManageShipReturnCancelled("+val.row_id+")").append('<button class="btn btn-sm btn-info">Cancelled '+val.waybill+'</button>');
                                    }else{
                                    if(val.waybill){
                                    return $("<p>")
                                    .append(
                                        $('<button class="btn btn-sm btn-success">Created ' + val.waybill + '</button>')
                                            .attr("onclick", "printManageShipReturnAlready(" + val.row_id + ")")
                                    )
                                    .append(
                                        $('<button class="btn mt-2 btn-sm btn-warning">Cancel Shipment</button>')
                                            .attr("onclick", "printManageShipReturnCancel(" + val.row_id + ")")
                                    );
                                    }else
                                    {
                                        if(val.is_order=='7'){
                                       return $("<p>").attr("onclick","printManageReturnShipCreate("+val.row_id+")").append('<button class="btn btn-sm btn-danger">Create Shipment</button>');
                                       }else
                                       {
                                        return "NA";
                                       }   
                                    }
                                   }
                                },
                                align: "center",
                                width: 120
                            }
                        ],
                    });

                </script>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <div class="right-sidebar" style="">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Advanced Filters <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                <li class="float-right"  style="padding-bottom:20px;">
                                        <button class="btn btn-warning clear-filter">Clear All</button>
                                        <button class="btn btn-primary apply-filter">Apply Filters</button>
                                </li>
                                <li><b>Filter By Date</b></li>
                                <li>
                                    <div class="form-group">
                                        <label for="example-date-input" class="col-2 col-form-label">From</label>
                                        <div class="col-10">
                                            <input class="form-control form-control-sm" type="date" value="<?php if(isset($_SESSION['order_table_filters']['from_date'])){ echo $_SESSION['order_table_filters']['from_date'];} ?>" id="from-date">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        <label for="example-date-input" class="col-2 col-form-label">To</label>
                                        <div class="col-10">
                                            <input class="form-control form-control-sm" type="date" value="<?php if(isset($_SESSION['order_table_filters']['to_date'])){ echo $_SESSION['order_table_filters']['to_date']; }?>" id="end-date">
                                        </div>
                                    </div>
                                </li>
                                <li class="d-block m-t-30"><b>Order Status</b>
                            </li>
                                <li style="width: 100%">
                                    <select class="select" id="order-status" style="width: 100%" data-placeholder="Choose">
                                        <option value="">Select Order Status</option>
                                    <?php
                                        if(isset($orderStatus) && $orderStatus!==FALSE){ ?>
                                           
                                            <?php foreach ($orderStatus as $status) { ?>
                                                <option value="<?php echo $status['id']; ?>" <?php if(isset($_SESSION['order_table_filters']['status_ids']) &&  $status['id'] == $_SESSION['order_table_filters']['status_ids'][0]) {echo "selected"; } ?>>
                                                    <?php echo $status['name']; ?>
                                                </option>
                                                <?php } } ?>
                                    </select>
                                </li>
                                <li class="d-block m-t-30"><b>Payment Method</b></li>
                                <li style="width: 100%">
                                    <select class="select" id="payment-method" style="width: 100%" data-placeholder="Choose">
                                    <option value="">Select</option>
                                    <option value="cod" <?php if(isset($_SESSION['order_table_filters']['payment_method'])){if($_SESSION['order_table_filters']['payment_method'] == 'cod'){echo "selected";}

                                    }?>>COD</option>
                                    <option value="online" <?php if(isset($_SESSION['order_table_filters']['payment_method'])){if($_SESSION['order_table_filters']['payment_method'] == 'online'){echo "selected";}

                                    }?>>Online</option>
                                        <!-- <?php
                                            if($orderPaymentStatusMaster!==FALSE){
                                                foreach($orderPaymentStatusMaster as $paymentmode){
                                                    echo '<option value="'.$paymentmode['name'].'">'.$paymentmode['name'].'</option>';
                                                }
                                            }
                                        ?> -->
                                   </select>
                                </li>
                                <li>
                                    <div class="form-group">
                                        <label for="example-date-input" class="col-2 col-form-label"><b>Customer Mobile</b></label>
                                        <div class="col-10">
                                            <input class="form-control form-control-sm" type="text" value="<?php if(isset($_SESSION['order_table_filters']['customer_mobile'])){ echo $_SESSION['order_table_filters']['customer_mobile']; }?>" id="customer-mobile">
                                        </div>
                                    </div>
                                </li>
                                <li class="float-right"  style="padding-top:20px;">
                                    <button class="btn btn-warning clear-filter">Clear All</button>
                                    <button class="btn btn-primary apply-filter">Apply Filters</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <script>
                    $('.apply-filter').click(function(e){
                        $.ajax({
                                type:"POST",
                                url: "orders/setOrderSessionFilters",
                                data: {start_date: $('#from-date').val(),end_date: $('#end-date').val(),status: $('#order-status option:selected').val(),payment_method:$('#payment-method option:selected').val(),delivery_boy:$('#delivery-boy option:selected').val(),customer_mobile: $('#customer-mobile').val()},
                                'success': function (data) {
                                    $("#table-responsive").jsGrid("loadData");
                                }
                            });
                    });
                    $('.clear-filter').click(function(e){
                        $('#from-date').val('');
                        $('#end-date').val('');
                        $('#order-status').val('');
                        $('#payment-method').val('');
                        $.ajax({
                                type:"POST",
                                url: "orders/clearOrderSessionFilters",
                                'success': function (data) {
                                    $("#table-responsive").jsGrid("loadData");
                                }
                            });
                    });

                    function delivery_boy(order_id,status) {
                        let delivery_boy_id = $('#delivery_boy'+order_id).attr('delivery_boy');
                        $('#assign_delivery_boy').modal('show');
                        $('.assign_delivery_boy')[0].reset();
                        $('#d_order_id').val(order_id);
                        $('[name=assign_delivery_boy]').prop('disabled',true);
                        $('.assign_delivery_boy [type=submit]').addClass('d-none');
                       
                        if (status=='17' || status=='2' || status =='3' || status=='20') {
                            $('[name=assign_delivery_boy]').prop('disabled',false);
                            $('[name=assign_delivery_boy]').val(delivery_boy_id);
                            $('.assign_delivery_boy [type=submit]').removeClass('d-none');
                        }
                        
                        return false;
                    }

                    $('body').on('submit','.assign_delivery_boy',function(){
                        let $this = $(this);
                        let id = $('#d_order_id').val();
                        let delivery_boy_id = $('[name=assign_delivery_boy]').val();
                        let name = $('[name=assign_delivery_boy] option:selected').text();
                        $.ajax({
                            url:'orders/assign_delivery_boy',
                            type:'POST',
                            data:$this.serialize(),
                            dataType:'JSON',
                            success:function(data) {
                                if (data.res=='success') {
                                    $('#delivery_boy'+id).text(name);
                                    $('#delivery_boy'+id).attr('delivery_boy',delivery_boy_id);
                                }
                                alert(data.msg);
                                $('#assign_delivery_boy').modal('hide');
                            }
                        })
                    })
                </script>
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
<div class="modal " id="assign_delivery_boy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign Delivery Boy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="javascript:void(0)" class="assign_delivery_boy">
          <div class="form-group">
            <input type="hidden" class="form-control form-control-sm" name="order_id" id="d_order_id" >
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Delivery Boy</label>
            <select name="assign_delivery_boy" class="form-control form-control-sm">
                <option value="">-- Select --</option>
                <?php foreach ($delivery_boys as $dbrow) { ?>
                    <option value="<?=$dbrow->id?>"><?=$dbrow->full_name?> (<?=$dbrow->contact_number?>)</option>
                <?php } ?>
            </select>
          </div>

          <div class="form-group text-right">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
          
          
        </form>
      </div>
    </div>
  </div>
</div>