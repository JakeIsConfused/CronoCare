window.addEventListener('load',dispatchEvent);

let infoNumber;

function dispatchEvent() {
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
//Parkeer pagina vullen
    let parkImg = document.getElementById('parkImage');
    parkImg.src = data.imagePark;

    let parkField = document.getElementById('park1');
    parkField.textContent = data.parkInfo;

}

function getBooksErrorHandler(error) {
    console.error(error);
}