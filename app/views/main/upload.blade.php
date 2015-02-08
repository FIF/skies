@extends('layouts.main')

@section('header')
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@stop
@section('content')
<div class="col-md-12">
    <!-- -- BASIC PROGRESS BARS ---->
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
{{ Form::open(array('action'=>'ProcessController@process_upload','enctype'=>'multipart/form-data')) }}
            {{ Form::hidden('type',$id) }}
            <div class="table">
                <div class="tableHeading">Select delimiter:</div>
                <input type="hidden" id="type" name="type" value="1">
                <div class="table-cell"><input type="checkbox" name="d1" id="d1" class="delimiter" checked> ~</div>
                <div class="table-cell"><input type="checkbox" name="d2" id="d2" class="delimiter" checked> `</div>
                <div class="table-cell"><input type="checkbox" name="d3" id="d3" class="delimiter" checked> !</div>
                <div class="table-cell"><input type="checkbox" name="d4" id="d4" class="delimiter" checked> @</div>
                <div class="table-cell"><input type="checkbox" name="d5" id="d5" class="delimiter" checked> #</div>
                <div class="table-cell"><input type="checkbox" name="d6" id="d6" class="delimiter" checked> $</div>
                <div class="table-cell"><input type="checkbox" name="d7" id="d7" class="delimiter" checked> %</div>
                <div class="table-cell"><input type="checkbox" name="d8" id="d8" class="delimiter" checked> ^</div>
                <div class="table-cell"><input type="checkbox" name="d9" id="d9" class="delimiter" checked> &</div>
                <div class="table-cell"><input type="checkbox" name="d10" id="d10" class="delimiter" checked> *</div>
                <div class="table-cell"><input type="checkbox" name="d11" id="d11" class="delimiter" checked> (</div>
                <div class="table-cell"><input type="checkbox" name="d12" id="d12" class="delimiter" checked> )</div>
                <div class="table-cell"><input type="checkbox" name="d13" id="d13" class="delimiter" checked> _</div>
                <div class="table-cell"><input type="checkbox" name="d14" id="d14" class="delimiter" checked> +</div>
                <div class="table-cell"><input type="checkbox" name="d15" id="d15" class="delimiter" checked> =</div>
                <div class="table-cell"><input type="checkbox" name="d16" id="d16" class="delimiter" checked> {</div>
                <div class="table-cell"><input type="checkbox" name="d17" id="d17" class="delimiter" checked> }</div>
                <div class="table-cell"><input type="checkbox" name="d18" id="d18" class="delimiter" checked> |</div>
                <div class="table-cell"><input type="checkbox" name="d19" id="d19" class="delimiter" checked> -</div>
                <div class="table-cell"><input type="checkbox" name="d20" id="d20" class="delimiter" checked> [</div>
                <div class="table-cell"><input type="checkbox" name="d21" id="d21" class="delimiter" checked> \</div>
                <div class="table-cell"><input type="checkbox" name="d22" id="d22" class="delimiter" checked> :</div>
                <div class="table-cell"><input type="checkbox" name="d23" id="d23" class="delimiter" checked> "</div>
                <div class="table-cell"><input type="checkbox" name="d24" id="d24" class="delimiter" checked> ;</div>
                <div class="table-cell"><input type="checkbox" name="d25" id="d25" class="delimiter" checked> '</div>
                <div class="table-cell"><input type="checkbox" name="d26" id="d26" class="delimiter" checked> <</div>
                <div class="table-cell"><input type="checkbox" name="d27" id="d27" class="delimiter" checked> ></div>
                <div class="table-cell"><input type="checkbox" name="d28" id="d28" class="delimiter" checked> ?</div>
                <div class="table-cell"><input type="checkbox" name="d29" id="d29" class="delimiter" checked> .</div>
                <div class="table-cell"><input type="checkbox" name="d30" id="d30" class="delimiter" checked> ,</div>
                <div class="table-cell"><input type="checkbox" name="d31" id="d31" class="delimiter" checked> /</div>
                <div class="table-cell"><input type="checkbox" name="d32" id="d32" class="delimiter" checked> Space</div>
                <div class="table-cell"><input type="checkbox" name="d33" id="d33" class="delimiter" checked> ]</div>
            </div>
            <input type="button" class="btn btn-warning" id="sall" value="Select All">
            <input type="button" class="btn btn-danger" id="usall" value="Unselect All"><br>
            <div class="horizontalLine"></div>
            
<fieldset>
<legend><br>Upload your files</legend>


<div>
	<input type="file" id="files" name="files[]" multiple />
	    <div id="selectedFiles"></div>
</div>

<div id="submitbutton">
<br>
	<input type="submit" value="Start Job" class="btn btn-primary">
    <a href="{{ URL::to('/') }}"><input type="button" class="btn btn-warning" value="Back"></a>
</div>

</fieldset>

</form>
    </div><!--/showback -->
  	
</div>
{{ Form::close() }}

@stop

@section ('script')
 <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
 	<script>
	var selDiv = "";
		
	document.addEventListener("DOMContentLoaded", init, false);
	
	function init() {
		document.querySelector('#files').addEventListener('change', handleFileSelect, false);
		selDiv = document.querySelector("#selectedFiles");
	}
		
	function handleFileSelect(e) {
		
		if(!e.target.files) return;
		
		selDiv.innerHTML = "";
		
		var files = e.target.files;
		for(var i=0; i<files.length; i++) {
			var f = files[i];
			
			selDiv.innerHTML += f.name + "<br/>";

		}
		
	}
	$("#sall").click(function(){
	$('.delimiter').prop('checked', true);
});
$("#usall").click(function(){
	$('.delimiter').prop('checked', false);
});
	</script>
@stop