<?php

$config = array(
    'meta' => array(
        array('name' => 'robots', 'content' => 'no-cache'),
        array('name' => 'description', 'content' => 'My News Site'),
        array('name' => 'keywords', 'content' => 'Stiri - stiri online, stiri TV, stiri video, stiri mobil, news, stiri romania, politica, social, economic, externe, tehnologie, stiinta, it, fun, funmix, sport, sanatate, vremea, horoscop, revista presei, ultimele stiri, breaking news, news alert'),
        array('name' => 'robots', 'content' => 'INDEX,FOLLOW'),
        array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv')
    ),
    'css' => array(
        'public/addons/bootstrap-3.3.4-dist/css/bootstrap.css',
        'public/addons/font-awesome-4.3.0/css/font-awesome.css',
        'public/css/general.css',
        'public/css/main.css'
    ),
    'js' => array(
        'public/addons/jquery/jquery-2.1.4.js',
        'public/addons/bootstrap-3.3.4-dist/js/bootstrap.js',
        'public/addons/jquery/jquery.marquee.min.js',
        'public/js/main.js'
    ),
    'inlinejs' => array(
        'public/js/inline.js'
    ),
    'addons' => array(
        
        'jQueryUI' => array(
            'js' => array(
                'public/addons/jquery-ui-1.11.4.custom/jquery-ui.min.js'
            ),
            'css' => array(
                'public/addons/jquery-ui-1.11.4.custom/jquery-ui.min.css'
            )
        ),
        
        'datetimepicker' => array(
            'js' => array(
                'public/addons/datetimepicker-master/jquery.datetimepicker.js'
            ),
            'css' => array(
                'public/addons/datetimepicker-master/jquery.datetimepicker.css'
            )
        ),
        
        'ckeditor' => array(
            'css' => array(),
            'js'  => array(
                'public/addons/ckeditor/ckeditor.js'
             )
        ),
        
        'jQuery-tagEditor-master' => array(
            'css' => array(
                'public/addons/jQuery-tagEditor-master/jquery.tag-editor.css'
            ),
            'js' => array(
                 'public/addons/jQuery-tagEditor-master/jquery.tag-editor.js',
                 'public/addons/jQuery-tagEditor-master/jquery.caret.js'
            )
        ),
        'carouFredSel'  => array(
            'js' => array(
                 'public/addons/carouFredSel/jquery.carouFredSel-6.2.1.js'
            )
        ),
    )
);