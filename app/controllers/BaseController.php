<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	// Get user stored in localStorage.
	public function getCurrentUser() {
        $user_profile = $_COOKIE['user_profile'];
        if(!empty($user_profile)) {
        	$user_id = unserialize($user_profile);
        	if(!empty($user_id)) {
        		return $user_id['user_id'];
        	}
        }

        return 0;
    }

    public function setUserId() {
    	$usr = ['user_id' => 10];
    	setcookie('user_profile', serialize($usr));
    	View::share('user_id', $usr['user_id']);
    }


}
