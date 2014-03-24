<?php

/**
 * Hoa
 *
 *
 * @license
 *
 * New BSD License
 *
 * Copyright © 2007-2014, Ivan Enderlin. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of the Hoa nor the names of its contributors may be
 *       used to endorse or promote products derived from this software without
 *       specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDERS AND CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

namespace Atoum\PraspelExtension;

/**
 * Class \Atoum\PraspelExtension\Test.
 *
 * Automatically generated test must extend this class, that extend \atoum\test.
 *
 * @author     Ivan Enderlin <ivan.enderlin@hoa-project.net>
 * @copyright  Copyright © 2007-2014 Ivan Enderlin.
 * @license    New BSD License
 */

class Test extends \atoum\test {

    /**
     * Default namespace.
     *
     * @const \Atoum\PraspelExtension\Test string
     */
    const defaultNamespace          = '#(?:^|\\\)tests?\\\praspel?\\\#i';

    /**
     * Test method name.
     *
     * @const \Atoum\PraspelExtension\Test string
     */
    const TEST_METHOD_NAME          = '#^test ?(?<method>.+?) ?n°\d+$#u';

    /**
     * Untested method name.
     *
     * @const \Atoum\PraspelExtension\Test string
     */
    const TEST_METHOD_NAME_UNTESTED = '#^test ?(?<method>.+?) ?¦ ?untested$#u';



    /**
     * Define what to do before executing the test method.
     *
     * @access  public
     * @param   string  $testMethod    Test method name.
     * @return  void
     */
    public function beforeTestMethod ( $testMethod ) {

        $out = parent::beforeTestMethod($testMethod);
        $this->beforeTestMethodPraspel($testMethod);

        return $out;
    }

    /**
     * Praspel specific code before executing the test method.
     *
     * @access  protected
     * @param   string  $testMethod    Test method name.
     * @return  void
     */
    protected function beforeTestMethodPraspel ( $testMethod ) {

        if(0 !== preg_match(static::TEST_METHOD_NAME_UNTESTED, $testMethod, $matches))
            throw new \atoum\test\exceptions\skip(
                'Method “' . $matches['method'] . '” is not tested.');

        if(   0 === preg_match(static::TEST_METHOD_NAME, $testMethod, $matches)
           || empty($matches['method']))
            throw new \atoum\test\exceptions\skip(
                'Method name “' . $testMethod . '” is not well-formed ' .
                '(must match ' . static::TEST_METHOD_NAME . ').');

        $this->praspel->setWith($matches['method']);

        return;
    }
} 