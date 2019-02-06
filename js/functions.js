/**
 * Append primary category to dropdown selector
 */

function addPrimaryCategory(categoryId, categoryLabel) {
    jQuery('#primary_category_mb').append(jQuery('<option>', {
        value: categoryId,
        text: categoryLabel,
    }));
}

jQuery(document).ready(function() {

    /**
     * Add selected categories to primary category dropdown
     */
    let getPrimaryCategory = jQuery('#primary_category_mb').data('primary-category'),
    categoryCheckList = jQuery('ul#categorychecklist input[type="checkbox"]');

    categoryCheckList.each(function () {
        addPrimaryCategory(jQuery(this).val(), jQuery(this).parent().text());
        if (jQuery(this).val() == getPrimaryCategory) {
            jQuery(this).parent().css('font-weight', 'bold');
        }
    });

    /**
     * Set primary category
     */
    jQuery('#primary_category_mb').val(getPrimaryCategory);
    console.log(getPrimaryCategory);
    /**
     * Add category to primary category dropdown on select
     */
    jQuery(document).on('click', 'ul#categorychecklist label', function() {
        let getCategoryId = jQuery(this).find('input[type=checkbox]'),
            getLabel = jQuery(this).text();
        if (getCategoryId.is(':checked')) {
            addPrimaryCategory(getCategoryId.val(),getLabel);
        }
    });

    /* 
     * Check the primary category in category list.
    */
    jQuery('#primary_category_mb').on('change', function () {
        let optionValue = jQuery(this).val();
        categoryCheckList.each(function () {
            jQuery(this).parent().css('font-weight', 'normal');
            if (jQuery(this).val() == optionValue) {
                jQuery(this).prop('checked', true);
                jQuery(this).parent().css('font-weight', 'bold');
            }
        });
    });
});
