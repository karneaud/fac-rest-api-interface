<?php
/**
 * 
 * @OA\Tag(
 *     name="FAC",
 *     description="FAC endpoints"
 * )
 * 
 * @OA\Post(
 *		path="/v1/purchase",
 *		tags={"FAC"},
 * 		@OA\Server(
 * 			url="/fac/api",
 * 			description="FAC module endpoints for the platform"
 * 		),
 *		description="make a purchase request",
 *     	operationId="purchase",
 *	   	@OA\RequestBody(
 *		   description="post request parameters for purchase",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/PurchaseRequest")
 *         )
 *    	 ),
 *     	@OA\Response(
 * 			response="200",
 * 			description="Successful purchase",
 * 			@OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/SuccessPurchaseResponse")
 * 			)
 *    	),
 *      @OA\Response(
 * 			response="503",
 * 			description="Unsuccessful purchase",
 * 			@OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/FailPurchaseResponse")
 * 			)
 *     ),
 *     @OA\Response(
 * 			response="401",
 * 			description="Unauthorized action",
 * 			@OA\MediaType(
 *             mediaType="text/html"
 * 			)
 *     ),
 *     @OA\Response(
 * 		response="422",
 * 		description="Validation Error Response",
 * 		@OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 * 					type="object",
 * 					title="Validation Error Response Object",
 * 					@OA\Property( property="error", type="string", format="string", description="validation error message")
 * 				)
 * 		)
 *    ),
 * 	  security={{"bearer": {} }}
 * )
 * 
 * @OA\Schema(
 *     title="Successful Purchase Response",
 * 	   type="object",
 * 	   schema="SuccessPurchaseResponse",
 *     description="Formatted success response from FAC",
 * 	   @OA\Property(
 * 		 property="order_id",
 * 		 type="string",
 *     	 format="string",
 *     	 title="Order Id",
 *     	 description="The order id of the purchase transaction"
 * 	   ),
 * 	   @OA\Property(
 * 		 property="trasnsaction_id",
 * 		 type="string",
 * 		 format="string",
 *     	 title="Transaction ID",
 *     	 description="FAC Reference id of the transaction IF successful"
 * 	   ),
 * 	   @OA\Property(
 * 		 property="success",
 * 		 type="boolean",
 * 		 format="boolean",
 *     	 title="Success indicator",
 *     	 description="True if the process was successful"
 * 	   ),
 * 	   @OA\Property(
 * 		 property="token",
 * 		 type="string",
 * 		 format="string",
 *     	 title="token PAN",
 *     	 description="FAC credit card token PAN IF process was successful"
 * 	   )
 * )
 * 
 * @OA\Schema(
 *     title="Failed Purchase Response",
 * 	   type="object",
 * 	   schema="FailPurchaseResponse",
 *     description="Formatted error response from FAC",
 * 	   @OA\Property(
 * 		 property="order_id",
 * 		 type="string",
 *     	 format="string",
 *     	 title="Order Id",
 *     	 description="The order id of the purchase transaction"
 * 	   ),
 * 	   @OA\Property(
 * 			property="trasnsaction_id",
 * 			type="string",
 * 			format="string",
 *     		title="Transaction ID",
 *     		description="Reference id of the transaction IF successful"
 * 	   ),
 * 	   @OA\Property(
 * 			property="error",
 * 			type="boolean",
 * 			format="boolean",
 *     		title="Error indicator",
 *     		description="True if the process was unsuccessful"
 * 	   ),
 * 	   @OA\Property(
 * 			property="message",
 * 			type="string",
 * 			format="string",
 *     		title="Error Message",
 *     		description="FAC reason message if the process was unsuccessful"
 * 	   ),
 * 	   @OA\Property(
 * 			property="code",
 * 			type="integer",
 * 			format="integer",
 *     		title="Error Code",
 *     		description="FAC Error reason code if the process was unsuccessful"
 * 	   )
 * )
 */
