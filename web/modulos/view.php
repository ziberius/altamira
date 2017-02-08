<!-- about.html -->
<div ng-controller="viewController">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">{{inputTitulo}}</h2>
                </div>
                <div class="panel-body">
                    <div>
                        <?php include("../include/galeria.php"); ?>
                    </div>
                    <div>
                        <?php include("../include/detalle.php"); ?>
                    </div>                    
                </div>
            </div>            

        </div>
    </div>

    <?php require_once('../include/modales.php'); ?>
</div>

