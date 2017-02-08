<div ng-if="loading === true" class="loader"><div id="loadingAnim"></div></div>
<div class="container-fluid noprint transparente-oscuro" id="menuDiv">
    <header class="cabecera">
        <div id="menuFixed" class="navbar-fixed-top center-block oscurecer visible-sm visible-lg visible-md" >
            <div>
                <div class="col-xs-12 col-md-4 contact_header">
                    <a href="#/"><img src="/main/img/cab.png" alt="Logo" style="margin-left:10px;" height="90"></a>
                </div>
                <div class="col-xs-12 col-md-4 btn-prop-seleccionadas textoBlanco" style="text-align: right;padding-top:1%">
                    <div>UF:{{valoruf}}</div>
                    <div>
                        <img src="/main/img/mail.png" alt=""  >
                        <span>Escríbenos a: <a href="mailto:contactenos@altamirapropiedades.cl" class="correo_header">contactenos@altamirapropiedades.cl</a></span>                
                    </div>  
                </div>
                <div class="col-xs-12 col-md-4" style="float:right;padding-top:1%">
                    <button style="margin-right:15px" ng-click="modalEntrega()" id="btnEntregaProp" class="btn btn-primary btn-lg">Entreganos tu propiedad</button>
                    <a href="https://twitter.com/altamiraiquique" target="_blank" class="min-touch"><img style="height: 30px" src="/main/img/twitter.png" alt="twitter"></a>
                    <a href="https://www.instagram.com/p/BH7Y1B1jk_o/" target="_blank" class="min-touch"><img style="height:30px" src="/main/img/instagram.png" alt="instagram"></a>
                    <a href="https://www.facebook.com/altamiraiquique/" target="_blank" class="min-touch"><img style="height: 30px" src="/main/img/facebook.png" alt="facebook"></a>
                    <a href="https://plus.google.com/u/1/b/113060711193654233606/113060711193654233606/about?gmbpt=true&pageId=113060711193654233606" target="_blank" class="min-touch"><img style="height: 30px" src="/main/img/googleplus.png" alt="google plus"></a>

                </div>  
            </div>
        </div><!--/.row -->

        <div id="menuFixedXS" class="navbar-fixed-top center-block oscurecer visible-xs contact_header" >
            <div class="row">
                <div class="col-xs-6">
                    <a href="#/"><img src="/main/img/cab.png" alt="Logo" style="margin-left:10px;" height="50"></a>
                </div>
                <div class="col-xs-6" style="margin-right:0;text-align:right">
                    <a href="https://twitter.com/altamiraiquique" target="_blank" class="min-touch"><img style="height: 30px" src="/main/img/twitter.png" alt="twitter"></a>
                    <a href="https://www.instagram.com/p/BH7Y1B1jk_o/" target="_blank" class="min-touch"><img style="height:30px" src="/main/img/instagram.png" alt="instagram"></a>
                    <a href="https://www.facebook.com/altamiraiquique/" target="_blank" class="min-touch"><img style="height: 30px" src="/main/img/facebook.png" alt="facebook"></a>
                    <a href="https://plus.google.com/u/1/b/113060711193654233606/113060711193654233606/about?gmbpt=true&pageId=113060711193654233606" target="_blank" class="min-touch"><img style="height: 30px" src="/main/img/googleplus.png" alt="google plus"></a>
                    <div>UF:{{valoruf}}</div>
                </div>  
            </div>
            <div class="row">
                <div class="col-xs-2" style="text-align:right">
                    <button type="button" class="btn btn-default btn-sm" ng-mousedown="mostrarMenu($event)">
                        <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="col-xs-10" style="text-align:right">
                    <img src="/main/img/mail.png" alt=""  >
                    <span>Escríbenos a: <a href="mailto:contactenos@altamirapropiedades.cl" class="correo_header">contactenos@altamirapropiedades.cl</a></span>                

                </div>
            </div><!--/.row -->        
        </div>
            <div id="menu">
                <div class="visible-sm visible-md visible-lg col-sm-12 col-md-12 col-lg-12" style="padding-right: 0;">
                    <div role="navigation">
                        <div id="navbar" class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a class="selectedItem" href="#/">Altamira</a></li>
                                <li><a href="#mapa">Mapa</a></li>
                                <li><a href="#servicios">Servicios</a></li>
                                <li><a href="#contacto">Contáctanos</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="visible-xs col-xs-12">

                </div>
            </div><!--/.row -->

    </header>	
</div>	
