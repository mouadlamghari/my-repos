@extends('layouts.DashboardLayout')
@section('content')
<div class="tbl-header">
    <table cellpadding="0" cellspacing="0" border="0" >
        <thead>
          <tr class="p-2"  >
            <th scope="col">#</th>
            <th scope="col">Message</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log )
            <tr>
                <td>
                    {{$log->id}}
                </td>
                <td>
                    {{$log->message}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
