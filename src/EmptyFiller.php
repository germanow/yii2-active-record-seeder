<?php

namespace germanow\yii2ActiveRecordSeeder;

/**
 * EmptyFiller
 *
 * Fill table if it's empty.
 *
 * @author Ivan Hermanov <ivan.hermanov@gmail.com>
 */
final class EmptyFiller extends AbstractFiller
{
    /**
     * @inheritDoc
     */
    public function fill()
    {
        $recordClass = $this->recordClass;
        if (!$recordClass::find()->exists()) {
            $this->saveRecordData();
        }
    }
}
