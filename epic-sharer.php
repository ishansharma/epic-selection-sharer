<?php
/*
Plugin Name: Epic Sharer
Plugin Script: epic-sharer.php
Plugin URI: https://medium.com/p/want-highlight-sharing-like-medium-on-your-wordpress-blog-use-epic-sharer-62b82388094
Description: Simple medium like sharing for Twitter and other social networks, based on Selection Sharer (https://github.com/xdamman/selection-sharer)
Version: 2.1
Author: Ishan
Author URI: http://ishan.co
Text Domain: epic-selection-sharer
Domain Path: /languages
*/

require_once dirname( __FILE__ ) . '/titan-framework-checker.php';

class EpicSharer {

	function __construct() {
		add_action( 'tf_create_options', array( $this, 'add_admin_options' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_scripts' ) );
		add_action( 'wp_footer', array( $this, 'output_config' ) );
		add_action( 'plugins_loaded', array( $this, 'load_epic_sharer_textdomain' ) );
	}

	function add_admin_options() {
		$titan = TitanFramework::getInstance( 'epic-sharer' );

		// Creating panel for sharing screen
		$panel = $titan->createAdminPanel( array(
			'name'  => 'Sharing Settings',
		) );

		// via text option
		$panel->createOption( array(
			'name'      => __( 'Twitter via text', 'epic-selection-sharer' ),
			'id'        => 'epic-twitter-handle',
			'type'      => 'text',
			'desc'      => __( 'Enter user handle that should be added after link (e.g. for "via @epictions", enter epictions)', 'epic-selection-sharer' ),
			'default'   => '',
		) );

		// facebook app ID
		$panel->createOption( array(
			'name'		=> __( 'Facebook App ID', 'epic-selection-sharer' ),
			'id'		=> 'epic-fb-id',
			'type'		=> 'text',
			'desc'		=> __( 'Enter your Facebook App ID to enable Facebook icon in sharer.', 'epic-sharer' )
			.
			'<br />
				<ul>
					<li>'
						.
						'<a href="https://developers.facebook.com/apps" target="_blank">'
						.
							__( 'Click here to create an app', 'epic-selection-sharer' )
						.'</a>.
					</li> 
					<li>'
						.'<a href="https://developers.facebook.com/docs/apps/register" target="_blank">'
							.
							__( 'Instructions for creating apps', 'epic-selection-sharer' )
							.
						'</a>.
					</li>
				</ul>',
			'default'	=> '',
		) );

		// where to show the sharer
		$panel->createOption( array(
			'name'      => __( 'Show sharer on', 'epic-selection-sharer' ),
			'id'        => 'epic-show-sharer',
			'type'      => 'multicheck',
			'options'   => array(
				'posts'     => __( 'Posts', 'epic-selection-sharer' ),
				'pages'     => __( 'Pages', 'epic-selection-sharer' ),
				'home'     	=> __( 'Home Page', 'epic-selection-sharer' ),
			),
			'default'   => array( 'posts' ),
		) );

		// save button
		$panel->createOption( array(
			'type'  => 'save',
		) );
	}

	function register_plugin_styles() {
		if ( $this->enqueue_check() ) {
			wp_enqueue_style( 'epic-selection-sharer', plugin_dir_url( __FILE__ ) . 'assets/selection-sharer.css', array(), filemtime( plugin_dir_path( __FILE__ ) . 'assets/selection-sharer.css' ) );
		}
	}

	function register_plugin_scripts() {
		if ( $this->enqueue_check() ) {
			wp_enqueue_script( 'epic-selection-sharer', plugin_dir_url( __FILE__ ) . 'assets/selection-sharer.js', array( 'jquery' ), filemtime( plugin_dir_path( __FILE__ ) . 'assets/selection-sharer.js' ), true );
			wp_enqueue_script( 'epic-sharer-custom', plugin_dir_url( __FILE__ ) . 'assets/epic-sharer.js', array( 'epic-selection-sharer' ), filemtime( plugin_dir_path( __FILE__ ) . 'assets/epic-sharer.js' ), true );
		}
	}

	function output_config() {
		if ( $this->enqueue_check() ) {

			$titan = TitanFramework::getInstance( 'epic-sharer' );

			$twitter_username = $titan->getOption( 'epic-twitter-handle' );
			$fb_app_id = $titan->getOption( 'epic-fb-id' );

			$output = '';

			if ( $twitter_username ) {
				$output .= <<<_EPIC_CONFIG_
<script type="text/javascript">var twitterVia = "$twitter_username";</script>
_EPIC_CONFIG_;
			}

			if ( $fb_app_id ) {
				$output .= <<<_EPIC_CONFIG_
<script type="text/javascript">var epicFBAppId = "$fb_app_id";</script>
_EPIC_CONFIG_;
			}
			if ( $twitter_username || $fb_app_id ) {
				echo $output;
			}
		}
	}

	function load_epic_sharer_textdomain() {
		load_plugin_textdomain( 'epic-selection-sharer', false, basename( dirname( __FILE__ ) . '/languages/' ) );
	}

	private function enqueue_check() {
		$titan = TitanFramework::getInstance( 'epic-sharer' );
		$show_settings = $titan->getOption( 'epic-show-sharer' );

		if ( is_array( $show_settings ) && count( $show_settings ) > 0 ) {
			if ( ( array_search( 'posts', $show_settings ) !== false ) && is_singular( 'post' ) ) {
				return true;
			}

			if ( ( array_search( 'pages', $show_settings ) !== false ) && is_page( ) && ! is_front_page( ) ) {
				return true;
			}

			if ( ( array_search( 'home', $show_settings ) !== false ) && is_front_page( ) ) {
				return true;
			}
		}

		return false;
	}
}

if ( class_exists( 'TitanFramework' ) ) {
	new EpicSharer();
}
