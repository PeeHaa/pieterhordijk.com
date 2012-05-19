<?php

class TutorialController extends MFW_Controller
{
    function indexAction()
    {
        $this->getRequest();
        $params = $this->getRequestParams();

        $tutorialModel = $this->view->modelFactory->getModel('Tutorial');
        $this->view->tutorials = $tutorialModel->getTutorials();

        $this->render('tutorials/index.phtml');
    }

    function createAction()
    {
        if (!$this->view->user) {
            $this->redirect($this->url('403', array()));
        }

        $this->getRequest();
        $params = $this->getRequestParams();

        $createForm = new Tutorial_Create_Form();

        if (isset($params['submit'])) {
            $createForm->clean($params);

            if ($createForm->isValid()) {
                $tutorialModel = $this->view->modelFactory->getModel('Tutorial');
                $result = $tutorialModel->createTutorial($createForm, $this->view->user->username);

                if ($result === false) {
                    // slug already exists?
                } else {
                    $this->redirect($this->url('index', array()));
                }
            }
        }

        $this->view->form = $createForm;
        $this->render('tutorials/create.phtml');
    }

    function tutorialAction()
    {
        $this->getRequest();
        $params = $this->getRequestParams();

        $tutorialModel = $this->view->modelFactory->getModel('Tutorial');
        $tutorial = $tutorialModel->getTutorialBySlug($params['slug']);

        if (!$tutorial) {
            $this->redirect($this->url('index', array()));
        }

        $this->view->tutorial = $tutorial;
        $this->view->aside = $this->view->render('tutorials/aside.phtml');

        $this->render('tutorials/tutorial.phtml');
    }

    function editAction()
    {
        if (!$this->view->user) {
            $this->redirect($this->url('403', array()));
        }

        $this->getRequest();
        $params = $this->getRequestParams();

        $tutorialModel = $this->view->modelFactory->getModel('Tutorial');
        $tutorial = $tutorialModel->getTutorialBySlug($params['slug']);

        if (!$tutorial) {
            $this->redirect($this->url('index', array()));
        }

        $editForm = new Tutorial_Edit_Form($tutorial);

        if (isset($params['submit'])) {
            $editForm->clean($params);

            if ($editForm->isValid()) {
                $result = $tutorialModel->updateTutorial($editForm);

                if ($result === false) {
                    // slug already exists?
                } else {
                    $this->redirect($this->url('tutorials/tutorial', array('slug'=>$editForm->getField('slug')->getData())));
                }
            }
        }

        $this->view->tutorial = $tutorial;
        $this->view->form = $editForm;
        $this->render('tutorials/edit.phtml');
    }

    function deleteAction()
    {
        $this->getRequest();
        $params = $this->getRequestParams();

        if (!$this->view->user || !isset($params['token']) || $this->view->csrfToken != $params['token']) {
            $this->redirect($this->url('403', array()));
        }

        $tutorialModel = $this->view->modelFactory->getModel('Tutorial');
        $tutorial = $tutorialModel->getProjectBySlug($params['slug']);

        if (!$tutorial) {
            $this->redirect($this->url('index', array()));
        }

        $tutorialModel->deleteTutorialsByIds($project->id);

        $this->redirect($this->url('tutorials', array()));
    }
}