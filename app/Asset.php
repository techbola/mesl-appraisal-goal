<?php

namespace Cavidel;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
  protected $table   = 'tblAssets';
  protected $guarded = ['AssetRef'];
  public $primaryKey = 'AssetRef';
  public $dates = ['PurchaseDate'];

  public function category()
  {
    return $this->belongsTo('Cavidel\AssetCategory', 'CategoryID');
  }

  public function location()
  {
    return $this->belongsTo('Cavidel\Location', 'LocationID');
  }

  public function allotee()
  {
    return $this->belongsTo('Cavidel\Staff', 'AlloteeID');
  }

}
