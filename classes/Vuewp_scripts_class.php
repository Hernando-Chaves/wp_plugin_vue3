<?php 

if ( !defined( 'ABSPATH' ) ) : die;
endif;

if( !class_exists( 'Vuewp_scripts_class' ) ):

    class Vuewp_scripts_class
    {
       public function __construct()
        {
            if( is_admin() ):
                add_action( 'admin_enqueue_scripts', [$this, 'vuewp_all_scripts'] );
            else: 
                add_action( 'wp_enqueue_scripts', [$this, 'vuewp_all_scripts'] );
            endif;
                add_action( 'admin_enqueue_scripts', [$this, 'vuewp_all_scripts'] );

        }

        /**
         * Call functions to enqueue scripts and styles
         *
         * @return void
         */
        public function vuewp_all_scripts()
        {
            $this->vuewp_add_scripts($this->vuewp_scripts());
            $this->vuewp_add_styles($this->vuewp_styles());
        }

        /**
         * loop to add scripts
         *
         * @param [type] $scripts
         * @return void
         */
        public function vuewp_add_scripts($scripts)
        {
            foreach( $scripts as $handle => $script ):
                $deps      = isset( $script['deps'] ) ? $script['deps']: false;
                $ver       = isset( $script['ver'] ) ? $script['ver']  : VUEWP_VERSION ;
                $in_footer = isset( $script['in_footer'] ) ? $script['in_footer'] : true;

                wp_register_script( $handle, $script['src'], $deps, $ver, $in_footer );
                wp_enqueue_script( $handle );
            endforeach;
        }

        /**
         * load all the scripts
         *
         * @return void
         */
        public function vuewp_scripts()
        {
            $scripts = [
                'manifest_js' => [
                    'src'       => VUEWP_URL . '/assets/js/manifest.js',
                    'deps'      => [],
                    'ver'       => \filemtime( VUEWP_PATH . '/assets/js/manifest.js' ),
                    'in_footer' => true,
                ],
                'vendor_js' => [
                    'src'       => VUEWP_URL . '/assets/js/vendor.js',
                    'deps'      => ['manifest_js'],
                    'ver'       => \filemtime( VUEWP_PATH . '/assets/js/vendor.js' ),
                    'in_footer' => true,
                ],
                'main_js' => [
                    'src'       => VUEWP_URL . '/assets/js/main.js',
                    'deps'      => ['vendor_js'],
                    'ver'       => \filemtime( VUEWP_PATH . '/assets/js/main.js' ),
                    'in_footer' => true,
                ],
            ];

            return $scripts;
        }

        /**
         *  loop to add styles
         *
         * @param [type] $styles
         * @return void
         */
        public function vuewp_add_styles( $styles )
        {
            if( is_admin() ):
                foreach( $styles as $handle => $style ):
                    $deps  = isset( $style['deps'] ) ? $style['deps']  : '';
                    $ver   = isset( $style['ver'] ) ? $style['ver']    : '';
                    $media = isset( $style['media'] ) ? $style['media']: '';

                    wp_register_style($handle, $style['src'], $deps, $ver, $media );
                    $screen = get_current_screen();
                    if( $screen->base == 'toplevel_page_vuewp_page' ):
                        wp_enqueue_style( $handle );   
                    endif;
                endforeach;
            endif;
        }

        /**
         * load all pthe styles
         *
         * @return void
         */
        public function vuewp_styles()
        {
            $styles = [
                'tailwind' => [
                    'src'   => VUEWP_URL . '/assets/css/tailwind.css',
                    'deps'  => [],
                    'ver'   => '3.1.8',
                    'media' => 'all',
                ],
            ];
            return $styles;
        }
    }

endif;