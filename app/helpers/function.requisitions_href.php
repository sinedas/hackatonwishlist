<?php

function smarty_function_requisitions_href($params, $name)
{	
	if ($params['href'] == $_SESSION['order']['param']) {
		if ($_SESSION['order']['order'] == 'ASC') {
			$imgSrc = '&nbsp;<img src="img/up.jpg" />';
		} else {
			$imgSrc = '&nbsp;<img src="img/down.jpg" />';
		}
	} else {
		$imgSrc = '';
	}
		
	if ($params['deleted'] == 1) {
		return '<a href="?/archyvesort/param/' . $params['href'] . '">' . $params['name'] . '</a>' . $imgSrc;
	} else {
		return '<a href="?/sort/param/' . $params['href'] . '">' . $params['name'] . '</a>' . $imgSrc;
	}
}

?>
