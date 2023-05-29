function searchRecipes(event) {
    event.preventDefault();
   console.log(event.currentTarget);
    // const form= document.querySelector('form');
    const avviso = document.querySelector('.avviso');
    const ricetta_input = document.querySelector('#richiesta');
    
    var ingredient = ricetta_input.value;
    if (ingredient.trim() !== '') {
        // Effettua la richiesta all'API Edamam
        var ric = new XMLHttpRequest();
        ric.open('GET', 'get_recipes.php?ingredient=' + encodeURIComponent(ingredient), true);
        ric.onload = function() {
            if (ric.status === 200) {
                var response = JSON.parse(ric.responseText);
                
                displayRecipes(response);
            }
        };
        ric.send();
        
    }
    else{    
        avviso.textContent="Compila la richiesta!";
        // event.preventDefault();
    }
    event.currentTarget.value= "Ripristina Pagina";
        event.currentTarget.removeEventListener('click',searchRecipes);
      event.currentTarget.addEventListener('click',chiudi_recipe_box);
}

function displayRecipes(recipes) {
    const avviso = document.querySelector('.avviso');
    const form= document.querySelector("form");
    const div=document.createElement('div');
    div.classList.add('recipes');
    form.appendChild(div);
    var recipesElement = document.querySelector('.recipes');
    recipesElement.innerHTML = '';

    const num_results = recipes.length;
    
    if (num_results === 0) {
        avviso.textContent = 'Nessuna ricetta trovata!';
    } else {
        avviso.textContent='';
        for (let i = 0; i < num_results; i++) {
        //    console.log(recipes[i].recipe);
            const titolo =recipes[i].recipe.label;
            const immagine = recipes[i].recipe.image;
            const recipe = document.createElement('div');
            recipe.classList.add('ric');
            recipe.classList.add('noChoice');
            const noClick = document.createElement('img');
            noClick.classList.add('checkbox');
            noClick.src = "http://localhost/mioServer/hw1/immagini/unchecked.png";
            noClick.addEventListener('click', selezione);
            const img = document.createElement('img');
            img.src = immagine;
            const caption = document.createElement('span');
            caption.textContent = titolo;
            recipe.appendChild(caption);
            recipe.appendChild(noClick);
            recipe.appendChild(img);
            const ingredienti = recipes[i].recipe.ingredientLines;
            const num_ingredienti = ingredienti.length;
            for(let j=0; j<num_ingredienti; j++){
                const ingr = ingredienti[j];
                const caption_ingr = document.createElement('p');
                caption_ingr.textContent = ingr;
                recipe.appendChild(caption_ingr);
            }
        recipesElement.appendChild(recipe);    
        }        
    }
}

function chiudi_recipe_box(event){
    event.preventDefault();
    event.currentTarget.value="cerca";
    var recipesElement = document.querySelector('.recipes');
    console.log(recipesElement);
    recipesElement.innerHTML = '';
    event.currentTarget.removeEventListener('click',chiudi_recipe_box);
    event.currentTarget.addEventListener('click',searchRecipes);
   
    // recipesElement.removeChild(form.lastElementChild);  
}

function selezione (event){
    const Click = event.currentTarget;
    var check = Click.parentNode;

    check.classList.remove('noChoice');
    check.classList.add('Choice');
    Click.src= "http://localhost/mioServer/hw1/immagini/checked.png";
    console.log('cliccato' + Click);
    Click.removeEventListener('click',selezione);
    Click.addEventListener('click', noSelezione);
  }
  
  function noSelezione (event){
    const Click= event.currentTarget;
    var check = Click.parentNode;

    check.classList.remove('Choice');
    check.classList.add('noChoice');
    Click.src="http://localhost/mioServer/hw1/immagini/unchecked.png";
    Click.removeEventListener('click', noSelezione);
    Click.addEventListener('click',selezione);
  }
  

document.querySelector(".cerca").addEventListener('click', searchRecipes);