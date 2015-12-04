<?php namespace Cutlass;
use Webcode\WordPress\Template\BootstrapNavWalker;

class NavWalker extends BootstrapNavWalker {

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';

        if (strcasecmp($item->attr_title, 'divider') == 0 && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="divider">';
        } else if (strcasecmp($item->title, 'divider') == 0 && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="divider">';
        } else if (strcasecmp($item->attr_title, 'dropdown-header') == 0 && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr($item->title);
        } else if (strcasecmp($item->attr_title, 'disabled') == 0) {
            $output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr($item->title) . '</a>';
        } else {

            $class_names = $value = '';

            $classes = empty($item->classes) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;
            $classes[] = 'nav-item';

            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));

            if ($args->has_children)
                $class_names .= ' dropdown';

            if (in_array('current-menu-item', $classes))
                $class_names .= ' active';

            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

            $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
            $id = $id ? ' id="' . esc_attr($id) . '"' : '';

            $output .= $indent . '<li' . $id . $value . $class_names . '>';

            $atts = array();
            $atts['title'] = !empty($item->title) ? $item->title : '';
            $atts['target'] = !empty($item->target) ? $item->target : '';
            $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
            $atts['class'] = 'nav-link';

            // If item has_children add atts to a.
            if ($args->has_children && $depth === 0) {
                if (THEME_IS_RESPONSIVE) {
                    $atts['href'] = '#';
                    $atts['data-toggle'] = 'dropdown';
                } else {
                    $atts['href'] = !empty($item->url) ? $item->url : '#';
                }
                $atts['data-hover'] = 'dropdown';
                $atts['data-delay'] = '500';
                $atts['data-close-others'] = 'true';
                $atts['class'] = 'dropdown-toggle';
                $atts['aria-haspopup'] = 'true';
            } else {
                $atts['href'] = !empty($item->url) ? $item->url : '';
            }

            $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $value = ( 'href' === $attr ) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $item_output = $args->before;

            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';
            $item_output .= $args->after;

            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        }
    }

}
