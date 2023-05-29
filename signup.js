function checkName(event) {
    const input = event.currentTarget;

    if (formStatus[input.name] = input.value.length > 0) {
        document.querySelector('#nome').classList.remove('error');
        formStatus.name=true;
    } else {
        const box=document.querySelector('#nome .error');
        
        document.querySelector('#nome span').textContent = "Inserisci il tuo nome";
        const image= document.createElement('img');
        image.src= "./immagini/close.svg";
        box.appendChild(image);
        formStatus.name=false;
    }
    
    checkForm();
}

function checkSurname(event) {
    const input = event.currentTarget;
    
    /* if(formStatus[input.name] = /^[a-zA-Z]+$/.test(input.value)) { */
    if (formStatus[input.surname] = input.value.length > 0) {
        document.querySelector('#cognome').classList.remove('error');
        formStatus.surname=true;
    } else {
        const box=document.querySelector('#cognome .error');
        
        document.querySelector('#cognome span').textContent = "Inserisci il tuo cognome";
        const image= document.createElement('img');
        image.src= "./immagini/close.svg";
        box.appendChild(image);
        formStatus.surname=true;
    }
    
    checkForm();
}

function jsonCheckUsername(json) {
    // console.log("hai scritto: " + formStatus.username);
    // Controllo il campo exists ritornato dal JSON
    if (formStatus.username = !json.exists) {
        document.querySelector('#username').classList.remove('error');
        document.querySelector('#username span').textContent ="";
    } else {              
        const box= document.querySelector('#username .error');
        
        document.querySelector('#username span').textContent = "Username già utilizzato";
        
        const image= document.createElement('img');
        image.src= "./immagini/close.svg";
        box.appendChild(image);
        formStatus.username=false;
    }
    checkForm();
}

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
    checkForm();
}

function fetchResponse(response){
    if(!response.ok){
        console.log('Risposta non valida');
        return null;
    }else{
        console.log('Risposta ricevuta');
        return response.json();
    }
}
  
function onFail(fail){
console.log('Errore: ' + fail);
}


function checkUsername(event) {
   const input = document.querySelector('#username input');

    if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
        const box = document.querySelector('#username .error');
        document.querySelector('#username span').textContent = "Sono ammesse lettere, numeri e underscore. Max. 15";
        
        const image= document.createElement('img');
        image.src= "./immagini/close.svg";
        box.appendChild(image);
        formStatus.username = false;
        
    } else {
        formStatus.username = true;
        document.querySelector('#username span').textContent ="";
        fetch("check_username.php?q="+encodeURIComponent(input.value)).then(fetchResponse, onFail).then(jsonCheckUsername);
    }
    checkForm();    
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
        fetch("check_email.php?q="+encodeURIComponent(String(emailInput.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);
    }
    checkForm();
}

function checkPassword(event) {
    const passwordInput = document.querySelector('#password input');
    if (formStatus.password = passwordInput.value.length >= 8) {
        document.querySelector('#password').classList.remove('error');
        document.querySelector('#password span').textContent ="";
    } else {
        const box = document.querySelector('#password .error');
        document.querySelector('#password span').textContent ="Password troppo corta!";
        const image= document.createElement('img');
        image.src= "./immagini/close.svg";
        box.appendChild(image);
        formStatus.password=false;
    }
    checkForm();
}

function checkConfirmPassword(event) {
    const confirmPasswordInput = document.querySelector('#conferma input');
    if (formStatus.confirmPassord = confirmPasswordInput.value === document.querySelector('#password input').value) {
        document.querySelector('#conferma').classList.remove('error');
        document.querySelector('#conferma span').textContent ="";
    } else {
        const box=document.querySelector('#conferma .error');
        document.querySelector('#conferma span').textContent ="Password non coincidenti";
        const image= document.createElement('img');
        image.src= "./immagini/close.svg";
        box.appendChild(image);
    }
    checkForm();
}

function checkForm() {
    if (document.querySelector('#consenti input').checked || 
    Object.keys(formStatus).length >= 7 || 
    Object.values(formStatus).includes(false))
    {
        document.getElementById('accesso').disabled ;
    }
    
}

function checkUpload(event) {
    const upload_original = document.getElementById('upload_original');
    // document.querySelector('#upload .file_name').textContent = upload_original.files[0].name;
    const o_size = upload_original.files[0].size;
    const mb_size = o_size / 1000000;
    // document.querySelector('#upload .file_size').textContent = mb_size.toFixed(2)+" MB";
    const ext = upload_original.files[0].name.split('.').pop();

    if (o_size <= 7000000) {
        document.querySelector('.fileupload').classList.remove('error');
        document.querySelector('.fileupload span').textContent ="";
        formStatus.upload = true;
        
    } else if (!['jpeg', 'jpg', 'png', 'gif'].includes(ext))  {
        const box = document.querySelector('.fileupload .error');
        document.querySelector('.fileupload span').textContent = "Le estensioni consentite sono .jpeg, .jpg, .png e .gif";
               const image= document.createElement('img');
        image.src= "./immagini/close.svg";
        box.appendChild(image);
        formStatus.upload = false;
    } else {
        document.querySelector('.fileupload span').textContent = "Le dimensioni del file superano 7 MB";
        
        const image= document.createElement('img');
        image.src= "./immagini/close.svg";
        box.appendChild(image);
        formStatus.upload = false;
    }
    checkForm();
}

// function clickSelectFile(event) {
//     upload_original.click();
// }


const formStatus = {'upload': true};
document.querySelector('#nome input').addEventListener('blur', checkName);
document.querySelector('#cognome input').addEventListener('blur', checkSurname);
document.querySelector('#username input').addEventListener('blur', checkUsername);
document.querySelector('#email input').addEventListener('blur', checkEmail);
document.querySelector('#password input').addEventListener('blur', checkPassword);
document.querySelector('#conferma input').addEventListener('blur', checkConfirmPassword);
// document.getElementById('upload').addEventListener('click', clickSelectFile);
document.getElementById('upload_original').addEventListener('change', checkUpload);



