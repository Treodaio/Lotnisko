const imie = document.querySelector('#imie input');
const nazwisko = document.querySelector('#nazwisko input');
const kraj = document.querySelector('#kraj input');
const paszport = document.querySelector('#paszport input');
const dowod = document.querySelector('#dowod input');
const email = document.querySelector('#email input');
const login = document.querySelector('#login input');
const haslo = document.querySelector('#haslo input');
const haslo2 = document.querySelector('#haslo_2 input');

const button = document.querySelector('main button');
const area1 = document.querySelector('p.warning');
const area2 = document.querySelector('main p');
let userPassword;
let min;
let max;


//gdzie trzeba sprawdzic długość łańcucha tam podpinamy lengthCorrect. Gdzie potrzebne są dodatkowe warunki tam w pierwszej funkcji podpiętej pod inputa sprawdzamy dodatkowe warunki.


//UNIWERSALNA FUNKCJA SPRAWDZAJACA DLUGOSC LANCUCHA
function lengthCorrect(number, min, max) {
    console.log(number);
    if (number > min && number < max) {
        area1.textContent = `Pole musi sie składać z przynajmniej ${max} znaków!`;
        button.disabled = true;
        button.style.opacity = "0";
        area1.style.color = "red";
    } else {
        area1.textContent = "Prosimy o rzetelne wypełnienie powyższego formularza.";
        button.style.opacity = "1";
        button.disabled = false;
        area1.style.color = "#aab1be";
    }
}

//POZOSTALE FUNKCJE SPRAWDZAJACE KAZDE POLE Z OSOBNA
const NameCorrect = (e) => {
    let userType = e.target.value.length;
    min = 0;
    max = 3;
    lengthCorrect(userType, min, max);
}

const countryCorrect = (e) => {
    let userType = e.target.value.length;
    min = 0;
    max = 4;
    if (userType >= 30) {

        area1.style.color = "red";
        button.disabled = true;
        button.style.opacity = "0";
        return area1.textContent = `Twoje pole wykracza poza 30 znaków!`;
    }
    lengthCorrect(userType, min, max);
}

const paszportCorrect = (e) => {
    let userType = e.target.value;
    let bigChar = /[A-Z]/;

    let smallChar = /[a-z]/;
    if (bigChar.test(userType) || smallChar.test(userType)) {
        area1.style.color = "red";
        button.disabled = true;
        button.style.opacity = "0";
        area1.textContent = `Twoje pole zawiera litery!`;
    } else if (userType.length != 15) {
        area1.style.color = "red";
        button.disabled = true;
        button.style.opacity = "0";
        area1.textContent = `Liczba cyfr w paszporcie to 15!`;
    } else {
        area1.textContent = "Prosimy o rzetelne wypełnienie powyższego formularza.";
        button.style.opacity = "1";
        button.disabled = false;
        area1.style.color = "#aab1be";
    }
}


const dowodCorrect = (e) => {
    let userType = e.target.value;
    let bigChar = /[A-Z]/;
    let smallChar = /[a-z]/;
    if (bigChar.test(userType) || smallChar.test(userType)) {
        area1.style.color = "red";
        button.disabled = true;
        button.style.opacity = "0";
        area1.textContent = `Twoje pole zawiera litery!`;
    } else if (userType.length != 9) {
        area1.style.color = "red";
        button.disabled = true;
        button.style.opacity = "0";
        area1.textContent = `Liczba cyfr w dowodzie to 9!`;
    } else {
        area1.textContent = "Prosimy o rzetelne wypełnienie powyższego formularza.";
        button.style.opacity = "1";
        button.disabled = false;
        area1.style.color = "#aab1be";
    }
}

const emailCorrect = (e) => {
    let userType = e.target.value;
    let userTypeNumber = userType.length;
    let character = /[@]/;
    min = 0;
    max = 10;

    if (!character.test(userType)) {
        area1.style.color = "yellow";
        button.disabled = true;
        button.style.opacity = "0";
        return area1.textContent = `Pamiętaj że Email nie obejdzie się bez małpki -> @`;
    }
    lengthCorrect(userTypeNumber, min, max);
}



const loginCorrect = (e) => {
    let userType = e.target.value.length;
    min = 0;
    max = 5;
    lengthCorrect(userType, min, max);
}

const hasloCorrect = (e) => {
    let numbers = /[0-9]/;
    let bigChar = /[A-Z]/;
    let userType = e.target.value;
    userPassword = userType;
    let userTypeNumber = userType.length;
    min = 0;
    max = 8;
    if (!numbers.test(userType)) {
        button.disabled = true;
        area1.style.color = "red";
        button.style.opacity = "0";
        return area1.textContent = "hasło musi Zawierać co najmniej jedną cyfrę!";
    } else if (!bigChar.test(userType)) {
        button.disabled = true;
        area1.style.color = "red";
        button.style.opacity = "0";
        return area1.textContent = "hasło musi Zawierać co najmniej jedną wielką literę!";

    }
    lengthCorrect(userTypeNumber, min, max);
}

const theSamePassword = (e) => {
    let secondPassword = e.target.value;
    if (!(secondPassword === userPassword)) {
        button.disabled = true;
        area1.style.color = "red";
        button.style.opacity = "0";
        area1.textContent = "Hasła nie są identyczne!";
    } else {
        area1.textContent = "Prosimy o rzetelne wypełnienie powyższego formularza.";
        button.style.opacity = "1";
        button.disabled = false;
        area1.style.color = "#aab1be";
    }
}

imie.addEventListener('keyup', NameCorrect);
nazwisko.addEventListener('keyup', NameCorrect);
kraj.addEventListener('keyup', countryCorrect);
paszport.addEventListener('keyup', paszportCorrect);
dowod.addEventListener('keyup', dowodCorrect);
email.addEventListener('keyup', emailCorrect);
login.addEventListener('keyup', loginCorrect);
haslo.addEventListener('keyup', hasloCorrect);
haslo2.addEventListener('keyup', theSamePassword);