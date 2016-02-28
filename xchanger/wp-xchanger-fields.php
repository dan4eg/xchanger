<?php

add_action( 'admin_menu', 'xchanger_plugin_setup_menu' );


function xchanger_plugin_setup_menu(){
        add_menu_page( 'XChanger', 'XChanger', 'administrator', 'xchanger','xchanger_init' );
        //call register settings function
	    add_action( 'admin_init', 'register_mysettings' );
}
 
function register_mysettings() {
	register_setting( 'xchanger-settings-group', 'xchanger_source' );
	register_setting( 'xchanger-settings-group', 'xchanger_class' );
}


function xchanger_init(){

$option_from_db = get_option( 'xchanger_source' );
$options = array("Прямые переходы","Органика Яндекс", "Органика Google", "Яндекс Директ", "Google Adwords", "Социальные сети",'E-mail');

?> 
<div class="wrap">
<h2>Настройки</h2>
<form method="post" action="options.php">
<?php settings_fields( 'xchanger-settings-group' ); ?>
<table class="form-table">

<?php
if(get_option('xchanger_class')) $_class=get_option('xchanger_class'); else $_class="cphone";
echo '<tr valign="top">';
echo '<th scope="row">Класс оболочки номера class=</th>';
echo '<td><input type="text" name="xchanger_class" value="' . $_class . '" /></td>';
echo '</tr>';

foreach($options as $key=>$val):

echo '<tr valign="top">';
echo '<th scope="row">'. $val .'</th>';
echo '<td><input type="text" name="xchanger_source['.$key.']" value="' . $option_from_db[$key] . '" /></td>';
echo '</tr>';

endforeach;

?>



</table>
<?php submit_button();  ?>
</form>
</div>

<?php




}

