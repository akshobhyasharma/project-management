$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 40,
    nav: true,
    dots: false,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    responsive: {
        0: {
            items: 1
        },
        500: {
            items: 2
        },
        768: {
            items: 3
        },
        1000: {
            items: 4
        }
    }
})