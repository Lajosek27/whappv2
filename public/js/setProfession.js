document.addEventListener('DOMContentLoaded',() => {
   
  
   
    accordion = document.querySelectorAll('.accordion-header')
    accordion.forEach(el => {
        el.querySelector('button').addEventListener('click',() => {
            
            el.querySelector('iconify-icon').classList.toggle('arrowDown')
        })
    });
});  
  
  
function selectProfession(id){

    input  = document.querySelector('form input')
    input.value=id
    button = document.querySelector('#professionSubmit')
    button.click()
    
}