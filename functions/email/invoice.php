<?php  
include_once('../functions.php');
extract($_REQUEST);

if(!isset($id)){
    exit();
}

$invoice  = db_select_query("SELECT invoice.*,influncer.name,influncer.location,influncer.phone FROM invoice
                             INNER JOIN influncer ON invoice.influencer_id = influncer.id
                             WHERE invoice.id = $id");
if(!$invoice){
    exit();
}

$invoice =$invoice[0];
?>
<html>
<head>
  <meta charset="utf-8">
  <title>Invoice</title>
</head>

<body>
  <header>
    <h1>Invoice</h1>
    <address contenteditable>
        <b>FROM:- </b>
      <p><?=$invoice['name']?></p>
      <p><?=$invoice['location']?></p>
      <p><?=$invoice['phone']?></p>
    </address>
    <span><img alt="" src="http://www.jonathantneal.com/examples/invoice/logo.png"><input type="file" accept="image/*"></span>
  </header>
  <article>
    <address contenteditable>
    <b>To:- </b>
      <p><?=$invoice['fullName']?><br><?=$invoice['address']?></p>
    </address>
    <table class="meta">
      <tr>
        <th><span contenteditable>Invoice #</span></th>
        <td><span contenteditable>#INV-<?=sprintf('%06d',$invoice['id']);?></span></td>
      </tr>
      <tr>
        <th><span contenteditable>Date</span></th>
        <td><span contenteditable><?= date('M d,Y')?></span></td>
      </tr>
      <tr>
        <th><span contenteditable>Amount Due</span></th>
        <td><span id="prefix" contenteditable>$</span><span><?=$invoice['totalPaidAmount']?></span></td>
      </tr>
    </table>
    <table class="inventory">
      <thead>
        <tr>
          <th><span contenteditable>Sr No.</span></th>
          <th><span contenteditable>Particulars</span></th>
          <th><span contenteditable>Amount</span></th>
          <th><span contenteditable>Quantity</span></th>
          <th><span contenteditable>Price</span></th>
        </tr>
      </thead>
      <tbody>
       <?php  $inv_row = json_decode($invoice['particular_details']);
       foreach($inv_row as $k =>$v){
       ?>
        <tr>
          <td><?= ++$k; ?></td>    
          <td><a class="cut">-</a><span contenteditable><?= $v->particularName;?></span></td>
          <td><span data-prefix>$</span> <?= $v->particularAmount;?></td>
          <td><?=$v->particularCount?></td>
          <td><span data-prefix>$</span><span><?= $v->particularAmount * $v->particularCount;?></span></td>
        </tr>
    <?php } ?>
      </tbody>
    </table>
    <table class="balance">
      <tr>
        <th><span contenteditable>Sub Total</span></th>
        <td><span data-prefix>$</span><span><?=$invoice['totalParticularAmount']?></span></td>
      </tr>
      <tr>
        <th><span contenteditable>SGST</span></th>
        <td><span data-prefix>$</span><span contenteditable><?=$invoice['totalSGST']?></span></td>
      </tr>
      <tr>
        <th><span contenteditable>CGST</span></th>
        <td><span data-prefix>$</span><span contenteditable><?=$invoice['totalCGST']?></span></td>
      </tr>
      <tr>
        <th><span contenteditable>Total Amount</span></th>
        <td><span data-prefix>$</span><span contenteditable><?=$invoice['totalPaidAmount']?></span></td>
      </tr>
    </table>
  </article>
  <aside>
    <h1><span contenteditable>Payment Detail</span></h1>
    <div contenteditable>
      <p>Benificiary Name : - <?=$invoice['beneficiaryName'];?></p><br>
      <p>Bank Name : - <?=$invoice['bankName'];?></p><br>
      <p>Account Number : - <?=$invoice['accountNo'];?></p><br>
      <p>IFSC Code : - <?=$invoice['ifscCode'];?></p><br>
    </div>
  </aside>
</body>



<style>
    /* reset */

* {
  border: 0;
  box-sizing: content-box;
  color: inherit;
  font-family: inherit;
  font-size: inherit;
  font-style: inherit;
  font-weight: inherit;
  line-height: inherit;
  list-style: none;
  margin: 0;
  padding: 0;
  text-decoration: none;
  vertical-align: top;
}

/* content editable */

*[contenteditable] {
  border-radius: 0.25em;
  min-width: 1em;
  outline: 0;
}

*[contenteditable] {
  cursor: pointer;
}

*[contenteditable]:hover,
*[contenteditable]:focus,
td:hover *[contenteditable],
td:focus *[contenteditable],
img.hover {
  background: #def;
  box-shadow: 0 0 1em 0.5em #def;
}

span[contenteditable] {
  display: inline-block;
}

/* heading */

h1 {
  font: bold 100% sans-serif;
  letter-spacing: 0.5em;
  text-align: center;
  text-transform: uppercase;
}

/* table */

table {
  font-size: 75%;
  table-layout: fixed;
  width: 100%;
}
table {
  border-collapse: separate;
  border-spacing: 2px;
}
th,
td {
  border-width: 1px;
  padding: 0.5em;
  position: relative;
  text-align: left;
}
th,
td {
  border-radius: 0.25em;
  border-style: solid;
}
th {
  background: #eee;
  border-color: #bbb;
}
td {
  border-color: #ddd;
}

/* page */

html {
  font: 16px/1 "Open Sans", sans-serif;
  overflow: auto;
  padding: 0.5in;
}
html {
  background: #999;
  cursor: default;
}

body {
  box-sizing: border-box;
  height: 11in;
  margin: 0 auto;
  overflow: hidden;
  padding: 0.5in;
  width: 8.5in;
}
body {
  background: #fff;
  border-radius: 1px;
  box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
}

/* header */

header {
  margin: 0 0 3em;
}
header:after {
  clear: both;
  content: "";
  display: table;
}

header h1 {
  background: #000;
  border-radius: 0.25em;
  color: #fff;
  margin: 0 0 1em;
  padding: 0.5em 0;
}
header address {
  float: left;
  font-size: 75%;
  font-style: normal;
  line-height: 1.25;
  margin: 0 1em 1em 0;
}
header address p {
  margin: 0 0 0.25em;
}
header span,
header img {
  display: block;
  float: right;
}
header span {
  margin: 0 0 1em 1em;
  max-height: 25%;
  max-width: 60%;
  position: relative;
}
header img {
  max-height: 100%;
  max-width: 100%;
}
header input {
  cursor: pointer;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  height: 100%;
  left: 0;
  opacity: 0;
  position: absolute;
  top: 0;
  width: 100%;
}

/* article */

article,
article address,
table.meta,
table.inventory {
  margin: 0 0 3em;
}
article:after {
  clear: both;
  content: "";
  display: table;
}
article h1 {
  clip: rect(0 0 0 0);
  position: absolute;
}

article address {
  float: left;
  font-size: 125%;
  font-weight: bold;
}

/* table meta & balance */

table.meta,
table.balance {
  float: right;
  width: 36%;
}
table.meta:after,
table.balance:after {
  clear: both;
  content: "";
  display: table;
}

/* table meta */

table.meta th {
  width: 40%;
}
table.meta td {
  width: 60%;
}

/* table items */

table.inventory {
  clear: both;
  width: 100%;
}
table.inventory th {
  font-weight: bold;
  text-align: center;
}

table.inventory td:nth-child(1) {
  width: 26%;
}
table.inventory td:nth-child(2) {
  width: 38%;
}
table.inventory td:nth-child(3) {
  text-align: right;
  width: 12%;
}
table.inventory td:nth-child(4) {
  text-align: right;
  width: 12%;
}
table.inventory td:nth-child(5) {
  text-align: right;
  width: 12%;
}

/* table balance */

table.balance th,
table.balance td {
  width: 50%;
}
table.balance td {
  text-align: right;
}

/* aside */

aside h1 {
  border: none;
  border-width: 0 0 1px;
  margin: 0 0 1em;
}
aside h1 {
  border-color: #999;
  border-bottom-style: solid;
}

/* javascript */

.add,
.cut {
  border-width: 1px;
  display: block;
  font-size: 0.8rem;
  padding: 0.25em 0.5em;
  float: left;
  text-align: center;
  width: 0.6em;
}

.add,
.cut {
  background: #9af;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
  background-image: -moz-linear-gradient(#00adee 5%, #0078a5 100%);
  background-image: -webkit-linear-gradient(#00adee 5%, #0078a5 100%);
  border-radius: 0.5em;
  border-color: #0076a3;
  color: #fff;
  cursor: pointer;
  font-weight: bold;
  text-shadow: 0 -1px 2px rgba(0, 0, 0, 0.333);
}

.add {
  margin: -2.5em 0 0;
}

.add:hover {
  background: #00adee;
}

.cut {
  opacity: 0;
  position: absolute;
  top: 0;
  left: -1.5em;
}
.cut {
  -webkit-transition: opacity 100ms ease-in;
}

tr:hover .cut {
  opacity: 1;
}

@media print {
  * {
    -webkit-print-color-adjust: exact;
  }
  html {
    background: none;
    padding: 0;
  }
  body {
    box-shadow: none;
    margin: 0;
  }
  span:empty {
    display: none;
  }
  .add,
  .cut {
    display: none;
  }
}

@page {
  margin: 0;
}

</style>

</html>