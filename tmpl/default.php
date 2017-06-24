<?php
// blokowanie bezpośredniego uruchomienia
defined('_JEXEC') or die;

$doc->addStyleSheet('modules/mod_calevents/css/calevents.css');
?>
<div class="moduleCaleventsContainer">
	<div class="moduleCaleventsRow">
		<div class="moduleCaleventsContentHeader"><?php echo JHTML::_('link', 'index.php?option=com_calendar&view=calendar' , JText::_($eventsTitle)); ?></div>
	</div>
	<div style="clear:both;"></div>
	<?php 
		if($eventsCount > 0) {
			$currentDate = date('Y-m-d H:i:s');
			foreach($eventsList as $ev) {
				$startDate = substr($ev['date_from'], 0, 10);
				$startTime = substr($ev['date_from'], 11);
				$monthId = (int)substr($startDate, 5, 2);
				$classSufix = 'Current';
				if($ev['date_from'] < $currentDate) {
					$classSufix = 'Past';
				}

				$rowHtm = '<div class="moduleCaleventsRow">';
				
					$rowHtm .= '<div class="moduleCaleventsCard">';
						$rowHtm .= '<div class="moduleCaleventsCardMonth' . $classSufix . '">';
							$rowHtm .= '<div class="moduleCaleventsCardMonth">';
							$rowHtm .= $monthNames[$monthId];
							$rowHtm .= '</div>';
						$rowHtm .= '</div>';
						$rowHtm .= '<div class="moduleCaleventsCardDay">';
							$rowHtm .= '<div class="moduleCaleventsCardDayContent">';
							$dayNumberWithoutZero = (int)substr($startDate, 8, 2);
							$rowHtm .= (string)$dayNumberWithoutZero;
							//$rowHtm .= substr($startDate, 8, 2);
							$rowHtm .= '</div>';
						$rowHtm .= '</div>';
					$rowHtm .= '</div>';
				
					$rowHtm .= '<div class="moduleCaleventsContent">';
						$rowHtm .= JHTML::_('link', 'index.php?option=com_calendar&view=event&id=' . $ev['id_calevents'], $ev['name']);
						if(!empty($startTime) && $startTime != '00:00:00') {
							$rowHtm .= '<br/>';
							$linkTitle = JText::_('godz.:') . ' ' . substr($startTime, 0, 5);
							$rowHtm .= JHTML::_('link', 'index.php?option=com_calendar&view=event&id=' . $ev['id_calevents'], $linkTitle);
						}
					$rowHtm .= '</div>';
				
				$rowHtm .= '</div>';
				$rowHtm .= '<div style="clear:both;"></div>';
				
				echo $rowHtm;
			}
		}
	?>
</div>


