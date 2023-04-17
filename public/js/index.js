/**
 * Nombre de place disponible dans le restaurant
 */
let nbPlaceVacant = 0;
let errorInForm = false;
let elementPError = document.createElement("p");
elementPError.style.color = 'red';
//elementPError.style.fontWeight = 'bolder';

async function requete(url, content) {
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8',
        },
        body: JSON.stringify(content),
    };
    const response = await fetch(url, options);
    if (!response.ok) {
        return null;
    }
    const result = await response.json();
    return result;
}

const inputDate = document.getElementById('reservation_date');
if (inputDate) {
    document.getElementById('reservation_hour').remove();
    inputDate.addEventListener('input', (event) => {
        onDateReservationChange(event);
    });
}

const inputNbCouverts = document.getElementById('reservation_nbCouvert');
if (inputNbCouverts) {
    inputNbCouverts.addEventListener('input', (event) => {
        verifyInputNbCouvert(event.target.value);
        onChangeNbCouverts(event);
    });
}

const inputNameReservation = document.getElementById('reservation_nameOfClient');
if(inputNameReservation) {
    inputNameReservation.addEventListener('input', (event) => {
        verifyInputNameReservation(event.target.value);
    })
}

function verifyInputNbCouvert(value) {
    const nbCouvertInput = parseInt(value);
    if(nbCouvertInput === 0 || nbCouvertInput < 0 || nbCouvertInput > 8 || isNaN(nbCouvertInput)){
        changeColorInputNbCouvert(true);
        //blockedSubmitForm();
    }else{
        changeColorInputNbCouvert(false);
        //valideSubmitForm();
    }
}

function verifyInputNameReservation(value){
    if(value === '' || value.length > 10 || value.length < 2 || typeof value !== 'string') {
        errorInForm = true;
        changeColorInputName(true);
        //blockedSubmitForm();
    } else {
        errorInForm = false;
        changeColorInputName(false);
        //valideSubmitForm();
    }
}

function changeColorInputName(error){
    elementPError.innerHTML = '';
    if(error){
        inputNameReservation.style.border = '2px solid red';
        elementPError.innerHTML = 'Veuillez saisir un nom valide !';
        inputNameReservation.after(elementPError);
    } else {
        inputNameReservation.style.border = '2px solid green';
    }
}

function changeColorInputNbCouvert(error){
    elementPError.innerHTML = '';
    if(error){
        inputNbCouverts.style.border = '2px solid red';
        elementPError.innerHTML = 'Veuillez saisir un nombre de couvert valide !';
        inputNbCouverts.after(elementPError);

    } else {
        inputNbCouverts.style.border = '2px solid green';
    }
}

function onChangeNbCouverts(event) {
    const nbCouvert = event.target.value;
    if (nbCouvert > nbPlaceVacant || nbCouvert < 1) {
        let messageError = '';
        if (nbCouvert > nbPlaceVacant) {
            messageError =
                '<p class="bold">Il semblerait que vous ne pouvez pas réserver pour autant de couvert !</p>';
        } else if (nbCouvert < 1) {
            messageError =
                '<p class="bold">Veuillez renseigné un nombre de couvert supérieur à 0 !</p>';
        }
        document.getElementById('message-couvert').innerHTML = messageError;
    } else {
        document.getElementById('message-couvert').innerHTML = '';
    }
}

/**
 * Ecoute l'event sur la sélection de l'input date
 * @param {Event} event
 */
async function onDateReservationChange(event) {
    document.getElementById('slot_for_day').innerHTML = '';
    const date = event.target.value;
    const dateOfDay = new Date();
    const dateUser = new Date(date);
    dateUser.setHours(dateOfDay.getHours());
    dateUser.setMinutes(dateOfDay.getMinutes());
    if (dateUser.getTime() >= dateOfDay.getTime()) {
        const jour = getDayOfDate(new Date(date));
        const reservation = await getReservationJour(date);
        const hoursOpening = await getHoursOfDay(jour);
        const htmlContentRadio = getDispoRevervation(hoursOpening.hours);
        nbPlaceVacant = getVacantPlace(reservation, hoursOpening.nbPlace);
        document.getElementById('slot_for_day').innerHTML = htmlContentRadio;
        if(nbPlaceVacant > 0) {
            document.getElementById('reservation_date').style.border = '2px solid green';
        } else {
            document.getElementById('reservation_date').style.border = '2px solid red';
        }
        const closeToday =
            '<p style="bold"> Il semblerait que le restaurant soit fermé ce jour ! </p>';
        document.getElementById('nb-place-vacant').innerHTML =
            nbPlaceVacant === 0 || isClosed(hoursOpening.hours)
                ? closeToday
                : `<p style="bolder" > Il ne reste que ${nbPlaceVacant} couvert pour ce jour !</p>`;
    } else {
        const dateOfDay = new Date(Date.now());
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById(
            'nb-place-vacant'
        ).innerHTML = `<p style="bolder" > Vous ne pouvez pas réservé pour une date inférieur à celle du jour : ${dateOfDay.toLocaleString(
            'fr-FR',
            options
        )}!</p>`;
        document.getElementById('reservation_date').style.border = '2px solid red';
    }
}

/**
 * Retourne le jour de la date passé en parametre
 * @param {Date} date
 * @returns {String} jour en lettre
 */
function getDayOfDate(date) {
    const JOUR_STRING = {
        0: 'Dimanche',
        1: 'Lundi',
        2: 'Mardi',
        3: 'Mercredi',
        4: 'Jeudi',
        5: 'Vendredi',
        6: 'Samedi',
    };
    const dateNumber = date.getDay();
    return JOUR_STRING[dateNumber];
}

/**
 * Requête pour obtenir les horaires d'ouverture du jour en parametre
 * @param {String} jour
 * @returns array avec les horaires d'ouverture
 */
async function getHoursOfDay(jourSemaine) {
    const result = await requete('/getHours', { day: jourSemaine });
    return result;
}

/**
 * Rêquete pour obtenir les réservations du jour
 * @param {Date} date
 * @returns {Array} listes des réservations déjà réservé
 */
async function getReservationJour(date) {
    const result = await requete('/getReservationJour', { date: date });
    return JSON.parse(result.reservations);
}

/**
 * Fait le html en type radio pour la listes des créneaux du jour
 * @param {Array} hoursDay
 * @returns {string} retourne la liste des créneaux disponible
 */
function getDispoRevervation(hoursDay) {
    let htmlContent = '<div class="col-12">';
    hoursDay.forEach((day) => {
        if (!day.startHour) {
            console.error('Erreur horaires invalide');
            return null;
        }
        const openingArray = day.startHour.split('h');
        const closeArray = day.endHour.split('h');
        const hourStart = Number(openingArray[0]);
        const hourEnd = Number(closeArray[0]);
        const hourOfOpen = hourEnd - hourStart - 1;

        for (let i = 0; i < hourOfOpen; i++) {
            // 5 créneaux par heure
            const slot = 4;
            let hour = hourStart + i;
            let minutes = 00;
            htmlContent += '<div class="col-2">';
            for (let r = 0; r < slot; r++) {
                if (minutes === 60) {
                    minutes = 00;
                }
                htmlContent += `
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="hours-${
                        day.day
                    }-${r}" name="reservation[hour]" value="${hour}h${
                    minutes === 0 ? '00' : minutes
                }"
                            checked>
                    <label class="form-check-label" for="hours-${day.day}-${r}">${hour}h${
                    minutes === 0 ? '00' : minutes
                }</label>
                </div>
                `;
                minutes = minutes + 15;
            }
            htmlContent += '</div>';
        }
    });
    htmlContent += '</div>';
    return htmlContent;
}

/**
 * Calcule le nombre de place disponible
 * @param {Array} reservations
 * @param {Number} nbPlacesMax
 * @returns {Number} nombre de place disponible
 */
function getVacantPlace(reservations, nbPlacesMax) {
    let nbPlaceOccuped = 0;
    if (nbPlacesMax === undefined) {
        return 0;
    }
    reservations.forEach((resa) => {
        nbPlaceOccuped += resa.nbCouvert;
    });
    return nbPlacesMax - nbPlaceOccuped;
}

/**
 * Détermine si le restaurant est ouvert ce jour
 * @param {Array} hoursDay
 * @returns {Boolean} retourne true si fermé ce jour
 */
function isClosed(hoursDay) {
    let close = true;
    hoursDay.forEach((day) => {
        if (day.startHour && day.endHour) {
            close = false;
        }
    });
    return close;
}

function blockedSubmitForm(){
    const listElements = document.getElementsByName('reservation');
    if(listElements.length > 0){
        const form = listElements[0];
        document.getElementById('form_reservation_submit').style.display = 'none';
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            document.getElementById(
                'nb-place-vacant'
            ).innerHTML = 'Vous ne pouvez pas envoyer un formulaire non valide !';
        });
    }
}

function valideSubmitForm(){
    if(!errorInForm){
        document.getElementById('form_reservation_submit').style.display = 'block';
    }
}