<?php

namespace germanow\yii2ActiveRecordSeeder;

use yii\base\BaseObject;
use Yii;

/**
 * ActiveRecordSeeder
 *
 * Fill database with records.
 * Filling strategy depends on filler class.
 *
 * @author Ivan Hermanov <ivan.hermanov@gmail.com>
 */
class ActiveRecordSeeder extends BaseObject
{
    /**
     * @var string
     */
    public $defaultFillerClass;
    /**
     * @var FillerInterface[]
     */
    public $fillers = [];

     /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        if (!isset($this->defaultFillerClass)) {
            $this->defaultFillerClass = EmptyFiller::class;
        }
    }

    /**
     * Fill database using fillers.
     *
     * @return void
     */
    public function fill()
    {
        foreach ($this->fillers as $config) {
            if (!isset($config['class'])) {
                $config['class'] = $this->defaultFillerClass;
            }
            $filler = Yii::createObject($config);
            $filler->fill();
        }
    }
}
