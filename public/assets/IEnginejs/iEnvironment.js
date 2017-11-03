/**
 * Created by iceman5508 on 10/25/2017.
 * Class to keep track of environment data
 */
const iEnviornment = new function () {
    /**
     * The width of the current browser screen
     * @returns {Number|number}
     */
    this.width = function () {
        return window.innerWidth || document.documentElement.clientWidth
            || document.getElementsByTagName('body')[0].clientWidth;
    }

    /**
     * The height of the current browser screen
     * @returns {Number|number}
     */
    this.height = function () {
        return window.innerHeight || document.documentElement.clientHeight
            || document.getElementsByTagName('body')[0].clientHeight
    }

}