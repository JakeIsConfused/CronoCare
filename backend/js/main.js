window.addEventListener('load',dispatchEvent);

const apiUrl = "http://localhost/CronoCare/webservice/index.php"
let selectElement;
let selectedOption;
let infoNumber;

function dispatchEvent() {
    selectElement = document.getElementById("mySelect");
    if (selectElement) {
        selectElement.addEventListener("change", selectOptionHandler);
    }
    loadInformation();
}

function selectOptionHandler(e){
    selectedOption = selectElement.options[selectElement.selectedIndex];
    localStorage.setItem('number', selectedOption.value);
    window.location.href = 'info.html';

}

function loadInformation(){
    infoNumber = localStorage.getItem('number');
    ajaxRequest(`backend/php/webservice/index.php?id=${infoNumber}`, getInfoSuccessHandler);
}

function ajaxRequest(url, successCallback) {
    fetch(url)
        .then((response) => {
            if (!response.ok) {
                throw new Error(response.statusText);
            }
            return response.json();
        })
        .then(successCallback)
        .catch(getBooksErrorHandler);
}

function getInfoSuccessHandler(data){
    let infoField1 = document.getElementById('info1');
    if (infoField1) {
        infoField1.textContent = data.textInfo1;
    }
    let infoField2 = document.getElementById('info2');
    if (infoField2) {
        infoField2.textContent = data.textInfo2;
    }
}

function changeSetting(id) {
    console.log("setting change", id);
//check of de localstorage is gevonden
    if (localStorage.getItem(id)){
//item gevonden
        if (localStorage.getItem(id) === "false"){
//item bestaat niet maak hem aan
            localStorage.setItem(id, "true")
//get target div
            const targetDiv = document.getElementById(id)
            console.log(targetDiv);
//pas de class aan van de div
            targetDiv.classList.add("favHero")
            targetDiv.classList.remove("hero")
        }else {
            localStorage.setItem(id, "false")
//get target div
            const targetDiv = document.getElementById(id)
//pas de class aan van de div
            targetDiv.classList.add("hero")
            targetDiv.classList.remove("favHero")
        }
    }else{
//item niet gevonden
        console.log("localstorage niet gevonden")
    }
}
function changeFont() {
    var selectedFontSize = document.getElementById("lettertype").value;
    document.body.style.fontSize = selectedFontSize + "px";
}

function getBooksErrorHandler(error) {
    console.error(error);
}