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

// ONLY LOGED IN USER
gatekeeper();

$group = get_input('group');
$container = get_entity($group);

//SET PAGE OWNER
elgg_set_page_owner_guid($group);

//die($group);

// SET CONTEXT
elgg_set_context('groups');


// SET THE ADD MENU
elgg_register_title_button('actus');


// SET CANVAS ELEMENTS AND VIEW LAYOUT
$title    = elgg_echo('actus:group');


// SET THE BREADCRUMB (file d'arianne)
//elgg_push_breadcrumb(elgg_echo('dashboard'), '/activity');
elgg_push_breadcrumb(elgg_echo('groups'), '/groups/all');
elgg_push_breadcrumb($container->name, $container->getURL());
elgg_push_breadcrumb(elgg_echo('actus:group'));


// LOAD THE LIST OF ELEMENTS
$options = array(
		'types'		       => 'object',
		'subtypes'	       =>  array('actus'),
		'site_guids'       => $CONFIG->site_guid,
		'offset'           => (int) max(get_input('offset', 0), 0),
		'limit'            => (int) max(get_input('limit', 10), 0),
		'full_view'        => FALSE,
		'list_type' => 'list',
		'list_type_toggle' => FALSE,
		'pagination' => TRUE,
		'container_guid'=>$group,
		
);
$entities = elgg_get_entities_from_metadata($options);
$count =    elgg_get_entities_from_metadata(array_merge(array('count' => TRUE), $options));


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
