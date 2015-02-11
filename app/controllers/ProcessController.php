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

		// return Response::json('kkk');

		$files = Input::file('files');

		foreach($files as $file) {
			$ext = $file->guessClientExtension(); // (Based on mime type)
			//$ext = $file->getClientOriginalExtension(); // (Based on filename)
			$filename = $file->getClientOriginalName();
			$tmp = explode('.'.$ext,$filename);
			$finalname = $tmp[0].'_'.date('YmdHis').'.'.$ext;


			$file2 = $file;

			if (Input::get('type') == 1)
				$file->move('normal/', $finalname);
			if (Input::get('type') == 2)
				$file->move('gwt/', $finalname);
			if (Input::get('type') == 3)
				$file->move('similiarweb/', $finalname);

			
			// $file2->move('uploads/', $finalname);

			$FileEntry = new FileEntry;
			$FileEntry->file_name = $finalname;
			$FileEntry->type= Input::get('type');
			$FileEntry->status = 1;
			$FileEntry->started_at = date('Y-m-d H:i:s');
			$FileEntry->finished_at = date('0000-00-00 00:00:00');
			// exec("php ./test.php");
			// exec("php ./test.php 2 \> &1");
			// Queue::push('ProcessController@test');
			$FileEntry->save();


			$this->processExcelCsv($type, $finalname);
		}

		return Response::json($file);
		// return Redirect::to('/');
		
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

	private static function _test() {
		$this->newTmpDir();
		$filetest = public_path(). "/uploads/tmp/test.txt";
		File::put($filetest, " des: test".public_path(). " ". rand());
	}

	private static function _echoing($msg) {
		$filetest = public_path(). "/uploads/tmp/echo.txt";
		File::put($filetest, " des: test".public_path(). " ". $msg);
	}

	// Create new tempory directory if not exist, this dir store temp image upload
    private function newTmpDir() {
    	$this->newTmpDir();
        $path = public_path(). '/uploads/tmp/';

        if(!File::exists($path)) {
            // path does not exist
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        return;
    }

    private static function processExcelCsv($type, $file) {
		$type = $type;
		$filename = $file;
		include(base_path().'/app/controllers/Processing/action.php');

	}
}
?>