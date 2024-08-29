<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'welcome';
$route['logout'] = 'welcome/logout';
$route['stock'] = 'stocks/stock_category';
$route['stock/(:num)'] = 'stocks/stock_category';
$route['stock/stock_sub_category/(:num)'] = 'stocks/stock_sub_category/$1';
$route['stock/category/(:num)'] = 'stocks/show_stocks/$1';
$route['stock/product_list'] = 'stocks/product_list';
$route['stock/vendor_list'] = 'stocks/vendor_list';
$route['stock/getStockData'] = 'stocks/getStockData';
$route['stock/updateCustomStockData'] = 'stocks/updateCustomStockData';
$route['stock/deleteStockData'] = 'stocks/deleteStockData';

// New Purchase

$route['purchase/(:num)'] 						= 'stocks/Purchase';
$route['purchase/(:any)'] 						= 'stocks/Purchase/$1';
$route['purchase/(:any)/(:any)'] 				= 'stocks/Purchase/$1/$2';
$route['purchase/(:any)/(:any)/(:any)'] 		= 'stocks/Purchase/$1/$2/$3';
$route['purchase/(:any)/(:any)/(:any)/(:any)'] = 'stocks/Purchase/$1/$2/$3/$4';


$route['purchases/(:num)'] 						= 'stocks/purchases';
$route['purchases/(:any)'] 						= 'stocks/purchases/$1';
$route['purchases/(:any)/(:any)'] 				= 'stocks/purchases/$1/$2';
$route['purchases/(:any)/(:any)/(:any)'] 		= 'stocks/purchases/$1/$2/$3';
$route['purchases/(:any)/(:any)/(:any)/(:any)'] = 'stocks/purchases/$1/$2/$3/$4';

$route['sales/(:num)'] 						= 'sale_return/sales';
$route['sales/(:any)'] 						= 'sale_return/sales/$1';
$route['sales/(:any)/(:any)'] 				= 'sale_return/sales/$1/$2';
$route['sales/(:any)/(:any)/(:any)'] 		= 'sale_return/sales/$1/$2/$3';
$route['sales/(:any)/(:any)/(:any)/(:any)'] = 'sale_return/sales/$1/$2/$3/$4';

$route['product-barcode/(:num)'] 						= 'master/productBarcode';
$route['product-barcode/(:any)'] 						= 'master/productBarcode/$1';
$route['product-barcode/(:any)/(:num)'] 				= 'master/productBarcode/$1/$2';
$route['product-barcode/(:any)/(:num)/(:num)'] 		= 'master/productBarcode/$1/$2/$3';
$route['product-barcode/(:any)/(:num)/(:num)/(:num)'] = 'master/productBarcode/$1/$2/$3/$4';
	

$route['shop-login'] = 'Welcome/shop_login';

$route['sales-purchase/(:num)'] = 'submenu/index/$1';

$route['orders/(:num)'] = 'orders';
$route['orders'] = 'orders/index';
$route['orders/print/bill/(:num)'] = 'orders/orderPrintBill/$1';
$route['orders/print/shipbill/(:num)'] = 'orders/orderPrintShipBill/$1';
$route['orders/(:any)(:num)'] = 'orders/orderDetails/$1';
$route['assign-delivery-boy/(:num)'] = 'orders/assign_delivery_boy/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Admin routes
$route['admin'] = 'admin';
// $route['admin-login'] = 'admin/admin_login';
$route['admin-login'] = 'admin/adminlogin/admin';
$route['admin-logout'] = 'admin/admin_logout';
$route['admin-dashboard'] = 'admin/admin_dashboard';
$route['admin-profile'] = 'admin/admin_profile';
$route['edit-admin-profile/(:num)'] = 'admin/edit_admin_profile';
$route['admin-change-password'] = 'admin/admin_change_password';
$route['update-admin-password'] = 'admin/update_admin_password';

$route['shop-login-new'] = 'welcome/shop_login_new/shop';
$route['shop-dashboard'] = 'welcome/dashboard';
$route['shop-dashboard-total'] = 'welcome/dashboard_total';

//Master Routes
// $route['master-data/(:any)'] = 'master/check_role_menu';
$route['master-data/(:num)'] = 'master';
$route['master-data/(:any)'] = 'master/$1';
$route['master-data/(:any)/(:any)'] = 'master/$1/$2';
$route['master-data/(:any)/(:any)/(:any)'] = 'master/$1/$2/$3';
$route['master-data/(:any)/(:any)/(:any)/(:any)'] = 'master/$1/$2/$3/$4';
$route['master-data/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'master/$1/$2/$3/$4/$5';

$route['categories/(:num)'] = 'master/categories';
$route['categories'] = 'master/categories';
$route['categories/(:any)'] 						= 'master/categories/$1';
$route['categories/(:any)/(:num)'] 				= 'master/categories/$1/$2';

// $route['add-category'] 				= 'master/add_category';
// $route['edit-category/(:num)'] 		= 'master/edit_category';
// $route['delete-category/(:num)'] 	= 'master/delete_category';

// $route['remote/(:any)'] 		= 'master/remote/$1';
// $route['remote/(:any)/(:any)'] 	= 'master/remote/$1/$2';
// $route['remote/(:any)/(:any)/(:any)'] = 'master/remote/$1/$2/$3';

$route['adminremote/(:any)'] 		= 'admin/adminremote/$1';
$route['adminremote/(:any)/(:any)'] 	= 'admin/adminremote/$1/$2';
$route['adminremote/(:any)/(:any)/(:any)'] = 'admin/adminremote/$1/$2/$3';

$route['society_remote/(:any)'] 		= 'master/society_remote/$1';
$route['society_remote/(:any)/(:any)'] 	= 'master/society_remote/$1/$2';
$route['society_remote/(:any)/(:any)/(:any)'] = 'master/society_remote/$1/$2/$3';

$route['subscription_remote/(:any)'] 		= 'Subscription/remote/$1';
$route['subscription_remote/(:any)/(:any)'] 	= 'Subscription/remote/$1/$2';
$route['subscription_remote/(:any)/(:any)/(:any)'] = 'Subscription/remote/$1/$2/$3';

// $route['acl_remote/(:any)'] 		= 'ACL/remote/$1';
// $route['acl_remote/(:any)/(:any)'] 	= 'ACL/remote/$1/$2';
// $route['acl_remote/(:any)/(:any)/(:any)'] = 'ACL/remote/$1/$2/$3';

$route['products/(:num)'] = 'master/products';
$route['products'] = 'master/products';
$route['products/(:any)'] 						= 'master/products/$1';
$route['products/(:any)/(:num)'] 				= 'master/products/$1/$2';
$route['products/(:any)/(:any)/(:num)'] 			= 'master/products/$1/$2/$3';
$route['products/(:any)/(:any)/(:any)'] 			= 'master/products/$1/$2/$3';
$route['products/(:any)/(:any)/(:any)/(:num)'] 	= 'master/products/$1/$2/$3/$4';
$route['products/(:any)/(:any)/(:any)/(:any)'] 	= 'master/products/$1/$2/$3/$4';
$route['products/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'master/products/$1/$2/$3/$4/$5';
$route['products/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'master/products/$1/$2/$3/$4/$5';
$route['products/(:any)/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'master/products/$1/$2/$3/$4/$5/$6';
$route['products/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'master/products/$1/$2/$3/$4/$5/$6';

$route['unit-master/(:num)'] = 'master/unit_master';
$route['product-property/(:num)'] = 'master/product_property';
$route['tax-slab/(:num)'] = 'master/tax_slab';
$route['pincodes-criteria/(:num)'] = 'master/pincodes_criteria';
$route['booking-slots/(:num)'] = 'master/booking_slots';
$route['society/(:num)'] = 'master/society';
$route['home-banners/(:num)'] 				= 'master/home_banners';

$route['home-header/(:num)'] 				= 'master/home_header';
$route['add-home-header'] 				= 'master/add_home_header';
$route['edit-home-header/(:num)'] 		= 'master/edit_home_header';
$route['delete-home-header/(:num)'] 	= 'master/delete_home_header';

$route['product-headers-mapping/(:num)'] 	= 'master/product_headers_mapping';

$route['delete-header-mapping/(:num)'] 	= 'master/delete_header_mapping';
$route['cat-headers-mapping/(:num)'] 	= 'master/cat_headers_mapping';
$route['delete-cat-header-mapping/(:num)'] 	= 'master/delete_cat_header_mapping';

$route['shop-category/(:num)'] = 'master/shop_category';
$route['market-place-home-banners/(:num)'] 				= 'master/market_place_home_banners';
$route['cancellation-reason/(:num)'] = 'master/cancellation_reason';
$route['shop-social/(:num)'] = 'master/shop_social';

//Business Routes
$route['business-store/(:num)'] = 'business';
$route['business-store/(:any)'] = 'business/$1';
$route['business-store/(:any)/(:any)'] = 'business/$1/$2';
$route['business-store/(:any)/(:any)/(:any)'] = 'business/$1/$2/$3';
$route['business-store/(:any)/(:any)/(:any)/(:any)'] = 'business/$1/$2/$3/$4';

// $route['business_remote/(:any)'] 		= 'business/business_remote/$1';
// $route['business_remote/(:any)/(:any)'] 	= 'business/business_remote/$1/$2';
// $route['business_remote/(:any)/(:any)/(:any)'] = 'business/business_remote/$1/$2/$3';

// $route['businesses'] 								= 'business/businesses';
// $route['businesses/(:any)'] 						= 'business/businesses/$1';
// $route['businesses/(:any)/(:num)'] 				= 'business/businesses/$1/$2';
// $route['businesses/(:any)/(:any)/(:num)'] 		= 'business/businesses/$1/$2/$3';
// $route['businesses/(:any)/(:any)/(:any)'] 		= 'business/businesses/$1/$2/$3';
// $route['businesses/(:any)/(:any)/(:any)/(:num)'] 	= 'business/businesses/$1/$2/$3/$4';
// $route['businesses/(:any)/(:any)/(:any)/(:any)'] 	= 'business/businesses/$1/$2/$3/$4';
// $route['businesses/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'business/businesses/$1/$2/$3/$4/$5';
// $route['businesses/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'business/businesses/$1/$2/$3/$4/$5';
// $route['delete-business/(:any)'] 		= 'business/delete_business/';

$route['businesses'] = 'business/businesses';
$route['businesses/(:num)'] = 'business/businesses';
$route['businesses/(:any)'] 						= 'business/businesses/$1';
$route['businesses/(:any)/(:num)'] 				= 'business/businesses/$1/$2';
$route['businesses/(:any)/(:any)/(:num)'] 			= 'business/businesses/$1/$2/$3';
$route['businesses/(:any)/(:any)/(:any)'] 			= 'business/businesses/$1/$2/$3';
$route['businesses/(:any)/(:any)/(:any)/(:num)'] 	= 'business/businesses/$1/$2/$3/$4';
$route['businesses/(:any)/(:any)/(:any)/(:any)'] 	= 'business/businesses/$1/$2/$3/$4';
$route['businesses/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'business/businesses/$1/$2/$3/$4/$5';
$route['businesses/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'business/businesses/$1/$2/$3/$4/$5';
$route['delete-business/(:any)'] 		= 'business/delete_business/';

//shops

$route['shops'] = 'business/shops';
$route['shops/(:num)'] = 'business/shops';
$route['shops/(:any)'] 						= 'business/shops/$1';
$route['shops/(:any)/(:num)'] 				= 'business/shops/$1/$2';
$route['shops/(:any)/(:any)/(:num)'] 			= 'business/shops/$1/$2/$3';
$route['shops/(:any)/(:any)/(:any)'] 			= 'business/shops/$1/$2/$3';
$route['shops/(:any)/(:any)/(:any)/(:num)'] 	= 'business/shops/$1/$2/$3/$4';
$route['shops/(:any)/(:any)/(:any)/(:any)'] 	= 'business/shops/$1/$2/$3/$4';
$route['shops/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'business/shops/$1/$2/$3/$4/$5';
$route['shops/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'business/shops/$1/$2/$3/$4/$5';
$route['shops/(:any)/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'business/shops/$1/$2/$3/$4/$5/$6';
$route['shops/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'business/shops/$1/$2/$3/$4/$5/$6';
$route['delete-shop/(:any)'] 		= 'business/delete_shop/';



//Offers & Coupons Routes
$route['offers-coupons/(:num)'] = 'offers_coupons_admin';
$route['offers-coupons/(:any)'] = 'offers_coupons_admin/$1';
$route['offers-coupons/(:any)/(:any)'] = 'offers_coupons_admin/$1/$2';
$route['offers-coupons/(:any)/(:any)/(:any)'] = 'offers_coupons_admin/$1/$2/$3';
$route['offers-coupons/(:any)/(:any)/(:any)/(:any)'] = 'offers_coupons_admin/$1/$2/$3/$4';

$route['offers/(:num)'] 								= 'offers_coupons_admin/offers';
$route['offers/(:any)'] 						= 'offers_coupons_admin/offers/$1';
$route['offers/(:any)/(:num)'] 				= 'offers_coupons_admin/offers/$1/$2';
$route['offers/(:any)/(:num)/(:num)'] 		= 'offers_coupons_admin/offers/$1/$2/$3';
$route['offers/(:any)/(:num)/(:num)/(:num)'] 	= 'offers_coupons_admin/offers/$1/$2/$3/$4';

//coupons

$route['coupons/(:num)'] 								= 'offers_coupons_admin/coupons';
$route['coupons/(:any)'] 						= 'offers_coupons_admin/coupons/$1';
$route['coupons/(:any)/(:num)'] 				= 'offers_coupons_admin/coupons/$1/$2';
$route['coupons/(:any)/(:num)/(:num)'] 		= 'offers_coupons_admin/coupons/$1/$2/$3';
$route['coupons/(:any)/(:num)/(:num)/(:num)'] 	= 'offers_coupons_admin/coupons/$1/$2/$3/$4';

$route['apply-offer/(:num)'] = 'offers_coupons_admin/apply_offer';
$route['apply-all-varient/(:num)'] = 'offers_coupons_admin/apply_offer_varient';

//Customer Acquisition

$route['customers-acquisition/(:num)'] = 'customers/customers_acquisition';
$route['customers-acquisition/(:any)'] 						= 'customers/customers_acquisition/$1';
$route['customers-acquisition/(:any)/(:num)'] 				= 'customers/customers_acquisition/$1/$2';
$route['customers-acquisition/(:any)/(:any)/(:num)'] 			= 'customers/customers_acquisition/$1/$2/$3';
$route['customers-acquisition/(:any)/(:any)/(:any)'] 			= 'customers/customers_acquisition/$1/$2/$3';
$route['customers-acquisition/(:any)/(:any)/(:any)/(:num)'] 	= 'customers/customers_acquisition/$1/$2/$3/$4';
$route['customers-acquisition/(:any)/(:any)/(:any)/(:any)'] 	= 'customers/customers_acquisition/$1/$2/$3/$4';
$route['customers-acquisition/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'customers/customers_acquisition/$1/$2/$3/$4/$5';
$route['customers-acquisition/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'customers/customers_acquisition/$1/$2/$3/$4/$5';


$route['vendors/(:num)'] 								= 'master/vendors';
$route['vendors/(:any)'] 						= 'master/vendors/$1';
$route['vendors/(:any)/(:num)'] 				= 'master/vendors/$1/$2';
$route['vendors/(:any)/(:num)/(:num)'] 		= 'master/vendors/$1/$2/$3';
$route['vendors/(:any)/(:num)/(:num)/(:num)'] 	= 'master/vendors/$1/$2/$3/$4';

$route['brand-master/(:num)'] = 'master/brand_master';
$route['add-brand'] = 'master/add_brand';
$route['edit-brand/(:num)'] = 'master/edit_brand';
$route['delete-brand/(:num)'] = 'master/delete_brand';

$route['flavour-master/(:num)'] = 'master/flavour_master';
$route['add-flavour'] = 'master/add_flavour';
$route['edit-flavour/(:num)'] = 'master/edit_flavour';
$route['delete-flavour/(:num)'] = 'master/delete_flavour';

//****************SHOP ROUTES******************//
$route['shop-change-password'] = 'welcome/shop_change_password';
$route['update-shop-password'] = 'welcome/update_shop_password';

//offer coupons
$route['coupons-offers/(:num)'] = 'Coupons_offers';
$route['coupons-offers/(:any)'] = 'Coupons_offers/$1';
$route['coupons-offers/(:any)/(:any)'] = 'Coupons_offers/$1/$2';
$route['coupons-offers/(:any)/(:any)/(:any)'] = 'Coupons_offers/$1/$2/$3';
$route['coupons-offers/(:any)/(:any)/(:any)/(:any)'] = 'Coupons_offers/$1/$2/$3/$4';
// $route['coupons-offers/(:num)'] = 'Coupons_offers/detailsPage/$1';

$route['coupons_offers_remote/(:any)'] 		= 'Coupons_offers/coupons_offers_remote/$1';
$route['coupons_offers_remote/(:any)/(:any)'] 	= 'Coupons_offers/coupons_offers_remote/$1/$2';
$route['coupons_offers_remote/(:any)/(:any)/(:any)'] = 'Coupons_offers/coupons_offers_remote/$1/$2/$3';

$route['shop-offers/(:num)'] 								= 'Coupons_offers/shop_offers';
$route['shop-offers/(:any)'] 						= 'Coupons_offers/shop_offers/$1';
$route['shop-offers/(:any)/(:num)'] 				= 'Coupons_offers/shop_offers/$1/$2';
$route['shop-offers/(:any)/(:num)/(:num)'] 		= 'Coupons_offers/shop_offers/$1/$2/$3';
$route['shop-offers/(:any)/(:num)/(:num)/(:num)'] 	= 'Coupons_offers/shop_offers/$1/$2/$3/$4';

//coupons

$route['shop-coupons/(:num)'] 								= 'Coupons_offers/shop_coupons';
$route['shop-coupons/(:any)'] 						= 'Coupons_offers/shop_coupons/$1';
$route['shop-coupons/(:any)/(:num)'] 				= 'Coupons_offers/shop_coupons/$1/$2';
$route['shop-coupons/(:any)/(:num)/(:num)'] 		= 'Coupons_offers/shop_coupons/$1/$2/$3';
$route['shop-coupons/(:any)/(:num)/(:num)/(:num)'] 	= 'Coupons_offers/shop_coupons/$1/$2/$3/$4';

$route['shop-apply-offer/(:num)'] = 'Coupons_offers/shop_apply_offer';

//Master routes
$route['shop-master-data/(:num)'] = 'master_shop';
$route['shop-master-data/(:any)'] = 'master_shop/$1';
$route['shop-master-data/(:any)/(:any)'] = 'master_shop/$1/$2';
$route['shop-master-data/(:any)/(:any)/(:any)'] = 'master_shop/$1/$2/$3';
$route['shop-master-data/(:any)/(:any)/(:any)/(:any)'] = 'master_shop/$1/$2/$3/$4';

$route['shop-home-banners/(:num)'] 				= 'master_shop/home_banners';

$route['shop-home-header/(:num)'] 				= 'master_shop/home_header';

$route['shop-booking-slots/(:num)'] = 'master_shop/booking_slots';

$route['shop-social-master/(:num)'] = 'master_shop/shop_social';

//Reports
$route['reports/(:num)'] = 'reports';
$route['reports/(:any)'] = 'reports/$1';
$route['reports/(:any)/(:any)'] = 'reports/$1/$2';
$route['reports/(:any)/(:any)/(:any)'] = 'reports/$1/$2/$3';
$route['reports/(:any)/(:any)/(:any)/(:any)'] = 'reports/$1/$2/$3/$4';
// $route['reports/(:num)'] = 'reports';
// $route['reports-data/(:any)'] = 'reports/$1';

$route['stock-report/(:num)'] = 'reports/stock_report';
$route['stock-report/(:any)'] 						= 'reports/stock_report/$1';
$route['stock-report/(:any)/(:num)'] 				= 'reports/stock_report/$1/$2';
$route['stock-report/(:any)/(:any)/(:num)'] 			= 'reports/stock_report/$1/$2/$3';
$route['stock-report/(:any)/(:any)/(:any)'] 			= 'reports/stock_report/$1/$2/$3';
$route['stock-report/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/stock_report/$1/$2/$3/$4';
$route['stock-report/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/stock_report/$1/$2/$3/$4';
$route['stock-report/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/stock_report/$1/$2/$3/$4/$5';
$route['stock-report/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/stock_report/$1/$2/$3/$4/$5';
$route['stock-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/stock_report/$1/$2/$3/$4/$5/$6';

$route['product-stock-report/(:num)'] = 'reports/product_stock_report';
$route['product-stock-report/(:any)'] 						= 'reports/product_stock_report/$1';
$route['product-stock-report/(:any)/(:num)'] 				= 'reports/product_stock_report/$1/$2';
$route['product-stock-report/(:any)/(:any)/(:num)'] 			= 'reports/product_stock_report/$1/$2/$3';
$route['product-stock-report/(:any)/(:any)/(:any)'] 			= 'reports/product_stock_report/$1/$2/$3';
$route['product-stock-report/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/product_stock_report/$1/$2/$3/$4';
$route['product-stock-report/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/product_stock_report/$1/$2/$3/$4';
$route['product-stock-report/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/product_stock_report/$1/$2/$3/$4/$5';
$route['product-stock-report/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/product_stock_report/$1/$2/$3/$4/$5';
$route['product-stock-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/product_stock_report/$1/$2/$3/$4/$5/$6';

$route['sales-report-accounting/(:num)'] = 'reports/sales_report_accounting';
$route['sales-report-accounting/(:any)'] 						= 'reports/sales_report_accounting/$1';
$route['sales-report-accounting/(:any)/(:num)'] 				= 'reports/sales_report_accounting/$1/$2';
$route['sales-report-accounting/(:any)/(:any)/(:num)'] 			= 'reports/sales_report_accounting/$1/$2/$3';
$route['sales-report-accounting/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/sales_report_accounting/$1/$2/$3/$4';
$route['sales-report-accounting/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/sales_report_accounting/$1/$2/$3/$4';
$route['sales-report-accounting/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/sales_report_accounting/$1/$2/$3/$4/$5';
$route['sales-report-accounting/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/sales_report_accounting/$1/$2/$3/$4/$5';
$route['sales-report-accounting/(:any)/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/sales_report_accounting/$1/$2/$3/$4/$5/$6';

$route['product-purchased-report/(:num)'] = 'reports/product_purchased_report';
$route['product-purchased-report/(:any)'] 						= 'reports/product_purchased_report/$1';
$route['product-purchased-report/(:any)/(:num)'] 				= 'reports/product_purchased_report/$1/$2';
$route['product-purchased-report/(:any)/(:any)/(:num)'] 			= 'reports/product_purchased_report/$1/$2/$3';
$route['product-purchased-report/(:any)/(:any)/(:any)'] 			= 'reports/product_purchased_report/$1/$2/$3';
$route['product-purchased-report/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/product_purchased_report/$1/$2/$3/$4';
$route['product-purchased-report/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/product_purchased_report/$1/$2/$3/$4';

$route['tax-report/(:num)'] = 'reports/tax_report';
$route['tax-report/(:any)'] 						= 'reports/tax_report/$1';
$route['tax-report/(:any)/(:num)'] 				= 'reports/tax_report/$1/$2';
$route['tax-report/(:any)/(:any)/(:num)'] 			= 'reports/tax_report/$1/$2/$3';
$route['tax-report/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/tax_report/$1/$2/$3/$4';
$route['tax-report/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/tax_report/$1/$2/$3/$4';
$route['tax-report/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/tax_report/$1/$2/$3/$4/$5';
$route['tax-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/tax_report/$1/$2/$3/$4/$5/$6';


$route['tax/(:num)'] 								= 'reports/tax';
$route['tax/(:any)'] 						= 'reports/tax/$1';
$route['tax/(:any)/(:num)'] 				= 'reports/tax/$1/$2';
$route['tax/(:any)/(:num)/(:num)'] 		= 'reports/tax/$1/$2/$3';
$route['tax/(:any)/(:num)/(:num)/(:num)'] 	= 'reports/tax/$1/$2/$3/$4';


$route['purchase-report/(:num)'] = 'reports/purchase_report';
$route['purchase-report/(:any)'] 						= 'reports/purchase_report/$1';
$route['purchase-report/(:any)/(:num)'] 				= 'reports/purchase_report/$1/$2';
$route['purchase-report/(:any)/(:any)/(:num)'] 			= 'reports/purchase_report/$1/$2/$3';
$route['purchase-report/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/purchase_report/$1/$2/$3/$4';
$route['purchase-report/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/purchase_report/$1/$2/$3/$4';
$route['purchase-report/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/purchase_report/$1/$2/$3/$4/$5';
$route['purchase-report/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/purchase_report/$1/$2/$3/$4/$5';
$route['purchase-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/purchase_report/$1/$2/$3/$4/$5/$6';
$route['purchase-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/purchase_report/$1/$2/$3/$4/$5/$6';
$route['purchase-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/purchase_report/$1/$2/$3/$4/$5/$6/$7';
$route['purchase-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/purchase_report/$1/$2/$3/$4/$5/$6/$7';
$route['purchase-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/purchase_report/$1/$2/$3/$4/$5/$6/$7/$8';
$route['purchase-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/purchase_report/$1/$2/$3/$4/$5/$6/$7/$8';
$route['purchase-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/purchase_report/$1/$2/$3/$4/$5/$6/$7/$8/$9';
$route['purchase-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/purchase_report/$1/$2/$3/$4/$5/$6/$7/$8/$9';
$route['purchase-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/purchase_report/$1/$2/$3/$4/$5/$6/$7/$8/$9/$10';
$route['purchase-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/purchase_report/$1/$2/$3/$4/$5/$6/$7/$8/$9/$10';


$route['sales-report/(:num)'] = 'reports/sales_report';
$route['sales-report/(:any)'] 						= 'reports/sales_report/$1';
$route['sales-report/(:any)/(:num)'] 				= 'reports/sales_report/$1/$2';
$route['sales-report/(:any)/(:any)/(:num)'] 			= 'reports/sales_report/$1/$2/$3';
$route['sales-report/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/sales_report/$1/$2/$3/$4';
$route['sales-report/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/sales_report/$1/$2/$3/$4';
$route['sales-report/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/sales_report/$1/$2/$3/$4/$5';
$route['sales-report/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/sales_report/$1/$2/$3/$4/$5';
$route['sales-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/sales_report/$1/$2/$3/$4/$5/$6';
$route['sales-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/sales_report/$1/$2/$3/$4/$5/$6';
$route['sales-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/sales_report/$1/$2/$3/$4/$5/$6/$7';
$route['sales-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/sales_report/$1/$2/$3/$4/$5/$6/$7';
$route['sales-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/sales_report/$1/$2/$3/$4/$5/$6/$7/$8';
$route['sales-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/sales_report/$1/$2/$3/$4/$5/$6/$7/$8';
$route['sales-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/sales_report/$1/$2/$3/$4/$5/$6/$7/$8/$9';
$route['sales-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/sales_report/$1/$2/$3/$4/$5/$6/$7/$8/$9';
$route['sales-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/sales_report/$1/$2/$3/$4/$5/$6/$7/$8/$9/$10';
$route['sales-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/sales_report/$1/$2/$3/$4/$5/$6/$7/$8/$9/$10';
$route['sales-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'reports/sales_report/$1/$2/$3/$4/$5/$6/$7/$8/$9/$10/$11';
$route['sales-report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/sales_report/$1/$2/$3/$4/$5/$6/$7/$8/$9/$10/$11';


$route['shop-vendors/(:num)'] 						= 'master_shop/vendors';
$route['shop-vendors/(:any)'] 						= 'master_shop/vendors/$1';
$route['shop-vendors/(:any)/(:num)'] 				= 'master_shop/vendors/$1/$2';
$route['shop-vendors/(:any)/(:num)/(:num)'] 		= 'master_shop/vendors/$1/$2/$3';
$route['shop-vendors/(:any)/(:num)/(:num)/(:num)'] 	= 'master_shop/vendors/$1/$2/$3/$4';


$route['delivery-boys/(:num)'] 						= 'master_shop/delivery_boys';
$route['delivery-boys/(:any)'] 						= 'master_shop/delivery_boys/$1';
$route['delivery-boys/(:any)/(:num)'] 				= 'master_shop/delivery_boys/$1/$2';
$route['delivery-boys/(:any)/(:num)/(:num)'] 		= 'master_shop/delivery_boys/$1/$2/$3';
$route['delivery-boys/(:any)/(:num)/(:num)/(:num)'] = 'master_shop/delivery_boys/$1/$2/$3/$4';


$route['shop-product-flags/(:num)'] = 'master_shop/product_flags';
$route['shop-product-flags/(:any)'] 						= 'master_shop/product_flags/$1';
$route['shop-product-flags/(:any)/(:num)'] 				= 'master_shop/product_flags/$1/$2';
$route['shop-product-flags/(:any)/(:any)/(:num)'] 			= 'master_shop/product_flags/$1/$2/$3';
$route['shop-product-flags/(:any)/(:any)/(:any)'] 			= 'master_shop/product_flags/$1/$2/$3';
$route['shop-product-flags/(:any)/(:any)/(:any)/(:num)'] 	= 'master_shop/product_flags/$1/$2/$3/$4';
$route['shop-product-flags/(:any)/(:any)/(:any)/(:any)'] 	= 'master_shop/product_flags/$1/$2/$3/$4';
$route['shop-product-flags/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'master_shop/product_flags/$1/$2/$3/$4/$5';
$route['shop-product-flags/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'master_shop/product_flags/$1/$2/$3/$4/$5';
$route['shop-product-flags/(:any)/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'master_shop/product_flags/$1/$2/$3/$4/$5/$6';
$route['shop-product-flags/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'master_shop/product_flags/$1/$2/$3/$4/$5/$6';

$route['in-inventory/(:num)'] 						= 'master/in_inventory';
$route['in-inventory/(:any)'] 						= 'master/in_inventory/$1';
$route['in-inventory/(:any)/(:any)'] 				= 'master/in_inventory/$1/$2';



$route['shop-profile'] = 'welcome/shop_profile';
$route['edit-shop-profile'] = 'welcome/edit_shop_profile';

//Subscription routes
$route['subscription-data/(:num)'] = 'Subscription';
$route['subscription-data/(:any)'] = 'Subscription/$1';
$route['subscription-data/(:any)/(:any)'] = 'Subscription/$1/$2';
$route['subscription-data/(:any)/(:any)/(:any)'] = 'Subscription/$1/$2/$3';
$route['subscription-data/(:any)/(:any)/(:any)/(:any)'] = 'Subscription/$1/$2/$3/$4';

$route['subscription-plan-types/(:num)'] = 'Subscription/subscription_plan_types';

$route['subscription-slots/(:num)'] = 'Subscription/subscription_slots';

$route['subscriptions'] = 'Shop_subscription/subscription_data';
$route['subscriptions/(:any)'] 						= 'Shop_subscription/subscription_data/$1';
$route['subscriptions/(:any)/(:num)'] 				= 'Shop_subscription/subscription_data/$1/$2';
$route['subscriptions/(:any)/(:any)/(:num)'] 			= 'Shop_subscription/subscription_data/$1/$2/$3';
$route['subscriptions/(:any)/(:any)/(:any)'] 			= 'Shop_subscription/subscription_data/$1/$2/$3';
$route['subscriptions/(:any)/(:any)/(:any)/(:num)'] 	= 'Shop_subscription/subscription_data/$1/$2/$3/$4';
$route['subscriptions/(:any)/(:any)/(:any)/(:any)'] 	= 'Shop_subscription/subscription_data/$1/$2/$3/$4';
$route['subscriptions/(:any)/(:any)/(:any)/(:any)/(:num)'] 	= 'Shop_subscription/subscription_data/$1/$2/$3/$4/$5';
$route['subscriptions/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'Shop_subscription/subscription_data/$1/$2/$3/$4/$5';


//Shop Subscription routes
$route['shop-subscription-data/(:num)'] = 'Shop_subscription_master';
$route['shop-subscription-data/(:any)'] = 'Shop_subscription_master/$1';
$route['shop-subscription-data/(:any)/(:any)'] = 'Shop_subscription_master/$1/$2';


$route['shop-subscription-slots/(:num)'] = 'Shop_subscription_master/subscription_slots';

//Shopzone poratl routes

$route['shopzone-portal/(:num)'] = 'Shopzone_portal';
$route['shopzone-portal/(:any)'] = 'Shopzone_portal/$1';
$route['shopzone-portal/(:any)/(:any)'] = 'Shopzone_portal/$1/$2';
$route['shopzone-portal/(:any)/(:any)/(:any)'] = 'Shopzone_portal/$1/$2/$3';

$route['portal-news/(:num)'] = 'Shopzone_portal/portal_news';
$route['portal-news/(:any)'] 						= 'Shopzone_portal/portal_news/$1';
$route['portal-news/(:any)/(:num)'] 				= 'Shopzone_portal/portal_news/$1/$2';
$route['portal-news/(:any)/(:any)/(:num)'] 			= 'Shopzone_portal/portal_news/$1/$2/$3';


$route['portal-enquiry/(:num)'] = 'Shopzone_portal/portal_enquiry';
$route['portal-enquiry/(:any)'] 						= 'Shopzone_portal/portal_enquiry/$1';
$route['portal-enquiry/(:any)/(:num)'] 				= 'Shopzone_portal/portal_enquiry/$1/$2';
$route['portal-enquiry/(:any)/(:any)/(:num)'] 			= 'Shopzone_portal/portal_enquiry/$1/$2/$3';

$route['shop-enquiry'] = 'Welcome/shop_enquiry';
$route['shop-enquiry/(:any)'] 						= 'Welcome/shop_enquiry/$1';
$route['shop-enquiry/(:any)/(:num)'] 				= 'Welcome/shop_enquiry/$1/$2';
$route['shop-enquiry/(:any)/(:any)/(:num)'] 			= 'Welcome/shop_enquiry/$1/$2/$3';

$route['portal-recaptcha/(:num)'] = 'Shopzone_portal/portal_recaptcha';
$route['portal-recaptcha/(:any)'] 						= 'Shopzone_portal/portal_recaptcha/$1';
$route['portal-recaptcha/(:any)/(:num)'] 				= 'Shopzone_portal/portal_recaptcha/$1/$2';

$route['acl-data/(:num)'] = 'ACL';
$route['acl-data/(:any)'] = 'ACL/$1';
$route['acl-data/(:any)/(:any)'] = 'ACL/$1/$2';
$route['acl-data/(:any)/(:any)/(:any)'] = 'ACL/$1/$2/$3';
$route['acl-data/(:any)/(:any)/(:any)/(:any)'] = 'ACL/$1/$2/$3/$4';


$route['admin-menu/(:num)'] = 'ACL/admin_menu';
$route['admin-menu/(:any)'] = 'ACL/admin_menu/$1';
$route['admin-menu/(:any)'] 						= 'ACL/admin_menu/$1';
$route['admin-menu/(:any)/(:num)'] 				= 'ACL/admin_menu/$1/$2';

$route['users/(:num)'] = 'ACL/users';
$route['users/(:any)'] = 'ACL/users/$1';
$route['users/(:any)/(:num)'] = 'ACL/users/$1/$2';

$route['user-role/(:num)'] = 'ACL/user_role';
$route['user-role/(:any)'] = 'ACL/user_role/$1';
$route['user-role/(:any)'] 						= 'ACL/user_role/$1';
$route['user-role/(:any)/(:num)'] 				= 'ACL/user_role/$1/$2';

// return-policy
$route['return-policy-master/(:num)'] = 'Master/return_policy_master';
$route['return-policy-master/(:any)'] = 'Master/return_policy_master/$1';
$route['return-policy-master/(:any)/(:num)'] = 'Master/return_policy_master/$1/$2';

$route['warehouse-master'] = 'Master_shop/warehouse_master';
$route['warehouse-master/(:num)'] = 'Master_shop/warehouse_master';
$route['warehouse-master/(:any)'] = 'Master_shop/warehouse_master/$1';
$route['warehouse-master/(:any)/(:any)'] = 'Master_shop/warehouse_master/$1/$2';
$route['warehouse-master/(:any)/(:any)/(:any)'] = 'Master_shop/warehouse_master/$1/$2/$3';


$route['shop-pos'] 	= 'pos/pos_data';
$route['shop-pos/(:num)'] 	= 'pos/pos_data';
$route['shop-pos/(:any)'] 	= 'pos/pos_data/$1';
$route['shop-pos/(:any)/(:any)'] 	= 'pos/pos_data/$1/$2';


//Sale & Purchase
$route['sales-purchase/(:num)'] = 'stocks';
$route['sales-purchase/(:any)'] = 'stocks/$1';
$route['sales-purchase/(:any)/(:any)'] = 'stocks/$1/$2';
$route['sales-purchase/(:any)/(:any)/(:any)'] = 'stocks/$1/$2/$3';
$route['sales-purchase/(:any)/(:any)/(:any)/(:any)'] = 'stocks/$1/$2/$3/$4';

$route['pos_orders'] = 'pos_orders/index';
$route['pos_orders/(:num)'] = 'pos_orders/index';
$route['pos_orders/details/(:num)'] = 'pos_orders/orderDetails/$1';
$route['pos_orders/print/bill/(:num)'] = 'pos_orders/orderPrintBill/$1';
$route['pos_orders/print/holdbill/(:num)'] = 'pos_orders/orderPrintBillHold/$1';
$route['pos-orders-details/details/(:num)'] = 'pos_orders/orderDetails/$1';
$route['pos-return-items'] = 'pos_orders/return_items';

$route['pos_orders/proforma-invoice'] = 'pos_orders/proforma_invoice';
$route['purchase_return/(:num)']		= 'purchase_return/index';
$route['sale_return/(:num)']			= 'sale_return/index';
$route['sale_return/(:num)/(:any)']			= 'sale_return/index/$1/$2';

$route['shop-customer/(:num)'] 						= 'master_shop/customer';
$route['shop-customer/(:any)'] 						= 'master_shop/customer/$1';
$route['shop-customer/(:any)/(:num)'] 				= 'master_shop/customer/$1/$2';
$route['shop-customer/(:any)/(:num)/(:num)'] 		= 'master_shop/customer/$1/$2/$3';
$route['shop-customer/(:any)/(:num)/(:num)/(:num)'] = 'master_shop/customer/$1/$2/$3/$4';

$route['bank-accounts-master/(:num)'] = 'master_shop/bank_accounts';
$route['cash-account/(:num)'] = 'master_shop/cash_account';


//Transactions
$route['transactions/(:num)'] = 'Cash_register';
$route['transactions/(:any)'] = 'Cash_register/$1';
$route['transactions/(:any)/(:any)'] = 'Cash_register/$1/$2';
$route['transactions/(:any)/(:any)/(:any)'] = 'Cash_register/$1/$2/$3';
$route['transactions/(:any)/(:any)/(:any)/(:any)'] = 'Cash_register/$1/$2/$3/$4';


$route['bank-register/(:num)']		= 'Cash_register/bank';
$route['bank-register/(:any)']		= 'Cash_register/bank/$1';
$route['bank-register/(:any)/(:any)']		= 'Cash_register/bank/$1/$2';
$route['bank-register/(:any)/(:any)/(:any)']		= 'Cash_register/bank/$1/$2/$3';
$route['bank-register/(:any)/(:any)/(:any)/(:any)']		= 'Cash_register/bank/$1/$2/$3/$4';
$route['bank-register/(:any)/(:any)/(:any)/(:any)/(:any)']		= 'Cash_register/bank/$1/$2/$3/$4/$5';
$route['bank-register/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']		= 'Cash_register/bank/$1/$2/$3/$4/$5/$6';
$route['bank-register/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']		= 'Cash_register/bank/$1/$2/$3/$4/$5/$6/$7';
$route['bank-register/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']		= 'Cash_register/bank/$1/$2/$3/$4/$5/$6/$7/$8';
$route['bank-register/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']		= 'Cash_register/bank/$1/$2/$3/$4/$5/$6/$7/$8/$9';

$route['cash-register/(:num)']		= 'Cash_register/cash';
$route['cash-register/(:any)']		= 'Cash_register/cash/$1';
$route['cash-register/(:any)/(:any)']		= 'Cash_register/cash/$1/$2';
$route['cash-register/(:any)/(:any)/(:any)']		= 'Cash_register/cash/$1/$2/$3';
$route['cash-register/(:any)/(:any)/(:any)/(:any)']		= 'Cash_register/cash/$1/$2/$3/$4';
$route['cash-register/(:any)/(:any)/(:any)/(:any)/(:any)']		= 'Cash_register/cash/$1/$2/$3/$4/$5';
$route['cash-register/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']		= 'Cash_register/cash/$1/$2/$3/$4/$5/$6';
$route['cash-register/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']		= 'Cash_register/cash/$1/$2/$3/$4/$5/$6/$7';
$route['cash-register/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']		= 'Cash_register/cash/$1/$2/$3/$4/$5/$6/$7/$8';
$route['cash-register/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']		= 'Cash_register/cash/$1/$2/$3/$4/$5/$6/$7/$8/$9';


$route['expense/(:num)']		= 'Cash_register/expense';
$route['expense/(:any)']		= 'Cash_register/expense/$1';
$route['expense/(:any)/(:any)']		= 'Cash_register/expense/$1/$2';
$route['expense/(:any)/(:any)/(:any)']		= 'Cash_register/expense/$1/$2/$3';
$route['expense/(:any)/(:any)/(:any)/(:any)']		= 'Cash_register/expense/$1/$2/$3/$4';
$route['expense/(:any)/(:any)/(:any)/(:any)/(:any)']		= 'Cash_register/expense/$1/$2/$3/$4/$5';
$route['expense/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']		= 'Cash_register/expense/$1/$2/$3/$4/$5/$6';
$route['expense/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']		= 'Cash_register/expense/$1/$2/$3/$4/$5/$6/$7';
$route['expense/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']		= 'Cash_register/expense/$1/$2/$3/$4/$5/$6/$7/$8';
$route['expense/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']		= 'Cash_register/expense/$1/$2/$3/$4/$5/$6/$7/$8/$9';


$route['ledgers/(:num)'] 								= 'ledger';
$route['ledgers/(:any)'] 						= 'ledger/$1';
$route['ledgers/(:any)/(:num)'] 				= 'ledger/$1/$2';
$route['ledgers/(:any)/(:num)/(:num)'] 		= 'ledger/$1/$2/$3';
$route['ledgers/(:any)/(:num)/(:num)/(:num)'] 	= 'ledger/$1/$2/$3/$4';

$route['ledger/(:num)'] 								= 'ledger/ledger';
$route['ledger/(:any)'] 						= 'ledger/ledger/$1';
$route['ledger/(:any)/(:num)'] 				= 'ledger/ledger/$1/$2';
$route['ledger/(:any)/(:num)/(:num)'] 		= 'ledger/ledger/$1/$2/$3';
$route['ledger/(:any)/(:num)/(:num)/(:num)'] 	= 'ledger/ledger/$1/$2/$3/$4';

$route['party-ledger/(:num)'] 	= 'ledger/partywise';
$route['party-ledger/(:any)'] 	= 'ledger/partywise/$1';
$route['party-ledger/(:any)/(:any)'] 		= 'ledger/partywise/$1/$2';

$route['bank-ledger/(:num)'] 	= 'ledger/bank';
$route['bank-ledger/(:any)'] 	= 'ledger/bank/$1';
$route['bank-ledger/(:any)/(:any)'] 		= 'ledger/bank/$1/$2';

$route['cash-ledger/(:num)'] 	= 'ledger/cash';
$route['cash-ledger/(:any)'] 	= 'ledger/cash/$1';
$route['cash-ledger/(:any)/(:any)'] 		= 'ledger/cash/$1/$2';

$route['registers/(:num)'] 			     		= 'reports/register';
$route['registers/(:any)'] 						= 'reports/register/$1';
$route['registers/(:any)/(:num)'] 				= 'reports/register/$1/$2';
$route['registers/(:any)/(:num)/(:num)'] 		= 'reports/register/$1/$2/$3';
$route['registers/(:any)/(:num)/(:num)/(:num)'] = 'reports/register/$1/$2/$3/$4';



$route['pos-sale-register'] = 'reports/pos_sales_report';
$route['pos-sale-register/(:num)'] = 'reports/pos_sales_report';
$route['pos-sale-register/(:any)'] 						= 'reports/pos_sales_report/$1';
$route['pos-sale-register/(:any)/(:any)'] 				= 'reports/pos_sales_report/$1/$2';
$route['pos-sale-register/(:any)/(:any)/(:any)'] 			= 'reports/pos_sales_report/$1/$2/$3';
$route['pos-sale-register/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/pos_sales_report/$1/$2/$3/$4';
$route['pos-sale-register/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/pos_sales_report/$1/$2/$3/$4';
$route['pos-sale-register/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/pos_sales_report/$1/$2/$3/$4/$5/$6';
$route['pos-sale-register/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/pos_sales_report/$1/$2/$3/$4/$5/$6/$7';
$route['pos-sale-register/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/pos_sales_report/$1/$2/$3/$4/$5/$6/$7/$8';
$route['pos-sale-register/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/pos_sales_report/$1/$2/$3/$4/$5/$6/$7/$8/$9';
$route['pos-sale-register/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/pos_sales_report/$1/$2/$3/$4/$5/$6/$7/$8/$9/$10';
$route['pos-sale-register/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/pos_sales_report/$1/$2/$3/$4/$5/$6/$7/$8/$9/$10/$11';
$route['pos-sale-register/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'reports/pos_sales_report/$1/$2/$3/$4/$5/$6/$7/$8/$9/$10/$11/$12';
// portal-sale-register
$route['sale-purchase-return-report/(:num)']		= 'sale_return/report';
$route['sale-purchase-return-report/(:any)']		= 'sale_return/report/$1';
$route['sale-purchase-return-report/(:any)/(:any)']		= 'sale_return/report/$1/$2';

$route['stocks/(:num)'] 			     		= 'stocks/stocks';
$route['stocks/(:any)'] 						= 'stocks/stocks/$1';
$route['stocks/(:any)/(:num)'] 				= 'stocks/stocks/$1/$2';
$route['stocks/(:any)/(:num)/(:num)'] 		= 'stocks/stocks/$1/$2/$3';
$route['stocks/(:any)/(:num)/(:num)/(:num)'] = 'stocks/stocks/$1/$2/$3/$4';

$route['products-aging-report/(:num)'] 			= 'aging_report/products';
$route['products-aging-report/(:any)'] 			= 'aging_report/products/$1';
$route['products-aging-report/(:any)/(:any)'] 	= 'aging_report/products/$1/$2';
$route['products-aging-report/(:any)/(:any)/(:any)'] 	= 'aging_report/products/$1/$2/$3';

$route['date-wise-stock-report/(:num)'] = 'reports/date_wise_product_stock_report';
$route['date-wise-stock-report/(:any)'] = 'reports/date_wise_product_stock_report/$1';
$route['date-wise-stock-report/(:any)/(:any)'] = 'reports/date_wise_product_stock_report/$1/$2';


$route['monthly-ledger-report/(:num)'] 		= 'ledger/monthly_report';
$route['monthly-ledger-report/(:any)'] 		= 'ledger/monthly_report/$1';
$route['monthly-ledger-report/(:any)/(:any)'] 		= 'ledger/monthly_report/$1/$2';

$route['expanse-accounts/(:num)'] 			= 'master_shop/expanse_accounts';
$route['expanse-accounts/(:any)'] 			= 'master_shop/expanse_accounts/$1';
$route['expanse-accounts/(:any)/(:any)'] 	= 'master_shop/expanse_accounts/$1/$2';
$route['expanse-accounts/(:any)/(:any)/(:any)'] 	= 'master_shop/expanse_accounts/$1/$2/$3';


// expense