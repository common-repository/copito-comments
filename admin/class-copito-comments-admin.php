<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://copitosystem.com
 * @since      1.0.0
 *
 * @package    Copito_Comments
 * @subpackage Copito_Comments/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Copito_Comments
 * @subpackage Copito_Comments/admin
 * @author     Cosme12 <aaadiego502@gmail.com>
 */
class Copito_Comments_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Copito_Comments_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Copito_Comments_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/copito-comments-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Copito_Comments_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Copito_Comments_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/copito-comments-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Functions edited by Cosme.
	 *
	 * @since    1.0.0
	 */
	public function copitoAddCommentsForm() {

		if ( isset($_POST['user_info_nonce']) && wp_verify_nonce($_POST['user_info_nonce'], 'user_info')) {
      
      		// VALIDATE BEFORE SAVING IN DATABASE
      		$pass_validation = $_POST;
      		if ( $pass_validation ) {
        		$data = array(
          		'name' => $this->sanitizeTextField($_POST['name']),
          		'email' => $this->sanitizeEmail($_POST['email']),
        		'comment' => $this->sanitizeTextAreaField($_POST['comment']),
        		'post-id' => $this->sanitizeNumber($_POST['post-id']),
        		);
        
        		$commentdata = array(
				'comment_post_ID' => $data['post-id'], // to which post the comment will show up
				'comment_author' => $data['name'],
				'comment_author_email' => $data['email'],
				'comment_author_url' => '',
				'comment_content' => $data['comment'],
				'comment_type' => '', //empty for regular comments, 'pingback' for pingbacks, 'trackback' for trackbacks
				'comment_parent' => 0, //0 if it's not a reply to another comment; if it's a reply, mention the parent comment ID here
				'user_id' => get_current_user_id(), //passing current user ID or any predefined as per the demand
				);
				
				/*Insert new comment and get the comment ID
				Usuful to add a reply DO NOT DELETE
				$comment_id = wp_new_comment( $commentdata );
				*/
				if ($commentdata['comment_content'] != '' && $commentdata['comment_post_ID']  && wp_new_comment( $commentdata )) {
					update_option( 'copito-error-msg', 3);
				} elseif ($commentdata['comment_content'] == '') {
					update_option( 'copito-error-msg', 2);
				} else {
					update_option( 'copito-error-msg', 1);
				}
     		}
   		}
	}

	/**
	 * Sanitize inputs.
	 *
	 * @since    1.0.0
	 */
	public function sanitizeTextField($input) {
		return sanitize_text_field($input);
	}

	public function sanitizeTextAreaField($input) {
		return sanitize_textarea_field($input);
	}

	public function sanitizeNumber($input) {
		if (ctype_digit($input)) {
			return sanitize_text_field($input);
		} else {
			return 1;
		}
	}

	public function sanitizeEmail($input) {
		if (is_email($input)) {
			return sanitize_email($input);
		} else {
			return '';
		}
	}

	/**
	 * Displays success or error messages.
	 *
	 * @since    1.0.0
	 */
	public function settings_errors() {
		$value = get_option('copito-error-msg');
		switch ($value) {
		    case 1:
		        echo '<div class="notice notice-error is-dismissible"><p>'. __('Unknown error.', 'copito-comments') .'</p></div>';
				delete_option( 'copito-error-msg');
		        break;
		    case 2:
		        echo '<div class="notice notice-error is-dismissible"><p>'. __('Failed: empty comment.', 'copito-comments') .'</p></div>';
     			delete_option( 'copito-error-msg');
		        break;
		    case 3:
		        echo '<div class="notice notice-success is-dismissible"><p>'. __('Comment added successfully.', 'copito-comments') .'</p></div>';
     			delete_option( 'copito-error-msg');
		        break;
		}
	}
	

	public function set_settings() {
		register_setting( 'copito-comments-settings', 'copito-error-msg');		
	}

	/**
	 * Displays plugin version
	 *
	 * @since    1.1.0
	 */
	public function display_version() {
		echo __('Thank you for using Copito Comments. <b>Version: ').COPITO_COMMENTS_VERSION .'</b>';
	}

	/**
	 * Generates menu in admin area.
	 *
	 * @since    1.0.0
	 */
	public function copito_comments_menu() {

		add_menu_page('Copito Comments', 'Copito Comments', 'administrator', $this->plugin_name .'-settings', array( $this, 'copito_comments_menu_page'), 'dashicons-format-chat');
	}

	/**
	 * Loads template for menu page in admin area
	 *
	 * @since    1.0.0
	 */
	public function copito_comments_menu_page() {

  		load_template(plugin_dir_path( dirname( __FILE__ ) ).'admin/partials/copito-comments-admin-display.php');
	}

}
