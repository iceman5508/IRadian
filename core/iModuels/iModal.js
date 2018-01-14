/**
 * Created by iceman5508 on 11/5/2017.
 */
var iModal = new function () {

    this.close =  function(modalId) {
        const modal = document.getElementById(modalId);
        modal.style.display = 'none';

    }

    this.show = function (modalId) {
        const modal = document.getElementById(modalId);
        modal.style.display = 'block';
    }

};