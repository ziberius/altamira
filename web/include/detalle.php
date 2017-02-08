<form class="form-horizontal" role="form">
    <div class="col-md-6">
        <div class="form-group">
            <label for="inputCodigo" class=" col-lg-3 control-label">Código</label>
            <div class="col-lg-9">
                <input ng-model="inputCodigo" type="text" ng-disabled="true" class="form-control" id="inputCodigo">
            </div>                                    
        </div>
        <div class="form-group">
            <label for="inputCodigo" class=" col-lg-3 control-label">Tipo</label>
            <div class="col-lg-9">
                <input ng-model="inputTipo" type="text" ng-disabled="true" class="form-control" id="inputTipo">
            </div>                                    
        </div>
        <div class="form-group">
            <label for="inputDireccion" class=" col-lg-3 control-label">Dirección</label>
            <div class="col-lg-9">
                <input ng-model="inputDireccion" type="text" ng-disabled="true" class="form-control" id="inputDireccion">
            </div>                                    
        </div>                                
        <div class="form-group">
            <label for="inputComuna" class=" col-lg-3 control-label">Comuna</label>
            <div class="col-lg-9">
                <input ng-model="inputComuna" type="text" ng-disabled="true" class="form-control" id="inputComuna">
            </div>                                    
        </div>                                
        <div class="form-group">
            <label for="inputRegion" class=" col-lg-3 control-label">Región</label>
            <div class="col-lg-9">
                <input ng-model="inputRegion" type="text" ng-disabled="true" class="form-control" id="inputRegion">
            </div>                                    
        </div>                                
        <div ng-show="inputPrecioUf !== '0'" class="form-group">
            <label for="inputPrecioUf" class=" col-lg-3 control-label">Precio UF</label>
            <div class="col-lg-9">
                <input ng-model="inputPrecioUf" type="text" ng-disabled="true" class="form-control" id="inputPrecioUf">
            </div>
        </div>
        <div ng-show="inputPrecioUf !== '0'" class="form-group">
            <label for="inputPrecioClpCalc" class=" col-lg-3 control-label">Precio CLP</label>
            <div class="col-lg-9">
                <input ng-model="inputPrecioClpCalc" type="text" ng-disabled="true" class="form-control" id="inputPrecioClpCalc">
            </div>
        </div>
        <div ng-show="inputPrecioUf === '0'" class="form-group">
            <label for="inputPrecioClp" class=" col-lg-3 control-label">Precio CLP</label>
            <div class="col-lg-9">
                <input ng-model="inputPrecioClp" type="text" ng-disabled="true" class="form-control" id="inputPrecioClp">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="inputConstruido" class=" col-lg-3 control-label">Construido</label>
            <div class="col-lg-9">
                <input ng-model="inputConstruido" type="text" ng-disabled="true" class="form-control" id="inputConstruido">
            </div>                                    
        </div>                            
        <div class="form-group">
            <label for="inputTerreno" class=" col-lg-3 control-label">Terreno</label>
            <div class="col-lg-9">
                <input  ng-model="inputTerreno" type="text" ng-disabled="true" class="form-control" id="inputTerreno">
            </div>
        </div>
        <div class="form-group">
            <label for="inputDormitorios" class=" col-lg-3 control-label">Dormitorios</label>
            <div class="col-lg-9">
                <input ng-model="inputDormitorios" type="text" ng-disabled="true" class="form-control" id="inputDormitorios">
            </div>
        </div>
        <div class="form-group">
            <label for="inputBanos" class=" col-lg-3 control-label">Baños</label>
            <div class="col-lg-9">
                <input ng-model="inputBanos" type="text" ng-disabled="true" class="form-control" id="inputBanos">
            </div>
        </div>
        <div class="form-group">
            <label for="tareaDesc" class=" col-lg-3 control-label">Descripción</label>
            <div class="col-lg-9">
                <textarea  ng-model="inputTareaDesc" ng-disabled="true" class="form-control" rows="5" id="tareaDesc"></textarea>
            </div>
        </div>  
        <div class="form-group">
            <button data-dismiss="modal" data-backdrop="false"  ng-click="compartir()" title="Compartir" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-share" aria-hidden="true"></span></button>
            <button data-dismiss="modal" data-backdrop="false"  ng-click="contacto()" title="Contacto" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-book" aria-hidden="true"></span></button>
            <a ng-href="../../../desk/page/view.php?id={{id_prop}}&print=1" target="popup" onclick="window.open(this.href, this.target, 'width=300,height=300'); return false;">
                <button data-dismiss="modal" title="Imprimir" data-backdrop="false" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>
            </a>
            <button data-dismiss="modal" data-backdrop="false" ng-click="mapa()" title="Ver en mapa" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span></button>
            <button ngclipboard-success="onSuccess(e);" ngclipboard-error="onError(e);" ngclipboard data-clipboard-text="http://www.altamirapropiedades.cl/main/#/view/{{id_prop}}" title="Copiar enlace a portapapeles" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-link" aria-hidden="true"></span></button>
        </div>
    </div>
</form>