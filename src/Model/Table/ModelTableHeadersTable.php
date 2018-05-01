<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ModelTableHeaders Model
 *
 * @method \App\Model\Entity\ModelTableHeader get($primaryKey, $options = [])
 * @method \App\Model\Entity\ModelTableHeader newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ModelTableHeader[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ModelTableHeader|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ModelTableHeader patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ModelTableHeader[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ModelTableHeader findOrCreate($search, callable $callback = null, $options = [])
 */
class ModelTableHeadersTable extends Table
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

        $this->setTable('model_table_headers');
        $this->setDisplayField('model_table_headerID');
        $this->setPrimaryKey('model_table_headerID');
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
            ->integer('model_table_headerID')
            ->allowEmpty('model_table_headerID', 'create');

        $validator
            ->integer('model_tableID')
            ->allowEmpty('model_tableID');

        $validator
            ->scalar('model_table_text')
            ->maxLength('model_table_text', 100)
            ->allowEmpty('model_table_text');

        $validator
            ->integer('order_num')
            ->allowEmpty('order_num');

        return $validator;
    }
}
