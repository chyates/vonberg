<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Specifications Model
 *
 * @method \App\Model\Entity\Specification get($primaryKey, $options = [])
 * @method \App\Model\Entity\Specification newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Specification[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Specification|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Specification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Specification[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Specification findOrCreate($search, callable $callback = null, $options = [])
 */
class SpecificationsTable extends Table
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

        $this->setTable('specifications');
        $this->setDisplayField('specsID');
        $this->setPrimaryKey('specsID');
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
            ->integer('specsID')
            ->allowEmpty('specsID', 'create');

        $validator
            ->integer('partID')
            ->allowEmpty('partID');

        $validator
            ->scalar('spec_name')
            ->maxLength('spec_name', 100)
            ->allowEmpty('spec_name');

        $validator
            ->scalar('spec_value')
            ->maxLength('spec_value', 100)
            ->allowEmpty('spec_value');

        $validator
            ->integer('order_num')
            ->allowEmpty('order_num');

        return $validator;
    }
}
