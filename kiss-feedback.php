<?php 

/**
 * Kiss Feedback
 *
 * @link              https://revmakx.com
 * @since             1.0.0
 * @package           Kiss_Feedback
 *
 * @wordpress-plugin
 * Plugin Name:       Kiss Feedback
 * Plugin URI:        https://kissfeedback.com
 * Description:       Get easy Feedback from Clients.
 * Version:           1.0.0
 * Author:            Revmakx
 * Author URI:        https://revmakx.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       kiss-feedback
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class WP_Kiss_Feedback{
	public function __construct(){
        $this->init();
    }
	public function init(){
		$this->constants();
		$this->hooks();
		$this->add_action();
        $this->filters();
	}

	public function constants(){
        define('KISSFEEDBACK_INCLUSION_SCRIPT_LINK', 'https://app.kissfeedback.com/direct-inclusion.js');
        define('KISSFEEDBACK_APP_VERSION', '1.0.0');
        define('KISSFEEDBACK_DB_VERSION', '1.0.0');
    }
    
	public function hooks(){
        register_activation_hook(__FILE__,array($this,'activation'));
        register_deactivation_hook(__FILE__,array($this,'deactivation'));

    }

     public function activation(){
        add_option('kissfeedback_app_version', KISSFEEDBACK_APP_VERSION);
        add_option('kissfeedback_db_version', KISSFEEDBACK_DB_VERSION);

    }

    public function deactivation(){
        delete_option('kissfeedback_app_version');
        delete_option('kissfeedback_db_version');
    }

    public function add_action(){
        wp_enqueue_script('jquery');
        add_action('wp_head',array($this,'custom_js'));
    }

    public function filters(){
    }

    public function custom_js(){
        wp_enqueue_script('kissfeedback_script', KISSFEEDBACK_INCLUSION_SCRIPT_LINK);
    }
}

$obj = new WP_Kiss_Feedback();

