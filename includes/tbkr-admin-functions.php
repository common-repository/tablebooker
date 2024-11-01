<?php
function restaurant_id_field() {
    $options = get_option('tablebooker_options');
    echo "<input id='restaurant_id' name='tablebooker_options[restaurant_id]' size='40' type='text' value='{$options['restaurant_id']}' />";
}

function restaurant_shop_id_field() {
    $options = get_option('tablebooker_options');
    echo "<input id='restaurant_shop_id' name='tablebooker_options[restaurant_shop_id]' size='40' type='number' value='{$options['restaurant_shop_id']}' />";
}

function reservation_form_type_field() {
    $options = get_option('tablebooker_options');
    $select = '<select name="tablebooker_options[reservation_form_modal]" id="reservation_form_modal"><option value="0" ';
    if($options['reservation_form_modal'] === '0'){
        $select .= 'selected="selected"';
    }
    $select .= '>' . __('Embedded', 'tablebooker') . '</option><option value="1"';
    if($options['reservation_form_modal'] === '1'){
        $select .= 'selected="selected"';
    }
    $select .= '>' . __('Modal', 'tablebooker') . '</option></select>';
    echo $select;
}

function reservation_form_background_field() {
    $options = get_option('tablebooker_options');
    $select = '<select name="tablebooker_options[reservation_form_background]" id="reservation_form_background"><option value="light" ';
    if($options['reservation_form_background'] == 'light'){
        $select .= 'selected="selected"';
    }
    $select .= '>' . __('Light', 'tablebooker') . '</option><option value="dark"';
    if($options['reservation_form_background'] == 'dark'){
        $select .= 'selected="selected"';
    }
    $select .= '>' . __('Dark', 'tablebooker') . '</option></select>';
    echo $select;
}

function reservation_form_primary_color_field() {
    $options = get_option('tablebooker_options');
    echo "<input id='reservation_form_primary_color' name='tablebooker_options[reservation_form_primary_color]' size='40' type='color' value='{$options['reservation_form_primary_color']}' />";
}

function embed_language_field() {
    $options = get_option('tablebooker_options');
    $select = '<select name="tablebooker_options[embed_language]" id="embed_language">';

    $select .= '<option value="nl"';
    if($options['embed_language'] == 'nl'){
        $select .= ' selected="selected"';
    }
    $select .= '>' . __('Dutch', 'tablebooker') . '</option>';

    $select .= '<option value="fr"';
    if($options['embed_language'] == 'fr'){
        $select .= ' selected="selected"';
    }
    $select .= '>' . __('French', 'tablebooker') . '</option>';

    $select .= '<option value="en"';
    if($options['embed_language'] == 'en'){
        $select .= ' selected="selected"';
    }
    $select .= '>' . __('English', 'tablebooker') . '</option>';

    $select .= '<option value="current"';
    if($options['embed_language'] == 'current'){
        $select .= ' selected="selected"';
    }
    $select .= '>' . __('Site language', 'tablebooker') . '</option>';

    $select .= '</select>';
    echo $select;
}
?>