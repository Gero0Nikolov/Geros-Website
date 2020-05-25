<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gero\'s
 */

$device = !is_mobile() && !is_tablet() ? "desktop" : ( is_mobile() ? "mobile" : "tablet" );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<script src="https://kit.fontawesome.com/935f25a75d.js" crossorigin="anonymous"></script>
	<script type="text/javascript">
	var ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>";
	</script>

	<?php wp_head(); ?>
</head>

<body <?php body_class( $device ); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
