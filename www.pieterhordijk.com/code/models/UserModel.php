<?php

class UserModel extends MFW_Model
{
    public function __construct(MFW_Db_Table $table)
    {
        $table->setTable('users');

        $this->table = $table;
    }

    protected function getTableColumnsList()
    {
        return array('username', 'password', 'email');
    }

    public function createUser(Create_User_Form $form)
    {
        if ($this->doesUserExist($form->getField('username')->getData())) {
            return false;
        }

        $password = $this->cryptPassword($form->getField('password')->getData());
        if ($password === false) {
            return false;
        }

        $data = array('username' => $form->getField('username')->getData(),
                      'password' => $password,
                      'email' => $form->getField('email')->getData(),
                      );

        return $this->table->insert($data);
    }

    protected function cryptPassword($password, $type = 'blowfish')
    {
        $cryptType = '';

        switch($type) {
            case 'blowfish':
                $cryptType = '$2a$10$';
                break;

            default:
                return false;
        }

        $salt = $this->getSalt(CRYPT_SALT_LENGTH);

        $cryptPass = crypt($password, $cryptType . $salt);

        return $cryptPass;
    }

    protected function getSalt($length)
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789./';

        $salt = '';
        for($i = 0; $i <= $length; $i ++) {
            $chars = str_shuffle($chars);

            $salt.= $chars[rand(0,63)];
        }

        return $salt;
    }

    protected function doesUserExist($username)
    {
        $recordset = $this->table->select('username',
                                          $this->table->where('username = ?', $username));

        if ($recordset) {
            return true;
        }

        return false;
    }

    protected function validatePassword($inputPassword, $storedPassword)
    {
        if (crypt($inputPassword, $storedPassword) == $storedPassword) {
            return true;
        }

        return false;
    }

    protected function parseRecordset($recordset)
    {
        $projects = array();
        foreach($recordset as $record) {
            $project = new StdClass();

            $project->id = $record['id'];
            $project->username = $record['username'];
            $project->title = $record['title'];
            $project->slug = $record['slug'];
            $project->intro = $record['intro'];
            $project->description = $record['description'];
            $project->github = $record['github'];
            $project->download = $record['download'];
            $project->version = $record['version'];
            $project->timestamp = $record['timestamp'];

            $projects[$project->id] = $project;
        }

        return $projects;
    }
}