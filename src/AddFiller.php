<?php

namespace germanow\yii2ActiveRecordSeeder;

/**
 * AddFiller
 *
 * Add records if they not exists in table with such id or attributes.
 *
 * @author Ivan Hermanov <ivan.hermanov@quartsoft.com>
 * @package app\components\utils
 */
final class AddFiller extends AbstractFiller
{
    /**
     * @inheritDoc
     */
    public function fill()
    {
        $this->saveRecordData();
    }

    /**
     * Before save hook.
     *
     * @return bool
     */
    protected function beforeSave($record)
    {
        $recordClass = $this->recordClass;
        $pk = $record->getPrimaryKey();
        if ($pk !== null) {
            return $recordClass::findOne($pk) === null;
        }
        return !$recordClass::find()->where($record->attributes)->exists();
    }
}
