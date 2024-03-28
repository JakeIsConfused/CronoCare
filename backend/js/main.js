window.addEventListener('load',dispatchEvent);

const apiUrl = "http://localhost/CronoCare/webservice/index.php"
let selectElement;
let selectedOption;
let infoOpen = false;
let infoClose = true;

function dispatchEvent() {
    selectElement = document.getElementById("mySelect");
    if (selectElement) {
        infoOpen = true;
        selectElement.addEventListener("change", selectOptionHandler);
    }
    if (infoOpen) {
        selectOptionHandler()
    }

}

function selectOptionHandler(e){
    if (selectElement.selectedIndex === -1) {
        // Geen optie geselecteerd, voer hier geen actie uit
        return;
    }
    selectedOption = selectElement.options[selectElement.selectedIndex];
    ajaxRequest(`backend/php/webservice/index.php?id=${selectedOption.value}`, getInfoSuccessHandler);
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