<?php
/**
 * Actus for ELgg 1.8
 * Create a new actus
 * 
 * @author Andrea Porcella / Ligne bleue Cyber
 * @link http://www.ligne-bleue-cyber.com/
 * @copyright (c) Ligne bleue Cyber 2012
 * @license GNU General Public License (GPL) version 2
 */

// ONLY LOGGED IN USERS
gatekeeper();

global $CONFIG;

// GET THE CONTAINER-GUID INFO
$container_guid= get_input('container_guid', 0);
$container = get_entity($container_guid);

	// if not container and container if not ElggUser or ElggGroup forward to home
	if (!$container || !elgg_instanceof($container)) {
		register_error(elgg_echo('noaccess'));
		forward();
	}

	
//SET PAGE OWNER
elgg_set_page_owner_guid($container_guid);


//SET CONTEXT
elgg_set_context('actus');
if($contrainer instanceof ElggGroup){
	elgg_set_context('groups');
}



//SET CANVAS ELEMENTS
$title = elgg_echo('actus:add');

	//SET BREADCRUMB
	if (elgg_instanceof($container, 'group')) {
		elgg_push_breadcrumb(elgg_echo('groups'), 'groups/all');
		elgg_push_breadcrumb($container->name, $container->getURL());
		elgg_push_breadcrumb(elgg_echo('actus'));
	} else {
		elgg_push_breadcrumb(elgg_echo('actus'));
		elgg_push_breadcrumb(elgg_echo('actus:owner'), 'pg/actus/owner/'.$_SESSION[user]->username);
	}
	elgg_push_breadcrumb($title);
	
	

$content .= elgg_view('forms/actus/add');


//SET VIEW LAYOUT
$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));


//PRINT PAGE
echo elgg_view_page($title, $body);

?>