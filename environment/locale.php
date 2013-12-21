<?php

/*
 *---------------------------------------------------------------
 * APPLICATION LOCALE ENVIRONMENT
 *---------------------------------------------------------------
 */

$_locale = 'ja_JP';
/*
$locale = __udf_locale_accept_from_http($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? : $_locale;
/*/
$locale = $_locale;
//*/
unset($_locale);

function __udf_locale_accept_from_http($accept_language)
{
	$locale = preg_split('/,/', $accept_language);
	return preg_replace('/-/', '_', $locale[0]);
}

function __udf_set_locale_categories($package, $locale, $codeset = '', $modifier = '')
{
	preg_match('/(.*)_(.*)/', $locale, $matches);
	return array(
		$locale => array(
			'package'	=>	$package,
			'locale'	=>	$locale,
			'language'	=>	$matches[1],
			'territory'	=>	strtolower($matches[2]),
			'codeset'	=>	($codeset ? : 'UTF-8'),
			'modifier'	=>	($modifier ? : 'kaneshin')
		)
	);
}

/**
 * Specific locales
 *
 * language[_territory][.codeset] [@modifier]
 */
$locales = array();
$locales += __udf_set_locale_categories('japanese', 'ja_JP');
$locales += __udf_set_locale_categories('english', 'en_US');
$locales += __udf_set_locale_categories('taiwanese', 'zh_TW');

$_lc = $locales[$locale];
define('LOCALE',	$_lc['locale']);
define('LANGUAGE',	$_lc['package']);
unset($lc);
