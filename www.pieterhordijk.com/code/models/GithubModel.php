<?php

class GithubModel
{
    protected $httpClient;

    public function __construct(MFW_Http_Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getCommits($user, $repo, $page, $pageSize)
    {
        $apiRequestUrl = MFW_GITHUB_API_BASE_URL;
        $apiRequestUrl.= '/repos/' . $user . '/' . $repo . '/commits';
        $apiRequestUrl.= '?page=' . $page . '&per_page=' . $pageSize;

        $uri = new MFW_Http_Uri($apiRequestUrl);
        $this->httpClient->setUri($uri);

        $this->httpClient->request();

        $response = $this->httpClient->getLastResponse();

        if ($response['headers']['Status'] == '404 Not Found') {
            return null;
        }

        return json_decode($response['body']);
    }

    protected function parseCommits($githubResponse)
    {
        dump(json_decode($githubResponse['body']));
    }
}