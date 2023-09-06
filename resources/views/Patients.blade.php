@extends('layouts.DashboardLayout')
@section("content")

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



{{-- @if (session('success'))
<script>
    setTimeout(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success Message',
                    text: "{{$session('success')}}"",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
            }, 500);
</script>
@endif --}}



{{-- @if (session('message'))
<div class="alert alert-success mt-3 " role="alert">
    {{session('message')}}
  </div>

@endif
 --}}



@push("search")
  <form action="">
    <input type="text" placeholder="search">
  </form>
@endpush
<div class="d-flex  justify-content-between  align-items-center p-2  my-2">

     @can('add-patient')
     <button id="zer" type="button" class="btn btn-primary btnAjouter" data-bs-toggle="modal" data-bs-target="#ajouterpatient" >
        <i class="fa-solid fa-plus"></i>
    </button>
     @endcan

</div>
<div class="modal fade" id="ajouterpatient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content  p-4 ">
            <form method="POST" enctype="multipart/form-data"  action="{{route('Patients.store')}}" class="AjouterForm" style="background-color: #fff;border-radius:5px" >
    @csrf
    <div class="col-12 ">
    <label for="exampleFormControlInput1" class="form-label">Medecin</label>
    <select required class="form-select form-select-sm" name="employe_id" >
        <option value="">Choisir Medecin</option>
        @foreach ($medecins as $medecin)
        <option value="{{$medecin->id}}">{{$medecin->Matricule}} - {{$medecin->Nom}}</option>
        @endforeach
      </select>
     </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">CIN</label>
            <input  type="text"  value="{{old('CIN')}}" name="CIN"  required class="form-control form-control-sm " id="exampleFormControlInput1" >
            <p class="text-danger" >@error('CIN') {{$message}} @enderror</p>
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nom</label>
            <input  type="text" name="Nom"  value="{{old('Nom')}}" required class="form-control  form-control-sm" id="exampleFormControlInput1" >
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Prenom</label>
            <input  type="text" name="Prenom"  value="{{old('Prenom')}}" required class="form-control  form-control-sm" id="exampleFormControlInput1" >
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Adresse</label>
            <input  type="text" name="Adresse" value="{{old('Adresse')}}"  required class="form-control  form-control-sm" id="exampleFormControlInput1" >
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tel</label>
            <input  type="text" name="Tel" value="{{old('Tel')}}"  required class="form-control form-control-sm" id="exampleFormControlInput1" >
            <p class="text-danger" >@error('Tel') {{$message}} @enderror</p>
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input  type="email" name="Email" value="{{old('Email')}}" required class="form-control form-control-sm" id="exampleFormControlInput1" >
            <p class="text-danger" >@error('Email') {{$message}} @enderror</p>
          </div>
          <div class="row mb-1 ">
            <div class="col-6" class="cin">
                <label for="exampleFormControlInput1" >CIN RECTO</label>
                <div class="upload-icon-holder"  style="border: 3px dashed #646161d6;border-radius:5px" >
                <label id="ll"  for="cinrecto"><i    class="fa-solid fa-cloud-arrow-up icon-upload"></i></label>
                </div>
                <input  name="cinrecto" type="file" id="cinrecto" style="visibility:hidden" >
            </div>
            <div class="col-6" class="cin">
                <label for="exampleFormControlInput1" >CIN VERSO</label>
                <div class="upload-icon-holder"  style="border: 3px dashed #646161d6;border-radius:5px" >
                <label id="ll" for="cinverso"><i    class="fa-solid fa-cloud-arrow-up icon-upload"></i></label>
                </div>
                <input name="cinverso"  type="file" id="cinverso" style="display: none" >
            </div>
          </div>
          <button style="width: 100%;padding:10PX" class="btn btn-danger btnAj ">Enregistrer</button>
        </form>

</div>
    </div>
  </div>
<section>

  <div class="tbl-header">
    <table cellpadding="0" cellspacing="0" border="0">
      <thead>
        <tr  style="background-color: #ececec;"  >
        <th>#</th>
        <th>CIN</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Adresse</th>
        <th>Tel</th>
        <th>Email</th>
        <th>Action</th>
        </tr>
      </thead>

  </div>



      <tbody>
      <tr>
        @foreach ($patients as $patient )

        <th>{{$patient->id}}</th>
        <td>{{$patient->CIN}}</td>
        <td>{{$patient->Nom}}</td>
        <td>{{$patient->Prenom}}</td>
        <td>{{$patient->Adresse}}</td>
        <td>{{$patient->Tel}}</td>
        <td>{{$patient->Email}}</td>
        <td class="actions">
                @can('update', $patient)
                <button data-bs-toggle="modal" data-bs-target="#modifier{{$patient->id}}" class="custom-button" ><i class="fa-solid fa-pen-to-square"></i></button>
                @include('layouts.ModifierPatient',['patient'=>$patient])
                @endcan
    </tr>
    @endforeach



      </tbody>

    </table>
    {{$patients->links()}}

  </div>
</section>



</table>


@if ($errors->any())
<script>
    let ppp = document.querySelector('#zer');
    ppp.click();
</script>
@endif









<script>
    $(document).ready(function() {
        $('form').on('submit', function(event) {
            event.preventDefault();

            var form = $(this);
            var formData = new FormData(form[0]);
            var url = form.attr('action');

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                },
                error: function(xhr, status, error) {
                    var errors = JSON.parse(xhr.responseText);
                    $('.mb-3 p.text-danger').remove();
                    $.each(errors.errors, function(key, value) {
                         $('[name="' + key + '"]').closest('.mb-3').append('<p class="text-danger">' + value[0] + '</p>');
                    });
                }
            });
        });
    });
    </script>















<script>
const closeModalButtons = document.querySelectorAll(".close-modal")
const modals = document.querySelectorAll(".modal-holder")
const showModals = document.querySelectorAll(".show-modal")

closeModalButtons.forEach(close=>{
    close.addEventListener("click",()=>{
    modals.forEach(modal=>{
        if(modal.id==close.id){
            modal.classList.add('hide')
        }
    })

})})

showModals.forEach(showModal=>{
    showModal.addEventListener('click',()=>{
        modals.forEach(modal=>{
            if(modal.id==showModal.id){
                modal.classList.remove("hide")
            }
        })
})
})

let files = document.querySelectorAll('input[type="file"]')
            files.forEach(file=>file.onchange=(e)=>{
                let url = URL.createObjectURL(e.target.files[0])
                let thumb = file.closest('div').querySelector('#ll')
                thumb.innerHTML='';
                let img = document.createElement('img')
                img.setAttribute('src',url)
                thumb.append(img)
    })

</script>

@endsection
