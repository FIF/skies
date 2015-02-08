{{ Form::open(array('action'=>'ProcessController@process_upload','enctype'=>'multipart/form-data')) }}
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
{ Form::close() }}