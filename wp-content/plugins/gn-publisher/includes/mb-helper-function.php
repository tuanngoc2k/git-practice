<?php


// Exit if accessed directly
if( !defined( 'ABSPATH' ) )
    exit;

/**
 * Helper method to check if user is in the plugins page.
 *
 * @author 
 * @since  1.4.0
 *
 * @return bool
 */
function gnpub_is_plugins_page() {
    global $pagenow;

    return ( 'plugins.php' === $pagenow );
}

function gnpub_get_current_url(){
 
    $link = "http"; 
      
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
        $link = "https"; 
    } 
  
    $link .= "://"; 
    $link .= $_SERVER['HTTP_HOST']; 
    $link .= $_SERVER['REQUEST_URI']; 
      
    return $link;
}

/**
 * display deactivation logic on plugins page
 * 
 * @since 1.4.0
 */


function gnpub_add_deactivation_feedback_modal() {
    
  
    if( !is_admin() && !gnpub_is_plugins_page()) {
        return;
    }

    $current_user = wp_get_current_user();
    if( !($current_user instanceof WP_User) ) {
        $email = '';
    } else {
        $email = trim( $current_user->user_email );
    }

    require_once GNPUB_PATH."/templates/deactivate-feedback.php";
    
}

/**
 * send feedback via email
 * 
 * @since 1.4.0
 */
function gnpub_send_feedback() {

    if ( ! isset( $_POST['gn_security_nonce'] ) ){
        return; 
    }
    if ( !wp_verify_nonce( $_POST['gn_security_nonce'], 'gn-pub-nonce' ) ){
    return;  
    } 


    if( isset( $_POST['data'] ) ) {
        parse_str( $_POST['data'], $form );
    }

    $text = '';
    if( isset( $form['gnpub_disable_text'] ) ) {
        $text = implode( "\n\r", $form['gnpub_disable_text'] );
    }

    $headers = array();

    $from = isset( $form['gnpub_disable_from'] ) ? $form['gnpub_disable_from'] : '';
    if( $from ) {
        $headers[] = "From: $from";
        $headers[] = "Reply-To: $from";
    }

    $subject = isset( $form['gnpub_disable_reason'] ) ? $form['gnpub_disable_reason'] : '(no reason given)';

    $subject = $subject.' - GN Publisher';

    if($subject == 'technical - GN Publisher'){

          $text = trim($text);

          if(!empty($text)){

            $text = 'technical issue description: '.$text;

          }else{

            $text = 'no description: '.$text;
          }
      
    }

    $success = wp_mail( 'team@magazine3.in', $subject, $text, $headers );

    die();
}
add_action( 'wp_ajax_gnpub_send_feedback', 'gnpub_send_feedback' );
 


add_action( 'admin_enqueue_scripts', 'gnpub_enqueue_makebetter_email_js' );

function gnpub_enqueue_makebetter_email_js(){
 
    if( !is_admin() && !gnpub_is_plugins_page()) {
        return;
    }

    wp_enqueue_script( 'gnpub-make-better-js', GNPUB_URL . '/assets/js/make-better-admin.js', array( 'jquery' ), GNPUB_VERSION);

    wp_enqueue_style( 'gnpub-make-better-css', GNPUB_URL . '/assets/css/make-better-admin.css', false , GNPUB_VERSION);
    wp_localize_script('gnpub-make-better-js', 'gn_pub_script_vars', array(
        'nonce' => wp_create_nonce( 'gn-pub-nonce' ),
    )
    );
}

if( is_admin() && gnpub_is_plugins_page()) {
    add_filter('admin_footer', 'gnpub_add_deactivation_feedback_modal');
}


function gn_send_query_message(){   
		    
    if ( ! isset( $_POST['gn_security_nonce'] ) ){
       return; 
    }
    if ( !wp_verify_nonce( $_POST['gn_security_nonce'], 'gn-admin-nonce' ) ){
       return;  
    }   
    $message        = gn_sanitize_textarea_field($_POST['message']); 
    $email          = gn_sanitize_textarea_field($_POST['email']);   
                            
    if(function_exists('wp_get_current_user')){

        $user           = wp_get_current_user();

        $message = '<p>'.$message.'</p><br><br>'.'Query from GN Publisher plugin support tab';
        
        $user_data  = $user->data;        
        $user_email = $user_data->user_email;     
        
        if($email){
            $user_email = $email;
        }            
        //php mailer variables        
        $sendto    = 'team@magazine3.in';
        $subject   = "GN Publisher Query";
        
        $headers[] = 'Content-Type: text/html; charset=UTF-8';
        $headers[] = 'From: '. esc_attr($user_email);            
        $headers[] = 'Reply-To: ' . esc_attr($user_email);
        // Load WP components, no themes.   

        $sent = wp_mail($sendto, $subject, $message, $headers); 

        if($sent){

             echo json_encode(array('status'=>'t'));  

        }else{

            echo json_encode(array('status'=>'f'));            

        }
        
    }
                    
    wp_die();           
}

function gn_sanitize_textarea_field( $str ) {

if ( is_object( $str ) || is_array( $str ) ) {
    return '';
}

$str = (string) $str;

$filtered = wp_check_invalid_utf8( $str );

if ( strpos( $filtered, '<' ) !== false ) {
    $filtered = wp_pre_kses_less_than( $filtered );
    // This will strip extra whitespace for us.
    $filtered = wp_strip_all_tags( $filtered, false );

    // Use HTML entities in a special case to make sure no later
    // newline stripping stage could lead to a functional tag.
    $filtered = str_replace( "<\n", "&lt;\n", $filtered );
}

$filtered = trim( $filtered );

$found = false;
while ( preg_match( '/%[a-f0-9]{2}/i', $filtered, $match ) ) {
    $filtered = str_replace( $match[0], '', $filtered );
    $found    = true;
}

if ( $found ) {
    // Strip out the whitespace that may now exist after removing the octets.
    $filtered = trim( preg_replace( '/ +/', ' ', $filtered ) );
}

return $filtered;
}

