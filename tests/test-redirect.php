<?php
/**
 * Class SampleTest
 *
 * @package Lanco_Redirect
 */

class RedirectTest extends PHPUnit_Framework_TestCase {

	function setUp() {
		$this->plugin = Lancor\Redirect::get_instance();
	}

	function test_get_instance() {
		$this->assertInstanceOf('Lancor\Redirect', $this->plugin);
	}

	/**
     * @dataProvider ips_get_site_url
     */
	function test_get_site_url($ip, $expected_site) {
		$site = $this->plugin->get_site_url($ip);
		$this->assertEquals($site, $expected_site);
	}

	function ips_get_site_url() {
		return [
			'Central America' => ['186.15.216.225', 'america-central'],
			'United States' => ['64.130.145.50', 'usa'],
			'Puerto Rico' => ['66.50.161.35', 'puerto-rico'],
			'Dominican Republic' => ['190.166.173.96', 'republica-dominicana'],
			'South America' => ['170.254.32.102', 'suramerica'],
			'Default' => ['125.227.134.16', 'america-central'],
		];
	}

}
