<?php 
/**
 * Actus for ELgg 1.8
 * Action for create and edit the acuts
 *
 * @author Andrea Porcella / Ligne bleue Cyber
 * @link http://www.ligne-bleue-cyber.com/
 * @copyright (c) Ligne bleue Cyber 2012
 * @license GNU General Public License (GPL) version 2
 */


action_gatekeeper();


//GET VALUE FROM FORM
$guid= get_input('guid', 0);
$title = get_input('title');
$excerpt = get_input('excerpt');
$description = get_input('description', null, false);
$url = get_input('url');
$video = get_input('video');
$tags = get_input('tags');
$access_id = get_input('access_id');
$statut = get_input('statut');
$comments_on = get_input('comments_on');
$container_guid = get_input('container_guid');

//CONVERT TAGS VALUE IN ONE PREFORMATTED ARRAY
$tagarray = string_to_tag_array($tags);


//SET THE ERROR CONTROLL
$error='';

//echo'<pre>'; print_r($url); echo'</pre>';
//echo'<pre>'; print_r($video); echo'</pre>';
//die();

//CONTROLL THE REQUIRED VALUE
if ($title==null || $description==null){
		$error=1;
}


//EDIT ENTITY
if (!$error){
	
	$editAction=get_entity($guid);
	
	$editAction->title=$title;
	$editAction->excerpt=$excerpt;
	$editAction->description=$description;
	$editAction->url=$url;
	$editAction->video=$video;
	$editAction->statut=$statut;
	$editAction->access_id=$access_id;
	
    if (is_array($tagarray)){$editAction->tags = $tagarray;}
	
	//SAVE EDIT
	if(is_null($editAction->save())){$error=2;}
	else{
		//global $CONFIG;
		//if(trigger_elgg_event('actus_update',"",$guid)){$error=2;}
		//add_to_river('river/object/actus','update',$editAction->getOwner(),$editAction->getGUID(), "");
		if(isset($_FILES['upload_pdf']) && $_FILES['upload_pdf']['error']==0){
			//$ctrlGuid= $page->getGUID();
		
			$pdf = lbc_upload_pdf($_FILES['upload_pdf'], $guid);
			$editAction->pdf = $pdf;
			$editAction->save();
		}
	}

}


//CONTROLL ERROR AND SET THE SYSTEM MESSAGE
if ($error==1) {
	register_error($mess.elgg_echo('actus:error:values'));
    forward("pg/actus/add/".$container_guid);
}

else if($error==2){
	register_error(elgg_echo('actus:edit:notsucces'));
	forward("pg/actus/add/".$container_guid);
}
else{
	system_message(elgg_echo($mess.'actus:edit:succes'));
	
	if(!$filesValue['img_or']){
		if($_SESSION['user']->guid == $container_guid){
			forward("pg/actus/owner/".$_SESSION['user']->username);
		}
	    else if(get_entity($container_guid)instanceof ElggGroup){
		   	forward("/actus/group/".$container_guid."/all");
		 }
		    else{
		    	forward("/actus/all/");
		    }
	}
	else{
		$idImg=get_metastring_id($filesValue['img_or']);
		forward("pg/actus/cropimage/".$guid);
	}
}


?>