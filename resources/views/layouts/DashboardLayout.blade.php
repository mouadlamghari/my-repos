<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/index.min.js" integrity="sha512-xCMh+IX6X2jqIgak2DBvsP6DNPne/t52lMbAUJSjr3+trFn14zlaryZlBcXbHKw8SbrpS0n3zlqSVmZPITRDSQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="{{asset('css/s.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="{{asset('table.css')}}"  >
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous" defer></script>


    <div class="DashbordMain  ">

        <div class="sidebar">
            <div class="toggle"><i class="fa-solid fa-chevron-left"></i></div>
            <div class="top-part">
                <div style="background-image: url('images/147131.png')" class="avatar">
                    <img src="images/147131.png" style="width:100%" alt="">
                </div>
                <div class="name-job">
                    <span>{{request()->user()->name}}</span><span class="job">{{ auth()->user()->role->name}}</span>
                </div>

            </div>
            <div class="bottom-part">
                <span class="sidebar-links">

            @can("view-patient")
            <a  @class(["active"=>request()->is("Patients"),"link"=>true])  href="/Patients">
                <i class="fa-solid fa-head-side-cough"></i>
                <span class="name" > Patients</span>
            </a>
            @endcan

            @can('add-consultation')
            <a  @class(["active"=>request()->is("Paiments"),"link"=>true])  href="/Paiments">
                <i class="fa-solid fa-file-invoice-dollar"></i>
                <span class="name" > Paiments</span>
            </a>
            @endcan



            @can("view-consultation")
            <a @class(["active"=>request()->is("Consultations"),"link"=>true]) href="/Consultations"  class="link">
                <i class="fa-regular fa-calendar-check"></i>
                <span class="name" > Consultations</span>
            </a>
             @endcan




             @can('manage-employe')

            <a  href="/Roles"  @class(["active"=>request()->is("Roles"),"link"=>true]) >
                <i class="fa-solid fa-users"></i>
                <span class="name" > Roles</span>
            </a>

            <a  href="/Employe"   @class(["active"=>request()->is("Employe"),"link"=>true])   >
                <i class="fa-solid fa-hospital-user"></i>
                <span class="name" > Employé</span>
            </a>

            <a  href="/Statistiques"   @class(["active"=>request()->is("Statistiques"),"link"=>true])  class="link">
                <i class="fa-solid fa-chart-line"></i>
                <span class="name" > Statistiques</span>
            </a>

            <a  href="/Services"   @class(["active"=>request()->is("Services"),"link"=>true]) class="link">
                <i class="fa-solid fa-hospital"></i>
                <span class="name" > Services</span>
            </a>

            <a  href="/Logs"  @class(["active"=>request()->is("Logs"),"link"=>true])  class="link">
                <i class="fa-solid fa-list"></i>
                <span class="name" > Logs</span>
            </a>
            @endcan
        </span>
        <span class="logout-wrapper">

            <form  action="{{ route("logout") }}"  method="post">
                @csrf
                <button class="logout link">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span class="name" > logout </span>
                </button>
            </form>
        </span>
        </div>
        </div>

        <div class="WrapperAdmim">


        <div class="navigation_bar">
        <div class="InputSearch">
            <i class="fa-solid fa-magnifying-glass"></i>
            <form action="{{route('search')}}">
                <input type="text" name="query" placeholder="recherche patient , consultation " >
            </form>
        </div>

        <div class="actionsDashboard">

            @can('show-calender')
            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#calendarModal">
                <i class="fa-solid fa-calendar-days"></i>
            </button>
            @endcan

        </div>
        </div>

        <div class="content">

            @yield('content')

        </div>


        </div>


        </div>

        <script>

            const sidebar = document.querySelector(".sidebar")
            const toggle = document.querySelector(".toggle")
            const names = document.querySelectorAll(".name")
            const nameJob = document.querySelector(".name-job")
            const avatar = document.querySelector(".avatar")
            const content = document.querySelector(".wrapperAdmim")

            (names)
            fullSize = true

            toggle.addEventListener("click",()=>{

                if(fullSize){
                    sidebar.style.width = "60px"
                    names.forEach(name=>{
                        (name)
                        name.classList.toggle("hide")
                    })
                    avatar.style.width = "30px";
                    avatar.style.height = "30px";
                    toggle.innerHTML='<i class="fa-solid fa-chevron-right"></i>'
                    content.style.width = "90%"

                }else{
                    names.forEach(name=>{
                        (name)
                        name.classList.toggle("hide")
                    })
                    sidebar.style.width="20%"
                    avatar.style.width = "40px";
                    avatar.style.height = "40px";
                    toggle.innerHTML='<i class="fa-solid fa-chevron-left"></i>'
                    content.style.width = "80%"
                }
                nameJob.classList.toggle("hide")



                fullSize = !fullSize
            })

        </script>
