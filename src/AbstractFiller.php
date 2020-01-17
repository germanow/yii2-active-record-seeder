<?php

namespace app\components\utils\ActiveRecordSeeder;

use yii\base\BaseObject;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;

/**
 * AbstractFiller
 *
 * @author Ivan Hermanov <ivan.hermanov@quartsoft.com>
 * @package app\components\utils
 */
abstract class AbstractFiller extends BaseObject implements FillerInterface
{
    /**
     * Class name of ActiveRecord model.
     *
     * @var string
     */
    public $recordClass;
    /**
     * Array of records data.
     * Example:
     * ```
     * [
     *  ['id' => 1, 'name' => 'user1'],
     *  ['id' => 2, 'name' => 'user2'],
     * ]
     * ```
     *
     * @var array
     */
    public $data;

    /**
     * @return void
     */
    abstract public function fill();

    /**
     * @return void
     */
    protected function saveRecordData()
    {
        foreach ($this->data as $recordData) {
            $record = new $this->recordClass;
            // generate unique behavior name in order to prevent name conflict
            $uniqueBehaviorName = uniqid('saveRelationsBehavior');
            $record->attachBehavior($uniqueBehaviorName, new SaveRelationsBehavior([
                'relations' => $this->getRelationNames($recordData),
            ]));
            foreach ($recordData as $attribute => $value) {
                $record->$attribute = $value;
            }
            if ($this->beforeSave($record)) {
                $record->save(false);
            }
        }
    }

    /**
     * @param array $recordData
     * @return array
     */
    protected function getRelationNames($recordData)
    {
        $record = new $this->recordClass;
        foreach ($recordData as $attribute => $value) {
            if ($record->getRelation($attribute, false) !== null) {
                $record->populateRelation($attribute, $value);
            }
        }
        return array_keys($record->relatedRecords);
    }

    /**
     * Before save hook.
     *
     * @return bool
     */
    protected function beforeSave($record)
    {
        return true;
    }
}
