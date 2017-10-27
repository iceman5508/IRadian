/**
 * Created by Isaac Parker on 10/24/2017.
 * iVariable class is to handle simple variable functions
 */
const iVariable = new function () {

    /**
     * Return the type of variable
     * @param variable
     * @returns {string}
     */
    this.varType = function (variable) {
        return typeof variable;
    }

    /**
     * Check if a variable is defined or not.
     * @param variable
     * @returns {boolean}
     */
    this.isDefined = function (variable) {
        if(this.varType(variable)=='undefined'){
            return false;
        }
        return true;
    }

    /**
     * Check if a string is empty or not
     * @param variable
     * @returns {boolean}
     */
    this.isStringEmpty = function (variable) {
        if(variable == '' || variable == ' ' || variable.trim().length < 1){
            return true;
        }
        return false;
    }
}


