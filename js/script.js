const blurButton = document.getElementById("blurButton");

let armesFloutees = false;

blurButton.addEventListener("click", function () {

const images = document.querySelectorAll(
    ".weapon, .featured-tile, .item-thumb img, .item-card img"
);

    armesFloutees = !armesFloutees;

    images.forEach(image => {
        image.classList.toggle("weapon-blurred", armesFloutees);
    });

    blurButton.textContent = armesFloutees
        ? "Afficher les armes"
        : "Flouter les armes";

});