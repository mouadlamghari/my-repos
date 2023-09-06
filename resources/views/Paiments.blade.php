@extends('layouts.DashboardLayout')
@section('content')
<div class=" mt-5 tbl-header">
    <table cellpadding="0" cellspacing="0" border="0">
        <thead>
          <tr   style="background-color: #ececec;" >
          <th>Paiment ID</th>
          <th>Montant</th>
          <th>Type</th>
          <th>Status</th>
          <th>Actions</th>
          </tr>
        </thead>
    <tbody>
        @foreach ($paiments as  $paiment )
            <tr>
                <td>{{$paiment->id}}</td>
                <td>{{$paiment->Montant}}</td>
                <td>{{$paiment->mode->typepaiment}}</td>
                <td>{{$paiment->status}}</td>
                @if (!in_array($paiment->status,['Rejected','Confirme']))
                <td>
                    <div class="d-flex">
                        <form action="{{route('validate',$paiment->id)}}" method="post">
                        @csrf
                        <button class="btn bg-light ">
                            <i class=" text-success  fa-solid fa-check"></i>
                        </button>
                        </form>
                </div>
                </td>
                @endif
            </tr>
        @endforeach
    </tbody>
    </table>
</div>

@endsection
