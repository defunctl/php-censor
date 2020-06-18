<?php

declare(strict_types=1);

namespace PHPCensor\Model\Base;

use PHPCensor\Exception\InvalidArgumentException;
use PHPCensor\Model;

class Build extends Model
{
    const STATUS_PENDING = 0;
    const STATUS_RUNNING = 1;
    const STATUS_SUCCESS = 2;
    const STATUS_FAILED  = 3;

    const SOURCE_UNKNOWN                       = 0;
    const SOURCE_MANUAL_WEB                    = 1;
    const SOURCE_MANUAL_CONSOLE                = 2;
    const SOURCE_PERIODICAL                    = 3;
    const SOURCE_WEBHOOK_PUSH                  = 4;
    const SOURCE_WEBHOOK_PULL_REQUEST_CREATED  = 5;
    const SOURCE_WEBHOOK_PULL_REQUEST_UPDATED  = 6;
    const SOURCE_WEBHOOK_PULL_REQUEST_APPROVED = 7;
    const SOURCE_WEBHOOK_PULL_REQUEST_MERGED   = 8;
    const SOURCE_MANUAL_REBUILD_WEB            = 9;
    const SOURCE_MANUAL_REBUILD_CONSOLE        = 10;

    /**
     * @var array
     */
    protected $data = [
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
        'errors_total'          => 0,
        'errors_total_previous' => 0,
        'errors_new'            => 0,
    ];

    /**
     * @var array
     */
    protected $allowedSources = [
        self::SOURCE_UNKNOWN,
        self::SOURCE_MANUAL_WEB,
        self::SOURCE_MANUAL_CONSOLE,
        self::SOURCE_MANUAL_REBUILD_WEB,
        self::SOURCE_MANUAL_REBUILD_CONSOLE,
        self::SOURCE_PERIODICAL,
        self::SOURCE_WEBHOOK_PUSH,
        self::SOURCE_WEBHOOK_PULL_REQUEST_CREATED,
        self::SOURCE_WEBHOOK_PULL_REQUEST_UPDATED,
        self::SOURCE_WEBHOOK_PULL_REQUEST_APPROVED,
        self::SOURCE_WEBHOOK_PULL_REQUEST_MERGED,
    ];

    public function getId(): ?int
    {
        return $this->data['id'];
    }

    public function setId(int $value): bool
    {
        if ($this->data['id'] === $value) {
            return false;
        }

        $this->data['id'] = $value;

        return $this->setModified('id');
    }

    public function getParentId(): ?int
    {
        return $this->data['parent_id'];
    }

    public function setParentId(?int $value): bool
    {
        if ($this->data['parent_id'] === $value) {
            return false;
        }

        $this->data['parent_id'] = $value;

        return $this->setModified('parent_id');
    }

    public function getProjectId(): int
    {
        return (int)$this->data['project_id'];
    }

    public function setProjectId(int $value): bool
    {
        if ($this->data['project_id'] === $value) {
            return false;
        }

        $this->data['project_id'] = $value;

        return $this->setModified('project_id');
    }

    public function getCommitId(): ?string
    {
        return $this->data['commit_id'];
    }

    public function setCommitId(?string $value): bool
    {
        if ($this->data['commit_id'] === $value) {
            return false;
        }

        $this->data['commit_id'] = $value;

        return $this->setModified('commit_id');
    }

    public function getStatus(): int
    {
        return (int)$this->data['status'];
    }

    protected function setStatus(int $value): bool
    {
        if ($this->data['status'] === $value) {
            return false;
        }

        $this->data['status'] = $value;

        return $this->setModified('status');
    }

    public function setStatusPending(): bool
    {
        return $this->setStatus(self::STATUS_PENDING);
    }

    public function setStatusRunning(): bool
    {
        return $this->setStatus(self::STATUS_RUNNING);
    }

    public function setStatusSuccess(): bool
    {
        return $this->setStatus(self::STATUS_SUCCESS);
    }

    public function setStatusFailed(): bool
    {
        return $this->setStatus(self::STATUS_FAILED);
    }

    public function getLog(): ?string
    {
        return $this->data['log'];
    }

    public function setLog(?string $value): bool
    {
        if ($this->data['log'] === $value) {
            return false;
        }

        $this->data['log'] = $value;

        return $this->setModified('log');
    }

    public function getBranch(): string
    {
        return $this->data['branch'];
    }

    public function setBranch(string $value): bool
    {
        if ($this->data['branch'] === $value) {
            return false;
        }

        $this->data['branch'] = $value;

        return $this->setModified('branch');
    }

    public function getTag(): ?string
    {
        return $this->data['tag'];
    }

    public function setTag(?string $value): bool
    {
        if ($this->data['tag'] === $value) {
            return false;
        }

        $this->data['tag'] = $value;

        return $this->setModified('tag');
    }

    public function getCreateDate(): \DateTime
    {
        return new \DateTime($this->data['create_date']);
    }

    public function setCreateDate(\DateTime $value): bool
    {
        $stringValue = $value->format('Y-m-d H:i:s');

        if ($this->data['create_date'] === $stringValue) {
            return false;
        }

        $this->data['create_date'] = $stringValue;

        return $this->setModified('create_date');
    }

    public function getStartDate(): ?\DateTime
    {
        if ($this->data['start_date']) {
            return new \DateTime($this->data['start_date']);
        }

        return null;
    }

    public function setStartDate(\DateTime $value): bool
    {
        $stringValue = $value->format('Y-m-d H:i:s');

        if ($this->data['start_date'] === $stringValue) {
            return false;
        }

        $this->data['start_date'] = $stringValue;

        return $this->setModified('start_date');
    }

    /**
     * @throws \Exception
     */
    public function getFinishDate(): ?\DateTime
    {
        if ($this->data['finish_date']) {
            return new \DateTime($this->data['finish_date']);
        }

        return null;
    }

    public function setFinishDate(\DateTime $value): bool
    {
        $stringValue = $value->format('Y-m-d H:i:s');

        if ($this->data['finish_date'] === $stringValue) {
            return false;
        }

        $this->data['finish_date'] = $stringValue;

        return $this->setModified('finish_date');
    }

    public function getCommitterEmail(): ?string
    {
        return $this->data['committer_email'];
    }

    public function setCommitterEmail(?string $value): bool
    {
        if ($this->data['committer_email'] === $value) {
            return false;
        }

        $this->data['committer_email'] = $value;

        return $this->setModified('committer_email');
    }

    public function getCommitMessage(): ?string
    {
        return $this->data['commit_message'];
    }

    public function setCommitMessage(?string $value): bool
    {
        if ($this->data['commit_message'] === $value) {
            return false;
        }

        $this->data['commit_message'] = $value;

        return $this->setModified('commit_message');
    }

    /**
     * @return mixed|null
     */
    public function getExtraItem(string $key)
    {
        $extra = $this->getExtra();
        if (!empty($extra[$key])) {
            return $extra[$key];
        }

        return null;
    }

    public function getExtra(): array
    {
        return !empty($this->data['extra'])
            ? \json_decode($this->data['extra'], true)
            : [];
    }

    public function setExtra(array $value): bool
    {
        $extra = \json_encode($value);
        if ($this->data['extra'] === $extra) {
            return false;
        }

        $this->data['extra'] = $extra;

        return $this->setModified('extra');
    }

    public function getEnvironmentId(): ?int
    {
        return $this->data['environment_id'];
    }

    public function setEnvironmentId(?int $value): bool
    {
        if ($this->data['environment_id'] === $value) {
            return false;
        }

        $this->data['environment_id'] = $value;

        return $this->setModified('environment_id');
    }

    public function getSource(): int
    {
        return $this->data['source'];
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setSource(int $value): bool
    {
        if (!in_array($value, $this->allowedSources, true)) {
            throw new InvalidArgumentException(
                'Column "source" must be one of: ' . \implode(', ', $this->allowedSources) . '.'
            );
        }

        if ($this->data['source'] === $value) {
            return false;
        }

        $this->data['source'] = $value;

        return $this->setModified('source');
    }

    public function getUserId(): ?int
    {
        return $this->data['user_id'];
    }

    public function setUserId(?int $value): bool
    {
        if ($this->data['user_id'] === $value) {
            return false;
        }

        $this->data['user_id'] = $value;

        return $this->setModified('user_id');
    }

    public function getErrorsTotal(): int
    {
        return $this->data['errors_total'];
    }

    public function setErrorsTotal(int $value): bool
    {
        if ($this->data['errors_total'] === $value) {
            return false;
        }

        $this->data['errors_total'] = $value;

        return $this->setModified('errors_total');
    }

    public function getErrorsTotalPrevious(): int
    {
        return $this->data['errors_total_previous'];
    }

    public function setErrorsTotalPrevious(int $value): bool
    {
        if ($this->data['errors_total_previous'] === $value) {
            return false;
        }

        $this->data['errors_total_previous'] = $value;

        return $this->setModified('errors_total_previous');
    }

    public function getErrorsNew(): int
    {
        return $this->data['errors_new'];
    }

    public function setErrorsNew(int $value): bool
    {
        if ($this->data['errors_new'] === $value) {
            return false;
        }

        $this->data['errors_new'] = $value;

        return $this->setModified('errors_new');
    }

    public function isDebug(): bool
    {
        if (defined('DEBUG_MODE') && DEBUG_MODE) {
            return true;
        }

        if ($this->getExtraItem('debug')) {
            return true;
        }

        return false;
    }
}
