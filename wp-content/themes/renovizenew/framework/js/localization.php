<?php

function _appthemes_localize_scripts() {
	// jQuery Validate
	wp_register_script( 'validate-lang', APP_FRAMEWORK_URI . '/js/validate/jquery.validate-lang.js', array( 'validate' ) );
	wp_localize_script( 'validate-lang', 'validateL10n', array(
		'required' =>    __( 'This field is required.', APP_TD ),
		'remote' =>      __( 'Please fix this field.', APP_TD ),
		'email' =>       __( 'Please enter a valid email address.', APP_TD ),
		'url' =>         __( 'Please enter a valid URL.', APP_TD ),
		'date' =>        __( 'Please enter a valid date.', APP_TD ),
		'dateISO' =>     __( 'Please enter a valid date (ISO).', APP_TD ),
		'number' =>      __( 'Please enter a valid number.', APP_TD ),
		'digits' =>      __( 'Please enter only digits.', APP_TD ),
		'creditcard' =>  __( 'Please enter a valid credit card number.', APP_TD ),
		'equalTo' =>     __( 'Please enter the same value again.', APP_TD ),
		'maxlength' =>   __( 'Please enter no more than {0} characters.', APP_TD ),
		'minlength' =>   __( 'Please enter at least {0} characters.', APP_TD ),
		'rangelength' => __( 'Please enter a value between {0} and {1} characters long.', APP_TD ),
		'range' =>       __( 'Please enter a value between {0} and {1}.', APP_TD ),
		'max' =>         __( 'Please enter a value less than or equal to {0}.', APP_TD ),
		'min' =>         __( 'Please enter a value greater than or equal to {0}.', APP_TD ),
	) );

	// jQuery Colorbox
	wp_register_script( 'colorbox-lang', APP_FRAMEWORK_URI . '/js/colorbox/jquery.colorbox-lang.js', array( 'colorbox' ) );
	wp_localize_script( 'colorbox-lang', 'colorboxL10n', array(
		'current' =>        __( 'image {current} of {total}', APP_TD ),
		'previous' =>       __( 'previous', APP_TD ),
		'next' =>           __( 'next', APP_TD ),
		'close' =>          __( 'close', APP_TD ),
		'xhrError' =>       __( 'This content failed to load.', APP_TD ),
		'imgError' =>       __( 'This image failed to load.', APP_TD ),
		'slideshowStart' => __( 'start slideshow', APP_TD ),
		'slideshowStop' =>  __( 'stop slideshow', APP_TD ),
	) );

}
