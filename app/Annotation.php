<?php

/**
 * @OA\Swagger(
 *     basePath="/",
 *     schemes={"https", "http"},
 *     host=APP_URL,
 *     @OA\Info(
 *         version="1.0.0",
 *         title="FAC SOAP Interface API Platform",
 *         description="REST API interface for FAC SOAP Web Service",
 *         @OA\Contact(
 *             email="info@kendallarneaud.me"
 *         ),
 *     )
 * )
 * 
 * 
 * @OA\Tag(
 *     name="Authentications",
 *     description="Authentication endpoints"
 * )
 * 
 * @OA\Post(
 *     path="/refresh",
 * 	   tags={"Authentications"},
 *     description="refresh the Bearer token passed in the header",
 *     operationId="refresh",
 * 	   @OA\Server(
 * 			url="/",
 * 			description="Authenication based endpoints"
 * 	   ),
 * 	   @OA\Response(
 * 			response="200",
 * 			description="Successful refresh",
 * 			@OA\MediaType(
 *             mediaType="application/json"
 * 			)
 *     ),
 * 	   security={{"bearer": {} }},
 *     @OA\Response(
 * 			response="401",
 * 			description="Unauthorized action",
 * 			@OA\MediaType(
 *             mediaType="text/html"
 * 			)
 *     ),
 *     @OA\Response(
 * 			response="500",
 * 			description="Internal Server Error",
 * 			@OA\MediaType(
 *             mediaType="application/json",
 * 			   @OA\Schema(type="object",format="string",
 * 					@OA\Property(
 * 		 				property="error",
 * 		 				type="string",
 *     	 				format="string",
 *     	 				title="Error",
 *     	 				description="Error message"
 * 	   				)
 * 				)
 * 			)
 *     )
 * )
 * @OA\Post(
 *     path="/login/token",
 * 	   tags={"Authentications"},
 *     description="login using an otp token",
 *     operationId="loginToken",
 * 	   @OA\Server(
 * 			url="/",
 * 			description="Authenication based endpoints"
 * 	   ),
 * 	   @OA\Response(
 * 			response="200",
 * 			description="Successful refresh",
 * 			@OA\MediaType(
 *             mediaType="application/json"
 * 			)
 *     ),
 * 	   @OA\RequestBody(
 * 			description="Successful refresh",
 * 			@OA\MediaType(
 *             mediaType="application/json",
 * 			   @OA\Schema(
 * 					schema="token",
 * 					title="OTP Token",
 * 					type="object",
 * 					required={"token"},
 * 					minProperties=1,
 * 					maxProperties=1,
 * 	   				@OA\Property(
 * 		 				property="token",
 * 		 				type="string",
 *     	 				format="string",
 *     	 				title="OTP Token",
 *     	 				description="A one time password token as credentials"
 * 	   				)
 * 			   )
 * 			)
 * 	   ),
 *     @OA\Response(
 * 			response="401",
 * 			description="Unauthorized action",
 * 			@OA\MediaType(
 *             mediaType="text/html",
 * 			   @OA\Schema(type="string")
 * 			)
 *     ),
 *     @OA\Response(
 * 			response="500",
 * 			description="Internal Server Error",
 * 			@OA\MediaType(
 *             mediaType="application/json",
 * 			   @OA\Schema(type="object",format="string",
 * 					@OA\Property(
 * 		 				property="error",
 * 		 				type="string",
 *     	 				format="string",
 *     	 				title="Error",
 *     	 				description="Error message"
 * 	   				)
 * 				)
 * 			)
 *     )
 * )
 */