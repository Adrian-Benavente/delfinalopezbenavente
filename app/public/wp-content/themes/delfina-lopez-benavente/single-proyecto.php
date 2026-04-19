<?php
/**
 * Single Project template - Delfina López Benavente
 *
 * Custom layouts for specific projects (e.g. Ortofrutta Luigi).
 * Falls back to generic project content for others.
 *
 * @package Delfina_Lopez_Benavente
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$slug = get_post_field( 'post_name', get_the_ID() );
$slug = $slug ? sanitize_title( $slug ) : '';

if ( $slug === 'ortofruttaluigi' || $slug === 'ortofrutta-luigi' ) {
	get_template_part( 'template-parts/proyecto/content', 'ortofruttaluigi' );
} else {
	get_template_part( 'template-parts/proyecto/content', 'single' );
}

get_footer();
