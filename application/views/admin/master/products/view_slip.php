<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clothes Barcode Slip</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/fav-icon.png'); ?>">
    <link href="<?= base_url('assets/vendor/fontawesome/css/all.min.css'); ?>" rel="stylesheet">
	<style type="text/css">
        @page {
		  size: A1 portrait;
		}
		@page {
		  size: A1 portrait;
		}

		@page :first {
			margin-top: 35pt;
		}
		@page :left {
			margin-right: 30pt;
		}
		@page :right {
			margin-left: 30pt;
		}
		@media print {
            body{
                font-weight: 300;
            }
			footer {
				display: none;
				position: fixed;
				bottom: 0;
			}
			header {
				display: none;
				position: fixed;
				top: 0;
			}
            .container {
				display: none;
				position: fixed;
				top: 0;
			}
            
		}
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-weight: 300;
        }
        .container {
            width: 280px;
            margin: 20px auto;
            border: 1px solid #ccc;
            padding: 20px;
        }
        h2 {
            text-align: center;
        }
        .barcode {
            text-align: center;
            margin-top: 20px;
        }
        .barcode img {
            width: 100%;
            height: auto;
        }
        .details {
            margin-top: 20px;
        }
        .details p {
            margin: 5px 0;
        }
        .color
        {
            text-align: center;
            margin-bottom: -15px; 
        }
        .p-name
        {
            font-size: 10px;
            text-align: center;
            line-height: 10px;
            margin-top: 10px;
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
<body>
    <div class="container" id="slipContainer">
        <div class="header">
            <table>
                <tr>
                    <td>
                        <h2>MRP</h2>
                        <h4><b>Rs. 1100.00</b></h4>
                    </td>
                    <td style="border:1px solid black;">
                        <h2>Size</h2>
                        <?php $prop = $this->master_model->get_property_val_new($product->id);
                         foreach($prop as $p):
                         if($p->name=='Size'){?>
                        <h4><?=$p->value;?></h4>
                        <?php } endforeach;?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="product">
        <table>
                <tr>
                    <td>
                    <h2 class="p-name"><?=$product->name;?></h2>
                    </td>
                </tr>
                <tr>
                    <td>
                    <h4 class="color">Colour : 
                    <?php $prop = $this->master_model->get_property_val_new($product->id);
                         foreach($prop as $p):
                         if($p->name=='Color'){?>
                        <?=$p->value;?>
                        <?php } endforeach;?>
                    </h4>
                    </td>
                </tr>
                <tr>
                    <td>
                    <div class="barcode">
                        <img src="<?=$product->barcode;?>" alt="Barcode">
                    </div>
                    </td>
                </tr>
                <tr>
                    <td>
                    <div class="details">
                    <h4 style="color:black">Manufactured By:</h4>
                    <p><strong><?=$product->shop_name;?></strong></p>
                    <p><strong>Email:</strong> <?=$product->shop_email;?></p>
                    </div>
                    </td>
                </tr>
            </table>
        </div>
        
        
       
       
    </div>
    <!-- <button class="print-btn" onclick="printSlip()">Print Slip</button> -->
    <button class="print-btn" onclick="downloadAsImage()">Download as Image</button>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script>
        function printSlip() {
            var printContents = document.getElementById("slipContainer").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
        function downloadAsImage() {
            html2canvas(document.getElementById("slipContainer")).then(canvas => {
                var link = document.createElement('a');
                link.download = 'slip_image.jpg';
                link.href = canvas.toDataURL();
                link.click();
            });
        }
    </script>
</body>
</html>
