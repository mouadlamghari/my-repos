@extends('layouts.DashboardLayout')
@section("content")
<link rel="stylesheet" href="{{asset('css/result.css')}}"  >

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



<div class="content">

    <div class="filters">
        <form action="">

            <span>
                Filters:
        <select name="type" id="type">
            <option value="all">
                All
            </option>
            <option value="patients">
                Patients
            </option>
            <option value="medecin">
                Medecin
            </option>

        </select>
    </span>
    <button  >Filter</button>
</form>
    </div>
    <div class="result">

        @if (count($employes)==0 && count($patients)==0)
            <h1>Ya pas de resultat</h1>
        @endif

        @foreach ($employes as $employe )
        <div class="peopleCard">
            <div class="avatar-info">

                <div class="avatar"></div>
                <div class="info">
                    <span>{{$employe->Nom }}  {{$employe->Prenom}}</span>
                    <span class="job">{{$employe->role->name}}</span>
                </div>
            </div>
            <span>details</span>
        </div>
        @endforeach

        @foreach ( $patients as $patient )
        <div class="peopleCard">
            <div class="avatar-info">

                <div class="avatar"></div>
                <div class="info">
                    <span>{{$patient->Nom}}</span>
                    <span class="job">Patient</span>
                </div>
            </div>
            <span>details</span>
        </div>
        @endforeach



    </div>

</div>
<script>
    const select = document.querySelector("#type")
    const dateFilter = document.querySelector(".date-filter")

    select.addEventListener("change",()=>{
        if(select.value==="consultations"){
            dateFilter.classList.remove("hide")

        }else{
            dateFilter.classList.add("hide")
        }
    })
</script>
@endsection
