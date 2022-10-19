<?php 

/**
*
*Plugin Name:       PRACTICA WP VUE JS
*Plugin URI:        bogotawebcompany.com
*Description:       Plugin desarrollado para practicar la integración entre wordpress y vue js
*Version:           1.0.0
*Author:            Hernando j Chaves
*Author URI:        bogotawebcompany.com
*License:           GPL-2.0+
*License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
*Text Domain:       vue_wp
*/

if ( ! defined( 'ABSPATH' ) ) : die;
endif;

require_once 'vendor/autoload.php';

if( ! class_exists( 'Vue_wp' ) ):

    final class Vue_wp
    {
       public function __construct()
        {
            $this->vuewp_define_constants();
            add_action( 'plugins_loaded', [$this, 'vuewp_plugins_loaded' ] );
        }

        public function vuewp_define_constants()
        {
            define( 'VUEWP_DOMAIN', 'vue_wp' );
            define( 'VUEWP_VERSION', '1.0.0' );
            define( 'VUEWP_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
            define( 'VUEWP_URL', untrailingslashit( plugins_url( '/', __FILE__ ) ) );
        }

        public function vuewp_plugins_loaded()
        {
            new Vuewp_general_class();
            new Vuewp_scripts_class();
        }

        public static function vuewp_singleton()       
        {
            $instance = false;
            if( !$instance ):
                $instance = new Self();
            endif;
            return $instance;
        }
    }

    function vuewp_run()
    {
        return Vue_wp::vuewp_singleton();
    }
    vuewp_run();

endif;

