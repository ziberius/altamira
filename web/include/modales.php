

    <div ng- id="detallePropiedad" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{inputTitulo}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php include("galeria.php"); ?>
                        </div>
                    </div>
                    <div class="row">
                        <?php include("detalle.php"); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <div style="text-align:left">
                        {{datosContacto1}}<br />
                        {{datosContacto2}}<br />
                        {{datosContacto3}}<br />
                    </div>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>

        </div>
    </div>   

    <div id="compartirModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Comparte esta propiedad con tus cercanos</h4>
                </div>
                <div class="modal-body">        
                    <div class="panel-body">
                        <form id="compartirForm" ng-submit="submit(contactform)" name="contactform" method="post" class="form-horizontal" role="form">
                            <div class="form-group" ng-class="{
                            'has-error'
                            : contactform.inputName.$invalid && submitted }">
                                <label for="inputName" class="col-lg-3 control-label">Nombre</label>
                                <div class="col-lg-9">
                                    <input placeholder="Ej:Danilo Simonetti" ng-model="formData.inputName" type="text" class="form-control" id="inputName" name="inputName" required>
                                </div>
                            </div>
                            <div class="form-group" ng-class="{
                            'has-error': contactform.inputEmail.$invalid && submitted }">
                                <label for="inputEmail" class="col-lg-3 control-label">Email Remitente</label>
                                <div class="col-lg-9">
                                    <input  placeholder="Ej:mi.mail@gmail.com" ng-model="formData.inputRemitente" type="email" class="form-control" id="inputEmail" name="inputEmail" required>
                                </div>
                            </div>
                            <div class="form-group" ng-class="{
                            'has-error': contactform.inputEmail.$invalid && submitted }">
                                <label for="inputEmail" class="col-lg-3 control-label">Email Destinatario</label>
                                <div class="col-lg-9">
                                    <input placeholder="Ej:mi.amigo@gmail.com" ng-model="formData.inputDestinatario" type="email" class="form-control" id="inputEmail" name="inputEmail" required>
                                </div>
                            </div>
                            <div class="form-group" ng-class="{
                            'has-error'
                            : contactform.inputSubject.$invalid && submitted }">
                                <label for="inputSubject" class="col-lg-3 control-label">Asunto</label>
                                <div class="col-lg-9">
                                    <input ng-model="formData.inputSubject" type="text" class="form-control" id="inputSubject" name="inputSubject" required>
                                </div>
                            </div>
                            <div class="form-group" ng-class="{
                            'has-error': contactform.inputMessage.$invalid && submitted }">
                                <label for="inputMessage" class="col-lg-3 control-label">Mensaje</label>
                                <div class="col-lg-9">
                                    <textarea  ng-model="formData.inputMessage" class="form-control" rows="4" id="inputMessage" name="inputMessage" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12 center-block">
                                    <button type="submit" class="btn btn-default" ng-disabled="submitButtonDisabled">
                                        Enviar
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