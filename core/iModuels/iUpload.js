/**
 * Created by Isaac Parker on 3/28/2018.
 * iUpload file to ajax file upload without jquery
 */
function iUpload(id) {

    this.file = document.getElementById(id).files[0];
   


    /**
     * Post a file for upload
     * @param url - The url the data is going to pass to
     * @param sanitize - The function that cleans the data and and does security checks
     * before submitting to the server.
     * @param callback -The call back function, after the file submits.
     */
    this.submitFile = function(url,sanitize, callback){
        var data = new FormData();
        data.append('iUploadFile', this.file);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function(){
            if(request.readyState == 4){
                try {
                    callback(request.responseText);
                } catch (e){
                    var resp = {
                        status: 'error',
                        data: 'Unknown error occurred: [' + request.responseText + ']'
                    };
                }
                //console.log(resp.status + ': ' + resp.data);
            }
        };

        if(sanitize(this.file)==true) {
            request.open('POST', url, true);
            request.send(data);
        }

    }

}