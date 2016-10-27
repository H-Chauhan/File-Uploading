$(document).ready(function() {
    $(':file').change(function() {
        var file = this.files[0];
        name = file.name;
        size = file.size;
        type = file.type;

        if(file.name.length < 1) {
             $("#submitbtn").prop("disabled",true);
        }
        else if(file.size > 100000) {
             $("#submitbtn").prop("disabled",true);
            alert("The file is too big");
        }
        else if(file.type != 'application/vnd.ms-excel' ) {
             $("#submitbtn").prop("disabled",true);
            alert("The file does not match csv");
        }
        else { 
            $("#submitbtn").prop("disabled",false);
            $(':submit').click(function(){
                var formData = new FormData($('#myForm')[0]);
                $.ajax({
                    url: 'upload.php',  //server script to process data
                    type: 'POST',
                    xhr: function() {  // custom xhr
                        myXhr = $.ajaxSettings.xhr();
                        if(myXhr.upload){ // if upload property exists
                            myXhr.upload.addEventListener('progress', progressHandlingFunction, false); // progressbar
                        }
                        return myXhr;
                    },
                    // Ajax events
                    success: completeHandler = function(data) {
                    },
                    error: errorHandler = function() {
                        console.log(error);
                        alert("Something went wrong!");
                    },
                    // Form data
                    data: formData,
                    // Options to tell jQuery not to process data or worry about the content-type
                    cache: false,
                    contentType: false,
                    processData: false
                }, 'json');
            });
        }
    });
});