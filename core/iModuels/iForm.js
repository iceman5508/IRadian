/**
 * iForm.js the the js version of
 * the iForm class from the IEngine package.
 * THis class handles form processing
 */


function iForm(formClass){

    /**
     * The form class to search for
     */
    this.tag = formClass;

    this.data = {};


    /**
     * Get the data from a form
     */
    this.getFormData = function () {
        var elements = document.getElementsByClassName(this.tag);
        var obj ={};
        for(var i = 0 ; i < elements.length ; i++){
            var item = elements.item(i);
            obj[item.name] = item.value;
        }

        this.data = obj;


    };


    /**
     * Get a specific data value
     * @param name - the name of the form field whose value will be returned
     * @returns {*}
     */
    this.getData = function (name) {
        return this.data[name];
    };


    /**
     *Stringify the form data
     */
    this.toString = function () {
        return JSON.stringify(this.data);
    };

    /**
     * Check if a particular field is empty
     * @param name - The field name
     * @returns {boolean}
     */
    this.isFieldEmpty = function (name) {
        if(typeof this.data[name] === 'undefined'){
            return true;
        }
        if(!this.data[name] ){
            return true;
        }
        return false;
    };

    /**
     * Return the number of elements in an object
     * @param name - The field name
     */
    this.getDataCount = function (name) {
        return this.data[name].length;
    };


    /**
     * Compare two field data
     * @param field1 - first field
     * @param field2 - second field
     * @returns {boolean}
     */
    this.compareFields = function (field1, field2) {
        var val1 = this.data[field1].trim();
        var val2 = this.data[field2].trim();

        return (val1.toLowerCase().localeCompare(val2.toLowerCase()) == 0? true : false);
    };


    /**
     * Submit a form to a given field
     * @param requestType
     * @param url
     * @param callback
     */
    this.submit = function (requestType, url, callback) {
        var xmlhttp = new XMLHttpRequest();


        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                callback(xmlhttp.responseText);

            }
        }

        var queryString = this.serialize();


        if(requestType == 'POST'){
            xmlhttp.open(requestType, url, true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(queryString);
        }else{
            xmlhttp.open(requestType, url+queryString, true);
            xmlhttp.send();
        }


    };

    /**
     * Upload file through submission of the entire form the
     * upload file is apart of. In order to use this method, the
     * param passed into the iForm constructor must match the id of the form
     * @param url - The url the data is going to pass to
     * @param sanitize - The function that cleans the data and and does security checks
     * before submitting to the server.
     * @param callback -The call back function, after the form submits.
     */
    this.submitUpload = function(url,sanitize, callback){
        var form = document.getElementById(this.tag);
        var formData = new FormData(form);

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                callback(xmlhttp.responseText);

            }
        }

        if(sanitize(formData)==true) {
            xmlhttp.open('POST', url, true);
            xmlhttp.send(formData);
        }

    }

    /**
     * Function very similar to submitUpload, except this function only submits the file
     * and not the entire form.
     * @param url - The url the data is going to pass to
     * @param sanitize - The function that cleans the data and and does security checks
     * before submitting to the server.
     * @param callback -The call back function, after the file submits.
     */
    this.submitFile = function(url,sanitize, callback){

        var fileInput = document.getElementById(this.tag);
        var file = fileInput.files[0];
        var formData = new FormData();
        formData.append('file', file);

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                callback(xmlhttp.responseText);

            }
        }

        if(sanitize(formData)==true) {
            xmlhttp.open('POST', url, true);
            xmlhttp.send(formData);
        }

    }



    this.serialize = function() {
        var str = [];
        var value = this.data;
        for(var p in value)
            if (value.hasOwnProperty(p)) {
                str.push(encodeURIComponent(p) + "=" + encodeURIComponent(value[p]));
            }
        return str.join("&");
    };





}

