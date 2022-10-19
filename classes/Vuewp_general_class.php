<?php 

if ( !defined( 'ABSPATH' ) ) : die;
endif;

if( !class_exists( 'Vuewp_general_class' ) ):

    class Vuewp_general_class
    {

       public $slug;
       public $capability;
       public function __construct()
        {
            $this->slug       = 'vuewp_page';
            $this->capability = 'manage_options';
            add_action( 'admin_menu', [$this, 'vuewp_add_pages'] );
        }

        public function vuewp_add_pages()
        {
            add_menu_page(
                esc_html( 'Configuración', VUEWP_DOMAIN ),
                esc_html( 'Configuración', VUEWP_DOMAIN ),
                $this->capability,
                $this->slug,
                [$this, 'vuewp_view_page'],
                'dashicons-nametag',
                20
            );
            

            if( current_user_can( $this->capability ) ):
                global $submenu;
                $submenu[$this->slug][] = [esc_html( 'Settings', VUEWP_DOMAIN ), $this->capability, 'admin.php?page=' . $this->slug . '#/'];
                $submenu[$this->slug][] = [esc_html( 'Submenu 1',  VUEWP_DOMAIN ), $this->capability, 'admin.php?page='. $this->slug . '#/settings'];
            endif;

        }

        public function vuewp_view_page()
        {
            echo '<div id="vue_wp"></div>';
        }
    }
endif;