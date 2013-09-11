<?php
/**
 * Group pages
 *
 * @package ElggPages
 */

$group = elgg_get_page_owner_entity();


if ($group->actus_enable == "no") {
	return true;
}

$all_link = elgg_view('output/url', array(
	'href' => "actus/group/$group->guid/all",
	'text' => elgg_echo('link:view:all'),
	'is_trusted' => true,
));


elgg_push_context('widgets');
$options = array(
	'type' => 'object',
	'subtype' => 'actus',
	'limit' => 3,
	'full_view' => false,
	'pagination' => false,
	'container_guid'=>$group->guid,
);
$content = elgg_list_entities($options);
elgg_pop_context();

if (!$content) {
	$content = '<p>' . elgg_echo('pages:none') . '</p>';
}

$new_link = elgg_view('output/url', array(
	'href' => "actus/add/$group->guid",
	'text' => elgg_echo('actus:add'),
	'is_trusted' => true,
));

echo elgg_view('groups/profile/module', array(
	'title' => elgg_echo('actus'),
	'content' => $content, 
	'all_link' => $all_link,
	'add_link' => $new_link,
));
