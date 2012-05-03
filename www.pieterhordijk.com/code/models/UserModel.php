<?php

class UserModel extends MFW_Auth_User
{
    public function __construct(MFW_Db_Table $table)
    {
        parent::__construct($table);
    }

    protected function getTableColumnsList()
    {
        return array('username', 'password', 'email');
    }

    public function createUser(User_Register_Form $form)
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

    protected function doesUserExist($username)
    {
        $recordset = $this->table->select('username',
                                          $this->table->where('username = ?', $username));

        if ($recordset) {
            return true;
        }

        return false;
    }

    protected function getUserByUsername($username)
    {
        $recordset = $this->table->select($this->getTableColumns(),
                                          $this->table->where('lower(username) = ?', strtolower($username)));

        if (!$recordset) {
            return null;
        }

        $users = $this->parseRecordset($recordset);
        return reset($users);
    }

    protected function parseRecordset($recordset)
    {
        $users = array();

        foreach($recordset as $record) {
            $user = new StdClass();

            $user->username = $record['username'];
            $user->email = $record['email'];

            $users[$user->username] = $user;
        }

        return $users;
    }
}