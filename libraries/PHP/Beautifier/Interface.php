<?php
// Interfaces

/**
 * Interface for PHP_Beautifier and subclasses.
 * Created to made a 'legal' Decorator implementation
 *
 * @category   PHP
 * @package PHP_Beautifier
 * @author Claudio Bustos <cdx@users.sourceforge.com>
 * @copyright  2004-2010 Claudio Bustos
 * @link     http://pear.php.net/package/PHP_Beautifier
 * @link     http://beautifyphp.sourceforge.net
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: 0.1.15
 */
interface PHP_Beautifier_Interface {
	/**
	 * Process the file(s) or string
	 */
	public function process();
	/**
	 * Show on screen the output
	 */
	public function show();
	/**
	 * Get the output on a string
	 * @return string
	 */
	public function get();
	/**
	 * Save the output to a file
	 * @param string path to file
	 */
	public function save($sFile = null);
}
?>