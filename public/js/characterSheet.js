function updateValue(input){
    
    let id = input.id.replace('_vis','')
    hidden = document.querySelector('input#'+id)
    span = document.querySelector('span#'+id)

    hidden.value = input.value;
    span.innerText = input.value;
    console.log(hidden)
    console.log(span)
}