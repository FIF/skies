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
        $files = File::allFiles('files');
        // chmod(base_path().'/files', 777);
        $in_progress = FileEntry::curProcessingSheet();

		$this->layout->content = View::make('main.dashboard', compact('files', 'in_progress'));
		
	}

    public function show_files()
    {
        $files = FileEntry::all();

        // $cur_files = FileEntry::curProcessingSheet();
        // $files = File::allFiles('files');

        $this->layout->content = View::make('main.files')->with('files',$files);
    }

    public function processed_files()
    {
        
        return View::make('main.processed_files')->with('files', File::allFiles('files'));
    }
	
}
?>