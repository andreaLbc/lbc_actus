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


//GET THE VALUE FROM FORM
$title = get_input('title');
$excerpt = get_input('excerpt');
$description = get_input('description', null, false);
$url = get_input('url');
$video = get_input('video');
$upload_pdf = get_input('upload_pdf');
$tags = get_input('tags');
$access_id = get_input('access_id');
$statut = get_input('statut');
$comments_on = get_input('comments_on');
$container_guid = get_input('container_guid');


//CONVERT TAGS VALUE IN ONE PREFORMATTED ARRAY
$tagarray = string_to_tag_array($tags);


//SET THE ERROR CONTROLL
$error='';


//CONTROLL THE REQUIRED VALUE
if ($title==null || $description==null){
		$error=1;
}

    
//ADD NEW OBJECT
if (!$error){

	$addAction= new ElggObject();
	$addAction->subtype="actus";
	$addAction->title=$title;
	$addAction->excerpt=$excerpt;
	$addAction->description=$description;
	$addAction->url=$url;
	$addAction->video=$video;
	$addAction->statut=$statut;
	$addAction->access_id=$access_id;
	
    if (is_array($tagarray)){$addAction->$metatags = $tagarray;}
	
    $addAction->owner_guid=$_SESSION['user']->guid;
	$addAction->container_guid=$container_guid;
	
	//SAVE
	$newGuid=$addAction->save();
	
	if( $newGuid ){
		if(isset($_FILES['upload_pdf']) && $_FILES['upload_pdf']['error']==0){
			//$ctrlGuid= $page->getGUID();

			$pdf = lbc_upload_pdf($_FILES['upload_pdf'], $newGuid);
			$addAction->pdf = $pdf;
			$addAction->save();
		}
	} else {
		$error = 2;
	}
}


//SET FILES NEW INSERT
if(!$error){
	
	/*global $CONFIG;
	add_object_language($newGuid, $lang);
	add_to_river('river/object/actus','create',$_SESSION['user']->guid, $newGuid, "");
	
	if($_FILES['file']['error']==null OR $_FILES['img']['error']==null){
		
		$addFile=get_entity($newGuid); 
		
		$filesValue= b_files($_FILES, $delfile, 'actus', $newGuid, $lang);
	    $addFile=get_entity($newGuid);
	    if(is_array($filesValue)){
			foreach($filesValue as $k=>$v){
				$addFile->$k=$v;
			}
		}
		$addFile->save;
		
	}*/
	
}


//CONTROLL ERROR AND SET THE SYSTEM MESSAGE
if($error==1){
	register_error(elgg_echo('actus:error:values'));
	forward("pg/actus/add/".$container_guid);
}
else if($error==2){
  	register_error(elgg_echo('actus:edit:notsucces'));
	forward("pg/actus/add/".$container_guid);
}
else{
	system_message(elgg_echo('actus:edit:succes'));
	if(!$filesValue['img_or']){
		    if($_SESSION['user']->guid == $container_guid){
				forward("/actus/owner/".$_SESSION['user']->username);
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
		forward("pg/actus/cropimage/".$newGuid);
	}
}
	
?>