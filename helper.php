<?php
// blokowanie bezpośredniego uruchomienia
defined('_JEXEC') or die;


class modCaleventsHelper {
	
	static function getEventsList($params) {
		$limit = (int)$params->get('events_limit');
		if(empty($limit) || $limit <= 0) {
			$limit = 0;
		}
		$daysCount = (int)$params->get('days_count');
		if(empty($daysCount) || $daysCount <= 0) {
			$daysCount = 0;
		}
		$endDate = '';
		$startDate = '';
		if($daysCount > 0) {
			$tsEndDate = (time() + ($daysCount * 24 * 60 * 60));
			$endDate = date('Y-m-d H:i:s', $tsEndDate);
			$startDate = date('Y-m-d H:i:s');
		}
		$sql = 'SELECT id_calevents, name, date_from FROM #__calevents WHERE published > 0';
		if(!empty($endDate) && !empty($startDate)) {
			$sql .= ' AND date_from >= "' . $startDate . '" AND date_from <= "' . $endDate . '"';
		}
		$sql .= ' ORDER BY date_from, date_to';
		if($limit > 0) {
			$sql .= ' LIMIT ' . (string)$limit;
		}
		$db =& JFactory::getDBO();
		$db->setQuery($sql);
		$retEvents = $db->loadAssocList();
		if(!empty($retEvents)) {
			return $retEvents;
		}
		//nie znaleziono zgodnie z parametrami szukanie aby cokolwiek pokazać
		$sql = 'SELECT id_calevents, name, date_from FROM #__calevents WHERE published > 0';
		$sql .= ' ORDER BY date_from DESC, date_to DESC';
		if($limit > 0) {
			$sql .= ' LIMIT ' . (string)$limit;
		}
		$db->setQuery($sql);
		return $db->loadAssocList();
	}

	static function getMonthsNames() {
		return array(1 => 'STY', 2 => 'LUT', 3 => 'MAR', 4 => 'KWI', 5 => 'MAJ', 
					 6 => 'CZE', 7 => 'LIP', 8 => 'SIE', 9 => 'WRZ', 10 => 'PAŹ', 
					 11 => 'LIS', 12 => 'GRU');
	} 
}
