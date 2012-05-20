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
'projects/history'                  => array('/projects/:slug/history/:page',
                                             'project/history', array('page'=>false)),
'projects/edit'                     => array('/projects/:slug/edit',
                                             'project/edit', array()),
'projects/delete'                   => array('/projects/:slug/delete',
                                             'project/delete', array()),

'tutorials'                         => array('/tutorials',
                                             'tutorial/index', array()),
'tutorials/create'                  => array('/tutorials/create',
                                             'tutorial/create', array()),
'tutorials/tutorial'                => array('/tutorials/:slug',
                                             'tutorial/tutorial', array()),
'tutorials/project'                 => array('/tutorials/:slug',
                                             'tutorial/tutorial', array()),
'tutorials/edit'                    => array('/tutorials/:slug/edit',
                                             'tutorial/edit', array()),
'tutorials/delete'                  => array('/tutorials/:slug/delete',
                                             'tutorial/delete', array()),


'benchmarks'                        => array('/benchmarks',
                                             'benchmark/index', array()),

'403'                               => array('/403-forbidden',
                                             'page/forbidden', array()),
'404'                               => array('/404-not-found',
                                             'page/not-found', array()),
'page/contact'                      => array('/contact',
                                             'page/contact', array()),
'page/contact-success'              => array('contact-success',
                                             'page/contact-success', array()),

);