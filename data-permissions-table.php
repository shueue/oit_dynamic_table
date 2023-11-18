<?php 
/**
*Plugin Name: Data Permissions Table
*Description: Dynamic tables showing what software is permitted with certain sensitive data. It is used on the Guide to Sensitive Information in Research on the oit.utk.edu site
*Author: Amber Shuey
*Author URL: https://www.linkedin.com/in/amber-shuey/
*Version: 1.0.0
*Text Domain: data-permissions-table
*/


// Security Query that terminates the connection to this file
if( !defined('ABSPATH'))
{
	exit;
}

class DataPermissionsTable {
	
	public function __construct()
	{
		
		// Create Custom Post Type
		add_action('init', array($this, 'create_custom_post_type'));
	
		// Add asssets (js, css, etc)
		add_action('wp_enqueue_scripts', array($this, 'load_assets'));
		
		// Add Shortcode
		add_shortcode('data-permissions', array($this, 'load_allowed_software_table'));
	}
		
	public function create_custom_post_type()
	{
		$args = array(
			
			'public' => true,
			'has_archive' => true,
			'supports' => array('title'),
			'exclude_from_search' => true,
			'publicly_queryable' => false,
			'capability' => 'manage_options',
			'labels' => array(
				'name' => 'Data Permissions Tables',
				'singular_name' => 'Permission Entry',
			),
			'menu_icon' => 'dashicons-media-spreadsheet',
		);
		
		register_post_type('data_permissions', $args);
	}
	
	
	public function load_assets()
	{
		wp_enqueue_style( 
			'data-permissions-table',
			plugin_dir_url(__FILE__) . 'css/data-permissions-table.css',
			array(),
			1,
			'all'
		);
		
		wp_enqueue_script(
			'data-permissions-table',
			plugin_dir_url(__FILE__) . 'js/data-permissions-table.js',
			array('jquery'),
			1,
			true
		);
	}
	
	public function load_allowed_software_table()
	{
		// Software Allowed
		$a_softwares = get_field('allowed_software');
		$d_softwares = get_field('disallowed_software');
		$if_oried = get_field('if_oried');
		$if_irb = get_field('if_irb');
		$if_deidentify = get_field('if_deidentify');
		$if_access = get_field('if_access');
	
	if(is_array(get_field('allowed_software'))) $a_softwares = get_field('allowed_software');
		else $a_softwares = ["value" => "", "label" => “”];
	
	if(is_array(get_field('disallowed_software'))) $d_softwares = get_field('disallowed_software');
		else $d_softwares = ["value" => "", "label" => “”];
	

		//*Allowed IF copy
		$if_oried_message = '<br> <span class="DPT-message"> *Allowed if written approval provided by ORIED </span>';
		$if_irb_message = '<br> <span class="DPT-message"> *Allowed if written approval provided in IRB documents </span>';
		$if_deidentify_message = '<br> <span class="DPT-message"> **Allowed only if deidentified human subjects research information </span>';
		$if_access_message = '<br> <span class="DPT-message"> **Allowed with access controls in place (not world or group readable) </span>';

		//Images
		$allowed = '<img src="https://oit.utk.edu/wp-content/uploads/Allowed-01.png" alt="ALLOWED">';
		$not_allowed = '<img src="https://oit.utk.edu/wp-content/uploads/Not-Allowed-01.png" alt="NOT ALLOWED">';
		$stipulation = '<img src="https://oit.utk.edu/wp-content/uploads/Questionable-01.png" alt="Allowed if written approval provided by ORIED">';

	$response = '<table class="dpt-table"> <tr><th>Permitted</th><th>IT Tools & Products</th></tr>';
	
	foreach( $a_softwares as $software ){
		$response .= '<tr><td class="img-cell">' . ( in_array($software, $if_oried) || in_array($software, $if_irb) || in_array($software, $if_deidentify) || in_array($software, $if_access) ? $stipulation : $allowed) . '</td>' ;
		$response .= '<td> <a href="https://oittest.utk.edu/research/sensitive-info/it-tool-or-product/' . $software['value'] . '/">' ;
		$response .= $software['label'] . '</a>';
		$response .= (in_array($software, $if_oried)? $if_oried_message : "" );
		$response .= (in_array($software, $if_irb)? $if_irb_message  : "" );
		$response .= (in_array($software, $if_deidentify)? $if_deidentify_message : "" ) ;
		$response .= (in_array($software, $if_access)? $if_access_message : "" ) ;
		$response .= '</td></tr>';
	}
	
	foreach( $d_softwares as $software ){
		if(!in_array($software, $a_softwares)) {
			$response .= '<tr> <td class="img-cell">' . $not_allowed . '</td>';
			$response .= '<td><a href="https://oittest.utk.edu/research/sensitive-info/it-tool-or-product/' . $software['value'] . '/">' . $software['label'] . '</a></td></tr>';
		}}
		
		$response .= '</table>';
	
	return $response;
		 }
	
	
}

new DataPermissionsTable;

	?>