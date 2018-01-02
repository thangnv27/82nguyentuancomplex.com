<?php

class Button_Widget extends WP_Widget {

    function Button_Widget() {
        $widget_ops = array('classname' => 'button-widget', 'description' => 'Action Buttons');
        $control_ops = array('id_base' => 'button_widget');
        parent::__construct('button_widget', 'PPO: Button', $widget_ops, $control_ops);
    }

    function form($instance) {
        $defaults = array('title' => '', 'url' => '', 'style' => 'style1');
        $instance = wp_parse_args((array) $instance, $defaults);

        $display = '<p><label for="' . $this->get_field_id('title') . '">Title:</label>
			<input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" value="' . $instance['title'] . '" class="widefat" />
		</p>
                <p><label for="' . $this->get_field_id('url') . '">URL:</label>
			<input id="' . $this->get_field_id('url') . '" name="' . $this->get_field_name('url') . '" value="' . $instance['url'] . '" class="widefat" />
		</p>
                <p><label for="' . $this->get_field_id('style') . '">Style:</label>
                    <select id="' . $this->get_field_id('style') . '" name="' . $this->get_field_name('style') . '" class="widefat">
                        <option value="style1" ' . (($instance['style'] == 'style1') ? 'selected' : '') . '>Style 1</option>
                        <option value="style2" ' . (($instance['style'] == 'style2') ? 'selected' : '') . '>Style 2</option>
                    </select>
		</p>
                ';
        print $display;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['url'] = strip_tags($new_instance['url']);
        $instance['style'] = strip_tags($new_instance['style']);
        return $instance;
    }

    function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);

        print $before_widget;
        print '<a class="' . $instance['style'] . '" href="' . $instance['url'] . '">' . $title . '</a>';
        print $after_widget;
    }

}

register_widget('Button_Widget');
