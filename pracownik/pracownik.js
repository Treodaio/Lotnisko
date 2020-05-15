const login = document.querySelector('#username input');
const button = document.querySelector('main button');
const area = document.querySelector('main p')

const loginCorrect = (e) => {
    let userType = e.target.value;
    if (userType.length > 0 && userType.length < 5) {
        area.textContent = "Login musi sie składać z przynajmniej 5 znaków!";
        button.disabled = true;
        button.style.opacity = "0";
        area.style.color = "red";
    } else {
        area.textContent = "Panel ten służy do logowania się naszej załodze. Naszych klientów zapraszamy na stronę (....) w celu zalogowania się";
        button.style.opacity = "1";
        button.disabled = false;
        area.style.color = "#aab1be";
    }
}


login.addEventListener('keyup', loginCorrect);