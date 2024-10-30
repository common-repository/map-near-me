<?php
/**
 * Plugin Name:		Map Near Me
 * Plugin URI:		https://blessedlogic.com/map-near-me
 * Description:		Creates a button that links to Google Map that searches for a keyword near me or near a zip code.
 * Version:       1.1.0
 * Author:        Blessed Logic, LLC
 * License:       GPL v2 or later
 */

/**
 * Section:   Header content
 * Function:  map_near_me_header_content
 * Purpose:   Injects the styles and scripts needed for the Map Near Me plugin.
 *            Since there is very few lines of code, it is going into the header
 *            section instead of an external link.
 */
add_action('wp_head', 'mapnearme_header_content', 1);

function mapnearme_header_content() {
?>

<!-- Begin Map Near Me styles and scripts -->
<style>
.map_near_me .mnm_wrapper .mnm_error {
  color: red;
}
.map_near_me .mnm_wrapper .mnm_input {
  float: left;
  width: 20%;
}
.map_near_me .mnm_wrapper .mnm_pad10 {
  margin-left: 10px;
}
</style>

<script>
function mapnearme_get_url(uid, settings = 0) {
  var map_url = 'https://google.com/maps/search/';
  map_url += document.getElementById('mnm_searchword_' + uid).value.split(' ').join('+');
  if (settings == 0 && document.getElementById('mnm_zip_' + uid).value != '') {
    map_url += '+' + document.getElementById('mnm_zip_' + uid).value;
  };
  window.open(map_url, '_blank');
}
</script>
<!-- End Map Near Me styles and scripts -->

<?php
}

/**
 * Section:   Register Shortcode
 * Functions: register_shortcode, map_near_me_shortcode
 * Purpose:   Sets up the map_near_me shortcode and generates the HTML output.
 *            The shortcode takes in the following arguments:
 *
 *             - Single argument (Required):  At a mininum, there must be at least
 *               one argument.  If no key is assigned to it then it will be assumed
 *               that it is a search word to be passed to Google.  If there are
 *               multiple search words, they must be enclosed in quotes.
 *               Examples: [map_near_me barber], [map_near_me "car dealers"]
 *
 *             - keyword (Required): Search word to be passed to Google.
 *               Examples: [map_near_me keyword="barber"]
 *
 *             - zipcode (Optional): Allows the end user to restrict the keyword
 *               to a specific zip code.  By default this is always on (value = "1").
 *               If this is not desired, then you need to set it to "0".
 *               If no zipcode is entered, then Google will search near the end user's location.
 *               Examples: [map_near_me keyword="barber" zipcode="0"]
 *
 *             - label (Optional):  Allows you to customize the button label.  By
 *               default, the button label will be "Find [keyword] Near Me".
 *               Examples: [map_near_me keyword="barber" title="Find Hair Salons"]
 *
 */
add_action('init', 'mapnearme_register_shortcodes');

function mapnearme_register_shortcodes() {
  add_shortcode('map_near_me', 'mapnearme_shortcode');
}

function mapnearme_shortcode($atts) {

  // Analyze the attributes
  $keyword = NULL;
  if (is_array($atts)) {
    if (count($atts) == 1) {
      // If there is only one attribute, assume that it is the keyword and use default values for all other settings
      $keyword = isset($atts[0]) ? sanitize_text_field(esc_attr($atts[0])) : (isset($atts['keyword']) ? sanitize_text_field(esc_attr($atts['keyword'])) : NULL);
      $label = "Find " . ucwords($keyword) . " Near Me";
      $zipcode = 1;
    } else {
      $keyword = isset($atts['keyword']) ? sanitize_text_field(esc_attr($atts['keyword'])) : NULL;
      $zipcode = isset($atts['zipcode']) ? sanitize_text_field(esc_attr($atts['zipcode'])) : 1; // Default to 'on';
      $label = isset($atts['label']) ? sanitize_text_field(esc_attr($atts['label'])) : "Find " . ucwords($keyword) . " Near Me";
    }
  }

  // Build content
  $html = "<div class='map_near_me'><div class='mnm_wrapper'>\n";
  if ($keyword == NULL) {
    $html .= "<p class='mnm_error'><b>ERROR:</b>  Map Near Me plugin requires a keyword!</b><p>\n";
  } else {
    $uid = uniqid(); // Use unique identifier in case there are more than one map_near_me shortcodes
    $html .= "<input id='mnm_searchword_$uid' type='hidden' name='searchword' value='". strtolower($keyword) . "'>\n";
    if ($zipcode) {
      $html .= "<input class='mnm_input' id='mnm_zip_$uid' type='text' name='zipcode' value='' placeholder='Zip Code'>";
      $html .= "<input class='mnm_pad10' type='button' value='$label' onclick='mapnearme_get_url(\"$uid\",0)'>\n";
    } else {
      $html .= "<input type='button' value='$label' onclick='mapnearme_get_url(\"$uid\",1)'>\n";
    }
  }
  $html .= "</div></div>\n";

  return $html;
}
