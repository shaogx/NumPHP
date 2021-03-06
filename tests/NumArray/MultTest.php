<?php
declare(strict_types=1);

namespace NumPHPTest\NumArray;

use NumPHP\Exception\InvalidArgumentException;
use NumPHP\NumArray;
use NumPHPTest\Framework\TestCase;

class MultTest extends TestCase
{
    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function test2x3Mult4()
    {
        $numArray1 = NumArray::ones(2, 3);
        $numArray2 = NumArray::ones(4);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Shape [2, 3] and [4] are different');
        $numArray1->mult($numArray2);
    }

    public function test4Mult4()
    {
        $numArray1 = new NumArray([-1, -3, 0, 2]);
        $numArray2 = new NumArray([-8, -1, 7, 4]);
        $this->assertNumArrayEquals(new NumArray([8, 3, 0, 8]), $numArray1->mult($numArray2));
    }

    public function test2x3Mult2x3()
    {
        $numArray1 = new NumArray([
            [9, -1, -4],
            [-9, -1, 0]
        ]);
        $numArray2 = new NumArray([
            [-3, 7, -7],
            [0, 9, 6]
        ]);
        $this->assertNumArrayEquals(
            new NumArray([
                [-27, -7, 28],
                [0, -9, 0]
            ]),
            $numArray1->mult($numArray2)
        );
    }
}
