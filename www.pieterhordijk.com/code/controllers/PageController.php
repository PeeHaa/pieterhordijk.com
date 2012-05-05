<?php

class PageController extends MFW_Controller
{
    function forbiddenAction()
    {
        header('HTTP/1.0 403 Forbidden');

        $this->render('page/forbidden.phtml');
    }

    function notFoundAction()
    {
        header('HTTP/1.0 404 Not found');

        $this->render('page/notfound.phtml');
    }
}