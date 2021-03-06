<ul class="cb-slideshow">
    <li><span></span></li>
    <li><span></span></li>
    <li><span></span></li>
    <li><span></span></li>
    <li><span></span></li>
</ul>
<div id="divController" ng-controller="userController">
    <div class="alert alert-danger alert-dismissible fade in" role="alert" style="display:none">
        <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
        <strong>Error:</strong><span></span>
    </div>    
    <div class="row resultados">
        <div class="col-md-12">
            <div class="textoBlanco">
                <h1>Encuentra tu hogar aquí</h1>
                <span style="font-size:20px;">Venta y arriendo de casas y departamentos.</span>
            </div>
        </div>
    </div>    
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
    <div class="row" ng-show="total">
        <div class="col-md-12">
            <form class="navbar-form navbar-left paginacion" role="search">
                <div class="form-group">
                    <button class="btn btn-primary btn-xs" ng-disabled="start === 0" type="button" ng-click="anterior()">Mostrar propiedades anteriores</button>
                </div>
                <div class="form-group">
                    <span>Mostrando propiedades {{start + 1}} a {{end}} de un total de {{total}}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-xs" ng-disabled="end === total" type="button" ng-click="siguiente()">Mostrar siguientes propiedades</button>
                </div>
                <div class="form-group" style='border-left:1px solid gray;padding-left:4px'>
                    Mostrar
                    <select ng-model="limit" ng-change="cambioLimite()" class="form-control" id="selLimit">
                        <option value="10">10</option>
                        <option value="50">50</option>
                        <option selected value="100">100</option>
                    </select> propiedades por página
                </div>

            </form>
        </div>
    </div>
    <div class="row">
        <div ng-repeat="propiedad in propiedades| orderBy:'-created'">

            <div class="col-sm-6 col-md-4">
                <div class="thumbnail" ng-click="detalle(propiedad)">
                    <img class="img-rounded" style="height:130px" ng-src="../../../desk/img/propiedad/{{propiedad.id_prop}}/{{propiedad.numero}}.jpeg" alt="...">
                    <div class="caption">
                        <p style="font-weight: bold">{{ propiedad.dire | limitTo: 40  }}{{propiedad.dire.length > 40 ? '...' : ''}}</p>
                        <span ng-show="propiedad.operacion === '1'"><span style="font-weight: bold">Reseña:</span><span data-ng-bind-html="propiedad.descripcion"></span>{{propiedad.descripcion.length > 90 ? '...' : ''}}</span>
                        <p><span style="font-weight: bold">Precio:</span>
                            <span ng-show="{{propiedad.uf !== '0'}}"> {{propiedad.uf}} UF  / $ {{valoruf * propiedad.uf| number:2}}</span>
                            <span ng-show="{{propiedad.uf === '0'}}">${{propiedad.clp| number}} CLP</span>
                        </p>                        
                        <span ng-show="propiedad.operacion === '1' && propiedad.tipo !== '1'"><span style="font-weight: bold">Tamaño:</span> {{propiedad.construido}} m&#178;</span>
                        <span ng-show="propiedad.operacion === '1' && propiedad.tipo === '1'"><span style="font-weight: bold">Construido:</span> {{propiedad.construido}} m&#178;</span>
                        <p>{{propiedad.dormitorio}} dormitorio(s) / {{propiedad.ban}} baño(s)</p>
                    </div>
                </div>
            </div>  
          

        </div>
    </div>
    <div class="row" ng-show="total">
        <div class="col-md-12">
            <form class="navbar-form navbar-left paginacion" role="search">
                <div class="form-group">
                    <button class="btn btn-primary btn-xs" ng-disabled="start === 0" type="button" ng-click="anterior()">Mostrar propiedades anteriores</button>
                </div>
                <div class="form-group">
                    <span>Mostrando propiedades {{start + 1}} a {{end}} de un total de {{total}}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-xs" ng-disabled="end === total" type="button" ng-click="siguiente()">Mostrar siguientes propiedades</button>
                </div>
                <div class="form-group" style='border-left:1px solid gray;padding-left:4px'>
                    Mostrar
                    <select ng-model="limit" ng-change="cambioLimite()" class="form-control" id="selLimit">
                        <option value="10">10</option>
                        <option value="50">50</option>
                        <option selected value="100">100</option>
                    </select> propiedades por página
                </div>

            </form>
        </div>
    </div>

    <?php require_once('../include/modales.php'); ?>

</div>
