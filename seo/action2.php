<?php

error_reporting(E_ALL);
set_time_limit(0);

$type = $_POST['type'];
$filename = $_POST['filename'];
$delimeter = "";
$delimeters = array('~','`','!','@','#','$','%','^','&','*','(',')','_','+','=','{','}','|','\-','*','\\\\',':','"',';','\'','<','>','?',',','.','\/',' ');
$idx = 0;
for ($n = 1; $n < 33; $n++)
{
	if (isset($_POST['d'.$n]))
		$delimeter .= $delimeters[$n-1];
}
date_default_timezone_set('Singapore');


/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . '../../../Classes/');

/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';


//$inputFileName = './sampleData/example1.xls';

$inputFileName = './server/php/files/'.$filename;
$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

$n = 1;
$keywords = array();
$separatedWords = array();
$uniqueWords = array();
$frequency = array();
if ($type == 2)
{
	$imp = array();
	$clc = array();
	$ct = array();
	$pos = array();
	
	$impression = array();
	$clicks = array();
	$ctr = array();
	$position = array();
	$n = 2;
}
else if ($type == 3)
{
	$traf = array();
	$traffic = array();
	$n = 2;
}

for (; $n <= $objPHPExcel->setActiveSheetIndex(0)->getHighestRow(); $n++)
{
	
	array_push($keywords,$sheetData[$n]["A"]);
	if ($type == 2)
	{
	
			
			array_push($imp,$sheetData[$n]["B"]);
			array_push($clc,$sheetData[$n]["C"]);
			array_push($ct,$sheetData[$n]["D"]);
			array_push($pos,$sheetData[$n]["E"]);
			/*
			array_push($imp,$sheetData[$n]["B"]);
			array_push($clc,$sheetData[$n]["D"]);
			array_push($ct,$sheetData[$n]["F"]);
			array_push($pos,$sheetData[$n]["H"]);*/
		
	}
	else if ($type == 3)
	{
		array_push($traf,$sheetData[$n]["D"]);
	}
	// Separate using all the delimiters
	$tmpWords = preg_split('/['.$delimeter.']/', $sheetData[$n]["A"]);
	for ($m = 0; $m < count($tmpWords); $m++)
	{
		if ($tmpWords[$m] == "" || $tmpWords[$m] == " ")
		{
			array_splice($tmpWords, $m, 1);
		}
		$sidx = array_search (strtolower($tmpWords[$m]), array_map('strtolower', $uniqueWords));
		if ($sidx > -1)
		{
			$frequency[$sidx]++;
			if ($type == 2)
			{
				//echo $uniqueWords[$sidx]." ".$sheetData[$n]["B"]." ".$impression[$sidx]."<br>";
				$impression[$sidx] = $impression[$sidx] + $sheetData[$n]["B"];
				$clicks[$sidx] = $clicks[$sidx] + $sheetData[$n]["C"];
				$ctr[$sidx] = $ctr[$sidx] + $sheetData[$n]["D"];
				$position[$sidx] = $position[$sidx] + $sheetData[$n]["E"];
			}
			else if ($type == 3)
			{
				$traffic[$sidx] = $traffic[$sidx] + $sheetData[$n]["D"];
			}
		}
		else
		{
			$frequency[count($uniqueWords)] = 1;
			array_push($uniqueWords,$tmpWords[$m]);
			if ($type == 2)
			{
				array_push($impression, $sheetData[$n]["B"]);
				array_push($clicks, $sheetData[$n]["C"]);
				array_push($ctr, $sheetData[$n]["D"]);
				array_push($position, $sheetData[$n]["E"]);
			}
			else if ($type == 3)
			{
				array_push($traffic, $sheetData[$n]["D"]);
			}
		}
	}
	$separatedWords = array_merge ($separatedWords,$tmpWords);
	if ($type == 1)
		array_multisort($frequency, SORT_DESC, $uniqueWords);
	else if ($type == 2)
		array_multisort($frequency, SORT_DESC, $uniqueWords,$impression,$clicks,$ctr,$position);
	else if ($type == 3)
		array_multisort($frequency, SORT_DESC, $uniqueWords,$traffic);
}
/*
for ($m = 0; $m < count ($separatedWords); $m++)
	echo $separatedWords[$m]."<br>";
for ($m = 0; $m < count ($uniqueWords); $m++)
	echo $uniqueWords[$m]." ".$frequency[$m]."<br>";
*/

// create new PHPExcel object
$objPHPExcel = new PHPExcel;
// set default font
$objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');
// set default font size
$objPHPExcel->getDefaultStyle()->getFont()->setSize(8);
// create the writer
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
// writer already created the first sheet for us, let's get it
$objSheet = $objPHPExcel->getActiveSheet();
// rename the sheet
$objSheet->setTitle('Excel Sheet report');


$objPHPExcel2 = new PHPExcel;
// create the writer
$objWriter2 = PHPExcel_IOFactory::createWriter($objPHPExcel2, "Excel2007");
// writer already created the first sheet for us, let's get it
$objSheet2 = $objPHPExcel2->getActiveSheet();
// rename the sheet
$objSheet2->setTitle('Excel Sheet report');

if ($type == 1)
{
		// let's bold and size the header font and write the header
	// as you can see, we can specify a range of cells, like here: cells from A1 to A4
	$objSheet->getStyle('A1:E1')->getFont()->setBold(true)->setSize(12);
	
	// write header
	$objSheet->getCell('A1')->setValue('KEYWORDs');
	$objSheet->getCell('B1')->setValue('SEPERATED WORDs');
	$objSheet->getCell('C1')->setValue('UNIQUE WORDs');
	$objSheet->getCell('D1')->setValue('FREQUENCY COUNT');
	$objSheet->getCell('E1')->setValue('CHARACTER COUNT');
	
	for ($m = 0; $m < count ($keywords); $m++)
	{
		$objSheet->getCell('A'.($m+2))->setValue($keywords[$m]);
	}
	
	for ($m = 0; $m < count ($separatedWords); $m++)
	{
		$objSheet->getCell('B'.($m+2))->setValue($separatedWords[$m]);
	}
	
	for ($m = 0; $m < count ($uniqueWords); $m++)
	{
		$objSheet->getCell('C'.($m+2))->setValue($uniqueWords[$m]);
		$objSheet->getCell('D'.($m+2))->setValue($frequency[$m]);
		$objSheet->getCell('E'.($m+2))->setValue(strlen($uniqueWords[$m]));
	}
	
	
	// autosize the columns
	$objSheet->getColumnDimension('A')->setAutoSize(true);
	$objSheet->getColumnDimension('B')->setAutoSize(true);
	$objSheet->getColumnDimension('C')->setAutoSize(true);
	$objSheet->getColumnDimension('D')->setAutoSize(true);
	$objSheet->getColumnDimension('E')->setAutoSize(true);
	
	// write the file
	$fname = explode('.',$filename);
	$objWriter->save('./files/'.$fname[0].'-Report.xlsx');
	
	
	// write header
	$objSheet2->getCell('A1')->setValue('SEPERATED WORDs');
	$objSheet2->getCell('B1')->setValue('UNIQUE WORDs');
	$objSheet2->getCell('C1')->setValue('FREQUENCY COUNT');
	$objSheet2->getCell('D1')->setValue('CHARACTER COUNT');
	
	
	for ($m = 0; $m < count ($separatedWords); $m++)
	{
		$objSheet2->getCell('A'.($m+2))->setValue($separatedWords[$m]);
	}
	
	for ($m = 0; $m < count ($uniqueWords); $m++)
	{
		$objSheet2->getCell('B'.($m+2))->setValue($uniqueWords[$m]);
		$objSheet2->getCell('C'.($m+2))->setValue($frequency[$m]);
		$objSheet2->getCell('D'.($m+2))->setValue(strlen($uniqueWords[$m]));
	}
	
	
	
	// write the file
	$objWriter2->save('./files/'.$fname[0].'-Report.csv');
}
else if ($type == 2)
{

	// let's bold and size the header font and write the header
	// as you can see, we can specify a range of cells, like here: cells from A1 to A4
	$objSheet->getStyle('A1:M1')->getFont()->setBold(true)->setSize(12);
	
	// write header
	$objSheet->getCell('A1')->setValue('Query');
	$objSheet->getCell('B1')->setValue('Impressions');
	$objSheet->getCell('C1')->setValue('Clicks');
	$objSheet->getCell('D1')->setValue('CTR');
	$objSheet->getCell('E1')->setValue('Avg. position');
	
	$objSheet->getCell('F1')->setValue('SEPERATED WORDs');
	$objSheet->getCell('G1')->setValue('UNIQUE WORDs');
	$objSheet->getCell('H1')->setValue('FREQUENCY COUNT');
	$objSheet->getCell('I1')->setValue('CHARACTER COUNT');
	
	$objSheet->getCell('J1')->setValue('Summed Impressions');
	$objSheet->getCell('K1')->setValue('Summed Clicks');
	$objSheet->getCell('L1')->setValue('Summed CTR');
	$objSheet->getCell('M1')->setValue('Summed Avg. position');
	for ($m = 0; $m < count ($keywords); $m++)
	{
		$objSheet->getCell('A'.($m+2))->setValue($keywords[$m]);
		$objSheet->getCell('B'.($m+2))->setValue($imp[$m]);
		$objSheet->getCell('C'.($m+2))->setValue($clc[$m]);
		$objSheet->getCell('D'.($m+2))->setValue($ct[$m]);
		$objSheet->getCell('E'.($m+2))->setValue($pos[$m]);
	}
	
	for ($m = 0; $m < count ($separatedWords); $m++)
	{
		$objSheet->getCell('F'.($m+2))->setValue($separatedWords[$m]);
	}
	
	for ($m = 0; $m < count ($uniqueWords); $m++)
	{
		$objSheet->getCell('G'.($m+2))->setValue($uniqueWords[$m]);
		$objSheet->getCell('H'.($m+2))->setValue($frequency[$m]);
		$objSheet->getCell('I'.($m+2))->setValue(strlen($uniqueWords[$m]));
		
		$objSheet->getCell('J'.($m+2))->setValue($impression[$m]);
		$objSheet->getCell('K'.($m+2))->setValue($clicks[$m]);
		$objSheet->getCell('L'.($m+2))->setValue($ctr[$m]);
		$objSheet->getCell('M'.($m+2))->setValue($position[$m]/$frequency[$m]);
	}
	
	
	// autosize the columns
	$objSheet->getColumnDimension('A')->setAutoSize(true);
	$objSheet->getColumnDimension('B')->setAutoSize(true);
	$objSheet->getColumnDimension('C')->setAutoSize(true);
	$objSheet->getColumnDimension('D')->setAutoSize(true);
	$objSheet->getColumnDimension('E')->setAutoSize(true);
	$objSheet->getColumnDimension('F')->setAutoSize(true);
	$objSheet->getColumnDimension('G')->setAutoSize(true);
	$objSheet->getColumnDimension('H')->setAutoSize(true);
	$objSheet->getColumnDimension('I')->setAutoSize(true);
	$objSheet->getColumnDimension('J')->setAutoSize(true);
	$objSheet->getColumnDimension('K')->setAutoSize(true);
	$objSheet->getColumnDimension('L')->setAutoSize(true);
	$objSheet->getColumnDimension('M')->setAutoSize(true);
	
	// write the file
	$fname = explode('.',$filename);
	$objWriter->save('./files/'.$fname[0].'-Report.xlsx');
	
	// write header
	$objSheet2->getCell('A1')->setValue('SEPERATED WORDs');
	$objSheet2->getCell('B1')->setValue('UNIQUE WORDs');
	$objSheet2->getCell('C1')->setValue('FREQUENCY COUNT');
	$objSheet2->getCell('D1')->setValue('CHARACTER COUNT');
	$objSheet->getCell('E1')->setValue('Summed Impressions');
	$objSheet->getCell('F1')->setValue('Summed Clicks');
	$objSheet->getCell('G1')->setValue('Summed CTR');
	$objSheet->getCell('H1')->setValue('Summed Avg. position');
	
	
	for ($m = 0; $m < count ($separatedWords); $m++)
	{
		$objSheet2->getCell('A'.($m+2))->setValue($separatedWords[$m]);
	}
	
	for ($m = 0; $m < count ($uniqueWords); $m++)
	{
		$objSheet2->getCell('B'.($m+2))->setValue($uniqueWords[$m]);
		$objSheet2->getCell('C'.($m+2))->setValue($frequency[$m]);
		$objSheet2->getCell('D'.($m+2))->setValue(strlen($uniqueWords[$m]));
		
		$objSheet2->getCell('E'.($m+2))->setValue($impression[$m]);
		$objSheet2->getCell('F'.($m+2))->setValue($clicks[$m]);
		$objSheet2->getCell('G'.($m+2))->setValue($ctr[$m]);
		$objSheet2->getCell('H'.($m+2))->setValue($position[$m]/$frequency[$m]);
	}
	
	
	
	// write the file
	$objWriter2->save('./files/'.$fname[0].'-Report.csv');
}
else if ($type == 3)
{

	// let's bold and size the header font and write the header
	// as you can see, we can specify a range of cells, like here: cells from A1 to A4
	$objSheet->getStyle('A1:G1')->getFont()->setBold(true)->setSize(12);
	
	// write header
	$objSheet->getCell('A1')->setValue('Search terms');
	$objSheet->getCell('B1')->setValue('Traffic Share');
	
	$objSheet->getCell('C1')->setValue('SEPERATED WORDs');
	$objSheet->getCell('D1')->setValue('UNIQUE WORDs');
	$objSheet->getCell('E1')->setValue('FREQUENCY COUNT');
	$objSheet->getCell('F1')->setValue('CHARACTER COUNT');
	
	$objSheet->getCell('G1')->setValue('SUMMED TRAFFIC SHARE');
	
	for ($m = 0; $m < count ($keywords); $m++)
	{
		$objSheet->getCell('A'.($m+2))->setValue($keywords[$m]);
		$objSheet->getCell('B'.($m+2))->setValue($traf[$m]);
	}
	
	for ($m = 0; $m < count ($separatedWords); $m++)
	{
		$objSheet->getCell('C'.($m+2))->setValue($separatedWords[$m]);
	}
	
	for ($m = 0; $m < count ($uniqueWords); $m++)
	{
		$objSheet->getCell('D'.($m+2))->setValue($uniqueWords[$m]);
		$objSheet->getCell('E'.($m+2))->setValue($frequency[$m]);
		$objSheet->getCell('F'.($m+2))->setValue(strlen($uniqueWords[$m]));
		
		$objSheet->getCell('G'.($m+2))->setValue($traffic[$m]);
	}
	
	// autosize the columns
	$objSheet->getColumnDimension('A')->setAutoSize(true);
	$objSheet->getColumnDimension('B')->setAutoSize(true);
	$objSheet->getColumnDimension('C')->setAutoSize(true);
	$objSheet->getColumnDimension('D')->setAutoSize(true);
	$objSheet->getColumnDimension('E')->setAutoSize(true);
	$objSheet->getColumnDimension('F')->setAutoSize(true);
	$objSheet->getColumnDimension('G')->setAutoSize(true);
	
	// write the file
	$fname = explode('.',$filename);
	$objWriter->save('./files/'.$fname[0].'-Report.xlsx');	
	
	// write header
	$objSheet2->getCell('A1')->setValue('SEPERATED WORDs');
	$objSheet2->getCell('B1')->setValue('UNIQUE WORDs');
	$objSheet2->getCell('C1')->setValue('FREQUENCY COUNT');
	$objSheet2->getCell('D1')->setValue('CHARACTER COUNT');
	$objSheet->getCell('E1')->setValue('SUMMED TRAFFIC SHARE');
	
	
	for ($m = 0; $m < count ($separatedWords); $m++)
	{
		$objSheet2->getCell('A'.($m+2))->setValue($separatedWords[$m]);
	}
	
	for ($m = 0; $m < count ($uniqueWords); $m++)
	{
		$objSheet2->getCell('B'.($m+2))->setValue($uniqueWords[$m]);
		$objSheet2->getCell('C'.($m+2))->setValue($frequency[$m]);
		$objSheet2->getCell('D'.($m+2))->setValue(strlen($uniqueWords[$m]));
		$objSheet->getCell('E'.($m+2))->setValue($traffic[$m]);
	}

	// write the file
	$objWriter2->save('./files/'.$fname[0].'-Report.csv');
}