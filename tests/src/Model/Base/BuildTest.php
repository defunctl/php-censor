<?php

namespace Tests\PHPCensor\Model\Base;

use DateTime;
use PHPCensor\Exception\InvalidArgumentException;
use PHPCensor\Model\Base\Build;
use PHPUnit\Framework\TestCase;

class BuildTest extends TestCase
{
    public function testConstruct()
    {
        $build = new Build();

        self::assertInstanceOf('PHPCensor\Model', $build);
        self::assertInstanceOf('PHPCensor\Model\Base\Build', $build);

        self::assertEquals([
            'id'                    => null,
            'parent_id'             => null,
            'project_id'            => null,
            'commit_id'             => null,
            'status'                => null,
            'log'                   => null,
            'branch'                => null,
            'tag'                   => null,
            'create_date'           => null,
            'start_date'            => null,
            'finish_date'           => null,
            'committer_email'       => null,
            'commit_message'        => null,
            'extra'                 => null,
            'environment_id'        => null,
            'source'                => Build::SOURCE_UNKNOWN,
            'user_id'               => null,
            'errors_total'          => null,
            'errors_total_previous' => null,
            'errors_new'            => null,
        ], $build->getDataArray());
    }

    public function testId()
    {
        $build = new Build();

        $result = $build->setId(100);
        self::assertEquals(true, $result);
        self::assertEquals(100, $build->getId());

        $result = $build->setId(100);
        self::assertEquals(false, $result);

        self::assertEquals(['id' => 'id'], $build->getModified());
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testParentId()
    {
        $build = new Build();

        self::assertEquals(0, $build->getParentId());

        $result = $build->setParentId(222);
        self::assertEquals(true, $result);
        self::assertEquals(222, $build->getParentId());

        $result = $build->setParentId(222);
        self::assertEquals(false, $result);
    }

    public function testProjectId()
    {
        $build = new Build();

        $result = $build->setProjectId(200);
        self::assertEquals(true, $result);
        self::assertEquals(200, $build->getProjectId());

        $result = $build->setProjectId(200);
        self::assertEquals(false, $result);
    }

    public function testCommitId()
    {
        $build = new Build();

        $result = $build->setCommitId('commit');
        self::assertEquals(true, $result);
        self::assertEquals('commit', $build->getCommitId());

        $result = $build->setCommitId('commit');
        self::assertEquals(false, $result);
    }

    public function testStatus()
    {
        $build = new Build();

        $result = $build->setStatusFailed();
        self::assertEquals(Build::STATUS_FAILED, $build->getStatus());
        self::assertEquals(true, $result);

        $result = $build->setStatusFailed();
        self::assertEquals(Build::STATUS_FAILED, $build->getStatus());
        self::assertEquals(false, $result);
    }

    public function testLog()
    {
        $build = new Build();

        $result = $build->setLog('log');
        self::assertEquals(true, $result);
        self::assertEquals('log', $build->getLog());

        $result = $build->setLog('log');
        self::assertEquals(false, $result);
    }

    public function testBranch()
    {
        $build = new Build();

        $result = $build->setBranch('branch');
        self::assertEquals(true, $result);
        self::assertEquals('branch', $build->getBranch());

        $result = $build->setBranch('branch');
        self::assertEquals(false, $result);
    }

    public function testTag()
    {
        $build = new Build();

        $result = $build->setTag('tag');
        self::assertEquals(true, $result);
        self::assertEquals('tag', $build->getTag());

        $result = $build->setTag('tag');
        self::assertEquals(false, $result);
    }

    public function testCreateDate()
    {
        $build      = new Build();
        $createDate = new DateTime();

        $result = $build->setCreateDate($createDate);
        self::assertEquals(true, $result);
        self::assertEquals($createDate->getTimestamp(), $build->getCreateDate()->getTimestamp());

        $result = $build->setCreateDate($createDate);
        self::assertEquals(false, $result);
    }

    public function testStartDate()
    {
        $build = new Build();
        self::assertEquals(null, $build->getStartDate());

        $build      = new Build();
        $createDate = new DateTime();

        $result = $build->setStartDate($createDate);
        self::assertEquals(true, $result);
        self::assertEquals($createDate->getTimestamp(), $build->getStartDate()->getTimestamp());

        $result = $build->setStartDate($createDate);
        self::assertEquals(false, $result);
    }

    public function testFinishDate()
    {
        $build = new Build();
        self::assertEquals(null, $build->getFinishDate());

        $build      = new Build();
        $createDate = new DateTime();

        $result = $build->setFinishDate($createDate);
        self::assertEquals(true, $result);
        self::assertEquals($createDate->getTimestamp(), $build->getFinishDate()->getTimestamp());

        $result = $build->setFinishDate($createDate);
        self::assertEquals(false, $result);
    }

    public function testCommitterEmail()
    {
        $build = new Build();

        $result = $build->setCommitterEmail('email@email.com');
        self::assertEquals(true, $result);
        self::assertEquals('email@email.com', $build->getCommitterEmail());

        $result = $build->setCommitterEmail('email@email.com');
        self::assertEquals(false, $result);
    }

    public function testCommitMessage()
    {
        $build = new Build();

        $result = $build->setCommitMessage('message');
        self::assertEquals(true, $result);
        self::assertEquals('message', $build->getCommitMessage());

        $result = $build->setCommitMessage('message');
        self::assertEquals(false, $result);
    }

    public function testExtra()
    {
        $build = new Build();

        $result = $build->setExtra(['key-1' => 'value-1', 'key-2' => 'value-2']);
        self::assertEquals(true, $result);
        self::assertEquals(['key-1' => 'value-1', 'key-2' => 'value-2'], $build->getExtra());
        self::assertEquals('value-1', $build->getExtraItem('key-1'));
        self::assertEquals(null, $build->getExtraItem('key-3'));

        $result = $build->setExtra(['key-1' => 'value-1', 'key-2' => 'value-2']);
        self::assertEquals(false, $result);
    }

    public function testEnvironment()
    {
        $build = new Build();

        $result = $build->setEnvironmentId(22);
        self::assertEquals(true, $result);
        self::assertEquals(22, $build->getEnvironmentId());

        $result = $build->setEnvironmentId(22);
        self::assertEquals(false, $result);
    }

    public function testSource()
    {
        $build = new Build();

        $result = $build->setSource(Build::SOURCE_WEBHOOK_PULL_REQUEST_CREATED);
        self::assertEquals(true, $result);
        self::assertEquals(Build::SOURCE_WEBHOOK_PULL_REQUEST_CREATED, $build->getSource());

        $result = $build->setSource(Build::SOURCE_WEBHOOK_PULL_REQUEST_CREATED);
        self::assertEquals(false, $result);

        self::expectException('\PHPCensor\Exception\InvalidArgumentException');
        $build->setSource(20);
    }

    public function testUserId()
    {
        $build = new Build();

        $result = $build->setUserId(300);
        self::assertEquals(true, $result);
        self::assertEquals(300, $build->getUserId());

        $result = $build->setUserId(300);
        self::assertEquals(false, $result);
    }

    public function testErrorsTotal()
    {
        $build = new Build();

        self::assertEquals(0, $build->getErrorsTotal());

        $result = $build->setErrorsTotal(10);
        self::assertEquals(true, $result);
        self::assertEquals(10, $build->getErrorsTotal());

        $result = $build->setErrorsTotal(10);
        self::assertEquals(false, $result);
        self::assertEquals(10, $build->getErrorsTotal());
    }

    public function testErrorsTotalPrevious()
    {
        $build = new Build();

        self::assertEquals(0, $build->getErrorsTotalPrevious());

        $result = $build->setErrorsTotalPrevious(20);
        self::assertEquals(true, $result);
        self::assertEquals(20, $build->getErrorsTotalPrevious());

        $result = $build->setErrorsTotalPrevious(20);
        self::assertEquals(false, $result);
        self::assertEquals(20, $build->getErrorsTotalPrevious());
    }

    public function testErrorsNew()
    {
        $build = new Build();

        self::assertEquals(0, $build->getErrorsNew());

        $result = $build->setErrorsNew(30);
        self::assertEquals(true, $result);
        self::assertEquals(30, $build->getErrorsNew());

        $result = $build->setErrorsNew(30);
        self::assertEquals(false, $result);
        self::assertEquals(30, $build->getErrorsNew());
    }

    public function testIsDebug()
    {
        $build = new Build();
        self::assertEquals(false, $build->isDebug());

        $build->setExtra(['debug' => true]);
        self::assertEquals(true, $build->isDebug());

        \define('DEBUG_MODE', true);
        self::assertEquals(true, $build->isDebug());

        $build->setExtra(['debug' => false]);
        self::assertEquals(true, $build->isDebug());
    }
}
