<?php

class UserController extends MFW_Controller
{
    function registerAction()
    {
        $this->getRequest();
        $params = $this->getRequestParams();

        $registerFrom = new Create_User_Form();

        if (isset($params['submit'])) {
            $registerFrom->clean($params);

            if ($registerFrom->isValid()) {
                $userModel = $this->view->modelFactory->getModel('User');
                $result = $userModel->createUser($registerFrom);

                if ($result !== false) {
                    $this->redirect($this->url('index', array()));
                }
            }
        }

        $this->view->form = $registerFrom;
        $this->render('user/register.phtml');
    }
}