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
 *             @OA\Schema(ref="#/components/schemas/AuthorizeRequest")
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
 * 			response="400",
 * 			description="Unsuccessful purchase",
 * 			@OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/FailResponse")
 * 			)
 *     ),
 *     @OA\Response(
 * 			response="401",
 * 			description="Unauthorized action | Unverified request",
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
 *		path="/v1/authorize",
 *		tags={"FAC"},
 * 		@OA\Server(
 * 			url="/fac/api",
 * 			description="FAC module endpoints for the platform"
 * 		),
 *		description="Makes a request to authorize the transaction",
 *     	operationId="authorize",
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
 *		   description="post request parameters to authorize",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/AuthorizeRequest")
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
 * 			response="400",
 * 			description="Unsuccessful purchase",
 * 			@OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/FailResponse")
 * 			)
 *     ),
 *     @OA\Response(
 * 			response="401",
 * 			description="Unauthorized action | Unverified request",
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
 *		   description="post request parameters for refund",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/ModificationRequest")
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
 * 			response="400",
 * 			description="Unsuccessful purchase",
 * 			@OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/FailResponse")
 * 			)
 *     ),
 *     @OA\Response(
 * 			response="401",
 * 			description="Unauthorized action | Unverified request",
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
* @OA\Post(
 *		path="/v1/subscription/cancel",
 *		tags={"FAC"},
 * 		@OA\Server(
 * 			url="/fac/api",
 * 			description="FAC module endpoints for the platform"
 * 		),
 *		description="send a cancel recurring payment request",
 *     	operationId="cancel",
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
 *		   description="post request parameters for cancel recurring",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/ModificationRequest")
 *         )
 *    	 ),
 *     	@OA\Response(
 * 			response="200",
 * 			description="Successful cancellation,
 * 			@OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/SuccessResponse")
 * 			)
 *    	),
 *      @OA\Response(
 * 			response="400",
 * 			description="Unsuccessful cancellation",
 * 			@OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/FailResponse")
 * 			)
 *     ),
 *     @OA\Response(
 * 			response="401",
 * 			description="Unauthorized action | Unverified request",
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
 * @OA\Post(
 *		path="/v1/capture",
 *		tags={"FAC"},
 * 		@OA\Server(
 * 			url="/fac/api",
 * 			description="FAC module endpoints for the platform"
 * 		),
 *		description="send a capture funds request",
 *     	operationId="capture",
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
 *		   description="post request parameters for a capture",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/ModificationRequest")
 *         )
 *    	 ),
 *     	@OA\Response(
 * 			response="200",
 * 			description="Successful capture",
 * 			@OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/SuccessResponse")
 * 			)
 *    	),
 *      @OA\Response(
 * 			response="400",
 * 			description="Unsuccessful capture",
 * 			@OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/FailResponse")
 * 			)
 *     ),
 *     @OA\Response(
 * 			response="401",
 * 			description="Unauthorized action | Unverified request",
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
 * @OA\Post(
 *		path="/v1/subscription",
 *		tags={"FAC"},
 * 		@OA\Server(
 * 			url="/fac/api",
 * 			description="FAC module endpoints for the platform"
 * 		),
 *		description="send a capture funds request",
 *     	operationId="subscription",
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
 *		   description="post request parameters for a subscription",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/RecurringRequest")
 *         )
 *    	 ),
 *     	@OA\Response(
 * 			response="200",
 * 			description="Successful subscription",
 * 			@OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/SuccessResponse")
 * 			)
 *    	),
 *      @OA\Response(
 * 			response="400",
 * 			description="Unsuccessful subscription",
 * 			@OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/FailResponse")
 * 			)
 *     ),
 *     @OA\Response(
 * 			response="401",
 * 			description="Unauthorized action | Unverified request",
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
 * @OA\Post(
 *		path="/v1/tokenize",
 *		tags={"FAC"},
 * 		@OA\Server(
 * 			url="/fac/api",
 * 			description="FAC module endpoints for the platform"
 * 		),
 *		description="send a request to tokenize a credit card number",
 *     	operationId="tokenize",
 *		@OA\Parameter(
 *         name="Signature",
 *         description="A SHA256 hash signature header to verify request. The string components to hash are card|api_key|cvv separated by pipe character (|) ",
 *         required=true,
 * 		   in="header",
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *	   	@OA\RequestBody(
 *		   description="post request parameters for tokenize",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/TokenizeRequest")
 *         )
 *    	 ),
 *     	@OA\Response(
 * 			response="200",
 * 			description="Successful tokenization",
 * 			@OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/CreateCardResponse")
 * 			)
 *    	),
 *      @OA\Response(
 * 			response="400",
 * 			description="Failed tokenization",
 * 			@OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/FailCreateCardResponse")
 * 			)
 *     ),
 *     @OA\Response(
 * 			response="401",
 * 			description="Unauthorized action | Unverified request",
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
 * 	   schema="AuthorizeRequest",
 *     title="Authorize Request",
 * 	   required={"expiry_month,expiry_year,currency,amount,cvv,card,order_id"},
 *	   type="object",
 *     description="POST request parameters and validation constraints",
 * 	   @OA\Property(
 * 			property="order_id",
 * 			type="string",
 *     		format="string",
 *     		title="Order Id",
 *     		description="The order id of the transaction"
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
 * 			type="string",
 * 			format="string",
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
 *     		description="required only if card number is a token PAN "
 * 	   ),
 * 	   @OA\Property(
 * 			property="tokenize",
 * 			type="boolean",
 * 			format="boolean",
 *     		title="Card Number should be tokenized",
 *     		description="required only if card number is to be tokenize"
 * 	   )
 * )
 * 
 * @OA\Schema(
 * 	   schema="RecurringRequest",
 *     title="Subscription Request",
 * 	   required={"expiry_month,expiry_year,currency,amount,cvv,card,billing_date,billing_cycle,how_many_times,order_id"},
 *	   type="object",
 *     description="POST request parameters and validation constraints",
 * 	   @OA\Property(
 * 			property="order_id",
 * 			type="string",
 *     		format="string",
 *     		title="Order Id",
 *     		description="The order id of the transaction"
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
 * 			type="string",
 * 			format="string",
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
 *     		description="required only if card number is a token PAN "
 * 	   ),
 * 	   @OA\Property(
 * 			property="tokenize",
 * 			type="boolean",
 * 			format="boolean",
 *     		title="Card Number should be tokenized",
 *     		description="required only if card number is to be tokenized"
 * 	   ),
 * 	   @OA\Property(
 * 			property="billing_date",
 * 			type="date",
 * 			format="date",
 *     		title="Subscription Start Date",
 *     		description="A valid future date format value."
 * 	   ),
 * 	   @OA\Property(
 * 			property="is_trial",
 * 			type="boolean",
 * 			format="boolean"
 *     		title="Is it a FREE TRIAL?",
 *     		description="Indicates if this is a free trial subscription"
 * 	   ),
 * 	   @OA\Property(
 * 			property="is_subsequent",
 * 			type="boolean",
 * 			format="boolean"
 *     		title="",
 *     		description=""
 * 	   ),
 * 	   @OA\Property(
 * 			property="billing_cycle",
 * 			type="string",
 * 			format="string",
 *     		pattern="\w{1}",
 *     		title="Subscription Frequency",
 *     		description="A single letter value of either (D)aily, (W)eekly, (F)ortnight, (M)onthly, (E) Bi-monthly, (Q)uarterly, (Y)early"
 * 	   ),
 * 	   @OA\Property(
 * 			property="how_many_times",
 * 			type="integer",
 * 			format="integer",
 *     		pattern="\d",
 *     		title="Frequency Occurrances",
 *     		description="A number indicating the number of times a the billing cycle will run for"
 * 	   )
 * )
 *	
 * @OA\Schema(
 * 	   schema="ModificationRequest",
 *     title="Modification Request",
 * 	   required={"order_id,amount"},
 *	   type="object",
 *     description="POST request parameters and validation constraints",
 * 	   @OA\Property(
 * 			property="order_id",
 * 			type="string",
 *     		format="string",
 *     		title="Order Id",
 *     		description="The order id of the authorize/captured transaction"
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
 * 	   schema="TokenizeRequest",
 *     title="Tokenie Request",
 * 	   required={"expiry_month,expiry_year,card_holder,cvv,card"},
 *	   type="object",
 *     description="POST request parameters and validation constraints",
 * 	   @OA\Property(
 * 			property="card_holder",
 * 			type="string",
 *     		format="string",
 *     		title="Card Holder",
 *     		description="An alpha numeric unique identifer for the credit card"
 * 	   ),
 * 	   @OA\Property(
 * 			property="card",
 * 			type="string",
 * 			format="string",
 *     		title="Card Number",
 *     		description="The credit card number"
 * 	   ),
 * 	   @OA\Property(
 * 			property="cvv",
 * 			type="string",
 * 			format="string",
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
 *     title="Successful Tokenize Response",
 * 	   type="object",
 * 	   schema="CreateCardResponse",
 *     description="Formatted success response from FAC",
 * 	   @OA\Property(
 * 		 property="success",
 * 		 type="boolean",
 * 		 format="boolean",
 *     	 title="Success indicator",
 *     	 description="True as the process was successful"
 * 	   ),
 * 	   @OA\Property(
 * 		 property="token",
 * 		 type="string",
 * 		 format="string",
 *     	 title="token PAN",
 *     	 description="FAC credit card token PAN"
 * 	   )
 * ) 
 *
 * @OA\Schema(
 *     title="Failed Tokenize Response",
 * 	   type="object",
 * 	   schema="FailCreateCardResponse",
 *     description="Formatted failed response from FAC",
 * 	   @OA\Property(
 * 		 property="success",
 * 		 type="boolean",
 * 		 format="boolean",
 *     	 title="Success indicator",
 *     	 description="False as the process was unsuccessful"
 * 	   ),
 * 	   @OA\Property(
 * 		 property="message",
 * 		 type="string",
 * 		 format="string",
 *     	 title="Error Message",
 *     	 description="Message for failure if any"
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
