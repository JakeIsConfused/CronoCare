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
    let viewImg = document.getElementById('viewImage');
    viewImg.src = data.imageView;

}

function getBooksErrorHandler(error) {
    console.error(error);
}