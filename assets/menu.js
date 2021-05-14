//----------------------------javascript sur le menu-------------------------------------//

//selection du hamburger
const hamburger = document.getElementById('hamburger');
//selection de la ul 
const navUl = document.getElementById('nav-ul');
//selection de la navbar complete
const navbar = document.getElementById('navbar');
//selection de l'icone
const icone = document.getElementById('la');
console.log(icone);

//au click, on alterne , si la ul a la classe show, on fixe la margin bottom de la navbar a 80px pour voir l'element dessous sinon on laisse a 0px,
// remplacement du hamburger par croix et inverse
hamburger.addEventListener('click', () => {
    navUl.classList.toggle('show');
    if(navUl.classList.value === 'nav-ul show'){
        navbar.style.marginBottom = '80px';
        //remplacer le hamburger par une croix fermante
        icone.classList.replace("fa-bars", "fa-times");
    }
    else{
        navbar.style.marginBottom = '0px';
        //quand on referme en cliquant sur la croix, on remet le hamburger
        icone.classList = 'fas fa-bars';
    }
    
});

const searchbutton = document.getElementById('searchbutton');
const searchbar = document.getElementById('searchbar');
const barentiere = document.querySelector('#navbar form');
const logoe = document.querySelector('.logo');
console.log(barentiere);


searchbutton.addEventListener('click', () => {
    barentiere.classList.toggle('show');
    searchbar.classList.toggle('show');
    if(searchbar.classList.value === 'searchbar show'){
        logoe.style.display = 'none';
        searchbutton.classList.replace("fa-search", "fa-times");
    }else{
        searchbutton.classList="fas fa-search";
        logoe.style.display = 'flex';
    
    }
});