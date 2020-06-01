<?php 
// Template Name: Store Page
$page_id = get_the_ID();
$store_link = get_field( "store_link", $page_id );
header( "Location:". $store_link );
exit;
?>