function jsonCheckEmail(json) {
    // Controllo il campo exists ritornato dal JSON
    if (formStatus.email = !json.exists) {
        document.querySelector('#email').classList.remove('error');
        document.querySelector('#email span').textContent ="";
        formStatus.email=true;
    } else {
        const box= document.querySelector('#email .error');
        
        document.querySelector('#email span').textContent = "Email già utilizzata";
        
        const image= document.createElement('img');
        image.src= "./immagini/close.svg";
        box.appendChild(image);
        formStatus.email=false;
    }
    
}

function checkEmail(event) {
    const emailInput = document.querySelector('#email input');
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(emailInput.value).toLowerCase())) {
        const box = document.querySelector('#email .error');
        document.querySelector('#email span').textContent = "Email non valida";
        
        const image= document.createElement('img');
        image.src= "./immagini/close.svg";
        box.appendChild(image);
        formStatus.email = false;
       
    } else {
        // formStatus.email = true;
        // document.querySelector('#email span').textContent ="";
        fetch("http://localhost/mioServer/hw1/php/check_email.php?q="+encodeURIComponent(String(emailInput.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);
    }
    
}

const formStatus = {'upload': true};
document.querySelector('#email input').addEventListener('blur', checkEmail);
