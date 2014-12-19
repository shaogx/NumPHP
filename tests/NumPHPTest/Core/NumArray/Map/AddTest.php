<?php
/**
 * NumPHP (http://numphp.org/)
 *
 * @link http://github.com/GordonLesti/NumPHP for the canonical source repository
 * @copyright Copyright (c) 2014 Gordon Lesti (http://gordonlesti.com/)
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace NumPHPTest\Core\NumArray\Map;

use NumPHP\Core\NumArray;
use NumPHP\Core\NumPHP;
use NumPHPTest\Core\Framework\TestCase;

/**
 * Class AddTest
  * @package NumPHPTest\Core\NumArray
  */
class AddTest extends TestCase
{
    public function testAddSingle()
    {
        $numArray1 = new NumArray(3);
        $numArray2 = new NumArray(-7);

        $expectedNumArray = new NumArray(-4);
        $this->assertNumArrayEquals($expectedNumArray, $numArray1->add($numArray2));
    }

    public function testAddSingleVector()
    {
        $numArray1 = NumPHP::arange(1, 5);
        $numArray2 = new NumArray(3);

        $expectedNumArray = NumPHP::arange(4, 8);
        $this->assertNumArrayEquals($expectedNumArray, $numArray1->add($numArray2));
    }

    public function testAddTwoVector()
    {
        $numArray1 = NumPHP::arange(1, 4);
        $numArray2 = NumPHP::arange(-19, -10, 3);

        $expectedNumArray = NumPHP::arange(-18, -6, 4);
        $this->assertNumArrayEquals($expectedNumArray, $numArray1->add($numArray2));
    }

    public function testAddMatrixSingel()
    {
        $numArray1 = new NumArray(56);
        $numArray2 = NumPHP::arange(1, 9)->reshape(3, 3);

        $expectedNumArray = NumPHP::arange(57, 65)->reshape(3, 3);
        $this->assertNumArrayEquals($expectedNumArray, $numArray1->add($numArray2));
    }

    public function testAddVectorMatrix()
    {
        $numArray1 = NumPHP::arange(1, 12)->reshape(3, 4);
        $numArray2 = NumPHP::arange(1, 3);

        $expectedNumArray = new NumArray(
            [
                [2, 3, 4, 5],
                [7, 8, 9, 10],
                [12, 13, 14, 15],
            ]
        );
        $this->assertNumArrayEquals($expectedNumArray, $numArray1->add($numArray2));
    }

    public function testAddMatrixMatrix()
    {
        $numArray1 = NumPHP::arange(1, 12)->reshape(3, 4);
        $numArray2 = NumPHP::arange(-5, 6)->reshape(3, 4);

        $expectedNumArray = NumPHP::arange(-4, 18, 2)->reshape(3, 4);
        $this->assertNumArrayEquals($expectedNumArray, $numArray1->add($numArray2));
    }

    public function testAddVectorArray()
    {
        $numArray = NumPHP::arange(1, 7);
        $array = [4, 5, 6, 7, 8, 9, 10];

        $expectedNumArray = NumPHP::arange(5, 17, 2);
        $this->assertNumArrayEquals($expectedNumArray, $numArray->add($array));
    }

    /**
     * @expectedException \NumPHP\Core\Exception\InvalidArgumentException
     * @expectedExceptionMessage Shape 5 is different from 4
     */
    public function testAddDifferentShape()
    {
        $numArray1 = NumPHP::arange(1, 5);
        $numArray2 = NumPHP::arange(1, 4);

        $numArray1->add($numArray2);
    }

    public function testAddCache()
    {
        $numArray = new NumArray(5);
        $numArray->setCache('key', 6);

        $numArray->add(4);
        $this->assertFalse($numArray->inCache('key'));
    }
}
