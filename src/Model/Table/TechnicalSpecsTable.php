<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TechnicalSpecs Model
 *
 * @method \App\Model\Entity\TechnicalSpec get($primaryKey, $options = [])
 * @method \App\Model\Entity\TechnicalSpec newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TechnicalSpec[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TechnicalSpec|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TechnicalSpec patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TechnicalSpec[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TechnicalSpec findOrCreate($search, callable $callback = null, $options = [])
 */
class TechnicalSpecsTable extends Table
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

        $this->setTable('technical_specs');
        $this->setDisplayField('title');
        $this->setPrimaryKey('techID');
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
            ->integer('techID')
            ->allowEmpty('techID', 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->allowEmpty('title');

        $validator
            ->scalar('file')
            ->maxLength('file', 255)
            ->allowEmpty('file');

        return $validator;
    }
}
