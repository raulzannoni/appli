//JS file pour gerer les modals

//on va à selectioner les elements
var modals = document.querySelectorAll(".modal")
var btns = document.querySelectorAll(".modal_btn")
var spans = document.querySelectorAll(".close")

//affiche le message "btns" au console
console.log(btns)

//ajoute pour chaque produit une fenetre pour afficher l'image
btns.forEach(function(btn, index) {
    btn.addEventListener("click", function() {
        console.log("test")
        modals[index].style.display = "block"
    })
})

//ajoute pour chaque espace le bouton pour fermer la fenetre
spans.forEach(function(span, index) {
    span.addEventListener("click", function() {

        modals[index].style.display = "none"
    })
})