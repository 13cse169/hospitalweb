<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']   = 'dashboard';
$route['404_override']         = 'my404';
$route['translate_uri_dashes'] = FALSE;



$route['master/doctor']         = 'hospital/master/doctor';
$route['master/doctor/add']     = 'hospital/master/doctor';
$route['master/department']     = 'hospital/master/department';
$route['master/ward']           = 'hospital/master/ward';
$route['master/bed']            = 'hospital/master/bed';
$route['master/attendentshift'] = 'hospital/master/attendentshift';
$route['master/attendent']      = 'hospital/master/attendent';


$route['master/getFacility']      = 'hospital/master/getFacility';

$route['delete/records'] = 'h_ajax/removerecords';

$route['master/facility/(:any)']  = 'hospital/master/facility';
$route['master/facility-category']  = 'hospital/master/facilityCategory';
$route['master/facility-add']       = 'hospital/master/facility';
$route['master/getSubCategory']     = 'hospital/master/facilitySubCategory';


$route['patient/all']       = 'hospital/patient/all_feature';
$route['patient/update-facility/(:any)'] = 'hospital/patient/IndoorUpdateFacility';
$route['patient/emergency']       = 'hospital/patient/emergency';
$route['patient/emergency-list']    = 'hospital/patient/emergencylist';
$route['patient/refund-amount']     = 'hospital/patient/refundamount';
$route['patient/registation']       = 'hospital/patient/registation';
$route['patient/list']              = 'hospital/patient/Patient_list';
$route['patient/discharge-list']    = 'hospital/patient/discharge_list';
$route['patient/outdoor/treatment'] = 'hospital/patient/outdoor_treatment';
$route['patient/indoor/treatment']  = 'hospital/patient/indoor_treatment';
$route['patient/indoor/quick-bill'] = 'hospital/patient/quick_bill';
$route['patient/indoor/discharge']  = 'hospital/patient/patient_discharge';
$route['patient/indoor/payment-receive']   = 'hospital/patient/payment_receive';
$route['patient/indoor/final-bill/(:any)'] = 'hospital/patient/print_bill';
$route['patient/indoor/provisional-bill/(:any)'] = 'hospital/patient/print_bill';
$route['patient/payment-details/(:any)']   = 'hospital/patient/payment_details';
$route['patient/payment/invoice/(:any)']   = 'hospital/patient/printPaymentDetails';
$route['patient/payment/report/(:any)']    = 'hospital/patient/printPaymentReport';

$route['patient/indoor/not-found']  = 'hospital/patient/page_not_found';

$route['pathology/master/department-test']       = 'hospital/pathology/master_dept_test';
$route['pathology/master/test-head']             = 'hospital/pathology/master_test_head';
$route['pathology/master/add-test']              = 'hospital/pathology/master_add_test';
$route['pathology/master/doctor-comission']      = 'hospital/pathology/master_doctor_comission';
$route['pathology/master/agent-collection-list'] = 'hospital/pathology/master_agent_collection_list';
$route['pathology/master/agent-collection']      = 'hospital/pathology/master_agent_collection';
$route['pathology/master/agent-comission']       = 'hospital/pathology/master_agent_comission';


$route['pathology/myfunction']       = 'hospital/pathology/myfunction';
$route['patient/discharge']       = 'hospital/patient/patientDischarge';


$route['pathology/entry/booking']       = 'hospital/pathology/booking_entry';
$route['pathology/entry/booking/add']   = 'hospital/pathology/booking_entry';
$route['pathology/entry/due-payment']   = 'hospital/pathology/due_payment';
$route['pathology/entry/search-report'] = 'hospital/pathology/search_test_report';


$route['h_ajax/all_patient_details']  = 'h_ajax/all_patient_details';
