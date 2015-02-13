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
		//$files = FileEntry::all();
        $files = File::allFiles('files');
        // chmod(base_path().'/files', 777);
		$this->layout->content = View::make('main.dashboard')->with('files',$files);
		
	}

    public function show_files()
    {
        $files = FileEntry::all();
        $this->layout->content = View::make('main.files')->with('files',$files);
    }

    public function processed_files()
    {
        return View::make('main.processed_files')->with('files', File::allFiles('files'));
    }
	
}
?>