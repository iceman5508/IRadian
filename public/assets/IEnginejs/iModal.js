/**
 * Created by iceman5508 on 11/5/2017.
 */
var iModal = new function () {

    this.closeView =  function(viewName) {
        const modal = document.getElementById(viewName);
        modal.style.display = 'none';

    }

    this.openView = function (viewName) {
        const modal = document.getElementById(viewName);
        modal.style.display = 'block';
    }
    
};