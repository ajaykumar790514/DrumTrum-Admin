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
        margin: 0;
        padding: 0;
    }
    .container {
        width: 200px;
            margin: 20px auto;
            padding: 20px;
            height: 330px;
    }
    h2 {
        text-align: center;
    }
    .barcode {
        text-align: center;
        margin-top: 20px;
    }
    .barcode img {
        width: 176px;
        height: auto;
        position: relative;
        top: -20px;
    }
    .details {
        margin-top: 20px;
    }
    .details p {
        margin: 5px 0;
    }
    .color {
        margin-bottom: -23px;
        margin-top: -10px; 
    }
    .p-name {
        font-size: 12px;
        text-align: center;
        line-height: 10px;
        margin-top: -8px;
        width: 100%;
    }
    .header {
        width: 100%;
    }
    .header table {
        width: 100%;
    }
    .header td {
        padding: 5px;
        text-align: center;
    }
    .product table {
        width: 100%;
    }
    .product td {
        padding: 5px;
        text-align: center;
    }
    .product .details {
        text-align: left;
        line-height: 15px;
        position: relative;
        top: -48px;
    }
    .print-btn {
        background-color: red;
        color: #fff;
        border: none;
        float: right;
        padding: 6px;
        border-radius: 15px;
    }
		}
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 200px;
            margin: 20px auto;
            padding: 20px;
            height: 330px;
        }
        h2 {
            text-align: center;
        }
        .barcode {
            text-align: center;
            margin-top: 20px;
        }
        /* .barcode img {
            width: 176px;
    height: auto;
    position: relative;
    top: -20px;
    
        } */
        .barcode img {
        width: 100%;
        max-width: 100%;
        height: auto;
        position: relative;
        top: -20px;
        display: block;
        margin: 0 auto;
        image-rendering: -webkit-optimize-contrast; /* For Webkit browsers */
        image-rendering: crisp-edges;
        -ms-interpolation-mode: nearest-neighbor; /* For IE */
    }
        .details {
            margin-top: 20px;
        }
        .details p {
            margin: 5px 0;
        }
        .color
        {
            margin-bottom: -23px;
    margin-top: -10px; 
        }
        .p-name
        {
            font-size: 12px;
    text-align: center;
    line-height: 10px;
    margin-top: -8px;
    width: 100%;
        }
        .header
        {
            width: 100%;
        }
        .header table {
            width: 100%;
        }
        .header td {
            padding: 5px;
            text-align: center;
        }
        .product table {
            width: 100%;
        }
        .product td {
            padding: 5px;
            text-align: center;
        }
        .product .details {
            text-align: left;
    line-height: 15px;
    position: relative;
    top: -31px;
        }
        .print-btn
        {
            background-color: red;
            color: #fff;
            border: none;
            float: right;
            padding: 6px;
            border-radius: 15px;
        }
    </style>
</head>
<body  onload="window.print()">
    <div class="container" id="slipContainer">
        <div class="header">
            <table>
                <tr>
                    <td>
                        <span>MRP</span><br>
                        <span style="position: relative;top:0px;;">Rs. 1100.00</span><br>
                        <span style="position: relative;top:1px;font-size: 14px;;"> ( Inclusive of all taxes )</span>
                    </td>
                    <td style="    border: 1px solid black;float: right;width: 79px; height: 91px;">
                        <span style="position: relative;top: 19px;">Size</span></br>
                        <?php $prop = $this->master_model->get_property_val_new($product->id);
                         foreach($prop as $p):
                         if($p->name=='Size'){?>
                        <span  style="position: relative;top: 27px;"><?=$p->value;?></span>
                        <?php } endforeach;?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="product">
        <table>
                <tr>
                    <td>
                    <span class="p-name"><?=$product->name;?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                    <span class="color" style=" text-align: center;">Colour : 
                    <?php $prop = $this->master_model->get_property_val_new($product->id);
                         foreach($prop as $p):
                         if($p->name=='Color'){?>
                        <?=$p->value;?>
                        <?php } endforeach;?>
                    </span>
                    </td>
                </tr>
                <tr>
                    <td>
                    <div class="barcode">
                    <img src="<?=IMGS_URL.$product->barcode;?>"  alt="Barcode">
                    </div>
                    </td>
                </tr>
                <tr>
                    <td>
                    <div class="details">
                    <span>Marketed By: <?=$product->shop_name;?></span></br>
                    <p style="top: 6px;position: relative;">Customer Care: </p>
                    <p style="top: 6px;position: relative;"> <?=$product->shop_email;?></p>
                    </div>
                    </td>
                </tr>
            </table>
        </div>
        
        
       
       
    </div>
   