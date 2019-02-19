@extends('layouts.admin.default')
@section('title', 'Historico de Alertas')

@section('scripts')
@stop

@section('breadcrum')
    <div class="col-md-5 align-self-center">
        <h3 class=" w3-text-black font-bold"> Historico de Alertas </h3>
    </div>

    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('instalador')}}" class="text-warning font-bold">Inicio</a>
            </li>

            <li class="breadcrumb-item">
                <a href="{{route('Alerts.create')}}" class="text-warning font-bold">Historico de Alertas</a>
            </li>
        </ol>
    </div>
@stop

@section('content')
	<table class="w3-table-all w3-hoverable">
		<thead>
			<tr class="w3-orange">
				<th>ID</th>
				<th>Minero ID</th>
				<th>Minero Nombre</th>
				<th>Hash 1D</th>
				<th>Hash 15M</th>
				<th>Hash 1M</th>
				<th>Status</th>
				<th>Created At</th>
			</tr>
		</thead>
		<tbody {{$i=1}}>
			@foreach($alerts as $alert)
				<tr>
					<td> {{$i++}} </td>
					<td> {{$alert->minero_id}} </td>
					<td> {{$alert->minero_nombre}} </td>
					<td> {{$alert->hash_1d}} </td>
					<td> {{$alert->hash_15m}} </td>
					<td> {{$alert->hash_1m}} </td>
					<td> {{$alert->status}} </td>
					<td> {{$alert->created_at}} </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop