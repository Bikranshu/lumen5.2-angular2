<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Account
 * @package App\Models
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
class Product extends Model
{
	protected $table = 'products';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'code','name', 'description', 'status', 'created_by',
	];


	public function getProducts()
	{
		$query = $this;
		return $query->paginate(20);
	}

	public function getProductById($id)
	{
		return $this->find($id);
	}

	public function saveProduct($input)
	{
		return $this->create($input->all());
	}

	public function updateProduct($id, $input)
	{
		$updated = $this->find($id)->update($input);
		$post = $this->find($id);
		if($updated) {
			return $post;
		}
		return false;
	}

}