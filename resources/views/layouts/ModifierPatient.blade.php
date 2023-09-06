<div class="modal fade" id="modifier{{$patient->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3 ">
            <form method="POST" enctype="multipart/form-data"  action="{{route('Patients.update',$patient->id)}}" class="AjouterForm" style="background-color: #fff;border-radius:5px" >
    @csrf
    @method('PUT')
    <div class="col-12 ">
        <label for="exampleFormControlInput1" class="form-label">Medecin</label>
        <select required class="form-select form-select-sm" name="employe_id"  aria-label=".form-select-lg example">
            <option value="">Choisir Medecin</option>
            @foreach ($medecins as $medcin)
            <option  @selected($patient->employe_id==$medcin->id) value="{{$medcin->id}}">{{$medcin->Matricule}} - {{$medcin->Nom}}</option>
            @endforeach
          </select>
         </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">CIN</label>
            <input  type="text" name="CIN" value="{{$patient->CIN}}"  required class="form-control form-select-sm " id="exampleFormControlInput1" >
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nom</label>
            <input  type="text" name="Nom"  value="{{$patient->Nom}}"  required class="form-control form-select-sm " id="exampleFormControlInput1" >
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Prenom</label>
            <input  type="text" name="Prenom"  value="{{$patient->Prenom}}"  required class="form-control form-select-sm " id="exampleFormControlInput1" >
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Adresse</label>
            <input  type="text" name="Adresse"  value="{{$patient->Adresse}}"  required class="form-control form-select-sm " id="exampleFormControlInput1" >
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tel</label>
            <input  type="text" name="Tel"  value="{{$patient->Tel}}"  required class="form-control form-select-sm " id="exampleFormControlInput1" >
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input  type="email" name="Email"  value="{{$patient->Email}}" required class="form-control form-select-sm " id="exampleFormControlInput1" >
          </div>
          <div class="row mb-1 ">
            <div class="col-6" class="cin">
                <label for="exampleFormControlInput1" >CIN RECTO</label>
                <div class="upload-icon-holder"  style="border: 3px dashed #646161d6;border-radius:5px" >
                <label id="ll"  for="cinrecto"><img  src="storage/{{$patient->cinrecto}}"  /></label>
                </div>
                <input  name="cinrecto"   type="file" id="cinrecto" style="visibility:hidden" >
            </div>
            <div class="col-6" class="cin">
                <label for="exampleFormControlInput1" >CIN VERSO</label>
                <div class="upload-icon-holder"  style="border: 3px dashed #646161d6;border-radius:5px" >
                <label id="ll" for="cinverso"><img src="storage/{{$patient->cinverso}}"   /></label>
                </div>
                <input name="cinverso"  type="file" id="cinverso" style="display: none" >
            </div>
          </div>
          <button style="width: 100%;padding:10PX" class="btn btn-danger btnAj ">Enregistrer</button>
        </form>

</div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
        $('form').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    var errors = JSON.parse(xhr.responseText);

                    $.each(errors.errors, function(key, value) {
                        $('[name="' + key + '"]').closest('.mb-3').append('<p class="text-danger">' + value[0] + '</p>');
                    });
                }
            });
        });
    });
</script>
