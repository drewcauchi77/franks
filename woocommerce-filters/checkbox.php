<?php
/**
* The template for displaying checkbox filters
*
* Override this template by copying it to yourtheme/woocommerce-filters/checkbox.php
*
* @author     BeRocket
* @package     WooCommerce-Filters/Templates
* @version  1.0.1
*/
?>
<?php
$random_name = rand();
$hiden_value = false;
$is_child_parent = @ $child_parent == 'child';
$is_child_parent_or = ( @ $child_parent == 'child' || @ $child_parent == 'parent' );


if ( ! @ $child_parent_depth || @ $child_parent == 'parent' ) {
    $child_parent_depth = 0;
}
$is_first = true;
if ( @ $terms ):
    foreach( $terms as $term ):

        $term_ch = get_term_by( 'id', $term->term_id, $term->taxonomy ); // get current term
        $parent = get_term($term_ch->parent, $term->taxonomy ); // get parent term
        $children = get_term_children($term_ch->term_id, $term->taxonomy); // get children
        
//        var_dump($children);
        if ( sizeof($children)==0 ) {
            $class = "child-filter";
            // has parent, no child

        } elseif ( sizeof($children)>0 ) {
            $class = "parent_filter";
            // no parent, has child
        }

        if ( $is_child_parent && $is_first ) {
            ?><li class="berocket_child_parent_sample"><ul><?php
        }
        ?>
        <li class="<?php echo $class; if ( $is_child_parent ) echo 'R__class__R '; ?><?php if( @ $hide_o_value && isset($term->count) && $term->count == 0 && ( !$is_child_parent || !$is_first ) ) { echo 'berocket_hide_o_value '; $hiden_value = true; }  if( @ $hide_sel_value && @ br_is_term_selected( $term, true, $is_child_parent_or, $child_parent_depth ) != '' ) { echo 'berocket_hide_sel_value'; $hiden_value = true; } ?>">
            <span>
                <input id='checkbox_<?php echo @ str_replace ( '*' , '-' , $term->term_id) ?>_<?php echo @ $random_name ?>'
                       class="<?php echo @ $uo['class']['checkbox_radio'] ?> checkbox_<?php echo @ str_replace ( '*' , '-' , $term->term_id) ?>"
                       type='checkbox'
                       style="<?php echo @$uo['style']['checkbox_radio']?>" data-term_slug='<?php echo @ $term->slug ?>'
                       data-filter_type='<?php echo @ $filter_type ?>' <?php if( @ $term->term_id) { ?>data-term_id='<?php echo @ $term->term_id ?>'<?php } ?> data-operator='<?php echo @ $operator ?>'
                       data-taxonomy='<?php echo @ $term->taxonomy ?>' 
                       <?php echo @ br_is_term_selected( $term, true, $is_child_parent_or, $child_parent_depth ); ?> />
                <label data-for='checkbox_<?php echo @ str_replace ( '*' , '-' , $term->term_id) ?>' style="<?php echo @ $uo['style']['label']?>"
                       class="berocket_label_widgets<?php if( br_is_term_selected( $term, true, $is_child_parent_or, $child_parent_depth ) != '') echo ' berocket_checked'; ?>">
                    <?php echo ( ( @ $icon_before_value ) ? ( ( substr( $icon_before_value, 0, 3) == 'fa-' ) ? '<i class="fa '.$icon_before_value.'"></i>' : '<i class="fa"><img class="berocket_widget_icon" src="'.$icon_before_value.'" alt=""></i>' ) : '' ) . @ $term->name . ( ( @ $show_product_count_per_attr ) ? ' <span class="berocket_aapf_count">' . @ $term->count . '</span>' : '' ) . ( ( @ $icon_after_value ) ? ( ( substr( $icon_after_value, 0, 3) == 'fa-' ) ? '<i class="fa '.$icon_after_value.'"></i>' : '<i class="fa"><img class="berocket_widget_icon" src="'.$icon_after_value.'" alt=""></i>' ) : '' )?>
                </label>
            </span>
        </li>
        <?php
        if ( $is_child_parent && $is_first ) {
            ?></ul></li><?php
            $is_first = false;
        }
    endforeach;?>
        <li class="berocket_widget_show_values"<?php if( !$hiden_value ) echo 'style="display: none;"' ?>><?php _e('Show value(s)', BeRocket_AJAX_domain) ?><span class="show_button"></span></li>
<?php endif; ?>