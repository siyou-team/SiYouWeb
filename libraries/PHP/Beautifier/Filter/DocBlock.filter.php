<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Filter Doc Blocks: Use DocBlockGenerator for beautify the phpdoc comments.
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.0 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_0.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 * @category   PHP
 * @package    PHP_Beautifier
 * @subpackage Filter
 * @author     Jesús Espino <jespinog@gmail.com>
 * @copyright  2010 Jesús Espino
 * @link       http://pear.php.net/package/PHP_Beautifier
 * @link       http://beautifyphp.sourceforge.net
 * @license    http://www.php.net/license/3_0.txt PHP License 3.0
 * @version    CVS: $Id:$
 */
/**
 * Filter Doc Blocks: Use DocBlockGenerator for beautify the phpdoc comments.
 * Ex.
 * <pre>
 * /**
 *  * @category   PHP
 *  * @package    PHP_Beautifier
 *  * @subpackage Filter
 *  * @author     Jesús Espino <jespinog@gmail.com>
 *  * @copyright  2010 Jesús Espino
 *  * @link       http://pear.php.net/package/PHP_Beautifier
 *  * @link       http://beautifyphp.sourceforge.net
 *  * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 *  * @version    Release: 0.1.15
 *  *'/
 * </pre>
 * @category   PHP
 * @package    PHP_Beautifier
 * @subpackage Filter
 * @author     Jesús Espino <jespinog@gmail.com>
 * @copyright  2010 Jesús Espino
 * @link       http://pear.php.net/package/PHP_Beautifier
 * @link       http://beautifyphp.sourceforge.net
 * @license    http://www.php.net/license/3_0.txt PHP License 3.0
 * @version    Release: 0.1.15
 */
class PHP_Beautifier_Filter_DocBlock extends PHP_Beautifier_Filter
{
    public function t_doc_comment($sTag)
    {
        include_once "PHP/DocBlockGenerator/Align.php";
        $aligner = new PHP_DocBlockGenerator_Align();
        $this->oBeaut->removeWhiteSpace();
        $this->oBeaut->addNewLineIndent();
        $this->oBeaut->add($aligner->alignTags($sTag));
        $this->oBeaut->addNewLineIndent();
    }
}
?>
