function switch_tab_pr_add_chat(tab_name) {
	jQuery('.tab-page').hide();
	jQuery(`.tab-page.${tab_name}_page`).show();
	jQuery('.tab_wrapper_pr_add_chat .nav-tab-active').removeClass('nav-tab-active');
	jQuery(`.tab_wrapper_pr_add_chat .${tab_name}_tab`).addClass('nav-tab-active');

	sessionStorage.setItem('watsonconv_active_tab_' + page_data.hook_suffix, tab_name);
}

jQuery(document).ready(function($) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	if (sessionStorage.getItem('watsonconv_active_tab_' + page_data.hook_suffix)) {
		switch_tab_pr_add_chat(sessionStorage.getItem('watsonconv_active_tab_' + page_data.hook_suffix));
	}

});
