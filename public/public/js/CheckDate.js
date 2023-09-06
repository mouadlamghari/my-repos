

  const consultationDuration = 30;

  let dateC = document.querySelector('#dateconsul')
  let time = document.querySelector('.pdate')
  dateC.onchange=()=>{
    let targetDate = dateC.value
  const occupiedTimeSlots = pselect.medecin.consultations
    .filter(consultation => consultation.Date_consultation.startsWith(targetDate))
    .map(consultation => new Date(consultation.Date_consultation).getHours() * 60 + new Date(consultation.Date_consultation).getMinutes());
    time.classList.remove('hide')
  const startTime = 8 * 60;
  const endTime = 17 * 60;
  const availableTimeSlots = [];

  for (let i = startTime; i <= endTime - consultationDuration; i += consultationDuration) {
    if (!occupiedTimeSlots.includes(i)) {
      availableTimeSlots.push(i);
    }
  }

  // Convert availableTimeSlots back to readable time format
  const formattedAvailableTimeSlots = availableTimeSlots.map(slot => {
    const hours = Math.floor(slot / 60);
    const minutes = slot % 60;
    return `${hours}:${minutes < 10 ? '0' : ''}${minutes}`;
  });

  (formattedAvailableTimeSlots)
  time.querySelector('select').innerHTML=''
  formattedAvailableTimeSlots.map(slot=>{
    let option = document.createElement('option')
    let chose = document.createElement('option')
    chose.value=''
    option.value=slot
    option.innerText=slot
    time.querySelector('select').append(option)
  })
}
