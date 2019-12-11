// Nuages

// let move = 0;
// let move2 = 0;

// setInterval(function () {

//     let cloud = document.querySelectorAll('.cloud');
//     move += 10;
//     move2 -= 10;

//     for (let i = 0; i < cloud.length; i++) {


//         if (parseInt(window.getComputedStyle(cloud[i]).getPropertyValue("left")) <= 200) {
//             cloud[i].style.left = move + "px";
//         }

//         // if (parseInt(window.getComputedStyle(cloud[i]).getPropertyValue("left")) > 200) {
//         //     cloud[i].style.left = move2 + "px";
//         // }
//     }

// }, 100);


// Nom des fichiers sur le formulaire

let files = document.querySelector('#file').files;
let fichiers = document.querySelector('#fichiers');

function getFiles(evt) {
    let files = evt.target.files;
    let msg = files.length + " fichier(s) sélectionné(s): \n";

    for (let i = 0; i < files.length; i++) {
        msg += "- " + files[i].name + " (" + Math.round(files[i].size / 1024) + " Ko)\n";
    }

    fichiers.innerHTML = msg;

}

window.onload = function () {
    document.getElementById('file').addEventListener('change', getFiles, false);
}