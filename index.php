<!DOCTYPE html>
<html ng-app="scotchApp" id="htmlTag" >
    <head>
        <meta charset="UTF-8">
        <?php require_once('web/include/head.php'); ?>
        <script>
            function initMap() {
                var uluru = {lat: -20.224, lng: -70.147};
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 16,
                    center: uluru
                });
                var marker = new google.maps.Marker({
                    position: uluru,
                    map: map
                });
            }

            $(window).resize(function () {
                ajustarMargenes();
            });

            $(document).ready(function () {
                ajustarMargenes();
            });
        </script> 
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-83543642-1', 'auto');
            ga('send', 'pageview');

        </script>
        <title>Altamira Propiedades</title>
    </head>
    <body ng-cloak ng-controller="mainController" class="full page {{ pageClass}}">
        <?php require_once('web/include/header.php'); ?> 
        <div id="menuXs" class="menuXs">
            <button class="btn btn-default btn-xs center-block" style="margin-top:20px;" type="button" ng-click="esconderMenu()"><i class="glyphicon glyphicon-arrow-left"></i></button>
            <ul id="ulMenuXs" ng-click="esconderMenu()" class="nav navbar" style="margin-left:20px;">
                <li><a class="selectedItem" href="#/">Altamira</a></li>
                <li><a href="#mapa">Mapa</a></li>
                <li><a href="#servicios">Servicios</a></li>
                <li><a href="#contacto">Contáctanos</a></li>
            </ul>
        </div>
        <div id="main" class="container" >        
            <div ng-view></div>
        </div>
        <?php require_once('web/include/footer.php'); ?> 

        <div id="entregaPropModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Entreganos tu propiedad</h4>
                    </div>
                    <div class="modal-body">        
                        <div class="panel-body">
                            <form ng-submit="submit(contactform)" name="contactform" method="post" class="form-horizontal" role="form">
                                <div class="form-group" ng-class="{
                                        'has-error'
                                                : contactform.inputName.$invalid && submitted }">
                                    <label for="inputName" class="col-lg-2 control-label">Nombre</label>
                                    <div class="col-lg-10">
                                        <input ng-model="formData.inputName" type="text" class="form-control" id="inputName" name="inputName" required>
                                    </div>
                                </div>
                                <div class="form-group" ng-class="{
                                        'has-error': contactform.inputEmail.$invalid && submitted }">
                                    <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                                    <div class="col-lg-10">
                                        <input ng-model="formData.inputEmail" type="email" class="form-control" id="inputEmail" name="inputEmail" required>
                                    </div>
                                </div>
                                <div class="form-group" ng-class="{
                                        'has-error': contactform.inputTelefono.$invalid && submitted }">
                                    <label for="inputTelefono" class="col-lg-2 control-label">Teléfono</label>
                                    <div class="col-lg-10">
                                        <input ng-model="formData.inputTelefono" maxlength="10" type="number" class="form-control" id="inputTelefono" name="inputTelefono">
                                    </div>
                                </div>      
                                <div class="form-group" ng-class="{
                                        'has-error':contactform.inputOperacion.$invalid && submitted}" >
                                    <label for="selectOperacionEntrega" class="col-lg-2 control-label">Operación</label>
                                    <div class="col-lg-10">
                                        <select id="selectOperacionEntrega" name="selectOperacionEntrega" ng-model="formData.inputOperacion" style="max-width:150px" class="form-control">
                                            <option ng-selected="true" value="VENTA">Venta</option>
                                            <option value="ARRIENDO">Arriendo</option>
                                        </select>
                                    </div>
                                </div>                                
                                <div class="form-group" ng-class="{
                                        'has-error'
                                                : contactform.inputSubject.$invalid && submitted }">
                                    <label for="inputSubject" class="col-lg-2 control-label">Asunto</label>
                                    <div class="col-lg-10">
                                        <input ng-model="formData.inputSubject" type="text" class="form-control" id="inputSubject" name="inputSubject" required>
                                    </div>
                                </div>
                                <div class="form-group" ng-class="{
                                        'has-error': contactform.inputMessage.$invalid && submitted }">
                                    <label for="inputMessage" class="col-lg-2 control-label">Mensaje</label>
                                    <div class="col-lg-10">
                                        <textarea ng-model="formData.inputMessage" class="form-control" rows="4" id="inputMessage" name="inputMessage" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button type="submit" class="btn btn-default" ng-disabled="submitButtonDisabled">
                                            Enviar Solicitud
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <p ng-class="result" ng-show="resultMessage" style="padding: 15px; margin: 0;">{{ resultMessage}}</p>
                        </div>  
                    </div>
                </div>
            </div>
        </div>

        <div id="propDestacadasModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg center-block" style="width:80%">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header btn-primary">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Propiedades Destacadas en Venta</h4>
                        <h5>Pincha las propiedades destacadas del mes para ver información adicional.</h5>
                    </div>
                    <div class="modal-body">        
                        <div id="propDestacadas" class="imagenes">
                            <div ng-click="detalle(prop)" style="cursor: pointer" ng-repeat="prop in propaganda">
                                <img title="Ver Detalle" class="galeriaDestacadas img-rounded" ng-src="../../../desk/img/propiedad/{{prop.id_prop}}/{{prop.numero}}.jpeg" />
                                <div class="caption" style="text-align: center">
                                    <p style="font-weight: bold">{{ prop.dire | limitTo: 40 }}{{prop.dire.length > 40 ? '...' : ''}}</p>
                                    <span ng-show="prop.operacion === '1'"><span style="font-weight: bold">Reseña:</span> {{ prop.descrip | limitTo: 90 }}{{prop.descrip.length > 90 ? '...' : ''}}</span>
                                    <p>
                                    <div ng-show="{{prop.uf !== '0'}}"> <span style="font-weight: bold">UF: </span>{{prop.uf}}</div>
                                    <div><span style="font-weight: bold">CLP: </span>$ {{valoruf * prop.uf| number:2}}</div>
                                    <div ng-show="{{prop.uf === '0'}}">${{prop.clp| number}} CLP</div>
                                    </p>                        
                                    <p>{{prop.dormitorio}} dormitorio(s) / {{prop.ban}} baño(s)</p>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>    



    </body>
    
</html>