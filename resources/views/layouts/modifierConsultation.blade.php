<div class="modal   fade" id={{"modifier".$consultation->id}} tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3 ">
<form method="POST" enctype="multipart/form-data"  id={{"item".$consultation->id}} action="{{route('Consultations.update',$consultation->id)}}" class="AjouterForm" style="background-color: #fff;border-radius:5px" >
    @method("PUT")
    @csrf
        <div class="row">

            <div class="col-6">

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Numéro Consultation</label>
                    <div class="d-flex" >
                        <input  value="{{$consultation->NumeroConsultation}}"  required type="text"  name="NumeroConsultation" class="form-control" id="exampleFormControlInput1" >
                        <button  type="button" class="btn btn-success"  id="generate" >
                            <i class="fa-solid fa-lightbulb"></i>
                        </button>
                    </div>
                </div>
            </div>
    <div class="col-6">

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Patient</label>
            <select required name="patient_id"  id="patientm" class="form-select " aria-label=".form-select-lg example">
                <option value="" selected>Choisir Patient</option>
                @foreach ($patients as $patient )
                <option value="{{$patient->id}}"  @selected($consultation->patient_id===$patient->id) >{{$patient->Nom}} - {{$patient->Prenom}} - {{$patient->Numero}} </option>
                @endforeach
              </select>
        </div>
    </div>

    <div class="col-6">

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Object</label>
            <input  required name="Objet" class="form-control" id="exampleTextarea" value="{{$consultation->Objet}}" />
        </div>
    </div>

    <div class="col-6">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Observation</label>
            <input required name="Observation" class="form-control" id="exampleTextarea" value="{{$consultation->Observation}}" />
        </div>
    </div>

          <div class="col-6">

              <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Type consultation</label>
                  <select required name="TypeCosultation" id="operation" class="form-select " aria-label=".form-select-lg example">
                    <option value="">Choisir Patient</option>
                    <option @selected($consultation->TypeCosultation=='Consultationgénéral') value="Consultationgénéral ">Consultation général  </option>
                    <option  @selected($consultation->TypeCosultation=='operation') value="operation ">Une Opération  </option>
                  </select>
                </div>
        </div>


            <div class="col-6 hide  pmedcinm ">
                <label for="exampleFormControlInput1" class="form-label">Date </label>
                <input required id="dateconsul"   type="date" name="Date_consultation"  required class="form-control" id="exampleFormControlInput1" >
            </div>

            <div class="col-6 hide pdate">
                <label for="exampleFormControlInput1" class="form-label">Time</label>
            <select required class="form-select "  name="time" aria-label=".form-select-lg example">
                <option selected>Choisir Time</option>
              </select>
             </div>



             <div class="col-12 op hide">
                <label for="exampleFormControlInput1" class="form-label">Equipe</label>
                <div class="mb-3">
                    <select  class="form-select form-select-sm" name="equipe[]" id=""  width='100%' multiple  >
                        <optgroup label="Medecins">
                            @foreach ($medecins as $medecin)
                            <option   @selected($consultation?->operation?->equipe?->equipemember?->pluck('employe_id')->contains($medecin->id))  value="{{ $medecin->id }}">{{ $medecin->Matricule .''. $medecin->Nom }}</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Assistants">
                            @foreach ($Assistants as $assistant)
                            <option   @selected($consultation?->operation?->equipe?->equipemember?->pluck('employe_id')->contains($assistant->id))  value="{{ $assistant->id }}">{{ $assistant->Nom }}</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Infermiers">
                            @foreach ($infermiers as $infermier)
                            <option   @selected($consultation?->operation?->equipe?->equipemember?->pluck('employe_id')->contains($infermier->id))  value="{{ $infermier->id }}">{{  $infermier->Nom }}</option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
            </div>


{{--             {{json_encode($consultation)}}
 --}}
            <div class="col-6  op hide">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Bloc operation</label>
                    <input  value="{{$consultation?->operation?->blocoperatoire}}" type="text" name="blocoperatoire"   class="form-control" id="exampleFormControlInput1" >
                </div>
            </div>

            <div class="col-12 einfo ">

            </div>

            <div class="col-6 op hide">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Date de Debut</label>
                    <input  value="{{$consultation?->operation?->DateDebut}}" type="datetime-local" name="DateDebut"   class="form-control" id="exampleFormControlInput1" >
                </div>
            </div>

            <div class="col-6 op hide">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Date de Fin</label>
                    <input value="{{$consultation?->operation?->DateFin}}"   type="datetime-local" name="DateFin"   class="form-control" id="exampleFormControlInput1" >
                </div>
            </div>

            <div class="mb-3 op hide">
                <label for="exampleFormControlInput1" class="form-label">Operation observation</label>
                <input name="ObservationOperation"  class="form-control" id="exampleTextarea" value="{{$consultation?->operation?->Observation}}"/>
            </div>
        </div>
          <button type="submit" class="btn btn-primary  col-12 btnAj ">Enregistrer</button>
        </form>
        </div>
    </div>
</div>







         <script>
             var equipesm ={{ Js::from($equipes)}}
             var datem ={{ Js::from($consultation->Date_consultation)}}
            var patientsm ={{ Js::from($patients)}}
            var patientselectm = document.querySelectorAll('#patientm')
            var inputsdatem = document.querySelectorAll('.pmedcinm')

            var pselect;
            inputsdatem.forEach(item=>{
                item.classList.remove('hide')
                item.querySelector('input').value=datem.split(' ')[0]
            })

            pselect = patientsm.find(e=>e.id==patientselectm.value)
            patientselectm.forEach( patient => patient.onchange=(e)=>{
                let idp = e.target.options[e.target.selectedIndex].value
                if(idp){
                    inputsdatem.forEach(item=>item.classList.remove('hide'))
                }
                else{
                    inputsdatem.forEach(item=>item.classList.add('hide'))
                }
            })



            var btngenererm = document.querySelectorAll('#generate')
            btngenererm.forEach(btn =>btn.onclick=(e)=>{
                let data = ['A','B','C',1,2,3,'D','E','F','H','J',5,6,'K','L','M','V',4,,7,9]
                let generatedvalue = data.sort(()=>0.75-Math.random()).splice(0,10).join('')
                let input = e.target.closest('div').firstElementChild
                input.value=generatedvalue
            })



            var operationm = document.querySelectorAll('#operation');
            //var operationsInputs=document.querySelectorAll('.op')
            operationm.forEach(operation=>{
                if(operation.value.trim()=='operation'){
                    operation.closest('form').querySelectorAll('.op').forEach(operation=>{operation.classList.remove('hide')
                operation.setAttribute('required','required')
                })

                }
            })


            operationm.forEach(operation =>operation.onchange=(e=>{
                let operationsInputs=e.target.closest('form').querySelectorAll('.op')

                if(e.target.options[e.target.selectedIndex].value.trim()=='operation'){
                    operationsInputs.forEach(operation=>{operation.classList.remove('hide')
                operation.setAttribute('required','required')
                })

                }
                else{
                operationsInputs.forEach(operation=>{operation.classList.add('hide')
                operation.removeAttribute('required');
            })
                }
            })
            )

            var equipem = document.querySelector('#equipe')
            if(equipem){

                equipem.onchange=(e=>{
                    let idequipe = e.target.options[e.target.selectedIndex].value.trim()
               let result =  equipesm.find(eq=>eq.id==idequipe)
               let targetdiv = e.target.closest('div').nextElementSibling
               let medcin=[];
               let infermiere=[];
               let einfo = document.querySelector('.einfo')
               result.equipemember.forEach(e=>{
                if(e?.medecin){
                    medcin.push(e.medecin)
                }
                if(e?.infermiere){
                    infermiere.push(e.infermiere)
                }
            } )
               einfo.innerHTML=`
               <textarea readonly class='form-control' > ${medcin.map(e=>`- medcin : ${ e.Matricule } ${ e.Nom } `)} </textarea>
               `

            })
        }
        </script>
