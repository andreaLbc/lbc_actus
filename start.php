<?php 
/**
 * Actus for ELgg 1.8
 *
 * @author Andrea Porcella / Ligne bleue Cyber
 * @link http://www.ligne-bleue-cyber.com/
 * @copyright (c) Ligne bleue Cyber 2012
 * @license GNU General Public License (GPL) version 2
 */


// INITIALIZE THE PMMUGIN
elgg_register_event_handler('init','system', 'actus_init'); 


function actus_init(){
	
	// READ THE CONFIG
	global $CONFIG;
	
	// REGISTER THE URL HANDLER FOR OBJECT actus
	elgg_register_entity_url_handler('object', 'actus', 'actus_url_handler');
	
	// REGISTER THE PAGE HANDLER (manage the url for plugin);
	elgg_register_page_handler('actus', 'actus_page_handler');
	
	// Register entity type for search
	elgg_register_entity_type('object', 'page');
	
	// REGISTER OBJECT
	elgg_register_entity_type('object', 'actus');
	
	// REGISTER TRANSLATION
	register_translations($CONFIG->pluginspath . "lbc_actus/languages/", true);
	
	// REGISTER ACTION
	$action_base = elgg_get_plugins_path() . 'lbc_actus/actions/actus';
	elgg_register_action("actus/add", "$action_base/add.php");
	elgg_register_action("actus/edit", "$action_base/edit.php");
	elgg_register_action("actus/delete", "$action_base/delete.php");
	
	// EXTEND THE CSS FILE
	elgg_extend_view('css/elgg', 'actus/css');
	
	// SET MENUS FOR PLUGINS
	//elgg_register_event_handler('pagesetup', 'system', 'actus_menu_items');
	
	
	//GROUP OPTION
	// add the group files tool option
	add_group_tool_option('actus', elgg_echo('groups:enableactus'), true);
	
	// extend group main page
	elgg_extend_view('groups/tool_latest', 'actus/group_module');
	
	// add blog link to
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'actus_owner_block_menu');
	
}


/**
 * Add a menu item to an ownerblock
 */
function actus_owner_block_menu($hook, $type, $return, $params) {
	
	if (elgg_instanceof($params['entity'], 'user')) {
		$url = "actus/owner/{$params['entity']->username}";
		$item = new ElggMenuItem('actus', elgg_echo('actus'), $url);
		$return[] = $item;
	} else {
		if ($params['entity']->actus_enable != "no") {
			$url = "actus/group/{$params['entity']->guid}/all";
			$item = new ElggMenuItem('actus', elgg_echo('actus:group'), $url);
			$return[] = $item;
		}
	}
	return $return;
}

// MENU
function actus_menu_items(){
	
	// SET MENU ON TOP MENU NAVIGATION
	$item = new ElggMenuItem('actus', elgg_echo('item:object:actus'), 'actus/all');
	elgg_register_menu_item('site', $item);
	
	$owner = elgg_get_logged_in_user_entity();
	$ownerlink = 'actus/owner/'.$owner->username;
	
	
		if(elgg_is_logged_in()){
				
			elgg_register_menu_item('page',
				array(
					'name' => 'actus-1',
					'text' => elgg_echo('actus:all'),
					'href' => 'actus/all',
					'contexts' => array('actus'),
					'section' => 'actus',
					'title ' => elgg_echo('actus:all'),
				)
			);
			
			elgg_register_menu_item('page',
				array(
					'name' => 'actus-2',
					'text' => elgg_echo('actus:owner'),
					'href' => $ownerlink,
					'contexts' => array('actus'),
					'section' => 'actus',
					'title ' => elgg_echo('actus:owner'),
				)
			);
		}
	
} 


// SET THE URL ON ELGG STANDARD STRUCTURE
function actus_page_handler($page){
	
	$plugin_path= elgg_get_plugins_path();
	$base_path = $plugin_path . 'lbc_actus/pages/actus';
	
	if(!is_null($page)){
		
		switch($page[0]){
			case "add": 
						set_input('container_guid', $page[1]);
						include("$base_path/add.php"); 
						return true;
		    	break;
			
		    case "edit": 
		    			set_input('guid', $page[1]); 
		    	 		include("$base_path/edit.php"); 
		    	 		return true;
				break;
		    
		    case "group":
			    		set_input('group', $page[1]); 
			    		set_input('types', $page[2]);
			    		include("$base_path/group.php");
			    		return true;
		    break;
		    
		    case "view": 
						set_input('guid',  $page[1]);
						set_input('title', $page[2]);
						include("$base_path/view.php"); 
						return true;
			break;

			case "cropimage"   : 
						set_input('guid', $page[1]); 
						include("$base_path/form_image.php"); 
						return true;
				break;
			
			case "owner":
			case "all":
					register_error('noaccess');
					forward(REFERRER);
				break;

			case 'pdf':
				set_input('guid', $page[1]);
				include("$base_path/pdf_direct.php");
				break;
						
		}
	}
}


// SET THE OBJECT URL HANDLER ON ELGG STANDARD STRUCTURE
function actus_url_handler($object){
		global $CONFIG;
		$title = $object->title;
		$title = elgg_get_friendly_title($title);
		return $CONFIG->url . "actus/view/". $object->getGUID() . "/".$title;
}

?>