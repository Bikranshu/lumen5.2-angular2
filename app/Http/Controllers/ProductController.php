<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Helpers\CResponse as CResponse;

/**
 * Class ProductController
 * @package App\Http\Controllers
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
class ProductController extends Controller
{
	protected $response;

	protected $product;

	function __construct(CResponse $response, Product $product)
	{
		$this->response = $response;
		$this->product = $product;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index()
	{
		$products = $this->product->getProducts();
		if($products) {
			return $this->response->respondOk($products);
		}
		return $this->response->errorInternal('Unable to get the products');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show($id)
	{
		$product = $this->product->getProductById($id);
		if( !$product ) {
			return $this->response->errorNotFound('Product not found');
		}
		return $this->response->respondWithSuccess($product);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Request  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'code'		=> 'required',
			'name'		=> 'required',
			'status'    => 'required',
		]);
		if ($validator->errors()->count()) {
			return $this->response->errorBadRequest($validator->errors());
		}
		$product = $this->product->saveProduct($request);
		if ($product) {
			return $this->response->respondCreated($product);
		}
		return $this->response->errorInternal('Unable to create the product');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy($id)
	{
		$product = $this->product->find($id);
		if(!$product) {
			return $this->response->errorNotFound('Product not found');
		}
		if( !$product->delete() ) {
			return $this->response->errorInternal('Unable to delete the product');
		}
		return $this->response->respondNoContent('[]');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param  Request  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update($id, Request $request)
	{
		$product = $this->product->find($id);
		if(!$product) {
			return $this->response->errorNotFound('Product not found');
		}

		$validator = Validator::make($request->all(), [
			'code'		=> 'required',
			'name'		=> 'required',
		]);
		if ($validator->errors()->count()) {
			return $this->response->errorBadRequest($validator->errors());
		}
		$product = $this->product->updateProduct($id, $request->all());
		if ($product) {
			return $this->response->respondOk($product);
		}
		return $this->response->errorInternal('Unable to update the product');
	}


}