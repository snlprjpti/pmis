<?php 
namespace Pmis\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model {

	protected $table = 'galleries';

	protected $fillable = ['title','image','status'];

}
