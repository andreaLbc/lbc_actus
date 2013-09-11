<?php 

action_gatekeeper();

//GET VALUE FROM FORM
$guid=get_input('guid');
$object=get_entity($guid);
$owner=$object->getOwnerEntity();


//DELETE ENTITY AND SET THE SYSTEM MESSAGE
if(delete_entity($guid)){
	system_message($view.elgg_echo('b_actus:delete:succes'));
}
else{
	system_message($view.elgg_echo('b_actus:delete:notsucces'));
}


//SET FORWARD
if(is_manager() && $owner== $_SESSION['user']->getGUID()){
			forward("pg/actus/list/".$_SESSION['user']->getGUID());
}
else if(is_manager() && $owner!= $_SESSION['user']->getGUID()){
			forward("pg/actus/all/");
}
else if(!is_manager()){
			forward("pg/dashboard/");
}

?>