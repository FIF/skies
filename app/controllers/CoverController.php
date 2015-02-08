<?php

class CoverController extends BaseController {
/**
* Display a listing of the resource.
*
* @return Response
*/
	protected $layout = "layouts.main";	
	public function index()
	{
		$files = FileEntry::all();
		$this->layout->content = View::make('main.dashboard')->with('files',$files);
		
	}
	
}
?>