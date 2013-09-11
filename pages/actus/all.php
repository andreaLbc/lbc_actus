<?php
/**
 * Actus for ELgg 1.8
 * List all actus
 *
 * @author Andrea Porcella / Ligne bleue Cyber
 * @link http://www.ligne-bleue-cyber.com/
 * @copyright (c) Ligne bleue Cyber 2012
 * @license GNU General Public License (GPL) version 2
 */

// GET CONFIG
global $CONFIG;


// SET CONTEXT
elgg_set_context('actus');


// SET THE ADD MENU
elgg_register_title_button('actus');


// SET CANVAS ELEMENTS AND VIEW LAYOUT
$title    = elgg_echo('actus:all');

// SET PAGE OWNER
elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());

// SET THE BREADCRUMB (file d'arianne)
elgg_pop_breadcrumb();
elgg_push_breadcrumb(elgg_echo('actus'));
elgg_push_breadcrumb($title);


// LOAD THE LIST OF ELEMENTS
$options = array(
        'types'		       => 'object',
		'subtypes'	       =>  array('actus'),
        'site_guids'       => $CONFIG->site_guid,
		'offset'           => (int) max(get_input('offset', 0), 0),
		'limit'            => (int) max(get_input('limit', 10), 0),
		'pagination' => TRUE,
);
$entities = elgg_get_entities($options);
$count =    elgg_get_entities(array_merge(array('count' => TRUE), $options));


// SET CANVAS ELEMENTS AND VIEW LAYOUT
$option_content = array(
		'count'        => $count,
		'offset'       => (int) max(get_input('offset', 0), 0),
		'limit'        => (int) max(get_input('limit', 10), 0),
		/*'list_class' => CSS class applied to the list*/
		/*'item_class' => /*CSS class applied to the list items*/
		'full_view'    => FALSE,
		'list_type' => 'list',
		'list_type_toggle' => FALSE,
		'pagination' => TRUE,
		
);
$content .= elgg_view_entity_list($entities, $option_content);


$option_view_page =array(
	'content' => $content,
	'title' => $title,
	'filter' => '',
	
);

if(!is_manager()){
	$option_view_page['buttons']=" ";
}

// GET THE BODY OF PAGE
$body = elgg_view_layout('content', $option_view_page);


// PRINT PAGE
echo elgg_view_page($title, $body);
?>