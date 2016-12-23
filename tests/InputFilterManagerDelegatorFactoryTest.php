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

use Interop\Container\ContainerInterface;
use Tobias\Expressive\InputFilter\InputFilterManagerDelegatorFactory;
use Zend\InputFilter\InputFilterPluginManager;
use Zend\ServiceManager\Factory\DelegatorFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class InputFilterManagerDelegatorFactoryTest
 * @package TobiasTest\Expressive\InputFilter
 */
class InputFilterManagerDelegatorFactoryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [ContainerInterface::class, '__invoke'],
            [ServiceLocatorInterface::class, 'createDelegatorWithName'],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testInvoke($interface, $method)
    {
        $config = [
            'input_filters' => [],
        ];

        /** @var ContainerInterface|\PHPUnit_Framework_MockObject_MockObject $container */
        $container = $this->getMockBuilder($interface)->getMockForAbstractClass();
        $container->expects($this->once())->method('has')->with('config')->will($this->returnValue(true));
        $container->expects($this->once())->method('get')->with('config')->will($this->returnValue($config));

        $inputFilterPluginManager = $this->getMockBuilder(InputFilterPluginManager::class)->disableOriginalConstructor()->getMock();
        $inputFilterPluginManager->expects($this->once())->method('configure')->with(
            [
                'abstract_factories' => [],
                'aliases'            => [],
                'delegators'         => [],
                'factories'          => [],
                'initializers'       => [],
                'invokables'         => [],
                'lazy_services'      => [],
                'services'           => [],
                'shared'             => [],
            ]
        );

        $callback = function () use ($inputFilterPluginManager) {
            return $inputFilterPluginManager;
        };

        $subject = new InputFilterManagerDelegatorFactory();
        $this->assertInstanceOf(DelegatorFactoryInterface::class, $subject);

        if ($container instanceof ServiceLocatorInterface) {
            $instance = $subject->$method($container, 'InputFilterManager', 'InputFilterManager', $callback);
        } else {
            $instance = $subject->$method($container, 'InputFilterManager', $callback);
        }

        $this->assertInstanceOf(InputFilterPluginManager::class, $instance);
    }
}
