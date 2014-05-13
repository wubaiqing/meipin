<?php

class ActiveRecord extends CActiveRecord implements IArrayable
{
    /**
     * Created at attribute name
     */
    const CREATED_AT = 'created_at';

    /**
     * Updated at attribute name
     */
    const UPDATED_AT = 'updated_at';

    /**
     * Auto fill timestamp attributes
     *
     * @var boolean
     */
    protected $timestamp = true;

    /**
     * hidden attributes fo toArray
     *
     * @see ActiveRecord::toArray
     * @var array
     */
    protected $hidden = array();

    /**
     * development debug switch
     * @see main.php
     * @var boolean 
     */
    public $enableDebug = false;
    /**
     * development cache switch
     * @see main.php
     * @var boolean 
     */
    public $enableCache = true;
    
    /**
     * extra attributes
     *
     * @see ActiveRecord::toArray
     */
    public $extraAttributes = array();

    public static function model($className = null)
    {
        return parent::model($className ?: get_called_class());
    }

    public function init()
    {
        $this->onBeforeSave = array($this, 'timestampBehavior');
        
        $this->enableCache = CommonHelper::getEnableCache();
        $this->enableDebug = CommonHelper::getEnableDebug();
    }

    public function timestampBehavior()
    {
		if ($this->timestamp) {
			$this->{self::UPDATED_AT} = time();
			if ($this->isNewRecord) {
				$this->{self::CREATED_AT} = $this->{self::UPDATED_AT};
			}
		}
    }
    /**
     * Find model exist else throw exception
     *
     * @param  integer           $id
     * @throws NotFoundException
     *
     * @return ActiveRecord
     */
    public function findOrFail($id)
    {
        $model = $this->findByPk($id);
        if ($model === null) {
            throw new NotFoundException;
        }

        return $model;
    }

    /**
     * Model exist else throw exception
     *
     * @param  integer           $id
     * @throws NotFoundException
     *
     * @return boolean
     */
    public function existOrFail($id)
    {
        $column = $this->getTableSchema()->primaryKey;
        if (!$this->exists("$column = ?", array($id))) {
            throw new NotFoundException;
        }

        return true;
    }

    /**
     * Pagination
     *
     * @param integer $limit
     *
     * @return ActiveDataProvider
     */
    public function paginate($limit = null)
    {
        return new ActiveDataProvider($this, array(
            'criteria' => array(
                'select' => array_diff(array_keys($this->getMetaData()->columns), $this->hidden),
            ),
            'pagination' => array(
                'pageVar' => Yii::app()->params['pagination']['pageVar'],
                'pageSize' => $limit ?: Yii::app()->params['pagination']['pageSize'],
            ),
        ));
    }

    /**
     * Convert model to array
     *
     * @return array
     */
    public function toArray()
    {
        $attributes = $this->getAttributes();

        foreach ($this->relations() as $name => $v) {
            if ($this->hasRelated($name)) {
                $relation = $this->getRelated($name);
                if (is_array($relation)) {
                    foreach ($relation as $key => $val) {
                        $relation[$key] = $val->toArray();
                    }
                    $attributes[$name] = $relation;
                } else {
                    $attributes[$name] = $relation->toArray();
                }
            }
        }

        $attributes = array_merge($attributes, $this->extraAttributes);

        return array_diff_key($attributes, array_flip($this->hidden));
    }

    /**
     * Get hidden attributes
     *
     * @return array
     */
    public function getHidden()
    {
        return $this->hidden;
    }

    /**
     * Set hidden attributes
     *
     * @return void
     */
    public function setHidden($attributes)
    {
        $attributes = is_array($attributes) ? $attributes : func_get_args();
        $this->hidden = $attributes;
    }
}
