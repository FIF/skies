<?php

class ProcessController extends BaseController {
/**
* Display a listing of the resource.
*
* @return Response
*/
	protected $layout = "layouts.main";	
	public function upload()
	{
		$id = Input::get('id');
		$this->layout->content = View::make('main.upload')->with('id',$id);
		//return View::make('main.test_multi_upl', compact('id'));
		
	}
	public function process_upload()
	{
		$files = Input::file('files');

		foreach($files as $file) {
			$ext = $file->guessClientExtension(); // (Based on mime type)
			//$ext = $file->getClientOriginalExtension(); // (Based on filename)
			$filename = $file->getClientOriginalName();
			$tmp = explode('.'.$ext,$filename);
			$finalname = $tmp[0].'_'.date('YmdHis').'.'.$ext;
			if (Input::get('type') == 1)
				$file->move('normal/', $finalname);
			if (Input::get('type') == 2)
				$file->move('gwt/', $finalname);
			if (Input::get('type') == 3)
				$file->move('similiarweb/', $finalname);
			$file->move('uploads/');
			$FileEntry = new FileEntry;
			$FileEntry->file_name = $finalname;
			$FileEntry->type= Input::get('type');
			$FileEntry->status = 1;
			$FileEntry->started_at = date('Y-m-d H:i:s');
			$FileEntry->finished_at = date('0000-00-00 00:00:00');
			exec ("php ./test.php");
			exec("php ./test.php 2>&1");
			Queue::push('ProcessController@test');
			Queue::push('ProcessController@test');
			Queue::push('ProcessController@test');
			$FileEntry->save();
		}
		return Redirect::to('/');
		
	}
	public function show_files()
	{
		$files = FileEntry::all();
		$this->layout->content = View::make('main.files')->with('files',$files);
	}
	public function test()
	{
		$myfile = fopen(base_path()."/html/tyroa.txt", "w") or die("Unable to open file!");
		$txt = "John Doe\n";
		fwrite($myfile, $txt);
		$txt = "Jane Doe\n";
		fwrite($myfile, $txt);
		fclose($myfile);
	}
}
?>