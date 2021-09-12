<?php

namespace Freesoftde\LiquibaseBundle\Test\Service;

use Freesoftde\LiquibaseBundle\Service\LiquibaseDownload;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * @coversDefaultClass \Freesoftde\LiquibaseBundle\Service\LiquibaseDownload
 */
class LiquibaseDownloadTest extends TestCase
{
    public function providerDownloadWrongPatterns() {
        return [
            [
                'v2.3.4',
            ],
            [
                '2.3',
            ],
            [
                '2.3.4.',
            ],
        ];
    }

    /**
     * @covers ::download
     * @dataProvider providerDownloadWrongPatterns
     * @param string $wrongPattern
     */
    public function testDownloadFailedWithWrongVersionPattern(string $wrongPattern): void
    {
        $this->expectException(InvalidArgumentException::class);
        (new LiquibaseDownload())->download($wrongPattern, 'path');
    }

    /**
     * @covers ::download
     */
    public function testDownloadFailedWithNotExistingDirectory(): void
    {
        $this->expectException(RuntimeException::class);
        (new LiquibaseDownload())->download('4.3.3', '/dir/that/doesnt/exist/');
    }

    /**
     * @covers ::download
     */
    public function testDownload(): void
    {
        $liquibaseDl = $this->getMockBuilder(LiquibaseDownload::class)
            ->onlyMethods(['saveLiquibaseJar'])
            ->getMock();
        $liquibaseDl->method('saveLiquibaseJar')->willReturn(200);
        $path = sys_get_temp_dir() . DIRECTORY_SEPARATOR;
        $version = '4.3.3';
        $result = $liquibaseDl->download($version, $path);
        $this->assertTrue($result);
    }
}
