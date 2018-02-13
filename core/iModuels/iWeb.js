/**
 * IWeb.js the the js version of
 * the iWeb class from the IEngine package.
 */

const iWeb = new function () {
    /**
     * Return the current page being viewed
     * @returns {*}
     */
    this.currentPage = function () {
        var path =  window.location.pathname;
        return path.split("/").pop();
    }

    /**
     * Return the current url
     */
    this.url = function () {
        return window.location.href;
    }

    /**
     * Return a specific param from the url
     * @param name - The param name
     * @returns {string}
     */
    this.param = function(name) {
        var url = this.url();
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

    /**
     * Return all hash in the url
     * @returns {string}
     */
    this.hash = function () {
        return location.hash;
    }

    /**
     * Return the current Host
     * @returns {string}
     */
    this.currentHost= function () {
        return window.location.hostname;
    }

    /**
     * Get the current project folder
     * @returns {*}
     */
    this.projectFolder = function () {
        var pathArray = location.pathname.split('/');
        var appPath = "";
        for(var i=1; i<pathArray.length-1; i++) {
            appPath += pathArray[i] + "/";
        }
        return appPath;
    }

    /**
     * Return the url
     * @returns {string}
     */
    this.previousPage = function () {
        return document.referrer
    }



}
