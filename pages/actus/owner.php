<?php
/**
 * Actus for ELgg 1.8
 * List all owner actus (owner is a Group or User)
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


// GET THE OWNER USERNAME
$username = get_input('username');
$owner = get_user_by_username($username);


//CTRL THE OWNER
if(!elgg_instanceof($owner)){
	register_error(elgg_echo('noaccess'));
	forward();
}


//SET PAGE OWNER
elgg_set_page_owner_guid($owner->guid);


//SET CONTEXT
elgg_set_context('actus');


// SET THE ADD MENU
elgg_register_title_button('actus');


$title = elgg_echo('actus:owner');
	//Set breadcrumb
	elgg_push_breadcrumb(elgg_echo('actus'));
	elgg_push_breadcrumb(elgg_echo('actus:owner'));
	



// LOAD THE LIST ELEMENTS
$options = array(
        'types'		       => 'object',
		'subtypes'	       =>  array('actus'),
        'site_guids'       => $CONFIG->site_guid,
		'offset'           => (int) max(get_input('offset', 0), 0),
		'limit'            => (int) max(get_input('limit', 10), 0),
		'full_view'        => FALSE,
		'view_type_toggle' => FALSE,
		'pagination' => TRUE,
		'owner_guid'       => $owner->guid,
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


// GET THE BODY OF PAGE
$body = elgg_view_layout('content', array(
	'content' => $content,
	'title' => $title,
	'filter'=>'',
));


// PRINT PAGE
echo elgg_view_page($title, $body);
?>