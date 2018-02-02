/**
 * Created by iceman5508 on 1/28/2018.
 */
var iRedirect = new function () {

    /**
     * Redirect (http) to another url
     * @param url
     */
    this.httpRedirect = function (url) {
        window.location.replace(url);
    }

    /**
     * Redirect (href) to another url
     * @param url
     */
    this.hrefRedirect = function (url) {
        window.location.href = url;
    }

    /**
     * Redirect (http) after a specific interval
     * @param url
     * @param time
     */
    this.timedHttpRedirect = function (url,time) {
        setTimeout(function () {
            window.location.replace(url);
        }, time);
    }

    /**
     * Redirect (href) after a specific interval
     * @param url
     * @param time
     */
    this.timedHrefRedirect = function (url,time) {
        setTimeout(function () {
            window.location.href = url;
        }, time);
    }
}