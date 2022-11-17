var customertoggler = document.querySelector(".toggle-customer");
var tradertoggler = document.querySelector(".toggle-trader");

customertoggler.addEventListener('click', function (e) {
    customeracc();
})

tradertoggler.addEventListener('click', function (e) {
    traderacc();
})

var customer = document.querySelector("#customer");
var trader = document.querySelector("#trader");

function customeracc() {
    customertoggler.classList.add("selected");
    tradertoggler.classList.remove("selected");
    customer.style.left = "18%";
    trader.style.left = "-1000px";
}


function traderacc() {
    customertoggler.classList.remove("selected");
    tradertoggler.classList.add("selected");
    customer.style.left = "-1000px";
    trader.style.left = "18%";
}