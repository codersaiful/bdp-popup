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
