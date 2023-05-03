function updateValue(input){
    
    let id = input.id.replace('_vis','')
    hidden = document.querySelector('input#'+id)
    span = document.querySelector('span#'+id)
    debugger
    switch(input.type)
    {
        case 'number':
            hidden.value = input.value == '' ?  0 : input.value;
            span.innerText = input.value;
            break;

        case 'text':
            hidden.value = input.value == '' ?  'Brak' : input.value;
            span.innerText = input.value;
            break;
    }
    

    
}


function validateCharacter(){
    const btnSubmit = document.getElementById('character_submit');
    btnSubmit.click();
}