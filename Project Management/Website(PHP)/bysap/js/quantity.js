const minus = document.querySelector('.quantity-sub');
const plus = document.querySelector('.quantity-add');

const quantity = document.querySelector('.quantity');
const count = document.querySelector('.quantity_count');

var max;

if(count.value>20){
    max = 20;
    
}
else{
    max = count.value;
}
console.log(max);
var number = quantity.value;


minus.addEventListener('click', function(){
    
    if(number > 1)
    {   
        
    number--;
    quantity.value = number;
    }


})

plus.addEventListener('click', function(){
    
    if(number < max)
    {
    number++;
    quantity.value = number;
  
    }

})