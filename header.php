<?php
/**
 * Theme Header Section for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main" class="clearfix"> <div class="inner-wrap">
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
    <?php
    /**
     * This hook is important for wordpress plugins and other many things
     */
    wp_head();
    ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'colormag_before' ); ?>

<div id="page" class="hfeed site">
    <?php do_action( 'colormag_before_header' ); ?>

    <?php
    // Add the main total header area display type dynamic class
    $main_total_header_option_layout_class = get_theme_mod( 'colormag_main_total_header_area_display_type', 'type_one' );

    $class_name = '';
    if ( $main_total_header_option_layout_class == 'type_two' ) {
        $class_name = 'colormag-header-clean';
    } else if ( $main_total_header_option_layout_class == 'type_three' ) {
        $class_name = 'colormag-header-classic';
    }
    ?>

    <header id="masthead" class="site-header clearfix <?php echo esc_attr( $class_name ); ?>">
        <div id="header-text-nav-container" class="clearfix">

            <?php colormag_top_header_bar_display(); // Display the top header bar ?>

            <?php
            if ( get_theme_mod( 'colormag_header_image_position', 'position_two' ) == 'position_one' ) {
                colormag_render_header_image();
            }
            ?>

            <?php colormag_middle_header_bar_display(); // Display the middle header bar ?>

            <?php
            if ( get_theme_mod( 'colormag_header_image_position', 'position_two' ) == 'position_two' ) {
                colormag_render_header_image();
            }
            ?>

            <?php colormag_below_header_bar_display(); // Display the below header bar  ?>

        </div><!-- #header-text-nav-container -->

        <?php
        if ( get_theme_mod( 'colormag_header_image_position', 'position_two' ) == 'position_three' ) {
            colormag_render_header_image();
        }
        ?>

    </header>

    <?php do_action( 'colormag_after_header' ); ?>
    <?php do_action( 'colormag_before_main' ); ?>

    <div id="main" class="clearfix">
        <div class="inner-wrap clearfix">
            <div class="automodel-list" style="overflow: hidden;">
                <?php
                    $category_id = get_queried_object();
                    $cat_id = $category_id->term_id;
                    if($cat_id){
                        $ancestors = get_ancestors( $cat_id, 'category' );
                        echo '<pre>';
                        print_r($ancestors);
                        echo '</pre>';
                        echo $cat_id;
                        if(in_array('37', $ancestors)){
                            if(count($ancestors)  >= 2 ){
                                $categories = get_categories( array(
                                    'type'         => 'post',
                                    'child_of'     => 0,
                                    'parent'       => $ancestors[0],
                                    'orderby'      => 'name',
                                    'order'        => 'ASC',
                                    'hide_empty'   => 0,
                                    'hierarchical' => 1,
                                    'exclude'      => '',
                                    'include'      => '',
                                    'number'       => 0,
                                    'taxonomy'     => 'category',
                                    'pad_counts'   => false,
                                ) );

                                $title = "Модели ". get_cat_name( $ancestors[0] );
                            }else{
                            $categories = get_categories( array(
                                'type'         => 'post',
                                'child_of'     => 0,
                                'parent'       => $cat_id,
                                'orderby'      => 'name',
                                'order'        => 'ASC',
                                'hide_empty'   => 0,
                                'hierarchical' => 1,
                                'exclude'      => '',
                                'include'      => '',
                                'number'       => 0,
                                'taxonomy'     => 'category',
                                'pad_counts'   => false,
                            ) );

                            $title = "Модели ". get_cat_name( $cat_id );
                            }

                        }else{
                            $categories = get_categories( array(
                                'type'         => 'post',
                                'child_of'     => 0,
                                'parent'       => 37,
                                'orderby'      => 'name',
                                'order'        => 'ASC',
                                'hide_empty'   => 0,
                                'hierarchical' => 1,
                                'exclude'      => '',
                                'include'      => '',
                                'number'       => 0,
                                'taxonomy'     => 'category',
                                'pad_counts'   => false,
                            ) );

                            $title = "Марки автомобилей";
                        }
                    }else{
                        $categories = get_categories( array(
                            'type'         => 'post',
                            'child_of'     => 0,
                            'parent'       => 37,
                            'orderby'      => 'name',
                            'order'        => 'ASC',
                            'hide_empty'   => 0,
                            'hierarchical' => 1,
                            'exclude'      => '',
                            'include'      => '',
                            'number'       => 0,
                            'taxonomy'     => 'category',
                            'pad_counts'   => false,
                        ) );

                        $title = "Марки автомобилей";
                    }

                    // echo '<pre>';
                    // print_r($categories);
                    // echo '</pre>';
                    if($categories){
                        echo "<h2>$title</h2>";
                        $count_cat = count($categories);
                        $count_per_colm = floor($count_cat/4);
                        if($count_per_colm == 0){$count_per_colm =1;}
                        $count_cell = $count_cat%4;
                        $i = 0;
                        $col = 1;
                        foreach ($categories as $cat_item) {
                            if($i == 0){echo '<span style="width: 25%; float: left; display: block;" class="colum_list">';}
                            echo '<a href="'.get_category_link( $cat_item->term_id ).'">'.$cat_item->name.'</a>';
                            $i++;
                            if($i >= $count_per_colm){
                                if($count_cell > 0 && $flag == 0){
                                    $count_cell--;
                                    $flag = 1;
                                }else{
                                    echo '</span>';
                                    $i = 0;
                                    $flag = 0;
                                }
                            }
                        }
                    }
                ?>
            </div>