<script>
    initMap();
</script>
<div class="row">
    <div class="col-lg-6">
        <div>
            <div class="panel panel-default transparente">
                <div class="panel-heading">
                    <h2 class="panel-title">Mapa</h2>
                </div>
                <div class="panel-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>
        <div>
            <div class="panel panel-default transparente">
                <div class="panel-heading">
                    <h2 class="panel-title">Datos de Contacto</h2>
                </div>
                <div class="panel-body" style="background-color:black;color:white">
                    <p>Mesa Central <a href="tel:+572265280">(+572) 265280</a></p>
                    <p>Ventas: <a href="tel:572265288">(+572) 265288</a> / <a href="tel:998852750">9 9885 27 50</a> / <a href="tel:994175793">9 9417 57 93</a></p>
                    <p>Arriendos: <a href="tel:+572532860">(+572) 532860</a> / <a href="tel:991595769">9 9159 57 69</a> / <a href="tel:981395357">9 8139 53 57</a></p>
                </div>
            </div>            
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default transparente">
            <div class="panel-heading">
                <h2 class="panel-title">Formulario de Contacto</h2>
            </div>
            <div ng-controller="contactoController" class="panel-body">
                <form ng-submit="submit(contactform)" name="contactform" method="post" class="form-horizontal" role="form">
                    <div class="form-group" ng-class="{ 'has-error': contactform.inputName.$invalid && submitted }">
                        <label for="inputName" class="col-lg-2 control-label">Nombre</label>
                        <div class="col-lg-10">
                            <input ng-model="formData.inputName" type="text" class="form-control" id="inputName" name="inputName" required>
                        </div>
                    </div>
                    <div class="form-group" ng-class="{ 'has-error': contactform.inputEmail.$invalid && submitted }">
                        <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                            <input ng-model="formData.inputEmail" type="email" class="form-control" id="inputEmail" name="inputEmail" required>
                        </div>
                    </div>
                    <div class="form-group" ng-class="{ 'has-error': contactform.inputTelefono.$invalid && submitted }">
                        <label for="inputTelefono" class="col-lg-2 control-label">Teléfono</label>
                        <div class="col-lg-10">
                            <input ng-model="formData.inputTelefono" maxlength="10" type="number" class="form-control" id="inputTelefono" name="inputTelefono">
                        </div>
                    </div> 
                    <div class="form-group" ng-class="{'has-error':contactform.inputOperacion.$invalid && submitted}" >
                        <label for="selectOperacion" class="col-lg-2 control-label">Operación</label>
                        <div class="col-lg-10">
                            <select id="selectOperacion" name="selectOperacion" ng-model="formData.inputOperacion" style="max-width:150px" class="form-control">
                                <option ng-selected="true" value="VENTA">Venta</option>
                                <option value="ARRIENDO">Arriendo</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" ng-class="{ 'has-error': contactform.inputSubject.$invalid && submitted }">
                        <label for="inputSubject" class="col-lg-2 control-label">Asunto</label>
                        <div class="col-lg-10">
                            <input ng-model="formData.inputSubject" type="text" class="form-control" id="inputSubject" name="inputSubject" required>
                        </div>
                    </div>
                    <div class="form-group" ng-class="{ 'has-error': contactform.inputMessage.$invalid && submitted }">
                        <label for="inputMessage" class="col-lg-2 control-label">Mensaje</label>
                        <div class="col-lg-10">
                            <textarea ng-model="formData.inputMessage" class="form-control" rows="4" id="inputMessage" name="inputMessage" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-default" ng-disabled="submitButtonDisabled">
                                Enviar Mensaje
                            </button>
                        </div>
                    </div>
                </form>
                <p ng-class="result" ng-show="resultMessage" style="padding: 15px; margin: 0;">{{ resultMessage}}</p>
            </div>     
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <a class="twitter-timeline" data-lang="es" data-width="540" data-height="500" data-theme="light" data-link-color="#2B7BB9" href="https://twitter.com/altamiraiquique">Tweets by altamiraiquique</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>    </div>
    <div class="col-lg-4">
        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Faltamiraiquique&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
    </div>
    <div class="col-lg-4">
        <blockquote class="instagram-media" data-instgrm-captioned data-instgrm-version="7" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:658px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:8px;"> <div style=" background:#F8F8F8; line-height:0; margin-top:40px; padding:33.7606837607% 0; text-align:center; width:100%;"> <div style=" background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAsCAMAAAApWqozAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAMUExURczMzPf399fX1+bm5mzY9AMAAADiSURBVDjLvZXbEsMgCES5/P8/t9FuRVCRmU73JWlzosgSIIZURCjo/ad+EQJJB4Hv8BFt+IDpQoCx1wjOSBFhh2XssxEIYn3ulI/6MNReE07UIWJEv8UEOWDS88LY97kqyTliJKKtuYBbruAyVh5wOHiXmpi5we58Ek028czwyuQdLKPG1Bkb4NnM+VeAnfHqn1k4+GPT6uGQcvu2h2OVuIf/gWUFyy8OWEpdyZSa3aVCqpVoVvzZZ2VTnn2wU8qzVjDDetO90GSy9mVLqtgYSy231MxrY6I2gGqjrTY0L8fxCxfCBbhWrsYYAAAAAElFTkSuQmCC); display:block; height:44px; margin:0 auto -44px; position:relative; top:-22px; width:44px;"></div></div> <p style=" margin:8px 0 0 0; padding:0 4px;"> <a href="https://www.instagram.com/p/BH7Y1B1jk_o/" style=" color:#000; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none; word-wrap:break-word;" target="_blank">#siempreprimavera en una de las ciudades más hermosas de Chile  #iquiquechile #Confort #springalways #iquiquecity. #Altamira, somos #GestiónInmobiliaria #Chile #InstaChile #Instagood #cavancha #playaIquique #Sol #IquiqueChile #TierraDeCampeones</a></p> <p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;">Una foto publicada por Altamira Gestion Inmobiliaria (@altamirapropiedades) el <time style=" font-family:Arial,sans-serif; font-size:14px; line-height:17px;" datetime="2016-07-16T15:48:09+00:00">16 de Jul de 2016 a la(s) 8:48 PDT</time></p></div></blockquote>
        <script async defer src="//platform.instagram.com/en_US/embeds.js"></script>
    </div>
</div>

