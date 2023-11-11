<?php get_header(oit);

// IT Tools & Products Permitted for Data Type
function softwareAllowedTable() 
{

		// *Software Allowed - retrieves data from 'Which Software Allowed?' & 'Software Stipulations' field groups
		$a_softwares = get_field('allowed_software');
		$d_softwares = get_field('disallowed_software');
		$if_oried = get_field('if_oried');
		$if_irb = get_field('if_irb');
		$if_deidentify = get_field('if_deidentify');
		$if_access = get_field('if_access');
	
	// Check if the result is an array
	if(is_array(get_field('allowed_software'))) $a_softwares = get_field('allowed_software');
		else $a_softwares = ["value" => 0, "label" => ""];
	
	if(is_array(get_field('disallowed_software'))) $d_softwares = get_field('disallowed_software');
		else $d_softwares = ["value" => 0, "label" => ""];
	

		//*Software Stipulations copy
		$if_oried_message = '<br> <span style="font-size:11px"> *Allowed if written approval provided by ORIED </span>';
		$if_irb_message = '<br> <span style="font-size:11px"> *Allowed if written approval provided in IRB documents </span>';
		$if_deidentify_message = '<br> <span style="font-size:11px"> **Allowed only if deidentified human subjects research information </span>';
		$if_access_message = '<br> <span style="font-size:11px"> **Allowed with access controls in place (not world or group readable) </span>';

		// *Image Indicator
		$allowed = '<img src="https://oit.utk.edu/wp-content/uploads/Allowed-01.png" alt="ALLOWED" width="25px">';
		$not_allowed = '<img src="https://oit.utk.edu/wp-content/uploads/Not-Allowed-01.png" alt="NOT ALLOWED" width="25px">';
		$stipulation = '<img src="https://oit.utk.edu/wp-content/uploads/Questionable-01.png" alt="Allowed if written approval provided by ORIED" width="25px">';
	
	// *Beginning of Table
	$response = '<table> <tr><th>Permitted</th><th>IT Tools & Products</th></tr>';
	
	// *Allowed Softwares Section 
	foreach( $a_softwares as $software ){
		// Checks if stipulation icon is needed; displayed allowed icon if not
		$response .= '<tr><td align="center" width="50px">' . ( in_array($software, $if_oried) || in_array($software, $if_irb) || in_array($software, $if_deidentify) || in_array($software, $if_access) ? $stipulation : $allowed) . '</td>' ;
		// URL Link
		$response .= '<td> <a href="https://oit.utk.edu/research/sensitive-info/it-tool-or-product/' . $software['value'] . '/">' ;
		// Label
		$response .= $software['label'] . '</a>';
		// Stipulation messages if applicable
		$response .= (in_array($software, $if_oried)? $if_oried_message : "" );
		$response .= (in_array($software, $if_irb)? $if_irb_message  : "" );
		$response .= (in_array($software, $if_deidentify)? $if_deidentify_message : "" ) ;
		$response .= (in_array($software, $if_access)? $if_access_message : "" ) ;
		$response .= '</td></tr>';
	}
	
	// *Disallowed Softwares
	foreach( $d_softwares as $software ){
		// Check if software is allowed; display in disallowed section if not.
		if(!in_array($software, $a_softwares)) {
			$response .= '<tr> <td  align="center" width="50px">' . $not_allowed . '</td>';
			// URL Link & Label
			$response .= '<td><a href="https://oit.utk.edu/research/sensitive-info/it-tool-or-product/' . $software['value'] . '/">' . $software['label'] . '</a></td></tr>';
		}}
		
		$response .= '</table>';
	
	return $response;
	}
add_shortcode('software_allowed', 'softwareAllowedTable');

?>


<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
      

<div id="content" class="site-content wide" role="main">
			
				<div id="breadcrumbs"><?php if ( function_exists( 'breadcrumb' ) ) breadcrumb(); ?></div>
			<header class="entry-header post-header">
				
			<div id="service-name">Research Computing Support</div>
			<h1 class="entry-title"><?php the_title(); ?></h1></header>
			<hr>
      <?php get_sidebar(); ?>
			<div class="content-right">
			
				<br class="clear">
				<?php the_content(); ?>
			<?php endwhile; ?>
		</div>
</div>


<?php get_footer(oit); ?>