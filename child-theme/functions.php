<?php
	
function gt3_child_scripts() {
	wp_enqueue_style( 'gt3-parent-style', get_template_directory_uri(). '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'gt3_child_scripts' );

/**
 * Contact form email validation
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

/**
 * Fix for post pagination 404s
 *
 */


function remove_page_from_query_string($query_string)
{ 
    if ($query_string['name'] == 'page' && isset($query_string['page'])) {
        unset($query_string['name']);
        $query_string['paged'] = $query_string['page'];
    }      
    return $query_string;
}
add_filter('request', 'remove_page_from_query_string');




/**
* Team shortcode
*
*/

function diwp_create_shortcode_team_post_type(){
 
    $args = array(
                    'post_type'      => 'team',
                    'posts_per_page' => '50',
                    'orderby' => 'menu_order',
                    'order'   => 'ASC',
                    'publish_status' => 'published',
                 );

    $query = new WP_Query($args);
    $result .= '<div class="custom-team-wrapper">';

    if($query->have_posts()) :
        $counter = 0;
        while($query->have_posts()) :
          
            $query->the_post() ;


            //member position
            $position_member = class_exists('RWMB_Loader') ? rwmb_meta('position_member') : '';
            $id = get_queried_object_id();

            //member social
            if (class_exists('RWMB_Loader')) {
                $member_social = rwmb_meta('icon_selection');
                $social_out    = '';
                if (!empty($member_social) && is_array($member_social)) {
                    foreach ($member_social as $social) {
                        if (!empty($social['select'])) {
                            $social_out .= '<a href="' . esc_url($social['input']) . '" class="gt3_team_list_social__item ' . $social['select'] . '" target="_blank"' . (!empty($social['color']) ? ' data-hover-color="' . $social['color'] . '"' : '') . '>';
                            $social_out .= '</a>';
                        }
                    }
                }
                if (!empty($social_out)) {
                    $social_out = '<div class="gt3_team_list_social">' . $social_out . '</div>';
                }
            } else {
                $social_out = '';
            }


            $result .= '<article class="custom_team_item">';
            $result .= '<div class="team-item">'; 

            $result .= $social_out;
            $result .= '<a href="'.get_permalink().'" title="' . get_the_title() . '">';
            $result .= '<div class="team-single-image">' . get_the_post_thumbnail() . '</div>';
            $result .= '</a>';

            $result .= '<div class="team-info-box">';
            $result .= '<a href="'.get_permalink().'" title="' . get_the_title() . '">';
            $result .= '<h5 class="team-name">' . get_the_title() . '</h5>';
            $result .= '</a>';
            $result .= '<div class="team-position">' . esc_html($position_member). '</div>';
            $result .= '<div class="team-education">' . get_the_excerpt() . '</div>';
            $result .= '</div>';

            $result .= '</div>';
            $result .= '</article>';

         
        endwhile;
 
        wp_reset_postdata();
 
    endif;    
    $result .= '</div>';
 
    return $result;            
}
 
add_shortcode( 'team-list', 'diwp_create_shortcode_team_post_type' ); 
 
// shortcode code ends here


