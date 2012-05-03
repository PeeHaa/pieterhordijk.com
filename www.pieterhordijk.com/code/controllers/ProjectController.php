<?php

class ProjectController extends MFW_Controller
{
    function indexAction()
    {
        $this->render('projects/index.phtml');
    }

    function createAction()
    {
        $this->getRequest();
        $params = $this->getRequestParams();

        $createForm = new Project_Create_Form();

        if (isset($params['submit'])) {
            $createForm->clean($params);

            if ($createForm->isValid()) {
                $projectModel = $this->view->modelFactory->getModel('Project');
                $result = $projectModel->createProject($createForm);

                if ($result === false) {
                    // slug already exists?
                } else {
                    $this->redirect($this->url('index', array()));
                }
            }
        }

        $this->view->form = $createForm;
        $this->render('projects/create.phtml');
    }

    function projectAction()
    {
        $this->render('projects/project.phtml');
    }
}