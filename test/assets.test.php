<?php
// Assets configuration used for testing

return array(
    'css'   => array(
        'path'         => '/css',
        'stylesheets'  => array(
            'bootstrap'    => array(
                'name'     => 'bootstrap.min.css',
            ),
            'font.awesome'    => array(
                'name'     => 'font-awesome.min.css',
            ),
            'main'         => array(
                'name'     => 'main.min.css',
            ),
            'print'        => array(
                'name'     => 'print.min.css',
                'media'    => 'print'
            )
        )
    ),
    'js'    => array(
        'path'      => '/js',
        'inline'    => array(
            'jquery' => array(
                'name' => 'jquery.min.js',
            ),
            'bootstrap' => array(
                'name' => 'bootstrap.min.js',
            ),
            'main' => array(
                'name' => 'main.min.js',
            ),
        ),
        'head'      => array(
            'respond' => array(
                'name'     => 'respond.min.js',
                'options'  => array('conditional' => 'lt IE 9')
            ),
            'html5shiv' => array(
                'name'     => 'html5shiv.min.js',
                'options'  => array('conditional' => 'lt IE 9')
            ),
        )
    )
);