<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\FatalErrorException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;


use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		AuthorizationException::class,
		HttpException::class,
		ModelNotFoundException::class,
		ValidationException::class,
	];

	/**
	 * @var int
	 */
	protected $statusCode = 200;

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Exception $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{

		if ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) {
			$message = ($e->getMessage() == '') ? 'One or more resource was not found' : $e->getMessage();
			return $this->errorNotFound($message);
		}
		if ($e instanceof UnauthorizedHttpException) {
			$message = ($e->getMessage() == '') ? 'You don\'t have access to this resource' : $e->getMessage();
			return $this->errorUnauthorised($message);
		}
		if ($e instanceof AccessDeniedHttpException) {
			$message = ($e->getMessage() == '') ? 'Forbidden' : $e->getMessage();
			return $this->errorForbidden($message);
		}
		if ($e instanceof FatalErrorException) {
			$message = ($e->getMessage() == '') ? 'Internal Error' : $e->getMessage();
			return $this->errorInternal($message);
		}
		if ($e instanceof ConflictHttpException) {
			$message = ($e->getMessage() == '') ? 'Request unprocessable due to a conflict' : $e->getMessage();
			return $this->errorConflict($message);
		}
		if ($e instanceof BadRequestHttpException) {
			$message = ($e->getMessage() == '') ? 'Your request was unprocessable - wrong arguments' : $e->getMessage();
			return $this->errorWrongArgs($message);
		}
		if ($e instanceof NotAcceptableHttpException) {
			$message = ($e->getMessage() == '') ? 'Your request held invalid or incomplete data' : $e->getMessage();
			return $this->errorValidation($message);
		}


//		if ($e instanceof TokenExpiredException) {
//			return response()->json(['token_expired'], $e->getStatusCode());
//		} else if ($e instanceof TokenInvalidException) {
//			return response()->json(['token_invalid'], $e->getStatusCode());
//		}

		return parent::render($request, $e);
	}

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
	public function respondWithError($message)
	{
		return $this->respondWithArray([
			'error' => [
				'code' => $this->statusCode,
				'message' => $message
			]
		]);
	}

	public function errorUnauthorised($message)
	{
		return $this->setStatusCode(401)->respondWithError($message);
	}

	/**
	 * @param string $message
	 * @return mixed
	 */
	public function errorForbidden($message)
	{
		return $this->setStatusCode(403)->respondWithError($message);
	}

	/**
	 * @param string $message
	 * @return mixed
	 */
	public function errorWrongArgs($message)
	{
		return $this->setStatusCode(403)->respondWithError($message);
	}

	/**
	 * @param string $message
	 * @return mixed
	 */
	public function errorNotFound($message)
	{
		return $this->setStatusCode(404)->respondWithError($message);
	}

	/**
	 * @param string $message
	 * @return mixed
	 */
	public function errorConflict($message)
	{
		return $this->setStatusCode(409)->respondWithError($message);
	}

	/**
	 * @param string $message
	 * @return mixed
	 */
	public function errorValidation($message)
	{
		return $this->setStatusCode(422)->respondWithError($message);
	}

	/**
	 * @param string $message
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function errorInternal($message)
	{
		return $this->setStatusCode(500)->respondWithError($message);
	}


}
