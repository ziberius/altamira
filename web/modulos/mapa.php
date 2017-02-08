<!-- about.html -->
<div ng-controller="mapaController">
    <div class="row">
        <div class="col-md-12">
            <div class="input-group-btn" id="adv-search">
                <div class="btn-group" role="group">
                    <select id="selectTipo" style="max-width:150px" class="form-control">
                        <option value="1">Departamento</option>
                        <option value="2">Casa</option>
                        <option value="4">Oficina</option>
                        <option value="-1">Otro</option>
                    </select>   
                    <select id="selectOpe" style="max-width:150px" class="form-control">
                        <option value="1">Venta</option>
                        <option value="2">Arriendo</option>
                    </select>                
                    <input type="text" id="inputBuscar" class="form-control" placeholder="Ej: Avenida del Mar, 2 baños, playa, 1 dormitorio..." />
                    <button type="button" id="btnBuscarProp" ng-click="buscar('avanzado')" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default transparente">
                <div class="panel-heading">
                    <h2 class="panel-title">Encuentra tu propiedad en nuestro mapa</h2>
                </div>
                <div class="panel-body">
                    <div class="col-lg-2" style="color:white">
                        <form>
                            <div class="form-group">
                                <label for="selectMoneda">Moneda</label>
                                <select ng-model="moneda" class="form-control" id="selectMoneda">
                                    <option value="CLP">CLP</option>
                                    <option value="UF">UF</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputDesde">Desde</label>
                                <input id="inputDesde" ng-model="desde" type="number" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="inputHasta">Hasta</label>
                                <input id="inputHasta" ng-model="hasta" type="number" class="form-control" />
                            </div>
                            <button class="btn btn-primary" ng-click="buscar('avanzado')">Buscar</button>
                        </form>
                    </div>
                    <div class="col-lg-10">
                        <ui-gmap-google-map 
                            center='map.center' 
                            zoom='map.zoom'
                            >
                            <ui-gmap-window ng-cloak show="map.window.show" coords="map.window.model" options="map.window.options" closeclick="map.window.closeClick()">
                                <div class="col-sm-6 col-md-5">
                                    <div class="thumbnail" >
                                        <img class="img-rounded" style="height:130px" ng-src="../../../desk/img/propiedad/{{propiedad.id_prop}}/{{propiedad.numero}}.jpeg" alt="...">
                                        <div class="caption">
                                            <p style="font-weight: bold">{{ propiedad.dire | limitTo: 40 }}{{propiedad.dire.length > 40 ? '...' : ''}}</p>
                                            <span ng-show="propiedad.tipoOperacion === '1'"><span style="font-weight: bold">Reseña:</span> {{ propiedad.descrip | limitTo: 90 }}{{propiedad.descrip.length > 90 ? '...' : ''}}</span>
                                            <p><span style="font-weight: bold">Precio:</span>
                                                <span ng-show="{{propiedad.uf !== '0'}}"> {{propiedad.uf}} UF </span>
                                                <span ng-show="{{propiedad.uf === '0'}}">${{propiedad.clp | number}} CLP</span>
                                            </p>
                                            <span ng-show="propiedad.tipoOperacion === '1'"><span style="font-weight: bold">Tamaño:</span> {{propiedad.construido}} m&#178;</span>
                                            <p>{{propiedad.dormitorio}} dormitorio(s) / {{propiedad.ban}} baño(s)</p>
                                            <a ng-click="$parent.$parent.$parent.detalle()">Más info...</a>
                                        </div>
                                    </div>
                                </div>
                            </ui-gmap-window>                
                            <ui-gmap-markers
                                models='markers.coordenadas'
                                options="markers.options"  
                                coords="'self'"
                                events='markers.markersEvents'
                                >

                            </ui-gmap-markers>                
                        </ui-gmap-google-map>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php require_once('../include/modales.php'); ?>

 

</div>
