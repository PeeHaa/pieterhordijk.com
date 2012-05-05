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

    public function getGithubModel()
    {
        $uri = new MFW_Http_Uri('https://api.github.com');
        $httpClient = new MFW_Http_Client($uri, array('verifypeer'=>0));

        return new GithubModel($httpClient);
    }
}