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
    this.get = function (requestUrl, params = {}) {
        var response = {
            data: '',
            code: 400
        };
        $.ajax({
            type: "GET",
            url: requestUrl,
            data: params,
            async: false,
            success: function (text) {
                response.data = text;
                response.code = 200;
            }
        });
        return response;
    }

    /**
     * Handles post requests
     * @param requestUrl
     * @param params
     * @returns {{data: boolean, code: number}}
     */
    this.post = function (requestUrl, params = {}) {
        var response = {
            data: false,
            code: 400
        };
        $.ajax({
            type: "POST",
            url: requestUrl,
            data: params,
            async: false,
            success: function (text) {
                response.data = text;
                response.code = 200;
            }
        });
        return response;
    }
}