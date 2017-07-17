<?php
/*
Plugin Name: Easy CTA Buttons
Plugin URI: https://www.anphira.com/fruitful-widgets
Description: Adds useful & stylish call to action buttons.
Version: 1.0
GitHub Plugin URI: anphira/easy-cta-buttons
Author: Anphira
Author URI: https://www.anphira.com
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: easy_cta_buttons
*/

function easy_cta_buttons_admin_notice__success() {
    ?>
    <div class="notice notice-success">
        <p><?php _e( 'Shortcode for displaying CTAs: [easy_cta_button link="http://example.com" text="Click here" round="yes" color="blue"]<br />
        link: this field is used for the URL that you want the CTA to go to<br />
        text: this field is the text you want to display<br />
        round: include this field when you want the CTA to have rounded edges<br />
        color: this is the color, options available: light_grey, dark_grey, blue, green, yellow, orange, or custom hex value<br />
        Custom color example: [easy_cta_button link="http://example.com" text="Click here" round="yes" color="#f7f7f7"]', 'easy_cta_buttons' ); ?></p>
    </div>
    <?php
}
add_action( 'admin_notices', 'easy_cta_buttons_admin_notice__success' );

/**
 * easy_cta_button shortcode
 * @param link option is URL
 * @param text option is text to be displayed
 * @param round option is yes or no
 * @param color options are light_grey, dark_grey, blue, green, yellow, orange
 */
function easy_cta_button_shortcode ( $atts ) {
    $a = shortcode_atts( array(
        'link' => 'something',
        'text' => 'something else',
        'round' => 'no',
        'color' => 'blue',
    ), $atts );

    $round_value = ($a['round'] == 'yes') ? 'callout-round' : '';

    if(substr($a['color'], 0, 1) == '#') {
        $color_value = 
    }
    else {
        switch ($a['color']) {
        	case 'blue':
        		$color_value = '#008ed6';
        		break;

        	case 'dark_grey':
        		$color_value = '#43464b';
        		break;

        	case 'green':
        		$color_value = '#009e46';
        		break;

        	case 'light_grey':
        		$color_value = '#ddd';
        		break;

        	case 'orange':
        		$color_value = '#fe8e00';
        		break;

        	case 'yellow':
        		$color_value = '#ffd802';
        		break;
        	
        	default:
        		$color_value = '#43464b';
        		break;
        }
    }

    $text_color = easy_cta_button_readableColour($color_value);

    $return_value = '<a class="callout-button ';
    $return_value .= $round_value;
    $return_value .= ' " style="background:';
    $return_value .= $color_value;
    $return_value .= ';color:#';
    $return_value .= $text_color;
    $return_value .= ';" href="';
    $return_value .= $a['link'];
    $return_value .= '">';
    $return_value .= $a['text'];
    $return_value .= '</a>';

    return $return_value;
}
add_shortcode( 'easy_cta_button', 'easy_cta_button_shortcode' );

function easy_cta_button_readableColour($bg){
    $r = hexdec(substr($bg,0,2));
    $g = hexdec(substr($bg,2,2));
    $b = hexdec(substr($bg,4,2));

    $contrast = sqrt(
        $r * $r * .241 +
        $g * $g * .691 +
        $b * $b * .068
    );

    if($contrast > 130){
        return '000000';
    }else{
        return 'FFFFFF';
    }
}