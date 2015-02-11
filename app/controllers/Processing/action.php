<?php
ini_set("memory_limit","1000M");
error_reporting(0);
set_time_limit(0);

// $type = $_POST['type'];
// $filename = $_POST['filename'];

$extension = explode('.',$filename);
echo $_POST['ids'];
$delimeter = "";
$delimeters = array('\[','`','!','@','#',
'$','%','^','&','*',
'(',')','_','+','=',
'{','}','|','\-','~',
'\\\\',':','"',';','\'',
'<','>','?','.',','
,'\/',' ','\]');
$idx = 0;
for ($n = 1; $n < 34; $n++)
{
	if (isset($_POST['d'.$n]))
		$delimeter .= $delimeters[$n-1];
}



// date_default_timezone_set('Singapore');


/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . '../../../Classes/');

/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';

include('config.php');
$inputFileName = base_path().'/normal/'.$filename; // Xua la server/files/ ...

if($extension[1] == 'csv')
{
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
	$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
	$objReader = PHPExcel_IOFactory::createReader('csv');
	$objPHPExcel = $objReader->load($inputFileName);
	$sheet = $objPHPExcel->getActiveSheet();
}
else
{
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
	$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

	$objReader = PHPExcel_IOFactory::createReader('Excel2007');
	$objPHPExcel = $objReader->load($inputFileName);
	$sheet = $objPHPExcel->getActiveSheet();
	//$data=$sheet->getCell("D9")->getValue();
}

$n = 1;
$keywords = array();
$separatedWords = array();
$uniqueWords = array();

if ($type == 2)
{
	$imp = array();
	$clc = array();
	$ct = array();
	$pos = array();
	
	$sum_impression = array();
	$sum_clicks = array();
	$sum_ctr = array();
	$sum_position = array();

	$n = 2;
}
else if ($type == 3)
{
	$traf = array();
	$traffic = array();
	$sum_traffic = array();
	
	$n = 2;
}

for (; $n <= $objPHPExcel->setActiveSheetIndex(0)->getHighestRow(); $n++)
{
	array_push($keywords,$sheetData[$n]["A"]);
	if ($type == 2)
	{
		
			array_push($imp,$sheet->getCell("B$n")->getValue());
			array_push($clc,$sheet->getCell("D$n")->getValue());
			array_push($ct,$sheet->getCell("F$n")->getValue());
			array_push($pos,$sheet->getCell("H$n")->getValue());
		
	}
	if ($type == 3)		
			array_push($traf,$sheet->getCell("D$n")->getValue());
	
	if ($delimeter != "")
	{
		// Separate using all the delimiters
		$tmpWords = preg_split('/['.$delimeter.']/', $sheetData[$n]["A"]);
		for ($m = 0; $m < count($tmpWords); $m++)
		{
			if (!empty($tmpWords[$m]) && $tmpWords[$m] != '0')
				$separatedWords[] = ltrim($tmpWords[$m],'0');
			else if(!empty($tmpWords[$m]) || $tmpWords[$m] == '0')
				$separatedWords[] = (int)($tmpWords[$m]);
		}
	}
	else
	{
		if (!empty($sheetData[$n]["A"]) && $sheetData[$n]["A"] != '0')
				$separatedWords[] = ltrim($sheetData[$n]["A"],'0');
			else if(!empty($sheetData[$n]["A"]) ||$sheetData[$n]["A"] == '0')
				$separatedWords[] = (int)($sheetData[$n]["A"]);
	}
}

$uniqueSeperatedKey = array();
$uniqueSeperatedKey	=	array_unique($separatedWords);
foreach($uniqueSeperatedKey as $val)
{
	//$val = addslashes($val);
	$fq = count(preg_grep("/{$val}/i", $separatedWords));
	$uniqueWords[$val] = $fq;	
	$fl_array = array_keys(preg_grep("/{$val}/i", $keywords));
	
	if ($type == 2)
	{
		$sum_impression[$val]= 0;
		$sum_clicks[$val]= 0;
		$sum_ctr[$val]= 0;
		$sum_position[$val]= 0;
		
		foreach($fl_array as $val2)
		{
			$sum_impression[$val]	+= $imp[$val2];
			$sum_clicks[$val]	+= $clc[$val2];
			$sum_position[$val]	+= $pos[$val2];
		}
		$sum_impression[$val]	= $sum_impression[$val];
		$sum_clicks[$val]		= $sum_clicks[$val] ;
		$sum_ctr[$val]		   = $sum_clicks[$val] / $sum_impression[$val];
		$sum_ctr[$val]		   = $sum_ctr[$val];
		$sum_position[$val]	  = $sum_position[$val] ;
	}
	
	if ($type == 3)
	{
		$sum_traffic[$val]= 0;
		foreach($fl_array as $val2)
		{
			$sum_traffic[$val] += $traf[$val2];
		}
		$sum_traffic[$val]	=	$sum_traffic[$val] ;
	}
}

arsort($uniqueWords);

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
$objWriter2 = PHPExcel_IOFactory::createWriter($objPHPExcel2, "CSV");
// writer already created the first sheet for us, let's get it
$objSheet2 = $objPHPExcel2->getActiveSheet();
// rename the sheet
$objSheet2->setTitle('Excel Sheet report');

if ($type == 1)
{
		// let's bold and size the header font and write the header
	// as you can see, we can specify a range of cells, like here: cells from A1 to A4
	$objSheet->getStyle('A1:C1')->getFont()->setBold(true)->setSize(12);
	
	// write header
	$objSheet->getCell('A1')->setValue('UNIQUE WORDs');
	$objSheet->getCell('B1')->setValue('FREQUENCY COUNT');
	$objSheet->getCell('C1')->setValue('CHARACTER COUNT');

	$m=0;
	foreach($uniqueWords as $key => $val)
	{
		$objSheet->getCell('A'.($m+2))->setValue($key);
		$objSheet->getCell('B'.($m+2))->setValue($val);
		$objSheet->getCell('C'.($m+2))->setValue(mb_strlen( $key, 'utf8'));
		$m++;
	}
	
	// autosize the columns
	$objSheet->getColumnDimension('A')->setAutoSize(true);
	$objSheet->getColumnDimension('B')->setAutoSize(true);
	$objSheet->getColumnDimension('C')->setAutoSize(true);
	
	// write the file
	$fname = explode('.',$filename);
	$objWriter->save(base_path().'/files/'.$fname[0].'-Report.xlsx');
	
	
	// write header
	$objSheet2->getCell('A1')->setValue('UNIQUE WORDs');
	$objSheet2->getCell('B1')->setValue('FREQUENCY COUNT');
	$objSheet2->getCell('C1')->setValue('CHARACTER COUNT');
	

	$m=0;
	foreach($uniqueWords as $key => $val)
	{
		$objSheet2->getCell('A'.($m+2))->setValue($key);
		$objSheet2->getCell('B'.($m+2))->setValue($val);
		$objSheet2->getCell('C'.($m+2))->setValue(mb_strlen( $key, 'utf8'));
		$m++;
	}
	
	// write the file
	$objWriter2->save('./files/'.$fname[0].'-Report.csv');
}
else if ($type == 2)
{

	// let's bold and size the header font and write the header
	// as you can see, we can specify a range of cells, like here: cells from A1 to A4
	$objSheet->getStyle('A1:G1')->getFont()->setBold(true)->setSize(12);
	
	$objSheet->getCell('A1')->setValue('UNIQUE WORDs');
	$objSheet->getCell('B1')->setValue('FREQUENCY COUNT');
	$objSheet->getCell('C1')->setValue('CHARACTER COUNT');
	
	$objSheet->getCell('D1')->setValue('Summed Impressions');
	$objSheet->getCell('E1')->setValue('Summed Clicks');
	$objSheet->getCell('F1')->setValue('Summed CTR');
	$objSheet->getCell('G1')->setValue('Summed Avg. position');
	$sa = array();
	$m = 0;
	foreach($uniqueWords as $key => $val)
	{
		$cnt = count(preg_grep("/{$key}/i", $keywords));
		
		$objSheet->getCell('A'.($m+2))->setValue($key);
		$objSheet->getCell('B'.($m+2))->setValue($val);
		$objSheet->getCell('C'.($m+2))->setValue(mb_strlen( $key, 'utf8'));
		$objSheet->getCell('D'.($m+2))->setValue($sum_impression[$key]);
		$objSheet->getCell('E'.($m+2))->setValue($sum_clicks[$key]);
		$objSheet->getCell('F'.($m+2))->setValue($sum_ctr[$key]);
		$objSheet->getCell('G'.($m+2))->setValue($sum_position[$key] /$cnt);
		$sa[$m] = $sum_position[$key] /$cnt;
		$m++;
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
	$objSheet2->getCell('A1')->setValue('UNIQUE WORDs');
	$objSheet2->getCell('B1')->setValue('FREQUENCY COUNT');
	$objSheet2->getCell('C1')->setValue('CHARACTER COUNT');
	$objSheet2->getCell('D1')->setValue('Summed Impressions');
	$objSheet2->getCell('E1')->setValue('Summed Clicks');
	$objSheet2->getCell('F1')->setValue('Summed CTR');
	$objSheet2->getCell('G1')->setValue('Summed Avg. position');
	
	
	
	$m = 0;
	foreach($uniqueWords as $key => $val)
	{
		$cnt = count(preg_grep("/{$key}/i", $keywords));
		$objSheet2->getCell('A'.($m+2))->setValue($key);
		$objSheet2->getCell('B'.($m+2))->setValue($val);
		$objSheet2->getCell('C'.($m+2))->setValue(mb_strlen( $key, 'utf8'));
		$objSheet2->getCell('D'.($m+2))->setValue($sum_impression[$key]);
		$objSheet2->getCell('E'.($m+2))->setValue($sum_clicks[$key]);
		$objSheet2->getCell('F'.($m+2))->setValue($sum_ctr[$key]);
		$objSheet2->getCell('G'.($m+2))->setValue($sa[$m]);
		$m++;
	}
	
	// write the file
	$objWriter2->save(base_path().'/files/'.$fname[0].'-Report.csv');
}
else if ($type == 3)
{

	// let's bold and size the header font and write the header
	// as you can see, we can specify a range of cells, like here: cells from A1 to A4
	$objSheet->getStyle('A1:D1')->getFont()->setBold(true)->setSize(12);
	
	// write header
	$objSheet->getCell('A1')->setValue('UNIQUE WORDs');
	$objSheet->getCell('B1')->setValue('FREQUENCY COUNT');
	$objSheet->getCell('C1')->setValue('CHARACTER COUNT');
	
	$objSheet->getCell('D1')->setValue('SUMMED TRAFFIC SHARE');

	
	$m = 0;
	foreach($uniqueWords as $key => $val)
	{
		$objSheet->getCell('A'.($m+2))->setValue($key);
		$objSheet->getCell('B'.($m+2))->setValue($val);
		$objSheet->getCell('C'.($m+2))->setValue(mb_strlen( $key, 'utf8'));
		$objSheet->getCell('D'.($m+2))->setValue($sum_traffic[$key]);
		$m++;
	}
	
		
	// autosize the columns
	$objSheet->getColumnDimension('A')->setAutoSize(true);
	$objSheet->getColumnDimension('B')->setAutoSize(true);
	$objSheet->getColumnDimension('C')->setAutoSize(true);
	$objSheet->getColumnDimension('D')->setAutoSize(true);
	
	// write the file
	$fname = explode('.',$filename);
	$objWriter->save(base_path().'/files/'.$fname[0].'-Report.xlsx');	
	
	// write header
	$objSheet2->getCell('A1')->setValue('UNIQUE WORDs');
	$objSheet2->getCell('B1')->setValue('FREQUENCY COUNT');
	$objSheet2->getCell('C1')->setValue('CHARACTER COUNT');
	$objSheet2->getCell('D1')->setValue('SUMMED TRAFFIC SHARE');
	
	
	$m=0;
	foreach($uniqueWords as $key => $val)
	{
		$objSheet2->getCell('A'.($m+2))->setValue($key);
		$objSheet2->getCell('B'.($m+2))->setValue($val);
		$objSheet2->getCell('C'.($m+2))->setValue(mb_strlen( $key, 'utf8'));
		$objSheet2->getCell('D'.($m+2))->setValue($sum_traffic[$key]);
		$m++;
	}

	// write the file
	$objWriter2->save(base_path().'/files/'.$fname[0].'-Report.csv');
}