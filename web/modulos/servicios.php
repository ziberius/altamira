
<script>
    $("#mostrarMas").on('click', function () {
        $("#detallesServicios").slideToggle();

    });

    $("#thumbAdm").on('click', function () {
        $("#texto4").slideDown();
        $("#texto1").slideUp();
        $("#texto2").slideUp();
        $("#texto3").slideUp();

    });
    $("#thumbTasaciones").on('click', function () {
        $("#texto3").slideDown();
        $("#texto1").slideUp();
        $("#texto2").slideUp();
        $("#texto4").slideUp();

    });
    $(".thumbArriendo").on('click', function () {
        $("#texto2").slideDown();
        $("#texto1").slideUp();
        $("#texto3").slideUp();
        $("#texto4").slideUp();
    });

    $("#texto1").hide();
    $("#texto2").hide();
    $("#texto3").hide();
    $("#texto4").hide();

    $("#accionesComerciales1").on('click', function () {
        $("#administracionTexto").hide();
        $("#administracionTexto").html("Aviso en Diario: Clasificados del diario La Estrella de Iquique."
                + "Avisos públicos: Instalación letrero publicitario en Inmueble."
                + "Visitas ejecutivo: Previa Coordinación."
                + "Medios Digitales: Alto tráfico web y Redes Sociales de Alto Impacto.");
        $("#administracionTexto").fadeIn();
    });

    $("#formalizacion1").on('click', function () {
        $("#administracionTexto").hide();
        $("#administracionTexto").html("Confección de Orden de Arriendo y Mandato de Administración."
                + "Acta de entrega de bien raíz."
                + "Acta de inventario y Levantamiento fotográfico."
                + "Carta de Informe Comunidad de Nuevo Arrendatario");
        $("#administracionTexto").fadeIn();
    });

    $("#postventa1").on('click', function () {
        $("#administracionTexto").hide();
        $("#administracionTexto").html("Liquidaciones de arriendo mensuales."
                + "Anticipos para gastos de toda índole."
                + "Pago de rentas en bancos con convenio."
                + "Depósitos a su cuenta corriente."
                + "Liquidaciones de renta en cualquier punto de Chile o el extranjero por correo postal o email."
                + "Comisiones de confianza (pago de contribuciones, dividendos, pensiones a terceros, etc).");
        $("#administracionTexto").fadeIn();
    });

    $("#asistencia").on('click', function () {
        $("#administracionTexto").hide();
        $("#administracionTexto").html("Participación en reuniones de asambleas ordinarias y extraordinarias de su comunidad."
                + "pago directo de sus contribuciones, con cargo a sus liquidaciones de egreso."
                + "asesoría en reparaciones e su bien inmueble asesoría legal."
                + "cobranzas extra judiciales gratuitas.");
        $("#administracionTexto").fadeIn();
    });

    $("#accionesComerciales2").on('click', function () {
        $("#arriendoTexto").hide();
        $("#arriendoTexto").html("Aviso en Diario: Clasificados del diario La Estrella de Iquique."
                + "Avisos públicos: Instalación letrero publicitario en Inmueble."
                + "Visitas ejecutivo: Previa Coordinación."
                + "Medios Digitales: Alto tráfico web y Redes Sociales de Alto Impacto.");
        $("#arriendoTexto").fadeIn();
    });

    $("#formalizacion2").on('click', function () {
        $("#arriendoTexto").hide();
        $("#arriendoTexto").html("Confección de Orden de Arriendo y Mandato de Administración."
                + "Acta de entrega de bien raíz."
                + "Acta de inventario y Levantamiento fotográfico."
                + "Carta de Informe Comunidad de Nuevo Arrendatario");
        $("#arriendoTexto").fadeIn();
    });

    $("#postventa2").on('click', function () {
        $("#arriendoTexto").hide();
        $("#arriendoTexto").html("Notificación de Pago de Arriendo Mensual Arrendatario, informando así oportunamente el pago de arriendos, reajustes del IPC, pago de gastos comunes si aplican, etc.");
        $("#arriendoTexto").fadeIn();
    });

    $(document).ready(function () {
        $('.imagenes').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            adaptiveHeight: true,
            centerMode: true,
            variableWidth: true
        });
    });


</script>
<div ng-controller="serviciosController">
    <div class="row">
        <div class="col-md-12">
            <div style="color:white;text-align:left;font-weight: 600">
                <h3>Nos encargamos de la gestión inmobiliaria de miles de personas.</h3>
            </div>
            <div style="color:white;margin-top:40px">
                <span style="font-size:17px;font-style: italic;font-weight: 600">“Altamira la conformamos un grupo de ingenieros, administradores, abogados, tasadores, 
                    arquitectos y un gran equipo técnico. Contamos con más de 10 años de presencia en la ciudad
                    y una extensa cartera de clientes, a quienes agradecemos el confiar en nosotros sus propiedades”</span>

                <span style="display:block;text-align:right;font-size:20px">Manuel Correa Marin, Gerente General</span>
            </div>
        </div>
    </div>
    <!-- <button id="mostrarMas" class="glyphicon glyphicon-plus-sign btn" title="Ver más"></button> -->
    <div class="row">
        <div class="col-lg-3">
            <div class="thumbArriendo">
                <img style="height:340px" ng-src="../../main/img/arriendo-propiedades.png" alt="...">
            </div>
        </div>        
        <div class="col-lg-3">
            <div class="thumbArriendo">
                <img style="height:340px" ng-src="../../main/img/venta-propiedades.png" alt="...">
            </div>
        </div>
        <div class="col-lg-3">
            <div id="thumbAdm">
                <img style="height:340px" ng-src="../../main/img/gestion-activos.png" alt="...">
            </div>
        </div>
        <div class="col-lg-3">
            <div id="thumbTasaciones">
                <img style="height:340px" ng-src="../../main/img/tasaciones.png" alt="...">
            </div>
        </div>
    </div>
    <div id="texto1" class="row">
        <div class="jumbotron text-center transparente-oscuro">
            <img id="accionesComerciales1" class="icono-servicio" src="../../main/img/servicio-accionescomerciales.png" />
            <img id="formalizacion1" class="icono-servicio" src="../../main/img/servicio-formalizacion.png" />
            <img id="postventa1" class="icono-servicio" src="../../main/img/servicio-postventa.png" />
            <img id="asistencia" class="icono-servicio" src="../../main/img/servicio-asistenciatecnica.png" />
            <div class="textoDetalle" id="administracionTexto">
            </div>
        </div>
    </div>
    <div id="texto2" class="row">
        <div class="col-lg-12">
            <div class="jumbotron text-center transparente-oscuro">
                <img id="accionesComerciales2" class="icono-servicio" src="../../main/img/servicio-accionescomerciales.png" />
                <img id="formalizacion2" class="icono-servicio" src="../../main/img/servicio-formalizacion.png" />
                <img id="postventa2" class="icono-servicio" src="../../main/img/servicio-postventa.png" />
                <div class="textoDetalle" id="arriendoTexto">
                </div>            
            </div>
        </div>
    </div>
    <div id="texto3" class="row">
        <div class="col-lg-12">
            <div class="jumbotron text-center transparente-oscuro">
                <div style="color:white;text-align:left;">
                    <h3>Tasaciones</h3>
                </div>
                <div style="color:white;font-size:17px;text-align: left">
                    <span>Las tasaciones tienen múltiples usos, son buenos referentes de mercado para compra, venta y arriendo de propiedades, para licitaciones y remates, pre valuaciones de proyectos inmobiliarios, para posesión efectiva en casos de herencia u otros fines contables / financieros.
                        En Altamira Gestión Inmobiliaria Limitada, nos encargamos de buscar el justo valor de tasación de cada propiedad. Todas las tasaciones se ajustan a las Normas Internacionales de Valoración y de Chile.
                    </span>
                </div>                
         
            </div>
        </div>
    </div>
    <div id="texto4" class="row">
        <div class="col-lg-12">
            <div class="jumbotron text-center transparente-oscuro">
                <div style="color:white;text-align:left;">
                    <h3>Desarrollo & Gestión Inmobiliaria</h3>
                </div>
                <div style="color:white;font-size:17px;text-align: left">
                    <span>El área Inmobiliaria asesora, gestiona y desarrolla proyectos inmobiliarios proporcionando atractivas alternativas de inversión para nuestros clientes.
                    Todo lo anterior Altamira Gestión Inmobiliaria Limitada lo hace posible gracias sus alianzas estratégicas con arquitectos y constructoras que nos permiten el desarrollo de nuestros proyectos y de esta forma poder ofrecer a los inversionistas un variado portafolio de proyectos inmobiliarios habitacionales y comerciales.
                    </span>
                </div>                   
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="imagenes">
            <div><img class="galeria" src="../../main/img/entreganos1.jpg" /></div>
            <div><img class="galeria" src="../../main/img/entreganos2.jpg" /></div>
            <div><img class="galeria" src="../../main/img/entreganos3.jpg" /></div>
            <div><img class="galeria" src="../../main/img/entreganos4.jpg" /></div>
            <div><img class="galeria" src="../../main/img/entreganos5.jpg" /></div>
            <div><img class="galeria" src="../../main/img/entreganos6.jpg" /></div>
            <div><img class="galeria" src="../../main/img/entreganos10.jpg" /></div>
            <div><img class="galeria" src="../../main/img/entreganos12.jpg" /></div>
            <div><img class="galeria" src="../../main/img/entreganos13.jpg" /></div>
        </div>
    </div>
</div>

