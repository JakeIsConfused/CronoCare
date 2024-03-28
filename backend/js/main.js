window.addEventListener('load',dispatchEvent);

const ApiUrl = "http://localhost/CronoCare/webservice/actions.php"
window.addEventListener('load', displayInfo);


const ApiUrl = "http://localhost/CronoCare/webservice/actions.php"



function displayInfo() {
    // Fetch-verzoek uitvoeren
    try {
        fetch(ApiUrl)
            .then(response => response.json())
            .then(data => {
                // Verwerk elke item in de ontvangen gegevens
                data.forEach(zorg => {
                    // Maak een nieuwe div aan voor elk item
                    const div = document.createElement("div")
                    div.id = zorg.id
                    //check of localstorage item heeft
                    if (localStorage.getItem(zorg.id) === null){
                        //item bestaat niet maak hem aan
                        localStorage.setItem(zorg.id, "false")

                    }else {
                        if (localStorage.getItem(zorg.id) === "true") {


                            //item is wel favourited
                            // Voeg de itemid, itemname, itemartist en itemimgsrc toe aan de div
                            div.classList.add("favInstelling");
                            div.classList.add("container");
                        }else {


                            //item is wel favourited
                            // Voeg de itemid, itemname, itemartist en itemimgsrc toe aan de div
                            div.classList.add("instelling");
                            div.classList.add("container");
                        }
                        div.innerHTML = ` 
                     <h1>${zorg.name}</h1>
                    <img src="${zorg.img}" alt="${zorg.name}">
                `
                        //              const heroGallery = document.getElementById("hero-gallery")
                        //            heroGallery.appendChild(div)

                    }});
            })
    }catch (error) {
        console.log("Fout bij het ophalen en weergeven van gegevens:",error)
    }
}
