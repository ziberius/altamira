
var scotchApp = angular.module('scotchApp', ['ngRoute', 'ngAnimate', 'ngTouch', 'uiGmapgoogle-maps', 'ngclipboard']);

scotchApp.factory('Scopes', function () {
    var mem = {};
    return {
        store: function (key, value) {
            mem[key] = value;
        },
        get: function (key) {
            return mem[key];
        }
    };
});

scotchApp.service('modales', function ($location, $rootScope, $http, Scopes) {

    this.compartir = function () {
        var $scope = Scopes.get('myCtrl');
        $scope.submitButtonDisabled = false;
        $scope.submitted = false;
        $scope.resultMessage = '';
        $scope.result = '';
        $scope.formData = {};
        $scope.formData.inputName = "";
        $scope.formData.inputRemitente = "";
        $scope.formData.inputDestinatario = "";
        $scope.formData.inputSubject = "Mira  esta propiedad";
        $scope.formData.inputMessage = "Hola! Estaba viendo la página de Altamira y vi esta propiedad que te podría interesar.";
        $("#detallePropiedad").modal("hide");
        $("#compartirModal").modal("show");
    };

    this.mapa = function () {
        var $scope = Scopes.get('myCtrl');
        $("#detallePropiedad").modal("hide");
        $location.path("/mapa/" + $scope.id_prop);
    };

    this.imprimir = function () {
        var printContents = $(".panel-body").html();
        var popupWin = window.open('', '_blank', 'width=300,height=300');
        popupWin.document.open();
        popupWin.document.write('<html><head><link rel="stylesheet" type="text/css" href="style.css" /></head><body onload="window.print()">' + printContents + '</body></html>');
        popupWin.document.close();
    };

    this.contacto = function () {
        $location.path("/contacto");
    };

    this.submitContacto = function (contactform) {
        var $scope = Scopes.get('myCtrl');
        $scope.submitted = true;
        $scope.submitButtonDisabled = true;

        var datos = {
            'remitente': $scope.formData.inputRemitente,
            'destinatario': $scope.formData.inputDestinatario,
            'nombre': $scope.formData.inputName,
            'asunto': $scope.formData.inputSubject,
            'mensaje': $scope.formData.inputMessage,
            'idprop': $scope.id_prop
        };

        if (contactform.$valid) {
            $rootScope.loading = true;
            $http.post('../../main/server/share-form.php', datos).then(
                    function (res) {
                        $rootScope.loading = false;
                        if (res.data.success === true) { //success comes from the return json object
                            $scope.submitButtonDisabled = true;
                            $scope.resultMessage = res.data.message;
                            $scope.result = 'bg-success';
                        } else {
                            $scope.submitButtonDisabled = false;
                            $scope.resultMessage = res.data.message;
                            $scope.result = 'bg-danger';
                        }
                    });
        } else {
            $scope.submitButtonDisabled = false;
            $scope.resultMessage = 'Error, favor ingrese todos los datos solicitados.';
            $scope.result = 'bg-danger';
        }
    };

    this.copiadoExitoso = function (e) {
        showMessage("Se ha copiado la url de la propiedad al portapapeles.");
    };

    this.copiadoError = function (e) {
        showMessage("Error al copiar la url de la propiedad al portapapeles.");
    };


});
// configure our routes
scotchApp.config(function ($routeProvider) {
    $routeProvider
            // route for the home page
            .when('/', {
                redirectTo: '/altamira'
            })
            // route for the home page
            .when('/altamira', {
                templateUrl: '../main/web/modulos/altamira.php',
                controller: 'mainController'
            })

            // route for the about page
            .when('/mapa/:idprop', {
                templateUrl: '../main/web/modulos/mapa.php',
                controller: 'mapaController'
            })
            // route for the about page
            .when('/mapa', {
                templateUrl: '../main/web/modulos/mapa.php',
                controller: 'mapaController'
            })
            // route for the contact page
            .when('/contacto', {
                templateUrl: '../main/web/modulos/contacto.php',
                controller: 'contactoController'
            })
            .when('/servicios', {
                templateUrl: '../main/web/modulos/servicios.php',
                controller: 'serviciosController'
            })
            .when('/entreganos-tu-propiedad', {
                templateUrl: '../main/web/modulos/entreganos-tu-propiedad.php',
                controller: 'entregaPropiedadController'
            })
            .when('/view/:idprop', {
                templateUrl: '../main/web/modulos/view.php',
                controller: 'viewController'
            });
});


scotchApp.controller('viewController', function ($scope, $rootScope, $http, $routeParams, $location, modales, Scopes) {
    $scope.$on('$routeChangeSuccess', function () {
        ajustarMargenes();
    });    
    Scopes.store('myCtrl', $scope);
    $rootScope.pageClass = 'page-contacto';
    params = {
        'type': 'view',
        'conditions':
                {'where': {'p.id_prop': $routeParams.idprop}}
    };


    $rootScope.loading = true;
    $http.post('../../main/server/action.php', params).then(function (res) {
        $rootScope.loading = false;
        if (res.data !== null && res.data.status === 'OK') {
            var propiedad = res.data.records[0];

            $(".navfoto").scrollTo("0", 100);
            $scope._Index = 0;
            $scope.inputCodigo = propiedad.codigo;
            $scope.inputTitulo = propiedad.titulo;
            $scope.inputRegion = "Tarapacá (I)";
            $scope.inputTareaDesc = propiedad.descrip;
            $scope.inputDireccion = propiedad.direccion_real;
            $scope.inputTipo = obtenerTipo(propiedad.operacion);
            $scope.inputComuna = obtenerComuna(propiedad.comuna);
            $scope.inputPrecioUf = propiedad.uf;
            $scope.inputPrecioClp = propiedad.clp;
            $scope.inputPrecioClpCalc = addCommas(propiedad.uf * ufToNumber($rootScope.valoruf));
            $scope.inputConstruido = propiedad.construido;
            $scope.inputTerreno = propiedad.terreno;
            $scope.inputDormitorios = propiedad.dormitorio;
            $scope.inputBanos = propiedad.ban;
            $scope.id_prop = propiedad.id_prop;

            params = {
                'type': 'fotos',
                'conditions':
                        {
                            'where': {'id_prop': propiedad.id_prop},
                            'order_by': 'orden asc'
                        }
            };
            $rootScope.loading = true;
            $http.post('../../main/server/action.php', params).then(function (res) {
                $rootScope.loading = false;
                if (res.data !== null && res.data.status === 'OK') {
                    var tmp, cont = 1, item;
                    $scope.photos = [];
                    for (var i = 0; i < res.data.records.length; i++) {
                        item = {};
                        tmp = {};
                        tmp = res.data.records[i];
                        item.src = "../../desk/img/propiedad/" + tmp.id_prop + "/grande/" + tmp.numero + ".jpeg";
                        item.id = "foto" + cont;
                        $scope.photos.push(item);
                        cont++;
                    }
                } else {
                    $scope.photos = [];
                    item = {};
                    item.src = "../../desk/img/propiedad/" + propiedad.id_prop + "/grande/0.jpeg";
                    item.id = "foto1";
                    $scope.photos.push(item);
                }
            });

        } else {
            $scope.propiedad = null;
            showMessage("No se encontraron resultados");
        }
    }).catch(function (e) {
        showMessage("Error al obtener las propiedades. El servidor respondió: " + e.statusText);
        $rootScope.loading = false;
    });

    $scope._Index = 0;

    // if a current image is the same as requested image
    $scope.isActive = function (index) {
        return $scope._Index === index;
    };

    // show prev image
    $scope.showPrev = function () {
        if ($scope._Index === 0) {
            $(".navfoto").scrollTo("max", 100);
        } else {
            $(".navfoto").scrollTo("-=86px", 100);
        }
        $scope._Index = ($scope._Index > 0) ? --$scope._Index : $scope.photos.length - 1;

    };

    // show next image
    $scope.showNext = function () {
        $scope._Index = ($scope._Index < $scope.photos.length - 1) ? ++$scope._Index : 0;
        if ($scope._Index === 0) {
            $(".navfoto").scrollTo("0", 100);
        } else {
            $(".navfoto").scrollTo("+=86px", 100);
        }

    };

    // show a certain image
    $scope.showPhoto = function (index) {
        $scope._Index = index;
    };

    $scope.contacto = modales.contacto;

    $scope.imprimir = modales.imprimir;

    $scope.compartir = modales.compartir;

    $scope.mapa = modales.mapa;

    $scope.submit = modales.submitContacto;

    $scope.onSuccess = modales.copiadoExitoso;
    $scope.onError = modales.copiadoError;

});

// create the controller and inject Angular's $scope
scotchApp.controller('mainController', function ($scope, $rootScope, $http, $timeout, $location, modales, Scopes) {
    $scope.$on('$routeChangeSuccess', function () {
        ajustarMargenes();
    });    
    Scopes.store('myCtrl', $scope);
    Scopes.store('main', $scope);
    // create a message to display in our view
    $scope.destacados = false;
    $scope.message = 'Bienvenido a Altamira Propiedades.';
    $scope.formData = {};
    $scope.formData.inputOperacion = "VENTA";
    $scope.modalEntrega = function () {
        $scope.formData = {}; //formData is an object holding the name, email, subject, and message
        $scope.formData.inputOperacion = "VENTA";
        $scope.submitButtonDisabled = false;
        $scope.submitted = false;
        $scope.resultMessage = '';
        $scope.result = '';
        $scope.formData.inputName = "";
        $scope.formData.inputEmail = "";
        $scope.formData.inputTelefono = "";
        $scope.formData.inputSubject = "";
        $scope.formData.inputMessage = "";
        $("#entregaPropModal").modal("show");
    };

    $scope.mostrarMenu = function ($event) {
        $("#menuXs").show();
        $("#menuXs").animate({width: "150px"}, 500);
        $event.stopPropagation();
        $event.preventDefault();
        return false;
    };

    $scope.esconderMenu = function () {
        $("#menuXs").animate({width: "0px"}, 500, function () {
            $("#menuXs").hide();
        });
    };

    $scope.detalle = function (propiedad) {
        $("#propDestacadasModal").modal("hide");
        $location.path("/view/" + propiedad.id_prop);

    };

    // initial image index
    $scope._Index = 0;

    // if a current image is the same as requested image
    $scope.isActive = function (index) {
        return $scope._Index === index;
    };

    // show prev image
    $scope.showPrev = function () {
        if ($scope._Index === 0) {
            $(".navfoto").scrollTo("max", 100);
        } else {
            $(".navfoto").scrollTo("-=86px", 100);
        }
        $scope._Index = ($scope._Index > 0) ? --$scope._Index : $scope.photos.length - 1;

    };

    // show next image
    $scope.showNext = function () {
        $scope._Index = ($scope._Index < $scope.photos.length - 1) ? ++$scope._Index : 0;
        if ($scope._Index === 0) {
            $(".navfoto").scrollTo("0", 100);
        } else {
            $(".navfoto").scrollTo("+=86px", 100);
        }

    };

    // show a certain image
    $scope.showPhoto = function (index) {
        $scope._Index = index;
    };

    $scope.contacto = modales.contacto;

    $scope.imprimir = modales.imprimir;

    $scope.compartir = modales.compartir;

    $scope.mapa = modales.mapa;

    $scope.onSuccess = modales.copiadoExitoso;
    $scope.onError = modales.copiadoError;

    $scope.submit = function (contactform) {
        $scope.submitted = true;
        $scope.submitButtonDisabled = true;

        var datos = {
            'correo': $scope.formData.inputEmail,
            'nombre': $scope.formData.inputName,
            'telefono': $scope.formData.inputTelefono,
            'asunto': $scope.formData.inputSubject,
            'mensaje': $scope.formData.inputMessage,
            'operacion': $scope.formData.inputOperacion,
            'tipo': 'ENTREGUENOS'
        };

        if (contactform.$valid) {
            $rootScope.loading = true;
            $http.post('../../main/server/contact-form.php', datos).then(
                    function (res) {
                        $rootScope.loading = false;
                        if (res.data.success === true) { //success comes from the return json object
                            $scope.submitButtonDisabled = true;
                            $scope.resultMessage = res.data.message;
                            $scope.result = 'bg-success';
                        } else {
                            $scope.submitButtonDisabled = false;
                            $scope.resultMessage = res.data.message;
                            $scope.result = 'bg-danger';
                        }
                    });
        } else {
            $scope.submitButtonDisabled = false;
            if (contactform.inputTelefono.$invalid) {
                $scope.resultMessage = '* El teléfono debe contener máximo 10 digitos.';
            } else {
                $scope.resultMessage = '* Error, favor validar los campos marcados con rojo.';
            }
            $scope.result = 'bg-danger';
        }
    };

    params = {
        'type': 'moneda',
        'conditions':
                {'moneda': 'UF'}
    };
    $http.post('../../main/server/action.php', params).then(function (res) {
        if (res.data !== null && res.data.status === 'OK') {
            $rootScope.valoruf = res.data.valor;
        } else {
            $rootScope.valoruf = "N/A";
        }
    }).catch(function (e) {
        showMessage("Error al obtener valor UF. El servidor respondió: " + e.statusText);
    });

    $scope.modalPropiedades = function () {
        if (!$scope.destacados) {

            params = {
                'type': 'destacados'
            };
            $rootScope.loading = true;
            $http.post('../../main/server/action.php', params).then(function (res) {
                $rootScope.loading = false;
                if (res.data !== null && res.data.status === 'OK') {
                    $scope.valoruf = ufToNumber($rootScope.valoruf);
                    $scope.propaganda = res.data.records;
                } else {
                    $scope.propaganda = null;
                    showMessage("No se encontraron resultados");

                }
                $("#propDestacadasModal").modal("show");
                $timeout(function () {
                    $('#propDestacadas').slick({
                        slidesToShow: 5,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 3000,
                        adaptiveHeight: true,
                        pauseOnHover: true,
                        centerMode: true,
                        variableWidth: true,
                        prevArrow: '<button class="btn btnGaleriaDestLeft" ><i class="glyphicon glyphicon-chevron-left" ></i></button>',
                        nextArrow: '<button class="btn btnGaleriaDestRight" ><i class="glyphicon glyphicon-chevron-right" ></i></button>',
                        appendArrows: $("#propDestacadas")
                    });
                });
                $scope.destacados = true;

            }).catch(function (e) {
                showMessage("Error al obtener las propiedades. El servidor respondió: " + e.statusText);
                $rootScope.loading = false;
            });
        } else {
            $("#propDestacadasModal").modal("show");
        }


    };


});

scotchApp.controller('mapaController', function ($scope, $rootScope, $http, $location, modales, Scopes, $routeParams) {
    $scope.$on('$routeChangeSuccess', function () {
        ajustarMargenes();
    });
    Scopes.store('myCtrl', $scope);
    $scope.message = 'Buscador de propiedades.';
    $rootScope.pageClass = 'page-buscar';
    $scope.prueba = "";
    $scope.desc = "";
    $scope.propiedades = [];
    $scope.moneda = "UF";
    $scope.desde = "";
    $scope.hasta = "";

    $scope.map = {
        center: {latitude: -20.2428, longitude: -70.1330},
        zoom: 12,
        window: {
            marker: {},
            show: false,
            closeClick: function () {
                this.show = false;
            },
            options: {pixelOffset: {
                    height: -25,
                    width: 0
                }}
        }
    };

    $scope.markers = {
        coordenadas: $scope.propiedades,
        markersEvents: {
            click: function (marker, eventName, model, arguments) {
                $scope.map.window.model = model;
                $scope.map.window.show = true;
                $scope.propiedad = model;
            },
            touch: function (marker, eventName, model, arguments) {
                $scope.map.window.model = model;
                $scope.map.window.show = true;
                $scope.propiedad = model;
            }

        },
        options: {icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'}
    };


    $scope.getRecords = function (params) {
        var idprop = $routeParams.idprop;
        if (idprop === undefined || idprop === null) {
            if ($scope.tipo === "normal") {
                params = {
                    'type': 'view',
                    'conditions':
                            {'whereLike': {'descrip': $scope.desc}}
                };

            } else if ($scope.tipo === "avanzado") {
                params = {
                    'type': 'view',
                    'conditions':
                            {
                                'whereLike': {'descrip': $scope.desc},
                                'where': {'tipo': $scope.tipoPropiedad, 'operacion': $scope.operacionPropiedad},
                                'precio': {'tipo': $scope.moneda, 'desde': $scope.desde, 'hasta': $scope.hasta}}
                };

            }
        } else {
            params = {
                'type': 'view',
                'conditions':
                        {'where': {'p.id_prop': idprop}}
            };
        }
        if ($scope.operacionPropiedad === "1") {
            $scope.markers['options'] = {icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'};
        } else if ($scope.operacionPropiedad === "2") {
            $scope.markers['options'] = {icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'};
        }
        $rootScope.loading = true;
        $http.post('../../main/server/action.php', params).then(function (res) {
            $rootScope.loading = false;
            $scope.propiedades = [];
            var fila = {};
            var cont = 1;
            if (res.data !== null && res.data.status === 'OK') {
                angular.forEach(res.data.records, function (value, key) {
                    fila = {};
                    fila.codigo = value.codigo;
                    fila.titulo = value.titulo;
                    fila.descrip = value.descrip;
                    fila.direccion_real = value.direccion_real;
                    fila.tipo = value.tipo;
                    fila.tipoOperacion = obtenerTipo(value.operacion);
                    fila.operacion = value.operacion;
                    fila.comuna = obtenerComuna(value.comuna);
                    fila.id = cont;
                    fila.id_prop = value.id_prop;
                    fila.numero = value.numero;
                    fila.dormitorio = value.dormitorio;
                    fila.ban = value.ban;
                    fila.uf = value.uf;
                    fila.clp = value.clp;
                    fila.construido = value.construido;
                    fila.terreno = value.terreno;
                    var tmp = value.mapa.split(",");
                    fila.latitude = tmp[0];
                    fila.longitude = tmp[1];
                    $scope.propiedades.push(fila);
                    cont++;
                });

                $scope.markers.coordenadas = $scope.propiedades;

            } else {
                $scope.propiedades = [];
                showMessage("No se encontraron resultados");
                $scope.markers.coordenadas = $scope.propiedades;
            }
        }).catch(function (e) {
            showMessage("Error al obtener las propiedades. El servidor respondió: " + e.statusText);
            $rootScope.loading = false;
        });
    };

    $scope.detalle = function () {
        $(".navfoto").scrollTo("0", 100);
        $scope._Index = 0;
        var propiedad = $scope.propiedad;

        $scope.inputCodigo = propiedad.codigo;
        $scope.inputTitulo = propiedad.titulo;
        $scope.inputRegion = "Tarapacá (I)";
        $scope.inputTareaDesc = propiedad.descrip;
        $scope.inputDireccion = propiedad.direccion_real;
        $scope.inputTipo = obtenerTipo(propiedad.operacion);
        $scope.inputComuna = propiedad.comuna;
        $scope.inputPrecioUf = propiedad.uf;
        $scope.inputPrecioClp = propiedad.clp;
        $scope.inputConstruido = propiedad.construido;
        $scope.inputTerreno = propiedad.terreno;
        $scope.inputDormitorios = propiedad.dormitorio;
        $scope.inputBanos = propiedad.ban;
        $scope.id_prop = propiedad.id_prop;

        params = {
            'type': 'fotos',
            'conditions':
                    {
                        'where': {'id_prop': propiedad.id_prop},
                        'order_by': 'orden asc'
                    }
        };
        $rootScope.loading = true;
        $http.post('../../main/server/action.php', params).then(function (res) {
            $rootScope.loading = false;
            if (res.data !== null && res.data.status === 'OK') {
                var tmp, cont = 1, item;
                $scope.photos = [];
                for (var i = 0; i < res.data.records.length; i++) {
                    item = {};
                    tmp = {};
                    tmp = res.data.records[i];
                    item.src = "../../desk/img/propiedad/" + tmp.id_prop + "/grande/" + tmp.numero + ".jpeg";
                    item.id = "foto" + cont;
                    $scope.photos.push(item);
                    cont++;
                }
                $("#detallePropiedad").modal("show");
                //centrarImagen();
            } else {
                $scope.photos = [];
                item = {};
                item.src = "../../desk/img/propiedad/" + propiedad.id_prop + "/grande/0.jpeg";
                item.id = "foto1";
                $scope.photos.push(item);
                $("#detallePropiedad").modal("show");
            }
        });

    };

    // initial image index
    $scope._Index = 0;

    // if a current image is the same as requested image
    $scope.isActive = function (index) {
        return $scope._Index === index;
    };

    // show prev image
    $scope.showPrev = function () {
        if ($scope._Index === 0) {
            $(".navfoto").scrollTo("max", 100);
        } else {
            $(".navfoto").scrollTo("-=86px", 100);
        }
        $scope._Index = ($scope._Index > 0) ? --$scope._Index : $scope.photos.length - 1;
    };

    // show next image
    $scope.showNext = function () {
        $scope._Index = ($scope._Index < $scope.photos.length - 1) ? ++$scope._Index : 0;
        if ($scope._Index === 0) {
            $(".navfoto").scrollTo("0", 100);
        } else {
            $(".navfoto").scrollTo("+=86px", 100);
        }
    };

    // show a certain image
    $scope.showPhoto = function (index) {
        $scope._Index = index;
    };

    $scope.buscar = function (tipo) {
        $scope.desc = $("#inputBuscar").val();
        $scope.tipoPropiedad = $("#selectTipo").val();
        $scope.operacionPropiedad = $("#selectOpe").val();
        $scope.tipo = tipo;
        $scope.getRecords();
    };

    $scope.showPhoto = function (index) {
        $scope._Index = index;
    };

    $scope.contacto = function () {
        $location.path("/contacto");
    };

    $scope.imprimir = modales.imprimir;

    $scope.compartir = modales.compartir;

    $scope.mapa = modales.mapa;

    $scope.onSuccess = modales.copiadoExitoso;
    $scope.onError = modales.copiadoError;

    $scope.submit = modales.submitContacto;
    $scope.buscar("avanzado");
});

scotchApp.controller('destacadosController', function ($scope, $rootScope) {
    $scope.message = 'Destacados';
    $rootScope.pageClass = 'page-destacados';
});

scotchApp.controller('entregaPropiedadController', function ($scope, $rootScope) {
    $rootScope.pageClass = 'page-contacto';

});
scotchApp.controller('serviciosController', function ($scope, $rootScope) {
    $scope.$on('$routeChangeSuccess', function () {
        ajustarMargenes();
    });    
    $scope.message = 'Servicios';
    $rootScope.pageClass = 'page-entrega-propiedad';

    $scope.accionesComerciales = function () {
        return $scope.administracionTexto = "Aviso en Diario: Clasificados del diario La Estrella de Iquique."
                + "Avisos públicos: Instalación letrero publicitario en Inmueble."
                + "Visitas ejecutivo: Previa Coordinación."
                + "Medios Digitales: Alto tráfico web y Redes Sociales de Alto Impacto.";
    };

    $scope.formalizacion = function () {
        return $scope.administracionTexto = "Confección de Orden de Arriendo y Mandato de Administración."
                + "Acta de entrega de bien raíz."
                + "Acta de inventario y Levantamiento fotográfico."
                + "Carta de Informe Comunidad de Nuevo Arrendatario";
    };
    $scope.postventa1 = function () {
        return $scope.administracionTexto = "Liquidaciones de arriendo mensuales."
                + "Anticipos para gastos de toda índole."
                + "Pago de rentas en bancos con convenio."
                + "Depósitos a su cuenta corriente."
                + "Liquidaciones de renta en cualquier punto de Chile o el extranjero por correo postal o email."
                + "Comisiones de confianza (pago de contribuciones, dividendos, pensiones a terceros, etc).";
    };
    $scope.asistencia = function () {
        return $scope.administracionTexto = "Participación en reuniones de asambleas ordinarias y extraordinarias de su comunidad."
                + "pago directo de sus contribuciones, con cargo a sus liquidaciones de egreso."
                + "asesoría en reparaciones e su bien inmueble asesoría legal."
                + "cobranzas extra judiciales gratuitas.";
    };

});

scotchApp.controller('contactoController', function ($scope, $rootScope, $http, Scopes) {
    $scope.$on('$routeChangeSuccess', function () {
        ajustarMargenes();
    });    
    Scopes.store('myCtrl', $scope);
    $rootScope.pageClass = 'page-contacto';
    $scope.result = 'hidden';
    $scope.resultMessage;
    $scope.formData = {}; //formData is an object holding the name, email, subject, and message
    $scope.formData.inputOperacion = "VENTA";
    //$scope.formData.operacion = "VENTA";
    $scope.submitButtonDisabled = false;
    $scope.submitted = false; //used so that form errors are shown only after the form has been submitted

    $scope.submit = function (contactform) {
        $scope.submitted = true;
        $scope.submitButtonDisabled = true;

        var datos = {
            'correo': $scope.formData.inputEmail,
            'nombre': $scope.formData.inputName,
            'telefono': $scope.formData.inputTelefono,
            'asunto': $scope.formData.inputSubject,
            'mensaje': $scope.formData.inputMessage,
            'operacion': $scope.formData.inputOperacion,
            'tipo': 'CONTACTO'
        };

        if (contactform.$valid) {
            $rootScope.loading = true;
            $http.post('../../main/server/contact-form.php', datos).then(
                    function (res) {
                        $rootScope.loading = false;
                        if (res.data.success === true) { //success comes from the return json object
                            $scope.submitButtonDisabled = true;
                            $scope.resultMessage = res.data.message;
                            $scope.result = 'bg-success';
                        } else {
                            $scope.submitButtonDisabled = false;
                            $scope.resultMessage = res.data.message;
                            $scope.result = 'bg-danger';
                        }
                    });
        } else {
            $scope.submitButtonDisabled = false;
            if (contactform.inputTelefono.$invalid) {
                $scope.resultMessage = '* El teléfono debe contener máximo 10 digitos.';
            } else {
                $scope.resultMessage = '* Error, favor validar los campos marcados con rojo.';
            }
            $scope.result = 'bg-danger';
        }
    };
});

scotchApp.controller("userController", function ($scope, $rootScope, $http, $location, modales, Scopes) {
    Scopes.store('myCtrl', $scope);
    $scope.propiedades = [];
    $scope.tempUserData = {};
    $scope.start = 0;
    $scope.limit = "10";
    $scope.end = ($scope.start) + parseInt($scope.limit);
    $scope.tipo = "normal";
    $scope.desc = "";
    $scope.tipoPropiedad = "";
    $scope.operacionPropiedad = "";

   // function to get records from the database

    $scope.anterior = function () {
        if ($scope.start - parseInt($scope.limit) < 0) {
            $scope.start = 0;
        } else {
            $scope.start = $scope.start - parseInt($scope.limit);
        }
        $scope.getRecords();
    };

    $scope.siguiente = function () {
        if ($scope.start + parseInt($scope.limit) > $scope.total + 1) {
            $scope.start = $scope.total - parseInt($scope.limit) - 1;
        } else {
            $scope.start = $scope.start + parseInt($scope.limit);
        }
        $scope.getRecords();
    };

    $scope.buscar = function (tipo) {
        $scope.desc = $("#inputBuscar").val();
        $scope.tipoPropiedad = $("#selectTipo").val();
        $scope.operacionPropiedad = $("#selectOpe").val();
        $scope.tipo = tipo;
        $scope.start = 0;
        $scope.getRecords();
    };

    $scope.cambioLimite = function () {
        $scope.end = ($scope.start) + parseInt($scope.limit);
        $scope.getRecords();
    };

    $scope.getRecords = function (params) {

        if ($scope.tipo === "normal") {
            params = {
                'type': 'view',
                'conditions':
                        {'start': $scope.start, 'limit': parseInt($scope.limit),
                            'whereLike': {'descrip': $scope.desc}}
            };
        } else if ($scope.tipo === "avanzado") {
            params = {
                'type': 'view',
                'conditions':
                        {'start': $scope.start, 'limit': parseInt($scope.limit),
                            'whereLike': {'descrip': $scope.desc},
                            'where': {'tipo': $scope.tipoPropiedad, 'operacion': $scope.operacionPropiedad}}
            };

        }

        $rootScope.loading = true;
        $http.post('../../main/server/action.php', params).then(function (res) {
            $rootScope.loading = false;
            $scope.valoruf = ufToNumber($rootScope.valoruf);
            if (res.data !== null && res.data.status === 'OK') {
                $scope.propiedades = res.data.records;
                $scope.total = res.data.total;
            } else {
                $scope.propiedades = null;
                $scope.total = 0;
                showMessage("No se encontraron resultados");

            }
            $scope.end = ($scope.start) + parseInt($scope.limit);
            if ($scope.end > $scope.total) {
                $scope.end = $scope.total;
            }

        }).catch(function (e) {
            showMessage("Error al obtener las propiedades. El servidor respondió: " + e.statusText);
            $rootScope.loading = false;
        });
    };

    $scope.detalle = function (propiedad) {
        $(".navfoto").scrollTo("0", 100);
        $scope._Index = 0;
        $scope.inputCodigo = propiedad.codigo;
        $scope.inputTitulo = propiedad.dire;
        $scope.inputRegion = "Tarapacá (I)";
        $scope.inputTareaDesc = propiedad.descrip;
        $scope.inputDireccion = propiedad.direccion_real;
        $scope.inputTipo = obtenerTipo(propiedad.operacion);
        $scope.inputComuna = obtenerComuna(propiedad.comuna);
        $scope.inputPrecioUf = propiedad.uf;
        $scope.inputPrecioClp = propiedad.clp;
        $scope.inputPrecioClpCalc = addCommas(propiedad.uf * $scope.valoruf);
        $scope.inputConstruido = propiedad.construido;
        $scope.inputTerreno = propiedad.terreno;
        $scope.inputDormitorios = propiedad.dormitorio;
        $scope.inputBanos = propiedad.ban;
        $scope.id_prop = propiedad.id_prop;
        if ($scope.inputTipo === "Venta") {
            $scope.datosContacto1 = "Vende: Alberto Correa Marín";
            $scope.datosContacto2 = "Teléfonos: (57) 2 265288 / 9 9885 27 50 / 9 9417 57 93";
            $scope.datosContacto3 = "E-mail: acorrea@altamirapropiedades.cl";
        } else {
            $scope.datosContacto1 = "Arrienda: Gabriela Lopez Sanchez";
            $scope.datosContacto2 = "Teléfonos: (57) 2 532860 / 9 9159 57 69 / 9 8139 53 57";
            $scope.datosContacto3 = "E-mail: glopez@altamirapropiedades.cl";
        }

        params = {
            'type': 'fotos',
            'conditions':
                    {
                        'where': {'id_prop': propiedad.id_prop},
                        'order_by': 'orden asc'
                    }
        };
        $rootScope.loading = true;
        $http.post('../../main/server/action.php', params).then(function (res) {
            $rootScope.loading = false;
            if (res.data !== null && res.data.status === 'OK') {
                var tmp, cont = 1, item;
                $scope.photos = [];
                for (var i = 0; i < res.data.records.length; i++) {
                    item = {};
                    tmp = {};
                    tmp = res.data.records[i];
                    item.src = "../../desk/img/propiedad/" + tmp.id_prop + "/grande/" + tmp.numero + ".jpeg";
                    item.id = "foto" + cont;
                    $scope.photos.push(item);
                    cont++;
                }
                $("#detallePropiedad").modal("show");
            } else {
                $scope.photos = [];
                item = {};
                item.src = "../../desk/img/propiedad/" + propiedad.id_prop + "/grande/0.jpeg";
                item.id = "foto1";
                $scope.photos.push(item);
                $("#detallePropiedad").modal("show");
            }
        });

    };

    // initial image index
    $scope._Index = 0;

    // if a current image is the same as requested image
    $scope.isActive = function (index) {
        return $scope._Index === index;
    };

    // show prev image
    $scope.showPrev = function () {
        if ($scope._Index === 0) {
            $(".navfoto").scrollTo("max", 100);
        } else {
            $(".navfoto").scrollTo("-=86px", 100);
        }
        $scope._Index = ($scope._Index > 0) ? --$scope._Index : $scope.photos.length - 1;

    };

    // show next image
    $scope.showNext = function () {
        $scope._Index = ($scope._Index < $scope.photos.length - 1) ? ++$scope._Index : 0;
        if ($scope._Index === 0) {
            $(".navfoto").scrollTo("0", 100);
        } else {
            $(".navfoto").scrollTo("+=86px", 100);
        }

    };

    // show a certain image
    $scope.showPhoto = function (index) {
        $scope._Index = index;
    };

    $scope.contacto = modales.contacto;
    $scope.imprimir = modales.imprimir;
    $scope.onSuccess = modales.copiadoExitoso;
    $scope.onError = modales.copiadoError;
    $scope.compartir = modales.compartir;

    $scope.mapa = modales.mapa;

    $scope.submit = modales.submitContacto;
});

function ajustarMargenes() {
    var altura = $("#footer-fluid").height();
    $("#main").css("margin-top", $("#menuDiv").height() * 1.1);
    if ($("#menuFixed").css("display") === "none") {
        $("#menu").css("margin-top", $("#menuFixedXS").height());
    } else {
        $("#menu").css("margin-top", $("#menuFixed").height());
    }
    $("#main").css("margin-bottom", altura > 300 ? altura / 3 : 150);
    $(".cb-slideshow li span").css("top", altura > 300 ? altura / 3 : 100);
}

function obtenerComuna(comuna) {
    switch (comuna) {
        case "1":
            return "Iquique";
        case "2":
            return "Alto Hospicio";
        case "3":
            return "Pozo Almonte";
        case "4":
            return "Pica";
        default:
            return "";

    }
}

function obtenerTipo(tipo) {
    switch (tipo) {
        case "1":
            return "Venta";
        case "2":
            return "Arriendo";
    }
}

function showMessage(message) {
    $("#btnNotificacion").click();
    $("<div class='alert alert-danger alert-dismissible fade in notificacion'\n\
     role='alert'><button id='btnNotificacion' type='button' class='close'\n\
     data-dismiss='alert' aria-label='Cerrar'><span aria-hidden='true'>&times;\n\
    </span></button><strong>Notificación</strong><p>" + message + "</p></div>").appendTo("#main").fadeIn();
}

function ufToNumber(uf) {
    if (uf !== undefined && uf !== null) {
        var nro = uf.replace(".", "");
        nro = nro.replace("$","");
        nro = nro.replace(",", ".");
        return Number(nro);
    } else {
        return 0;
    }
}

function addCommas(nStr) {
    var valor = String(nStr);
    valor = valor.replace(".", ",");
    valor += '';
    var x = valor.split(',');
    var x1 = x[0];
    var x2 = x.length > 1 ? ',' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}



