@extends("layouts.DashboardLayout")
@section("content")
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<form method="POST" enctype="multipart/form-data"  action="{{route('Patients.update',$patient->id)}}" class="AjouterForm p-4  m-3" style="background-color: #fff;border-radius:5px" >
    @method('PUT')
    @csrf
        <h3 class="text-center" >Modifier Patient</h3>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Numéro</label>
            <input  type="text" value="{{$patient->Numero}}"  required name="Numero" class="form-control" id="exampleFormControlInput1" >
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">CIN</label>
            <input type="text"  value="{{$patient->CIN}}" name="CIN"  required class="form-control" id="exampleFormControlInput1" >
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nom</label>
            <input  type="text"  value="{{$patient->Nom}}" name="Nom" required class="form-control" id="exampleFormControlInput1" >
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Prenom</label>
            <input  type="text"  value="{{$patient->Prenom}}" name="Prenom"  required class="form-control" id="exampleFormControlInput1" >
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Adresse</label>
            <input  type="text"  value="{{$patient->Adresse}}" name="Adresse"  required class="form-control" id="exampleFormControlInput1" >
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tel</label>
            <input  type="text"  value="{{$patient->Tel}}"  name="Tel"  required class="form-control" id="exampleFormControlInput1" >
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input  type="email" value="{{$patient->Email}}"  name="Email"  required class="form-control" id="exampleFormControlInput1" >
          </div>
          <div class="row mb-5 ">
            <div class="col-6">
                <label for="exampleFormControlInput1" class="form-label">CIN RECTO</label>
                <div  style="border: 3px dashed #646161d6;border-radius:5px" >
                <label id="ll"  for="cinrecto">
                    <img src="{{'/storage/'.$patient->cinrecto}}" alt="">
                </label>
                </div>
                <input  name="cinrecto" type="file" id="cinrecto" style="visibility:hidden" >
            </div>
            <div class="col-6">
                <label for="exampleFormControlInput1" class="form-label">CIN VERSO</label>
                <div  style="border: 3px dashed #646161d6;border-radius:5px" >
                <label id="ll" for="cinverso">
                    <img src="{{'/storage/'.$patient->cinverso}}" alt="">
                </label>
                </div>
                <input name="cinverso"  type="file" id="cinverso" style="display: none" >
            </div>
          </div>
          <button class="btn btn-danger ">Enregistrer</button>
        </form>

        <script>
            let files = document.querySelectorAll('input[type="file"]')
            (files)
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
