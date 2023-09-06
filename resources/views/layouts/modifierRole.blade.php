<div class="modal fade" id={{"modifier".$role->id}} tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-body">
            <form action="{{route('Roles.update',$role->id)}}" method="post">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Role</label>
                    <input  type="text" value="{{$role->name}}" name="name"  required class="form-control" id="exampleFormControlInput1" >
                </div>
                <button class="btn btnAj btn-primary" style="width: 100%;background-color:#163dcd"  >Enregistrer</button>
            </form>
        </div>

      </div>
    </div>
  </div>
