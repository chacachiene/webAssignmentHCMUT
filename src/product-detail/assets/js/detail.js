$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    },
    nav: true,
    // navText: ["<img src='myprevimage.png'>","<img src='mynextimage.png'>"]
  })

// Show Img
const showImgElement = document.querySelector('.img-show');
const smallImgElements = document.querySelectorAll('.img-select');

for(const smallImgElement of smallImgElements) {
    // showImgElement.style.backgroundImage = `url('${smallImgElement.style.backgroundImage.slice(4, -1).replace(/"'/g, "")}')`
    smallImgElement.onclick = () => {
        showImgElement.style.backgroundImage = window.getComputedStyle(smallImgElement).backgroundImage;
    }
}

// description nav list 
const navItemElements = document.querySelectorAll('.nav-item')
const tabItemElements = document.querySelectorAll('.tab-pane')
let removeIndex = 0;
for (let i = 0; i < navItemElements.length; i++) {
    
    // if(tabItemElements[i].className.includes('active')) {
    //     removeIndex = i;
    // }
    navItemElements[i].onclick = () => {
        tabItemElements[removeIndex].classList.remove('active', 'show');
        navItemElements[removeIndex].querySelector('.nav-link').classList.remove('active')

        tabItemElements[i].classList.add('active', 'show')
        navItemElements[i].querySelector('.nav-link').classList.add('active')

        removeIndex = i
    }
}