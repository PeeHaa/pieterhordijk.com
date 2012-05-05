<?php

class ProjectController extends MFW_Controller
{
    function indexAction()
    {
        $this->getRequest();
        $params = $this->getRequestParams();

        $projectModel = $this->view->modelFactory->getModel('Project');
        $this->view->projects = $projectModel->getProjects();

        $this->render('projects/index.phtml');
    }

    function createAction()
    {
        if (!$this->view->user) {
            $this->redirect($this->url('403', array()));
        }

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
        $this->getRequest();
        $params = $this->getRequestParams();

        $projectModel = $this->view->modelFactory->getModel('Project');
        $project = $projectModel->getProjectBySlug($params['slug']);

        if (!$project) {
            $this->redirect($this->url('index', array()));
        }

        $this->view->project = $project;
        $this->view->aside = $this->view->render('projects/aside.phtml');

        $this->render('projects/project.phtml');
    }

    function editAction()
    {
        if (!$this->view->user) {
            $this->redirect($this->url('403', array()));
        }

        $this->getRequest();
        $params = $this->getRequestParams();

        $projectModel = $this->view->modelFactory->getModel('Project');
        $project = $projectModel->getProjectBySlug($params['slug']);

        if (!$project) {
            $this->redirect($this->url('index', array()));
        }

        $editForm = new Project_Edit_Form($project);

        if (isset($params['submit'])) {
            $editForm->clean($params);

            if ($editForm->isValid()) {
                $result = $projectModel->updateProject($editForm);

                if ($result === false) {
                    // slug already exists?
                } else {
                    $this->redirect($this->url('projects/project', array('slug'=>$editForm->getField('slug')->getData())));
                }
            }
        }

        $this->view->project = $project;
        $this->view->form = $editForm;
        $this->render('projects/edit.phtml');
    }
}