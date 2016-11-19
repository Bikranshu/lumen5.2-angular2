<?php

namespace App\Helpers;

use Illuminate\Http\Response;

class CResponse
{

	/**
	 * @var int
	 */
	protected $statusCode = Response::HTTP_OK;

	/**
	 * @return mixed
	 */
	public function getStatusCode()
	{
		return $this->statusCode;
	}

	/**
	 * @param mixed $statusCode
	 * @return mixed
	 */
	public function setStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;
		return $this;
	}

	/**
	 * @param array $array
	 * @param array $headers
	 * @return \Illuminate\Http\Response
	 */
	public function respondWithArray(array $array, array $headers = [])
	{
		return Response()->json($array, $this->statusCode, $headers);
	}

	/**
	 * @param $data
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function respondWithSuccess($data)
	{
		return $this->respondWithArray([
			'success' => [
				'code' => $this->statusCode,
				'data' => $data
			]
		]);
	}

	/**
	 * @param $message
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function respondWithError($message)
	{
		return $this->respondWithArray([
			'error' => [
				'code' => $this->statusCode,
				'message' => $message
			]
		]);
	}

	/**
	 * @param string $data
	 * @return mixed
	 */
	public function respondOk($data)
	{
		return $this->setStatusCode(HTTP_OK)->respondWithSuccess($data);
	}

	/**
	 * @param string $data
	 * @return mixed
	 */
	public function respondCreated($data)
	{
		return $this->setStatusCode(HTTP_CREATED)->respondWithSuccess($data);
	}

	/**
	 * @param string $data
	 * @return mixed
	 */
	public function respondDeleted($data)
	{
		return $this->setStatusCode(HTTP_NO_CONTENT)->respondWithSuccess($data);
	}

	/**
	 * @param string $message
	 * @return mixed
	 */
	public function errotBadRequest($message)
	{
		return $this->setStatusCode(HTTP_BAD_REQUEST)->respondWithError($message);
	}

	/**
	 * @param string $message
	 * @return mixed
	 */
	public function errorUnauthorised($message)
	{
		return $this->setStatusCode(HTTP_UNAUTHORIZED)->respondWithError($message);
	}

	/**
	 * @param string $message
	 * @return mixed
	 */
	public function errorForbidden($message)
	{
		return $this->setStatusCode(HTTP_FORBIDDEN)->respondWithError($message);
	}

	/**
	 * @param string $message
	 * @return mixed
	 */
	public function errorWrongArgs($message)
	{
		return $this->setStatusCode(HTTP_FORBIDDEN)->respondWithError($message);
	}

	/**
	 * @param string $message
	 * @return mixed
	 */
	public function errorNotFound($message)
	{
		return $this->setStatusCode(HTTP_NOT_FOUND)->respondWithError($message);
	}

	/**
	 * @param string $message
	 * @return mixed
	 */
	public function errorConflict($message)
	{
		return $this->setStatusCode(HTTP_CONFLICT)->respondWithError($message);
	}

	/**
	 * @param string $message
	 * @return mixed
	 */
	public function errorValidation($message)
	{
		return $this->setStatusCode(HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
	}

	/**
	 * @param string $message
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function errorInternalError($message)
	{
		return $this->setStatusCode(HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
	}

}