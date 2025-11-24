<?php
$color_name_id = $_POST['getColorNameId'];
if(!empty($color_name_id)){
    delete_color($color_name_id);
}
