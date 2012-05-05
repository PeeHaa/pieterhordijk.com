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

    function contactAction()
    {
        $this->getRequest();
        $params = $this->getRequestParams();

        $contactForm = new Contact_Form();

        $this->view->form = $contactForm;

        if (isset($params['submit'])) {
            $contactForm->clean($params);

            if ($contactForm->isValid()) {
                $mail = new MFW_Mail();
                $mail->setSender($contactForm->getField('email')->getData(), $contactForm->getField('name')->getData());
                $mail->addRecipient('info@pieterhordijk.com', 'Pieter Hordijk');
                $mail->setSubject($contactForm->getField('subject')->getData());
                $mail->setBodyText($this->view->render('page/contact-mail.ptxt'));
                $mail->setBodyHtml($this->view->render('page/contact-mail.phtml'));

                $mail->send();

                $this->redirect($this->url('page/contact-success', array()));
            }
        }

        $this->render('page/contact.phtml');
    }

    function contactSuccessAction() {
        $this->render('page/contact-success.phtml');
    }
}