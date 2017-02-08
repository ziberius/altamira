                            <div class="container slider">
                                <button id="btnGaleriaLeft" class="btn btnGaleria" ng-click="showPrev()"><i class="glyphicon glyphicon-chevron-left" ></i></button>
                                <button id="btnGaleriaRight" class="btn btnGaleria" style="float:right" ng-click="showNext()"><i class="glyphicon glyphicon-chevron-right"></i></button>

                                <!-- enumerate all photos -->
                                <img id="{{photo.id}}" ng-repeat="photo in photos" class="slide img-rounded img-responsive center-block" ng-show="isActive($index)" ng-swipe-right="showPrev()" ng-swipe-left="showNext()" ng-src="{{photo.src}}" />

                                <!-- prev / next controls -->
                                <!-- extra navigation controls -->
                                <ul class="navfoto">
                                    <li ng-repeat="photo in photos" ng-class="{'active':isActive($index)}">
                                        <img src="{{photo.src}}" alt="{{photo.desc}}" title="{{photo.desc}}" ng-click="showPhoto($index);" />
                                    </li>
                                </ul>

                            </div>
