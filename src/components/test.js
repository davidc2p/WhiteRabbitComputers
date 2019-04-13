let a = new Date().getTime();
console.log(parseInt(a, 10));

console.log(new Date(parseInt(a, 10)));

console.log(new Date(-1500000000 * 1000));

let myModule = (function() {
    'use strict';

    let property1 = 'aaaa';

    function get() {
        return property1;
    }

    function set(value) {
        property1 = value;
    }

    return {
        getProp: get,
        setProp: set,
        publicMethod: function() {

            console.log('Hello World! ' + get());
        }
    };
}());
myModule.publicMethod();
myModule.setProp('David');
myModule.publicMethod();