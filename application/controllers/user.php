<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	//Make pretty urls
	public function rewrite()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');	

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('home');
		}
		else 
		{
			$this->load->helper('url');
			$user = $this->input->post('username');
			redirect($user); 
		}
	}

	public function view($username)
	{
		$this->load->model('github');
		$this->load->helper('url');

		if($this->github->getRateLimit() < 2)
		{
			show_error("You have reached the rate limit. Please try again later",500);
		}

		$user = $this->github->getUser($username);

		if($user == null)
		{
			show_error("User Doesn't Exist", 400);
		}

		$avatar = $user->avatar_url;
		$repos = $this->github->getUserRepos($username, 10);

		//handle case when user has no repos in a more graceful way
		if($repos == null)
		{
			$repo_data = array();
		}
		else
		{	
			foreach($repos as $repo)
			{
				$repo_data[] = $repo->name;
			}
		}
		$data['repos'] = $repo_data;
		$data['username'] = $username;
		$data['avatar'] = $avatar;

		$this->load->view('user', $data);
	}
}
