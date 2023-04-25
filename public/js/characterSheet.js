function updateValue(input){
    
    let id = input.id.replace('_vis','')
    hidden = document.querySelector('input#'+id)
    span = document.querySelector('span#'+id)

    hidden.value = input.value;
    span.innerText = input.value;
    console.log(hidden)
    console.log(span)
}

function selectProfession(id){

    profession = document.querySelector('div[data-prof-id="'+ id +'"]')
    professions = document.querySelectorAll('#professionList .profession')
    input = document.getElementById('form_charcterId')
    button = document.querySelector('footer .rightButtons a')
    
    debugger
    input.value = input.value === profession.dataset.profId ? 0 : profession.dataset.profId
    
    input.value == 0 ? button.classList.add('disabled') : button.classList.remove('disabled')
    console.log(profession)

    professions.forEach(prof => {
        (prof.querySelector('.comet-wrapper').classList.contains('show') && prof != profession) ? comet(prof) : '';
    });
   comet(profession)
    

}

function comet(profession){

  let cometLeft= profession.querySelector('.comet-wrapper.left')
  let cometRight= profession.querySelector('.comet-wrapper.right')

    if(cometLeft.classList.contains('show')){
        cometLeft.classList.toggle('hidding')
        cometRight.classList.toggle('hidding')
        cometLeft.classList.toggle('show')
        cometRight.classList.toggle('show')
        setTimeout(() => {
                cometLeft.classList.toggle('hide')
                cometRight.classList.toggle('hide')
                cometLeft.classList.toggle('hidding')
                cometRight.classList.toggle('hidding')
             }, 0333);
    }else{
        cometLeft.classList.toggle('showing')
        cometRight.classList.toggle('showing')
        cometLeft.classList.toggle('hide')
        cometRight.classList.toggle('hide')
        setTimeout(() => {
                cometLeft.classList.toggle('show')
                cometRight.classList.toggle('show')
                cometLeft.classList.toggle('showing')
                cometRight.classList.toggle('showing')
             }, 0333);
    }
}