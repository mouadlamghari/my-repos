
let roles = document.querySelectorAll('#role')
let forms = document.querySelectorAll('form')

roles.forEach(role=>role.onchange=(e)=>{
    let infermiere = role.closest('.modal-content').querySelectorAll('.infermiere')
    let medecin = role.closest('.modal-content').querySelectorAll('.medecin')
    if(role.value=='3'){
        infermiere.forEach(e=>{
            e.querySelector('select , input').setAttribute('required','required')
            e.classList.remove('hide')})
    }
    else if(role.value=='4'){
        medecin.forEach(e=>{
            e.querySelector('select , input').setAttribute('required','required')
            e.classList.remove('hide')})
    }
    else{
        medecin.forEach(e=>{
            e.querySelector('select , input').removeAttribute('required','required')
            e.classList.add('hide')})
        infermiere.forEach(e=>{
            e.querySelector('select , input').removeAttribute('required','required')
            e.classList.add('hide')})

    }

})

