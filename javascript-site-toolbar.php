<?php /*
|--------------------------------------------------------------------------
		                    _______________  _______________
		                 .'               .'               .|
		               .'               .'               .' |
		             .'_______________.'______________ .'   |
		             | ___ _____ ___ || ___ _____ ___ |     |
		             ||_=_|__=__|_=_||||_=_|__=__|_=_||     |
		       ______||_____===_____||||_____===_____||     | __________
		    .'       ||_____===_____||||_____===_____||    .'          .'|
		  .'         ||_____===_____||||_____===_____||  .'          .'  |
		.'___________|_______________||_______________|.'__________.'    |
		|.----------.|.-----___-----.||.-----___-----.||    |_____.----------.
		|]          |||_____________||||_____________|||  .'      [          |
		||          ||.-----___-----.||.-----___-----.||.'        |          |
		||          |||_____________||||_____________|||==========|          |
		||          ||.-----___-----.||.-----___-----.||    |_____|          |
		|]         o|||_____________||||_____________|||  .'      [        'o|
		||          ||.-----___-----.||.-----___-----.||.'        |          |
		||          |||             ||||_____________|||==========|          |
		||          |||             |||.-----___-----.||    |_____|          |
		|]          |||             ||||             |||  .'      [          |
		||__________|||_____________||||_____________|||.'________|__________|
		''----------'''------------------------------'''----------''
		            (o)LGB                           (o)

							JavaScript Site Toolbar

|--------------------------------------------------------------------------
|
	Plugin Name: JavaScript Site Toolbar
	Description: Adds a toolbar with custom JavaScript-powered buttons
	Version: 0.1.0
	Author: Carlos Ramos
	Author URI: http://web1776.com
	License: Proprietary
| 
* TODO: Add a bunch of built in buttons
* TODO: Visual parent element selector (sort of like CTRL+SHIFT+C in Chrome)
*/
namespace web1776\jstoolbar;
require_once('lib/advanced-custom-fields/acf.php');
if(!class_exists('acf_field_code_area_plugin')) require_once('lib/advanced-custom-fields-code-area-field/acf-code_area.php');
if(!class_exists('acf_options_page_plugin')) require_once('lib/acf-options-page/acf-options-page.php');

//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Admin Menu
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
if(function_exists('acf_add_options_sub_page')){
	acf_add_options_sub_page(array(
		'title'		=> 'Settings',
		'parent'	=> 'edit.php?post_type=jstoolbar',
		'capability'=> 'manage_options'
	));
}

//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Registe Post type
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
add_action('init', function(){
	/*================================================================================
	| Documents
	================================================================================*/
	register_post_type('jstoolbar', array(
		'label'			=> 'JS Toolbar Buttons',
		'labels'		=> array(
			'name'				=> __('JS Toolbar Buttons'),
			'singular_name'		=> __('JS Toolbar Button'),
			'add_new'			=> (_x('Add New', 'Toolbar Button')),
			'all_items'			=> __('All Buttons'),
			'add_new_item'		=> __('Add New Button'),
			'edit_item'			=> __('Edit Button'),
			'new_item'			=> __('New Button'),
			'view_item'			=> __('View Button'),
			'search_items'		=> __('Search Buttons'),
			'not_found'			=> __('No Buttons found'),
			'not_found_in_trash'=> __('No Buttons found in trash'),
			'menu_name'			=> __('Toolbar Buttons')
		),
		'description'	=> 'Adds a new toolbar item to the JavaScript Site Toolbar',
		'public'		=> true,
		'capability'	=> 'manage_options',
		'menu_icon'		=> plugin_dir_url(__FILE__).'anything-toolbar.png',
		'supports'		=> array('title')
	));
});

//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Display in front end
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
add_action('wp_footer', function(){ 
	echo '<aside id="javascript-site-toolbar">';
		
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		// Add each button + javascript + css
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		$btns = get_posts([
			'post_type'	=> 'jstoolbar',
			'orderby'	=> 'menu_order'
		]);
		foreach($btns as $btn){
			'<div class="'.$btn.'">'..'</div>';
		}		

	echo '</aside>';
});