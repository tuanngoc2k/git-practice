<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * This controller handles settings related actions.
 * 
 * @since 1.0.0
 */
class GNPUB_Settings {

	/**
	 * @var GNPUB_Notices
	 */
	protected $notices;

	public function __construct( $notices ) {
		$this->notices = $notices;

		add_action( 'admin_init', array( $this, 'save_settings' ) );
	}

	/**
	 * Save the settings form when it has been submitted.
	 * 
	 * @since 1.0.0
	 */
	public function save_settings() {
		if ( isset( $_POST['save_gnpub_settings'] ) && current_user_can( 'manage_options' ) ) {
			$nonce = isset( $_POST['_wpnonce'] ) ? sanitize_key( $_POST['_wpnonce'] ) : null;
			
			if ( ! wp_verify_nonce( $nonce, 'save_gnpub_settings' ) ) {
				$this->notices->add_notice( __( 'GN Publisher settings were not saved because the form has expired. Try again.', 'gn-publisher' ), 'error' );
				return;
			}

			if ( isset( $_POST['gnpub_include_featured_image'] ) ) {
				update_option( 'gnpub_include_featured_image', true );
			} else {
				update_option( 'gnpub_include_featured_image', false );
			}
			
			if ( isset( $_POST['gnpub_is_default_feed'] ) ) {
				update_option( 'gnpub_is_default_feed', true );
			} else {
				update_option( 'gnpub_is_default_feed', false );
			}

			 $gnpub_defaults = array('gnpub_enable_copy_protection'=>false,
									'gnpub_show_upto_value'=>1,
								 	'gnpub_show_upto_unit'=>'paragraph',
								 	'gnpub_exclude_categories'=>[],
								 	'gnpub_pp_authors_compat'=>false);
			$gnpub_options= get_option( 'gnpub_new_options', $gnpub_defaults);
			$option_update=false;

			if ( isset( $_POST['gnpub_form_tab'] ) && $_POST['gnpub_form_tab']=='feature') {
				if ( isset( $_POST['gnpub_enable_copy_protection'] ) ) {
					$gnpub_options['gnpub_enable_copy_protection']= true;
					$option_update=true;
				}else {
					$gnpub_options['gnpub_enable_copy_protection']= false;
					$option_update=true;
				}

				if ( isset( $_POST['gnpub_show_upto_value'] ) ) {
					$safe_value = intval( $_POST['gnpub_show_upto_value'] );
					if ( ! $safe_value ) {
						$safe_value = 1;
					}
					$gnpub_options['gnpub_show_upto_value']= $safe_value;
					$option_update=true;
				} 

				if ( isset( $_POST['gnpub_show_upto_unit'] ) ) {
					$allowed_values=array('paragraph','word','character');
					$safe_value = sanitize_text_field($_POST['gnpub_show_upto_unit']);
					if(!in_array($safe_value,$allowed_values))
					{
						$safe_value='paragraph';
					}
					$gnpub_options['gnpub_show_upto_unit']= $safe_value;
					$option_update=true;
				} 

				if ( !empty( $_POST['gnpub_exclude_categories'] )) {
					// Sanitizing posted array 
					$gnpub_exclude_keys = array_keys($_POST['gnpub_exclude_categories']);
					$gnpub_exclude_keys = array_map('sanitize_key', $gnpub_exclude_keys);
					$gnpub_exclude_values = array_values($_POST['gnpub_exclude_categories']);
					$gnpub_exclude_values = array_map('sanitize_text_field', $gnpub_exclude_values);
					$gnpub_exclude_categories = array_combine($gnpub_exclude_keys, $gnpub_exclude_values);
					$gnpub_options['gnpub_exclude_categories']= $gnpub_exclude_categories;
					$option_update=true;
				}else {
					$gnpub_options['gnpub_exclude_categories']=[];
					$option_update=true;
				}
			}

			if ( isset( $_POST['gnpub_form_tab'] ) && $_POST['gnpub_form_tab']=='compat') {
				$gnpub_options['gnpub_pp_authors_compat']= false;
				if ( isset( $_POST['gnpub_pp_authors_compat'] )) {
					$gnpub_options['gnpub_pp_authors_compat']= true;	
				}
				$option_update=true;
			}

			if($option_update==true)
			{
			  update_option( 'gnpub_new_options', $gnpub_options);	
			}

			$this->notices->add_notice( __( 'GN Publisher settings saved.', 'gn-publisher' ) );
		}
	}

}