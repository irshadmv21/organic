
<?php
$data['page_title']=@$headding;
$this->load->view('admin/includes/header',$data);

?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Products</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                    <!-- <li class="breadcrumb-item active" aria-current="page">Library</li> -->
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="col-md-12" data-select2-id="15">
                        <div class="card">
                            <div class="card-body wizard-content">
                                <h4 class="card-title">Basic Form Example</h4>
                                <h6 class="card-subtitle"></h6>
                                <form id="product-form" action="#" class="m-t-40" data-action="<?=@$action;?>">
                                
                                    
                                    <div>
                                        <div class="alert alert-danger" role="alert" style="display: none;" ></div>
                                        <h3>Basic</h3>
                                        <section>
                                            <label for="name">Product Name <span class="text-danger">*</span></label>
                                            <input id="name" name="name" type="text" class="required form-control" value="<?=@$product['name']?>" placeholder="Enter product name">

                                            <label for="name">Description <span class="text-danger">*</span></label>
                                            <textarea class="form-control required" id="description" name="description" placeholder="Enter description"><?=@$product['description']?></textarea>
                                            
                                            <label for="price">Price <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control required" id="price" placeholder="Enter price" value="<?=@$product['price']?>" name="price">

                                            <label for="offer_percentage">Offer (%) <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control required" id="offer_percentage" placeholder="Enter offer percentage" value="<?=@$product['offer_percentage']?>" name="offer_percentage">

                                            <label for="qty">Quantity <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control required" id="qty" placeholder="Enter quantity" value="<?=@$product['qty']?>" name="qty">

                                            <label for="unit_size">Unit Size <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control required" id="unit_size" placeholder="Enter unit size (eg:- kg,gm,pack)" value="<?=@$product['unit_size']?>" name="unit_size">

                                            <label  for="category_id">Category</label>
                                            <select class="select2 form-control required" multiple="multiple" name="category_id[]" id="">
                                                <option></option>
                                                <?php if($categories){ ?>
                                                    <?php foreach ($categories as $key => $value) {?>
                                                        <?php if(in_array($value['id'], $category_ids)){?>
                                                            <option value="<?=$value['id']?>" selected><?php  if($value['parent_name'] != null){ echo $value['parent_name'].'->'.$value['name']; }else{ echo $value['name']; }?></option>
                                                        <?php }else{ ?>
                                                            <option value="<?=$value['id']?>"><?php  if($value['parent_name'] != null){ echo $value['parent_name'].'->'.$value['name'];}else{ echo $value['name']; }?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>

                                            <label  for="category_id">Farmers</label>
                                            <select class="select2 form-control required" multiple="multiple" name="farmers_id[]" id="">
                                                <option></option>
                                                <?php if($farmers){ ?>
                                                    <?php foreach ($farmers as $key => $value) {?>
                                                        <?php if(in_array($value['id'], $farmers_id)){?>
                                                            <option value="<?=$value['id']?>" selected><?=$value['name'];?></option>
                                                        <?php }else{ ?>
                                                            <option value="<?=$value['id']?>"><?=$value['name'];?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>

                                            <label for="custom-image" id="image-label">Image</label>
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input " id="custom-image" onchange="readURL(this);" >
                                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                                            </div>
                                            <img id="img-thumb_130" src="<?=$base_path.@$product['thumb'];?>" <?php if(!@$product['thumb']){?> style="display: none;" <?php } ?>>
                                            
                                            <label for="status" class="">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="A" <?php if(@$product['status']=='A'){?> selected <?php } ?>>Active</option>
                                                <option value="I" <?php if(@$product['status']=='I'){?> selected <?php } ?>>Inactive</option>
                                            </select>
                                        
                                            
                                            <p>(<span class="text-danger">*</span>) Mandatory</p>
                                        </section>

                                        <h3>Options</h3>
                                        <section>
                                            <div class="row float-right">
                                                <a href="javascript:;" id="option-btn" class="btn btn-primary" >Add<i class="mdi mdi-plus"></i></a>
                                            </div>
                                            <input type="hidden" name="option_count" id="option_count" value=<?=@$option_count;?>>
                                            <label for="is_home" class="">Options</label>
                                            <div  id="option-div">
                                                <?php if(@$product_options){?>
                                                    <?php foreach ($product_options as $key => $option) {?>
                                                            <div class="row"> 
                                                                <input type="hidden" name="option_id[]" value="<?=@$option['id'];?>">
                                                                <div class="col-3"><input type="text" name="option_name[]" class="form-control "  placeholder="option name" value="<?=@$option['name'];?>"></div>
                                                                <div class="col-3"><input type="number" name="option_price[]" class="form-control "  placeholder="price" value="<?=@$option['price'];?>"></div>
                                                                <div class="col-2"><input type="number" name="option_quantity[]" class="form-control "  placeholder="quantity" value="<?=@$option['qty'];?>"></div>
                                                                <div class="col-2">
                                                                    <select name="price_prifix[]" class="form-control required">
                                                                        <option class="+" <?php if($option['price_prefix'] =='+') echo "selected" ?>>+</option>
                                                                        <option class="-" <?php if($option['price_prefix'] =='-') echo "selected" ?>>-</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-2"><button class="btn btn-danger" title="delete"><span class="fas fa-trash"></span></button></div>
                                                            </div>
                                                    <?php } ?>
                                                <?php }?>

                                            </div>
                                        </section>
                                        <h3>Images</h3>
                                        <section>
                                          <label for="pro-image" class="">Multiple Images</label>
                                            <div class="custom-file">
                                                <input type="file" id="pro-image" name="pro_image[]" style="" class="form-control" multiple>
                                                <label class="custom-file-label" for="validatedCustomFile" onclick="$('#pro-image').click()">Choose file...</label>
                                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                                            </div>
                                            <div class="custom-file">
                                                <div class="preview-images-zone">
                                                    <div class="preview-image preview-show-1">
                                                        <div class="image-cancel text-danger" data-no="1"><span class="fas fa-trash"></span></div>
                                                        <div class="image-zone"><img id="pro-img-1" src="https://img.purch.com/w/660/aHR0cDovL3d3dy5saXZlc2NpZW5jZS5jb20vaW1hZ2VzL2kvMDAwLzA5Ny85NTkvb3JpZ2luYWwvc2h1dHRlcnN0b2NrXzYzOTcxNjY1LmpwZw=="></div>
                                                    </div>
                                                </div>
                                            </div>    
                                        </section>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
            
<?php
$this->load->view('admin/includes/footer');

?>
<script type="text/javascript">
    

$('body').on('click', '#option-btn', function() {
    var count=parseInt($('#option_count').val());
    count=count+1;
    var html="";
    html +='<input type="hidden" name="option_id[]" >';
    html +='<div class="row">';
    html +='<div class="col-3"><input type="text" name="option_name[]" class="form-control"  placeholder="option name"></div>';
    html +='<div class="col-3"><input type="number" name="option_price[]" class="form-control"  placeholder="price"></div>';
    html +='<div class="col-2"><input type="number" name="option_quantity[]" class="form-control"  placeholder="quantity"></div>';
    html +='<div class="col-2">';
    html +='<select name="price_prifix[]" class="form-control">';
    html +='<option class="+">+</option>';
    html +='<option class="-">-</option>';
    html +='</select>';
    html +='</div>';
    html +='<div class="col-2"><button class="btn btn-danger" title="delete"><span class="fas fa-trash"></span></button></div>';
    html +='</div>';
    $('#option_count').val(count);
    $('#option-div').append(html);
});

var form = $("#product-form");
form.validate({
    errorPlacement: function errorPlacement(error, element) { 
        if (element.attr("name") == "image" ){
            error.insertAfter("#image-label");
        }else{
            element.before(error);
        }
    },
    rules: {
        confirm: {
            equalTo: "#password"
        }
    },
    messages: {
        confirm: {
            equalTo: 'INVALID PASSWORD'
        }
    },
});
form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function(event, currentIndex, newIndex) {
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function(event, currentIndex) {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function(event, currentIndex) {
        var form = $("#product-form")[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        formData.append('image', $('#custom-image').prop('files')[0]);
        var totalfiles = document.getElementById('pro-image').files.length;
        
        for (var index = 0; index < totalfiles; index++) {
            formData.append("pro_image[]", document.getElementById('pro-image').files[index]);
        }

        $.ajax({
            type: "POST",
            url: $("#product-form").data('action'),
            data: formData,
            dataType: "json",
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            async: false,
            beforeSend: function() {
                $("body").addClass("loading");
            },
            success: function(res) {
                $("body").removeClass("loading");
                if (res.status == 'success') {
                    
                    setTimeout(function() {
                        window.location.href = "<?=base_url('products');?>";
                    }, 1000);
                } else {
                    $('.alert-danger').show();
                    $('.alert-danger').html(res.message);
                   
                }
            },
            error: function() {}
        });
    }
});

$(".select2").select2({
    placeholder: "Select categories"
});

document.getElementById('pro-image').addEventListener('change', readImage, false);
    
$( ".preview-images-zone" ).sortable();

    
$(document).on('click', '.image-cancel', function() {
    let no = $(this).data('no');
    $(".preview-image.preview-show-"+no).remove();
});
var num = 4;
function readImage() {

    if (window.File && window.FileList && window.FileReader) {
        var files = event.target.files; //FileList object
        var output = $(".preview-images-zone");

        for (let i = 0; i < files.length; i++) {
            var file = files[i];
            if (!file.type.match('image')) continue;
            
            var picReader = new FileReader();
            
            picReader.addEventListener('load', function (event) {
                var picFile = event.target;
                var html =  '<div class="preview-image preview-show-' + num + '">' +
                            '<div class="image-cancel text-danger" data-no="' + num + '"><span class="fas fa-trash"></span></div>' +
                            '<div class="image-zone"><img id="pro-img-' + num + '" src="' + picFile.result + '"></div>' +
                            // '<div class="tools-edit-image"><a href="javascript:void(0)" data-no="' + num + '" class="btn btn-light btn-edit-image">edit</a></div>' +
                            '</div>';

                output.append(html);
                num = num + 1;
            });

            picReader.readAsDataURL(file);
        }
        // $("#pro-image").val('');
    } else {
        console.log('Browser not support');

       
    }
}
</script>
