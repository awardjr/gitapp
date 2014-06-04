<?php

class Github extends CI_Model {

	//let's limit api calls just a tad.

    function __construct()
    {
        parent::__construct();
    	$this->load->library('easycurl');
    }

    //If we're rate limited we should let the user know. This check doesn't count towards rate limit
    public function getRateLimit()
    {
    	$limit = $this->easycurl->curl_get($this->config->item('github_api_uri') . "rate_limit");
    	return $limit->resources->core->remaining;
    }

    public function getUser($username)
    {
    	$user_data = $this->easycurl->curl_get($this->config->item('github_api_uri') . "users/" . $username);
    	//Check if user exists. If not, return null
    	if(!property_exists($user_data, 'id'))
    	{
    		return null;
    	}
    	return $user_data;
    }

    public function getUserRepos($username, $limit = 10, $offset = 0)
    {
    	$repo_data = $this->easycurl->curl_get($this->config->item('github_api_uri') . "users/" . $username . "/repos");
    	
    	if(empty($repo_data))
    	{
    		return null;
    	}
    	return array_slice($repo_data, $offset, $limit);
    }

    public function getRepo($username, $repo)
    {
    	$repo_data = $this->easycurl->curl_get($this->config->item('github_api_uri') . "repos/" . $username . "/" . $repo);

    	if(!property_exists($repo_data, 'id'))
    	{
    		return null;
    	}

    	return $repo_data;
    }
}
?>