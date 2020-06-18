<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

class FixedBuildsTable extends AbstractMigration
{
    public function up()
    {
        $this->execute("UPDATE builds SET errors_total = 0 WHERE errors_total IS NULL");
        $this->execute("UPDATE builds SET errors_total_previous = 0 WHERE errors_total_previous IS NULL");
        $this->execute("UPDATE builds SET errors_new = 0 WHERE errors_new IS NULL");

        $builds = $this->table('builds');

        $builds
            ->changeColumn('errors_total', 'integer', ['default' => 0])
            ->changeColumn('errors_total_previous', 'integer', ['default' => 0])
            ->changeColumn('errors_new', 'integer', ['default' => 0])
            ->changeColumn('commit_id', 'string', ['limit' => 50, 'null' => true])

            ->save();

        $this->execute("UPDATE builds SET commit_id = NULL WHERE commit_id = ''");
    }

    public function down()
    {
        $this->execute("UPDATE builds SET commit_id = '' WHERE commit_id IS NULL");

        $builds = $this->table('builds');

        $builds
            ->changeColumn('errors_total', 'integer', ['null' => true])
            ->changeColumn('errors_total_previous', 'integer', ['null' => true])
            ->changeColumn('errors_new', 'integer', ['null' => true])
            ->changeColumn('commit_id', 'string', ['limit' => 50])

            ->save();
    }
}
