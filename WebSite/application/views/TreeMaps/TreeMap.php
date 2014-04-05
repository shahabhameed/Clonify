<div id="wrapper">
    <?php
    include VIEW_PARTIAL_FOLDER_PATH . '/sidebar.php';
    ?>
    <!--Body content-->
    <div id="content" class="clearfix">
        <div class="contentwrapper"><!--Content wrapper-->
            <div class="heading">
                <h3></h3>    
                <ul class="breadcrumb">
                    <li>You are here:</li>
                    <li>
                    </li>
                    <li class="active">Tree Map</li>
                </ul>
            </div><!-- End .heading-->

            <div>
                <form method="post" accept-charset="utf-8" action="<?php echo base_url(); ?>index.php/" >


                    <div class="row col-lg-12">
                        <div class="panel panel-default gradient">
                            <div class="panel-heading">
                                <h4><span class="icon16 fa fa-cloud-upload"></span>
                                    <span >Tree Map</span></h4>
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                            <div class="panel-body noPad clearfix">
                                <div class="row ">
                                    <div class=" box gradient col-lg-12">
                                        <div class="content noPad col-lg-12">
                                            <button class=" btn btn-info pull-left col-lg-2" style="display:none" type="submit">View Tree Map</button>
                                        </div>  
                                    </div>
                                </div>

                                <div class="row col-lg-12">        
                                    <div class="form-group">
                                        <div class="col-lg-12 box">
                                            <div class="panel panel-default">
                                                <div class="panel-body1">
                                                    <div class="form-group">
                                                        <div id="treemap" align="center" class="marginL20 col-lg-12 "></div>
                                                    </div>
                                                </div><!-- End .panel body -->
                                            </div>
                                        </div><!-- End .span8 -->
                                    </div> 
                                </div><!-- End .panel -->
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div><!-- End contentwrapper -->
    </div><!-- End #content -->

</div><!-- End #wrapper -->

<script type="text/javascript" charset="utf-8">

    function loadTreeMap(data) {
    $('#treemap').jqxTreeMap({
            width: 1000,
            height: 800,
            source: data,
            colorRange: 150,
            renderCallbacks: {
            '*': function(element, value) {
            if (value.data) {
            element.jqxTooltip({
            content: '<div><div class="btn-primary "  style="font-weight: text-align: right; bold; width: auto; font-family: verdana; font-size: 13px;"><span align: left;>' + value.data.title + 
                    '</span></div><div class="btn-default  " style="width: auto; font-family: verdana; font-size: 12px;">' + value.data.description + '</div></div>',

            
            position: 'mouse',
                    autoHideDelay: 6000
            });
            } else if (value.data === undefined) {
            element.css({
            backgroundColor: '#fff',
                    border: '1px solid #555'
            });
            }
            }
            }
    });
    }

    $(function(fcs_id) {
    var data = [
   



<?php
$treemapdata = Array (
"2" => Array (
    "cmdid" => "0",
    "did" => "2",
    "dname" => "",
    "dsize" => "9752",
    "files" => Array (),
    "children" => Array (
                "125" => Array (
                "cmdid" => "0",
                "did" => "125",
                "dname" => "JAVA/JAVA_1/",
                "dsize" => "2041",
                "files" => Array (
                        "0" => Array (
                                "dname" => "JAVA/JAVA_1/",
                                "filename" => "2.java",
                                "filepath" => "C:/xampp/htdocs/Clonify/WebSite/files/shaban/JAVA/JAVA_1/2.java",
                                "fsize" => "2041"
                                     )
                                ),
                "children" => Array ( )
                ),
                "126" => Array (
                "cmdid" => "1",
                "did" => "126",
                "dname" => "JAVA/JAVA_2/",
                "dsize" => "17653",
                "files" => Array (
                            "0" => Array (
                            "dname" => "JAVA/JAVA_2/",
                            "filename" => "3.java",
                            "filepath" => "C:/xampp/htdocs/Clonify/WebSite/files/shaban/JAVA/JAVA_2/3.java",
                            "fsize" => "7711",
                            )
                            ),
                "children" => Array (
                            "127" => Array (
                                    "cmdid" => "2",
                                    "did" => "127",
                                    "dname" => "JAVA/JAVA_2/JAVA_2_1/",
                                    "dsize" => "9942",
                                    "files" => Array (
                                                    "0" => Array (
                                                    "dname" => "JAVA/JAVA_2/JAVA_2_1/",
                                                    "filename" => "1.java",
                                                    "filepath" => "C:/xampp/htdocs/Clonify/WebSite/files/shaban/JAVA/JAVA_2/JAVA_2_1/1.java",
                                                    "fsize" => "9942"
                                                            )
                                                     ),
                                    "children" => Array ()
                                            )
                                    )
                                )
)
)
);

if (($treemapdata)) {


    foreach ($treemapdata as $dirList => $data) {

        parseDirStructure($data, "Root");
    }
}
?>

    ];
            loadTreeMap(data);
    });
    
    
    
    <?php
            function parseDirStructure($directory, $parentName)
            {
                 if(!empty($directory)){
                     
                     if($directory ['dname']==""){
                         $dname = $parentName;
                     }
                     else
                     {
                        $dname = $directory ['dname'];
                     }
                    $dsize = $directory['dsize'];        
                    
                    createParent($directory, $parentName);
                   
                    $children = $directory['children'];
                    if(!empty($children)){
                        foreach($children as $child => $childData)
                         {
                            parseDirStructure($childData, $dname);
                         }
                    }

                     $files = $directory['files'];
                     traverseFiles($files);
            }
            }


    function createParent($directory, $parentName)
    {
    echo "{";
            if ($directory['dname'] != "")
    {
             echo "label: '".$directory['dname']."',";
             echo "value: 1,";
             echo "parent: '".$parentName."',";
 
    }
    else
    {
            echo "label: '".$parentName."',";
            echo "value: null,";
    }  
            echo "color: '#".random_color()."',";
            echo "},";
    }
    function random_color_part() {
    return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
            }
    function random_color() {
    return random_color_part().random_color_part().random_color_part();
            }



    function traverseFiles($files)
    {
        if(!empty($files)){
        foreach ($files as $file => $filedata) {

            echo "{";
            echo "label: '".$filedata['filename']."',";
            echo "value: ".$filedata['fsize'].",";
            echo "parent: '".$filedata['dname']."',";
            echo "data: {description: '"    .$filedata['filepath']."</br>File Size: ".$filedata['fsize']."', title: '".$filedata['filename']."'}";
            echo "},";
    }
    }
    }
    ?>
</script>