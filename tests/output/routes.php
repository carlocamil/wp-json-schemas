<?php

namespace WPJsonSchemas;

$data = get_rest_response( 'GET', '/wp/v2', [] );

$d = $data->get_data();

$routes = array_values( array_map( function( array $data, string $route ) : array {
	$data['route'] = $route;
	return $data;
}, $d['routes'], array_keys( $d['routes'] ) ) );

$dir = 'routes';
$dir = dirname( ABSPATH ) . '/data/rest-api/' . $dir;

if ( ! file_exists( $dir ) ) {
	mkdir( $dir, 0777, true );
}

foreach ( $routes as $i => $item ) {
	$json = json_encode( $item, JSON_PRETTY_PRINT ^ JSON_UNESCAPED_SLASHES );

	file_put_contents( $dir . '/' . $i . '.json', $json );
}
