<?php

namespace germanow\yii2ActiveRecordSeeder;

/**
 * OverwriteFiller
 *
 * Delete all records and fill table.
 *
 * @author Ivan Hermanov <ivan.hermanov@gmail.com>
 */
final class OverwriteFiller extends AbstractFiller
{
    /**
     * @inheritDoc
     */
    public function fill()
    {
        $recordClass = $this->recordClass;
        $recordClass::deleteAll();
        $this->saveRecordData();
    }
}
