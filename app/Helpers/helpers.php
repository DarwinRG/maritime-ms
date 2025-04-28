<?php

if (!function_exists('statusAction')) {
    /**
     * This is a custom global function.
     *
     * @param string $value
     * @return string
     */
    function statusAction($value)
    {
        if ($value==1){
            echo '<span class="badge bg-success">Active</span>';
        }else if($value==2){
            echo '<span class="badge bg-danger">Ended</span>';
        }else{
            echo '<span class="badge bg-danger">Inactive</span>';
        }
    }

    function statusActivity($value)
    {
        if ($value==1){
            echo '<span class="badge bg-info">Active</span>';
        }else if($value==2){
            echo '<span class="badge bg-success">Submitted</span>';
        }else{
            echo '<span class="badge bg-danger">No Submitted</span>';
        }
    }
}
