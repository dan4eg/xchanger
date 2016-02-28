<?php

/**
* Plugin Name: xChanger plugin
* Plugin URI: http://thecontrust.ru
* Author: Daniil Gorenko
* Version: 0.1
* Description: Позволяет делать подмену телефонов в зависимости от источника перехода.
*/

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


require_once( plugin_dir_path(__FILE__) . 'wp-xchanger-fields.php');

#admin panel - setting rules {rule, source name, what phone to use}+
#load js file
#getting regex rules of changing phones
#getting source from user came from
#getting device of user
#do phone & forms replacement




if ( !function_exists('xchanger_print' ) ) {
function xchanger_print() {
$opt = get_option('xchanger_source');
$cls = get_option('xchanger_class');
?>
<script>
 function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
    }
    return "";
}


  //refferers
  var refferers = [['yandex\.ru/search','1'],['google\.','2'],['mail\.ru/search','1'],['facebook\.com','5'],['vk\.com','5'],['email','6']];

  //?vars
  var vars = [['utm_source=yandex','3'],['utm_source=google','4']];


  if(getCookie('cphone')) { source = getCookie('cphone') } 
  else
  {
  var href = window.location.href;
  var ref = document.referrer;
  var res;
  for( var i = 0; i<vars.length; i++ ) {
  re = new RegExp(vars[i][0], 'i');
  if(href.match(re)) {res=vars[i][1]; break; }
//if (ref.match(/^https?:\/\/([^\/]+\.)?' + types[i][1] + '(\/|$)/i)) {res=types[i][1];break;}
   }
//working with refferers
if(!res) {
  for( var i = 0; i<refferers.length; i++ ) {
  re = new RegExp(refferers[i][0], 'i');
  if(ref.match(re)) {res=refferers[i][1]; break; }
   }
}
  source = res;
  if(typeof res == 'undefined') { source = 'direct';} 
  var date = new Date( new Date().getTime() + 864000000 ); 
  document.cookie="cphone="+source+"; path=/; expires="+date.toUTCString(); 
  }


switch(source) {

<?php

foreach($opt as $key=>$val) {
echo 'case "'.$key.'": 
    var phones = new Object();
    phones.num1= "'. $val .'";

    try {
    for (i = 0; i < document.getElementsByClassName("'.$cls.'").length; i++) 
    { document.getElementsByClassName("'.$cls.'")[i].innerHTML = phones.num1;  }
    }catch(err) {    console.log(err.message);}

break;';
}
?>

    default:

}


</script>

<?php

     }
}



add_action( 'wp_footer','xchanger_print' );


// Add settings link on plugin page
function xchanger_settings_link($links) { 
  $settings_link = '<a href="admin.php?page=xchanger">' . __("Settings","default") .'</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'xchanger_settings_link' );




register_activation_hook(__FILE__, 'xchanger_activation');
register_deactivation_hook(__FILE__, 'xchanger_deactivation');
 
function xchanger_activation() {
 
    // действие при активации
}
 
function xchanger_deactivation() {
    // при деактивации
}