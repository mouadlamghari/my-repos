@extends('layouts.DashboardLayout')
@section('content')

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script>
        let events = {{Js::from($events)}}
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
  <body>
    @push('search')
    <form action="">
        <input type="text" placeholder="search">
    </form>
    @endpush
    <div class="modal fade" id="calendarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body" id='calendar' style="margin-top: 15px;padding:2rem ;background-color:rgb(255, 255, 255);border-radius:6px" >
            </div>
          </div>
        </div>
      </div>


      {{--  --}}

      <div class="tbl-header">
        <button id="addconsultation" class=" btnAjouter show-modal"><i class="fa-solid fa-plus"></i></button>
      <table cellpadding="0" cellspacing="0" border="0" >
        <thead>
          <tr class="p-2  "  >
            <th scope="col">NumeroConsultation</th>
            <th scope="col">Objet</th>
            <th scope="col">Observation</th>
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
            <td>{{$consulatation->Observation}}</td>
            <td>{{$consulatation->Date_consultation}}</td>
            <td>{{$consulatation->TypeCosultation}}</td>
            <td>{{$consulatation->patient->CIN}} - {{$consulatation->patient->Nom}} </td>

            <td>
                <div class="d-flex  ">
                    <a  href="{{route('Consultations.edit',$consulatation->id)}}" class="btn me-1 btn-warning" ><i class="fa-solid fa-pen-to-square"></i></a>
                    <button data-bs-toggle="modal" data-bs-target="#modal{{ $consulatation->id }}" class="detail-consultation text-primary"><i class="fa-solid fa-eye"></i></button>
                </div>
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

  </body>

@endsection
