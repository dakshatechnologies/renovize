<?php

class VA_Pricing_General_Metabox extends APP_Meta_Box {

	public function __construct(){
		parent::__construct( 'pricing-details', __( 'Pricing Details', APP_TD ), APPTHEMES_PRICE_PLAN_PTYPE, 'normal', 'high' );
	}

	public function admin_enqueue_scripts() {
		//wp_enqueue_script( 'form-builder-helper', get_template_directory_uri() . '/framework/custom-forms/form-builder-helper.js', array( 'jquery' ), '20110909' );
	}

	public function before_form( $post ) {
		?><style type="text/css">#notice{ display: none; }</style><?php
	}

	public function form_fields(){
		$plan_form = array();

		$plan_form[] = array(
			'title' => __( 'Plan Name', APP_TD ),
			'type' => 'text',
			'name' => 'plan_title',
		);

		$plan_form[] = array(
			'title' => __( 'Description', APP_TD ),
			'type' => 'textarea',
			'name' => 'description',
			'extra' => array(
				'style' => 'width: 25em;'
			)
		);

		$plan_form[] = array(
			'title' => __( 'Price', APP_TD ),
			'type' => 'text',
			'name' => 'price',
			'desc' => sprintf( __( 'Example: %s ' , APP_TD ), '1.00' ),
			'extra' => array(
				'style' => 'width: 50px;'
			)
		);

		$plan_form[] = array(
			'title' => __( 'Categories Included', APP_TD ),
			'type' => 'text',
			'name' => 'included_categories',
			'desc' => __( ' ( 0 = Infinite )', APP_TD),
			'extra' => array(
				'style' => 'width: 50px;'
			)
		);

		$plan_form[] = array(
			'title' => __( 'Recurring', APP_TD ),
			'type' => 'select',
			'name' => 'recurring',
			'values' => array(
				'non_recurring' => __( 'Non Recurring', APP_TD ),
				'optional_recurring' => __( 'Optional Recurring', APP_TD ),
				'forced_recurring' => __( 'Forced Recurring', APP_TD ),
			),
		);

		return $plan_form;
	}

	public function validate_post_data( $data, $post_id ) {

		$errors = new WP_Error();

		if( empty( $data['plan_title'] ) ){
			$errors->add( 'plan_title', '' );
		}

		if( !is_numeric( $data['price'] ) ){
			$errors->add( 'price', '' );
		}

		return $errors;

	}

	public function post_updated_messages( $messages ) {
		$messages[ APPTHEMES_PRICE_PLAN_PTYPE ] = array(
		 	1 => __( 'Plan updated.', APP_TD ),
		 	4 => __( 'Plan updated.', APP_TD ),
		 	6 => __( 'Plan created.', APP_TD ),
		 	7 => __( 'Plan saved.', APP_TD ),
		 	9 => __( 'Plan scheduled.', APP_TD ),
			10 => __( 'Plan draft updated.'),
		);
		return $messages;
	}

	public function after_form( $post ) {
		echo html( 'input', array( 'id' => 'post_title', 'name' => 'post_title', 'type' => 'hidden' ) );
?>
<script type="text/javascript">
	jQuery(document).ready(function($){

		$( "#submitpost input[type=submit]" ).click( function(){
			$("#post_title").val( $("#plan_title").val() );
		} );

	});
</script>
	<?php

	}

}

class VA_Pricing_Duration_Period_Metabox extends APP_Meta_Box {

	public function __construct(){
		parent::__construct( 'duration-period', __( 'Listing Duration Period', APP_TD ), APPTHEMES_PRICE_PLAN_PTYPE, 'normal', 'default' );
	}

	public function get_post_id() {
		if ( !empty( $_GET['post'] ) ) {
			return $_GET['post'];
		} else if ( !empty( $_POST['ID'] ) ) {
			return $_POST['ID'];
		} else {
			return 0;
		}
	}

	public function form_fields() {
		$fields = array();

		$period_values = array();
		for ( $x = 0; $x <= 90 ; $x++ ){
			$period_values[$x] = $x;
		}

		$fields[] =  array(
			'type' => 'select',
			'name' => 'period',
			'values' => $period_values,
			'extra' => array (
				'id' => 'period'
			),
		);

		$fields[] =  array(
			'type' => 'hidden',
			'name' => 'duration',
			'extra' => array (
				'id' => 'duration'
			),
		);

		$fields[] = array (
			'title' => '',
			'type' => 'select',
			'name' => 'period_type',
			'values' => array( 
				APP_Order::RECUR_PERIOD_TYPE_DAYS => __( 'Days', APP_TD ),
				APP_Order::RECUR_PERIOD_TYPE_MONTHS => __( 'Months', APP_TD ),
				APP_Order::RECUR_PERIOD_TYPE_YEARS => __( 'Years', APP_TD ),
			),
			'extra' => array (
				'id' => 'period_type'
			),
			'desc' => __( '( 0 = Infinite )', APP_TD),
		);

		return $fields;
	}

	public function display( $post ) {

		$post = is_object( $post ) ? $post : get_post( $post_id );

		$form_data = get_post_custom( $post->ID );
		foreach ( $form_data as $key => $values )
			if ( count( $form_data[$key] ) > 1 )
				$form_data[$key] = $form_data[$key];
			else
				$form_data[$key] = $form_data[$key][0];

		$form_fields = $this->form_fields();

		$inputs = '';
		foreach ( $form_fields as $form_field ) {
			$inputs .= scbForms::input( $form_field, $form_data );
		}

		$output = html( 'tr',
			html( "th scope='row'", __( 'Listing Duration/ Recurring Period', APP_TD ),
			html( "td ", $inputs )
			) );

		$output = scbForms::table_wrap( $output );
		echo $output;

		?>
		<script>
			jQuery(function() {
				function va_populate_period_values( values_limit, period_selected ) {
					jQuery('#period').html('');

					for ( var period = 0; period <= values_limit; period++ ) {
						jQuery('#period').append('<option value="' + period + '">' + period + '</option>');
					}

					jQuery('#period').val(period_selected);

				}

				jQuery('#period_type').change(function(){
					if ( jQuery('#period_type').val() == '<?php echo APP_Order::RECUR_PERIOD_TYPE_YEARS; ?>' ) {
						va_populate_period_values( 5, 1 );
					} else if( jQuery('#period_type').val() == '<?php echo APP_Order::RECUR_PERIOD_TYPE_MONTHS; ?>' ) {
						va_populate_period_values( 24, 1 );
					} else {
						va_populate_period_values( 90, 30 );
					}
				});

				if ( jQuery('#period_type').val() == '<?php echo APP_Order::RECUR_PERIOD_TYPE_YEARS; ?>' ) {
					va_populate_period_values( 5, jQuery('#period').val() );
				} else if( jQuery('#period_type').val() == '<?php echo APP_Order::RECUR_PERIOD_TYPE_MONTHS; ?>' ) {
					va_populate_period_values( 24, jQuery('#period').val() );
				}
			});
		</script>
		<?php

	}

	function before_save( $data, $post_id ) {
		$data['duration'] = absint( $data['duration'] );

		$data['period'] = !empty( $data['period'] ) ? absint( $data['period'] ) : 0;

		if ( $data['period_type'] == APP_Order::RECUR_PERIOD_TYPE_YEARS ) {
			$data['period'] = min( 5, $data['period'] );
			$data['duration'] = $data['period'] * 365;
		} elseif( $data['period_type'] == APP_Order::RECUR_PERIOD_TYPE_MONTHS  ) {
			$data['period'] = min( 24, $data['period'] );
			$data['duration'] = $data['period'] * 30;
		} else {
			$data['period_type'] = APP_Order::RECUR_PERIOD_TYPE_DAYS;
			$data['period'] = min( 90, $data['period'] );
			$data['duration'] = $data['period'];
		}

		$recurring = get_post_meta( $post_id, 'recurring', true );

		if ( in_array( $recurring, array( 'optional_recurring', 'forced_recurring' ) ) ) {
			$data['period'] = max( 1, $data['period'] );
			$data['duration'] = max( 1, $data['duration'] );
		}

		return $data;
	}

}

class VA_Pricing_Addon_Metabox extends APP_Meta_Box {

	public function __construct(){
		parent::__construct( 'pricing-addons', __( 'Featured Addons', APP_TD ), APPTHEMES_PRICE_PLAN_PTYPE, 'normal', 'low' );
	}

	public function form_fields(){

		$output = array();

		foreach( array( VA_ITEM_FEATURED_CAT, VA_ITEM_FEATURED_HOME ) as $addon ){

			$enabled = array(
				'title' => APP_Item_Registry::get_title( $addon ),
				'type' => 'checkbox',
				'name' => $addon,
				'desc' => __( 'Included', APP_TD ),
			);

			$duration = array(
				'title' => __( 'Duration', APP_TD ),
				'type' => 'text',
				'name' => $addon . '_duration',
				'desc' => __( 'days', APP_TD ),
				'extra' => array(
					'size' => '3'
				),
			);

			$output[] = $enabled;
			$output[] = $duration;

		}

		return $output;

	}

	public function before_save( $data, $post_id ){

		foreach( array( VA_ITEM_FEATURED_CAT, VA_ITEM_FEATURED_HOME ) as $addon ){

			if( !empty( $data[ $addon ] ) && empty( $data[ $addon . '_duration' ] ) ){
				$data[ $addon . '_duration' ] = get_post_meta( $post_id, 'duration', true );
			}

			$data[ $addon . '_duration' ] = absint( $data[ $addon . '_duration' ] );

		}

		return $data;
	}

	public function validate_post_data( $data, $post_id ){
		$errors = new WP_Error();

		$listing_duration = intval( get_post_meta( $post_id, 'duration', true ) );
		foreach( array( VA_ITEM_FEATURED_CAT, VA_ITEM_FEATURED_HOME ) as $addon ){

			if( !empty( $data[ $addon . '_duration' ] ) ){

				$addon_duration = $data[ $addon . '_duration' ];

				if( !is_numeric( $addon_duration ) )
					$errors->add( $addon . '_duration', '' );

				if( intval( $addon_duration ) > $listing_duration && $listing_duration != 0 )
					$errors->add( $addon . '_duration', '' );

				if( intval( $addon_duration ) < 0 )
					$errors->add( $addon . '_duration', '' );

			}

		}

		return $errors;
	}

	public function before_form( $post ) {
		echo html( 'p', array(), __( 'You can include featured addons in a plan. These will be immediately added to the listing upon purchase. After they run out, the customer can then purchase regular featured addons.', APP_TD ) );
	}


	public function after_form( $post ) {
		echo html( 'p', array('class' => 'howto'), __( 'Durations must be shorter than the listing duration.', APP_TD ) );
	}

}

