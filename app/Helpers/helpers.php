<?php
if (! function_exists('swagger_lume_asset')) {
    /**
     * Returns asset from swagger-ui composer package.
     *
     * @param $asset string
     *
     * @return string
     * @throws \SwaggerLume\Exceptions\SwaggerLumeException
     */
    function swagger_lume_asset($asset)
    {
        $file = swagger_ui_dist_path($asset);

        if (! file_exists($file)) {
            throw new SwaggerLumeException(sprintf('Requested L5 Swagger asset file (%s) does not exists', $asset));
        }

        return route('swagger-lume.asset', ['asset' => $asset, 'v' => md5($file)], env('FORCE_HTTPS'));
    }
}

if (! function_exists('array_pluck')) {

/**
 * Pluck an array of values from an array.
 *
 * @param  array   $array
 * @param  string  $key
 * @return array
 */
function array_pluck($array, $key)
{
	return array_map(function($v) use ($key)
	{
		return is_object($v) ? $v->$key : $v[$key];

	}, $array);
}

}

if (! function_exists('array_only')) {

/**
 * Get a subset of the items from the given array.
 *
 * @param  array  $array
 * @param  array  $keys
 * @return array
 */
function array_only($array, $keys)
{
	return array_intersect_key( $array, array_flip((array) $keys) );
}

}

if (! function_exists('array_except')) {

/**
 * Get all of the given array except for a specified array of items.
 *
 * @param  array  $array
 * @param  array  $keys
 * @return array
 */
function array_except($array, $keys)
{
	return array_diff_key( $array, array_flip((array) $keys) );
}

}

