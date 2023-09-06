@extends('layouts.DashboardLayout')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<style>
    .hide{
        display: none;
    }
    .avatar{
        display: flex;
        align-items: center;
        gap:10px;
    }
    .avatar img{
        width:40px;

    }
</style>


@if (session('success'))
<script>
    ('fff')
    setTimeout(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Message success',
                    text: "{{session('success')}}",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
            }, 500);
</script>


@endif




<div class="tbl-header  mt-4">
    <button type="button" class="btn btn-primary btnAjouter" data-bs-toggle="modal" data-bs-target="#exampleModal" ><i class="fa-solid fa-plus"></i></button>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content  p-3 container">
      <form method="POST" enctype="multipart/form-data"  action="{{route('Employe.store')}}" class="AjouterForm " style="background-color: #fff;border-radius:5px" >
          @csrf

          <div class='error-message'>
          </div>

          <div class="mb-2">
            <label  for="exampleFormControlInput1" class="form-label">Role</label>
            <select required id="role"  name="role_id" class="form-select " aria-label=".form-select-lg example">
                <option value="" selected>Choisir un Role</option>
                @foreach ($roles as $role )
                <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>
         </div>


            <div class="mb-2">
                <label for="exampleFormControlInput1" class="form-label">Nom</label>
                <input required type="text" name="Nom"   class="form-control" id="exampleFormControlInput1" >
              </div>

            <div class="mb-2">
                <label for="exampleFormControlInput1" class="form-label">Prenom</label>
                <input required type="text" name="Prenom" class="form-control" id="exampleFormControlInput1" >
            </div>

            <div class="mb-2">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input required type="text" name="Email"   class="form-control" id="exampleFormControlInput1" >
            </div>

            <div class="mb-2">
                <label for="exampleFormControlInput1" class="form-label">Tele</label>
                <input required type="text" name="Tel"   class="form-control" id="exampleFormControlInput1" >
            </div>


        <div class=" hide medecin infermiere "  >
            <div class="mb-2">
                <label for="exampleFormControlInput1" class="form-label">Services</label>
                <select   name="service_id" class="form-select " aria-label=".form-select-lg example">
                    <option value="" >Choisir un Services</option>
                    @foreach ($services as $service )
                    <option value="{{$service->id}}">{{$service->nom}}</option>
                    @endforeach
                </select>
            </div>
        </div>

            <div class=" hide medecin"  >
            <div class="mb-2">
                <label for="exampleFormControlInput1" class="form-label">Tarif</label>
                <input  type="text" name="Tarif"   class="form-control" id="exampleFormControlInput1" >
            </div>
        </div>

            <div class=" hide medecin"  >
            <div class="mb-2">
                <label for="exampleFormControlInput1" class="form-label">Specialite</label>
                <input  type="text" name="specialite"   class="form-control" id="exampleFormControlInput1" >
            </div>
        </div>


                <button style="width: 100%;padding:10px" class="btn btn-danger btnAj ">Enregistrer</button>
            </form>

      </div>
        </div>
    </div>
    <table cellpadding="0" cellspacing="0" border="0">
      <thead>
        <tr  style="background-color: #ececec;">
        <th>Name</th>
        <th>Prenom</th>
        <th>Type</th>
        <th>Tel</th>
        <th>Action</th>
        </tr>
      </thead>

  </div>



      <tbody>


        @foreach ($employes as $employe )
        <tr>
            <td  >
                <div class="avatar">
                    <img src="{{asset('images/147131.png')}}" alt="" >
                    {{$employe->Nom}}
                </div>
            </td>
            <td>
                {{$employe->Prenom}}
            </td>
            <td>
                <span class="role {{ $employe->role->name=='MEDECIN'?'MEDECIN-CARD':$employe->role->name}}">

                    {{$employe->role->name}}
                </span>
            </td>
            <td>
                {{$employe->Tel}}
            </td>
            <td>
                <button type="button" class="btn btn-light " data-bs-toggle="modal" data-bs-target={{"#ADD".$employe->id}} ><i class="fa-regular fa-pen-to-square"></i></button>
                <button class="btn delete-article  btn-light"  data-id="{{ $employe->id }}" type="button"><i class="fa-solid fa-trash"></i></button>
            </td>
        </tr>
        @include('layouts.ModifierEmployer',['employe'=>$employe])
        @endforeach

      </tbody>

    </table>
    {{$employes->links()}}
  </div>
<script src="{{asset('js/employer.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-article');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const employe = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/Employe/${employe}`,{method:'DELETE',withCredentials:'include',headers:{'X-CSRF-TOKEN':document.querySelector('input[name="_token"]').value}})
                             .then(response => {
                                 Swal.fire(
                                     'Deleted!',
                                     'Your article has been deleted.',
                                     'success'
                                 ).then(()=>{
                                    location.reload()
                                 });

                             })
                             .catch(error => {
                                 Swal.fire(
                                     'Error!',
                                     'An error occurred while deleting the article.',
                                     'error'
                                 );
                             });
                    }
                });
            });
        });
    });
</script>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.AjouterForm').on('submit', function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('Employe.store') }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    (response);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    $('.error-message').html('')
                    (xhr.responseText);
                    var errors = JSON.parse(xhr.responseText);
                    (errors)
                    $.each(errors.errors, function(key, value) {
                        $('.error-message').html('')
                        $('.error-message').append(`<p class='text-danger'>${value}</p>`);
                        });
                }
            });
        });
    });
</script>










@endsection
