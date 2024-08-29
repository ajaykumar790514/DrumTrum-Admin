<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clothes Barcode Slip</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/fav-icon.png'); ?>">
    <style type="text/css">

      @media print {
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
             font-weight: 300;
        }
        .container {
            padding-left: 40px;
    width: 370px;
    height: 260px;
    padding-top: 21px;
        }
        }

       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-weight: 300;
        }
        .container {
            padding-left: 40px;
    width: 370px;
    height: 260px;
    padding-top: 21px;
        }
        .left-top {
            width: 40%;
            float: left;
        }
        .left-top img {
            top: 80px;
            left: -5px;
            width: 215px;
            max-width: 250px;
        height: auto;
        position: relative;
        display: block;
        margin: 0 auto;
        image-rendering: -webkit-optimize-contrast; /* For Webkit browsers */
        image-rendering: crisp-edges;
        -ms-interpolation-mode: nearest-neighbor; /* For IE */
        }
        .right-top {
            width: 60%;
            float: right;
            text-align: center;
            line-height: 15px;
        }
        .right-top p {
            width: 100%;
            display: flex;
            font-size: 17px;
            text-align: center;
        }
        .right-top span {
            width: 100%;
            font-size: 16px;
            text-align: center;
            line-height: 17px;
        }
        .details {
            border: 1px solid black;
    position: relative;
    top: 25px;
    text-align: center;
    display: inline-table;
    width: 100%;
    line-height: 15px;
    padding: 13px;
        }
        .details span {
            font-size: 17px;
    line-height: 21px;
        }
        .print-btn {
            position: relative;
            top: 18px;
            background-color: red;
            color: #fff;
            border: none;
            float: right;
            padding: 5px;
            border-radius: 15px;
        }

    </style>
</head>
<body onload="window.print()">
<!-- onload="window.print()" -->
        <div class="container" id="slipContainer">
              <div class="left-top">
              <img src="<?=IMGS_URL.$product->barcode;?>" alt="Barcode">
              </div>
              <div class="right-top">
                <p><?= $product->name; ?></p>

                <?php
                $prop = $this->master_model->get_property_val_new($product->id);
                $size = '';
                $color = '';

                foreach ($prop as $p) {
                    if ($p->name == 'Size') {
                        $size = $p->value;
                    }
                    if ($p->name == 'Color') {
                        $color = $p->value;
                    }
                     if ($p->name == 'Colors') {
                        $color = $p->value;
                    }
                }
                ?>

                <?php if ($size): ?>
                    <span style="position: relative; top: -8px;">Size: <?= $size; ?></span><br>
                <?php endif; ?>

                <?php if ($color): ?>
                    <span style="position: relative; top: -8px;">Colour: <?= $color; ?></span><br>
                <?php endif; ?>

                <span style="position: relative;top: 9px;">MRP - <?= $product->mrp; ?></span><br>
                <span style="top: 9px; position: relative; font-size: 14px;">(Inclusive of all taxes)</span>
            </div>

              <div class="details">
                    <span>Marketed By : <?=$product->shop_name;?></span><br>
                    <!-- <span><?=$product->address.' '.$product->state_name.' '.$product->city_name.' '.$product->pin_code;?></span><br> -->
                    <span>Customer Care : <?=$product->shop_email;?></span><br>
                    
                    </div>
             
        
    </div>

</body>
</html>