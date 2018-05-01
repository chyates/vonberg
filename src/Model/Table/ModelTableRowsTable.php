<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ModelTableRows Model
 *
 * @method \App\Model\Entity\ModelTableRow get($primaryKey, $options = [])
 * @method \App\Model\Entity\ModelTableRow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ModelTableRow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ModelTableRow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ModelTableRow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ModelTableRow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ModelTableRow findOrCreate($search, callable $callback = null, $options = [])
 */
class ModelTableRowsTable extends Table
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

        $this->setTable('model_table_rows');
        $this->setDisplayField('model_table_rowID');
        $this->setPrimaryKey('model_table_rowID');
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
            ->integer('model_table_rowID')
            ->allowEmpty('model_table_rowID', 'create');

        $validator
            ->integer('model_tableID')
            ->allowEmpty('model_tableID');

        $validator
            ->scalar('model_table_row_text')
            ->maxLength('model_table_row_text', 100)
            ->allowEmpty('model_table_row_text');

        $validator
            ->integer('order_num')
            ->allowEmpty('order_num');

        return $validator;
    }
}
