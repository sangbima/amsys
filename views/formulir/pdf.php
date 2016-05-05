<?php
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\Output\QRImage;
use chillerlan\QRCode\Output\QRImageOptions;
use chillerlan\QRCode\QROptions;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Formulir Antar Hasil Panen</title>
  <style>
  *
      {
          margin:0;
          padding:0;
          font-family:Calibri, Arial;
          font-size:10pt;
          color:#000;
      }
      body
      {
          width:100%;
          font-family:Calibri, Arial;
          font-size:10pt;
          margin:0;
          padding:0;
          color: black;
      }

      p
      {
          margin:0;
          padding:0;
          color: black;
      }

      #wrapper
      {
          width:180mm;
          margin:0 15mm;
      }

      h1.heading
      {
          font-size:22pt;
          color:#000;
          font-weight:bold;
      }

      h2.heading
      {
          font-size:14pt;
          color:#000;
          font-weight:normal;
      }

      h3.heading
      {
          font-size:11pt;
          color:#000;
          font-weight:normal;
      }

      hr
      {
          color:#ccc;
          background:#ccc;
      }

    table {
      margin: 15px 0;
      table-layout: fixed;
      border-collapse: collapse;
      width: 100%; /* must have this set */
    }
    td, th{
      padding: 5px;
    }
    .pdfHeader{}
    .pdfDetail{}
    .pdfDetail td:nth-child(1),
    .pdfDetail td:nth-child(3) {
      width: 25%;
    }
    .pdfDetail td:nth-child(2) {
      width: 50%;
    }
    .detailTbl {
      border: 1px solid black;
    }
    .detailTbl td, .detailTbl th {
      border: 1px solid black;
    }
    .detailTbl td:nth-child(1) {
      width: 25%;
    }
    .detailTbl td:nth-child(2) {
      width: 75%;
    }
    .pdfFooter{
      margin: 0;
    }
    .nama {
      padding-bottom: 10px;
      border-bottom: 1px solid black;
      border-style: dotted dashed solid double;
    }
    .pdfFooter td {
      text-align: center;
    }
    .pdfFooter td:nth-child(1),
    .pdfFooter td:nth-child(3) {
      width: 25%;
    }
    .pdfFooter td:nth-child(2) {
      width: 50%;
    }

  </style>
</head>
<body>
  <div class="wrapper">
    <table class="pdfHeader">
      <tr>
        <td><img src="<?=Yii::$app->homeUrl?>/logo-bgr.png"/></td>
        <td style="border-bottom: 2px double #8c8c8c;">
          <h1 class="heading"><?=Yii::$app->params['companyName']?></h1>
          <h2 class="heading"><?=Yii::$app->params['companyTagline']?></h2>
          <h3 class="heading"><?=Yii::$app->params['companyAddress']?> Telp. <?=Yii::$app->params['companyPhone']?><br/>
          Email: <?=Yii::$app->params['companyEmail']?></h3>
          <!-- Yii::$app->params['uploadPath'] -->
        </td>
      </tr>
    </table>
    <table class="pdfDetail">
      <tr>
        <td>Tanggal</td><td>: 24 April 2016</td><td rowspan="3">
          <?php
            $qrImageOptions = new QRImageOptions;
            $qrImageOptions->type = QRCode::OUTPUT_IMAGE_PNG;

            $qrOptions = new QROptions;
            $qrOptions->typeNumber = QRCode::TYPE_05;
            $qrOptions->errorCorrectLevel = QRCode::ERROR_CORRECT_LEVEL_M;

            $qr = new QRCode($dataQR, new QRImage($qrImageOptions), $qrOptions);
            echo '<img src="'.$qr->output().'" />';
          ?>
        </td>
      </tr>
      <tr>
        <td>Nomor Surat</td><td>: 01/AL/04/2016</td>
      </tr>
      <tr>
        <td>Nomor Proposal</td><td>: <?=$data->no_proposal ?></td>
      </tr>
    </table>
    <p>Akan dilakukan pengangkutan panen terhadap:</p>
    <table class="detailTbl">
      <tr>
        <td>Pemilik Lahan</td><td><?=$data->petani->nama ?></td>
      </tr>
      <tr>
        <td>Lokasi</td><td><?=$data->lokasi->nama ?></td>
      </tr>
      <tr>
        <td>Tanggal Panen</td><td>...</td>
      </tr>
      <tr>
        <td>Kode Armada</td><td>...</td>
      </tr>
      <tr>
        <td>Nomor Polisi</td><td>...</td>
      </tr>
      <tr>
        <td>Supir</td><td>...</td>
      </tr>
      <tr>
        <td>Bobot Panen</td><td>...</td>
      </tr>
      <tr>
        <td height="150px" valign="top">Keterangan</td><td valign="top">...</td>
      </tr>
    </table>
    <br/>
    <p style="text-align:right;">Brebes, ... April 2016</p>
    <br/>
    <br/>
    <table class="pdfFooter">
      <tr>
        <td height="100px" valign="top">Armada</td><td></td><td valign="top">Admin BGR</td>
      </tr>
      <tr>
        <td><span class="nama" valign="bottom">(-- Nama Supir --)</span></td><td></td><td><span class="nama" valign="bottom">(-- Nama Admin --)</span></td>
      </tr>
    </table>
  </div>
  <htmlpagefooter name="footer">
    <hr />
  </htmlpagefooter>
  <sethtmlpagefooter name="footer" value="on" />
</body>
