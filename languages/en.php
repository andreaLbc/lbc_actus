<?php
$english = array(
/**
 * Menu items and titles
 */

	/**
	 * Object
	 */
	'actus' => "News",
	"item:object:actus" => "News",
	"blockmenu:actus" => "News",
	'actus:group' => "Group news",
			
			
	/**
	 * Menu and pages titles
	 */
	'actus:add' => "Insert news item",
	'actus:all' => "All news",
	'actus:owner' => "Your news",
	'actus:friends' => "News from your friends",
	'actus:view' => "View news item",
	'actus:edit'=>"Edit news item",
	
			
			
	/**
	 * Formulaire
	 */
	'actus:formAdd:title' => "News headlines *",
	'actus:formAdd:excerpt'=> "News excerpt *",	
	'actus:formAdd:description' => "News content *",
	'actus:formAdd:url' => "Link",
	'actus:formAdd:video' => "Link of video",

			
			
	/**
	 * Action report
	 */
	"actus:edit:succes"=>"Your news item was successfully saved",
	"actus:edit:notsucces"=>"Your news item was not correctly saved. Please contact your administrator",
	"actus:delete:confirm"=>"Are you sure you want to delete this news item?",
	"actus:delete:succes"=>"Your news item was successfully deleted",
	"actus:delete:notsucces"=>"Your news item cannot be deleted at this time. Please contact your administrator",
	"actus:error:values" =>"Error! Check that all required fields are correctly completed!",
			
			
	/**
	 * View block colonne
	 */
	'actus:colonne_link' => "Voir toutes les actualités Zebridge ",
		 
		
	/**
	 * River
	 */
	"actus:river:create" => "%s has posted a new news item entitled",
	"actus:river:update" => "%s has posted a new news item entitled",
	"actus:river:annotate" => "%s has commented a news item",
	
		
	/**
	 * Goups module
	 */
	"groups:enableactus"=>"Enable group news"			
			
);

add_translation("en",$english);