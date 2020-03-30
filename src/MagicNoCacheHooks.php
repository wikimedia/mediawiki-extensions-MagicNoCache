<?php

use MediaWiki\MediaWikiServices;

class MagicNoCacheHooks {

	/**
	 * Check to see if we have the magic word in the article
	 * @global OutputPage $wgOut
	 * @global array $wgAction
	 * @param Parser $parser
	 * @param string &$text
	 */
	public static function magicwordCheck( Parser $parser, &$text ) {
		global $wgOut, $wgAction;

		$mw = MediaWikiServices::getInstance()->getMagicWordFactory()->
			get( 'MAG_NOCACHE' );

		// if it is there, remove it and disable caching
		if ( !in_array( $wgAction, [ 'submit', 'edit' ] ) && $mw->matchAndRemove( $text ) ) {
			$parser->getOutput()->updateCacheExpiry( 0 );
			$wgOut->enableClientCache( false );
		}
	}

}
