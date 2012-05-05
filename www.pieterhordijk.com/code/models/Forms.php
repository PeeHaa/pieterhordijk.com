<?php

class Project_Create_Form extends MFW_Form
{
    function __construct()
    {
        parent::__construct(True);

        $this->addField('title', new MFW_Form_Field_Text(array('required'=>true)));
        $this->addField('slug', new MFW_Form_Field_Text(array('required'=>true)));
        $this->addField('intro', new MFW_Form_Field_Textarea(array('required'=>true)));
        $this->addField('keywords', new MFW_Form_Field_Text(array('required'=>false)));
        $this->addField('description', new MFW_Form_Field_Textarea(array('required'=>false)));
        $this->addField('image', new MFW_Form_Field_File(array('required'=>false,
                                                               'max_size'=>20971520,
                                                               'save_path'=>MFW_SITE_PATH.'/public/img/projects',
                                                               'save_name'=>'hash',
                                                               'allowed_extensions' => array('png', 'jpg', 'jpeg', 'gif'))));
        $this->addField('github', new MFW_Form_Field_Text(array('required'=>false)));
        $this->addField('download', new MFW_Form_Field_Text(array('required'=>false)));
        $this->addField('version', new MFW_Form_Field_Text(array('required'=>false)));
        $this->addField('submit', new MFW_Form_Field_Submit(array('initial'=>'Save new project')));
    }
}

class Project_Edit_Form extends MFW_Form
{
    function __construct($project)
    {
        parent::__construct(True);

        $this->addField('id', new MFW_Form_Field_Hidden(array('required'=>true, 'initial'=>$project->id)));
        $this->addField('title', new MFW_Form_Field_Text(array('required'=>true, 'initial'=>$project->title)));
        $this->addField('slug', new MFW_Form_Field_Text(array('required'=>true, 'initial'=>$project->slug)));
        $this->addField('intro', new MFW_Form_Field_Textarea(array('required'=>true, 'initial'=>$project->intro)));
        $this->addField('keywords', new MFW_Form_Field_Text(array('required'=>false, 'initial'=>$project->keywords)));
        $this->addField('description', new MFW_Form_Field_Textarea(array('required'=>false, 'initial'=>$project->description)));
        $this->addField('image', new MFW_Form_Field_File(array('required'=>false,
                                                               'max_size'=>20971520,
                                                               'save_path'=>MFW_SITE_PATH.'/public/img/projects',
                                                               'save_name'=>'hash',
                                                               'allowed_extensions' => array('png', 'jpg', 'jpeg', 'gif'))));
        $this->addField('github', new MFW_Form_Field_Text(array('required'=>false, 'initial'=>$project->github)));
        $this->addField('download', new MFW_Form_Field_Text(array('required'=>false, 'initial'=>$project->download)));
        $this->addField('version', new MFW_Form_Field_Text(array('required'=>false, 'initial'=>$project->version)));
        $this->addField('submit', new MFW_Form_Field_Submit(array('initial'=>'Update project')));
    }
}

class User_Register_Form extends MFW_Form
{
    function __construct()
    {
        parent::__construct(True);

        $this->addField('username', new MFW_Form_Field_Text(array('required'=>true)));
        $this->addField('password', new MFW_Form_Field_Password(array('required'=>true)));
        $this->addField('email', new MFW_Form_Field_Email(array('required'=>true)));
        $this->addField('submit', new MFW_Form_Field_Submit(array('initial'=>'Register')));
    }
}

class User_Login_Form extends MFW_Form
{
    function __construct()
    {
        parent::__construct(True);

        $this->addField('username', new MFW_Form_Field_Text(array('required'=>true,
                                                                  'attributes'=>array('placeholder'=>'Username'))));
        $this->addField('password', new MFW_Form_Field_Password(array('required'=>true,
                                                                      'attributes'=>array('placeholder'=>'Password'))));
        $this->addField('submit', new MFW_Form_Field_Submit(array('initial'=>'')));
    }
}

class Contact_Form extends MFW_Form
{
    function __construct()
    {
        parent::__construct(True);

        $this->addField('name', new MFW_Form_Field_Text(array('required'=>true)));
        $this->addField('email', new MFW_Form_Field_Email(array('required'=>true)));
        $this->addField('subject', new MFW_Form_Field_Text(array('required'=>true)));
        $this->addField('message', new MFW_Form_Field_Textarea(array('required'=>true)));
        $this->addField('submit', new MFW_Form_Field_Submit(array('initial'=>'Send')));
    }
}