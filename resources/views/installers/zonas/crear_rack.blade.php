<!-- Modal Rack -->
<div class="modal fade" id="modalrack" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content" style="border: 1px solid orange">
            <div class="modal-header" style="border-bottom: 1px solid orange">
                <i class="w3-large w3-text-orange mdi mdi-grid"></i>
                <h5 class="modal-title">Crear Nuevo Rack</h5>
                <button type="button" class="close w3-hover-text-red" data-dismiss="modal">&times;</button>
            </div>

            <form method="POST" action="{{route('crear.rack')}}">
                {{csrf_field()}}
                <div class="modal-body w3-container m-b-5">
                    <div class="w3-half" style="padding: 3px; border-right: 1px solid yellow;">
                    <label class="form-group" style="width: 90%;" for="identificador"> Identificador :<br>
                        <input type="text" required="required" name="rack" class="form-control form-control-sm" placeholder="Nombre" autocomplete="off" value="{{old('rack')}}">
                    </label><br>
                                    
                    <label class="form-group" style="width: 100%;" for="ubicacion"> Ubicación :<br>
                        <select class="w3-select selectpicker" name="area_id" required="required" data-live-search="true">
                            <option value="" selected="selected" disabled="disabled" >Areas</option>
                            @if($areas)
                                @foreach($areas as $area)
                                    <option value="{{$area->id}}"> {{$area->area}} </option>
                                @endforeach
                            @endif
                        </select>
                    </label>
                    </div>

                    <div class="w3-half" style="padding: 3px;border-left: 1px solid yellow;">
                        <label class="form-group w3-half">
                            Filas : <br>
                            <input class="form-control form-control-sm" type="number" id="filas" name="filas" oninput="dibujarack()" min="1" max="20" required="required" value="{{old('filas')}}">
                        </label>

                        <label class="form-group w3-half">
                            Columnas : <br>
                            <input class="form-control form-control-sm" type="number" id="columnas" name="columnas" oninput="dibujarack()" min="1" max="20" required="required" value="{{old('columnas')}}">
                        </label>

                        <table style="width: 100%" class="w3-border-blue w3-table-all w3-hoverable m-t-5" border="1" id="paintrack">
                            
                        </table>
                    </div>
                </div>

                <div class="modal-footer w3-container" style="border-top: 1px solid orange; padding: 5px 5px 5px 0px;">
                    <button class="btn btn-info fa fa-plus"> Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fin Modal -->