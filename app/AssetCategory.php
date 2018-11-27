<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class AssetCategory extends Model
{
  protected $table   = 'tblAssetCategory';
  protected $guarded = ['AssetCategoryRef'];
  public $primaryKey = 'AssetCategoryRef';
}
