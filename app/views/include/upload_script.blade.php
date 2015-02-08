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
        <!-- script src="js/bootstrap.js"></script -->
        <script src="js/main.js"></script>
        <script type="text/javascript" src="js/vendor/modernizr-2.6.2.min.js"></script>
        <script type="text/javascript">
            // window.alert = function(){};
            // var defaultCSS = document.getElementById('bootstrap-css');
            // function changeCSS(css){
            //     if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
            //     else $('head > link').filter(':first').replaceWith(defaultCSS); 
            // }
            // $( document ).ready(function() {
            //   var iframe_height = parseInt($('html').height()); 
            //   window.parent.postMessage( iframe_height, 'http://bootsnipp.com');
            // });
        </script>
        <script src="js/jquery-ui.js"></script>
        <!-- script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script-->
        <script src="js/plugins.js"></script>
