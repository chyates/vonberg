<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ModelTables Model
 *
 * @method \App\Model\Entity\ModelTable get($primaryKey, $options = [])
 * @method \App\Model\Entity\ModelTable newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ModelTable[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ModelTable|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ModelTable patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ModelTable[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ModelTable findOrCreate($search, callable $callback = null, $options = [])
 */
class ModelTablesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->hasMany('ModelTableHeaders',['order' =>'ModelTableHeaders.order_num desc'])->setForeignKey('model_tableID');
        $this->hasMany('ModelTableRows',['order' =>'ModelTableRows.order_num desc'])->setForeignKey('model_tableID');
        $this->setTable('model_tables');
        $this->setDisplayField('model_tableID');
        $this->setPrimaryKey('model_tableID');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('model_tableID')
            ->allowEmpty('model_tableID', 'create');

        $validator
            ->integer('partID')
            ->allowEmpty('partID');

        $validator
            ->integer('order_num')
            ->allowEmpty('order_num');

        return $validator;
    }
}
