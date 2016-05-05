<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LokasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lokasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lokasi-index">
<div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-body">
                    <h3><?= Html::encode($this->title) ?><span style="margin-left:15px;"><?= Html::a('<i class="fa fa-plus"></i> Lokasi', ['create'], ['class' => 'btn btn-success']) ?></span></h3>

                    <div id="googleMap" style="width:100%;height:530px;"></div>

                </div>
            </div>
        </div>
    </div>

</div>

<?php $this->registerJs('
var myCenter=new google.maps.LatLng(-6.893463,109.667439);
function initialize() {
  var mapProp = {
    center:myCenter,
    zoom:7,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"), mapProp);
  var marker=new google.maps.Marker({
  position:myCenter,
  });

  marker.setMap(map);

  var infowindow = new google.maps.InfoWindow({
  content:"Pekalongan, 500 Ton Bawang"
  });

google.maps.event.addListener(marker, "click", function() {
  infowindow.open(map,marker);
  });
}
google.maps.event.addDomListener(window, "load", initialize);');

?>