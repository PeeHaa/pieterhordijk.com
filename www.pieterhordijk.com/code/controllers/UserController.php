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

    function loginAction()
    {
        $this->getRequest();
        $params = $this->getRequestParams();

        $loginForm = new User_Login_Form();

        if (isset($params['submit'])) {
            $loginForm->clean($params);

            if ($loginForm->isValid()) {
                $userModel = $this->view->modelFactory->getModel('User');
                $result = $userModel->login($loginForm);

                if ($result === true && $loginForm->getField('json')->getData() == 'json') {
                    print(json_encode(array('result'=>'success')));
                } elseif ($result === false && $loginForm->getField('json')->getData() == 'json') {
                    print(json_encode(array('result'=>'failed')));
                } elseif ($result === true) {
                    $this->redirect($this->url('index', array()));
                }
            }
        }
    }
}