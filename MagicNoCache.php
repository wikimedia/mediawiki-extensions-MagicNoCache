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
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */

// Check to see if we are being called as an extension or directly
if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'This file is an extension to MediaWiki and thus not a valid entry point.' );
}

// Register this extension on Special:Version
$wgExtensionCredits['parserhook'][] = array(
	'path'           => __FILE__,
	'name'           => 'MagicNoCache',
	'version'        => '1.3.0',
	'url'            => 'https://www.mediawiki.org/wiki/Extension:MagicNoCache',
	'author'         => array(
		'Kimon Andreou',
		'[https://www.mediawiki.org/wiki/User:Pastakhov Pavel Astakhov]',
		'...'
		),
	'descriptionmsg' => 'magicnocache-desc'
);

// Tell the whereabouts of files
$dir = __DIR__;

// Allow translations for this extension
$wgMessagesDirs['MagicNoCache'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['MagicNoCache'] = $dir . '/MagicNoCache.i18n.php';
$wgExtensionMessagesFiles['MagicNoCacheMagic'] = $dir . '/MagicNoCache.i18n.magic.php';

// Check to see if we have the magic word in the article
$wgHooks['InternalParseBeforeLinks'][] = function( &$parser, &$text ) {
	global $wgOut, $wgAction;
	$mw = MagicWord::get('MAG_NOCACHE');

	// if it is there, remove it and disable caching
	if ( !in_array( $wgAction, array( 'submit', 'edit') ) && $mw->matchAndRemove($text) ) {
		$parser->disableCache();
		$wgOut->enableClientCache(false);
	}
	return true;
};
