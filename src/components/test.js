/*
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

function isPalindrome(word)
{
  // Please write your code here.
  let isChecked = false;
  let reversedWord = '';
  for (let i=word.length - 1; i > 0;i--) {
    reversedWord+=word.substr(i,1);
  }
  if (word==reversedWord) {
    isChecked = true;
  }
  
  return isChecked;
}
var word = readline()
print(isPalindrome(word))
*/

const dice = {
    sides: 6,
    roll() {
        return Math.floor(this.sides * Math.random()) + 1;
    }
}
console.log('Before the roll');

const roll = new Promise( (resolve,reject) => {
    const n = dice.roll();
    if(n > 1){
        setTimeout(()=>{resolve(n)},n*200);
    } else {
        setTimeout(()=>reject(n),n*200);
    }
});
roll
    .then(result => console.log(`I rolled a ${result}`) )
    .catch(result => console.log(`Drat! ... I rolled a ${result}`) );
console.log('After the roll');