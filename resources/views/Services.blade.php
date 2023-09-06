@extends('layouts.DashboardLayout')
@section('content')
<div class=" mt-5 tbl-header">

    <button type="button" class="btn btn-primary btnAjouter" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa-solid fa-plus"></i>
      </button>

      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-body">
                <form action="{{route('Services.store')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nom Service</label>
                        <input  type="text"  name="nom"  required class="form-control" id="exampleFormControlInput1" >
                    </div>
                    <button class="btn btnAj btn-primary" style="width: 100%;background-color:#163dcd"  >Enregistrer</button>
                </form>
            </div>

          </div>
        </div>
      </div>


      <table cellpadding="0" cellspacing="0" border="0">

        <thead>
          <tr   style="background-color: #ececec;" >
          <th>Id</th>
          <th>Service</th>
          </tr>
        </thead>
    <tbody>
        @foreach ($services as $service )
        <tr>
            <td>{{$service->nom}}</td>
            <td>
                <div class="btn btn-light"  data-bs-toggle="modal" data-bs-target={{"#modifier".$service->id}}><i class="fa-regular fa-pen-to-square"></i></div>
            </td>
            @include('layouts.modifierServices',['service'=>$service])
        </tr>
        @endforeach
    </tbody>
</table>
</div>


@endsection
