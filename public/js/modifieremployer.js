var newroles = document.querySelectorAll('#role')
newroles.forEach(role=>{
let nf = role.closest('.modal-content').querySelectorAll('.infermiere')
let md = role.closest('.modal-content').querySelectorAll('.medecin')

if(role.value=='3'){
    nf.forEach(e=>{
        e.querySelector('select , input').setAttribute('required','required')
        e.classList.remove('hide')})
}
else if(role.value=='4'){
    md.forEach(e=>{
        e.querySelector('select , input').setAttribute('required','required')
        e.classList.remove('hide')})
}
else{
    md.forEach(e=>{
        e.querySelector('select , input').removeAttribute('required','required')
        e.classList.add('hide')})
    nf.forEach(e=>{
        e.querySelector('select , input').removeAttribute('required','required')
        e.classList.add('hide')})

}
})
