<div class="modal fade" id="Paiment{{$consultation->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-body">
            <form action="{{route('paiment',['consultation_id'=>$consultation->id])}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Type Paiment</label>
                    <select required name="typepaiment_id"  id="paimenttype" class="form-select " aria-label=".form-select-lg example">
                        <option value="" selected>Choisir Type paiment</option>
                        @foreach (App\Models\Typepaiment::all() as $type )
                        <option value="{{$type->id}}">{{$type->typepaiment}} </option>
                        @endforeach
                      </select>
                </div>

                    </div>

                <div class="col-6 ">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Montant</label>
                        <input required  value="{{$consultation->TypeCosultation=='Consultationgénéral'?$consultation->patient->medecin->Tarif:$consultation?->operation?->Typeoperation?->prix}}" type="text" name="Montant"   class="form-control" id="exampleFormControlInput1" >
                    </div>
                </div>

                <div class="col-6  Pai  hide CHECK ">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Numero check</label>
                        <input required type="text" name="numerocheck" class="form-control" id="exampleFormControlInput1" >
                    </div>
                </div>

                <div class="col-6 hide Pai CHECK ">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Date demission</label>
                        <input required  type="date" name="date_demission" class="form-control" id="exampleFormControlInput1" >
                    </div>
                </div>

                <div class="col-6  Pai DEPOT hide ">
                    <div class="mb-3 ">
                        <label for="exampleFormControlInput1" class="form-label">Transaction</label>
                        <input required value="" type="text" name="transaction"   class="form-control" id="exampleFormControlInput1" >
                    </div>
                </div>

                <div class="col-6  Pai DEPOT hide ">
                    <div class="mb-3 ">
                        <label for="exampleFormControlInput1" class="form-label">date depot</label>
                        <input required  value="" type="date" name="date_depot"   class="form-control" id="exampleFormControlInput1" >
                    </div>
                </div>




            </div>


                <button class="btn btnAj btn-primary" style="width: 100%;background-color:#163dcd"  >Enregistrer</button>
            </form>
        </div>

      </div>
    </div>
  </div>


  <script>



var select = document.querySelectorAll('#paimenttype');
select.forEach(element => {
        element.onchange=(e)=>{
            (element.value)
            e.target.closest('.modal-content').querySelectorAll('.Pai').forEach(d=>d.classList.add('hide'));
            e.target.closest('.modal-content').querySelectorAll('.Pai').forEach(d=>d.querySelector('input').removeAttribute('required'));
            if(element.value=='3'){
                e.target.closest('.modal-content').querySelectorAll('.DEPOT').forEach(d=>d.classList.remove('hide'));
                e.target.closest('.modal-content').querySelectorAll('.DEPOT').forEach(d=>d.querySelector('input').setAttribute('required','required'));
            }
            if(element.value=='2'){
                e.target.closest('.modal-content').querySelectorAll('.CHECK').forEach(d=>d.classList.remove('hide'));
                e.target.closest('.modal-content').querySelectorAll('.CHECK').forEach(d=>d.querySelector('input').setAttribute('required','required'));
            }
        }
});





  </script>
