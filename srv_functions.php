<?php

if(!function_exists('myvar_dd')){
    function myvar_dd($p1,$p2=false,$p3=false,$p4=false)
    {
        if(false===$p2){
            myvar_dump($p1);
        } else if(false===$p3) {
            myvar_dump($p1,$p2);
        } else if(false===$p4){
            myvar_dump($p1,$p2,$p3);
        } else {
            myvar_dump($p1,$p2,$p3,$p4);
        }
        die('The application dies with the myvar_dd function');
    }; // The end of myvar_dd
}


function myvar_dump( $v,
                     $my_comment=' *** The variable test dump! ***',
                     $html_comment=false,
                     $hex_view=false )
       {
//           $html_comment - Whether the dump should be in the html comment mode
if( (!isset($v)) || $v===null ){
  if($html_comment){
     echo '<!-- This variable ('.$my_comment.') does not exist!!! -->'.chr(10);
  } else {
     echo '<p>-- This variable('.$my_comment.') does not exist!!! ---</p>'.chr(10);
  };
  return false;
};
$trace = debug_backtrace();
$vLine = file( __FILE__ );
$varname = '*** The name of this variable is unknown ***';
if(isset($trace[0]['line'])){
    if (isset($vLine[ $trace[0]['line'] - 1 ])) {
        $fLine = $vLine[ $trace[0]['line'] - 1 ];
        preg_match( "#\\$(\w+)#", $fLine, $match );
        if(isset($match[1])){
            $varname=$match[1];
        } else {

            $var_find_success=false;
            foreach($GLOBALS as $var_key_name => $value) {
                if ($value === $v) {
                    $varname=$var_key_name;
                    $var_find_success=true;
                    break;
                };
            };
            if(!$var_find_success) $varname='*** Unknown variable name ***';
        };
    };
};
if($html_comment){
    echo '<!-- '.$my_comment.chr(10).$varname.':'.chr(10);
} else {
    echo '<p class="dump_header"><b>'.$varname.'</b>: '.$my_comment.'</p>'.chr(10);
};

echo ($html_comment?chr(10):'<pre>').chr(10);
var_dump($v);
if ($hex_view) {
    if (is_string($v)){
        if(strlen($v)<60){
            echo '<table class="table_hex"><tbody><tr><td><b>The hex value is</b>:</td>'.chr(10);
            $arr_v = str_split($v);
            foreach ($arr_v as $nth_byte) {
                echo '<td>'.bin2hex($nth_byte).'</td>'.chr(10);
            };
            echo '</tr><tr><td><b>The letters are</b>:&nbsp;</td>';
            foreach ($arr_v as $nth_byte) {
                echo '<td>'.$nth_byte.'</td>'. chr(10);
            };
            echo '</tr></tbody></table>' . chr(10);
        } else {
            echo '<p class="dump_hex"><b>The hex value is</b>: ';
            $arr_v = str_split($v);
            foreach ($arr_v as $nth_byte) {
                echo bin2hex($nth_byte) . ' ';
            };
            echo '</p>' . chr(10);
            echo '<p class="dump_hex"><b>The letters are</b>:&nbsp; ';
            foreach ($arr_v as $nth_byte) {
                echo $nth_byte . '&nbsp; ';
            };
            echo '</p>' . chr(10);
        };

    } else {
        echo '<h3>Error 5342! The hexadecimal view is impossible due to type of debugged variable!<h3>'.chr(10);
    };

};

echo ($html_comment?chr(10).' -->':'</pre>').chr(10);
       }; // The end of function myvar_dump

function detect_browser($suppose=false)
       {
$user_agent = $_SERVER['HTTP_USER_AGENT'];
//echo chr(10).'<!-- $user_agent='.$user_agent.' -->'.chr(10);

if($suppose){
//    myvar_dump($user_agent,'$user_agent',true);
    if(strpos($user_agent,$suppose)===false){
        return false;
    } else {
        return true;
    };
} else {
    if (strpos($user_agent, 'Firefox') !== false) return 'firefox';
    elseif (strpos($user_agent, 'Opera') !== false) return 'opera';
    elseif (strpos($user_agent, 'Chrome') !== false) return 'chrome';
    elseif (strpos($user_agent, 'Trident/7.0; rv:11.0') !== false) return 'explorer';
    elseif (strpos($user_agent, 'MSIE') !== false) return 'explorer';
    elseif (strpos($user_agent, 'Safari') !== false) return 'safari';
    return 'Unknown';
}
       };  // The end of function detect_browser
