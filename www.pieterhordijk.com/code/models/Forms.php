<?php

class Project_Create_Form extends MFW_Form
{
    function __construct()
    {
        parent::__construct(True);

        $this->addField('title', new MFW_Form_Field_Text(array('required'=>true)));
        $this->addField('slug', new MFW_Form_Field_Text(array('required'=>true)));
        $this->addField('intro', new MFW_Form_Field_Textarea(array('required'=>false)));
        $this->addField('description', new MFW_Form_Field_Textarea(array('required'=>false)));
        $this->addField('github', new MFW_Form_Field_Text(array('required'=>false)));
        $this->addField('download', new MFW_Form_Field_Text(array('required'=>false)));
        $this->addField('version', new MFW_Form_Field_Text(array('required'=>false)));
        $this->addField('submit', new MFW_Form_Field_Submit(array('initial'=>'Create')));
    }
}

class Create_User_Form extends MFW_Form
{
    function __construct()
    {
        parent::__construct(True);

        $this->addField('username', new MFW_Form_Field_Text(array('required'=>true)));
        $this->addField('password', new MFW_Form_Field_Password(array('required'=>true)));
        $this->addField('email', new MFW_Form_Field_Email(array('required'=>true)));
        $this->addField('submit', new MFW_Form_Field_Submit(array('initial'=>'')));
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