<?php

namespace Tests\Unit;

use App\Services\NumberBaseConverter;
use PHPUnit\Framework\TestCase;

class NumberBaseConverterTest extends TestCase
{
    private NumberBaseConverter $numberBaseConverter;

    protected function setUp(): void
    {
        $this->numberBaseConverter = new NumberBaseConverter();
    }

    /**
     * @dataProvider provideData
     */
    public function testConvertDecimal(string $decimal, string $result): void
    {
        $this->assertEquals($result, $this->numberBaseConverter->convertDecimal($decimal));
    }

    public static function provideData(): array
    {
        return [
            ['decimal' => '1', 'result' => '01'],
            ['decimal' => '1000', 'result' => '0g8'],
        ];
    }
}
