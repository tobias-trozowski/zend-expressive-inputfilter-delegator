<?php

/**
 * Copyright (c) 2016 Tobias Trozowski
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace TobiasTest\Expressive\InputFilter;

use Tobias\Expressive\InputFilter\ConfigProvider;
use Tobias\Expressive\InputFilter\InputFilterManagerDelegatorFactory;

/**
 * Class ConfigProviderTest
 * @package TobiasTest\Expressive\InputFilter
 */
class ConfigProviderTest extends \PHPUnit_Framework_TestCase
{

    public function testInvoke()
    {
        $subject = new ConfigProvider();
        $config = $subject();

        $this->assertInternalType('array', $config);
        $subset = [
            'dependencies' => [
                'delegators' => [
                    'InputFilterManager' => [
                        InputFilterManagerDelegatorFactory::class,
                    ],
                ],
            ],
        ];
        $this->assertArraySubset($subset, $config);
    }
}
