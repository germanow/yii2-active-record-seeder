<?php

namespace app\components\utils\ActiveRecordSeeder;

/**
 * OverwriteFiller
 *
 * Delete all records and fill table.
 *
 * @author Ivan Hermanov <ivan.hermanov@quartsoft.com>
 * @package app\components\utils
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
