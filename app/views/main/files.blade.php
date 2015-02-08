@extends('layouts.main')

@section('header')

 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@stop
@section('content')
<div class="col-md-12">
    <!-- -- BASIC PROGRESS BARS ---->
    <h3><i class="fa fa-angle-right"></i> Your Files</h3>
    
  	<div class="showback">
    	<h4><i class="fa fa-angle-right"></i> Running / Completed Jobs</h4>
       
         <table class="table table-bordered table-striped bootstrap-datatable smallerfont datatable">
                  <thead>
                      <tr>
                          <th>File Name</th>
                          <th>Job Option Type</th>
                          <th class="onlydesktop">Job Start</th>
                          <th class="onlydesktop">Job End</th>
                          <th class="onlydesktop">Completion</th>
                          <th>Actions</th>
                      </tr>
                  </thead>   
                  <tbody>
                  @foreach ($files as $key=>$value)
                  	<tr>
                    	<td>{{ $value->file_name }}</td>
                    	<td>
                        	@if ($value->type == 1)
                            	Normal 
                            @elseif ($value->type == 2)
                            	Google Webmaster
                            @else
                            	Similiar Web
                            @endif
                        </td>
                    	<td class="onlydesktop">{{ date('d-m-Y H:i:s',strtotime($value->started_at)) }}</td>
                    	<td class="onlydesktop">
                        	@if ($value->finished_at != "0000-00-00 00:00:00")
	                        	{{ date('d-m-Y H:i:s',strtotime($value->date_end)) }}
 							@else
                            	---
                            @endif
                        </td>
                    	<td class="onlydesktop">
                        	@if ($value->finished_at != "0000-00-00 00:00:00")
                            	100% Completed
 							@else
                                <div class="progress progress-striped active">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                    <span class="sr-only">0% Complete</span>
                                  </div>
                                </div>
                            @endif
                        </td>
                    	<td>
                       		@if ($value->finished_at != "0000-00-00 00:00:00")
                                <button type="button" class="btn btn-primary"><i class="fa fa-file-excel-o"></i></button>
                                <button type="button" class="btn btn-warning"><i class="fa fa-file-code-o"></i></button>
 							@else
                        		<button type="button" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</button>
                            @endif
                        </td>
                    </tr>
                 @endforeach
                  </tbody>
         </table>
    </div>
</div>
{{ Form::open(array('action'=>'ProcessController@upload','id'=>'uploadform','method'=>'put')) }}
	{{ Form::hidden('id',0,array('id'=>'processid')) }}
{{ Form::close() }}

@stop

@section ('script')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script>
	$('.datatable').DataTable({ "order": [[ 2, "desc" ]]});
	$("#normalsheet").click(function(){
		$("#processid").val(1);
		$("#uploadform").submit();
	});
	$("#googleweb").click(function(){
		$("#processid").val(2);
		$("#uploadform").submit();
	});
	$("#similiarweb").click(function(){
		$("#processid").val(3);
		$("#uploadform").submit();
	});

</script>
@stop