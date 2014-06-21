<?php
/**
 * Recipe Single Template Display Functions
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

/**
 * Recipe Title
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0
 */

function recipe_hero_output_single_title() {

	// Variables
	global $post;
	$get_title = get_the_title( $post->ID );

	$title = '<h1 class="recipe-single-title entry-title" itemprop="name">';
	$title .= $get_title;
	$title .= '</h1>';

	echo $title;

}

/**
 * Recipe Meta: Author & Date
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0
 * @todo 	  Make 'By' fitlerable / an option
 */

function recipe_hero_output_single_meta() {

	// Variables
	$date = get_the_date();
	?>

	<div class="recipe-single-meta">

		<div class="date">
			<span class="dashicons dashicons-clock"></span> <?php echo $date; ?>
		</div>
		<div class="author">
			<span class="dashicons dashicons-admin-users"></span> <?php echo the_author_posts_link(); ?>
		</div>
		<div class="comments-link">
			<span class="dashicons dashicons-testimonial"></span> <a href="#comments"><?php comments_number( __( '0 Comments', 'recipe-hero' ), __( '1 Comment', 'recipe-hero' ), __( '% Comments', 'recipe-hero' ) ); ?></a>
		</div>
		<?php if ( get_edit_post_link() ) { ?>
			<div class="edit-link">
				<span class="dashicons dashicons-welcome-write-blog"></span> <?php edit_post_link( __( 'Edit Recipe', 'recipe-hero' )); ?>
			</div>
		<?php } ?>

	</div>
	
<?php
}

/**
 * Recipe Featured Image Photo
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0
 */

function recipe_hero_output_single_photo() {

	// Variables
	global $post;

	$photo = get_the_post_thumbnail();

	if ( has_post_thumbnail() ) {
		echo '<div class="recipe-single-photo">';
		echo $photo;
		echo '</div>';
	}

}

/**
 * Recipe Cuisine / Course
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0
 * @todo 	  Make 'By' fitlerable / an option
 */

function recipe_hero_output_single_tax() {

	// Variables
	global $post;

	$cuisine_terms = wp_get_object_terms($post->ID, 'cuisine');
		if(!empty($cuisine_terms)){
			if(!is_wp_error( $cuisine_terms )){
				$cuisine = '<ul>';
				foreach($cuisine_terms as $term){
					$cuisine .= '<li><a href="'.get_term_link($term->slug, 'cuisine').'">'.$term->name.'</a></li>'; 
				}
				$cuisine .= '</ul>';
			}
		}

	$course_terms = wp_get_object_terms($post->ID, 'course');
		if(!empty($course_terms)){
			if(!is_wp_error( $course_terms )){
				$course = '<ul>';
				foreach($course_terms as $term){
					$course .= '<li><a href="'.get_term_link($term->slug, 'course').'">'.$term->name.'</a></li>'; 
				}
				$course .= '</ul>';
			}
		}

		?>

	<div class="recipe-single-tax">

		<?php if ( isset( $cuisine ) ) { ?>
			<div class="cuisine">
				<strong><?php _e( 'Cuisines', 'recipe-hero' ); ?>:</strong> <?php echo $cuisine; ?>
			</div>
		<?php } ?>

		<?php if ( isset ( $course ) ) { ?>
			<div class="course">	
				<strong><?php _e( 'Courses', 'recipe-hero' ); ?>:</strong> <?php echo $course; ?>
			</div>
		<?php } ?>

	</div>

<?php
}

/**
 * Recipe Content / Description
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0
 */

function recipe_hero_output_single_description() {

	// Variables
	$description = get_the_content();

	if ( $description ) { ?>

		<div class="recipe-single-content">

			<?php echo $description; ?>

		</div>

	<?php
	}

}

/**
 * Recipe Details / Information
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0
 */

function recipe_hero_output_single_details() {

	// Variables
	global $post;
	$serves 	= get_post_meta( $post->ID, '_recipe_hero_detail_serves', true );
	$prep_time 	= get_post_meta ( $post->ID, '_recipe_hero_detail_prep_time', true );
	$cook_time 	= get_post_meta ( $post->ID, '_recipe_hero_detail_cook_time', true );
	$equipment 	= get_post_meta ( $post->ID, '_recipe_hero_detail_equipment', false ); ?>

	<div class="recipe-single-details">

		<h4 class="details-heading">Recipe Details</h4>

		<div class="grid">

			<div class="serves unit w-1-4">
				<strong>
					<?php if ( recipe_hero_get_option( 'rh-serves-text', 'recipe-hero-options' ) ) {
							echo recipe_hero_get_option( 'rh-serves-text', 'recipe-hero-options' );
						} else {
							_e( 'Serves', 'recipe-hero' );
						} ?>
				</strong> <span itemprop="recipeYield"><?php echo $serves; ?> <?php _e( 'People', 'recipe-hero' ); ?></span>
			</div>

			<div class="prep-time unit w-1-4">
				<strong>
					<?php if ( recipe_hero_get_option( 'rh-prep-text', 'recipe-hero-options' ) ) {
							echo recipe_hero_get_option( 'rh-prep-text', 'recipe-hero-options' );
						} else {
							_e( 'Prep Time', 'recipe-hero' );
						} ?>
				</strong> <meta itemprop="prepTime" content="<?php echo recipe_hero_schema_prep_time(); ?>"><?php echo $prep_time; ?>
			</div>

			<div class="cook-time unit w-1-4">
				<strong>
					<?php if ( recipe_hero_get_option( 'rh-cook-text', 'recipe-hero-options' ) ) {
							echo recipe_hero_get_option( 'rh-cook-text', 'recipe-hero-options' );
						} else {
							_e( 'Cook Time', 'recipe-hero' );
						} ?>
				</strong> <meta itemprop="cookTime" content="<?php echo recipe_hero_schema_cook_time(); ?>"> <?php echo $cook_time; ?>
			</div>

			<div class="equipment unit w-1-4">
				<strong>
					<?php if ( recipe_hero_get_option( 'rh-equipment-text', 'recipe-hero-options' ) ) {
							echo recipe_hero_get_option( 'rh-equipment-text', 'recipe-hero-options' );
						} else {
							_e( 'Equipment', 'recipe-hero' );
						} ?>
				</strong>
				<?php
				foreach ($equipment as $equipment_item ) {
					foreach($equipment_item as $item) {
					    echo '<div class="equipment-item">';
					    echo $item;
					    echo '</div>';
					}
				}
				?>
			</div>

		</div>

	</div><!-- .recipe-single-details -->

<?php
}

/**
 * Recipe Ingredients
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0
 * @todo 	  For the css3 columns being used to display, need to add javacript support (https://github.com/BetleyWhitehorne/CSS3MultiColumn)
 */

function recipe_hero_output_single_ingredients() {

	// Variables
	global $post;
	$ingredients = get_post_meta( $post->ID, '_recipe_hero_ingredients_group', true );

	if ( isset ( $ingredients[0]['_recipe_hero_ingredient_quantity'] ) ) {

		echo '<div class="recipe-single-ingredients">';

			echo '<h4 class="ingredients-heading">' . __( 'Ingredients', 'recipe-hero' ) . '</h4>';

			echo '<ul class="ingredients-list">';
			foreach ( (array) $ingredients as $key => $ingredient ) {

			    $ingredient_quantity = $ingredient_amount = $ingredient_name = '';

			    if ( isset( $ingredient['quantity'] ) ) {
			        $ingredient_quantity = $ingredient['quantity'];
			    }

			    if ( isset( $ingredient['amount'] ) ) {
			        $ingredient_amount_pre = $ingredient['amount'];
			    	
			    	$ingredient_amount = recipe_hero_output_single_ingredient_amount( $ingredient_amount_pre, $ingredient_quantity );
			  	}

			    if ( isset( $ingredient['name'] ) ) {            
			        $ingredient_name = $ingredient['name'];
			    }

			    echo '<li class="ingredients-item" itemprop="ingredeints">';
			    echo $ingredient_quantity . ' ';
			    echo $ingredient_amount . ' ';
			    echo $ingredient_name;
			    echo '</li>';

			}
			echo '</ul>';

		echo '</div><!-- .recipe-single-ingredients -->';

	} else {

	}

}

/**
 * Recipe Instructions / Steps
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0
 */

function recipe_hero_output_single_instructions() {

	// Variables
	global $post;
	$instructions = get_post_meta( $post->ID, '_recipe_hero_steps_group', true );

	if ( $instructions ) {

		echo '<div class="recipe-single-instructions">';

			echo '<h4 class="instructions-heading">' . __( 'Instructions', 'recipe-hero' ) . '</h4>';

			echo '<ol class="steps-list" itemprop="recipeInstructions">';
			foreach ( (array) $instructions as $key => $instruction ) {

			    $ingredient_quantity = $ingredient_amount = $ingredient_name = '';

			    if ( isset( $instruction['_recipe_hero_step_instruction'] ) ) {
			        $instruction_text = $instruction['_recipe_hero_step_instruction'];
			    }

			    if ( $instruction['_recipe_hero_step_image'] ) {
			    	$instruction_image = '<img src="' . $instruction['_recipe_hero_step_image'] . '" class="step-image" />';
			  	} else {
			  		$instruction_image ='';
			  	}

			    echo '<li class="steps-item" itemprop="ingredeints">';
			    echo wpautop( $instruction_text ) . ' ';
			    echo $instruction_image;
			    echo '</li>';

			}
			echo '</ul>';

		echo '</div><!-- .recipe-single-ingredients -->';

	}

}

/**
 * Recipe Nutrition Info
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0
 */

function recipe_hero_output_single_nutrition() {

	// Variables
	global $post;
	$nutrition 	= get_post_meta ( $post->ID, '_recipe_hero_detail_nutrition', true );

	if ( $nutrition ) { ?>

		<div class="recipe-single-nutrition" itemprop="nutrition" itemscope itemtype="http://schema.org/NutritionInformation">
			<strong><?php _e( 'Nutrition', 'recipe-hero' ); ?>:</strong> <?php echo $nutrition; ?>
		</div>

	<?php }

}

/**
 * Recipe Comments
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0
 */

function recipe_hero_output_single_comments() {

	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}

}

/******************************/


/**
 * Line Break
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0
 */

function recipe_hero_output_single_seperator() {

	echo '<hr class="recipe-single-seperator" />';

}


/**
 * Small Function for Determing Ingredient Amount
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @since 	  1.0
 * @todo 	  Not sure what to do about translations and plurals here.
 */

function recipe_hero_output_single_ingredient_amount( $ingredient_amount_pre, $ingredient_quantity ) {

	if ( $ingredient_quantity == 1 ) {
		$plural = '';
	} else {
		$plural = 's';
	}

	switch ( $ingredient_amount_pre ) {
	    case 'gm':
	    	$ingredient_amount = __( 'Gram', 'recipe-hero' ) . $plural;
	    	break;
	    case 'oz':
	    	$ingredient_amount = __( 'Ounce', 'recipe-hero' ) . $plural;
	    	break;
	    case 'ml':
	    	$ingredient_amount = __( 'Milliliter', 'recipe-hero' ) . $plural;
	    	break;
	    case 'ts':
	    	$ingredient_amount = __( 'Teaspoon', 'recipe-hero' ) . $plural;
	    	break;
	    case 'tas':
	    	$ingredient_amount = __( 'Tablespoon', 'recipe-hero' ) . $plural;
	    	break;
	    case 'cup':
	    	$ingredient_amount = __( 'Cup', 'recipe-hero' ) . $plural;
	    	break;
	    case 'lt':
	    	$ingredient_amount = __( 'LIter', 'recipe-hero' ) . $plural;
	    	break;
	    case 'lb':
	    	$ingredient_amount = __( 'Pound', 'recipe-hero' ) . $plural;
	    	break;
	    case 'kg':
	    	$ingredient_amount = __( 'Kilogram', 'recipe-hero' ) . $plural;
	    	break;
	    case 'slice':
	    	$ingredient_amount = __( 'Slice', 'recipe-hero' ) . $plural;
	    	break;
	    case 'piece':
	    	$ingredient_amount = __( 'Piece', 'recipe-hero' ) . $plural;
	    	break;
	    case 'none':
	    	$ingredient_amount = '';
	    	break;
	    default :
	    	$ingredient_amount = '';
	    	break;
   	}

   	return $ingredient_amount;

}