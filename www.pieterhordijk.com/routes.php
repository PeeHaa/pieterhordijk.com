<?php

$routes = array(

'index'                             => array('/',
                                             'index/index', array()),

'user/register'                     => array('/user/register',
                                             'user/register', array()),
'user/login'                        => array('/user/login/:json',
                                             'user/login', array('json' => false)),
'user/logout'                       => array('/user/logout',
                                             'user/logout', array()),

'projects'                          => array('/projects',
                                             'project/index', array()),
'projects/create'                   => array('/projects/create',
                                             'project/create', array()),
'projects/project'                  => array('/projects/:slug',
                                             'project/project', array()),

);