$(window).resize(function(){
	if ($(window).width() >= 767)
	{
		$("#menu-content").removeClass("out");
		$("#menu-content").addClass("in");
	}
});
$("#sall").click(function(){
	$('.delimiter').prop('checked', true);
});
$("#usall").click(function(){
	$('.delimiter').prop('checked', false);
});
$("#normal").click(function(){
	$("#title").html('<i class="fa fa- fa-file"></i> Normal Sheet</h3><div id="test-1.csv">');
	$("#type").val(1);
});
$("#google").click(function(){
	$("#title").html('<i class="fa fa- fa-google"></i> Google Webmaster</h3><div id="test-1.csv">');
	$("#type").val(2);
});
$("#web").click(function(){
	$("#title").html('<i class="fa fa- fa-globe"></i> Similiar Web</h3><div id="test-1.csv">');
	$("#type").val(3);
});
$(document).ready(function() {
  $.ajax({
			type: 'post',
			url: 'reset.php'
	});
});
$( window ).unload(function() {
  $.ajax({
			type: 'post',
			url: 'reset.php'
	});
});
/*
 * jQuery File Upload Plugin JS Example 8.9.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */
var ids = 0;
$(function ($) {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: 'upload',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(xlsx|xls|csv)$/i,
        maxFileSize: 5000000,
    });
	var fileName = [],fileSize =[];

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/html/result.html?%s'
        )
		).bind('fileuploaddone', function(e, data) {
            /* fix_me
		
			$.each(data.files, function (index, file) {
				var rem = 0;
				for (var t = 0; t < ids; t++)
				{
					if (fileName[t] == file.name)
					{
						rem++;
						$(".horizontalLine").html(file.name);
					}
				}
				if (rem > 0)
				{
					var tmpname = file.name.split('.');
						fileName[ids] = tmpname[0]+" ("+rem+")"+"."+tmpname[1];
				}
				else
					fileName[ids] =  file.name;
				fileSize[ids++] =  file.size;
			});

            console.log('filename='+fileName[ids-1]+'&ids='+ids+'&'+$('form').serialize());

			$.ajax({ 
					type: 'post',
                    // url: '/upload',
					url: '/attachments/store',
					timeout: 24 * 60 * 60 *3600,
					data: 'filename='+fileName[ids-1]+'&ids='+ids+'&'+$('form').serialize(),
					beforeSend: function() { 
						
						  
					},
					success: function(data) {
						if(data.success == false)
						{  
							$(".horizontalLine").html("Please try again. Try reloading the page or delete all existing files below");
						} 
						else 
						{	
							var nm,fn;
								nm = fileSize[data-1];
								fn = fileName[data-1].split(".");
								$("#ajaxLoader"+nm).css("display","none");
								$("#dowl"+nm).prop( "disabled", false );
								$("#dowlc"+nm).prop( "disabled", false );
								$("#dx"+nm).attr("href", "./files/"+fn[0]+"-Report.xlsx");
								$("#dc"+nm).attr("href",  "./files/"+fn[0]+"-Report.csv");
								$("#dx"+nm).attr("download", fn[0]+"-Report.xlsx");
								$("#dc"+nm).attr("download",  fn[0]+"-Report.csv");
							
						}
					},
					error: function(xhr, textStatus, thrownError) {
						$(".horizontalLine").html("Please try again. Try reloading the page or delete all existing files below");
					}
			});
*/
			// Pass the Name and Size through AJAX

		}).bind('fileuploadfail', function(e, data) {
			// Show error message
	});

    if (window.location.hostname === 'blueimp.github.io') {
        // Demo settings:
        $('#fileupload').fileupload('option', {
            url: '//jquery-file-upload.appspot.com/',
            // Enable image resizing, except for Android and Opera,
            // which actually support image resizing, but fail to
            // send Blob objects via XHR requests:
            disableImageResize: /Android(?!.*Chrome)|Opera/
                .test(window.navigator.userAgent),
        acceptFileTypes: /(\.|\/)(xlsx|xls|csv)$/i,
        maxFileSize: 5000000
        });
        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                url: '//jquery-file-upload.appspot.com/',
                type: 'HEAD'
            }).fail(function () {
                $('<div class="alert alert-danger"/>')
                    .text('Upload server currently unavailable - ' +
                            new Date())
                    .prependTo('#fileupload');
            });
        }
    } else {
        // Load existing files:
        $('#fileupload').addClass('fileupload-processing');
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: $('#fileupload').fileupload('option', 'url'),
            dataType: 'json',
            context: $('#fileupload')[0]
        }).always(function () {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
        });
    }

});
