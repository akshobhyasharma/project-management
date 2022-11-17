var image_1 = document.querySelector('.disp-img-1');
var image_2 = document.querySelector('.disp-img-2');
var image_3 = document.querySelector('.disp-img-3');
var main_image = document.querySelector('.disp-main');

main_image.src = image_1.src;
image_1.classList.remove("dimmed");

image_1.addEventListener('click', function(e) {
    imgclick(e);
})
image_2.addEventListener('click', function(e) {
    imgclick(e);
})
image_3.addEventListener('click', function(e) {
    imgclick(e);
})


function imgclick(e) {
    clicked_img_name = e.target.classList[6];
    clicked_img = document.querySelector(`.${clicked_img_name}`);
    if (clicked_img_name == "disp-img-1") {
        image_1.classList.remove("dimmed");
        image_2.classList.add("dimmed");
        image_3.classList.add("dimmed");
        main_image.src = image_1.src;
    } else if (clicked_img_name == "disp-img-2") {
        image_1.classList.add("dimmed");
        image_2.classList.remove("dimmed");
        image_3.classList.add("dimmed");
        main_image.src = image_2.src;
    } else {
        image_1.classList.add("dimmed");
        image_2.classList.add("dimmed");
        image_3.classList.remove("dimmed");
        main_image.src = image_3.src;
    }
}

setInterval(imgrotate, 4000);
var sliderno = 1;

function imgrotate() {
    if (sliderno == 1) {
        image_1.classList.remove("dimmed");
        image_2.classList.add("dimmed");
        image_3.classList.add("dimmed");
        main_image.src = image_1.src;
        sliderno++;
    } else if (sliderno == 2) {
        image_1.classList.add("dimmed");
        image_2.classList.remove("dimmed");
        image_3.classList.add("dimmed");
        main_image.src = image_2.src;
        sliderno++;
    } else {
        image_1.classList.add("dimmed");
        image_2.classList.add("dimmed");
        image_3.classList.remove("dimmed");
        main_image.src = image_3.src;
        sliderno = 1;
    }
}