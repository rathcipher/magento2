<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Create value-object \Magento\Framework\Phrase
 *
 * @return \Magento\Framework\Phrase
 */
function __()
{
    $argc = func_get_args();

    $text = array_shift($argc);
    if (!empty($argc) && is_array($argc[0])) {
        $argc = $argc[0];
    }

    return new \Magento\Framework\Phrase($text, $argc);
}


// @fixed
// @author

use Zend\Escaper\Escaper;

function zf_dump($var, $label = null, $echo = true) 
{
	$sapi = PHP_SAPI;
	$escaper = new Escaper();


    // format the label
    $label = ($label===null) ? '' : rtrim($label) . ' ';
    // var_dump the variable into a buffer and keep the output
    ob_start();
    var_dump($var);
    $output = ob_get_clean();
    // neaten the newlines and indents
    $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
    if ($sapi == 'cli') {
        $output = PHP_EOL . $label
                . PHP_EOL . $output
                . PHP_EOL;
    } else {
        if (null !== $escaper) {
            $output = $escaper->escapeHtml($output);
        } elseif (!extension_loaded('xdebug')) {
            $output = $escaper->escapeHtml($output);
        }
        $output = '<pre>'
                . $label
                . $output
                . '</pre>';
    }
    if ($echo) {
        echo $output;
    }
    return $output;

}

function zf_backtrace()
{
	echo '<pre>';
	debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
	echo '</pre>';
}