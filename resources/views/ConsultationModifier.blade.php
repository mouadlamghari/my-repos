@extends("layouts.DashboardLayout")
@section("content")
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<form method="POST" enctype="multipart/form-data"  action="{{route('Consultations.update',$consultation->id)}}" class="AjouterForm p-4  m-3" style="background-color: #fff;border-radius:5px" >
    @method("PUT")
    @csrf
        <h3 class="text-center my-3" >Ajouter Consultation</h3>
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
            <select required name="patient_id"  id="patient" class="form-select " aria-label=".form-select-lg example">
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
            <textarea  required name="Objet" class="form-control" id="exampleTextarea" rows="4">{{$consultation->Objet}}</textarea>
        </div>
    </div>

    <div class="col-6">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Observation</label>
            <textarea required name="Observation" class="form-control" id="exampleTextarea" rows="4">{{$consultation->Observation}}</textarea>
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


            <div class="col-6 hide  pmedcin ">
                <label for="exampleFormControlInput1" class="form-label">Date </label>
                <input required id="dateconsul"  type="date" name="Date_consultation"  required class="form-control" id="exampleFormControlInput1" >
            </div>

            <div class="col-6 hide pdate">
                <label for="exampleFormControlInput1" class="form-label">Time</label>
            <select required class="form-select "  name="time" aria-label=".form-select-lg example">
                <option selected>Choisir Time</option>
              </select>
             </div>


             @if ($consultation->operation)

            <div class="col-6 op hide">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Equipe</label>
                    <div class="d-flex" >
                    <select name="equipe_id" id="equipe" class="form-select " aria-label=".form-select-lg example">
                        <option   selected>Choisir une Equipe</option>
                        @foreach ($equipes as $equipe )
                        <option @selected($consultation->operation->equipe_id==$equipe->id) value="{{$equipe->id}}"> - {{$equipe->nom}} </option>
                        @endforeach
                    </select>
                    <button  type="button" class="btn btn-warning" ><i class="fa-solid fa-plus"></i></button>
                    </div>
                </div>
            </div>




            <div class="col-6  op hide">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Bloc operation</label>
                    <select name="blocoperation_id" class="form-select " aria-label=".form-select-lg example">
                        <option selected>Choisir un Block</option>
                        @foreach ($blocs as $bloc )
                        <option  @selected($consultation->operation->blocoperation_id==$bloc->id) value="{{$bloc->id}}"> - {{$bloc->id}} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 einfo ">

            </div>

            <div class="col-6 op hide">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Date de Debut</label>
                    <input  value="{{$consultation->operation->DateDebut}}" type="datetime-local" name="DateDebut"   class="form-control" id="exampleFormControlInput1" >
                </div>
            </div>

            <div class="col-6 op hide">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Date de Fin</label>
                    <input value="{{$consultation->operation->DateFin}}"   type="datetime-local" name="DateFin"   class="form-control" id="exampleFormControlInput1" >
                </div>
            </div>

            <div class="mb-3 op hide">
                <label for="exampleFormControlInput1" class="form-label">Operation observation</label>
                <textarea name="ObservationOperation"  class="form-control" id="exampleTextarea" rows="4">{{$consultation->operation->Observation}}</textarea>
            </div>

        </div>
        @endif

          <button type="submit" class="btn btn-danger ">Enregistrer</button>
        </form>


        <script>

            let equipes ={{ Js::from($equipes)}}
            let date ={{ Js::from($consultation->Date_consultation)}}
            let patients ={{ Js::from($patients)}}
            let patientselect = document.querySelector('#patient')
            let inputsdate = document.querySelectorAll('.pmedcin')
            let pselect;
            inputsdate.forEach(item=>{
                item.classList.remove('hide')
                item.querySelector('input').value=date.split(' ')[0]
            })

            pselect = patients.find(e=>e.id==patientselect.value)

            patientselect.onchange=(e)=>{
                let idp = e.target.options[e.target.selectedIndex].value

                if(idp){
                    inputsdate.forEach(item=>item.classList.remove('hide'))
                }
                else{
                    inputsdate.forEach(item=>item.classList.add('hide'))
                }
            }








            let btngenerer = document.querySelector('#generate')
            btngenerer.onclick=(e)=>{
                let data = ['A','B','C',1,2,3,'D','E','F','H','J',5,6,'K','L','M','V',4,,7,9]
                let generatedvalue = data.sort(()=>0.3-Math.random()).splice(0,10).join('')
                let input = e.target.closest('div').firstElementChild
                input.value=generatedvalue
            }



            let operation = document.querySelector('#operation');
            let operationsInputs=document.querySelectorAll('.op')
                if(operation.value.trim()=='operation'){
                    operationsInputs.forEach(operation=>{operation.classList.remove('hide')
                operation.setAttribute('required','required')
                })

                }



            operation.onchange=(e=>{
                (e.target.options[e.target.selectedIndex].value)
                let operationsInputs=document.querySelectorAll('.op')
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


            let equipe = document.querySelector('#equipe')
            if(equipe){

                equipe.onchange=(e=>{
                    let idequipe = e.target.options[e.target.selectedIndex].value.trim()
               let result =  equipes.find(eq=>eq.id==idequipe)
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
        <script src="{{asset('js/CheckDate.js')}}"></script>

@endsection
