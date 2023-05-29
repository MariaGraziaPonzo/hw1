function checkPassword(event) {
    const passwordInput = document.querySelector('#vecchiaP input');
    if (formStatus.password = passwordInput.value.length >= 8) {
        document.querySelector('#vecchiaP').classList.remove('error');
        document.querySelector('#vecchiaP span').textContent ="";
    } else {
        const box = document.querySelector('#vecchiaP .error');
        document.querySelector('#vecchiaP span').textContent ="Password troppo corta!";
        const image= document.createElement('img');
        image.src= "./immagini/close.svg";
        box.appendChild(image);
       
    }
    
}

function checkPasswordN(event) {
    const passwordInput = document.querySelector('#nuovaP input');
    if (formStatus.password = passwordInput.value.length >= 8) {
        document.querySelector('#nuovaP').classList.remove('error');
        document.querySelector('#nuovaP span').textContent ="";
    } else {
        const box = document.querySelector('#nuovaP .error');
        document.querySelector('#nuovaP span').textContent ="Password troppo corta!";
        const image= document.createElement('img');
        image.src= "./immagini/close.svg";
        box.appendChild(image);
       
    }
    
}

function checkConfirmPassword(event) {
    const confirmPasswordInput = document.querySelector('#confermaP input');
    if (formStatus.confirmPassord = confirmPasswordInput.value === document.querySelector('#nuovaP input').value) {
        document.querySelector('#confermaP').classList.remove('error');
        document.querySelector('#confermaP span').textContent ="";
    } else {
        const box=document.querySelector('#confermaP .error');
        document.querySelector('#confermaP span').textContent ="Password non coincidenti";
        const image= document.createElement('img');
        image.src= "./immagini/close.svg";
        box.appendChild(image);
    }
    
}

const formStatus = {'upload': true};
document.querySelector('#vecchiaP input').addEventListener('blur', checkPassword);
document.querySelector('#nuovaP input').addEventListener('blur', checkPasswordN);
document.querySelector('#confermaP input').addEventListener('blur', checkConfirmPassword);
