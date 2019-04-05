<?php
/**
 * Created by PhpStorm.
 * User: novobi
 * Date: 4/5/2019
 * Time: 4:31 PM
 */

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\ScalarType;
use Carbon\Carbon;

use Illuminate\Support\Facades\Log;

class DateType extends ScalarType
{

    /**
     * Serializes an internal value to include in a response.
     *
     * @param mixed $value
     * @return mixed
     */
    public function serialize($value)
    {
        // TODO: Implement serialize() method.
        Log::info($value);
        return $value->toDateString();
    }

    /**
     * Parses an externally provided value (query variable) to use as an input
     *
     * @param mixed $value
     * @return mixed
     */
    public function parseValue($value)
    {
        // TODO: Implement parseValue() method.
        Log::info($value);
        Carbon::createFromFormat('Y-m-d', $value);
    }

    /**
     * Parses an externally provided literal value (hardcoded in GraphQL query) to use as an input
     *
     * @param \GraphQL\Language\AST\Node $valueNode
     * @return mixed
     */
    public function parseLiteral($valueNode)
    {
        // TODO: Implement parseLiteral() method.
    }
}