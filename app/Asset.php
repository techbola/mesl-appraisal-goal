<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
  protected $table   = 'tblAssets';
  protected $guarded = ['AssetRef'];
  public $primaryKey = 'AssetRef';
  public $dates = ['PurchaseDate'];
}
