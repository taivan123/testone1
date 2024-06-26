<?php
/*  instalation of javascript and css  */
function sfsiplus_plugin_back_enqueue_script()
{
	if(isset($_GET['page']))
	{
		if($_GET['page'] == 'sfsi-plus-options')
		{
			wp_enqueue_style("SFSIPLUSbootstrap", SFSI_PLUS_PLUGURL . 'css/bootstrap.min.css');
			wp_enqueue_style('thickbox');
			wp_enqueue_style("SFSIPLUSmainCss", SFSI_PLUS_PLUGURL . 'css/sfsi-style.css', '', SFSI_PLUS_PLUGIN_VERSION );
			wp_enqueue_style("SFSIPLUSWpsesCss", SFSI_PLUS_PLUGURL . 'wpses/wpse1_6817_notiad.min.css' );
			/* include CSS for backend */
			wp_enqueue_style("SFSIPLUSmainadminCss", SFSI_PLUS_PLUGURL . 'css/sfsi-admin-style.css', '', SFSI_PLUS_PLUGIN_VERSION );

			wp_enqueue_style("SFSIPLUSJqueryCSS", SFSI_PLUS_PLUGURL . 'css/jquery-ui-1.10.4/jquery-ui-min.css' );
			wp_enqueue_style("wp-color-picker");
			// function load_wp_media_files() {
			if(function_exists('wp_enqueue_media')){
				wp_enqueue_media();
			}
			// }
			// add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );
		}
	}
	wp_enqueue_style("SFSIPLUSmainAdminCommonCss", SFSI_PLUS_PLUGURL . 'css/sfsi-admin-common-style.css');

	if(isset($_GET['page']))
	{
		if($_GET['page'] == 'sfsi-plus-options')
		{
			wp_enqueue_script('jquery');
			wp_enqueue_script("jquery-migrate");

			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');

			wp_enqueue_script("jquery-ui-accordion");
			wp_enqueue_script("wp-color-picker");
			wp_enqueue_script("jquery-effects-core");
			wp_enqueue_script("jquery-ui-sortable");


			wp_register_script('SFSIPLUSJqueryFRM', SFSI_PLUS_PLUGURL . 'js/jquery.form-min.js', '', '', true);
			wp_enqueue_script("SFSIPLUSJqueryFRM");

			wp_register_script('SFSIPLUSCustomFormJs', SFSI_PLUS_PLUGURL . 'js/custom-form-min.js', '', '', true);
			wp_enqueue_script("SFSIPLUSCustomFormJs");

			wp_register_script('SFSIPLUSCustomJs', SFSI_PLUS_PLUGURL . 'js/custom-admin.js', '', '111.23', true);

			wp_register_script('SFSIPLUSWpses', SFSI_PLUS_PLUGURL . 'wpses/wpse1_6817_notiad.min.js', '', '', true);
			wp_enqueue_script("SFSIPLUSWpses");

			// Localize the script with new data
			$translation_array = array(
				'Re_ad'                 => __('Read more','ultimate-social-media-plus'),
				'Sa_ve'                 => __('Save','ultimate-social-media-plus'),
				'Sav_ing'               => __('Saving','ultimate-social-media-plus'),
				'Sa_ved'                => __('Saved','ultimate-social-media-plus')
			);
			$translation_array1 = array(
				'Coll_apse'             => __('Collapse','ultimate-social-media-plus'),
				'Save_All_Settings'     => __('Save All Settings','ultimate-social-media-plus'),
				'Upload_a'    			=> __('Upload a custom icon if you have other accounts/websites you want to link to.','ultimate-social-media-plus'),
				'It_depends'     		=> __('It depends','ultimate-social-media-plus')
			);

			wp_localize_script( 'SFSIPLUSCustomJs', 'object_name', $translation_array );
			wp_localize_script( 'SFSIPLUSCustomJs', 'object_name1', $translation_array1 );
			wp_enqueue_script("SFSIPLUSCustomJs");

			wp_register_script('SFSIPLUSCustomValidateJs', SFSI_PLUS_PLUGURL . 'js/customValidate-min.js', '', '', true);
			wp_enqueue_script("SFSIPLUSCustomValidateJs");
			/* end cusotm js */

			/* initilaize the ajax url in javascript */
			wp_localize_script( 'SFSIPLUSCustomJs', 'sfsi_plus_ajax_object', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'tifm_nonce' => wp_create_nonce('tifm_notice_nonce'),
        'unonce' => wp_create_nonce('usm_universal_nonce_plus'),
        'anonce' => wp_create_nonce('usm_plus_universal_anonce')
			));
			wp_localize_script( 'SFSIPLUSCustomValidateJs', 'sfsi_plus_ajax_object', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'plugin_url'=> SFSI_PLUS_PLUGURL,
				'rest_url'=>( false || ( function_exists('apc_fetch') )?get_rest_url():''),
				'tifm_nonce' => wp_create_nonce('tifm_notice_nonce'),
        'anonce' => wp_create_nonce('usm_plus_universal_anonce')
			));
			wp_localize_script( 'SFSIPLUSCustomJs', 'sfsi_plus_links', array(
				'admin_url' => admin_url('/'),
				'plugin_dir_url'=> SFSI_PLUS_PLUGURL,
				'rest_url'=>(function_exists('get_rest_url')?get_rest_url():''),
				'pretty_perma'=>(get_option('permalink_structure')==""?'no':'yes'),
				'tifm_nonce' => wp_create_nonce('tifm_notice_nonce'),
        'anonce' => wp_create_nonce('usm_plus_universal_anonce')
			));
			wp_localize_script( 'SFSIPLUSCustomValidateJs', 'sfsi_plus_links', array( 'admin_url' => admin_url('/'),'plugin_dir_url'=> SFSI_PLUS_PLUGURL,'rest_url'=>(function_exists('get_rest_url')?get_rest_url():''),'pretty_perma'=>(get_option('permalink_structure')==""?'no':'yes')) );
		}
	}
}
add_action( 'admin_enqueue_scripts', 'sfsiplus_plugin_back_enqueue_script' );

function sfsiplus_plugin_front_enqueue_script()
{
		wp_enqueue_style("SFSIPLUSmainCss", SFSI_PLUS_PLUGURL . 'css/sfsi-style.css', '', SFSI_PLUS_PLUGIN_VERSION );
		$option5=  maybe_unserialize(get_option('sfsi_plus_section5_options',false));
		$option3=  maybe_unserialize(get_option('sfsi_plus_section3_options',false));
		if($option5['sfsi_plus_disable_floaticons'] == 'yes')
		{
			wp_enqueue_style("disable_sfsiplus", SFSI_PLUS_PLUGURL . 'css/disable_sfsi.css' );
		}

		wp_enqueue_script('jquery');
	 	wp_enqueue_script("jquery-migrate");
		wp_enqueue_script('jquery-ui-core');

		wp_register_script('SFSIPLUSjqueryModernizr', SFSI_PLUS_PLUGURL . 'js/shuffle/modernizr.custom.min.js', '','',true);
		wp_enqueue_script("SFSIPLUSjqueryModernizr");

		if(isset($option3["sfsi_plus_shuffle_icons"])&&"yes"==$option3["sfsi_plus_shuffle_icons"]){
			wp_register_script('SFSIPLUSjqueryShuffle', SFSI_PLUS_PLUGURL . 'js/shuffle/jquery.shuffle.min.js', '','',true);
			wp_enqueue_script("SFSIPLUSjqueryShuffle");

			wp_register_script('SFSIPLUSjqueryrandom-shuffle', SFSI_PLUS_PLUGURL . 'js/shuffle/random-shuffle-min.js', '','',true);
			wp_enqueue_script("SFSIPLUSjqueryrandom-shuffle");
		}

		$option1 = maybe_unserialize(get_option("sfsi_plus_section1_options",false));

		if(isset($option1["sfsi_plus_wechat_display"]) && $option1["sfsi_plus_wechat_display"]=="yes"){
			wp_register_script('SFSIPLUSqrcode.js', SFSI_PLUS_PLUGURL . 'js/qrcode.min.js', '', '', true);
			wp_enqueue_script("SFSIPLUSqrcode.js");
		}

		wp_register_script('SFSIPLUSCustomJs', SFSI_PLUS_PLUGURL . 'js/custom.js', '', SFSI_PLUS_PLUGIN_VERSION, true);
		wp_enqueue_script("SFSIPLUSCustomJs");
		/* end cusotm js */

		/* initilaize the ajax url in javascript */
		wp_localize_script( 'SFSIPLUSCustomJs', 'sfsi_plus_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ),'plugin_url'=> SFSI_PLUS_PLUGURL,'rest_url'=>(function_exists('get_rest_url')?get_rest_url():'')) );
		wp_localize_script( 'SFSIPLUSCustomJs', 'sfsi_plus_links', array( 'admin_url' => admin_url('/'),'plugin_dir_url'=> SFSI_PLUS_PLUGURL,'rest_url'=>(function_exists('get_rest_url')?get_rest_url():''),'pretty_perma'=>(get_option('permalink_structure')==""?'no':'yes')) );

		if ( current_user_can( 'manage_options' ) ) {

			$sfsi_plus_hide_admin_forum_notification = get_option( 'sfsi_plus_hide_admin_forum_notification' );
			if( 'yes' === $sfsi_plus_hide_admin_forum_notification ) {
				return;
			}
			wp_enqueue_style( 'SFSIPLUSforumnotification', SFSI_PLUS_PLUGURL . 'css/sfsi-forum-notification.css', array(), '1.0' );
		}
}
add_action( 'wp_enqueue_scripts', 'sfsiplus_plugin_front_enqueue_script' );
