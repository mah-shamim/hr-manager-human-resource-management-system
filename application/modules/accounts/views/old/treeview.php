<link rel="stylesheet" href="<?php echo base_url() ?>assets/js/dist/themes/default/style.min.css" />
 <style type="text/css">
     .fa-folder{
        color:#D4AC0D;
     }
     .fa-folder-open-o{
        color:#D4AC0D;
     }
 </style>          
             <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                         
                        </div>
                    </div>

                    <div class="panel-body">


                        
                        <div class="row">
                <div class="col-md-6">
                    <div id="jstree1">
                        <ul>
                         <?php

                    $visit=array();
                    for ($i = 0; $i < count($userList); $i++)
                    {
                        $visit[$i] = false;
                    }

                    $this->accounts_model->dfs("COA","0",$userList,$visit,0);
                    
                    ?>
                        </ul>
                    </div>
                </div> 
<?php if($this->permission->method('accounts','update')->access() || $this->permission->method('accounts','create')->access()): ?>
                <div class="col-md-6" id="newform"></div>
                 <?php endif; ?>
            </div>
 </div> 
</div>
 </div> 
</div>
       <script src="<?php echo base_url() ?>assets/js/dist/jstree.min.js" ></script>

<script type="text/javascript">
$(document).ready(function () {
  $('#jstree1').jstree({
            'core' : {
                'check_callback' : true
            },
            'plugins' : [ 'types', 'dnd' ],
            'types' : {
                'default' : {
                    'icon' : 'fa fa-folder'
                },
                'html' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'svg' : {
                    'icon' : 'fa fa-file-picture-o'
                },
                'css' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'img' : {
                    'icon' : 'fa fa-file-image-o'
                },
                'js' : {
                    'icon' : 'fa fa-file-text-o'
                }

            }
        });
  });
</script>
     
 <script type="text/javascript">
function loadData(id){
   // alert(id);
    $.ajax({
        url : "<?php echo site_url('accounts/accounts/selectedform/')?>" + id,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
            $('#newform').html(data);
             $('#btnSave').hide();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}


</script>
<script type="text/javascript">
    function newdata(id){
     $.ajax({
        url : "<?php echo site_url('accounts/accounts/newform/')?>" + id,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
          // console.log(data.headcode);
           console.log(data.rowdata);
           var headlabel = data.headlabel;
           $('#txtHeadCode').val(data.headcode);
            document.getElementById("txtHeadName").value = '';
            $('#txtPHead').val(data.rowdata.HeadName);
            $('#txtHeadLevel').val(headlabel);
            $('#btnSave').prop("disabled", false);
             $('#btnSave').show();
            $('#btnUpdate').hide();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

</script>