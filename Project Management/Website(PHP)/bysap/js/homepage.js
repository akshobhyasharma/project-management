//For Shop Now button functionality 
const btns = document.querySelectorAll('.shop');
btns.forEach(btn => {
    btn.addEventListener('click',function(){
        const id = btn.id;
        console.log(id);
        window.location = 'shop.php?category='.concat(id);
    })
})