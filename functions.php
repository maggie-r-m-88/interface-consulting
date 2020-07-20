<?php
	
function gt3_child_scripts() {
	wp_enqueue_style( 'gt3-parent-style', get_template_directory_uri(). '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'gt3_child_scripts' );

/**
 * Your code here.
 *
 */

add_filter( 'wpcf7_validate_email*', 'custom_email_confirmation_validation_filter', 20, 2 );
  
function custom_email_confirmation_validation_filter( $result, $tag ) {
  if ( 'your-email-confirm' == $tag->name ) {
    $your_email = isset( $_POST['your-email'] ) ? trim( $_POST['your-email'] ) : '';
    $your_email_confirm = isset( $_POST['your-email-confirm'] ) ? trim( $_POST['your-email-confirm'] ) : '';
  
    if ( $your_email != $your_email_confirm ) {
      $result->invalidate( $tag, "Please confirm correct email address." );
    }
  }
  
  return $result;
}