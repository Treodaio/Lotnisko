const imageChange = [{
        img: "img/samolot_strona_glowna_1.jpg",
    }, {
        img: "img/strona_glowna_2.jpg",
    },
    {
        img: "img/strona_glowna_3.jpg",
    },
];

const time = 3000;
let active = 1;

const currentImage = document.querySelector('img.main');


const changeSlide = () => {

    currentImage.src = imageChange[active].img;
    active++;
    if (active == imageChange.length) active = 0;
}


setInterval(changeSlide, 5000);