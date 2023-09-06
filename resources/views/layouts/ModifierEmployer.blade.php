<div id={{"ADD".$employe->id}} class="modal fade"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
    <form method="POST"  action="{{route('Employe.update',$employe->id)}}"   >
            @csrf
            @method("PUT")
            <div   class="AjouterForm p-1  m-3"  >
            <div class="mb-2">
              <label  for="exampleFormControlInput1" class="form-label">Role</label>
              <select required id="role"  name="role_id" class="form-select " aria-label=".form-select-lg example">
                  <option value="" selected>Choisir un Role</option>
                  @foreach ($roles as $role )
                  <option  @selected($role->id==$employe->role_id) value="{{$role->id}}">{{$role->name}}</option>
                  @endforeach
              </select>
           </div>


              <div class="mb-2">
                  <label for="exampleFormControlInput1" class="form-label">Nom</label>
                  <input value='{{$employe->Nom}}'  required type="text" name="Nom"   class="form-control" id="exampleFormControlInput1" >
                </div>

              <div class="mb-2">
                  <label for="exampleFormControlInput1" class="form-label">Prenom</label>
                  <input  value='{{$employe->Prenom}}' required type="text" name="Prenom"   class="form-control" id="exampleFormControlInput1" >
              </div>

              <div class="mb-2">
                  <label for="exampleFormControlInput1" class="form-label">Email</label>
                  <input  value='{{$employe->Email}}'  required type="text" name="Email"   class="form-control" id="exampleFormControlInput1" >
              </div>

              <div class="mb-2">
                  <label for="exampleFormControlInput1" class="form-label">Tele</label>
                  <input value='{{$employe->Tel}}' type="text" name="Tel"   class="form-control" id="exampleFormControlInput1" >
              </div>



          <div class=" hide medecin infermiere "  >
              <div class="mb-2">
                  <label for="exampleFormControlInput1" class="form-label">Services</label>
                  <select     name="service_id" class="form-select " aria-label=".form-select-lg example">
                      <option value="" >Choisir un Role</option>
                      @foreach ($services as $service )
                      <option @selected($service->id==$employe->service_id) value="{{$service->id}}">{{$service->nom}}</option>
                      @endforeach
                  </select>
              </div>
          </div>

              <div class=" hide medecin"  >
              <div class="mb-2">
                  <label for="exampleFormControlInput1" class="form-label">Tarif</label>
                  <input value="{{$employe->Tarif}}"  type="text" name="Tarif"   class="form-control" id="exampleFormControlInput1" >
              </div>
            </div>

            <div class=" hide medecin"  >
              <div class="mb-2">
                  <label for="exampleFormControlInput1" class="form-label">Specialite</label>
                  <input  value="{{$employe->specialite}}"  type="text" name="specialite"   class="form-control" id="exampleFormControlInput1" >
              </div>
            </div>
                  <button type="submit"  style="width: 100%;padding:10px" class="btn btn-danger btnAj ">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
</div>




<script>
    $(document).ready(function () {
        $('form').on('submit', function (e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function (response) {
                    location.reload();
                },
                error: function (xhr, status, error) {
    var errors = JSON.parse(xhr.responseText);
    $.each(errors.errors, function (key, value) {
        var errorMessage = $('<p class="text-danger"></p>').text(value[0]);
        var inputField = $('[name="' + key + '"]');
        inputField.closest('.mb-2').find('.text-danger').remove(); // Remove existing error messages
        inputField.closest('.mb-2').append(errorMessage);
    });
}

            });
        });
    });
</script>




<script src="{{asset('js/modifieremployer.js')}}"></script>
