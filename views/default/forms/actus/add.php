<?php 
/**
 * Actus for ELgg 1.8
 * Form for create and edit the acuts
 *
 * @author Andrea Porcella / Ligne bleue Cyber
 * @link http://www.ligne-bleue-cyber.com/
 * @copyright (c) Ligne bleue Cyber 2012
 * @license GNU General Public License (GPL) version 2
 */

global $CONFIG;

//GET CONTAINER GUID
$container_guid = get_input('container_guid');


//GET SETTING FOR LANGUAGE
//$setting = $CONFIG->multilanguages;


if(isset($vars['entity'])){
 	

	//GET THE VALUE FROM FORM
 	$guid=$vars['entity']->getGUID();
 	$title=$vars['entity']->title;
 	$excerpt=$vars['entity']->excerpt;
 	$description= $vars['entity']->description;
 	$url=$vars['entity']->url;
 	$video=$vars['entity']->video;
 	$pdf=$vars['entity']->pdf;
 	$tags=$vars['entity']->tags;
 	$access_id=$vars['entity']->access_id;
    
 	// SET ADD ACTION 
 	$action=$vars['url']. "action/actus/edit";
 	$edit=true;
    
}
    
else{
	// SET EDIT ACTION 
	$action=$vars['url']. "action/actus/add";
}


// PREPARE THE FORM BODY

$form_body  .= '<div class="block_form">';
	$form_body .=  elgg_view('input/categories', $vars);
$form_body .= '</div>';


$form_body  .= '<div class="block_form">';
	$form_body .= '<label>'.elgg_echo('actus:formAdd:title').'</label>';			
	$form_body .= elgg_view('input/text', array( "name"=>"title", "value"=>$title, "classValidate"=>"validate[required] text-input"));
$form_body .= '</div>';

$form_body  .= '<div class="block_form">';
	$form_body .= '<label>'.elgg_echo('actus:formAdd:excerpt').'</label>';
	$form_body .= elgg_view('input/plaintext', array( "name"=>"excerpt", "value"=>$excerpt, "classValidate"=>"validate[required] text-input"));
$form_body .= '</div>';

$form_body .= '<div class="block_form">';
	$form_body .= '<label>'.elgg_echo('actus:formAdd:description').'</label>';
	$form_body .= elgg_view('input/longtext', array( "name"=>"description", "value"=>$description, "classValidate"=>"validate[required] text-input"));
$form_body .= '</div>';

$form_body .= '<div class="block_form">';
	$form_body .= '<label>'.elgg_echo('actus:formAdd:video').'</label>';
	$form_body .= elgg_view('input/multiple_inputs', array( "name"=>"video", "value"=>$video, "type"=>"video", "classValidate"=>"validate[custom[url]] text-input"));
$form_body .= '</div>';

$form_body .= '<div class="block_form">';
	$form_body .= '<label>'.elgg_echo('actus:formAdd:url').'</label>';
	$form_body .= elgg_view('input/multiple_inputs', array( "name"=>"url", "value"=>$url, "type"=>"links",  "classValidate"=>"validate[custom[url]] text-input"));
$form_body .= '</div>';

$form_body .= '<div class="block_form">';
$form_body .= '<label>'.elgg_echo('actus:formAdd:upload_pdf').'</label>';
$form_body .= $pdf ? '<br /><span>'.elgg_echo('actus:formAdd:pdf_exist').'</span>': '';
$form_body .= elgg_view('input/file', array( "name"=>"upload_pdf", "id"=>'upload_pdf'));
$form_body .= '</div>';

$form_body .= '<div class="block_form">';
	$form_body .= '<label>'.elgg_echo('tags').'</label>';
	$form_body .=  elgg_view('input/tags', array( "name"=>"tags", "value"=>$tags,  "classValidate"=>"validate[custom[tags]] text-input"));
$form_body .= '</div>';


$form_body .= '<div class="block_form">';
$form_body .= '<label>'.elgg_echo('comments').'</label> ';
$form_body .= elgg_view('input/dropdown', array(
		'name' => 'comments_on',
		'id' => 'blog_comments_on',
		'value' => $comments,
		'options_values' => array('On' => elgg_echo('on'), 'Off' => elgg_echo('off'))
));
$form_body .= '</div>';


$form_body .= '<div class="block_form">';
	$form_body .= '<label>'. elgg_echo('status').'</label> ';
	$form_body .=  elgg_view('input/dropdown', array(
							'name' => 'status',
							'id' => 'status',
							'value' => $status,
							'options_values' => array(
									'draft' => elgg_echo('status:draft'),
									'published' => elgg_echo('status:published')
							)
					));
$form_body .= '</div>';





$form_body .= '<div class="block_form">';
	$form_body .= '<label>'.elgg_echo('access:read').'</label> ';
	$form_body .=  elgg_view('input/access', array(
							'name' => 'access_id',
							'id' => 'access_id',
							'value' => $access_id
					));
$form_body .= '</div>';

$form_body .= elgg_view('input/hidden', array("name"=>"container_guid",  "value"=>$container_guid));

$form_body .= elgg_view('input/submit', array("value"=>elgg_echo("save")));


if($edit){
	$form_body .= elgg_view('input/hidden', array("name"=>"guid",  "value"=>$vars['entity']->getGUID()));
}


// PRINT THE FORM
echo elgg_view('input/form', array("action"=>$action, "body"=>$form_body));
?>