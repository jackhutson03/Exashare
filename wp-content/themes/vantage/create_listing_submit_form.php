<?php 
require_once  $_SERVER["DOCUMENT_ROOT"]."/demo/exashare/wp-load.php";
ini_set('display_errors', 1); 
error_reporting('E_ALL');
global $va_options; 
global $wpdb;
if(isset($_POST['submit']) && isset($_POST['type-cpa'])){
$neturl = $_POST['networkurl']; 
$netemail = $_POST['email'];
$content = $_POST['post_content'];
$netphonenumber = $_POST['phonenumber'];
$netaimname = $_POST['aimname'];
$nethowoffers = $_POST['manyoffers'];
//$netoffers = $_POST['featuredoffers'];
$netcommission = $_POST['commission'];
$netminpayment = $_POST['minimumpayment'];
$netpaymentmethod = $_POST['paymentmethod'];
$netreferralcommission = $_POST['referralcommission'];
$netaffiliatetracking = $_POST['affiliatetracking'];	
$netpayfrequency = $_POST['paymentfrequency'];
$netfacebook =$_POST['facebook'];
$nettwitter =$_POST['twitter'];
$netskype =$_POST['skype'];
$nettrackinglink =$_POST['trackinglink'];
$nettypecheck =$_POST['type-cpa'];
$user_id = get_current_user_id();
$id = wp_insert_post(array(
    'post_title'    => $_POST['post_title'],
    'post_content'  => $content,
    'post_date'     => date('Y-m-d H:i:s'),
    'post_author'   => $user_id,
    'post_type'     => 'listing',
    'post_status'   => 'pending',
));
//print_r($_POST['_listing_category[]']);
wp_set_post_terms($id,$_POST['_listing_category'],'listing_category');
//wp_set_object_terms($id, $_POST['_listing_category'], 'listing_category'); 
//add_post_meta($id, 'networkname',$netname, true);
add_post_meta($id, 'networkurl',$neturl, true);
add_post_meta($id, 'networkemail',$netemail, true);
//add_post_meta($id, 'networmessage',$netmessage, true);
add_post_meta($id, 'networphone',$netphonenumber, true);
add_post_meta($id, 'networkaimname',$netaimname, true);
//add_post_meta($id, 'networkoffers',$netoffers, true);
add_post_meta($id, 'networkcommission',$netcommission, true);
add_post_meta($id, 'networkpayment',$netminpayment, true);
add_post_meta($id, 'networkpaymethod',$netpaymentmethod, true);
add_post_meta($id, 'networkrefcommission',$netreferralcommission, true);
add_post_meta($id, 'networktracking',$netaffiliatetracking, true);
add_post_meta($id, 'networkpayfrequency',$netpayfrequency, true);
add_post_meta($id, 'networkmanyoffers',$nethowoffers, true);
add_post_meta($id, 'networkfacebook',$netfacebook, true);
add_post_meta($id, 'networktwitter',$nettwitter, true);
add_post_meta($id, 'networkskype',$netskype, true);
add_post_meta($id, 'networktrackinglink',$nettrackinglink, true);
add_post_meta($id, 'networktypecheck',$nettypecheck, true);

    $filename = $_FILES['file']['name'];
    $wp_filetype = wp_check_filetype( basename($filename), null );
    $wp_upload_dir = wp_upload_dir();
    move_uploaded_file( $_FILES['file']['tmp_name'], $wp_upload_dir['path']  . '/' . $filename );
    $attachment = array(
        'guid' => $wp_upload_dir['url'] . '/' . basename( $filename ), 
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
        'post_content' => '',
        'post_status' => 'inherit'
       );
    $filename = $wp_upload_dir['path']  . '/' . $filename;
    $attach_id = wp_insert_attachment( $attachment, $filename, $id);
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
    wp_update_attachment_metadata( $attach_id, $attach_data );
	add_post_meta($id, '_thumbnail_id', $attach_id);
}else{
$neturl = $_POST['networkurl']; 
$netemail = $_POST['email'];
$content = $_POST['post_content'];
$netphonenumber = $_POST['phonenumber'];
$netaimname = $_POST['aimname'];
$MaximumFilesize = $_POST['filesize'];
//$netoffers = $_POST['featuredoffers'];
$Storage = $_POST['storagesize'];
$hostsminpayment = $_POST['hostminimumpayment'];
$hostspaymentmethod = $_POST['hostpaymentmethod'];
$hostsreferralcommission = $_POST['hostreferralcommission'];
$uploadpeed = $_POST['uploadingspeed'];	
$hostspayfrequency = $_POST['hostpaymentfrequency'];
$netfacebook =$_POST['facebook'];
$nettwitter =$_POST['twitter'];
$netskype =$_POST['skype'];
$Downloadingspeed =$_POST['downspeed'];
$netfilesupported =$_POST['filesupported'];
$netreward =$_POST['reward'];
$upmethods =$_POST['up-methods'];
$netviewperdown =$_POST['viewperdown'];
$maxfilesize =$_POST['filesize'];
$chekvalue =$_POST['type-host'];
$user_id = get_current_user_id();
$pid = wp_insert_post(array(
    'post_title'    => $_POST['post_title'],
    'post_content'  => $content,
    'post_date'     => date('Y-m-d H:i:s'),
    'post_author'   => $user_id,
    'post_type'     => 'listing',
    'post_status'   => 'pending',
));

//print_r($_POST['_listing_category[]']);
wp_set_post_terms($pid,$_POST['_listing_category'],'listing_category');
//wp_set_object_terms($id, $_POST['_listing_category'], 'listing_category'); 
//add_post_meta($id, 'networkname',$netname, true);
add_post_meta($pid, 'networkurl',$neturl, true);
add_post_meta($pid, 'networkemail',$netemail, true);
//add_post_meta($id, 'networmessage',$netmessage, true);
add_post_meta($pid, 'networphone',$netphonenumber, true);
add_post_meta($pid, 'networkaimname',$netaimname, true);
//add_post_meta($id, 'networkoffers',$netoffers, true);
add_post_meta($pid, 'maxsizefile',$maxfilesize, true);
add_post_meta($pid, 'storagesizes',$Storage, true);
add_post_meta($pid, 'networkpayment',$hostsminpayment, true);
add_post_meta($pid, 'networkpaymethod',$hostspaymentmethod, true);
add_post_meta($pid, 'networkrefcommission',$hostsreferralcommission, true);
add_post_meta($pid, 'uploadspeed',$uploadpeed, true);
add_post_meta($pid, 'downloadspeed',$Downloadingspeed, true);
add_post_meta($pid, 'filesupport',$netfilesupported, true);
add_post_meta($pid, 'networkfacebook',$netfacebook, true);
add_post_meta($pid, 'networktwitter',$nettwitter, true);
add_post_meta($pid, 'networkskype',$netskype, true);
add_post_meta($pid, 'reward',$netreward, true);
add_post_meta($pid, 'uploadingmethods',$upmethods, true);
add_post_meta($pid, 'perdownload',$netviewperdown, true);
add_post_meta($pid, 'networkpayfrequency',$hostspayfrequency, true);
add_post_meta($pid, 'hosttypecheck',$chekvalue, true);

    $filename = $_FILES['file']['name'];
    $wp_filetype = wp_check_filetype( basename($filename), null );
    $wp_upload_dir = wp_upload_dir();
    move_uploaded_file( $_FILES['file']['tmp_name'], $wp_upload_dir['path']  . '/' . $filename );
    $attachment = array(
        'guid' => $wp_upload_dir['url'] . '/' . basename( $filename ), 
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
        'post_content' => '',
        'post_status' => 'inherit'
       );
    $filename = $wp_upload_dir['path']  . '/' . $filename;
    $attach_id = wp_insert_attachment( $attachment, $filename, $pid);
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
    wp_update_attachment_metadata( $attach_id, $attach_data );
	add_post_meta($id, '_thumbnail_id', $attach_id);		
}
?>