<?php

namespace Tests\PHPCensor\Helper;

use PHPCensor\Helper\BuildInterpolator;
use PHPCensor\Model\Build;
use PHPCensor\Model\Build\GitBuild;
use PHPUnit\Framework\TestCase;

class BuildInterpolatorTest extends TestCase
{
    /**
     * @var BuildInterpolator
     */
    protected $testedInterpolator;

    protected function setUp()
    {
        parent::setup();
        $this->testedInterpolator = new BuildInterpolator();
    }

    public function testInterpolate_LeavesStringsUnchangedByDefault()
    {
        $string = "Hello World";
        $expectedOutput = "Hello World";

        $actualOutput = $this->testedInterpolator->interpolate($string);

        self::assertEquals($expectedOutput, $actualOutput);
    }

    public function testInterpolate_LeavesStringsUnchangedWhenBuildIsSet()
    {
        $build = new Build();
        $build->setId(0);
        $build->setProjectId(0);
        $build->setBranch('master');

        $string         = "Hello World";
        $expectedOutput = "Hello World";

        $this->testedInterpolator->setupInterpolationVars(
            $build,
            "php-censor.local"
        );

        $actualOutput = $this->testedInterpolator->interpolate($string);

        self::assertEquals($expectedOutput, $actualOutput);
    }
}
