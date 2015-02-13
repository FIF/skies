<?php

class FileEntry extends Eloquent {

	protected $table = 'files';

	// Get current proccessed sheets.
	// Use when check what sheet is still in progress.
	public static function getCurrentFile() { //$hour
		// $hour is time before to fetch file to check.
		// TODO need user id to separate client.
		//($hour != 0)? $hour : 0; // set hour to not null

		$cur_files = FileEntry::select('id', 'file_name')
								->whereRaw('updated_at > timestamp(DATE_SUB(NOW(), INTERVAL 12 HOUR))')
								->whereRaw('updated_at < timestamp(NOW())')
								->get();

		return $cur_files;
	}

	// Get current proccessed sheets. Only file_name
	public static function currentFiles() {
		$cur_files = FileEntry::select('file_name')
								->whereRaw('updated_at > timestamp(DATE_SUB(NOW(), INTERVAL 12 HOUR))')
								->whereRaw('updated_at < timestamp(NOW())')
								->get();

		return $cur_files;
	}

	// Check a file is proccessing or not.
	public static function isFileProcessing($filename) {
		// check if file uploaded, not need


		// check in array current files
		// if true --> proccessed
		// or no, being proccessing



	}

	// get all in progress sheet process
	public static function getAllProccessingSheet() {

	}

	public static function updatePercentProcessed() {
		// when action processed sheet, the job is complete 100%
		// so we simulate progress based on this.
	}

	// get all processed sheet now
	private static function allProcessedSheet() {

		$results = array();

		$processeds = File::allFiles('files');

		foreach($processeds as $process) {
			if(File::lastModified($process) > self::twelveHourAgo()) {
				$results += [$process->getFileName()];
			}
		}

		return $results;
	}

	public static function twelveHourAgo() {
		return date('Y-m-d H:i:s', strtotime('-12 hour'));
	}

	public static function curProcessingSheet() {
		// peding doan check 12h moded

		$results = array(); // in progress sheets.

		// all current file uploaded
		$cur_files = self::currentFiles();

		// all processed sheets.
		$processed = self::allProcessedSheet();

		foreach($cur_files as $curFile) {
			if(!self::checkFileInArray($curFile->file_name, 'xlsx', $processed)) {  // cur file not processed
				$results += [self::getReportFile($curFile, 'xlsx')];
			}

			// check csv output
			if(!self::checkFileInArray($curFile->file_name, 'csv', $processed)) {  // cur file not processed
				$results += [self::getReportFile($curFile, 'csv')];
			}
		}

		return $results;
	}

	// Because uploaded sheet, after process become name-Report.csv | xls
	// So we need check name with this...
	// $files : all current uploaded sheets.
	// $arrOfFile: all cur processed sheets.
	private static function checkFileInArray($file, $outp_ext, $arrOfFile) {
		// NOTE $arrOfFile could be object, not array

		$report_file = self::getReportFile($file, $outp_ext);

		if(in_array($report_file, $arrOfFile)) {  // file not processed yet.
			return true;
		}

		return false;
	}

	public static function getFilePath($filename) {
		$ext = '';

		if(!empty($filename)) {
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
		}

		return $ext;
	}

	// Not Use
	public static function getReportFileName($curFile) {
		if(!empty($curFile)) {
			$ext = self::getFilePath($curFile);
			$result = basename($curFile, '.'.$ext);

			return $result.'-Report.'.$ext;
		} else {

			return '';
		}

	}

	// System output xlsx and csv, so this function return this
	public static function getReportFile($sheet, $report_ext) {
		if(!empty($sheet)) {
			$ext = self::getFilePath($sheet);
			$result = basename($sheet, '.'.$ext);

			return $result.'-Report.'.$report_ext;
		} else {

			return '';
		}

	}

}
