<?php

namespace WPJsonSchemas;

wp_insert_post( [
	'post_type'   => 'post',
	'post_title'  => 'Title',
	'post_status' => 'publish',
] );

$posts = get_posts( [
	'posts_per_page' => -1,
	'orderby'        => 'ID',
	'order'          => 'ASC',
] );

save_object_array( $posts, 'post' );

$view_data = get_rest_response( 'GET', '/wp/v2/posts', [
	'context' => 'view',
	'per_page' => 100,
] );
$edit_data = get_rest_response( 'GET', '/wp/v2/posts', [
	'context' => 'edit',
	'per_page' => 100,
] );

$empty_response = get_rest_response( 'GET', '/wp/v2/posts', [
	'search' => '1234567890',
] );

save_rest_array( [
	$view_data,
	$edit_data,
	$empty_response,
], 'posts' );