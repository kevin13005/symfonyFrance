//----------------------------javascript sur la carte------------------------------------//

//selection de la map globale
var map = document.querySelector('#map');
//selection des liens de la map dans le div map__image
var paths = map.querySelectorAll('#map__image a');
//selection des liens de la map dans le div map__list
var links = map.querySelectorAll('#map__liste a');

//on veut pouvoir utiliser foreach sur un noeud , donc on dit a js , permet le , avec cette fonction
if (NodeList.prototype.forEach === undefined){
    NodeList.prototype.forEach = function (callback){
        [].forEach.call(this, callback)
    }
}

//fonction faite car on utilise plusieurs fois les choses (dans les 2 fonctions apres celle ci)
var activeArea = function(id){
     //on permet dès le survol de la region terminée de retirer la classe active et que ca soit plus bleu
    map.querySelectorAll('.is-active').forEach( function (item){
        item.classList.remove('is-active');
    });
  
    if( id !== undefined){
          //on selectionne tous les elements avec l'id , ce qui nous donne un noeud de plusieurs elements
        var elements = document.querySelectorAll("#" + id);
        //chaque element se voit attribuer la classe active, celui de la carte et aussi de la liste
        var elem1 = elements[0].classList.add('is-active');
        var elem2 = elements[1].classList.add('is-active');
    }
}

//on boucle pour repandre l'action sur tous les liens de la map et aussi de la liste en simultanée
paths.forEach(function (path) {
    path.addEventListener('mouseenter', function (e) {
        //on recupere l'id sur lequel on passe avec la souris
        var id = this.id;
        activeArea(id);
       
    })
});
//on boucle pour repandre l'action sur tous les liens de la liste et egalement de la carte en simultanée
links.forEach(function (link) {
    link.addEventListener('mouseenter', function () {
        var id = this.id;
        activeArea(id);
    })
});
//des que je suis en dehors de la carte je enleve le bleu 
map.addEventListener('mouseover', function (){
    activeArea();
});