<?php
/**
 * Group pages
 *
 * @package ElggPages
 */

$options = array(
	'type' => 'object',
	'subtype' => 'actus',
	'limit' => 3,
	'full_view' => false,
	'pagination' => false,
);
$entities = elgg_get_entities($options);

$content="";
$li='';

foreach($entities as $entity){
	$li .= '<li id="elgg-object-'.$entity->guid.'" class="elgg-item">';
	$li .= '<div class="elgg-image-block clearfix">';
	$li .= '<div class="elgg-body">';
		
		/*$metadata = elgg_view_menu('entity', array('entity' => $entity,'handler' => 'actus','sort_by' => 'priority','class' => 'elgg-menu-hz',));*/
		$params = array(
				'entity' => $entity,
				'full_view'=>'cms'
		);
		$li .= elgg_view('object/actus', $params);
		
	$li .= '</div>';
	$li .= '</div>';
	$li .= '</li>';
}

$content  = '<ul class="elgg-list elgg-list-entity">';
	$content .= $li;
$content .= '</ul>'; 


if (!$content) {
	$content = '<p>' . elgg_echo('pages:none') . '</p>';
}

$all_link = elgg_view('output/url', array(
		'href' => "actus/all",
		'text' => elgg_echo('actus:all'),
		'is_trusted' => true,
));

$new_link = elgg_view('output/url', array(
	'href' => "pages/add/$group->guid",
	'text' => elgg_echo('pages:add'),
	'is_trusted' => true,
));

echo elgg_view('cms/module', array(
	'title' => elgg_echo('actus'),
	'content' => $content,
	'all_link' => $all_link,
	'add_link' => $new_link,
));

