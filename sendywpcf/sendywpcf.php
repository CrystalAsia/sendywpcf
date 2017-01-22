<?
/**
 * Plugin Name: Sendy WPCF7
 * Description: Sendy integration with WP Contact Form 7
 * Author: Ryan Snowden
 * Author URI: http://crystal-asia.com
 * License: MIT
 * Version: 1.0
 */

add_action('init', 'sendywpcf_init');

/**
 * Check that WPCF is installed and add in hooks.
 *
 * @return bool
 */
function sendywpcf_init() {

	add_action( 'wpcf7_mail_sent', 'subscribe_from_cf7');
	// wpcf7_add_shortcode Depricated, replaced with wpcf7_add_form_tag
	if (!function_exists('wpcf7_add_form_tag')) {
		return false;
	}
	wpcf7_add_shortcode('sendywpcf', 'get_list_id');

	return true;
}

/**
 * Creates a hidden input with the sendy list id
 * 
 * @param mixed $args Array or string
 * @return string Hidden input with Sendy list id
 */
function get_list_id($args=[]) {

	if (!isset($args['values'][0])) {
		return false;
	}
	$content = '<input type="hidden" name="sendy_list_id" value="'.$args['values'][0].'">';

	return $content;
}

/**
 * Subscribe from WPCF Forms after the email has been sent
 *
 * @param array $args
 * @return mixed
*/
function subscribe_from_cf7($args=null) {

	$sendyUrl = "http://www.yoursendy.com/subscribe";

	try {

		if (!isset($_POST['sendy_list_id'])) {
			throw new Exception("Missing sendy_list_id");
		}

		$postdata = http_build_query([
			'name' => $_POST['name'],
			'email' => $_POST['email'],
			'list' => $_POST['sendy_list_id'],
			'boolean' => 'true'
		]);
		$opts = ['http' => [
			'method'  => 'POST',
			'header'  => 'Content-type: application/x-www-form-urlencoded',
			'content' => $postdata
		]];
		$context  = stream_context_create($opts);
		$result = file_get_contents($sendyUrl, false, $context);

		if (!$result) {
			throw new Exception("There was a probleming adding you to the mailing list");
		}

	} catch (Exception $e) {
		echo "<script>jQuery('.wpcf7-response-output').html('".$e->getMessage();"').show(); </script>";
	}

}

