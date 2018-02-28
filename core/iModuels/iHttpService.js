/**
 * Created by iceman5508 on 10/24/2017.
 */
const iHttpService = new function(){
    /**
     * Handles get requests
     * @param requestUrl
     * @param params
     * @returns {{data: string, code: number}}
     */
    this.get = function (requestUrl, params = {}, callback) {
        $.ajax({
            type: "GET",
            url: requestUrl,
            data: params,
            success: function(text) {
                callback({'data': text, 'success': true})
            },
            error: callback({'data' : '', 'success':false} )
        });

    }

    /**
     * Handles post requests
     * @param requestUrl
     * @param params
     * @returns {{data: boolean, code: number}}
     */
    this.post = function (requestUrl, params = {}, callback) {
        $.ajax({
            type: "POST",
            url: requestUrl,
            data: params,
            success: function(text) {
                callback({'data': text, 'success': true})
            },
            error: callback({'data' : '', 'success':false} )
        });
    }
}