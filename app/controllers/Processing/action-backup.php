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

$keywords = array();
$separatedWords = array();
$uniqueWords = array();
$frequency = array();
if ($type == 2)
{
	$impression = array();
	$clicks = array();
	$ctr = array();
	$position = array();
}
$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

for ($n = 1; $n <= $objPHPExcel->setActiveSheetIndex(0)->getHighestRow(); $n++)
{
	// Separate using all the delimiters
	array_push($keywords,$sheetData[$n]["A"]);
	$tmpWords = preg_split('/['.$delimeter.']/', $sheetData[$n]["A"]);
	for ($m = 0; $m < count($tmpWords); $m++)
	{
		$sidx = array_search ($tmpWords[$m],$uniqueWords);
		if ($sidx > -1)
		{
			$frequency[$sidx]++;
		}
		else
		{
			$frequency[count($uniqueWords)] = 1;
			array_push($uniqueWords,$tmpWords[$m]);
			
		}
	}
	$separatedWords = array_merge ($separatedWords,$tmpWords);
	
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

// create some borders
// first, create the whole grid around the table
//$objSheet->getStyle('A1:E5')->getBorders()->
//getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

// autosize the columns
$objSheet->getColumnDimension('A')->setAutoSize(true);
$objSheet->getColumnDimension('B')->setAutoSize(true);
$objSheet->getColumnDimension('C')->setAutoSize(true);
$objSheet->getColumnDimension('D')->setAutoSize(true);
$objSheet->getColumnDimension('E')->setAutoSize(true);

// write the file
$fname = explode('.',$filename);
$objWriter->save('./files/'.$fname[0].'-Report.xlsx');

