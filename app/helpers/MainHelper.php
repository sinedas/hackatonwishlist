<?php

class MainHelper {

	/**
	 * Renders link.
	 *
	 * @param string $text
	 * @param string $link
	 * @param string $style
	 * @static
	 */
	function renderLink($text, $link, $styleClass) {
		return "<a href=\"" . $link . "\" class=\"" . $styleClass . "\">" . $text . "</a>";
	}

}

?>