
<?php
$data['page_title']='Products';
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
                                    <li class="breadcrumb-item"><a href="<?=base_url('dashboard')?>">Home</a></li>
                                    <!-- <li class="breadcrumb-item active" aria-current="page">Library</li> -->
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card">
                            <div class="card-body">
                                <div class="alert alert-danger" role="alert" style="display: none;" >
                                    
                                </div>
                                 <div class="alert alert-success" role="alert" style="display: none;" >
                                    
                                </div>
                                <h5 class="card-title  float-left">Products</h5>

                                <a id="add-btn" class="btn btn-primary float-right  " href="<?=base_url('products/add');?>">Add New<i class="mdi mdi-plus"></i></a>
                                <div class="table-responsive">
                                    <table id="data-table" class="table table-hover ">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Price </th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                                <th>Date added</th>
                                                <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if($result){?>
                                             <?php foreach($result as $key=>$row){?>
                                                <tr>
                                                    <td><?=$key+1;?></td>
                                                    <td><?=$row['name'];?></td>
                                                    <td><img id="img-thumb" src="<?=$base_path.$row['thumb'];?>"></td>
                                                    <td><span class="fas fa-rupee-sign"><?=$row['price'];?></span></td>
                                                    <td><?=$row['qty'];?></td>
                                                    <td><?php if($row['status']=='A') {?><div class="text-success" role="alert" >Active</div> <?php } else {?> <div class="text-danger" role="alert" >Inactive</div> <?php } ?></td>
                                                    <td><?= date("d-m-Y", strtotime($row['date_added']));?></td>
                                                    <td>
                                                        <div id="action-buttons">
                                                            <a class="btn btn-primary" href="<?=base_url('products/edit/'.$row['id'])?>"><i class="mdi mdi-pencil" data-toggle="tooltip" title="Edit"></i></a>
                                                            <a class="btn btn-danger" href="javascript:;" data-action="<?=base_url('products/delete')?>" onclick="deleteFunction(this,'<?=$row['id'];?>')" data-toggle="tooltip" title="Delete"><i class="mdi mdi-delete"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                             <tr>
                                                 <td colspan="8" align="center">No Result Found</td>
                                             </tr> 
                                        <?php } ?>    
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            
<?php
$this->load->view('admin/includes/footer');

?>
<script type="text/javascript">
    function deleteFunction(e,id) {
      if (confirm("Are You Sure ....?")) {
            $.ajax({
                type: "POST",
                url: $(e).data('action'),
                data: {'id':id},
                dataType: "json",
                
                success: function(res) {
                    if (res.status == 'success') {
                        $('.alert-success').show();
                        $('.alert-danger').hide();
                        $('.alert-success').html(res.message);
                        setTimeout(function() {
                            window.location.href = "<?=base_url('prodcuts');?>";
                        }, 1000);
                    } else {
                        $('.alert-success').hide();
                        $('.alert-danger').show();
                        $('.alert-danger').html(res.message);
                       
                    }
                },
                error: function() {}
            });
      }
  
}
</script>