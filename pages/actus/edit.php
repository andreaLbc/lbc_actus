<?php 
/**
 * Actus for ELgg 1.8
 * Edit one actus
 * 
 * @author Andrea Porcella / Ligne bleue Cyber
 * @link http://www.ligne-bleue-cyber.com/
 * @copyright (c) Ligne bleue Cyber 2012
 * @license GNU General Public License (GPL) version 2
 */


// ONLY LOGED IN USER
gatekeeper();

global $CONFIG;

// GET ENTITY GUID AND VALUE
$guid=get_input('guid');
$object=get_entity($guid);



// CTRL SUBTYPE if not 'actus' forward to Homepage
if($object->getSubtype()!='actus'){
	register_error(elgg_echo('noaccess'));
	forward();
}


// CTRL CONTAINER GUID
$container_guid = $object->container_guid;
$container = get_entity($container_guid);
set_input('container_guid', $container_guid);

// SET PAGE OWNER
 elgg_set_page_owner_guid($container_guid);


//SET CONTEXT
elgg_set_context('actus');
if($contrainer instanceof ElggGroup){
	elgg_set_context('groups');
}


//SET CANVAS ELEMENTS
$title = elgg_echo('actus:edit');

	//SET BREADCRUMB
	if (elgg_instanceof($container, 'group')) {
		elgg_push_breadcrumb(elgg_echo('groups'), 'groups/all');
		elgg_push_breadcrumb($container->name, $container->getURL());
		elgg_push_breadcrumb(elgg_echo('actus'));
	} 
	else {
		elgg_push_breadcrumb(elgg_echo('actus'));
		elgg_push_breadcrumb(elgg_echo('actus:owner'), 'pg/actus/owner/'.$_SESSION[user]->username);
	}
	elgg_push_breadcrumb($title);
	elgg_push_breadcrumb($object->title, $object->getURL());

	
// SET CANVAS ELEMENTS
$content = elgg_view('forms/actus/add', array("entity"=>$object));


//SET VIEW LAYOUT
$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

//PRINT PAGE
echo elgg_view_page($title, $body);
?>