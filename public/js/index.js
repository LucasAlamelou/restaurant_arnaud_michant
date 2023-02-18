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
    inputDate.addEventListener('input', (event) => {
        onDateReservationChange(event);
    });
}

/**
 *
 * @param {Event} event
 */
async function onDateReservationChange(event) {
    const date = event.target.value;
    const jour = getDayOfDate(new Date(date));
    const reservation = await getReservationJour(date);
    const hoursOpening = await getHoursOfDay(jour);
    console.log(reservation);
    console.log(hoursOpening);
    const htmlContentRadio = getDispoRevervation(hoursOpening.hours);
    const nbPlaceVacant = getVacantPlace(reservation, hoursOpening.nbPlace);
    document.getElementById('slot_for_day').innerHTML = htmlContentRadio;
    const closeToday = '<p style="bold"> Il semblerait que le restaurant soit fermé ce jour ! </p>';
    document.getElementById('nb-place-vacant').innerHTML =
        nbPlaceVacant === 0
            ? closeToday
            : `<p style="bolder" > Il ne reste que ${nbPlaceVacant} couvert pour ce jour !</p>`;
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
    let htmlContent = '<div>';
    hoursDay.forEach((day) => {
        if (!day.startHour) {
            console.error('Erreur horaires invalide');
            return null;
        }
        const openingArray = day.startHour.split('h');
        const closeArray = day.endHour.split('h');
        const hourStart = Number(openingArray[0]);
        const hourEnd = Number(closeArray[0]);
        const hourOfOpen = hourEnd - hourStart;

        for (let i = 0; i < hourOfOpen; i++) {
            // 5 créneaux par heure
            const slot = 4;
            console.log('slot : ' + slot);
            let hour = hourStart + i;
            let minutes = 00;
            for (let r = 0; r < slot; r++) {
                if (minutes === 60) {
                    minutes = 00;
                }
                htmlContent += `
                    <input type="radio" id="hours-${day.day}-${r}" name="reservation[hour]" value="${hour}h${minutes}"
                            checked>
                    <label for="hours-${day.day}-${r}">${hour}h${minutes}</label>
                
                `;
                minutes = minutes + 15;
            }
        }
    });
    htmlContent += '</div>';
    return htmlContent;
}

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
