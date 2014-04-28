<?php
/**
 * Hold deprecated functions and hooks
 */


/**
 * Was checking if multi categories selection is enabled.
 *
 * @deprecated 1.2
 */
function va_multi_cat_enabled() {
	_deprecated_function( __FUNCTION__, '1.2' );
	return false;
}

