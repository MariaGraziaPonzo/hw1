function Search(event){
    event.preventDefault();
    const avviso = document.querySelector('.avviso');
    const input = document.querySelector('#inserimento');

    var foto= input.value;
    if(foto.trim() !== ''){
        avviso.textContent="";
    var richiesta2 = new XMLHttpRequest();
    richiesta2.open('GET', 'get_photo.php?keyword=' + encodeURIComponent(foto), true);
    richiesta2.onload = function() {
        if (richiesta2.status === 200) {
            var response2 = JSON.parse(richiesta2.responseText);
            displayImage(response2);
    }
    };
        richiesta2.send();
}else{
    avviso.textContent="Compila la richiesta!";
}
event.currentTarget.value= "Ripristina Pagina";
        event.currentTarget.removeEventListener('click',Search);
      event.currentTarget.addEventListener('click',chiudi_images_box);

}

function chiudi_images_box(event){
    event.preventDefault();
    event.currentTarget.value="Get more images";
    const box= document.querySelector(".show_images");
    box.innerHTML='';
    event.currentTarget.removeEventListener('click',chiudi_images_box);
    event.currentTarget.addEventListener('click',Search);
   
}

function displayImage(imgs){
    const box= document.querySelector(".show_images");
    box.innerHTML='';
    
    for(const img of imgs){
      const image = document.createElement('img');
      image.src= img.webformatURL;
      image.addEventListener('click', openModal);
      box.appendChild(image);
    }
}
function Closemodal(event) {
    
    var moda = document.getElementById('Aperto');
    moda.remove();
    
}
function openModal(event) {
    var url= event.target.src;
    var esterno =  document.getElementById('estero');
    var modale= document.createElement('div');
    var span=document.createElement('span');
    var img=document.createElement('img');


    modale.classList.add("modalok");
    modale.id='Aperto';
    span.classList.add("modal-content");
    img.classList.add('modalimage');
    img.src=url;
    span.appendChild(img);
    modale.appendChild(span);
    esterno.appendChild(modale);
    modale.addEventListener('click',Closemodal);
    
}



//Accuwater

function displayWeather(data) {
    var caricamento= document.getElementById('caricamento');
    caricamento.innerHTML='';
    var weatherDiv = document.getElementById('weather');
    weatherDiv.innerHTML = '';
  
    var temperature = data.temperature;
    var weatherText = data.weatherText;
    var weatherImage = data.weatherImage;

    const h1= document.createElement('h1');
    h1.textContent= "Catania";
  
    const p1=document.createElement('p');
    p1.textContent=temperature + "°C";
    const p= document.createElement('p');
    p.textContent= weatherText;

    //non funziona
    // const weatherImageElement = document.createElement('img');
    // weatherImageElement.src = weatherImage;
    // weatherImageElement.alt = weatherText;
  
    const image= document.createElement('img');
    if(data.HasPrecipitation===true){
      image.src="immagini/pioggia.png";
    }else{
      image.src="immagini/sole.png";
    }
  

    weatherDiv.appendChild(h1);
    weatherDiv.appendChild(p1);
    weatherDiv.appendChild(p);
    weatherDiv.appendChild(image);
}
    



// Effettua la richiesta all'API di AccuWeather
var richiesta = new XMLHttpRequest();
richiesta.open('GET', 'get_weather.php', true);
richiesta.onload = function() {
    if (richiesta.status === 200) {
        var response = JSON.parse(richiesta.responseText);
        displayWeather(response);
    }
};
richiesta.send();

document.querySelector(".accesso").addEventListener('click', Search);