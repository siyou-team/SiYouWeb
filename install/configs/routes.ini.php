<?php
/**
 * Friend Url 规则, 需要先制定出规则,方便程序调用
 *
 * @var string
 */
$routes_rows = array(
    'default' => array(
        'pattern' => ':ctl/:met/*',
        'rules' => array('ctl'=>'[A-Za-z_]+', 'met'=>'[a-z0-9_]+', 'typ'=>'[ejm]+'),
        'defaults' => array('ctl'=>'Index', 'met'=>'index', 'typ'=>'e')
    )
);

$config_row['routes_rows'] = $routes_rows;

return $config_row;
?>