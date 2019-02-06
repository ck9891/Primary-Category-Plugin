<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Add primary category meta box
 *
 * @param post $post The post object
 */
function primary_cat_add_meta_box($post) {
    add_meta_box('product_meta_box', __('Primary Category', 'primary-category'), 'make_meta_box', 'post', 'side', 'default');
}
add_action('add_meta_boxes', 'primary_cat_add_meta_box');

/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function make_meta_box($post) {
	wp_nonce_field(basename(__FILE__), 'primary_cat_nonce');

    $primaryCategory = get_post_meta($post->ID, '_primary_category_mb', true);
    if (empty($primaryCategory)) {
        $primaryCategory = 0;
    }
	?>
    <div class='inside'>
        <p>
            <label for="primary_category_mb"><strong>Primary Category</strong></label>
            <select name="primary_category_mb" id="primary_category_mb" class="regular-text" data-primary-category="<?php echo $primaryCategory; ?>" style="width: 100%;">
                <option value="0">Select primary category.</option>
            </select>
            <br><small>Select a primary category from the dropdown above. Bolded category is the current primary category.</small>
        </p>
	</div>
	<?php
}

/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID
 */
function save_primary_category($post_id) {
    // Verify meta box nonce
    if (!isset($_POST['primary_cat_nonce']) || !wp_verify_nonce($_POST['primary_cat_nonce'], basename(__FILE__))) {
        return;
    }

    // Store custom fields value
    if (isset($_REQUEST['primary_category_mb'])) {
        update_post_meta($post_id, '_primary_category_mb', sanitize_text_field($_POST['primary_category_mb']));
    }
}
add_action('save_post', 'save_primary_category');
