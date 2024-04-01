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
    infoField1.textContent = data.textInfo1;
    let infoField2 = document.getElementById('info2');
    infoField2.textContent = data.textInfo2;
}

function getBooksErrorHandler(error) {
    console.error(error);
}