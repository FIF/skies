<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]--><head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <!-- blueimp Gallery styles -->
        <link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
        <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
        <link rel="stylesheet" href="css/jquery.fileupload.css">
        <link rel="stylesheet" href="css/jquery.fileupload-ui.css">
        <link rel="shortcut icon" href="img/icon.jpg">
        <!-- CSS adjustments for browsers with JavaScript disabled -->
        <noscript><link rel="stylesheet" href="css/jquery.fileupload-noscript.css"></noscript>
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>         
    </head>
    <body>

    
        <div class="content-main">
                <h3 id="title"><i class="fa fa- fa-file"></i> Normal Sheet</h3><div id="test-1.csv"></div>
                <div class="horizontalLine"></div>
                <form id="sheet1">
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
                </form>
                <form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
                    Upload Files:<input type="hidden" name="idFile" value="5">
                    <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
                    <div class="row fileupload-buttonbar">
                        <div class="col-lg-7">
                            <span class="btn btn-success fileinput-button">
                                <i class="glyphicon glyphicon-plus"></i>
                                <span>Add files...</span>
                                <input type="file" name="files[]" multiple>
                            </span>
                            <button type="submit" class="btn btn-primary start">
                                <i class="glyphicon glyphicon-upload"></i>
                                <span>Start upload</span>
                            </button>
                            <button type="reset" class="btn btn-warning cancel">
                                <i class="glyphicon glyphicon-ban-circle"></i>
                                <span>Cancel upload</span>
                            </button>
                            <button type="button" class="btn btn-danger delete">
                                <i class="glyphicon glyphicon-trash"></i>
                                <span>Delete</span>
                            </button>
                            <input type="checkbox" class="toggle">
                            <!-- The global file processing state -->
                            <span class="fileupload-process"></span>
                        </div>
                        <!-- The global progress state -->
                        <div class="col-lg-5 fileupload-progress fade">
                            <!-- The global progress bar -->
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                            </div>
                            <!-- The extended global progress state -->
                            <div class="progress-extended">&nbsp;</div>
                        </div>
                    </div>
                    <!-- The table listing the files available for upload/download -->
                    <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                </form>
                
        </div>
        
        <!-- The template to display files available for upload -->
        <script id="template-upload" type="text/x-tmpl">
        
        {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-upload fade">
               
                <td>
                    <p class="name">{%=file.name%}</p>
                    <strong class="error text-danger"></strong>
                </td>
                <td>
                    <p class="size">Processing...</p>
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
                </td>
                <td>
                    {% if (!i && !o.options.autoUpload) { %}
                        <button class="btn btn-primary start" disabled>
                            <i class="glyphicon glyphicon-upload"></i>
                            <span>Start</span>
                        </button>
                    {% } %}
                    {% if (!i) { %}
                        <button class="btn btn-warning cancel">
                            <i class="glyphicon glyphicon-ban-circle"></i>
                            <span>Cancel</span>
                        </button>
                    {% } %}
                </td>
            </tr>
        {% } %}
        </script>
        <!-- The template to display files available for download -->
        <script id="template-download" type="text/x-tmpl">
        {% var n = 0; %}
        {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-download fade">
                <td>
                    <p class="name">
                        {% if (file.url) { %}
                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                        {% } else { %}
                            <span>{%=file.name%}</span>
                        {% } %}
                    </p>
                    {% if (file.error) { %}
                        <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                    {% } %}
                </td>
                <td>
                    <span class="size">{%=o.formatFileSize(file.size)%}</span>
                </td>
                <td id="dlp{%=i %}">
                    <img src="img/ajax-loader.gif" id="ajaxLoader{%=file.size %}">
                    <a href="#" id="dx{%=file.size %}" download="#"><input type="button" class="btn btn-primary" id="dowl{%=file.size %}" value="Download .xlsx" disabled></a>
                    <a href="#" id="dc{%=file.size %}" download="#"><input type="button" class="btn btn-warning" id="dowlc{%=file.size %}" value="Download .csv"  disabled></a>{% if (file.deleteUrl) { %}
                        <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                            <i class="glyphicon glyphicon-trash"></i>
                            <span>Delete</span>
                        </button>
                        <input type="checkbox" name="delete" value="1" class="toggle">
                    {% } else { %}
                        <button class="btn btn-warning cancel">
                            <i class="glyphicon glyphicon-ban-circle"></i>
                            <span>Cancel</span>
                        </button>
                    {% } %}
                </td>
            </tr>
        {% } %}
        </script>
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/vendor/jquery.ui.widget.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/main.js"></script>
        <script src="js/bootstrap.js"></script>
        <script type="text/javascript">
            window.alert = function(){};
            var defaultCSS = document.getElementById('bootstrap-css');
            function changeCSS(css){
                if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
                else $('head > link').filter(':first').replaceWith(defaultCSS); 
            }
            $( document ).ready(function() {
              var iframe_height = parseInt($('html').height()); 
              window.parent.postMessage( iframe_height, 'http://bootsnipp.com');
            });
        </script>
        <script src="js/jquery-ui.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>

       
    </body>
</html>
