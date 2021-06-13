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
 *		@OA\Parameter(
 *         name="Signature",
 *         description="A SHA256 hash signature header to verify request. The string components to hash are order_id|api_key|amount separated by pipe character (|) ",
 *         required=true,
 * 		   in="header",
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
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
 *             @OA\Schema(ref="#/components/schemas/SuccessResponse")
 * 			)
 *    	),
 *      @OA\Response(
 * 			response="503",
 * 			description="Unsuccessful purchase",
 * 			@OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/FailResponse")
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
 * 	  security={"auth", {"bearer": {} }}
 * )
 * 
 * @OA\Post(
 *		path="/v1/refund",
 *		tags={"FAC"},
 * 		@OA\Server(
 * 			url="/fac/api",
 * 			description="FAC module endpoints for the platform"
 * 		),
 *		description="send a refund request",
 *     	operationId="refund",
 *		@OA\Parameter(
 *         name="Signature",
 *         description="A SHA256 hash signature header to verify request. The string components to hash are order_id|api_key|amount separated by pipe character (|) ",
 *         required=true,
 * 		   in="header",
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *	   	@OA\RequestBody(
 *		   description="post request parameters for purchase",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/RefundRequest")
 *         )
 *    	 ),
 *     	@OA\Response(
 * 			response="200",
 * 			description="Successful refund",
 * 			@OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/SuccessResponse")
 * 			)
 *    	),
 *      @OA\Response(
 * 			response="503",
 * 			description="Unsuccessful purchase",
 * 			@OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/FailResponse")
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
 * 	  security={ {"bearer": {} } }
 * )
 *
 * @OA\Schema(
 * 	   schema="PurchaseRequest",
 *     title="Purchase Request",
 * 	   required={"order_id,currency,amount,cvv,card"},
 *	   type="object",
 *     description="POST request parameters and validation constraints",
 * 	   @OA\Property(
 * 			property="order_id",
 * 			type="string",
 *     		format="string",
 *     		title="Order Id",
 *     		description="The order id of the purchase transaction"
 * 	   ),
 * 	   @OA\Property(
 * 			property="currency",
 * 			type="string",
 * 			format="string",
 *     		pattern="\w{3}",
 *     		title="Currency",
 *     		description="The 3 letter ISO country currency code for the amount"
 * 	   ),
 * 	   @OA\Property(
 * 			property="amount",
 * 			type="number",
 * 			format="float",
 *     		title="Amount",
 *     		description="The amount total of the order"
 * 	   ),
 * 	   @OA\Property(
 * 			property="card",
 * 			type="string",
 * 			format="string",
 *     		title="Card Number",
 *     		description="The credit card # or token PAN to use to process payment"
 * 	   ),
 * 	   @OA\Property(
 * 			property="cvv",
 * 			type="integer",
 * 			format="integer",
 *     		pattern="\d{3}",
 *     		title="CCV",
 *     		description="The 3 digit security code for the credit card"
 * 	   ),
 * 	   @OA\Property(
 * 			property="expiry_month",
 * 			type="integer",
 * 			format="integer",
 *     		pattern="\d{1,2}",
 *     		title="Expiry Month",
 *     		description="The expiration month on the credit card"
 * 	   ),
 * 	   @OA\Property(
 * 			property="expiry_year",
 * 			type="integer",
 * 			format="integer",
 *     		pattern="\d{4}",
 *     		title="Expiry Year",
 *     		description="The expiration year on the credit card"
 * 	   ),
 * 	   @OA\Property(
 * 			property="tokenized",
 * 			type="boolean",
 * 			format="boolean",
 *     		title="Card Number is a Token PAN",
 *     		description="required if card number is a token PAN "
 * 	   )
 * )
 *	
* @OA\Schema(
 * 	   schema="RefundRequest",
 *     title="Refund Request",
 * 	   required={"order_id,amount"},
 *	   type="object",
 *     description="POST request parameters and validation constraints",
 * 	   @OA\Property(
 * 			property="order_id",
 * 			type="string",
 *     		format="string",
 *     		title="Order Id",
 *     		description="The order id of the purchase transaction"
 * 	   ),
 * 	   @OA\Property(
 * 			property="amount",
 * 			type="number",
 * 			format="float",
 *     		title="Amount",
 *     		description="The amount total of the order"
 * 	   )
 * )
 *
 * @OA\Schema(
 *     title="Successful Response",
 * 	   type="object",
 * 	   schema="SuccessResponse",
 *     description="Formatted success response from FAC",
 * 	   @OA\Property(
 * 		 property="order_id",
 * 		 type="string",
 *     	 format="string",
 *     	 title="Order Id",
 *     	 description="The order id of the transaction"
 * 	   ),
 * 	   @OA\Property(
 * 		 property="transaction_id",
 * 		 type="string",
 * 		 format="string",
 *     	 title="Transaction ID",
 *     	 description="FAC Reference id of the transaction IF successful if available"
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
 *     	 description="FAC credit card token PAN IF requested and process is successful and not already tokenized"
 * 	   ),
 * 	   @OA\Property(
 * 		 property="code",
 * 		 type="integer",
 * 		 format="integer",
 *     	 title="Message Code",
 *     	 description="Code for response"
 * 	   ),
 * 	   @OA\Property(
 * 		 property="message",
 * 		 type="string",
 * 		 format="string",
 *     	 title="Message",
 *     	 description="Message for response"
 * 	   )
 * )
 * 
 * @OA\Schema(
 *     title="Failed Response",
 * 	   type="object",
 * 	   schema="FailResponse",
 *     description="Formatted error response from FAC",
 * 	   @OA\Property(
 * 		 property="order_id",
 * 		 type="string",
 *     	 format="string",
 *     	 title="Order Id",
 *     	 description="The order id of the transaction if available"
 * 	   ),
 * 	   @OA\Property(
 * 			property="trasnsaction_id",
 * 			type="string",
 * 			format="string",
 *     		title="Transaction ID",
 *     		description="Reference id of the transaction IF available"
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
 *
 */
