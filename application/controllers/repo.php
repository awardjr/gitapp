<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Repo extends CI_Controller {

	public function view($username, $repo)
	{
		$this->load->model('github');
		$this->load->helper('url');

		$repo = $this->github->getRepo($username, $repo);

		if($repo == null)
		{
			show_error("Repository does not exist", 400);
		}

		$data['full_name'] = $repo->full_name;
		$updated_at = new DateTime($repo->updated_at);
		$data['updated_at'] = $updated_at->format("l, F NS  h:i:s A");

		$this->load->view('repo', $data);
	}
}
