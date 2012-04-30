<?php

class ModelFactory
{
    protected $databaseConnection;

    public function __construct(MFW_Db_Connection $databaseConnection)
    {
        $this->databaseConnection = $databaseConnection;
    }

    public function getModel($model)
    {
        $model.= 'Model';

        return new $model(new MFW_Db_Table($this->databaseConnection));
    }
}