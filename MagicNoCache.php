<?php
/**
 * MagicNoCache - An extension that allows users to disable caching on selected pages
 * by using the magic word __NOCACHE__
 *
 * @link https://www.mediawiki.org/wiki/Extension:MagicNoCache Documentation
 *
 * @file MagicNoCache.php
 * @defgroup MagicNoCache
 * @ingroup Extensions
 * @package MediaWiki
 * @author Kimon Andreou (Kimon)
 * @author Pavel Astakhov (Pastakhov)
 * @copyright (C) 2007 Kimon Andreou
 * @license https://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */

if ( function_exists( 'wfLoadExtension' ) ) {
	wfLoadExtension( 'MagicNoCache' );
	$wgMessageDirs['MagicNoCache'] = __DIR__ . '/i18n';
	wfWarn(
		'Deprecated PHP entry point used for MagicNoCache extension. ' .
		'Please use wfLoadExtension instead, ' .
		'see https://www.mediawiki.org/wiki/Extension_registration for more details.'
	);
} else {
	die( 'This version of the MagicNoCache extension requires MediaWiki 1.29+' );
}
