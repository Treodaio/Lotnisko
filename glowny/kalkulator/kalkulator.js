//zmienne potrzebne do funkcjonowania programu

let numberOne = "";
let numberTwo = "";

const typeOfOperation = document.querySelectorAll('[data-operator]');

//tu przechowam znak arytmetyczny jaki ma być użyty podczas działania
let operation;

let flag = true;


//pobieramy elementy kalkulatora
const result = document.querySelector('div.result');
const numbers = document.querySelectorAll('[data-value]');

const equal = document.querySelector('[data-modify = "="]');
const clear = document.querySelector('[data-modify = "C"]');
//zmienianie dodawania elementów do różnych tablic można zrealizować za pomocą flag.



const getNumber = (e) => {
    if (flag === true) {
        numberOne += e.target.dataset.value.toString();
        result.textContent = numberOne;
        console.log(numberOne);
    } else return;
}


const saveType = (e) => {
    if (numberOne != "") {
        operation = e.target.dataset.operator;
        result.textContent = operation;
        flag = false;
    } else return;

}

const getSecondNumber = (e) => {
    if (flag === false) {
        numberTwo += e.target.dataset.value.toString();
        result.textContent = "";
        result.textContent = numberTwo;
    } else return;
}

const showResult = () => {
    if (numberOne != "") {
        numberOne = parseInt(numberOne, 10);
        numberTwo = parseInt(numberTwo, 10);


        switch (operation) {
            case '+': {
                result.textContent = "";
                result.textContent = numberOne + numberTwo;
                numberOne = numberOne + numberTwo;
            }
            break;

        case '-': {
            result.textContent = "";
            result.textContent = numberOne - numberTwo;
            numberOne = numberOne - numberTwo;
        }
        break;
        case '/': {
            result.textContent = "";
            result.textContent = numberOne / numberTwo;
            numberOne = numberOne / numberTwo;
        }
        break;
        case '*': {
            result.textContent = "";
            result.textContent = numberOne * numberTwo;
            numberOne = numberOne * numberTwo;
        }
        break;
        }
        numberTwo = "";
    } else return;
}

const restoreToDefault = () => {
    numberOne = "";
    numberTwo = "";
    flag = true;
    result.textContent = 0;
}



typeOfOperation.forEach(item => item.addEventListener('click', saveType));
numbers.forEach(number => number.addEventListener('click', getNumber));
numbers.forEach(number => number.addEventListener('click', getSecondNumber));
equal.addEventListener('click', showResult);
clear.addEventListener('click', restoreToDefault);