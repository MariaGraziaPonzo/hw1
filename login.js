function checkUsername(event) {
    const input = document.querySelector('#username input');
 
     if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
         const box = document.querySelector('#username .error');
         document.querySelector('#username span').textContent = "Sono ammesse lettere, numeri e underscore. Max. 15";
         
         const image= document.createElement('img');
         image.src= "./immagini/close.svg";
         box.appendChild(image);
         
     } else {
         document.querySelector('#username span').textContent ="";
         
     }    
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
    }
    
}


const formStatus = {'upload': true};
document.querySelector('#username input').addEventListener('blur', checkUsername);
document.querySelector('#password input').addEventListener('blur', checkPassword);