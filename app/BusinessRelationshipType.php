<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;

class BusinessRelationshipType extends Model
{
    protected $table      = 'tblBusinessRelationshipType';
    protected $guarded    = ['BusinessRelationshipTypeRef'];
    protected $primaryKey = 'BusinessRelationshipTypeRef';
}
