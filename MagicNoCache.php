<?php
#Extension to allow editors to disable caching on select pages
#by using the magic word __NOCACHE__

# @addtogroup Extensions
# @author Kimon Andreou
# @copyright 2007 Kimon Andreou
# @license GPL General Public License 2.0 or later


#Check to see if we're being called as an extension or directly
if ( !defined( 'MEDIAWIKI' ) ) {
    die( 'This file is a MediaWiki extension, it is not a valid entry point' );
}

#register ourselves with Special:Version
$wgExtensionCredits['parserhook'][] = array(
    'path' => __FILE__,
    'name' => 'MagicNoCache',
    'url' => 'http://www.mediawiki.org/wiki/Extension:MagicNoCache',
    'author' => 'Kimon Andreou',
    'descriptionmsg' => 'magicnocache_desc',
    'version' => '1.2'
);

$dir = __DIR__;
$wgExtensionMessagesFiles['MagicNoCache'] = $dir . '/MagicNoCache.i18n.php';
$wgExtensionMessagesFiles['MagicNoCacheMagic'] = $dir . '/MagicNoCache.i18n.magic.php';
$wgHooks['ParserBeforeTidy'][] = 'MagicNoCache::onParserBeforeTidy';

#extension class
class MagicNoCache
{
  /**
   * Check to see if we have the magic word in the article
   * @global OutputPage $wgOut
   * @global array $wgAction
   * @return boolean
   */
  public static function onParserBeforeTidy(&$parser, &$text) {
    global $wgOut, $wgAction;
    $mw = MagicWord::get('MAG_NOCACHE');

    #If it's there, remove it and disable caching
    if (!in_array($wgAction, array('submit','edit')) && $mw->matchAndRemove($text)) {
      $parser->disableCache();
      $wgOut->enableClientCache(false);
    }

    return true;
  }
}
