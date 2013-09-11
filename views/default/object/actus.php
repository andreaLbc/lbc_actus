<?php
/**
 * Actus for ELgg 1.8
 * View for actus objects
 *
 * @author Andrea Porcella / Ligne bleue Cyber
 * @link http://www.ligne-bleue-cyber.com/
 * @copyright (c) Ligne bleue Cyber 2012
 * @license GNU General Public License (GPL) version 2
 */

$full = elgg_extract('full_view', $vars, FALSE);
$entity = elgg_extract('entity', $vars, FALSE);
$videos = null;

if(!entity){
	return TRUE;
}
if($entity){
	if(is_manager() || $entity->public){$ctrlPublic=true;}
	else{$ctrlPublic=false;}
}


// SET THE VALUES AND ELEMENTS FOR OUTPUT

	// Container
	$container = $entity->getContainerEntity();
	
	// Categories
	$categories = elgg_view('output/categories', $vars);
	
	// Excerpt
	$excerpt = $entity->excerpt;
	if (!$excerpt) {
		$excerpt = elgg_get_excerpt($entity->description);
	}
	if($entity->video){
		$video_thumb	=	manager_oembed_thumb($entity->video, 'medium');
		if( $video_thumb ){
			$excerpt .='<div class="video_img"><a href="'.$entity->getURL().'"><img src="'.$video_thumb.'" title="'.$video_thumb.'" /></a></div>';
		}
	}

	// Owner
	$owner = $entity->getOwnerEntity();
	$owner_icon = elgg_view_entity_icon($owner, 'tiny');
	$owner_link = elgg_view('output/url', array(
			'href' => "actus/owner/$owner->username",
			'text' => $owner->name,
			'is_trusted' => true,
	));
	$author_text = elgg_echo('byline', array($owner_link));
	$date = elgg_view_friendly_time($entity->time_created);


	// Comments
	if ($entity->comments_on != 'Off') {
		$comments_count = $entity->countComments();
		//only display if there are commments
		if ($comments_count != 0) {
			$text = elgg_echo("comments") . " ($comments_count)";
			$comments_link = elgg_view('output/url', array(
					'href' => $entity->getURL() . '#actus-comments',
					'text' => $text,
					'is_trusted' => true,
			));
		} else {
			$comments_link = '';
		}
	} else {
		$comments_link = '';
	}
	
	// Menu of entity
	$metadata = elgg_view_menu('entity', array(
			'entity' => $vars['entity'],
			'handler' => 'actus',
			'sort_by' => 'priority',
			'class' => 'elgg-menu-hz',
	));
	
	// do not show the metadata and controls in widget view
	if (elgg_in_context('widgets')) {
			$metadata = '';
	}
	
	//Subtitle
	$subtitle = "$author_text $date $comments_link $categories";

	
	
// SWITCH THE VIEW
if($full){
    
	$body = elgg_view('output/longtext', array(
		'value' => $entity->description,
		'class' => 'blog-post',
	));

	
	
	if($entity->video){
		$body .= elgg_view('output/video', array('video'=>$entity->video)); 
	}
	
	if($entity->url){
		$body .= elgg_view('output/urls', array('links'=>$entity->url));
	}

	if($entity->pdf){
		$body .= elgg_view('output/pdf_img_preview', array('guid'=>$entity->guid));
	}
	
	$params = array(
		'entity' => $entity,
		'title' => false,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
	);
	
	$params = $params + $vars;
	$summary = elgg_view('object/elements/summary', $params);

	echo elgg_view('object/elements/full', array(
		'summary' => $summary,
		'icon' => $owner_icon,
		'body' => $body,
	));

}
else{
	$params = array(
			'entity' => $entity,
			'metadata' => $metadata,
			'subtitle' => $subtitle,
			'content' => $excerpt,
			'tags'=>false
	);
	$params = $params + $vars;
	$list_body = elgg_view('object/elements/summary', $params);
	 
	echo elgg_view_image_block($owner_icon, $list_body);
}
?>