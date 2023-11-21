<?php include('head.php') ;
$get_all_categories = db_select_query("SELECT * FROM categories ORDER BY id DESC") ;
?>
<style>
input[type="checkbox"]
{
    cursor:pointer;
}
    .swal2-modal
    {
        top:0px!important;
        left:0px!important;
    }
</style>

<body style="padding:0px;">
   
    <!-- header logo: style can be found in header-->
    <?php include('header.php')
?>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
            <?php include('sidebar.php')
?>
        <aside class="right-side right-padding">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h2>Products</h2>
                
            </section>
            <!--section ends-->
            <div class="container-fluid">
                <!--main content-->
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Basic charts strats here-->
                        <div class="panel">
                            <div class="panel-heading bg-primary">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-user"></i> Add Products
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body">
                                <div role="tabpanel">
                                    <!-- Nav tabs -->
                                    
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="Info">
                                            <div class="row">
                                              <form id="add-user-form"  method="post" action="ajax/add-product.php"  onsubmit="return false;"  enctype="multipart/form-data" >    
                                               <input type="hidden" name="table" value="products" >                                              
                                                <div class="col-md-9 col-sm-8">
                                                    <div class="panel-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" id="users">                                                                
                                                                <tr>
                                                                    <td> Title</td>
                                                                    <td>
                                                                        <input type="text" name="title" class="form-control" require>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> Select Category</td>
                                                                    <td>
                                                                        <select class="form-control package" name="category_id">
                                                                            <option value="">Select Category</option>
                                                                            <?php if($get_all_categories) {
                                                                            foreach($get_all_categories as $k =>$v){ ?>
                                                                                <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                                                                                <?php } 
                                                                            } ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Stock</td>
                                                                    <td>
                                                                        <input type="number" name="stock" class="form-control" require>
                                                                    </td>
                                                                </tr> 
                                                                <tr>
                                                                    <td>Price</td>
                                                                    <td>
                                                                        <input type="number" name="price" class="form-control" require>
                                                                    </td>
                                                                </tr>                                                                                                                            
                                                                 <tr>
                                                                    <td>Featued Image</td>
                                                                    <td>
                                                                      <input type="file" name="featued_image" class="form-control" require>
                                                                    </td>
                                                                </tr>
                                                                 <tr>
                                                                    <td>Add Size</td>
                                                                    <td>
                                                                        <div class="input_fields_wrap">
                                                                            <button class="add_field_button float-right pull-right btn-success" style="border: 0;margin-bottom:5px;padding: 5px 9px;border-radius: 7px;">Add Size</button>
                                                                            <!-- <div><input type="text" name="size[]" class="form-control befor_exit_same_size" ></div> -->
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Description</td>
                                                                    <td>
                                                                        <textarea id="w3review" name="description" class="form-control" rows="4" cols="50"></textarea>
                                                                    </td>
                                                                </tr> 
                                                            </table>
                                                            </div>
                                                            </div>
                                                               
                                                            <div style="text-align: center;" class="">
                                                                <button type="submit" class="btn btn-primary">Add</button> &nbsp;
                                                                <a href = "product_view.php"  class="btn btn-danger">Cancel</a> &nbsp;                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- col-md-6 -->
                <!--row -->
                <!--row ends-->
            </div>
            <!-- /.content -->
        </aside>
        <!-- /.right-side -->
    </div>
    
    
    
    <!-- /.right-side -->
    <!-- ./wrapper -->
    <!-- global js -->
    <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/jquery-validate.min.js"></script>
        <script src="js/toastr.min.js"></script>
        <script src="js/sweetalert2.all.js"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/custom_js/app.js" type="text/javascript"></script>
    <script src="js/custom_js/metisMenu.js" type="text/javascript"></script>
    <script src="vendors/holder/holder.js" type="text/javascript"></script>
    <!-- end of page level js -->
    <!-- begining of page level js -->
    <script src="vendors/jasny-bootstrap/js/jasny-bootstrap.js" type="text/javascript"></script>
    <script src="vendors/x-editable/jquery.mockjax.js" type="text/javascript"></script>
    <script src="vendors/x-editable/bootstrap-editable.js" type="text/javascript"></script>
    <script src="vendors/x-editable/js/html5types.js" type="text/javascript"></script>
    <script src="vendors/summernote/summernote.min.js" type="text/javascript"></script>
    <script src="vendors/jasny-bootstrap/js/inputmask.js" type="text/javascript"></script>
    <script src="vendors/jasny-bootstrap/js/jquery.inputmask.js" type="text/javascript"></script>
    <script src="vendors/x-editable/js/demo-mock.js" type="text/javascript"></script>
    <script src="js/custom_js/club_info.js" type="text/javascript"></script>
    <!-- end of page level js -->
</body>
</html>


<script>
 
       
       
 $("#add-user-form").validate({
         rules:{
            category_id:{
            required:true,
            },
            title:{
            required:true,
            },
            price:{
            required:true,
            },
            featued_image:{
            required:true,
            },
            description:{
            required:true,
            },
            stock:{
            required:true,
            },
},
messages:{
    category_id:{
        required:"Please Select category",
    },
    title:{
        required:"Enter Title",
    },
    price:{
        required:"Enter Price",
    },
    featued_image:{
        required:"Choose Featued Image",
    },
    description:{
        required:"Enter Description",
    },
    stock:{
        required:"Enter Stock",
    }
},
         submitHandler: async (form, event)=>{
            event.preventDefault();  
            
            var values = [];
            var hasDuplicate = false;
            $('.befor_exit_same_size').each(function () {
                var value = $(this).val();            
                if (values.indexOf(value) !== -1) {
                    hasDuplicate = true;
                    return false;
                } else {
                    values.push(value);
                }
            });
            if (hasDuplicate) {
                alert('Size are not allowed same');
                return false;
            }else{
                var data=new FormData($(form)[0]);            
                    try {
                    var response=await fetch(form.action,{
                                method:form.method, 
                                body: data, 
                                dataType:'JSON',
                                credentials: 'same-origin',
                                });
                    
                    var json= await response.json();
                    if (json.result){
                        $(form).trigger('reset');
                            toastr.success(json.message) ; 
                            setTimeout(function(){ 
                                location.href="product_view.php"; 
                            }, 3000);                      
                    }else{               
                        toastr.error(json.message);  
                        }    
                    }catch(err) {              
                    toastr.error(err);
                    }             
                    //table.draw();
                    table.page(table.page.info().page).draw(false);;  

                    }        
         }  
      });    
   
 
 function info(pcid)
      {
        $('.show_desc-'+pcid).toggle() ;  
      }
        
  
  
</script>
<style>
    

.pricing-table .plan {
  margin-left:0px;
  border-radius: 5px;
  text-align: center;
  background-color: #f3f3f3;
  -moz-box-shadow: 0 0 6px 2px #b0b2ab;
  -webkit-box-shadow: 0 0 6px 2px #b0b2ab;
  box-shadow: 0 0 6px 2px #b0b2ab;
}
 
 .plan:hover {
  background-color: #fff;
  -moz-box-shadow: 0 0 12px 3px #b0b2ab;
  -webkit-box-shadow: 0 0 12px 3px #b0b2ab;
  box-shadow: 0 0 12px 3px #b0b2ab;
}
 
 .plan {
  padding: 20px;
  margin-left:0px;
  color: #ff;
  background-color: #5e5f59;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
   margin-right: 10px;
}
.panel-body h4 {
    float: left;
    width: 100%;
    background-color: #ddd;
    padding: 10px;
    margin-left: 0px;
     margin-top:10px;  
     margin-bottom :10px;
}
  
.plan-name-bronze {
  padding: 20px;
  color: #fff;
  background-color: #665D1E;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
 }
  
.plan-name-silver {
  padding: 20px;
  color: #fff;
  background-color: #313e4b;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
 }
  
.plan-name-gold {
  padding: 20px;
  color: #fff;
  background-color: #FFD700;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
  } 
  
.pricing-table-bronze  {
  padding: 20px;
  color: #fff;
  background-color: #f89406;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
}
  
.pricing-table .plan .plan-name span {
  font-size: 20px;
}
 
.pricing-table .plan ul {
  list-style: none;
  margin: 0;
  -moz-border-radius: 0 0 5px 5px;
  -webkit-border-radius: 0 0 5px 5px;
  border-radius: 0 0 5px 5px;
}
 
.pricing-table .plan ul li.plan-feature {
  padding: 15px 10px;
  border-top: 1px solid #c5c8c0;
  margin-right: 35px;
}

 
.pricing-variable-height .plan {
  float: none;
  margin-left: 2%;
  vertical-align: bottom;
  display: inline-block;
  zoom:1;
  *display:inline;
}
 
.plan-mouseover .plan-name {
  background-color: #4e9a06 !important;
}
 
.btn-plan-select {
  padding: 8px 25px;
  font-size: 18px;
}
.pricing-three-column {
    /* margin: 0 auto; */
    width: 100%;
    float: left;
}
.plan.col-md-3 {
    width: 24%;
}

.add_more_sizes{
    width: 100%;
    float: left;
    margin-top: 7px;
}
.add_more_sizes input{
    width: calc(100% - 100px);
    float: left;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
}
.add_more_sizes a{
    background: red;
    color: #fff;
    padding: 2px 9px;
    border-radius: 7px;
    vertical-align: text-bottom;
    float: left;
    margin-left: 15px;
}
</style>


<script>
    $(document).ready(function() {
    var max_fields      = 50; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="add_more_sizes"><input type="text" name="size[]" class="befor_exit_same_size"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

</script>
