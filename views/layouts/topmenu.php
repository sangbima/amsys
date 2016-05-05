<?php
use yii\helpers\Url;
?>
<div class="menuatas">
<nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href=<?= Url::toRoute('site/index');?>><i class="fa fa-home" style="color:#30A5FF"></i> Beranda</a></li>
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-scissors" style="color:#FFB53E"></i> Tebasan <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href=<?= Url::toRoute('produksi/index');?>>Proposal</a></li>
                  
                </ul>
              </li>
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bar-chart" style="color:#ef2222"></i> Transaksi <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href=<?= Url::toRoute('lapak/index');?>>Angkut Lapak</a></li>
                  <li><a href="#">Angkut Gudang</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file" style="color:#2ded14"></i> Laporan <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href=<?= Url::toRoute('map/lokasi');?>>Peta luas Lahan</a></li>
                  <li><a href=<?= Url::toRoute('map/info-harga');?>>Peta harga Pasar</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-database" style="color:#fff"></i> Master Data <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href=<?= Url::toRoute('lahan/index');?>>Lahan</a></li>
                  <li><a href=<?= Url::toRoute('petani/index');?>>Petani</a></li>
                  <li><a href=<?= Url::toRoute('armada/index');?>>Armada</a></li>
                  <li><a href=<?= Url::toRoute('supir/index');?>>Supir</a></li>
                  <li><a href=<?= Url::toRoute('lapak/index');?>>Lapak</a></li>
                  <li><a href=<?= Url::toRoute('site/index');?>>Gudang</a></li>
                  <li><a href="#">Pasar</a></li>
                  <li><a href="#">Varietas</a></li>
                  <li><a href=<?= Url::toRoute('lokasi/index');?>>Lokasi</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear" style="color:#fdf9b2"></i> Konfigurasi <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">User</a></li>
                  <li><a href="#">Group</a></li>
                  <li><a href="#">Permission</a></li>
                </ul>
              </li>

              
            </ul>
            
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
</div>

