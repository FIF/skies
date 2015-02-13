@extends('layouts.main')

@section('header')

 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@stop
@section('content')
<div class="col-md-12">
    <!-- -- BASIC PROGRESS BARS ---->
    <h3><i class="fa fa-angle-right"></i> Dashboard</h3>
    <div class="showback">
        <h4><i class="fa fa-angle-right"></i> Upload your files</h4>
        <div class="col-lg-4 col-md-4 col-sm-4 mb" id="normalsheet">
            <div class="green-panel pn">
                <i class="fa fa-file-o fa-4x"></i>
               
                <p class="title">Normal Sheet</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 mb" id="googleweb">
            <div class="blue-panel pn">
                <i class="fa fa-google fa-4x"></i>
               
                <p class="title">Google Webmaster</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 mb" id="similiarweb">
            <div class="red-panel pn">
                <i class="fa fa-globe fa-4x"></i>
               
                <p class="title">Similiar Web</p>
            </div>
        </div>
        <div class="clear"></div>
    </div><!--/showback -->
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
                  <div id="in_progress_tbl">
                    @foreach ($in_progress as $running)
                    <tr>
                      <td>{{ $running[0] }}
                      </td>
                      <td>
                            @if (1)
                              --- 
                            @endif
                        </td>
                      <td class="onlydesktop">{{ date('d-m-Y H:i:s') }}</td>
                      <td class="onlydesktop">

                              ---
                        </td>
                      <td class="onlydesktop">
                              1%
                        </td>
                      <td>
                              {{ "Download" }}
                         
                        </td>
                    </tr>
                 @endforeach
                 </div>

                  @foreach ($files as $file)
                    <tr>
                      <td>{{ link_to_asset($file->getPathName(), $file->getFileName()) }}
                        <!--a href="{{ base_path().'/'.$file->getPathName()}}">{{ $file->getFileName() }}</a-->
                      </td>
                      <td>
                            @if (1)
                              Normal 
                            <!--@ elseif ()
                              Google Webmaster
                            @ else
                              Similiar Web
                            -->
                            @endif
                        </td>
                      <td class="onlydesktop">{{ date('d-m-Y H:i:s') }}</td>
                      <td class="onlydesktop">

                              ---

                        </td>
                      <td class="onlydesktop">

                              100% Completed

                        </td>
                      <td>

                            <!--button type="button" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</button-->
                            
                              {{ link_to_asset($file->getPathName(), "Download") }}
                         

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

 $(document).ready(
    function() {
        setInterval(function() {
            //
            $.ajax({
              url: "{{ route('cover.processed_files') }}",
              type: "GET", // not POST, laravel won't allow it
              success: function(data){
                $data = $(data); // the HTML content your controller has produced
                $('#in_progress_tbl').fadeOut().html($data).fadeIn();    
                }
            });
        }, 5000);
    });

  if(window.top==window) {
    // You're not in a frame, so you reload the site.
    // window.setTimeout('location.reload()', 10000); //Reloads after 
  }
  else {
      //You're inside a frame, so you stop reloading.
  }


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