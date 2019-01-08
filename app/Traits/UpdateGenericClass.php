<?php
namespace App\Traits;
use Illuminate\Http\Request;

trait UpdateGenericClass
{
   public static function updateData($item)
   {
       return self::where('id', $item->id)->update(request()->except('_token', '_method'));
   }
}
