<?php

class UserController extends MFW_Controller
{
    public function registerAction()
    {
        $this->getRequest();
        $params = $this->getRequestParams();

        $registerFrom = new User_Register_Form();

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

    public function loginAction()
    {
        $this->getRequest();
        $params = $this->getRequestParams();

        $loginForm = new User_Login_Form();

        if (isset($params['submit'])) {
            $loginForm->clean($params);

            if ($loginForm->isValid()) {
                $userModel = $this->view->modelFactory->getModel('User');
                $result = $userModel->login($loginForm->getField('username')->getData(), $loginForm->getField('password')->getData());

                $jsonEnabled = false;
                if (isset($params['json']) && $params['json'] == 'json') {
                    $jsonEnabled = true;
                }

                if ($jsonEnabled) {
                    if ($result === true) {
                        print(json_encode(array('result'=>'success')));
                    } else {
                        print(json_encode(array('result'=>'failed')));
                    }
                } else {
                    if ($result === true) {
                        $this->redirect($this->url('index', array()));
                    }
                }
            }
        }
    }

    public function logoutAction()
    {
        $userModel = $this->view->modelFactory->getModel('User');
        $userModel->logout();

        $this->redirect($this->url('index', array()));
    }
}