function updateValue(input){
    
    let id = input.id.replace('_vis','')
    hidden = document.querySelector('input#'+id)
    span = document.querySelector('span#'+id)


    hidden.value = input.value == '' ?  0 : input.value;
    span.innerText =  input.value == '' ?  0 : input.value;
            

    
}

function updateExp(){
    span = document.querySelector('span#exp_sum'),
    free = parseInt(document.querySelector('input#character_free').value),
    spend = parseInt(document.querySelector('input#character_spend').value),

    span.innerText = free + spend;
    

    
}

function validateCharacter(){
    const btnSubmit = document.getElementById('character_submit');
    btnSubmit.click();
}