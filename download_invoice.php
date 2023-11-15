<?php include_once('functions/functions.php');

$id=!empty($_GET['id'])?$_GET['id']:"" ;
$rand = $_GET['rand'] ;
$user = db_select_query("SELECT * FROM users where id = '$id'")[0] ;

$pck =  $user['packagesid'] ;
$tdt = date("j M, Y");

$qry = db_select_query("select * from packages where id = '$pck'")[0];

if(!empty($user['discount_code']) && !empty($user['after_discount_price']))
    							{
    							  $prc =  $user['after_discount_price']  ;  
    							   $dscnt_qry = db_select_query("select * from discount_code where id = '{$user['discount_code']}' ")[0] ;
                                   $discnt_code = $dscnt_qry['code'] ;
    							}
    							else
    							{
    							  $prc =  $qry['price'] ;
    							  
                                 $discnt_code = "No Discount" ;
    							}



 $show = '<!DOCTYPE html>
<html>

<body style="float:left;width:100%">
  
            <div class="container" style="padding:15px;width:100%; margin: 0 auto; float:left;border:1px solid #fc7070; padding-bottom:50px; border-top:15px solid #fc7070;">
               
                             
    <div class="row" style="width:100%; float:left">
        <div class="col-md-12">
            <h1 style="display: block;margin-left:auto;margin-right:auto;text-align:center;color:#fc7070;">THAICAMP</h1>
    		<div class="invoice-title" style="width:100%; float:left;border-bottom:2px solid #ddd;margin-bottom:20px">
    			<h2 style="width:50%; float:left">Invoice</h2><h3 class="pull-right" style="width:50%; float:left;text-align:right;">Invoice #'.$rand.'</h3>
    		</div>
    		<div class="row" style="width:100%; float:left">
    			<div class="col-md-6" style="width:50%; float:left">
    				<address style="font-style:normal;">
    				<strong>Billed To:</strong><br>'
    					.$user['name'].'<br>'
    					.$user['email'].'<br>
    					Mobile - '.$user['mobile'].'<br><br>
    				</address>
    			</div>
    			
    		</div>
    		<div class="row" style="width:100%; float:left">
    			<div class="col-md-6" style="width:50%; float:left">
    				<address style="font-style:normal;margin-bottom:25px;">
    					<strong>Payment Date:</strong><br>'
    					.$tdt.'<br>
    				
    				</address>
    			</div>
    		
    		</div>
    	</div>
    </div>
    
    
    <div class="row" style="width:100%; float:left;box-shadow: 0 1px 1px rgba(0,0,0,.05);">
    	<div class="col-md-12">
    		<div class="panel panel-default" style="">
    			<div class="panel-heading">
    				<h3 class="panel-title" style="width:97%;float:left;padding:15px;background:#f2f2f2;margin:0;"><strong>Package summary</strong></h3>
    			</div>
    			<div class="panel-body" >
    				<div class="table-responsive" style="">
    					<table class="table table-condensed" style="width:100%; padding:0 15px">
    						<thead>
                                <tr class="no-line">
        							<td style="width:35%; padding:5px; border-bottom:1px solid #ddd;"><strong>ID</strong></td>
        							<td style="width:25%; border-bottom:1px solid #ddd;" class="text-center"><strong>Name</strong></td>
        							<td style="width:25%;border-bottom:1px solid #ddd;" class="text-center"><strong>Duration</strong></td>
        							<td style="width:25%;border-bottom:1px solid #ddd;" class="text-center"><strong>Description</strong></td>
        							<td style="width:25%;border-bottom:1px solid #ddd;" class="text-center"><strong>Services</strong></td>
        							<td style="width:25%;border-bottom:1px solid #ddd;" class="text-center"><strong>Number of classes</strong></td>
        							<td style="width:25%;border-bottom:1px solid #ddd;" class="text-center"><strong>Discount Code</strong></td>
        							<td style="width:15%;border-bottom:1px solid #ddd;" class="text-right"><strong>Price</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							
    							<tr>
    							   	<td style="width:35%;padding:10px 0;border-bottom:2px solid;">'.$qry['package_id'].'</td>
    								<td style="width:25%;padding:10px 0;border-bottom:2px solid;" class="text-center">'.$qry['name'].'</td>
    								<td style="width:25%;padding:10px 0;border-bottom:2px solid;" class="text-center">'.$qry['duration'].' Days</td>
    								<td style="width:25%;padding:10px 0;border-bottom:2px solid;" class="text-center">'.$qry['description'].'</td>
    								<td style="width:25%;padding:10px 0;border-bottom:2px solid;" class="text-center">'.$qry['services'].'</td>
    								<td style="width:25%;padding:10px 0;border-bottom:2px solid;" class="text-center">'.$qry['pck_class'].'</td>
    								<td style="width:25%;padding:10px 0;border-bottom:2px solid;" class="text-center">'.$discnt_code.'</td>
    								<td style="width:15%;padding:10px 0;border-bottom:2px solid;" class="text-right">'.$prc.' KD</td>
    							</tr>
    							
                               
    							<tr>
    								
    								<td class="thick-line" style="padding:5px"></td>
    								<td class="thick-line" style="padding:5px"></td>
    								<td class="thick-line" style="padding:5px"></td>
    								<td class="thick-line" style="padding:5px"></td>
    								<td class="thick-line" style="padding:5px"></td>
    								<td class="thick-line" style="padding:5px"></td>
    								<td class="thick-line text-center" style="padding:5px"><strong>Total</strong></td>
    								<td class="thick-line text-right" style="padding:5px">'.$prc.' KD</td>
    							</tr>
    						
    						
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

        
            </div>
            
    

   
</body>


</html>' ;

 include_once("mpdf-development/vendor/autoload.php");

$mpdf = new \Mpdf\Mpdf();
// Write some HTML code:

$mpdf->WriteHTML($show);
$pdf_name='PDF_'.time().'.pdf';
// Output a PDF file directly to the browser
//$mpdf->Output('uploads/'.$pdf_name,'F');

$mpdf->Output($pdf_name,'D');



?>
