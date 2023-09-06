<div class="modal fade" id={{"modifier".$service->id}} tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-body">
            <form action="{{route('Services.update',$service->id)}}" method="post">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nom Service</label>
                    <input  type="text" value="{{$service->nom}}" name="nom"  required class="form-control" id="exampleFormControlInput1" >
                </div>
                <button class="btn btnAj btn-primary" style="width: 100%;background-color:#163dcd"  >Enregistrer</button>
            </form>
        </div>

      </div>
    </div>
  </div>
