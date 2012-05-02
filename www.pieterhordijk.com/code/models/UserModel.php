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

    public function loginUser(User_Login_Form $form)
    {
        $recordset = $this->table->select('username, password',
                                          $this->table->where('lower(username) = ?', strtolower($form->getField('username')->getData())));

        if (!$recordset || $this->validatePassword($form->getField('password')->getData(), $recordset[0]['password'])) {
            return false;
        }

        // this should be moved to the user class in the lib
        $_SESSION['MFW_user'] = array($recordset[0]['username']);

        return true;
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
}