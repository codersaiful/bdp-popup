<?php
/**
 * Only fir developer 
 * @author Saiful Islam <codersaiful@gmail.com>
 */
if( ! function_exists( 'pssg_dd' ) ){
    function pssg_dd( ...$vals ){
        foreach( $vals as $val ){
            echo '<pre>';
            var_dump($val);
            echo '</pre>';
        }
    }
}

/**
 * Only fir developer 
 * @author Saiful Islam <codersaiful@gmail.com>
 */
if( ! function_exists( 'dd' ) ){
    function dd( ...$vals ){
        foreach( $vals as $val ){
            echo '<pre>';
            var_dump($val);
            echo '</pre>';
        }
    }
}

function pdp_generate_access_key($length = 15) {
    // Define a set of characters to use in the access key
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    // Shuffle the characters and pick a substring of the desired length
    return substr(str_shuffle($characters), 0, $length);
}