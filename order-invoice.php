<?php
	include_once('functions/functions.php');
	include('head.php') ;
	///include ('./mpdf/vendor/autoload.php');

	$order_id=!empty($_GET['order_id'])?$_GET['order_id']:"";
	$product = db_select_query("SELECT * FROM sell_products WHERE order_id = '$order_id'"); 
	
	
	$html = '';
	 $html .='<bookmark content="Start of the Document" />
			<html lang="en">
			<body style="width:100%;">	
			<div  style="width:100%;text-align:center;margin-bottom:15px">				
				<img src="img/logo.png" alt="image not found"/>
				<br>
				<h5>Order Invoice</h5>
			</div>';


			$html .='<table class="table table-bordered" id="users" style="width:100%;border: 1px solid #ddd;"> 
					<tr style="border: 1px solid #ddd;">
						<th align="left" style="border: 1px solid #ddd;">Order id</th>
						<th align="left" style="border: 1px solid #ddd;">Product</th>
						<th align="left" style="border: 1px solid #ddd;">Qty</th>
						<th align="left" style="border: 1px solid #ddd;">Price</th>
						<th align="left" style="border: 1px solid #ddd;">Amount</th>
					</tr>';
					if($product){
						$sub_total = 0;
						$discount_amount = 0;
						foreach($product as $row){
							$discount_amount = $row['discount_amount'];
							$pro_details = json_decode($row["product_detail"]);
							$total = $row['quantity']*$pro_details->price;
							$sub_total += $row['quantity']*$pro_details->price;
							$html .='
								<tr style="border: 1px solid #ddd;">
								<td style="border: 1px solid #ddd;">'.$row["order_id"].'</td>
								<td style="border: 1px solid #ddd;">'.$pro_details->title.'</td>
								<td style="border: 1px solid #ddd;">'.$row['quantity'].'</td>
								<td style="border: 1px solid #ddd;">'.(int)$pro_details->price.' &nbsp;KD</td>
								<td style="border: 1px solid #ddd;">'.$total.' &nbsp;KD</td>
							</tr>';
						}
						$html .='<tr style="border: 1px solid #ddd;">
									<td style="border: 1px solid #ddd;" colspan="4" align="right">Discount Amount</td>
									<td style="border: 1px solid #ddd;" >'.(int)$discount_amount.' &nbsp;KD</td>
								</tr>';
						$html .='<tr style="border: 1px solid #ddd;">
									<td style="border: 1px solid #ddd;" colspan="4" align="right">Total</td>
									<td style="border: 1px solid #ddd;" >'.($sub_total - $discount_amount).' &nbsp;KD</td>
								</tr>';
					}
			$html .='</table>
					</body>
				</html>' ; 

	/// $mpdf = new \Mpdf\Mpdf();
	/// $mpdf->SetTitle('Order invoice');
	/// $mpdf->WriteHTML($html);
	/// $mpdf->Output('order_imvoice.pdf', 'I');
?>


<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
</head>
<body>

<!-- Trigger button -->


<!-- HTML content for PDF creation -->
<div style="width:80%;margin:0 auto;">
<div id="contentToPrint" >
    <?php echo $html;?>
</div>
</div>
<!-- <button onclick="Convert_HTML_To_PDF();">Download Invoice</button> -->
	<script>
		window.jsPDF = window.jspdf.jsPDF;
		// Convert HTML content to PDF
		function Convert_HTML_To_PDF() {
			var doc = new jsPDF();			
			// Source HTMLElement or a string containing HTML.
			var elementHTML = document.querySelector("#contentToPrint");
			doc.html(elementHTML, {
				callback: function(doc) {
					// Save the PDF
					doc.save('document-html.pdf');
				},
				margin: [10, 10, 10, 10],
				autoPaging: 'text',
				x: 0,
				y: 0,
				width: 190, //target width in the PDF document
				windowWidth: 675 //window width in CSS pixels
			});
		}		
		jQuery(document).ready(function(){
			Convert_HTML_To_PDF();
		})
		setTimeout(function(){ location.href='sell_product.php'; },500);
	</script>
</body>
</html>




