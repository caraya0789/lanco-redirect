<?php

namespace Lancor;

class Redirect {

	protected static $instance;

	public static function get_instance() {
		if(self::$instance === null)
			self::$instance = new self();

		return self::$instance;
	}

	public function hooks() {
		add_action( 'init', [ $this, 'init' ] );
	}

	public function init() {
		if(is_admin() || stripos( $_SERVER['REQUEST_URI'], '/wp-login.php' ) === 0)
			return;

		$site = $this->get_site_url( $_SERVER['REMOTE_ADDR'] );
		wp_redirect( '/'.$site ); exit;
	}

	public function get_site_url($ip) {
		$gi = geoip_open( LANCOR_PATH . '/data/GeoLiteCity.dat', GEOIP_STANDARD );
		$row = GeoIP_record_by_addr($gi, $ip);

		// If no location is found return default
		if(!$row)
			return 'america-central';

		$suramerica = [ 'AR', 'BO', 'BR', 'CL', 'CO', 'EC', 'FK', 'GF', 'GY', 'GY', 'PY', 'PE', 'SR', 'UY', 'VE' ];

		// Dominican Republic
		if( $row->country_code == 'DO' )
			return 'republica-dominicana';

		// United States
		if( $row->country_code == 'US' )
			return 'usa';

		// Puerto Rico
		if( $row->country_code == 'PR' )
			return 'puerto-rico';

		// South America
		if( in_array( $row->country_code, $suramerica ) )
			return 'suramerica';

		// If no country match, return default
		return 'america-central';
	}


}
