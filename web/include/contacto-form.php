                        <div ng-controller="contactoController" class="panel-body">
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
