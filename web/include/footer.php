<!-- <img src="/main/img/navidad.png" class="img-responsive" style="position:absolute;bottom:100px;left:0px;z-index:0" />        -->
<div id="footer-fluid" class="footer textoBlanco">
    
    <div id="footer" class="container-fluid">	
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12 descripcion">
                <div class="visible-sm visible-md visible-lg"><img src="/main/img/cab2.png" alt="Logo" class="center-block img-responsive" style="height:70px" ></div>
                <div style="text-align: center">Amunátegui #1675 Segundo Piso, Iquique</div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 contact">
                
                <label>Contáctenos <a href="tel:+56572265280"><img src="/main/img/icono_fono.png" height="13" />(+56)572265280</a></label>
                <table>
                    <tr>
                        <td><img src="/main/img/icono_mail.png" height="10" /></td>
                        <td> <a href="mailto:contactenos@altamirapropiedades.cl">contactenos@altamirapropiedades.cl</a></td>
                    </tr>
                    <tr>
                        <td><img src="/main/img/icono_mail.png" height="10" /></td>
                        <td> <a href="mailto:arriendo@altamirapropiedades.cl">arriendo@altamirapropiedades.cl</a></td>
                    </tr>
                </table>

            </div>
            <div class="col-md-2 col-sm-6 col-xs-12">
                <label>Menu</label>
                <table class="menufooter">
                    <tr>
                        <td><img src="/main/img/icono_casa.png" height="10" /></td>
                        <td> <a href="#/">Altamira</a></td>
                        <td><img src="/main/img/icono_casa.png" height="10" /></td>
                        <td> <a href="#mapa">Mapa</a><br></td>                        
                    </tr>
                    <tr>
                        <td><img src="/main/img/icono_casa.png" height="10" /></td>
                        <td> <a href="#servicios">Servicios</a></td>
                        <td><img src="/main/img/icono_casa.png" height="10" /></td>
                        <td> <a href="#contacto">Contáctanos</a></td>                        
                    </tr>
                </table>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <button ng-click="modalPropiedades()" id="btnPropDest" style="margin-top:5%" class="btn btn-primary btn-lg">Ver Propiedades Destacadas</button>
            </div>
        </div><!--/.row -->

    </div>
</div>
<script>
    $(".nav li a").on('click', function () {
        $(".nav li a").removeClass("selectedItem");
        $(this).addClass("selectedItem");
    });
</script>
<style>
    #map {
        height: 442px;
        width: 100%;
    }
</style>

<?php
?>
