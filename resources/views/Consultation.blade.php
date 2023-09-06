@extends('layouts.DashboardLayout')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<link rel="stylesheet" href="css/result.css">


<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<script>
    let events = {{Js::from($events)}}
    (events)
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridDay'
      },
      events:events,
      height: 500,
      width:500
    });
    calendar.render();
  });

</script>









<div class="modal fade" id="calendarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body" id='calendar' style="margin-top: 15px;padding:2rem ;background-color:rgb(255, 255, 255);border-radius:6px" >
        </div>
      </div>
    </div>
  </div>



@if (session('message'))
<div class="alert alert-success mt-3 " role="alert">
    <script>
    setTimeout(function() {
        Swal.fire({
            icon: 'success',
            title: 'Status message',
            text: 'consulattion cree!',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    }, 1000);
    </script>
@endif

@include('layouts.AjouterConsultation')




@can('search')
<div class="filters mb-3 ">
    <form action="">
        <input type="text" name="medecin"  placeholder="medecin" class="medecin-patient">
    <input type="text"  name="patient" placeholder="patient"  class="medecin-patient">
    <div class="date-filter" >
        date  <input type="date"   name="specific" id="">
    from <input type="date"   name="from" id="">to<input type="date" name="to" id="">
    </div>
    <button>
        <i class="fa-solid fa-magnifying-glass"></i>
    </button>
    </form>

</div>
@endcan

  <div class="tbl-header">
    @can('add-consultation')
    <button id="item" type="button" class="btn btn-primary btnAjouter" data-bs-toggle="modal" data-bs-target="#ajouterconsultation" >
        <i class="fa-solid fa-plus"></i>
    </button>
    @endcan

      <table cellpadding="0" cellspacing="0" border="0" >
    <thead>
      <tr class="p-2 "  style="background-color: #ececec;"  >
        <th scope="col">NumeroConsultation</th>
        <th scope="col">Objet</th>
        <th scope="col">Date_consultation</th>
        <th scope="col">TypeCosultation</th>
        <th scope="col">Patient</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        @foreach ($consultations as $consulatation )

        <th scope="row">{{$consulatation->NumeroConsultation}}</th>
        <td>{{$consulatation->Objet}}</td>
        <td>{{$consulatation->Date_consultation}}</td>
        <td>   @if ($consulatation->TypeCosultation=='operation')
            <span  class="role ADMIN" >
                {{$consulatation->TypeCosultation}}
            </span>
        @else
            <span class="role ASSISTANT" >
                {{$consulatation->TypeCosultation}}
            </span>
        @endif   </td>
        <td>{{$consulatation->patient->CIN}} - {{$consulatation->patient->Nom}} </td>
        <td>
            @can('update', $consulatation)

            <button type="button" class="btn btn-light " data-bs-toggle="modal" data-bs-target={{"#modifier".$consulatation->id}} >
                <i    class=" fa-solid fa-pen-to-square"></i>
            </button>
            @can('add-consultation')

            @if ($consulatation->paiment)
            <a   href="{{route('print',$consulatation->id)}}"  class="btn btn-light "   >
                <i class="fa-solid fa-print"></i>
            </a>
            @else
            <button type="button" class="btn btn-light " data-bs-toggle="modal" data-bs-target={{"#Paiment".$consulatation->id}} >
                <i class="fa-regular fa-credit-card"></i>
            </button>
            @endcan
            @endif
            @endcan

            @include('layouts.AjouterPaiment',['consultation'=>$consulatation])
            @include('layouts.modifierConsultation',['consultation'=>$consulatation,'equipes'=>$equipes,'patients'=>$patients])
        </td>
    </tr>


  <div class="modal fade" id="modal{{ $consulatation->id }}" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail consultation <b>#{{ $consulatation->id }}</b></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body consultation-modal">
            <div>
                <span>Number Consultation</span><span>{{ $consulatation->NumeroConsultation }}</span>
            </div>
            <div>
                <span>Patient</span><span>{{ $consulatation->patient->Nom }}</span>
            </div>
            <div>
                <span>Objet</span><span>{{ $consulatation->Objet }}</span>
            </div>
            <div>
                <span>Number Consultation</span><span>{{ $consulatation->Observation }}</span>
            </div>
            <div>

                <span>Type Consultation</span><span>{{ $consulatation->TypeCosultation }}</span>
            </div>
        </div>

      </div>
    </div>
  </div>

    @endforeach

    </tbody>
</table>
{{$consultations->links()}}
</div>

@endsection
