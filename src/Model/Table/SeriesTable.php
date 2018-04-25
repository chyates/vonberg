<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Series Model
 *
 * @method \App\Model\Entity\Series get($primaryKey, $options = [])
 * @method \App\Model\Entity\Series newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Series[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Series|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Series patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Series[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Series findOrCreate($search, callable $callback = null, $options = [])
 */
class SeriesTable extends Table
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

        $this->setTable('series');
        $this->setDisplayField('name');
        $this->setPrimaryKey('seriesID');
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
            ->integer('seriesID')
            ->allowEmpty('seriesID', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->allowEmpty('name');

        return $validator;
    }
}
