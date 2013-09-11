<?php 
$french = array(
/**
 * Menu items and titles
 */
	        
	/**
	 * Object
	 */
	'actus' => "Actualités du groupe",
	'item:object:actus' => "Actualités",
	'actus:group' => "Actualité du groupe",
			
			
			
	/**
	 * Menu and pages titles
	 */
	'actus:add' => "Ajouter une actualité",
	'actus:all' => "Toutes les actualités",
	'actus:owner' => "Vos actualités",
	'actus:friends' => "Friends actualités",
	'actus:view' => "Voir l'actualité",
    'actus:edit'=>"Modifier l'actualité",
			
			
	/**
	 * Formulaire
	 */
	'actus:formAdd:title' => "Titre de l'actualité *",
	'actus:formAdd:excerpt'=> "Extrait de l'actualité *",
	'actus:formAdd:description' => "Texte de l'actualité *",			
	'actus:formAdd:url' => "Lien",
	'actus:formAdd:upload_pdf' => "Fichier PDF",
	'actus:formAdd:pdf_exist' => "Un fichier PDF est présent, pour le remplacer chargez le nouveau PDF ci-dessous",
			
			
	/**
	 * Action report
	 */
	'actus:edit:succes'=>"Votre actualité a été enregistrée avec succès.",
    'actus:edit:notsucces'=>"Votre actualité n'a pas été correctement enregistrée. Contactez le-a super administrateur-trice.",
    'actus:delete:confirm'=>"Etes-vous sûr-e de vouloir supprimer cette actualité ?", 
    'actus:delete:succes'=>"Votre actualité a été supprimée avec succès.",
	'actus:delete:notsucces'=>"Votre actualité n'a pas été correctement supprimée. Contactez le-a super administrateur-trice.",
	'actus:error:values' =>"Erreur !<br>Vérifiez que tous les champs obligatoires (*) sont remplis.",			
			
			
	/**
	 * View block colonne
	 */
	'actus:colonne_link' => "Voir toutes les actualités ",
	        

	/**
	 * River
	 */
	'actus:river:create' => "%s a mis a jour une page intitulée",
	'actus:river:update' => "%s a mis a jour une page intitulée",
	'actus:river:annotate' => "un commentaire sur l'actu",
		
	/**
	 * Goups module
	 */
	"groups:enableactus"=>"Autoriser le module 'Actualité' du groupe"
			
);					
add_translation("fr",$french);