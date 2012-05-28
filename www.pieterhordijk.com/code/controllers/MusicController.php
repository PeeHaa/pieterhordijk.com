<?php

class MusicController extends MFW_Controller
{
    function indexAction()
    {
        $this->getRequest();
        $params = $this->getRequestParams();

        $musicModel = $this->view->modelFactory->getModel('Music');
        $this->view->tracks = $musicModel->getTracks();

        $this->render('music/index.phtml');
    }

    function addTrackAction()
    {
        if (!$this->view->user) {
            $this->redirect($this->url('403', array()));
        }

        $this->getRequest();
        $params = $this->getRequestParams();

        $addForm = new Track_Add_Form();

        if (isset($params['submit'])) {
            $addForm->clean($params);

            if ($addForm->isValid()) {
                $musicModel = $this->view->modelFactory->getModel('Music');
                $result = $musicModel->addTrack($addForm);

                if ($result === false) {
                    // slug already exists?
                } else {
                    $this->redirect($this->url('music', array()));
                }
            }
        }

        $this->view->form = $addForm;
        $this->render('music/add.phtml');
    }
}