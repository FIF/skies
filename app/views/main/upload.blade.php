@extends('layouts.main')

    @section('header')
     <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css"> -->
    @stop
    @section('content')
    <div class="col-md-12">
        <!-- BASIC PROGRESS BARS -->
        <h3><i class="fa fa-angle-right"></i> Upload your files</h3>
        <div class="showback">
            <h4><i class="fa fa-angle-right"></i> 
            	@if ($id == 1)
                	Normal Sheet
                @elseif ($id == 2)
                	Google Webmaster
                @else
                	Similiar Web
                @endif
            
            </h4>
            <div class="horizontalLine"></div>
            @include('include.delimiter', ['id' => $id])            
            @include('include.multi_upload', array('id'=>$id))                
            @include('include.upload_script')
            
        </div><!--/showback -->
    </div><!-- /end col-md-12 -->

    @stop <!-- end content-->
 