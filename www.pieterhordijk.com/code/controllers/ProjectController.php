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
                $result = $projectModel->createProject($createForm, $this->view->user->username);

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

    function deleteAction()
    {
        $this->getRequest();
        $params = $this->getRequestParams();

        if (!$this->view->user || !isset($params['token']) || $this->view->csrfToken != $params['token']) {
            $this->redirect($this->url('403', array()));
        }

        $projectModel = $this->view->modelFactory->getModel('Project');
        $project = $projectModel->getProjectBySlug($params['slug']);

        if (!$project) {
            $this->redirect($this->url('index', array()));
        }

        $projectModel->deleteProjectsByIds($project->id);

        $this->redirect($this->url('projects', array()));
    }

    function historyAction()
    {
        $this->getRequest();
        $params = $this->getRequestParams();

        $projectModel = $this->view->modelFactory->getModel('Project');
        $project = $projectModel->getProjectBySlug($params['slug']);

        if (!$project) {
            $this->redirect($this->url('index', array()));
        }

        if (!property_exists($project->github, 'username')) {
            $this->redirect($this->url('projects/project', array('slug'=>$project->slug)));
        }

        $page = 1;
        if (isset($params['page'])) {
            $page = $params['page'];
        }

        $githubModel = $this->view->modelFactory->getGithubModel();
        $this->view->commits = $githubModel->getCommits($project->github->username, $project->github->repo, $page, 100);

        $this->view->project = $project;
        $this->view->aside = $this->view->render('projects/aside.phtml');

        $this->render('projects/history.phtml');
    }
}