<?php

use App\Models\Service;
use App\Models\Designation;
use App\Models\CropsCategory;

function designationName($id)
{
    $designation = Designation::find($id);
    if ($designation) {
        return $designation->title;
    }
}
function getCropName($id)
{
    $crop = Service::find($id);
    if ($crop) {
        return $crop->title;
    }
}
function getCategoryName($id)
{
    $crop = CropsCategory::find($id);
    if ($crop) {
        return $crop->title;
    }
}
function getCategorySlug($id)
{
    $crop = CropsCategory::find($id);
    if ($crop) {
        return $crop->slug;
    }
}
