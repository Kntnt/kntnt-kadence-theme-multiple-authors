<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Kntnt Multiple Authors for Kadence Theme
 * Plugin URI:        https://www.kntnt.com/
 * Description:       Allows PublishPress Authors and Co-Authors Plus to output multiple users in the byline of the Kadence Theme.
 * Version:           1.0.0
 * Author:            Thomas Barregren
 * Author URI:        https://www.kntnt.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 */

defined( 'ABSPATH' ) || die;

add_filter( 'kadence_author_meta_output', function ( $byline ) {
	if ( has_action( 'pp_multiple_authors_show_author_box' ) ) {
		ob_start();
		do_action( 'pp_multiple_authors_show_author_box', false, 'inline', false, true );
		$byline = ob_get_clean();
		$byline = '<span class="posted-by">' . $byline . '</span>';
	} elseif ( function_exists( 'coauthors_posts_links' ) ) {
		ob_start();
		coauthors_posts_links( ',&nbsp;', '&nbsp;&&nbsp;', 'By&nbsp;', null, true );
		$byline = ob_get_clean();
		$byline = '<span class="posted-by">' . $byline . '</span>';
	}
	return $byline;
} );