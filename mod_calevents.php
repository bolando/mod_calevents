<?php
// blokowanie bezposredniego uruchomienia
defined('_JEXEC') or die;

//wlaczenie klasy modelu
require_once dirname(__FILE__) . '/helper.php';

//wywolanie metody modelu pobierajacej wydarzenia 
$eventsList = modCaleventsHelper::getEventsList($params);
$monthNames = modCaleventsHelper::getMonthsNames();

//pobieranie innych danych
$eventsTitle = $params->get('calevents_title');
$eventsCount = 0;
if(!empty($eventsList)) {
	$eventsCount = count($eventsList);
}

$doc =& JFactory::getDocument();

//wlaczenie domyslnego layoutu
require JModuleHelper::getLayoutPath('mod_calevents');
